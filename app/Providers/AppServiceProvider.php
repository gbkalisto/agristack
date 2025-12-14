<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\AdminSetting;
use Illuminate\Support\Facades\Storage;
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
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            // Super Admin Bypass: User ID 1 + Full Access Permission
            if ($user->id === 1 && $user->hasPermissionTo('FullAccess')) {
                return true;
            }
        });
        // Share site settings with all views
        $settings = AdminSetting::pluck('value', 'key')->toArray();
        View::share('settings', $settings);
    }
}
