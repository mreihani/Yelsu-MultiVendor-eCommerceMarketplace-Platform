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

//     ini_set('max_execution_time', 1800);
//     App\Models\Product::chunk(1000, function($products) {
//         foreach ($products as $product) {
//             $product->selling_price = 0;
//             $product->save();
//         }
//     });

    $response = Illuminate\Support\Facades\Http::post('https://sep.shaparak.ir/onlinepg/onlinepg', [
        "action" => "token",
        "TerminalId" => "13062424",
        "Amount" => 12000,
        "ResNum" => "1qaz@WSX",
        "RedirectUrl" => "http://yelsu.com",
        "CellNumber" => "9120000000"
    ]);

    dd($response->body());

});