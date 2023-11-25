<?php



use Illuminate\Support\Facades\Auth;
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


// Route::get('changeDatabase', function () {

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


    // $all_products = App\Models\Product::all();
    // foreach ($all_products as $product) {
    //     $user_id = $product->determine_product_related_user_object();

    //     if(App\Models\User::find($user_id)->role == "admin" || App\Models\User::find($user_id)->role == "specialist") {
    //         $product->owner_id = 1;
    //         $product->save();
    //     }
        
        
    // }
    


    
        


       
// });