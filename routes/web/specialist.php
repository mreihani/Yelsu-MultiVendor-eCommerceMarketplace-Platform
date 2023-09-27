<?php

use App\Http\Controllers\Backend\Specialist\SpecialistController;
use App\Http\Controllers\Backend\Specialist\SpeclialistCustomsController;
use App\Http\Controllers\Backend\Specialist\SpecialistAttributeController;

//Specialist Dashboard
Route::get('dashboard', [SpecialistController::class, 'SpecialistDashboard'])->name('specialist.dashboard');
Route::get('logout', [SpecialistController::class, 'SpecialistDestroy'])->name('specialist.logout');
Route::get('profile', [SpecialistController::class, 'SpecialistProfile'])->name('specialist.profile');
Route::get('settings', [SpecialistController::class, 'SpecialistProfileSettings'])->name('specialist.profileSettings');
Route::post('profile/store', [SpecialistController::class, 'SpecialistProfileStore'])->name('specialist.profile.store');
Route::post('update/password', [SpecialistController::class, 'SpecialistUpdatePassword'])->name('specialist.update.password');

//Category All Route
Route::get('all/category', [SpecialistController::class, 'SpecialistAllCategory'])->name('specialist.all.category');
Route::get('add/category', [SpecialistController::class, 'SpecialistAddCategory'])->name('specialist.add.category');
Route::post('store/category', [SpecialistController::class, 'SpecialistStoreCategory'])->name('specialist.store.category');
Route::get('edit/category/{id}', [SpecialistController::class, 'SpecialistEditCategory'])->name('specialist.edit.category');
Route::post('update/category', [SpecialistController::class, 'SpecialistUpdateCategory'])->name('specialist.update.category');
Route::get('delete/category/{id}', [SpecialistController::class, 'SpecialistDeleteCategory'])->name('specialist.delete.category');

// Product All Route
Route::get('all/product', [SpecialistController::class, 'SpecialistAllProduct'])->name('specialist.all.product');
Route::get('all/product/search', [SpecialistController::class, 'SpecialistAllProductSearch'])->name('specialist.all.product.search');
Route::get('add/product', [SpecialistController::class, 'SpecialistAddProduct'])->name('specialist.add.product');
Route::post('store/product', [SpecialistController::class, 'SpecialistStoreProduct'])->name('specialist.store.product');
Route::get('edit/product/{id}', [SpecialistController::class, 'SpecialistEditProduct'])->name('specialist.edit.product');
Route::post('update/product', [SpecialistController::class, 'SpecialistUpdateProduct'])->name('specialist.update.product');
Route::get('delete/product/{id}', [SpecialistController::class, 'SpecialistDeleteProduct'])->name('specialist.delete.product');
Route::post('load-attributes', [SpecialistController::class, 'LoadAttributes']);

//Vendor Active and Inactive All Route
Route::get('vendor/status', [SpecialistController::class, 'SpecialistVendorStatus'])->name('specialist.vendor.status');
Route::get('vendor/status/search', [SpecialistController::class, 'SpecialistVendorStatusSearch'])->name('specialist.vendor.status.search');
Route::post('vendor/statusChange', [SpecialistController::class, 'SpecialistVendorStatusChange'])->name('specialist.vendor.statusChange');
Route::get('vendor/statusView/{id}', [SpecialistController::class, 'SpecialistVendorStatusView'])->name('specialist.vendor.statusView');

//Retailer Active and Inactive All Route
Route::get('retailer/status', [SpecialistController::class, 'SpecialistRetailerStatus'])->name('specialist.retailer.status');
Route::get('retailer/status/search', [SpecialistController::class, 'SpecialistRetailerStatusSearch'])->name('specialist.retailer.status.search');
Route::post('retailer/statusChange', [SpecialistController::class, 'SpecialistRetailerStatusChange'])->name('specialist.retailer.statusChange');
Route::get('retailer/statusView/{id}', [SpecialistController::class, 'SpecialistRetailerStatusView'])->name('specialist.retailer.statusView');

