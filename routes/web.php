<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

include_once __DIR__ . '/auth.php';

Route::get('/', function () {
    return redirect()->route('invoices.index');
})->name('index');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('invoices', InvoiceController::class);
        Route::resource('companies', CompanyController::class)->only(['index', 'store', 'create', 'destroy']);

        Route::prefix('companies')->group(function () {
            Route::get('find', [CompanyController::class, 'find'])->name('companies.find');
            Route::post('find', [CompanyController::class, 'found'])->name('companies.found');
        });

    });
});
