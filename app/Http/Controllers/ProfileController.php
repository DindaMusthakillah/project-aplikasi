<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    private function ensureAuth()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return null;
    }

    public function edit()
    {
        $guard = $this->ensureAuth();
        if ($guard) {
            return $guard;
        }

        return view('profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $guard = $this->ensureAuth();
        if ($guard) {
            return $guard;
        }

        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $guard = $this->ensureAuth();
        if ($guard) {
            return $guard;
        }

        $user = auth()->user();

        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai.',
            ]);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Password berhasil diperbarui.');
    }
}
