<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::middleware('otp.pending')->group(function () {
//     Route::get('otp', [LoginController::class, 'otpForm'])->name('web.otp');
//     Route::any('send-otp', [LoginController::class, 'sendOtp'])->name('otp.send');
//     Route::post('otp', [LoginController::class, 'verifyOtp'])->name('otp.verify');
// });

Route::get('/captcha', [CaptchaController::class, 'generate'])->name('captcha');
Route::get('districtsby/{divisionId}', [DistrictController::class, 'getDistrictsByDivision']);
Route::get('blocksby/{districtId}', [BlockController::class, 'getBlocksByDistrict']);
