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

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

//paypal routes
use App\Http\Controllers\PaypalController;

Route::get('/checkout', [PaypalController::class, 'checkout'])->name('paypal.checkout');
Route::get('/success', [PaypalController::class, 'success'])->name('paypal.success');
Route::get('/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');


Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [PaypalController::class, 'getEmail'])->name('paypal.email');
Route::post('/checkout', [PaypalController::class, 'captureEmail'])->name('paypal.capture.email');
Route::get('/checkout/pay', [PaypalController::class, 'checkout'])->name('paypal.checkout');




