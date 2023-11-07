<?php

use App\Http\Controllers\Backend\Representative\RepresentativeController;

Route::get('dashboard', [RepresentativeController::class, 'RepresentativeDashboard'])->name('representative.dashboard');
Route::get('logout', [RepresentativeController::class, 'RepresentativeDestroy'])->name('representative.logout');

Route::get('profile', [RepresentativeController::class, 'RepresentativeProfile'])->name('representative.profile');
Route::get('settings', [RepresentativeController::class, 'RepresentativeProfileSettings'])->name('representative.profileSettings');
Route::post('profile/store', [RepresentativeController::class, 'RepresentativeProfileStore'])->name('representative.profile.store');
Route::post('update/password', [RepresentativeController::class, 'RepresentativeUpdatePassword'])->name('representative.update.password');

//fincancial statement section
Route::get('financialStatement', [RepresentativeController::class, 'RepresentativeProfileFinancialStatement'])->name('representative.profileFinancialStatement');
Route::post('financialStatement/store', [RepresentativeController::class, 'RepresentativeProfileFinancialStatementStore'])->name('representative.profileFinancialStatement.store');

// Representative Add Product All Route
Route::controller(RepresentativeController::class)->group(function () {
    Route::get('all/product', 'RepresentativeAllProduct')->name('representative.all.product');
    Route::get('edit/product/{id}', 'RepresentativeEditProduct')->name('representative.edit.product');
    Route::post('update/product', 'RepresentativeUpdateProduct')->name('representative.update.product');
});

//Representative Order All Route
Route::get('orders', [RepresentativeController::class, 'ViewRepresentativeOrders'])->name('representative.orders');
Route::post('orders/destroy/{id}', [RepresentativeController::class, 'DestroyRepresentativeOrder'])->name('representative.orders.destroy');
Route::get('orders/view/{id}', [RepresentativeController::class, 'ViewRepresentativeOrderItem'])->name('representative.orders.view');
Route::post('order/changeStatus/{id}', [RepresentativeController::class, 'ChangeRepresentativeOrderStatus'])->name('representative.order.changeStatus');