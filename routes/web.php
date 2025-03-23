<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
// Product Routes
Route::resource('/products', ProductController::class);

// Cart Routes
Route::resource('/carts', CartController::class);


