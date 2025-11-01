<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\FileLoader;
use Illuminate\Support\Arr;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Override translation loader to handle nested JSON
        $this->app->extend('translation.loader', function ($loader, $app) {
            return new class($app['files'], $app['path.lang']) extends FileLoader {
                /**
                 * Load the messages for the given locale and group.
                 */
                public function load($locale, $group, $namespace = null)
                {
                    // For JSON files (* group), flatten nested structure
                    if ($group === '*' && $namespace === '*') {
                        $langPath = $this->path ?? base_path('resources/lang');
                        $path = $langPath . '/' . $locale . '.json';
                        
                        if ($this->files->exists($path)) {
                            $decoded = json_decode($this->files->get($path), true);
                            
                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                // Flatten nested array to dot notation keys
                                return Arr::dot($decoded);
                            }
                        }
                        
                        return [];
                    }
                    
                    // For other translation files, use default behavior
                    return parent::load($locale, $group, $namespace);
                }
            };
        });
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
