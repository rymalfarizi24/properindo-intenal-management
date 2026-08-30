<?php

namespace App\Providers;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
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
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        Model::preventLazyLoading();

        Gate::define('admin', function (Employee $employee) {
            return $employee->role === 'admin';
        });

        Gate::define('supervisor', function (Employee $employee) {
            return in_array($employee->role, ['admin', 'supervisor']);
        });
    }
}
