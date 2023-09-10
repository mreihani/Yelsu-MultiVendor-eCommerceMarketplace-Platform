<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\CartExportController;

// Checkout All Route
Route::get('checkout', [CartController::class, 'checkoutCreate'])->name('checkout');
Route::get('profile/twoStepAuth/phone', [UserController::class, 'getPhoneVerify'])->name('profile.2fa.phone');
Route::post('profile/twoStepAuth/phone', [UserController::class, 'postPhoneVerify']);
Route::get('profile/twoStepAuth/phoneResend', [UserController::class, 'phoneVerifyResend'])->name('profile.2fa.phoneResend');

// Export Checkout
Route::get('checkoutexport', [CartExportController::class, 'checkoutexport'])->name('exportcheckout');
Route::post('orderexport', [CartExportController::class, 'orderexport'])->name('orderexport');