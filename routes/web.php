<?php



use App\Models\Product;
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

    // $all_users = App\Models\User::all();
    // foreach ($all_users as $value) {
    //     // FIX - ISSUE in USERNAME
    //     if (str_contains($value->username, '-')) {
    //         $username2 = str_replace("-", "_", $value->username);
    //         $value->username = $username2;
    //         $value->save();
    //     }

    //     // LOWER CASE USERNAME
    //     $username2 = strtolower($value->username);
    //     $value->username = $username2;
    //     $value->save();
    // }

    ini_set('max_execution_time', 180);
    App\Models\Product::chunk(1000, function($products) {
        foreach ($products as $product) {
            if($product->determine_product_currency() != null && $product->determine_product_currency() != "تومان") {
            
                $product->trading_method = "export";
                $product->save();
            }
        }
    });
    

});