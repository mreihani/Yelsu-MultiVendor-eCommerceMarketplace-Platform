<?php

use App\Http\Controllers\Auth\AuthTokenController;

// SMS verification for login
Route::get('/auth/token', [AuthTokenController::class, 'getToken'])->name('2fa.token');
Route::post('/auth/token-send', [AuthTokenController::class, 'postToken'])->name('2fa.token.send');
Route::get('/auth/token/phoneResend', [AuthTokenController::class, 'phoneVerifyResend'])->name('2fa.token.phoneResend');