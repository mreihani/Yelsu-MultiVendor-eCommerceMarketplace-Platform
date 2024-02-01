<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Services\BankGatewayServices\SepGatewayService;




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

//     ini_set('max_execution_time', 1800);
//     App\Models\Product::chunk(1000, function($products) {
//         foreach ($products as $product) {
//             $product->selling_price = 0;
//             $product->save();
//         }
//     });
   
dd(SepGatewayService::verify("GmshtyjwKStvHnxdNFkAKXb30T2YAAIMGQJY3gFF1r"));

});