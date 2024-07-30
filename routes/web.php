<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'index'])->name('index');


Route::controller(InvoiceController::class)->group(function () {
    Route::get('/admin/invoice', 'index')->name('invoice.index');
    Route::get('/admin/invoice/create', 'create')->name('invoice.create');
    Route::post('/admin/invoice/store', 'store')->name('invoice.store');
    Route::get('/admin/invoice/show/{invoice}', 'show')->name('invoice.show');
    Route::delete('/admin/invoice/delete/{invoice}', 'destroy')->name('invoice.destroy');
});

Route::controller(CompanyController::class)->group(function () {
    Route::get('/admin/company', 'index')->name('company.index');
});


Route::get('/pdf', [InvoiceController::class, 'generatePDF'])->name('pdf');
