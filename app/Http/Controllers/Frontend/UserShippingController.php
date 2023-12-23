<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Useroutlets;
use Illuminate\Http\Request;
use App\Models\Freightagetype;
use App\Http\Controllers\Controller;
use App\Models\Freightageloadertype;
use Stevebauman\Purify\Facades\Purify;
use App\Services\NeshanServices\NeshanApiService;

class UserShippingController extends Controller
{
    public function ShippingDetails($id) {

        $userData = auth()->user();
        $user_id = $userData->id;

        $order = Order::findOrFail(Purify::clean($id));

        // products with lazy loading
        $products = $order->products()->get();

        // products with eager loading
        // $products = Order::where("id",Purify::clean($id))
        // ->with(["products", "products.determine_product_owner", "products.determine_product_owner.vendor_outlets"])
        // ->first()
        // ->products;

        if ($order->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'سفارش یافت نشد.');
        }

        return view('frontend.dashboard.shipping-details', compact('userData', 'order', 'products'));
    }

    public function GetAddressAjax(Request $request, NeshanApiService $neshanApiService) {

        $outlet_id = Purify::clean($request->outlet_id);
        $user_outlet_id = Purify::clean($request->user_outlet_id);

        if($outlet_id == 0 || $user_outlet_id == 0) {
            return;
        }

        $vendor_outlet = Outlet::findOrFail($outlet_id, ["id","shop_address", "latitude", "longitude"]);
        $user_outlet = Useroutlets::findOrFail($user_outlet_id, ["id","address", "latitude", "longitude"]);

        $origin = array('lt' => $vendor_outlet->latitude, 'ln' => $vendor_outlet->longitude);
        $destination = array('lt' => $user_outlet->latitude, 'ln' => $user_outlet->longitude);

        $neshan_response = $neshanApiService->GetCoordsDistance($origin, $destination);
        $image_arc_src = $neshanApiService->GetNeshanArcMapImage($origin, $destination);

        return response(["user_outlet" => $user_outlet, "vendor_outlet" => $vendor_outlet, "neshan_response" => $neshan_response, "image_arc_src" => $image_arc_src]);
    }

    public function GetFreightageInformationAjax(Request $request) {
        $freightage_id = Purify::clean($request->freightage_id);
        $freightage_obj = User::find($freightage_id)->verified_freightages_with_freightage_id->first()->getFreightageTypeParent();

        // اینجا موارد نوع ارسال کالا که روی این محصول ست شده رو آی دی آن را به صورت آرایه استخراج می کند که با موارد شرکت باربری هم پوشانی کند
        $product_id = Purify::clean($request->product_id);

        $freightagetype_id_from_product = [];
        foreach (Product::find($product_id)->freightageloadertype as $freightageloadertype_item) {
            $freightagetype_id_from_product[] = $freightageloadertype_item->freightageType->id;
        }

        $freightage_obj_filtered = [];
        foreach ($freightage_obj as $freightage_item) {
            if(in_array($freightage_item->id, $freightagetype_id_from_product)) {
                $freightage_obj_filtered[] = $freightage_item;
            }
        }
        // اینجا موارد نوع ارسال کالا که روی این محصول ست شده رو آی دی آن را به صورت آرایه استخراج می کند که با موارد شرکت باربری هم پوشانی کند

        return response(['freightage_obj_filtered' => $freightage_obj_filtered]);
    }

    public function GetFreightageLoaderTypeAjax(Request $request) {
        $type_id = Purify::clean($request->type_id);
        $freightage_id = Purify::clean($request->freightage_id);

        $freightageTypeItem = Freightagetype::find($type_id);
        $freightagetype_title = $freightageTypeItem->freightagetype_title;
        
        if($freightagetype_title == "road") {
            $freightage_loader_type = User::find($freightage_id)->freightage->freightage_loader_type;
            $freightage_loader_type_array = explode(",", $freightage_loader_type);
        } elseif($freightagetype_title == "rail") {
            $freightage_loader_type_rail = User::find($freightage_id)->freightage->freightage_loader_type_rail;
            $freightage_loader_type_array = explode(",", $freightage_loader_type_rail);
        } elseif($freightagetype_title == "sea") {
            $freightage_loader_type_sea = User::find($freightage_id)->freightage->freightage_loader_type_sea;
            $freightage_loader_type_array = explode(",", $freightage_loader_type_sea);
        } elseif($freightagetype_title == "air") {
            $freightage_loader_type_air = User::find($freightage_id)->freightage->freightage_loader_type_air;
            $freightage_loader_type_array = explode(",", $freightage_loader_type_air);
        }

        // اینجا موارد نوع بارگیر که روی این محصول ست شده رو آی دی آن را به صورت آرایه استخراج می کند که با موارد شرکت باربری هم پوشانی کند
        $product_id = Purify::clean($request->product_id);
        $freightageloadertype_object_from_product = Product::find($product_id)->freightageloadertype;

        $freightage_loader_type_last_items_filtered = [];
        foreach ($freightageloadertype_object_from_product as $freightageloadertype_item_from_product) {
            if(in_array($freightageloadertype_item_from_product->id, $freightage_loader_type_array)) {
                $freightage_loader_type_last_items_filtered[] = $freightageloadertype_item_from_product;
            }
        }
        // اینجا موارد نوع بارگیر که روی این محصول ست شده رو آی دی آن را به صورت آرایه استخراج می کند که با موارد شرکت باربری هم پوشانی کند

        return response($freightage_loader_type_last_items_filtered);
    }

}
