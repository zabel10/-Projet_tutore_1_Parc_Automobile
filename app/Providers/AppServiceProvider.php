<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Utilisateur;

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
        Gate::define('view-conducteur-dashboard', function (Utilisateur $user) {
            return $user->role === 'conducteur';
        });

        Gate::define('manage-conducteur-space', function (Utilisateur $user) {
            return in_array($user->role, ['admin', 'gestionnaire', 'conducteur'], true);
        });
    }
}
