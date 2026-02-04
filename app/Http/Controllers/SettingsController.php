<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    private function ensureAdmin()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Hanya admin yang bisa mengakses halaman ini.');
        }

        return null;
    }

    public function index()
    {
        $guard = $this->ensureAdmin();
        if ($guard) {
            return $guard;
        }

        $settings = Setting::whereIn('key', [
            'kabupaten',
            'kecamatan',
            'desa',
            'alamat',
        ])->pluck('value', 'key');

        return view('settings.index', [
            'settings' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $guard = $this->ensureAdmin();
        if ($guard) {
            return $guard;
        }

        $validated = $request->validate([
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $this->logActivity('update', 'settings', null, 'Memperbarui pengaturan sistem');

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
