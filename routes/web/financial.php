<?php

use App\Http\Controllers\Backend\Financial\FinancialController;

//Finanical Dashboard
Route::middleware(['auth', 'role:financial'])->group(function () {
    Route::get('dashboard', [FinancialController::class, 'FinancialDashboard'])->name('financial.dashboard');
    Route::get('logout', [FinancialController::class, 'FinancialDestroy'])->name('financial.logout');
    Route::get('profile', [FinancialController::class, 'FinancialProfile'])->name('financial.profile');
    Route::get('settings', [FinancialController::class, 'FinancialProfileSettings'])->name('financial.profileSettings');
    Route::post('profile/store', [FinancialController::class, 'FinancialProfileStore'])->name('financial.profile.store');
    Route::post('update/password', [FinancialController::class, 'FinancialUpdatePassword'])->name('financial.update.password');
});