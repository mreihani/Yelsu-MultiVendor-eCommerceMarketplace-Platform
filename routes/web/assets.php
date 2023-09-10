<?php

use App\Http\Controllers\Frontend\AssetController;
use Illuminate\Support\Facades\Route;

Route::get('assets/{role}/{user_id}/{file}', AssetController::class)->name('assets');