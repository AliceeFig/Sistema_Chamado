<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
    public function boot()
    {
        Gate::define('is-admin', function ($user) {
            return $user->hasRole('admin'); // Certifique-se de que `hasRole` funciona
        });

        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
