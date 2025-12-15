<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\OtpController;

Route::get('/', [PromoController::class, 'homepage'])->name('homepage');
Route::get('/promo', [PromoController::class, 'promo'])->name('promo');
Route::post('/select-product', [PromoController::class, 'selectProduct'])->name('select-product');
Route::get('/form', [PromoController::class, 'showForm'])->name('form');
Route::post('/submit-voucher', [PromoController::class, 'submitVoucher'])->name('submit-voucher');
Route::get('/success/{code}', [PromoController::class, 'success'])->name('success');

// OTP routes
Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send-otp');
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('verify-otp');