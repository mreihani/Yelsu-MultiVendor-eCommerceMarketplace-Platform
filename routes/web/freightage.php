<?php

use App\Http\Controllers\Backend\Freightage\FreightageController;
use App\Http\Controllers\Backend\Freightage\FreightageToVendorInvitationController;

//Freightage Dashboard
Route::get('dashboard', [FreightageController::class, 'FreightageDashboard'])->name('freightage.dashboard');
Route::get('logout', [FreightageController::class, 'FreightageDestroy'])->name('freightage.logout');
Route::get('profile', [FreightageController::class, 'FreightageProfile'])->name('freightage.profile');
Route::get('settings', [FreightageController::class, 'FreightageProfileSettings'])->name('freightage.profileSettings');
Route::post('profile/store', [FreightageController::class, 'FreightageProfileStore'])->name('freightage.profile.store');
Route::get('profile-field-of-activity', [FreightageController::class, 'profileFieldOfActivity'])->name('freightage.profileFieldOfActivity');
Route::post('profile-field-of-activity-store', [FreightageController::class, 'profileFieldOfActivityStore'])->name('freightage.profileFieldOfActivity.store');

// fincancial statement section
Route::get('financialStatement', [FreightageController::class, 'FreightageProfileFinancialStatement'])->name('freightage.profileFinancialStatement');
Route::post('financialStatement/store', [FreightageController::class, 'FreightageProfileFinancialStatementStore'])->name('freightage.profileFinancialStatement.store');

Route::middleware(['freightageaccess'])->group(function () {

    Route::controller(FreightageController::class)->group(function () {
        //Freightage About All Route
        Route::get('about', 'FreightageAboutPage')->name('freightage.about');
        Route::post('about/store', 'FreightageStoreAboutPage')->name('freightage.about.store');

        // File management all route
        Route::get('media/files', 'FreightageMediaFiles')->name('freightage.media.files');
        Route::get('media/addfiles', 'FreightageMediaAddFiles')->name('freightage.media.add');
        Route::post('media/storefiles', 'FreightageMediaStoreFiles')->name('freightage.media.store');
        Route::get('media/delete/{id}', 'FreightageDeleteFile')->name('freightage.media.delete');
    });
    
    Route::controller(FreightageToVendorInvitationController::class)->group(function () {
        // Freightage to Vendor Cooperation Request
        Route::get('all/vendor-request', 'FreightageAllVendorRequest')->name('freightage.all.vendor-request');
        Route::get('add/vendor-request', 'FreightageAddVendorRequest')->name('freightage.add.vendor-request');
        Route::post('store/vendor-request', 'FreightageStoreVendorRequest')->name('freightage.store.vendor-request');
        Route::get('edit/vendor-request/{invitation}', 'FreightageEditVendorRequest')->name('freightage.edit.vendor-request');
        Route::post('update/vendor-request', 'FreightageUpdateVendorRequest')->name('freightage.update.vendor-request');
        Route::get('delete/vendor-request/{invitation}', 'FreightageDeleteVendorRequest')->name('freightage.delete.vendor-request');
    });

});