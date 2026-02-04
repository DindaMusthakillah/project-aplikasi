<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPendudukController;
use App\Http\Controllers\MutasiPendudukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::resource('mutasi', MutasiPendudukController::class);

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::resource('penduduk', DataPendudukController::class);

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/print/penduduk', [LaporanController::class, 'printPenduduk'])->name('laporan.print.penduduk');
Route::get('/laporan/print/mutasi', [LaporanController::class, 'printMutasi'])->name('laporan.print.mutasi');
Route::get('/laporan/print/semua', [LaporanController::class, 'printAll'])->name('laporan.print.all');

Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
Route::patch('/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.updateRole');
Route::patch('/users/{user}/approve', [UserManagementController::class, 'updateApproval'])->name('users.updateApproval');
Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');

Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit.index');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/penduduk', [DataPendudukController::class, 'index'])->name('penduduk.index');
    Route::get('/penduduk/create', [DataPendudukController::class, 'create'])->name('penduduk.create');
    Route::post('/penduduk', [DataPendudukController::class, 'store'])->name('penduduk.store');
    Route::get('/penduduk/{penduduk}', [DataPendudukController::class, 'show'])->name('penduduk.show');
    Route::get('/penduduk/{penduduk}/edit', [DataPendudukController::class, 'edit'])->name('penduduk.edit');
    Route::put('/penduduk/{penduduk}', [DataPendudukController::class, 'update'])->name('penduduk.update');
    Route::delete('/penduduk/{penduduk}', [DataPendudukController::class, 'destroy'])->name('penduduk.destroy');

    Route::get('/penduduk/{id}/mutasi', [DataPendudukController::class, 'showMutasiForm'])->name('penduduk.showMutasiForm');
    Route::post('/penduduk/{id}/mutasi', [DataPendudukController::class, 'mutasi'])->name('penduduk.mutasi');

    Route::resource('mutasi', MutasiPendudukController::class);
