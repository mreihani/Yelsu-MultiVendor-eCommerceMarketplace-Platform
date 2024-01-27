<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Order;
use App\Models\Fparam;
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
    public function ShippingProduct($id) {

        $userData = auth()->user();
        $user_id = $userData->id;

        $order = Order::findOrFail(Purify::clean($id));

        $products = $order->products()->get();

        if ($order->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'سفارش یافت نشد.');
        }

        return view('frontend.dashboard.shipping-product', compact('userData', 'order', 'products'));
    }

    public function ShippingDetails($orderId, $productId) {
        $userData = auth()->user();
        $user_id = $userData->id;

        $order = Order::find(Purify::clean($orderId));
        $product = $order->products()->where('product_id', $productId)->first();

        if ($order->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'سفارش یافت نشد.');
        }

        return view('frontend.dashboard.shipping-details', compact('userData', 'order', 'product'));
    }

    // این متد برای متد GetAddressAjax استفاده میشود 
    private function calculatePriceOnDistance($neshan_response, $selected_loader_type_id) {
        // دریاقت ضرایب حمل
        $road_toll = Fparam::where("keyword", "road_toll")->first()->value;
        $yelsu_commission = Fparam::where("keyword", "yelsu_commission")->first()->value;
        $freight_commission = Fparam::where("keyword", "freight_commission")->first()->value;
        $value_added = Fparam::where("keyword", "value_added")->first()->value;
        $cargo_insurance = Fparam::where("keyword", "cargo_insurance")->first()->value;
        $value_added_insurance = Fparam::where("keyword", "value_added_insurance")->first()->value;
        $ad_insurance_driver = Fparam::where("keyword", "ad_insurance_driver")->first()->value;
        $loading = Fparam::where("keyword", "loading")->first()->value;
        $plus = Fparam::where("keyword", "plus")->first()->value;
        $bad_road = Fparam::where("keyword", "bad_road")->first()->value;

        $distance_by_kmeters = json_decode($neshan_response)->rows[0]->elements[0]->distance->value / 1000;
        if($selected_loader_type_id) {
            $selected_freightage_loader_type_obj = Freightageloadertype::find($selected_loader_type_id);
            $freight_per_ton_currency = $selected_freightage_loader_type_obj->freight_per_ton_currency;
            // $freight_per_ton_intracity = $selected_freightage_loader_type_obj->freight_per_ton_intracity;
            $freight_per_ton_intercity = $selected_freightage_loader_type_obj->freight_per_ton_intercity;
            // $freight_per_ton_rail = $selected_freightage_loader_type_obj->freight_per_ton_rail;
            // $freight_per_ton_sea = $selected_freightage_loader_type_obj->freight_per_ton_sea;
            // $freight_per_kg_air = $selected_freightage_loader_type_obj->freight_per_kg_air;
            // $freight_per_kg_post = $selected_freightage_loader_type_obj->freight_per_kg_post;

            $freight_max_capacity = $selected_freightage_loader_type_obj->max_capacity;

            $shipping_price = ($distance_by_kmeters * $freight_per_ton_intercity) * ($freight_max_capacity / 1000);
            $final_price = $shipping_price
            + ($shipping_price * $road_toll)/100
            + ($shipping_price * $yelsu_commission)/100 
            + ($shipping_price * $freight_commission)/100
            + ($shipping_price * $value_added)/100
            + ($shipping_price * $cargo_insurance)/100
            + ($shipping_price * $value_added_insurance)/100
            + ($shipping_price * $ad_insurance_driver)/100
            + ($shipping_price * $loading)/100
            + ($shipping_price * $plus)/100
            + ($shipping_price * $bad_road)/100;

            return $shipping_calculations = array(
                "currency" => $freight_per_ton_currency,
                "price" => ceil($final_price),
            );
        } 
    }

    public function GetAddressAjax(Request $request, NeshanApiService $neshanApiService) {

        $outlet_id = Purify::clean($request->outlet_id);
        $user_outlet_id = Purify::clean($request->user_outlet_id);
        $selected_loader_type_id = Purify::clean($request->selected_loader_type_id);

        if($outlet_id == 0 || $user_outlet_id == 0) {
            return;
        }

        $vendor_outlet = Outlet::findOrFail($outlet_id, ["id","shop_address", "latitude", "longitude"]);
        $user_outlet = Useroutlets::findOrFail($user_outlet_id, ["id","address", "latitude", "longitude"]);

        $origin = array('lt' => $vendor_outlet->latitude, 'ln' => $vendor_outlet->longitude);
        $destination = array('lt' => $user_outlet->latitude, 'ln' => $user_outlet->longitude);

        $neshan_response = $neshanApiService->GetCoordsDistance($origin, $destination);
        $image_arc_src = $neshanApiService->GetNeshanArcMapImage($origin, $destination);

        // بخش محاسبه قیمت بر اساس مسافت طی شده
        $shipping_calculations = $this->calculatePriceOnDistance($neshan_response, $selected_loader_type_id);

        return response([
            "user_outlet" => $user_outlet,
            "vendor_outlet" => $vendor_outlet,
            "neshan_response" => $neshan_response, 
            "image_arc_src" => $image_arc_src,
            "shipping_calculations" => $shipping_calculations,
        ]);
    }

    public function GetFreightageInformationAjax(Request $request) {
        $freightage_id = Purify::clean($request->freightage_id);
        $numberItemsRequest = (int) Purify::clean($request->numberItemsRequest);

        if($freightage_id == 0) {
            return;
        }
        
        // Get the freightage type
        $freightage_obj = User::find($freightage_id)->verified_freightages_with_freightage_id->first()->getFreightageTypeParent();

        // اینجا موارد نوع ارسال کالا که روی این محصول ست شده رو آی دی آن را به صورت آرایه استخراج می کند که با موارد شرکت باربری هم پوشانی کند
        $product_id = Purify::clean($request->product_id);

        // Find the product and its related freightage load type
        $productObj = Product::find($product_id);
        $freightageloadertype = $productObj->freightageloadertype;

        $freightagetype_id_from_product = [];
        // Iterate through each freightageloadertype item
        foreach ($freightageloadertype as $freightageloadertypeItem) {
            // Check if the number of items requested falls within the loader type range
            if($freightageloadertypeItem->loader_type_min <= $numberItemsRequest && $freightageloadertypeItem->loader_type_max >= $numberItemsRequest) {
                // Find the outlet based on the origin_loadertype_outlet and add it to the filtered array
                $freightagetype_id_from_product[] = $freightageloadertypeItem->loader_type->freightageType->id;;
            }
        }

        $freightage_obj_filtered = [];
        foreach ($freightage_obj as $freightage_item) {
            if(in_array($freightage_item->id, $freightagetype_id_from_product)) {
                $freightage_obj_filtered[] = $freightage_item;
            }
        }
        

        return response(['freightage_obj_filtered' => $freightage_obj_filtered]);
    }

    public function GetFreightageLoaderTypeAjax(Request $request) {
        $type_id = Purify::clean($request->type_id);
        $freightage_id = Purify::clean($request->freightage_id);
        $outlet_id = Purify::clean($request->outlet_id);
        $freightageTypeItem = Freightagetype::find($type_id);
        $freightagetype_title = $freightageTypeItem->freightagetype_title;
        $numberItemsRequest = (int) Purify::clean($request->numberItemsRequest);
        
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
        $product_obj = Product::find($product_id);
        $freightageloadertype_object_from_product = $product_obj->freightageloadertype;

        $order_id = Purify::clean($request->order_id);
        $order_quantity = $product_obj->orders()->where("order_id", $order_id)->first()->pivot->quantity;

        $freightage_loader_type_last_items_filtered = [];
        foreach ($freightageloadertype_object_from_product as $freightageloadertype_item_from_product) {
            if(
                in_array($freightageloadertype_item_from_product->loader_type->id, $freightage_loader_type_array)
                && ((int) $freightageloadertype_item_from_product->loader_type_min <= $order_quantity)
                && ((int) $outlet_id == (int) $freightageloadertype_item_from_product->origin_loadertype_outlet)
                && $freightageloadertype_item_from_product->loader_type_min <= $numberItemsRequest 
                && $freightageloadertype_item_from_product->loader_type_max >= $numberItemsRequest
            ) {
                $freightage_loader_type_last_items_filtered[] = $freightageloadertype_item_from_product->loader_type;
            }
        }

        return response($freightage_loader_type_last_items_filtered);
    }

    /**
     * Get filtered origin addresses via AJAX request
     *
     * @param Request $request The HTTP request
     * @return \Illuminate\Http\Response The filtered origin addresses
     */
    public function getOriginAddressesFilteredAjax(Request $request)
    {
        // Clean and retrieve request parameters
        $numberItemsRequest = (int) Purify::clean($request->numberItemsRequest);
        $productId = (int) Purify::clean($request->product_id);
        $orderId = (int) Purify::clean($request->order_id);

        // Find the product and its related freightage load type
        $productObj = Product::find($productId);
        $freightageloadertype = $productObj->freightageloadertype;
        
        $filteredOriginOutletArray = [];
        // Iterate through each freightageloadertype item
        foreach ($freightageloadertype as $freightageloadertypeItem) {
            // Check if the number of items requested falls within the loader type range
            if($freightageloadertypeItem->loader_type_min <= $numberItemsRequest && $freightageloadertypeItem->loader_type_max >= $numberItemsRequest) {
                // Find the outlet based on the origin_loadertype_outlet and add it to the filtered array
                $filteredOriginOutletArray[] = Outlet::find($freightageloadertypeItem->origin_loadertype_outlet, ['id', 'shop_name', 'shop_address']);
            }
        }

        // Remove duplicates
        $filteredOriginOutletArray = array_map("unserialize", array_unique(array_map("serialize", $filteredOriginOutletArray))); 

        // Return the response
        return response(array_unique($filteredOriginOutletArray));
    }

    /**
     * Get filtered freightage company data through AJAX request
     *
     * @param Request $request The request object
     * @return \Illuminate\Http\JsonResponse The JSON response
     */
    public function getFreightageCompanyFilteredAjax(Request $request)
    {
        // Clean and retrieve request parameters
        $numberItemsRequest = (int) Purify::clean($request->numberItemsRequest);
        $productId = (int) Purify::clean($request->product_id);
        $orderId = (int) Purify::clean($request->order_id);

        // Find the product and its related freightage load type
        $productObj = Product::find($productId);
        $freightageloadertype = $productObj->freightageloadertype;
        
        // Initialize an empty array to store freightage company data
        $freightageCompanyArray = [];
        
        // Get the verified freightages with vendor ID from the product object
        $verifiedFreightagesWithVendorId = $productObj->determine_product_owner->verified_freightages_with_vendor_id;
        
        // Iterate through the verified freightages and add them to the freightage company array
        foreach ($verifiedFreightagesWithVendorId as $key => $verifiedFreightagesWithVendorItem) {
            $freightageCompanyArray[] = $verifiedFreightagesWithVendorItem;
        }

        // Initialize an empty array to store filtered freightage loader types
        $filteredFreightageLoaderTypeArray = [];
        
        // Iterate through each freightage loader type
        foreach ($freightageloadertype as $freightageloadertypeItem) {
            // Check if the loader type min is less than or equal to the number of items requested
            // and the loader type max is greater than or equal to the number of items requested
            if ($freightageloadertypeItem->loader_type_min <= $numberItemsRequest &&
                $freightageloadertypeItem->loader_type_max >= $numberItemsRequest) {
                // If the condition is met, add the freightage loader type ID to the filtered array
                $filteredFreightageLoaderTypeArray[] = $freightageloadertypeItem->freightageloadertype_id;
            }
        }

        // Initialize an empty array to store filtered freightage company data
        $filteredFreightageCompanyArray = [];

        // Iterate through each freightage company
        foreach ($freightageCompanyArray as $freightageCompanyItem) {

            // road loader type
            $freightageLoaderTypeArrayRoad = explode(",", $freightageCompanyItem->freightage->freightage->freightage_loader_type);
            // Iterate through each freightage loader type
            foreach ($freightageLoaderTypeArrayRoad as $freightageLoaderTypeItem) {
                // Check if the loader type is in the filtered array
                if(in_array($freightageLoaderTypeItem, $filteredFreightageLoaderTypeArray)) {
                    // Add relevant information to the filtered freightage company array
                    $filteredFreightageCompanyArray[] = array(
                        'id' => $freightageCompanyItem->freightage->id, 
                        'shop_name' => $freightageCompanyItem->freightage->shop_name
                    );
                    // Exit the loop after adding one item
                    break;
                }
            }

            // air loader type
            // Split the string by comma and store the result in an array
            $freightageLoaderTypeArrayAir = explode(",", $freightageCompanyItem->freightage->freightage->freightage_loader_type_air);
            // Iterate through each item in the array
            foreach ($freightageLoaderTypeArrayAir as $freightageLoaderTypeItem) {
                // Check if the item exists in the filtered array
                if(in_array($freightageLoaderTypeItem, $filteredFreightageLoaderTypeArray)) {
                    // Add the freightage company details to the filtered array and break the loop
                    $filteredFreightageCompanyArray[] = array(
                        'id' => $freightageCompanyItem->freightage->id, 
                        'shop_name' => $freightageCompanyItem->freightage->shop_name
                    );
                    break;
                }
            }

            // sea loader type
            // Split the string into an array using comma as the delimiter
            $freightageLoaderTypeArraySea = explode(",", $freightageCompanyItem->freightage->freightage->freightage_loader_type_sea);
            
            // Iterate through each item in the array
            foreach ($freightageLoaderTypeArraySea as $freightageLoaderTypeItem) {
                // Check if the current item is in the filteredFreightageLoaderTypeArray
                if (in_array($freightageLoaderTypeItem, $filteredFreightageLoaderTypeArray)) {
                    // Add freightage company details to the filteredFreightageCompanyArray and break the loop
                    $filteredFreightageCompanyArray[] = array(
                        'id' => $freightageCompanyItem->freightage->id, 
                        'shop_name' => $freightageCompanyItem->freightage->shop_name
                    );
                    break;
                }
            }

            // rail loader type
            // Explode the string by comma to get an array of rail freightage loader types
            $freightageLoaderTypeArrayRail = explode(",", $freightageCompanyItem->freightage->freightage->freightage_loader_type_rail);
            // Iterate through each rail freightage loader type
            foreach ($freightageLoaderTypeArrayRail as $freightageLoaderTypeItem) {
                // Check if the rail freightage loader type is in the filtered array
                if(in_array($freightageLoaderTypeItem, $filteredFreightageLoaderTypeArray)) {
                    // Add the freightage company details to the filtered array
                    $filteredFreightageCompanyArray[] = array(
                        'id' => $freightageCompanyItem->freightage->id, 
                        'shop_name' => $freightageCompanyItem->freightage->shop_name
                    );
                    // Break the loop after adding the details
                    break;
                }
            }

        }

        // Return the response
        return response($filteredFreightageCompanyArray);
    }

}
