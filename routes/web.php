<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/product/{name}', [HomeController::class, 'product_details'])->name('product_details');
Route::post('/stripePayment', [HomeController::class, 'PaymentDetails'])->name('stripePayment');
