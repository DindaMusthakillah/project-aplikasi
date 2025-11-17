<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPendudukController;
use App\Http\Controllers\MutasiPendudukController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
Route::get('/', function () {
    return view('dashboard');
});


Route::resource('penduduk', PendudukController::class);
Route::resource('mutasi', MutasiPendudukController::class);


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('penduduk', PendudukController::class);
Route::get('/penduduk', [DataPendudukController::class, 'index'])->name('penduduk.index');
Route::get('/penduduk/create', [DataPendudukController::class, 'create'])->name('penduduk.create');
Route::post('/penduduk', [DataPendudukController::class, 'store'])->name('penduduk.store');
Route::get('/penduduk/{penduduk}', [DataPendudukController::class, 'show'])->name('penduduk.show');
Route::get('/penduduk/{penduduk}/edit', [DataPendudukController::class, 'edit'])->name('penduduk.edit');
Route::put('/penduduk/{penduduk}', [DataPendudukController::class, 'update'])->name('penduduk.update');
Route::delete('/penduduk/{penduduk}', [DataPendudukController::class, 'destroy'])->name('penduduk.destroy');

Route::resource('mutasi', MutasiPendudukController::class);
Route::post('/mutasi/{penduduk}', [MutasiPendudukController::class, 'mutate'])->name('mutasi.mutate');
Route::get('/mutasi/create/{id}', [MutasiPendudukController::class, 'createFromPenduduk'])->name('mutasi.createFromPenduduk');
Route::post('/mutasi/from-penduduk/{id}', [MutasiPendudukController::class, 'storeFromPenduduk'])->name('mutasi.storeFromPenduduk');
Route::get('/mutasi/print/{id}', [MutasiPendudukController::class, 'print'])->name('mutasi.print'); 
Route::get('/mutasi/print-all', [MutasiPendudukController::class, 'printAll'])->name('mutasi.printAll');
Route::post('/mutasi', [MutasiPendudukController::class, 'store'])->name('mutasi.store');
Route::get('/mutasi/{mutasi}', [MutasiPendudukController::class, 'show'])->name('mutasi.show');
Route::get('/mutasi/{mutasi}/edit', [MutasiPendudukController::class, 'edit'])->name('mutasi.edit');
Route::put('/mutasi/{mutasi}', [MutasiPendudukController::class, 'update'])->name('mutasi.update'); 
Route::delete('/mutasi/{mutasi}', [MutasiPendudukController::class, 'destroy'])->name('mutasi.destroy');

Route::get('/mutasi', [MutasiPendudukController::class, 'index'])->name('mutasi.index');
Route::get('/mutasi/print', [MutasiPendudukController::class, 'printAll'])->name('mutasi.printAll');
