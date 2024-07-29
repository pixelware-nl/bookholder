<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'index'])->name('index');

Route::get('/admin/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
Route::get('/admin/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::post('/admin/invoice/store', [InvoiceController::class, 'store'])->name('invoice.store');
Route::get('/admin/invoice/show/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::delete('/admin/invoice/delete/{invoice}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');

Route::get('/pdf', [InvoiceController::class, 'generatePDF'])->name('pdf');
