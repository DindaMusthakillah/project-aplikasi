<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Models\MutasiPenduduk;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduk = Penduduk::all();
        return view('penduduk.index', compact('penduduk'));
    }

    public function create()
    {
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:penduduk',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'pendidikan' => 'required',
            'jenis_pekerjaan' => 'required',
            'golongan_darah' => 'required',
            'status_perkawinan' => 'required',
            'tanggal perkawinan' => 'required',
            'status_hubungan_dalam_keluarga' => 'required',
            'kewarganegaraan' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required'
        ]);
        Penduduk::create($validated);
        return redirect()->route('penduduk.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show(Penduduk $penduduk)
    {
        return view('penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $request->validate([
            'no_kk' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:penduduk',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'pendidikan' => 'required',
            'jenis_pekerjaan' => 'required',
            'golongan_darah' => 'required',
            'status_perkawinan' => 'required',
            'tanggal perkawinan' => 'required',
            'status_hubungan_dalam_keluarga' => 'required',
            'kewarganegaraan' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required' . $penduduk->id,
        ]);

        $penduduk->update($request->all());
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus');
    }
    public function mutasi($id)
    {
        $penduduk = Penduduk::findOrFail($id);

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
            'tanggal_mutasi' => now(),
            'alamat_asal' => $penduduk->alamat ?? '-',
            'alamat_tujuan' => 'Belum ditentukan',
            'status_mutasi' => 'Pindah',
            'keterangan' => 'Pindah ke lokasi lain',

        ]);

        $penduduk->delete();

        return redirect()->route('mutasi.index')->with('success', 'Data berhasil dimutasi.');
    }
}
