<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\UserShippingController;

Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
Route::get('/orderview/{id}', [UserController::class, 'OrderView'])->name('orderview');
Route::post('/orderview/change-address', [UserController::class, 'OrderViewChangeAddress'])->name('orderview.changeAddress');
Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
Route::post('/user/profile/storePassword', [UserController::class, 'UserProfileStorePassword'])->name('user.profile.storePassword');
Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

// dashboard address all routes
Route::get('/dashboard/address/add', [UserController::class, 'DashboardAddressAdd'])->name('dashboard.address.add');
Route::post('/dashboard/address/store', [UserController::class, 'DashboardAddressStore'])->name('dashboard.address.store');
Route::get('/dashboard/address/edit/{id}', [UserController::class, 'DashboardAddressEdit'])->name('dashboard.address.edit');
Route::post('/dashboard/address/update', [UserController::class, 'DashboardAddressUpdate'])->name('dashboard.address.update');
Route::get('/dashboard/address/delete/{id}', [UserController::class, 'DashboardAddressDelete'])->name('dashboard.address.delete');

// dashboard shipping all routes
Route::get('/shipping-product/{id}', [UserShippingController::class, 'ShippingProduct'])->name('shipping-product');
Route::get('/shipping-details/{orderId}/{productId}', [UserShippingController::class, 'ShippingDetails'])->name('shipping-details');
Route::get('/get-users-address-shipping', [UserShippingController::class, 'GetAddressAjax']);
Route::get('/get-freightage-information', [UserShippingController::class, 'GetFreightageInformationAjax']);
Route::get('/get-freightage-loader-type', [UserShippingController::class, 'GetFreightageLoaderTypeAjax']);

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');