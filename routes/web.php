<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Product;

Route::get('/home', function () {
    $products = Product::all();
    return view('home', compact('products'));
    })->name('home');

Route::get('/home/search', [ProductController::class, 'searchUser'])->name('user.products.search');

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
// Product Routes
Route::get('/product/{id}', [ProductController::class, 'showUser'])->name('products.user');

// Authentication Routes
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// ------------------ Public Cart Routes ------------------

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// ------------------ Paypal Checkout Routes ------------------

use App\Http\Controllers\PaypalController;

Route::get('/checkout', [PaypalController::class, 'getEmail'])->name('paypal.email');
Route::post('/checkout', [PaypalController::class, 'captureEmail'])->name('paypal.capture.email');
Route::get('/checkout/pay', [PaypalController::class, 'checkout'])->name('paypal.checkout');
Route::get('/checkout/success', [PaypalController::class, 'success'])->name('paypal.success');
Route::get('/checkout/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');

use App\Http\Middleware\AdminMiddleware;

// Appliquer le middleware directement dans la définition des routes
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

});

