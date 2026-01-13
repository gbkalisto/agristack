<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\AdminSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // if (Schema::hasTable('admin_settings')) {
        //     $settings = AdminSetting::pluck('value', 'key')->toArray();
        //     View::share('settings', $settings);
        // }
        try {
            if (Schema::hasTable('admin_settings')) {
                $settings = AdminSetting::pluck('value', 'key')->toArray();
                View::share('settings', $settings);
            }
        } catch (\Exception $e) {
            // Ignore DB errors during first load / migration
        }
        Gate::define('create-farmer', function ($admin) {
            return $admin->role === 'block_admin';
        });
        // Authorization Gate
        Gate::define('manage-farmer', function ($admin, User $farmer) {

            return
                // ✅ role must be block_admin
                $admin->role === 'block_admin'

                // ✅ farmer must be created by admin
                && $farmer->filled_by === 'admin_user'

                // ✅ admin must be the creator
                && $farmer->filled_by_admin_user_id === $admin->id;
        });
    }
}
