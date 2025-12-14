<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', static function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', static function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('invoices', static function () {
    return Inertia::render('invoices/Index');
})->middleware(['auth', 'verified'])->name('invoices.index');

Route::get('clients', static function () {
    return Inertia::render('clients/Index');
})->middleware(['auth', 'verified'])->name('clients.index');

Route::get('calendar', static function () {
    return Inertia::render('calendar/Index');
})->middleware(['auth', 'verified'])->name('calendar.index');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
