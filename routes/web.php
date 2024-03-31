<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Route::get('/app', [InertiaController::class, 'app'])->name('inertia.app');

Route::get('/', [AdminController::class, 'MailOverview'])->name('admin.mail.overview');

Route::get('/admin/dashboard/mail', [AdminController::class, 'MailOverview'])->name('admin.mail.overview');


