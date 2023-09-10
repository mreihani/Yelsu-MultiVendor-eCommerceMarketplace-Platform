<?php

use App\Http\Controllers\Backend\Retailer\RetailerController;

//Retailer Dashboard
Route::get('dashboard', [RetailerController::class, 'RetailerDashboard'])->name('retailer.dashboard');
Route::get('logout', [RetailerController::class, 'RetailerDestroy'])->name('retailer.logout');

Route::get('profile', [RetailerController::class, 'RetailerProfile'])->name('retailer.profile');
Route::get('settings', [RetailerController::class, 'RetailerProfileSettings'])->name('retailer.profileSettings');
Route::post('profile/store', [RetailerController::class, 'RetailerProfileStore'])->name('retailer.profile.store');
//Route::post('update/password', [RetailerController::class, 'RetailerUpdatePassword'])->name('retailer.update.password');

// fincancial statement section
Route::get('financialStatement', [RetailerController::class, 'RetailerProfileFinancialStatement'])->name('retailer.profileFinancialStatement');
Route::post('financialStatement/store', [RetailerController::class, 'RetailerProfileFinancialStatementStore'])->name('retailer.profileFinancialStatement.store');


Route::middleware(['retaileraccess'])->group(function () {
    Route::controller(RetailerController::class)->group(function () {
        Route::get('all/product', 'RetailerAllProduct')->name('retailer.all.product');
        Route::get('add/product', 'RetailerAddProduct')->name('retailer.add.product');
        Route::post('store/product', 'RetailerStoreProduct')->name('retailer.store.product');
        Route::get('edit/product/{id}', 'RetailerEditProduct')->name('retailer.edit.product');
        Route::post('update/product', 'RetailerUpdateProduct')->name('retailer.update.product');
        Route::get('delete/product/{id}', 'RetailerDeleteProduct')->name('retailer.delete.product');
        Route::get('copy/product/{id}', 'RetailerCopyProduct')->name('retailer.copy.product');
        Route::post('storeCopy/product', 'RetailerStoreCopyProduct')->name('retailer.storeCopy.product');

        //Retailer Order All Route
        Route::get('orders', 'ViewRetailerOrders')->name('retailer.orders');
        Route::post('orders/destroy/{id}', 'DestroyRetailerOrder')->name('retailer.orders.destroy');
        Route::get('orders/view/{id}', 'ViewRetailerOrderItem')->name('retailer.orders.view');
        Route::post('order/changeStatus/{id}', 'ChangeRetailerOrderStatus')->name('retailer.order.changeStatus');

        //Retailer About All Route
        Route::get('about', 'RetailerAboutPage')->name('retailer.about');
        Route::post('about/store', 'RetailerStoreAboutPage')->name('retailer.about.store');

        // File management all route
        Route::get('media/files', 'RetailerMediaFiles')->name('retailer.media.files');
        Route::get('media/addfiles', 'RetailerMediaAddFiles')->name('retailer.media.add');
        Route::post('media/storefiles', 'RetailerMediaStoreFiles')->name('retailer.media.store');
        Route::get('media/delete/{id}', 'RetailerDeleteFile')->name('retailer.media.delete');

        //Retailer MapAddress All Route
        Route::get('/retailer/all/outlet', 'RetailerAllOutlet')->name('retailer.all.outlet');
        Route::get('/retailer/create/outlet', 'RetailerCreateOutlet')->name('retailer.create.outlet');
        Route::post('/retailer/store/outlet', 'RetailerStoreOutlet')->name('retailer.store.outlet');
        Route::get('/retailer/edit/outlet/{id}', 'RetailerEditOutlet')->name('retailer.edit.outlet');
        Route::post('/retailer/update/outlet', 'RetailerUpdateOutlet')->name('retailer.update.outlet');
        Route::get('/retailer/delete/outlet/{id}', 'RetailerDeleteOutlet')->name('retailer.delete.outlet');
    });

});