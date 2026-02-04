<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class AuditLogController extends Controller
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

        $query = AuditLog::query();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        if ($request->filled('target_type')) {
            $query->where('target_type', $request->target_type);
        }

        $logs = $query->orderBy('created_at', 'desc')->limit(200)->get();
        $users = User::orderBy('name')->get();

        return view('audit.index', compact('logs', 'users'));
    }
}
