<?php

namespace App\Providers;

use App\Models\DataPenduduk;
use App\Models\MutasiPenduduk;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.navbar', function ($view) {
            $today = Carbon::today();

            $pendudukCount = DataPenduduk::whereDate('created_at', $today)->count();
            $mutasiCount = MutasiPenduduk::whereDate('created_at', $today)->count();
            $pendingUsers = 0;
            if (auth()->check() && auth()->user()->role === 'admin') {
                $pendingUsers = \App\Models\User::where('approved', false)->count();
            }

            $notifications = [];
            if ($pendudukCount > 0) {
                $notifications[] = [
                    'icon' => 'fa-users',
                    'text' => $pendudukCount . ' penduduk baru hari ini',
                    'time' => $today->format('d M Y'),
                    'link' => route('penduduk.index'),
                ];
            }
            if ($mutasiCount > 0) {
                $notifications[] = [
                    'icon' => 'fa-exchange-alt',
                    'text' => $mutasiCount . ' mutasi baru hari ini',
                    'time' => $today->format('d M Y'),
                    'link' => route('mutasi.index'),
                ];
            }
            if ($pendingUsers > 0) {
                $notifications[] = [
                    'icon' => 'fa-user-clock',
                    'text' => $pendingUsers . ' user menunggu persetujuan',
                    'time' => $today->format('d M Y'),
                    'link' => route('users.index'),
                ];
            }

            $view->with([
                'notifCount' => $pendudukCount + $mutasiCount + $pendingUsers,
                'notifications' => $notifications,
            ]);
        });
    }
}
