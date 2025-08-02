<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

// Products page (display products)
Route::get('/', [CartController::class, 'index'])->name('products.index');

// Cart routes
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');

// POST routes for cart modifications
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout route (bonus feature)
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
