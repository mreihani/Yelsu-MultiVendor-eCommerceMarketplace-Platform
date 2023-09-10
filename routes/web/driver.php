<?php

use App\Http\Controllers\Backend\Driver\DriverController;

//Driver Dashboard
Route::get('dashboard', [DriverController::class, 'DriverDashboard'])->name('driver.dashboard');
Route::get('logout', [DriverController::class, 'DriverDestroy'])->name('driver.logout');
Route::get('profile', [DriverController::class, 'DriverProfile'])->name('driver.profile');
Route::get('settings', [DriverController::class, 'DriverProfileSettings'])->name('driver.profileSettings');
Route::post('profile/store', [DriverController::class, 'DriverProfileStore'])->name('driver.profile.store');
Route::get('profile-field-of-activity', [DriverController::class, 'profileFieldOfActivity'])->name('driver.profileFieldOfActivity');
Route::post('profile-field-of-activity-store', [DriverController::class, 'profileFieldOfActivityStore'])->name('driver.profileFieldOfActivity.store');

// fincancial statement section
Route::get('financialStatement', [DriverController::class, 'DriverProfileFinancialStatement'])->name('driver.profileFinancialStatement');
Route::post('financialStatement/store', [DriverController::class, 'DriverProfileFinancialStatementStore'])->name('driver.profileFinancialStatement.store');

Route::middleware(['driveraccess'])->group(function () {
    Route::controller(DriverController::class)->group(function () {
        //Driver About All Route
        Route::get('about', 'DriverAboutPage')->name('driver.about');
        Route::post('about/store', 'DriverStoreAboutPage')->name('driver.about.store');

        // File management all route
        Route::get('media/files', 'DriverMediaFiles')->name('driver.media.files');
        Route::get('media/addfiles', 'DriverMediaAddFiles')->name('driver.media.add');
        Route::post('media/storefiles', 'DriverMediaStoreFiles')->name('driver.media.store');
        Route::get('media/delete/{id}', 'DriverDeleteFile')->name('driver.media.delete');
    });

});