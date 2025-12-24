<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\AuthController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\FarmerController;

// Guest (not logged in)
Route::middleware('guest:account')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
});


Route::middleware('otp.pending')->group(function () {
    Route::get('otp', [AuthController::class, 'otpForm'])->name('otp.form');
    Route::any('send-otp', [AuthController::class, 'sendOtp'])->name('otp.send');
    Route::post('otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
});



// Route::get('otp', [AuthController::class, 'otpForm'])->name('otp.form');
// Route::post('otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
// Route::any('send-otp', [AuthController::class, 'sendOtp'])->name('otp.send');

// Route::get('step-form', [AuthController::class, 'stepForm'])->name('stepform');

// Authenticated
Route::middleware(['auth:account', 'account'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::any('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('profile', [ProfileController::class, 'showProfile'])->name('profile');

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
        Route::delete('{farmer}/delete', [FarmerController::class, 'destroy'])->name('destroy');
    });
});
