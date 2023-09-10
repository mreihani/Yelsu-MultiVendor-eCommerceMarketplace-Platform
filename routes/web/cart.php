<?php

use App\Http\Controllers\Frontend\CartController;

// Cart All Route
Route::post('cart/add', [CartController::class, 'addToCart']);
Route::get('cart', [CartController::class, 'cart']);
Route::get('minicart', [CartController::class, 'minicart']);
Route::patch('cart/quantity/change', [CartController::class, 'quantityChange']);
Route::delete('cart/delete/{cart}', [CartController::class, 'deleteFromCart'])->name('cart.destroy');
Route::delete('cart/delete/', [CartController::class, 'deleteAllFromCart'])->name('cart.destroyAll');