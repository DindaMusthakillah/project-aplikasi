<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use App\Models\MutasiPenduduk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dusun = $request->query('dusun');
        $status = $request->query('status');
        $tanggal = $request->query('tanggal');

        $pendudukQuery = DataPenduduk::query();
        if ($dusun) {
            $pendudukQuery->where('dusun', $dusun);
        }
        $penduduk = $pendudukQuery->get();

        $mutasiQuery = MutasiPenduduk::query();
        if ($status) {
            $mutasiQuery->where('status_mutasi', $status);
        }
        if ($tanggal) {
            $mutasiQuery->whereDate('tanggal_mutasi', $tanggal);
        }
        $mutasi = $mutasiQuery->get();

        return view('laporan.index', compact('penduduk', 'mutasi', 'dusun', 'status', 'tanggal'));
    }

    public function printPenduduk(Request $request)
    {
        $dusun = $request->query('dusun');
        $pendudukQuery = DataPenduduk::query();
        if ($dusun) {
            $pendudukQuery->where('dusun', $dusun);
        }
        $penduduk = $pendudukQuery->get();
        $pdf = Pdf::loadView('laporan.print_penduduk', compact('penduduk', 'dusun'));

        return $pdf->download('laporan_data_penduduk.pdf');
    }

    public function printMutasi(Request $request)
    {
        $status = $request->query('status');
        $tanggal = $request->query('tanggal');
        $mutasiQuery = MutasiPenduduk::query();
        if ($status) {
            $mutasiQuery->where('status_mutasi', $status);
        }
        if ($tanggal) {
            $mutasiQuery->whereDate('tanggal_mutasi', $tanggal);
        }
        $mutasi = $mutasiQuery->get();
        $pdf = Pdf::loadView('laporan.print_mutasi', compact('mutasi', 'status', 'tanggal'));

        return $pdf->download('laporan_data_mutasi.pdf');
    }

    public function printAll(Request $request)
    {
        $dusun = $request->query('dusun');
        $status = $request->query('status');
        $tanggal = $request->query('tanggal');

        $pendudukQuery = DataPenduduk::query();
        if ($dusun) {
            $pendudukQuery->where('dusun', $dusun);
        }
        $penduduk = $pendudukQuery->get();

        $mutasiQuery = MutasiPenduduk::query();
        if ($status) {
            $mutasiQuery->where('status_mutasi', $status);
        }
        if ($tanggal) {
            $mutasiQuery->whereDate('tanggal_mutasi', $tanggal);
        }
        $mutasi = $mutasiQuery->get();
        $pdf = Pdf::loadView('laporan.print_all', compact('penduduk', 'mutasi', 'dusun', 'status', 'tanggal'));

        return $pdf->download('laporan_semua_data.pdf');
    }
}
