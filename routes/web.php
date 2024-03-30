<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InertiaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', [InertiaController::class, 'app'])->name('inertia.app');
