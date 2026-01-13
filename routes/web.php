<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegistryController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\OtpController;



// Route::get('/', function () {
//     return view('index');
// })->name('index');
Route::get('/', [LoginController::class, 'loginAsOfficial'])->name('loginas.official');
Route::get('/login/as/farmer', [LoginController::class, 'loginAsFarmer'])->name('loginas.farmer');
Route::get('/farmer/otp', [LoginController::class, 'otpForm'])->name('farmer.otp.form');
Route::post('/farmer/otp', [LoginController::class, 'verifyOtp'])->name('farmer.otp.verify');
// Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/registration', [RegistrationController::class, 'index'])->name('register');
Route::post('/registration', [RegistrationController::class, 'register'])->name('registration');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/send-otp', [OtpController::class, 'sendOtp']);



Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/farmer/details/{uuid}', [RegistryController::class, 'showDetails'])->name('farmer.details');
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

Route::get('/captcha', [CaptchaController::class, 'generate'])->name('captcha');
Route::get('districtsby/{divisionId}', [DistrictController::class, 'getDistrictsByDivision']);
Route::get('blocksby/{districtId}', [BlockController::class, 'getBlocksByDistrict']);
