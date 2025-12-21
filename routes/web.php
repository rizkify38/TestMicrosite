<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;

// Admin Routes
Route::redirect('/admin', '/admin/login');
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });
});

Route::get('/', [PromoController::class, 'homepage'])->name('homepage');
Route::get('/promo', [PromoController::class, 'promo'])->name('promo');
Route::post('/select-product', [PromoController::class, 'selectProduct'])->name('select-product');
Route::get('/form', [PromoController::class, 'showForm'])->name('form');
Route::post('/submit-voucher', [PromoController::class, 'submitVoucher'])->name('submit-voucher');
Route::get('/success/{code}', [PromoController::class, 'success'])->name('success');

// OTP routes
Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send-otp');
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('verify-otp');