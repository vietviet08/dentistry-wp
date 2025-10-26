<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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
        $this->configureGates();
    }

    /**
     * Configure authorization gates.
     */
    protected function configureGates(): void
    {
        Gate::define('access-admin-panel', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-users', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-content', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('view-analytics', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-appointments', function ($user) {
            return $user->role === 'admin';
        });

        // Register policies
        Gate::policy(\App\Models\Appointment::class, \App\Policies\AppointmentPolicy::class);
    }
}
