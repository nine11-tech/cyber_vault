<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Product Routes
Route::resource('/products', ProductController::class);

// Cart Routes
Route::resource('/carts', CartController::class);
