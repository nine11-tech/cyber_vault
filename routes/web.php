<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Product Routes
Route::resource('/products', ProductController::class);

// Cart Routes
Route::resource('/carts', CartController::class);

// Authentication Routes
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');