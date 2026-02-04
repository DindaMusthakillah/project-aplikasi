<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
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

    public function index(Request $request)
    {
        $guard = $this->ensureAdmin();
        if ($guard) {
            return $guard;
        }

        $status = $request->query('status');

        $usersQuery = User::query();
        if ($status === 'approved') {
            $usersQuery->where('approved', true);
        } elseif ($status === 'pending') {
            $usersQuery->where('approved', false);
        }

        $users = $usersQuery->orderBy('created_at', 'desc')->get();

        return view('users.index', compact('users', 'status'));
    }

    public function updateRole(Request $request, User $user)
    {
        $guard = $this->ensureAdmin();
        if ($guard) {
            return $guard;
        }

        $validated = $request->validate([
            'role' => 'required|in:admin,pegawai',
        ]);

        $user->role = $validated['role'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'Role user berhasil diperbarui.');
    }

    public function updateApproval(Request $request, User $user)
    {
        $guard = $this->ensureAdmin();
        if ($guard) {
            return $guard;
        }

        $validated = $request->validate([
            'approved' => 'required|boolean',
        ]);

        if (auth()->id() === $user->id && !$validated['approved']) {
            return redirect()->route('users.index')->with('error', 'Admin tidak bisa menonaktifkan akun sendiri.');
        }

        $user->approved = (bool) $validated['approved'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'Status user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $guard = $this->ensureAdmin();
        if ($guard) {
            return $guard;
        }

        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Admin tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
