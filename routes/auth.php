<?php

use \App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('register', [RegisterController::class, 'create'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::get('forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'update'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});
