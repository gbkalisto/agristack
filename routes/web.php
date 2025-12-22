<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\BlockController;


Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/captcha', [CaptchaController::class, 'generate'])->name('captcha');
Route::get('districtsby/{divisionId}',[DistrictController::class, 'getDistrictsByDivision']);
Route::get( 'blocksby/{districtId}',[BlockController::class, 'getBlocksByDistrict']);
