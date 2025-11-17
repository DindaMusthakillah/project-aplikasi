<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPenduduk = DataPenduduk::count();
        $jumlahKK = DataPenduduk::distinct('no_kk')->count('no_kk');
        $jumlahLaki = DataPenduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = DataPenduduk::where('jenis_kelamin', 'Perempuan')->count();
        $persenPerempuan = $jumlahPenduduk > 0 ? round(($jumlahPerempuan / $jumlahPenduduk) * 100, 2) : 0;

        return view('dashboard', compact(
            'jumlahPenduduk',
            'jumlahKK',
            'jumlahLaki',
            'jumlahPerempuan',
            'persenPerempuan'
        ));
    }
}
