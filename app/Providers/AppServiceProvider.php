<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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

        if (auth()->check()) {
            $user = auth()->user();
            $roles = $user->roles()->pluck('role_name')->toArray() ?? [];
        }

        Inertia::share([
            'flash' => function () {
                return [
                    'success' => Session::get('success'),
                    'error' => Session::get('error'),
                    'warning' => Session::get('warning'),
                ];
            },
            'auth' => function () {
                // Gunakan auth()->check() HANYA SEKALI, di sini.
                if (auth()->check()) {
                    $user = auth()->user();

                    // Perhatikan: Gunakan relasi roles yang sudah dimuat (jika ada)
                    // Jika Anda menggunakan Spatie, pastikan relasi 'roles' sudah ada di model User
                    $roles = $user->roles->pluck('role_name')->toArray() ?? [];

                    return [
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            // data user lainnya
                            'roles' => $roles, // Data roles kini berada di sini
                        ],
                        'isAuthenticated' => true,
                    ];
                }

                // Jika tidak terotentikasi
                return [
                    'user' => null,
                    'isAuthenticated' => false,
                ];
            },
        ]);
    }
}
