<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use App\Models\MutasiPenduduk;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPenduduk = DataPenduduk::count();
        $jumlahKK = DataPenduduk::distinct('no_kk')->count('no_kk');
        $jumlahLaki = DataPenduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = DataPenduduk::where('jenis_kelamin', 'Perempuan')->count();
        $persenPerempuan = $jumlahPenduduk > 0 ? round(($jumlahPerempuan / $jumlahPenduduk) * 100, 2) : 0;

        // Data Mutasi
        $mutasiPindahKeluar = MutasiPenduduk::where('status_mutasi', 'Pindah Keluar')->count();
        $mutasiPindahMasuk = MutasiPenduduk::where('status_mutasi', 'Pindah Masuk')->count();
        $mutasiMeninggal = MutasiPenduduk::where('status_mutasi', 'Meninggal')->count();
        $mutasiLahir = MutasiPenduduk::where('status_mutasi', 'Lahir')->count();

        $today = Carbon::today();
        $pendudukHariIni = DataPenduduk::whereDate('created_at', $today)->count();
        $mutasiHariIni = MutasiPenduduk::whereDate('created_at', $today)->count();

        return view('dashboard', compact(
            'jumlahPenduduk',
            'jumlahKK',
            'jumlahLaki',
            'jumlahPerempuan',
            'persenPerempuan',
            'mutasiPindahKeluar',
            'mutasiPindahMasuk',
            'mutasiMeninggal',
            'mutasiLahir',
            'pendudukHariIni',
            'mutasiHariIni'
        ));
    }

    public function dashboard()
    {
        return $this->index();
    }
}
