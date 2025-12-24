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

    //  Route::prefix('farmers')->name('farmers.')->group(function () {
    //     // LIST
    //     Route::get('/', [FarmerController::class, 'index'])
    //         ->name('index');
    //  });
    // Farmer Routes
    Route::prefix('farmers')->name('farmers.')->group(function () {
        // LIST
        Route::get('/', [FarmerController::class, 'index'])
            ->name('index');
        // STEP 1
        Route::get('create', [FarmerController::class, 'create'])
            ->name('create');
        Route::post('store/basic', [FarmerController::class, 'storeBasic'])
            ->name('store.basic');
        // STEP 2
        Route::get('create/land', [FarmerController::class, 'createLand'])
            ->name('create.land');
        Route::post('store/land', [FarmerController::class, 'storeLand'])
            ->name('store.land');

        // STEP 3
        Route::get('create/crop', [FarmerController::class, 'createCrop'])
            ->name('create.crop');
        Route::post('store/crop', [FarmerController::class, 'storeCrop'])
            ->name('store.crop');

        // STEP 4
        Route::get('create/bank', [FarmerController::class, 'createBank'])
            ->name('create.bank');
        Route::post('store/bank', [FarmerController::class, 'storeBank'])
            ->name('store.bank');

        // STEP 5
        Route::get('create/documents', [FarmerController::class, 'createDocuments'])
            ->name('create.documents');
        Route::post('store/documents', [FarmerController::class, 'storeDocuments'])
            ->name('store.documents');

        // STEP 6 - Residential
        Route::get('create/residential', [FarmerController::class, 'createResidential'])
            ->name('create.residential');
        Route::post('store/residential', [FarmerController::class, 'storeResidential'])
            ->name('store.residential');



        /* ========= EDIT ========= */
        Route::get('{farmer}/edit/basic', [FarmerController::class, 'editBasic'])->name('edit.basic');
        Route::put('{farmer}/update/basic', [FarmerController::class, 'updateBasic'])->name('update.basic');

        Route::get('{farmer}/edit/land', [FarmerController::class, 'editLand'])->name('edit.land');
        Route::put('{farmer}/update/land', [FarmerController::class, 'updateLand'])->name('update.land');

        Route::get('{farmer}/edit/crop', [FarmerController::class, 'editCrop'])->name('edit.crop');
        Route::put('{farmer}/update/crop', [FarmerController::class, 'updateCrop'])->name('update.crop');

        Route::get('{farmer}/edit/bank', [FarmerController::class, 'editBank'])->name('edit.bank');
        Route::put('{farmer}/update/bank', [FarmerController::class, 'updateBank'])->name('update.bank');

        Route::get('{farmer}/edit/documents', [FarmerController::class, 'editDocuments'])->name('edit.documents');
        Route::put('{farmer}/update/documents', [FarmerController::class, 'updateDocuments'])->name('update.documents');

        Route::get('{farmer}/edit/residential', [FarmerController::class, 'editResidential'])->name('edit.residential');
        Route::put('{farmer}/update/residential', [FarmerController::class, 'updateResidential'])->name('update.residential');

        Route::delete('{farmer}', [FarmerController::class, 'destroy'])->name('destroy');
    });
});
