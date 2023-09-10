<?php

use App\Http\Controllers\GeomarketingController;

// Geo Marketing All route
Route::post('/sendcorrdinates', [GeomarketingController::class, 'sendCoords'])->name('geo.send.coords');