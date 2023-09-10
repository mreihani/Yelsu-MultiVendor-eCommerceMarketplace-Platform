<?php

use App\Http\Controllers\Frontend\IndexController;

Route::get('/', [IndexController::class, 'HomePage']);

// Frontend Shop All routes
Route::get('shop', [IndexController::class, 'ViewShop'])->name('shop');
Route::get('shop/search', [IndexController::class, 'ViewShopFiltered'])->name('shop.search');
Route::get('shop/category', [IndexController::class, 'ViewShopCategoryFiltered'])->name('shop.category');

// Frontend Product details all route
Route::get('/product/{slug}', [IndexController::class, 'ProductDetails'])->name('product.details');

// Frontend Vendor details all route
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');
Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');
Route::get('/vendor/search', [IndexController::class, 'VendorAllSearch'])->name('vendor.all.search');

// Frontend Merchant details all route
Route::get('/merchant/details/{id}', [IndexController::class, 'MerchantDetails'])->name('merchant.details');
Route::get('/merchant/all', [IndexController::class, 'MerchantAll'])->name('merchant.all');
Route::get('/merchant/search', [IndexController::class, 'MerchantAllSearch'])->name('merchant.all.search');

// Frontend Merchant details all route
Route::get('/retailer/details/{id}', [IndexController::class, 'RetailerDetails'])->name('retailer.details');
Route::get('/retailer/all', [IndexController::class, 'RetailerAll'])->name('retailer.all');
Route::get('/retailer/search', [IndexController::class, 'RetailerAllSearch'])->name('retailer.all.search');

// Frontend Customs details all route
Route::get('/customs/details/{id}', [IndexController::class, 'CustomsDetails'])->name('customs.details');
Route::get('/customs/all', [IndexController::class, 'CustomsAll'])->name('customs.all');
Route::get('/customs/search', [IndexController::class, 'CustomsAllSearch'])->name('customs.all.search');

// Frontend Freightage details all route
Route::get('/freightage/details/{id}', [IndexController::class, 'FreightageDetails'])->name('freightage.details');
Route::get('/freightage/all', [IndexController::class, 'FreightageAll'])->name('freightage.all');
Route::get('/freightage/search', [IndexController::class, 'FreightageAllSearch'])->name('freightage.all.search');

// Frontend Driver details all route
Route::get('/driver/details/{id}', [IndexController::class, 'DriverDetails'])->name('driver.details');
Route::get('/driver/all', [IndexController::class, 'DriverAll'])->name('driver.all');
Route::get('/driver/search', [IndexController::class, 'DriverAllSearch'])->name('driver.all.search');

Route::get('/search', [IndexController::class, 'ViewSearchProducts'])->name('search.products');