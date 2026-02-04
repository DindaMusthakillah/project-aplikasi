<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use Illuminate\Http\Request;
use App\Models\MutasiPenduduk;

class DataPendudukController extends Controller
{
    // Menampilkan data penduduk + pencarian berdasarkan dusun
    public function index(Request $request)
    {
        $query = DataPenduduk::query();

        // Filter berdasarkan KK kalau ada
        if ($request->has('kk') && $request->kk != '') {
            $query->where('no_kk', 'LIKE', '%' . $request->kk . '%');
        }

        $orderMap = [
            'Kepala Keluarga' => 1,
            'Suami' => 2,
            'Istri' => 3,
            'Anak' => 4,
            'Orang Tua' => 5,
            'Famili Lain' => 6,
            'Cucu' => 7,
        ];

        $penduduk = $query
            ->orderBy('no_kk')
            ->get()
            ->sortBy(function ($item) use ($orderMap) {
                $rank = $orderMap[$item->status_hubungan_dalam_keluarga] ?? 99;
                return sprintf('%s-%02d-%s', $item->no_kk, $rank, $item->nama_lengkap);
            })
            ->groupBy('no_kk');

        // Hitung jumlah laki-laki dan perempuan sesuai filter
        $jumlahLaki = (clone $query)->where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = (clone $query)->where('jenis_kelamin', 'Perempuan')->count();


        return view('penduduk.index', compact('penduduk', 'jumlahLaki', 'jumlahPerempuan'));
    }

    // Form tambah data
    public function create()
    {
        return view('penduduk.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => 'required|digits:16',
            'nama_lengkap' => 'required',
            'nik' => 'required|digits:16|unique:data_penduduks',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'pendidikan' => 'required',
            'jenis_pekerjaan' => 'required',
            'golongan_darah' => 'nullable',
            'status_perkawinan' => 'required',
            'tanggal_perkawinan' => 'nullable|date',
            'status_hubungan_dalam_keluarga' => 'required',
            'kewarganegaraan' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'dusun' => 'required',
        ]);

        DataPenduduk::create($validated);
        $this->logActivity('create', 'penduduk', null, 'Menambah data penduduk');

        return redirect()->route('penduduk.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        return view('penduduk.edit', compact('penduduk'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $penduduk = DataPenduduk::findOrFail($id);

        $validated = $request->validate([
            'no_kk' => 'required|digits:16',
            'nama_lengkap' => 'required',
            'nik' => 'required|digits:16|unique:data_penduduks,nik,' . $id,
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'pendidikan' => 'required',
            'jenis_pekerjaan' => 'required',
            'golongan_darah' => 'nullable',
            'status_perkawinan' => 'required',
            'tanggal_perkawinan' => 'nullable|date',
            'status_hubungan_dalam_keluarga' => 'required',
            'kewarganegaraan' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'dusun' => 'required',
        ]);

        $penduduk->update($validated);
        $this->logActivity('update', 'penduduk', $penduduk->id, 'Memperbarui data penduduk');

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('penduduk.index')->with('error', 'Hanya admin yang bisa menghapus data.');
        }

        $penduduk = DataPenduduk::findOrFail($id);
        $penduduk->delete();
        $this->logActivity('delete', 'penduduk', $id, 'Menghapus data penduduk');

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus!');
    }
    public function showMutasiForm($id)
    {
        $penduduk = DataPenduduk::find($id);

        if (!$penduduk) {
            return redirect()->route('penduduk.index')->with('error', 'Data penduduk tidak ditemukan.');
        }

        return view('penduduk.mutasi-form', compact('penduduk'));
    }

    public function mutasi(Request $request, $id)
    {
        $penduduk = DataPenduduk::find($id);

        if (!$penduduk) {
            return redirect()->route('penduduk.index')->with('error', 'Data penduduk tidak ditemukan.');
        }

        // Validasi input dari form
        $validated = $request->validate([
            'alamat_tujuan' => 'required',
            'jenis_mutasi' => 'nullable',
            'tanggal_mutasi' => 'nullable|date',
        ]);

        // Simpan data ke tabel mutasi_penduduk
        MutasiPenduduk::create([
            'no_kk' => $penduduk->no_kk,
            'nama_lengkap' => $penduduk->nama_lengkap,
            'nik' => $penduduk->nik,
            'jenis_kelamin' => $penduduk->jenis_kelamin,
            'tempat_lahir' => $penduduk->tempat_lahir,
            'tanggal_lahir' => $penduduk->tanggal_lahir,
            'agama' => $penduduk->agama,
            'pendidikan' => $penduduk->pendidikan,
            'jenis_pekerjaan' => $penduduk->jenis_pekerjaan,
            'golongan_darah' => $penduduk->golongan_darah,
            'status_perkawinan' => $penduduk->status_perkawinan,
            'tanggal_perkawinan' => $penduduk->tanggal_perkawinan,
            'status_hubungan_dalam_keluarga' => $penduduk->status_hubungan_dalam_keluarga,
            'kewarganegaraan' => $penduduk->kewarganegaraan,
            'nama_ayah' => $penduduk->nama_ayah,
            'nama_ibu' => $penduduk->nama_ibu,
            'dusun' => $penduduk->dusun,
            'alamat_asal' => $penduduk->dusun,
            'alamat_tujuan' => $validated['alamat_tujuan'],
            'status_mutasi' => $validated['jenis_mutasi'] ?? 'Pindah Keluar',
            'tanggal_mutasi' => $validated['tanggal_mutasi'] ?? now(),
            'keterangan' => 'Data dimutasi dari tabel penduduk',
        ]);

        // Hapus data penduduk dari tabel asli
        $penduduk->delete();

        return redirect()->route('mutasi.index')->with('success', 'Data berhasil dimutasi ke menu Mutasi Penduduk.');
    }
}
