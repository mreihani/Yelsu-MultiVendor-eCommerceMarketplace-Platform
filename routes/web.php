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

//     ini_set('max_execution_time', 1800);
//     App\Models\Product::chunk(1000, function($products) {
//         foreach ($products as $product) {
//             $product_currency = $product->determine_product_currency();
//             if($product_currency != null && $product_currency != "تومان") {
//                 $product->trading_method = "export";
//                 $product->save();
//             }
//         }
//     });

    $specialist_all_related_children_id = App\Models\Category::where("id",1)->first()->allChildrenIds();
    dd(
        //App\Models\Category::where("id", 167)->first()->allChildren()
        //App\Models\Attribute::where("category_id", [$specialist_all_related_children_id])->get()
        App\Models\Attribute::find($specialist_all_related_children_id)
    );

});