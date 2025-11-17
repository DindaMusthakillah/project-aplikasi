<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\MutasiPenduduk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MutasiPendudukController extends Controller
{
    public function index()
    {
        $mutasi = MutasiPenduduk::all();
        return view('mutasi.index', compact('mutasi'));
    }

    public function createFromPenduduk($id)
    {
        $penduduk = Penduduk::findOrFail($id);
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
        return redirect()->route('mutasi.index')->with('success', 'Data mutasi penduduk berhasil ditambahkan!');
    } 

    public function storeFromPenduduk(Request $request, $id)
    {
        $penduduk = Penduduk::findOrFail($id);

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
            'alamat_asal' => $penduduk->alamat_asal,
            'alamat_tujuan' => $request->alamat_tujuan,
                        'jenis_mutasi' => $request->jenis_mutasi,
            'tanggal_mutasi' => $request->tanggal_mutasi,

        ]);

        // Hapus dari tabel penduduk
        $penduduk->delete();

        return redirect()->route('mutasi.index')->with('success', 'Data penduduk berhasil dimutasi.');
    }
public function edit($id)
{
    $penduduk = MutasiPenduduk::findOrFail($id);
    return view('mutasi.edit', compact('penduduk'));
}
protected $fillable = [
    'no_kk', 'nama_lengkap', 'nik', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama',
    'pendidikan', 'jenis_pekerjaan', 'golongan_darah', 'status_perkawinan',
    'status_hubungan_dalam_keluarga', 'kewarganegaraan', 'nama_ayah', 'nama_ibu',
    'dusun', 'alamat_tujuan', 'jenis_mutasi', 'tanggal_mutasi', 'keterangan'
];

    public function update(Request $request, $id)
    {
        $penduduk = MutasiPenduduk::findOrFail($id);

        $validated = $request->validate([
            'no_kk' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:mutasi_penduduk,nik,' . $id,
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
            'jenis_mutasi' => 'required',
            'tanggal_mutasi' => 'required|date',
        ]);

        $penduduk->update($validated);

        return redirect()->route('mutasi.index')->with('success', 'Data mutasi penduduk berhasil diperbarui!');
    }
public function printAll()
{
    $dataMutasi = MutasiPenduduk::all();
    $pdf = Pdf::loadView('mutasi.print', compact('dataMutasi'));
    return $pdf->download('data_mutasi.pdf');
}
    public function show($id)
{
    // Supaya gak error, cukup redirect ke index aja
    return redirect()->route('mutasi.index');
}
}

