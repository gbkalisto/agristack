<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegistryController;



Route::get('/', function () {
    return view('index');
})->name('index');

// Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/registry', [RegistryController::class, 'index'])->name('registry.index');
    Route::get('/registry/step/{step}', [RegistryController::class, 'step'])->name('registry.step');
    Route::post('/registry/step/{step}', [RegistryController::class, 'store'])->name('registry.store');

    Route::post('/registry/basics', [RegistryController::class, 'basicDetail'])->name('basic.store');
    Route::post('/registry/residential', [RegistryController::class, 'residentialDetail'])->name('residential.store');
    Route::post('/registry/land', [RegistryController::class, 'landDetail'])->name('land.store');
    Route::post('/registry/crop', [RegistryController::class, 'cropDetail'])->name('crop.store');
    Route::post('/registry/bank', [RegistryController::class, 'bankDetail'])->name('bank.store');
    Route::post('/registry/documents', [RegistryController::class, 'documentsDetail'])->name('documents.store');
});

// Route::middleware('otp.pending')->group(function () {
//     Route::get('otp', [LoginController::class, 'otpForm'])->name('web.otp');
//     Route::any('send-otp', [LoginController::class, 'sendOtp'])->name('otp.send');
//     Route::post('otp', [LoginController::class, 'verifyOtp'])->name('otp.verify');
// });
Route::get('/captcha', [CaptchaController::class, 'generate'])->name('captcha');
Route::get('districtsby/{divisionId}', [DistrictController::class, 'getDistrictsByDivision']);
Route::get('blocksby/{districtId}', [BlockController::class, 'getBlocksByDistrict']);
