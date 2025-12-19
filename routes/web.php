<?php

use Illuminate\Support\Facades\Route;


Route::prefix('user')->name('user.')->group(function(){

    Route::get('/register', [App\Http\Controllers\User\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\User\AuthController::class, 'register'])->name('register.submit');

    Route::get('/email/verify', [App\Http\Controllers\User\AuthController::class, 'showVerificationNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\User\AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
    Route::get('/email/verification-notification', [App\Http\Controllers\User\AuthController::class, 'sendEmailVerification'])->name('verification.email');

    Route::get('/login', [App\Http\Controllers\User\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\User\AuthController::class, 'login'])->name('login.submit');

    // Route::get('forgot-password', [App\Http\Controllers\User\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

    Route::middleware(['auth:user' , 'verified'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\User\AuthController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [App\Http\Controllers\User\AuthController::class, 'logout'])->name('logout');
    });
});


Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\AuthController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    });
});