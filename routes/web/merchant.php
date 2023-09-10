<?php

use App\Http\Controllers\Backend\Merchant\MerchantController;

//Merchant Dashboard

Route::get('dashboard', [MerchantController::class, 'MerchantDashboard'])->name('merchant.dashboard');
Route::get('logout', [MerchantController::class, 'MerchantDestroy'])->name('merchant.logout');

Route::get('profile', [MerchantController::class, 'MerchantProfile'])->name('merchant.profile');
Route::get('settings', [MerchantController::class, 'MerchantProfileSettings'])->name('merchant.profileSettings');
Route::post('profile/store', [MerchantController::class, 'MerchantProfileStore'])->name('merchant.profile.store');

//fincancial statement section
Route::get('financialStatement', [MerchantController::class, 'MerchantProfileFinancialStatement'])->name('merchant.profileFinancialStatement');
Route::post('financialStatement/store', [MerchantController::class, 'MerchantProfileFinancialStatementStore'])->name('merchant.profileFinancialStatement.store');

Route::middleware('merchantaccess')->group(function () {
    //Merchant Add Product All Route
    Route::controller(MerchantController::class)->group(function () {
        Route::get('all/product', 'MerchantAllProduct')->name('merchant.all.product');
        Route::get('add/product', 'MerchantAddProduct')->name('merchant.add.product');
        Route::post('store/product', 'MerchantStoreProduct')->name('merchant.store.product');
        Route::get('edit/product/{id}', 'MerchantEditProduct')->name('merchant.edit.product');
        Route::post('update/product', 'MerchantUpdateProduct')->name('merchant.update.product');
        Route::get('delete/product/{id}', 'MerchantDeleteProduct')->name('merchant.delete.product');
        Route::get('copy/product/{id}', 'MerchantCopyProduct')->name('merchant.copy.product');
        Route::post('storeCopy/product', 'MerchantStoreCopyProduct')->name('merchant.storeCopy.product');
    });

    //Merchant Order All Route
    Route::get('orders', [MerchantController::class, 'ViewMerchantOrders'])->name('merchant.orders');
    Route::post('orders/destroy/{id}', [MerchantController::class, 'DestroyMerchantOrder'])->name('merchant.orders.destroy');
    Route::get('orders/view/{id}', [MerchantController::class, 'ViewMerchantOrderItem'])->name('merchant.orders.view');
    Route::post('order/changeStatus/{id}', [MerchantController::class, 'ChangeMerchantOrderStatus'])->name('merchant.order.changeStatus');

    //Merchant MapAddress All Route
    Route::get('all/outlet', [MerchantController::class, 'MerchantAllOutlet'])->name('merchant.all.outlet');
    Route::get('create/outlet', [MerchantController::class, 'MerchantCreateOutlet'])->name('merchant.create.outlet');
    Route::post('store/outlet', [MerchantController::class, 'MerchantStoreOutlet'])->name('merchant.store.outlet');
    Route::get('edit/outlet/{id}', [MerchantController::class, 'MerchantEditOutlet'])->name('merchant.edit.outlet');
    Route::post('update/outlet', [MerchantController::class, 'MerchantUpdateOutlet'])->name('merchant.update.outlet');
    Route::get('delete/outlet/{id}', [MerchantController::class, 'MerchantDeleteOutlet'])->name('merchant.delete.outlet');

    //Merchant About All Route
    Route::get('about', [MerchantController::class, 'MerchantAboutPage'])->name('merchant.about');
    Route::post('about/store', [MerchantController::class, 'MerchantStoreAboutPage'])->name('merchant.about.store');

    // Merchant File management all route
    Route::get('media/files', [MerchantController::class, 'MerchantMediaFiles'])->name('merchant.media.files');
    Route::get('media/addfiles', [MerchantController::class, 'MerchantMediaAddFiles'])->name('merchant.media.add');
    Route::post('media/storefiles', [MerchantController::class, 'MerchantMediaStoreFiles'])->name('merchant.media.store');
    Route::get('media/delete/{id}', [MerchantController::class, 'MerchantDeleteFile'])->name('merchant.media.delete');
});