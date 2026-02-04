<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use App\Models\MutasiPenduduk;
use App\Models\Setting;
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

    private function ensureAdmin()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('laporan.index')->with('error', 'Hanya admin yang bisa mencetak laporan.');
        }
        return null;
    }

    private function getKopSettings(): array
    {
        $settings = Setting::whereIn('key', ['kabupaten', 'kecamatan', 'desa', 'alamat'])
            ->pluck('value', 'key');

        return [
            'kabupaten' => $settings['kabupaten'] ?? 'PEMERINTAH KABUPATEN',
            'kecamatan' => $settings['kecamatan'] ?? 'KECAMATAN ................',
            'desa' => $settings['desa'] ?? 'DESA ................',
            'alamat' => $settings['alamat'] ?? 'Alamat: ..................................................',
        ];
    }

    public function printPenduduk(Request $request)
    {
        $guard = $this->ensureAdmin();
        if ($guard) {
            return $guard;
        }

        $dusun = $request->query('dusun');
        $pendudukQuery = DataPenduduk::query();
        if ($dusun) {
            $pendudukQuery->where('dusun', $dusun);
        }
        $penduduk = $pendudukQuery->get();
        $kop = $this->getKopSettings();
        $pdf = Pdf::loadView('laporan.print_penduduk', compact('penduduk', 'dusun', 'kop'));

        return $pdf->download('laporan_data_penduduk.pdf');
    }

    public function printMutasi(Request $request)
    {
        $guard = $this->ensureAdmin();
        if ($guard) {
            return $guard;
        }

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
        $kop = $this->getKopSettings();
        $pdf = Pdf::loadView('laporan.print_mutasi', compact('mutasi', 'status', 'tanggal', 'kop'));

        return $pdf->download('laporan_data_mutasi.pdf');
    }

    public function printAll(Request $request)
    {
        $guard = $this->ensureAdmin();
        if ($guard) {
            return $guard;
        }

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
        $kop = $this->getKopSettings();
        $pdf = Pdf::loadView('laporan.print_all', compact('penduduk', 'mutasi', 'dusun', 'status', 'tanggal', 'kop'));

        return $pdf->download('laporan_semua_data.pdf');
    }
}
