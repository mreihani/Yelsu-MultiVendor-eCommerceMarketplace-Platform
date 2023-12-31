<?php

use App\Http\Controllers\Backend\Vendor\OutletController;
use App\Http\Controllers\Backend\Vendor\VendorController;
use App\Http\Controllers\Backend\Vendor\VendorOrderController;
use App\Http\Controllers\Backend\Vendor\VendorProductController;
use App\Http\Controllers\Backend\Vendor\VendorScheduleController;
use App\Http\Controllers\Backend\Vendor\VendorFreightageController;
use App\Http\Controllers\Backend\Vendor\VendorRepresentativeController;

//Vendor Dashboard
Route::get('dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
Route::get('logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');

Route::get('profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
Route::get('settings', [VendorController::class, 'VendorProfileSettings'])->name('vendor.profileSettings');
Route::post('profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
Route::post('update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');

//fincancial statement section
Route::get('financialStatement', [VendorController::class, 'VendorProfileFinancialStatement'])->name('vendor.profileFinancialStatement');
Route::post('financialStatement/store', [VendorController::class, 'VendorProfileFinancialStatementStore'])->name('vendor.profileFinancialStatement.store');

Route::middleware(['vendoraccess'])->group(function () {
    //Vendor Add Product All Route
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('add/product', 'VendorAddProduct')->name('vendor.add.product');
        Route::post('store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');
        Route::post('update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::get('delete/product/{id}', 'VendorDeleteProduct')->name('vendor.delete.product');
        Route::get('copy/product/{id}', 'VendorCopyProduct')->name('vendor.copy.product');
        Route::post('storeCopy/product', 'VendorStoreCopyProduct')->name('vendor.storeCopy.product');
        Route::post('load-attributes','LoadAttributes');
        Route::get('/all/freightage-loader-type-ajax', 'GetFreightageLoaderAjax');
    });

    //Vendor Order All Route
    Route::get('orders', [VendorOrderController::class, 'ViewVendorOrders'])->name('vendor.orders');
    Route::post('orders/destroy/{id}', [VendorOrderController::class, 'DestroyVendorOrder'])->name('vendor.orders.destroy');
    Route::get('orders/view/{id}', [VendorOrderController::class, 'ViewVendorOrderItem'])->name('vendor.orders.view');
    Route::post('order/changeStatus/{id}', [VendorOrderController::class, 'ChangeVendorOrderStatus'])->name('vendor.order.changeStatus');

    //Vendor MapAddress All Route
    Route::get('all/outlet', [OutletController::class, 'VendorAllOutlet'])->name('vendor.all.outlet');
    Route::get('create/outlet', [OutletController::class, 'VendorCreateOutlet'])->name('vendor.create.outlet');
    Route::post('store/outlet', [OutletController::class, 'VendorStoreOutlet'])->name('vendor.store.outlet');
    Route::get('edit/outlet/{id}', [OutletController::class, 'VendorEditOutlet'])->name('vendor.edit.outlet');
    Route::post('update/outlet', [OutletController::class, 'VendorUpdateOutlet'])->name('vendor.update.outlet');
    Route::get('delete/outlet/{id}', [OutletController::class, 'VendorDeleteOutlet'])->name('vendor.delete.outlet');

    //Vendor About All Route
    Route::get('about', [VendorController::class, 'VendorAboutPage'])->name('vendor.about');
    Route::post('about/store', [VendorController::class, 'VendorStoreAboutPage'])->name('vendor.about.store');

    // File management all route
    Route::get('media/files', [VendorController::class, 'VendorMediaFiles'])->name('vendor.media.files');
    Route::get('media/addfiles', [VendorController::class, 'VendorMediaAddFiles'])->name('vendor.media.add');
    Route::post('media/storefiles', [VendorController::class, 'VendorMediaStoreFiles'])->name('vendor.media.store');
    Route::get('media/delete/{id}', [VendorController::class, 'VendorDeleteFile'])->name('vendor.media.delete');

    // Vendor Representative management all route
    Route::get('all/representative', [VendorRepresentativeController::class, 'VendorAllRepresentative'])->name('vendor.all.representative');
    Route::get('add/representative', [VendorRepresentativeController::class, 'VendorAddRepresentative'])->name('vendor.add.representative');
    Route::post('store/representative', [VendorRepresentativeController::class, 'VendorStoreRepresentative'])->name('vendor.store.representative');
    Route::get('edit/representative/{representative_id}', [VendorRepresentativeController::class, 'VendorEditRepresentative'])->middleware(['vendorrepresentativeaccess'])->name('vendor.edit.representative');
    Route::post('update-user/representative', [VendorRepresentativeController::class, 'VendorUpdateUserRepresentative'])->middleware(['vendorrepresentativeaccess'])->name('vendor.update.user.representative');
    Route::post('update-products/representative', [VendorRepresentativeController::class, 'VendorUpdateProductsRepresentative'])->middleware(['vendorrepresentativeaccess'])->name('vendor.update.products.representative');
    Route::get('delete/representative/{representative_id}', [VendorRepresentativeController::class, 'VendorDeleteRepresentative'])->middleware(['vendorrepresentativeaccess'])->name('vendor.delete.representative');

    // Vendor Freightage management all route
    Route::get('all/freightage/verified', [VendorFreightageController::class, 'VendorAllFreightageVerified'])->name('vendor.all.freightage.verified');
    Route::get('all/freightage/not-verified', [VendorFreightageController::class, 'VendorAllFreightageNotVerified'])->name('vendor.all.freightage.not-verified');
    Route::get('edit/freightage/{invitation}', [VendorFreightageController::class, 'VendorEditFreightage'])->name('vendor.edit.freightage');
    Route::post('update/freightage', [VendorFreightageController::class, 'VendorUpdateFreightage'])->name('vendor.update.freightage');

    // Vendor Product Schedule all route
    Route::get('add/schedule', [VendorScheduleController::class, 'VendorAddSchedule'])->name('vendor.add.schedule');
});

//Vendor Login
//Route::get('login',[VendorController::class, 'VendorLogin'])->middleware(RedirectIfAuthenticated::class);