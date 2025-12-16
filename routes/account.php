<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\AuthController;
use App\Http\Controllers\Account\DashboardController;

// Guest (not logged in)
Route::middleware('guest:account')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
});

Route::get('otp', [AuthController::class, 'otpForm'])
    ->name('account.otp.form');

Route::post('otp', [AuthController::class, 'verifyOtp'])
    ->name('account.otp.verify');
// Authenticated
Route::middleware('auth:account')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
