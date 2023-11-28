<?php

use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\OrderController;
use App\Http\Controllers\Backend\Admin\ProductController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\AdminBlogController;
use App\Http\Controllers\Backend\Admin\AdminVisitController;
use App\Http\Controllers\Backend\Admin\AdminCustomsController;
use App\Http\Controllers\Backend\Admin\AdminAttributeController;


//Admin Dashboard
Route::get('dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
Route::get('logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
Route::get('profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
Route::get('settings', [AdminController::class, 'AdminProfileSettings'])->name('admin.profileSettings');
Route::post('profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::post('update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');

// Admin Order All Route
Route::get('orders', [OrderController::class, 'ViewOrders'])->name('admin.orders');
Route::post('orders/destroy/{id}', [OrderController::class, 'DestroyOrder'])->name('admin.orders.destroy');
Route::get('orders/view/{id}', [OrderController::class, 'ViewOrderItem'])->name('admin.orders.view');
Route::post('order/changeStatus/{id}', [OrderController::class, 'ChangeOrderStatus'])->name('admin.order.changeStatus');

// Admin Blog Category All Route
Route::get('blog/category', [AdminBlogController::class, 'AllBlogCategory'])->name('admin.blog.category');
Route::get('add/blog/category', [AdminBlogController::class, 'AddBlogCategory'])->name('add.blog.category');
Route::post('store/blog/category', [AdminBlogController::class, 'StoreBlogCategory'])->name('store.blog.category');
Route::get('edit/blog/category/{id}', [AdminBlogController::class, 'EditBlogCategory'])->name('edit.blog.category');
Route::post('update/blog/category', [AdminBlogController::class, 'UpdateBlogCategory'])->name('update.blog.category');
Route::get('delete/blog/category/{id}', [AdminBlogController::class, 'DeleteBlogCategory'])->name('delete.blog.category');

// Admin Blog Post All Route
Route::get('blog/post', [AdminBlogController::class, 'AllBlogPost'])->name('admin.blog.post');
Route::get('add/blog/post', [AdminBlogController::class, 'AddBlogPost'])->name('add.blog.post');
Route::post('store/blog/post', [AdminBlogController::class, 'StoreBlogPost'])->name('store.blog.post');
Route::get('edit/blog/post/{id}', [AdminBlogController::class, 'EditBlogPost'])->name('edit.blog.post');
Route::post('update/blog/post', [AdminBlogController::class, 'UpdateBlogPost'])->name('update.blog.post');
Route::get('delete/blog/post/{id}', [AdminBlogController::class, 'DeleteBlogPost'])->name('delete.blog.post');

// Admin User Management All Route
Route::get('users', [AdminController::class, 'AdminUsersView'])->name('admin.users');
Route::get('users/search', [AdminController::class, 'AdminUsersViewSearch'])->name('admin.users.search');
Route::get('users/add', [AdminController::class, 'AdminUsersAdd'])->name('admin.users.add');
Route::post('users/store', [AdminController::class, 'AdminUserStore'])->name('admin.users.store');
Route::get('user/edit/{id}', [AdminController::class, 'AdminEditUser'])->name('admin.user.edit');
Route::post('user/update/', [AdminController::class, 'AdminUpdateUser'])->name('admin.user.update');
Route::get('user/delete/{id}', [AdminController::class, 'AdminDeleteUser'])->name('admin.user.delete');

//Vendor Active and Inactive All Route
Route::get('vendor/status', [AdminController::class, 'AdminVendorStatus'])->name('admin.vendor.status');
Route::get('vendor/status/search', [AdminController::class, 'AdminVendorStatusSearch'])->name('admin.vendor.status.search');
Route::post('vendor/statusChange', [AdminController::class, 'AdminVendorStatusChange'])->name('admin.vendor.statusChange');
Route::get('vendor/statusView/{id}', [AdminController::class, 'AdminVendorStatusView'])->name('admin.vendor.statusView');

//Merchant Active and Inactive All Route
Route::get('merchant/status', [AdminController::class, 'AdminMerchantStatus'])->name('admin.merchant.status');
Route::get('merchant/status/search', [AdminController::class, 'AdminMerchantStatusSearch'])->name('admin.merchant.status.search');
Route::post('merchant/statusChange', [AdminController::class, 'AdminMerchantStatusChange'])->name('admin.merchant.statusChange');
Route::get('merchant/statusView/{id}', [AdminController::class, 'AdminMerchantStatusView'])->name('admin.merchant.statusView');

//Retailer Active and Inactive All Route
Route::get('retailer/status', [AdminController::class, 'AdminRetailerStatus'])->name('admin.retailer.status');
Route::get('retailer/status/search', [AdminController::class, 'AdminRetailerStatusSearch'])->name('admin.retailer.status.search');
Route::post('retailer/statusChange', [AdminController::class, 'AdminRetailerStatusChange'])->name('admin.retailer.statusChange');
Route::get('retailer/statusView/{id}', [AdminController::class, 'AdminRetailerStatusView'])->name('admin.retailer.statusView');

//Freightage Active and Inactive All Route
Route::get('freightage/status', [AdminController::class, 'AdminFreightageStatus'])->name('admin.freightage.status');
Route::get('freightage/status/search', [AdminController::class, 'AdminFreightageStatusSearch'])->name('admin.freightage.status.search');
Route::post('freightage/statusChange', [AdminController::class, 'AdminFreightageStatusChange'])->name('admin.freightage.statusChange');
Route::get('freightage/statusView/{id}', [AdminController::class, 'AdminFreightageStatusView'])->name('admin.freightage.statusView');

//Driver Active and Inactive All Route
Route::get('driver/status', [AdminController::class, 'AdminDriverStatus'])->name('admin.driver.status');
Route::get('driver/status/search', [AdminController::class, 'AdminDriverStatusSearch'])->name('admin.driver.status.search');
Route::post('driver/statusChange', [AdminController::class, 'AdminDriverStatusChange'])->name('admin.driver.statusChange');
Route::get('driver/statusView/{id}', [AdminController::class, 'AdminDriverStatusView'])->name('admin.driver.statusView');

// Product Verify All Route
Route::get('vendor/product/verifyAll', [AdminController::class, 'AdminVendorProductVerifyAll'])->name('admin.vendor.product.verifyAll');
Route::get('merchant/product/verifyAll', [AdminController::class, 'AdminMerchantProductVerifyAll'])->name('admin.merchant.product.verifyAll');
Route::get('retailer/product/verifyAll', [AdminController::class, 'AdminRetailerProductVerifyAll'])->name('admin.retailer.product.verifyAll');

// Vendor About Page Verify All Route
Route::get('vendor/about/verifyAll', [AdminController::class, 'AdminVendorAboutVerifyAll'])->name('admin.vendor.about.verifyAll');
Route::get('vendor/about/verifyAll/search', [AdminController::class, 'AdminVendorAboutVerifyAllSearch'])->name('admin.vendor.about.verifyAll.search');
Route::get('vendor/about/verify/{id}', [AdminController::class, 'AdminVendorAboutVerify'])->name('admin.vendor.about.verify');
Route::post('vendor/about/verify/store', [AdminController::class, 'AdminVendorAboutVerifyStore'])->name('admin.vendor.about.verify.store');

// Merchant About Page Verify All Route
Route::get('merchant/about/verifyAll', [AdminController::class, 'AdminMerchantAboutVerifyAll'])->name('admin.merchant.about.verifyAll');
Route::get('merchant/about/verifyAl/search', [AdminController::class, 'AdminMerchantAboutVerifyAllSearch'])->name('admin.merchant.about.verifyAll.search');
Route::get('merchant/about/verify/{id}', [AdminController::class, 'AdminMerchantAboutVerify'])->name('admin.merchant.about.verify');
Route::post('merchant/about/verify/store', [AdminController::class, 'AdminMerchantAboutVerifyStore'])->name('admin.merchant.about.verify.store');

// Retailer About Page Verify All Route
Route::get('retailer/about/verifyAll', [AdminController::class, 'AdminRetailerAboutVerifyAll'])->name('admin.retailer.about.verifyAll');
Route::get('retailer/about/verifyAl/search', [AdminController::class, 'AdminRetailerAboutVerifyAllSearch'])->name('admin.retailer.about.verifyAll.search');
Route::get('retailer/about/verify/{id}', [AdminController::class, 'AdminRetailerAboutVerify'])->name('admin.retailer.about.verify');
Route::post('retailer/about/verify/store', [AdminController::class, 'AdminRetailerAboutVerifyStore'])->name('admin.retailer.about.verify.store');

// Freightage About Page Verify All Route
Route::get('freightage/about/verifyAll', [AdminController::class, 'AdminFreightageAboutVerifyAll'])->name('admin.freightage.about.verifyAll');
Route::get('freightage/about/verifyAl/search', [AdminController::class, 'AdminFreightageAboutVerifyAllSearch'])->name('admin.freightage.about.verifyAll.search');
Route::get('freightage/about/verify/{id}', [AdminController::class, 'AdminFreightageAboutVerify'])->name('admin.freightage.about.verify');
Route::post('freightage/about/verify/store', [AdminController::class, 'AdminFreightageAboutVerifyStore'])->name('admin.freightage.about.verify.store');

// Freightage Profile Pages Verify All Route
Route::get('freightage/profile/verifyAll', [AdminController::class, 'AdminFreightageProfileVerifyAll'])->name('admin.freightage.profile.verifyAll');
Route::get('freightage/profile/verifyAl/search', [AdminController::class, 'AdminFreightageProfileVerifyAllSearch'])->name('admin.freightage.profile.verifyAll.search');
Route::get('freightage/profile/verify/{id}', [AdminController::class, 'AdminFreightageProfileVerify'])->name('admin.freightage.profile.verify');
Route::post('freightage/profile/verify/store', [AdminController::class, 'AdminFreightageProfileVerifyStore'])->name('admin.freightage.profile.verify.store');

// Driver About Page Verify All Route
Route::get('driver/about/verifyAll', [AdminController::class, 'AdminDriverAboutVerifyAll'])->name('admin.driver.about.verifyAll');
Route::get('driver/about/verifyAl/search', [AdminController::class, 'AdminDriverAboutVerifyAllSearch'])->name('admin.driver.about.verifyAll.search');
Route::get('driver/about/verify/{id}', [AdminController::class, 'AdminDriverAboutVerify'])->name('admin.driver.about.verify');
Route::post('driver/about/verify/store', [AdminController::class, 'AdminDriverAboutVerifyStore'])->name('admin.driver.about.verify.store');

// Driver Profile Pages Verify All Route
Route::get('driver/profile/verifyAll', [AdminController::class, 'AdminDriverProfileVerifyAll'])->name('admin.driver.profile.verifyAll');
Route::get('driver/profile/verifyAl/search', [AdminController::class, 'AdminDriverProfileVerifyAllSearch'])->name('admin.driver.profile.verifyAll.search');
Route::get('driver/profile/verify/{id}', [AdminController::class, 'AdminDriverProfileVerify'])->name('admin.driver.profile.verify');
Route::post('driver/profile/verify/store', [AdminController::class, 'AdminDriverProfileVerifyStore'])->name('admin.driver.profile.verify.store');

// File management all route
Route::get('media/files', [AdminController::class, 'AdminMediaFiles'])->name('admin.media.files');
Route::get('media/addfiles', [AdminController::class, 'AdminMediaAddFiles'])->name('admin.media.add');
Route::post('media/storefiles', [AdminController::class, 'AdminMediaStoreFiles'])->name('admin.media.store');
Route::get('media/delete/{id}', [AdminController::class, 'AdminDeleteFile'])->name('admin.media.delete');

// Admin Customs Outlets All Route
Route::get('all/customsoutlet', [AdminCustomsController::class, 'AdminAllCustomsOutlet'])->name('admin.all.customsoutlet');
Route::get('create/customsoutlet', [AdminCustomsController::class, 'AdminCreateCustomsOutlet'])->name('admin.create.customsoutlet');
Route::post('store/customsoutlet', [AdminCustomsController::class, 'AdminStoreCustomsOutlet'])->name('admin.store.customsoutlet');
Route::get('edit/customsoutlet/{id}', [AdminCustomsController::class, 'AdminEditCustomsOutlet'])->name('admin.edit.customsoutlet');
Route::post('update/customsoutlet', [AdminCustomsController::class, 'AdminUpdateCustomsOutlet'])->name('admin.update.customsoutlet');
Route::get('delete/customsoutlet/{id}', [AdminCustomsController::class, 'AdminDeleteCustomsOutlet'])->name('admin.delete.customsoutlet');


// Categories and all backend functions related to the Admin
//Category All Route
Route::controller(CategoryController::class)->group(function () {
    Route::get('/all/category', 'AllCategory')->name('all.category');
    Route::get('/add/category', 'AddCategory')->name('add.category');
    Route::post('/store/category', 'StoreCategory')->name('store.category');
    Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
    Route::post('/update/category', 'UpdateCategory')->name('update.category');
    Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
});

//Product All Route
Route::controller(ProductController::class)->group(function () {
    Route::get('/all/product', 'AllProduct')->name('all.product');
    Route::get('/all/product/search', 'AllProductSearch')->name('all.product.search');
    Route::get('/add/product', 'AddProduct')->name('add.product');
    Route::post('/store/product', 'StoreProduct')->name('store.product');
    Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
    Route::post('/update/product', 'UpdateProduct')->name('update.product');
    Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
    Route::get('copy/product/{id}', 'CopyProduct')->name('copy.product');
    Route::post('storeCopy/product', 'StoreCopyProduct')->name('storeCopy.product');
    Route::post('load-attributes', 'LoadAttributes');
});

//Attribute All Route
Route::controller(AdminAttributeController::class)->group(function () {
    Route::get('/all/attribute', 'AllAttribute')->name('all.attribute');
    Route::get('/add/attribute', 'AddAttribute')->name('add.attribute');
    Route::post('/store/attribute', 'StoreAttribute')->name('store.attribute');
    Route::get('/edit/attribute/{id}', 'EditAttribute')->name('edit.attribute');
    Route::post('/update/attribute', 'UpdateAttribute')->name('update.attribute');
    Route::get('/copy/attribute/{id}', 'CopyAttribute')->name('copy.attribute');
    Route::post('/store-copy/attribute', 'StoreCopyAttribute')->name('store.copy.attribute');
    Route::get('/delete/attribute/{id}', 'DeleteAttribute')->name('delete.attribute');
});

//Visit All Route
Route::controller(AdminVisitController::class)->group(function () {
    Route::get('/visit/all', 'VisitAll')->name('visit.all');
    Route::get('/visit/search', 'AdminVisitViewSearch')->name('admin.visit.search');
    Route::get('/visit/status-view/{id}', 'AdminVisitStatusView')->name('admin.visit.statusView');
    Route::get('/visit/{id}', 'AdminVisitId')->name('admin.visit.id');
    Route::get('/chart/unique-visitors', 'ChartUniqueVisitors')->name('admin.chart.unique.visitors');
    Route::get('/chart/visits', 'ChartVisits')->name('admin.chart.visits');
});


//Admin Login
//Route::get('login',[AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);