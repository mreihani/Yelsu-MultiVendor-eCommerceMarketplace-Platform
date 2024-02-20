<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';


Route::get('changeDatabase', function () {

    ini_set('max_execution_time', 1800);
    App\Models\Product::chunk(1000, function($products) {
        foreach ($products as $product) {
           if($product->determine_product_related_user_object() == 1) {
                $product->product_verification = 'active';
                $product->save();
            }
        }
    });

});