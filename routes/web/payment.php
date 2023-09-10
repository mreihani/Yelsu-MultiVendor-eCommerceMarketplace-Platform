<?php

use App\Http\Controllers\Frontend\PaymentController;

Route::post('payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

Route::middleware(['auth'])->group(function () {
    Route::post('payment', [PaymentController::class, 'payment'])->name('cart.payment');
});