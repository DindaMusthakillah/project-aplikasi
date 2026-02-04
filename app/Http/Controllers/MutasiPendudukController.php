<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use App\Models\MutasiPenduduk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MutasiPendudukController extends Controller
{
    public function index()
    {
        $query = MutasiPenduduk::query();
        if (request()->has('kk') && request()->kk != '') {
            $query->where('no_kk', 'LIKE', '%' . request()->kk . '%');
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

        $mutasi = $query
            ->orderBy('no_kk')
            ->get()
            ->sortBy(function ($item) use ($orderMap) {
                $rank = $orderMap[$item->status_hubungan_dalam_keluarga] ?? 99;
                return sprintf('%s-%02d-%s', $item->no_kk, $rank, $item->nama_lengkap);
            })
            ->groupBy('no_kk');
        return view('mutasi.index', compact('mutasi'));
    }

    public function createFromPenduduk($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        return view('mutasi.create', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:mutasi_penduduk',
            'alamat_asal' => 'required',
            'alamat_tujuan' => 'required',
            'jenis_mutasi' => 'required',
            'tanggal_mutasi' => 'required|date',
        ]);
        MutasiPenduduk::create($validated);
        $this->logActivity('create', 'mutasi', null, 'Menambah data mutasi');
        return redirect()->route('mutasi.index')->with('success', 'Data mutasi penduduk berhasil ditambahkan!');
    }

    // Tambahkan method mutate untuk menangani tombol Mutasi langsung
    public function mutate(Request $request, $pendudukId)
    {
        $penduduk = DataPenduduk::findOrFail($pendudukId);

        // Validasi minimal (opsional, tambahkan jika perlu)
        $request->validate([
            'jenis_mutasi' => 'nullable|string',
            'alamat_tujuan' => 'nullable|string',
            'tanggal_mutasi' => 'nullable|date',
        ]);

        // Simpan ke tabel mutasi (isi semua kolom dari penduduk)
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
            'alamat_asal' => $penduduk->dusun, // Gunakan dusun sebagai alamat asal
            'alamat_tujuan' => $request->alamat_tujuan ?? 'Tidak diketahui',
            'jenis_mutasi' => $request->jenis_mutasi ?? 'Pindah',
            'tanggal_mutasi' => $request->tanggal_mutasi ?? now(),
            'keterangan' => 'Mutasi dari data penduduk',
        ]);
        $this->logActivity('mutasi', 'penduduk', $pendudukId, 'Memutasi data penduduk');

        // Hapus dari tabel penduduk
        $penduduk->delete();

        return redirect()->route('mutasi.index')->with('success', 'Data penduduk berhasil dimutasi.');
    }

    public function storeFromPenduduk(Request $request, $id)
    {
        $penduduk = DataPenduduk::findOrFail($id);

        $request->validate([
            'jenis_mutasi' => 'required',
            'alamat_tujuan' => 'required',
            'tanggal_mutasi' => 'required|date',
        ]);

        // Simpan ke tabel mutasi
        MutasiPenduduk::create([
            'no_kk' => $penduduk->no_kk,
            'nama_lengkap' => $penduduk->nama_lengkap,
            'nik' => $penduduk->nik,
            'alamat_asal' => $penduduk->dusun, // Perbaiki: gunakan dusun
            'alamat_tujuan' => $request->alamat_tujuan,
            'jenis_mutasi' => $request->jenis_mutasi,
            'tanggal_mutasi' => $request->tanggal_mutasi,
            // Tambahkan kolom lain jika perlu, seperti jenis_kelamin, dll.
        ]);
        $this->logActivity('mutasi', 'penduduk', $id, 'Memutasi data penduduk');

        // Hapus dari tabel penduduk
        $penduduk->delete();

        return redirect()->route('mutasi.index')->with('success', 'Data penduduk berhasil dimutasi.');
    }

    public function edit(MutasiPenduduk $mutasi)
    {
        return view('mutasi.edit', compact('mutasi'));
    }

    // Hapus $fillable yang salah di sini

    public function update(Request $request, MutasiPenduduk $mutasi)
    {
        $validated = $request->validate([
            'no_kk' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:mutasi_penduduk,nik,' . $mutasi->id,
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
            'alamat_asal' => 'required',
            'alamat_tujuan' => 'required',
            'status_mutasi' => 'required',
            'tanggal_mutasi' => 'required|date',
        ]);

        $mutasi->update($validated);
        $this->logActivity('update', 'mutasi', $mutasi->id, 'Memperbarui data mutasi');

        return redirect()->route('mutasi.index')->with('success', 'Data mutasi penduduk berhasil diperbarui!');
    }

    public function printAll()
    {
        $mutasi = MutasiPenduduk::all();
        $pdf = Pdf::loadView('mutasi.print_all', compact('mutasi'));
        return $pdf->download('data_mutasi_penduduk.pdf');
    }

    public function show($id)
    {
        // Supaya gak error, cukup redirect ke index aja
        return redirect()->route('mutasi.index');
    }

    public function destroy(MutasiPenduduk $mutasi)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('mutasi.index')->with('error', 'Hanya admin yang bisa menghapus data.');
        }

        $mutasi->delete();
        $this->logActivity('delete', 'mutasi', $mutasi->id, 'Menghapus data mutasi');
        return redirect()->route('mutasi.index')->with('success', 'Data mutasi penduduk berhasil dihapus!');
    }
}
