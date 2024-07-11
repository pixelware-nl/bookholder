<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

Route::get('/', [WebsiteController::class, 'index'])->name('index');

Route::get('/pdf', [InvoiceController::class, 'generatePDF'])->name('pdf');
