<?php

use App\Http\Controllers\ProductImportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/import', [ProductImportController::class, 'showImportForm'])->name('import.form');
Route::post('/import', [ProductImportController::class, 'import'])->name('import');
Route::get('/products', [ProductImportController::class, 'showProducts'])->name('products.index');
Route::get('/products/{product}', [ProductImportController::class, 'showProduct'])->name('products.show');