//Freightage Active and Inactive All Route
Route::get('freightage/status', [SpecialistController::class, 'SpecialistFreightageStatus'])->name('specialist.freightage.status');
Route::get('freightage/status/search', [SpecialistController::class, 'SpecialistFreightageStatusSearch'])->name('specialist.freightage.status.search');
Route::post('freightage/statusChange', [SpecialistController::class, 'SpecialistFreightageStatusChange'])->name('specialist.freightage.statusChange');
Route::get('freightage/statusView/{id}', [SpecialistController::class, 'SpecialistFreightageStatusView'])->name('specialist.freightage.statusView');

//Driver Active and Inactive All Route
Route::get('driver/status', [SpecialistController::class, 'SpecialistDriverStatus'])->name('specialist.driver.status');
Route::get('driver/status/search', [SpecialistController::class, 'SpecialistDriverStatusSearch'])->name('specialist.driver.status.search');
Route::post('driver/statusChange', [SpecialistController::class, 'SpecialistDriverStatusChange'])->name('specialist.driver.statusChange');
Route::get('driver/statusView/{id}', [SpecialistController::class, 'SpecialistDriverStatusView'])->name('specialist.driver.statusView');

//Private Chat all route
Route::get('private/chat', [SpecialistController::class, 'SpecialistPrivateChat'])->name('specialist.private.chat');
Route::get('private/autofetch', [SpecialistController::class, 'SpecialistPrivateChatAutoFetch']);
Route::get('private/newMessageCounter', [SpecialistController::class, 'newMessageCounter']);
Route::post('private/fetchsinglemessage', [SpecialistController::class, 'fetchSingleMessage']);
Route::post('private/fetchsinglemessagelongpolling', [SpecialistController::class, 'fetchSingleMessageLongPolling']);

// File management all route
Route::get('media/files', [SpecialistController::class, 'SpecialistMediaFiles'])->name('specialist.media.files');
Route::get('media/addfiles', [SpecialistController::class, 'SpecialistMediaAddFiles'])->name('specialist.media.add');
Route::post('media/storefiles', [SpecialistController::class, 'SpecialistMediaStoreFiles'])->name('specialist.media.store');
Route::get('media/delete/{id}', [SpecialistController::class, 'SpecialistDeleteFile'])->name('specialist.media.delete');

// Vendor Product Verify All Route
Route::get('vendor/product/verifyAll', [SpecialistController::class, 'SpecialistVendorProductVerifyAll'])->name('specialist.vendor.product.verifyAll');
// Retailer Product Verify All Route
Route::get('retailer/product/verifyAll', [SpecialistController::class, 'SpecialistRetailerProductVerifyAll'])->name('specialist.retailer.product.verifyAll');

// Vendor About Page Verify All Route
Route::get('vendor/about/verifyAll', [SpecialistController::class, 'SpecialistVendorAboutVerifyAll'])->name('specialist.vendor.about.verifyAll');
Route::get('vendor/about/verifyAll/search', [SpecialistController::class, 'SpecialistVendorAboutVerifyAllSearch'])->name('specialist.vendor.about.verifyAll.search');
Route::get('vendor/about/verify/{id}', [SpecialistController::class, 'SpecialistVendorAboutVerify'])->name('specialist.vendor.about.verify');
Route::post('vendor/about/verify/store', [SpecialistController::class, 'SpecialistVendorAboutVerifyStore'])->name('specialist.vendor.about.verify.store');

// Retailer About Page Verify All Route
Route::get('retailer/about/verifyAll', [SpecialistController::class, 'SpecialistRetailerAboutVerifyAll'])->name('specialist.retailer.about.verifyAll');
Route::get('retailer/about/verifyAll/search', [SpecialistController::class, 'SpecialistRetailerAboutVerifyAllSearch'])->name('specialist.retailer.about.verifyAll.search');
Route::get('retailer/about/verify/{id}', [SpecialistController::class, 'SpecialistRetailerAboutVerify'])->name('specialist.retailer.about.verify');
Route::post('retailer/about/verify/store', [SpecialistController::class, 'SpecialistRetailerAboutVerifyStore'])->name('specialist.retailer.about.verify.store');

// Freightage About Page Verify All Route
Route::get('freightage/about/verifyAll', [SpecialistController::class, 'SpecialistFreightageAboutVerifyAll'])->name('specialist.freightage.about.verifyAll');
Route::get('freightage/about/verifyAll/search', [SpecialistController::class, 'SpecialistFreightageAboutVerifyAllSearch'])->name('specialist.freightage.about.verifyAll.search');
Route::get('freightage/about/verify/{id}', [SpecialistController::class, 'SpecialistFreightageAboutVerify'])->name('specialist.freightage.about.verify');
Route::post('freightage/about/verify/store', [SpecialistController::class, 'SpecialistFreightageAboutVerifyStore'])->name('specialist.freightage.about.verify.store');

