<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\TwoFactorController;
use App\Http\Controllers\Admin\Auth\TwoFactorVerifyController;
use App\Http\Controllers\Admin\CollegeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\FarmerController;
use App\Models\Block;

// Public (admin) routes
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');

// Protected (admin) routes
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::any('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::post('/profile/{id}', [ProfileController::class, 'updateProfile'])->name('profile.update');

    // 2FA
    Route::get('/2fa/setup', [TwoFactorController::class, 'showSetupForm'])->name('2fa.setup');
    Route::post('/2fa/setup', [TwoFactorController::class, 'storeSetup'])->name('2fa.setup.store');

    Route::get('/2fa/verify', [TwoFactorVerifyController::class, 'showVerifyForm'])->name('2fa.verify');
    Route::post('/2fa/verify', [TwoFactorVerifyController::class, 'verify'])->name('2fa.verify.store');

    Route::get('/2fa/enable', [TwoFactorController::class, 'showSetupForm'])->name('2fa.enable');
    Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');

    // college routes
    Route::resource('colleges', CollegeController::class)->names('colleges');

    // admin user management
    Route::resource('admins', UserController::class)->names('admins');
    Route::resource('divisions', DivisionController::class)->names('divisions');
    Route::resource('districts', DistrictController::class)->names('districts');
    Route::resource('blocks', BlockController::class)->names('blocks');

    Route::post('divisions/import', [DivisionController::class, 'import'])->name('divisions.import');
    Route::post('districts/import', [DistrictController::class, 'import'])->name('districts.import');
    Route::post('blocks/import', [BlockController::class, 'import'])->name('blocks.import');
    // Move closure → controller method
    Route::get(
        'blocksby/{districtId}',
        [BlockController::class, 'getBlocksByDistrict']
    )->name('blocks.byDistrict');

    // Move closure → controller method
    Route::get(
        'districtsby/{divisionId}',
        [DistrictController::class, 'getDistrictsByDivision']
    )->name('districts.byDivision');

    Route::resource('accounts', AdminAccountController::class)->names('accounts');
    // roles & permissions
    Route::resource('roles', RoleController::class)->names('roles');
    Route::resource('permissions', PermissionController::class)->names('permissions');

    //settings route
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

     Route::prefix('farmers')->name('farmers.')->group(function () {
        // LIST
        Route::get('/', [FarmerController::class, 'index'])
            ->name('index');
     });
});
