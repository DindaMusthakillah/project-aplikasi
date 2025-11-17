<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiPenduduk extends Model
{
    use HasFactory;

    protected $table = 'mutasi_penduduk'; // biar gak otomatis pakai "mutasi_penduduks"
    protected $fillable = [
        'no_kk',
        'nama_lengkap',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'jenis_pekerjaan',
        'golongan_darah',
        'status_perkawinan',
        'tanggal_perkawinan',
        'status_hubungan_dalam_keluarga',
        'kewarganegaraan',
        'nama_ayah',
        'nama_ibu',
        'dusun',
        'tanggal_mutasi',
        'alamat_asal',
        'alamat_tujuan',
        'status_mutasi',
        'keterangan',
    ];
}