// Driver About Page Verify All Route
Route::get('driver/about/verifyAll', [SpecialistController::class, 'SpecialistDriverAboutVerifyAll'])->name('specialist.driver.about.verifyAll');
Route::get('driver/about/verifyAl/search', [SpecialistController::class, 'SpecialistDriverAboutVerifyAllSearch'])->name('specialist.driver.about.verifyAll.search');
Route::get('driver/about/verify/{id}', [SpecialistController::class, 'SpecialistDriverAboutVerify'])->name('specialist.driver.about.verify');
Route::post('driver/about/verify/store', [SpecialistController::class, 'SpecialistDriverAboutVerifyStore'])->name('specialist.driver.about.verify.store');

// Freightage Profile Pages Verify All Route
Route::get('freightage/profile/verifyAll', [SpecialistController::class, 'SpecialistFreightageProfileVerifyAll'])->name('specialist.freightage.profile.verifyAll');
Route::get('freightage/profile/verifyAl/search', [SpecialistController::class, 'SpecialistFreightageProfileVerifyAllSearch'])->name('specialist.freightage.profile.verifyAll.search');
Route::get('freightage/profile/verify/{id}', [SpecialistController::class, 'SpecialistFreightageProfileVerify'])->name('specialist.freightage.profile.verify');
Route::post('freightage/profile/verify/store', [SpecialistController::class, 'SpecialistFreightageProfileVerifyStore'])->name('specialist.freightage.profile.verify.store');

// Driver Profile Pages Verify All Route
Route::get('driver/profile/verifyAll', [SpecialistController::class, 'SpecialistDriverProfileVerifyAll'])->name('specialist.driver.profile.verifyAll');
Route::get('driver/profile/verifyAl/search', [SpecialistController::class, 'SpecialistDriverProfileVerifyAllSearch'])->name('specialist.driver.profile.verifyAll.search');
Route::get('driver/profile/verify/{id}', [SpecialistController::class, 'SpecialistDriverProfileVerify'])->name('specialist.driver.profile.verify');
Route::post('driver/profile/verify/store', [SpecialistController::class, 'SpecialistDriverProfileVerifyStore'])->name('specialist.driver.profile.verify.store');

// Specialist Customs Outlets All Route
Route::get('all/customsoutlet', [SpeclialistCustomsController::class, 'SpeclialistAllCustomsOutlet'])->name('specialist.all.customsoutlet');
Route::get('create/customsoutlet', [SpeclialistCustomsController::class, 'SpeclialistCreateCustomsOutlet'])->name('specialist.create.customsoutlet');
Route::post('store/customsoutlet', [SpeclialistCustomsController::class, 'SpeclialistStoreCustomsOutlet'])->name('specialist.store.customsoutlet');
Route::get('edit/customsoutlet/{id}', [SpeclialistCustomsController::class, 'SpeclialistEditCustomsOutlet'])->name('specialist.edit.customsoutlet');
Route::post('update/customsoutlet', [SpeclialistCustomsController::class, 'SpeclialistUpdateCustomsOutlet'])->name('specialist.update.customsoutlet');
Route::get('delete/customsoutlet/{id}', [SpeclialistCustomsController::class, 'SpeclialistDeleteCustomsOutlet'])->name('specialist.delete.customsoutlet');

//Attribute All Route
Route::controller(SpecialistAttributeController::class)->group(function () {
    Route::get('/all/attribute', 'AllAttribute')->name('specialist.all.attribute');
    Route::get('/add/attribute', 'AddAttribute')->name('specialist.add.attribute');
    Route::post('/store/attribute', 'StoreAttribute')->name('specialist.store.attribute');
    Route::get('/edit/attribute/{id}', 'EditAttribute')->name('specialist.edit.attribute');
    Route::post('/update/attribute', 'UpdateAttribute')->name('specialist.update.attribute');
    Route::get('/delete/attribute/{id}', 'DeleteAttribute')->name('specialist.delete.attribute');
});