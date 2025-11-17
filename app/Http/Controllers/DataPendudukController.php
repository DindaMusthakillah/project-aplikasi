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

        // Filter berdasarkan dusun kalau ada
        if ($request->has('dusun') && $request->dusun != '') {
            $query->where('dusun', 'LIKE', '%' . $request->dusun . '%');
        }

        $penduduk = $query->get();

        // Hitung jumlah laki-laki dan perempuan sesuai filter
        $jumlahLaki = $query->clone()->where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = $query->clone()->where('jenis_kelamin', 'Perempuan')->count();

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
            'no_kk' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:data_penduduks',
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
            'no_kk' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:data_penduduks,nik,' . $id,
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

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        $penduduk->delete();

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus!');
    }
 public function mutasi($id)
{
    $penduduk = DataPenduduk::find($id);

    if (!$penduduk) {
        return redirect()->route('penduduk.index')->with('error', 'Data penduduk tidak ditemukan.');
    }

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
        'alamat_tujuan' => $penduduk->alamat_tujuan ?? 'Belum diisi',
        'jenis_mutasi' => 'Pindah Keluar',
        'keterangan' => 'Data dimutasi otomatis dari tabel penduduk',
        'tanggal_mutasi' => now(),
    ]);

    // Hapus data penduduk dari tabel asli
    $penduduk->delete();

    return redirect()->route('mutasi.index')->with('success', 'Data berhasil dimutasi ke menu Mutasi Penduduk.');
}

}