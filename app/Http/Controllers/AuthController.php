<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (!auth()->user()->approved) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun menunggu persetujuan admin.',
                ])->withInput();
            }
            // kalau berhasil login, redirect ke dashboard
            return redirect()->route('dashboard');
        }

        // kalau gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // validasi
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // simpan user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'pegawai',
            'approved' => false,
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login');
    }
}
