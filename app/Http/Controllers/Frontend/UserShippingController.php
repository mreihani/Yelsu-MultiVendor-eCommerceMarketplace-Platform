<?php

namespace App\Http\Controllers\Frontend;


use App\Models\User;
use App\Models\Order;
use App\Models\Fparam;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Useroutlets;
use Illuminate\Http\Request;
use App\Models\OrderVproduct;
use App\Models\Freightagetype;
use App\Http\Controllers\Controller;
use App\Models\Freightageloadertype;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use App\Services\NeshanServices\NeshanApiService;
use Illuminate\Support\Facades\File as LaravelFile;

class UserShippingController extends Controller
{
    public function ShippingProduct($id) {

        $userData = auth()->user();
        $user_id = $userData->id;

        $order = Order::findOrFail(Purify::clean($id));
        
        $order_vproducts = $order->vproducts;

        if ($order->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'سفارش یافت نشد.');
        }

        return view('frontend.dashboard.shipping-product', compact('userData', 'order', 'order_vproducts'));
    }

    public function ShippingDetails(Request $request, OrderVproduct $vproducts) {

        $userData = auth()->user();
        $user_id = $userData->id;

        $order = Order::find($vproducts->order_id);
        
        $product = $vproducts->products->first();

        if ($order->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'سفارش یافت نشد.');
        }

        // Get shipping details
        $shipping = $vproducts->shipping;

        // Create array of json for shipping-row-object-json
        $shippingItemsJsonArray = $this->setJsonShippingRow($shipping);

        // Create array of items for each table row
        $shippingItemRowArray = $this->getRowInformation($shipping);

        // Calculate remaining order qualtity for shipping
        if(!count($shipping)) {
            $remainingShippingQuantity = $vproducts->quantity;
        } else {
            $remainingShippingQuantity = $vproducts->quantity - $shipping->sum('number_of_request_input');
        }
    
        return view('frontend.dashboard.shipping-details', compact(
            'userData',
            'order',
            'product',
            'vproducts',
            'shipping', 
            'shippingItemsJsonArray',
            'shippingItemRowArray',
            'remainingShippingQuantity'
        ));
    }
        
    /**
     * Retrieves information from the shipping items and returns it in an array format.
     *
     * @param array $shipping The array of shipping items
     * @return array The array of shipping item information
     */
    protected function getRowInformation($shipping) {
        // Initialize an empty array to store shipping items in JSON format
        $shippingItemRowArray = [];

        // Loop through each shipping item and extract relevant information
        foreach ($shipping as $shippingItem) {
            // Get selected order origin address
            $order_origin_address = collect(json_decode($shippingItem->order_origin_address))->filter(function($value, int $key) {
                return $value->selected;
            });

            // Get selected order destination address
            $order_destination_address = collect(json_decode($shippingItem->order_destination_address))->filter(function($value, int $key) {
                return $value->selected;
            });

            // Get selected freightage information
            $freightage_information = collect(json_decode($shippingItem->freightage_information))->filter(function($value, int $key) {
                return $value->selected;
            });

            // Get selected freightage activity field
            $freightage_activity_field = collect(json_decode($shippingItem->freightage_activity_field))->filter(function($value, int $key) {
                return $value->selected;
            });

            // Get selected freightage loadertype
            $freightage_loadertype = collect(json_decode($shippingItem->freightage_loadertype))->filter(function($value, int $key) {
                return $value->selected;
            });

            // Add the extracted information to the shipping item array
            $shippingItemRowArray[] = array(
                'row_id' => $shippingItem->selected_row_id,
                'order_origin_address' => $order_origin_address->first()->value,
                'order_destination_address' => $order_destination_address->first()->value,
                'freightage_information' => $freightage_information->first()->value,
                'freightage_activity_field' => $freightage_activity_field->first()->value,
                'freightage_loadertype' => $freightage_loadertype->first()->value,
                'deliverDateInputValue' => $shippingItem->deliver_date_input,
                'number_of_request_input' => $shippingItem->number_of_request_input,
                'shipping_status' => $shippingItem->shipping_status == 'processing' ? 'پرداخت شده و در حال ارسال' : 'ارسال شده',
            );
        }

        // Return the array of shipping item information
        return $shippingItemRowArray;
    }

    /**
     * Converts shipping data to JSON format and encodes ARC image to base64.
     *
     * @param array $shipping Array of shipping data
     *
     * @return array Array of shipping data in JSON format
     */
    protected function setJsonShippingRow($shipping) {
        // Initialize an empty array to store shipping items in JSON format
        $shippingItemsJsonArray = [];

        // Loop through each shipping item
        foreach ($shipping as $shippingItem) {
            
            // Encode ARC image to base64
            $base64 = 'data:image/png;base64,' . base64_encode(file_get_contents($shippingItem->neshan_arc_image_src));

            // Get Origin Address HTML
            $originAddressHTML = Outlet::find($shippingItem->selected_order_origin_address_id)->shop_address;

            // Get Destination Address HTML
            $destinationAddressHTML = Useroutlets::find($shippingItem->selected_order_destination_address_id)->address;

            // Get shipping distance text
            $shippingDistanceText = $shippingItem->distance_by_kilometer . ' کیلومتر ';
            
            // Get shipping price text
            $shippingPriceCurrency = $shippingItem->shipping_price_currency == 'toman' ? 'تومان' : 'دلار';
            $shippingPriceText = number_format($shippingItem->shipping_price, 0, '', ',') . ' ' . $shippingPriceCurrency;
            
            // Create an array for the shipping item
            $rowItemArray = [
                'order_origin_address_obj_array' => json_decode($shippingItem->order_origin_address),
                'order_destination_address_obj_array' => json_decode($shippingItem->order_destination_address),
                'freightage_information_obj_array' => json_decode($shippingItem->freightage_information),
                'freightage_activity_field_obj_array' => json_decode($shippingItem->freightage_activity_field),
                'freightage_loader_type_obj_array' => json_decode($shippingItem->freightage_loadertype),
                'deliverDateInputValue' => $shippingItem->deliver_date_input,
                'order_origin_address_html' => $originAddressHTML,
                'order_destination_address_html' => $destinationAddressHTML,
                'shipping_distance_text' => $shippingDistanceText,
                'shipping_price_text' => $shippingPriceText,
                'neshan_arc_image_src' => $base64,
                'numberOfRequestInput' => $shippingItem->number_of_request_input,
            ];

            // Encode the shipping item array to JSON and add it to the shippingItemsJsonArray
            $shippingItemsJsonArray[] = json_encode($rowItemArray);
        }

        // Return the array of shipping data in JSON format
        return $shippingItemsJsonArray;
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
        $productOutletId = (int) Purify::clean($request->productOutletId) ?: null;
        
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

        $order_id = (int) Purify::clean($request->order_id);
        $order_quantity = (int) $product_obj->vproducts()->where("order_id", $order_id)->where("outlet_id", $productOutletId)->first()->quantity;

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

    /**
     * Sends an AJAX request with shipping details item.
     *
     * @param Request $request 
     * @return mixed
     */
    function sendShippingDetailsItemAjax(Request $request) {
        // Clean the shipping row object JSON
        $shippingRowObjectJson = Purify::clean($request->shippingRowObjectJson);

        // Get row id
        $selectedRowId = (int) Purify::clean($request->selectedRowId);

        // Validate row id
        if($selectedRowId == null || $selectedRowId == '' || !is_integer($selectedRowId) || $selectedRowId == 0) {
           return;
        }

        // Get row id
        $order_vproduct_id = (int) Purify::clean($request->order_vproduct_id);

        // Validate row id
        if($order_vproduct_id == null || $order_vproduct_id == '' || !is_integer($order_vproduct_id) || $order_vproduct_id == 0) {
           return;
        }
        
        // Decode the shipping row object JSON
        $shippingRowObject = json_decode($shippingRowObjectJson);

        // Extract order origin address object array
        $orderOriginAddressObjectArray = $shippingRowObject->order_origin_address_obj_array;

        // Find selected origin address id
        $selectedOrderOriginAddressId = null;
        foreach ($orderOriginAddressObjectArray as $orderOriginAddressObjectItem) {
            if($orderOriginAddressObjectItem->selected) {
                $selectedOrderOriginAddressId = (int) $orderOriginAddressObjectItem->id;
            }
        }

        // Validate selectedOrderOriginAddressId
        if($selectedOrderOriginAddressId == null || $selectedOrderOriginAddressId == '' || !is_integer($selectedOrderOriginAddressId) || $selectedOrderOriginAddressId == 0) {
            return;
        }

        // Extract order destination address object array
        $orderDestinationAddressObjectArray = $shippingRowObject->order_destination_address_obj_array;

        // Find selected destination address id
        $selectedOrderDestinationAddressId = null;
        foreach ($orderDestinationAddressObjectArray as $orderDestinationAddressObjectItem) {
            if($orderDestinationAddressObjectItem->selected) {
                $selectedOrderDestinationAddressId = (int) $orderDestinationAddressObjectItem->id;
            }
        }

        // Validate selectedOrderDestinationAddressId
        if($selectedOrderDestinationAddressId == null || $selectedOrderDestinationAddressId == '' || !is_integer($selectedOrderDestinationAddressId) || $selectedOrderDestinationAddressId == 0) {
            return;
        }

        // Extract freightage information object array
        $freightageInformationObjArray = $shippingRowObject->freightage_information_obj_array;

        // Find selected freightage information id
        $selectedFreightageInformationId = null;
        foreach ($freightageInformationObjArray as $freightageInformationItem) {
            if($freightageInformationItem->selected) {
                $selectedFreightageInformationId = (int) $freightageInformationItem->id;
            }
        }

        // Validate selectedFreightageInformationId
        if($selectedFreightageInformationId == null || $selectedFreightageInformationId == '' || !is_integer($selectedFreightageInformationId) || $selectedFreightageInformationId == 0) {
            return;
        }

        // Extract freightage activity field object array
        $freightageActivityFieldObjArray = $shippingRowObject->freightage_activity_field_obj_array;

        // Find selected freightage activity field id
        $selectedFreightageActivityFieldId = null;
        foreach ($freightageActivityFieldObjArray as $freightageActivityFieldItem) {
            if($freightageActivityFieldItem->selected) {
                $selectedFreightageActivityFieldId = (int) $freightageActivityFieldItem->id;
            }
        }

        // Validate selectedFreightageActivityFieldId
        if($selectedFreightageActivityFieldId == null || $selectedFreightageActivityFieldId == '' || !is_integer($selectedFreightageActivityFieldId) || $selectedFreightageActivityFieldId == 0) {
            return;
        }

        // Extract freightage loader type object array
        $freightageLoaderTypeObjArray = $shippingRowObject->freightage_loader_type_obj_array;

        // Find selected freightage loader type id
        $selectedFreightageLoaderTypeId = null;
        foreach ($freightageLoaderTypeObjArray as $freightageLoaderTypeItem) {
            if($freightageLoaderTypeItem->selected) {
                $selectedFreightageLoaderTypeId = (int) $freightageLoaderTypeItem->id;
            }
        }

        // Validate selectedFreightageLoaderTypeId
        if($selectedFreightageLoaderTypeId == null || $selectedFreightageLoaderTypeId == '' || !is_integer($selectedFreightageLoaderTypeId) || $selectedFreightageLoaderTypeId == 0) {
            return;
        }

        // Extract deliver date input
        $deliver_date_input = $shippingRowObject->deliverDateInputValue;

        // Validate deliverDateInput
        if($deliver_date_input == null || $deliver_date_input == '' || $deliver_date_input == 0) {
            return;
        }

        // Extract number of request input
        $numberOfRequestInput = (int) $shippingRowObject->numberOfRequestInput;

        // Validate numberOfRequestInput
        if($numberOfRequestInput == null || $numberOfRequestInput == '' || !is_integer($numberOfRequestInput) || $numberOfRequestInput == 0) {
            return;
        }

        // Calculate distance between two addresses
        $calculatedDistance = $this->calculateDistance($selectedOrderOriginAddressId, $selectedOrderDestinationAddressId, $selectedFreightageLoaderTypeId);

        // Decode the calculated distance JSON
        $distanceByKilometer = (int) ceil(json_decode($calculatedDistance)->rows[0]->elements[0]->distance->value / 1000);
        
        // Break operation if neshan did not respond
        if($distanceByKilometer == 0
         || $distanceByKilometer == null
         || is_integer($distanceByKilometer) == false
         ) {
            return;
        }

        // Calculate the shipping cost based on the distance
        $shippingCost = $shippingPrice = $this->calculatePriceOnDistance($calculatedDistance, $selectedFreightageLoaderTypeId);

        // Get the user id from order table, check if user is eligible to update
        $user_id = OrderVproduct::findOrFail($order_vproduct_id)->order->user_id;
        if($user_id != auth()->user()->id) {
            return;
        }

        // Convert Base64 image to jpg and save it in storage
        $save_url = $this->convertBase64($shippingRowObject, $order_vproduct_id);

        $shippingDetailsArray = [
            'order_vproduct_id' => $order_vproduct_id,
            'selected_row_id' => $selectedRowId,
            'selected_order_origin_address_id' => $selectedOrderOriginAddressId,
            'order_origin_address' => json_encode($orderOriginAddressObjectArray),
            'selected_order_destination_address_id' => $selectedOrderDestinationAddressId,
            'order_destination_address' => json_encode($orderDestinationAddressObjectArray),
            'selected_freightage_information_id' => $selectedFreightageInformationId,
            'freightage_information' => json_encode($freightageInformationObjArray),
            'selected_freightage_activity_field_id' => $selectedFreightageActivityFieldId,
            'freightage_activity_field' => json_encode($freightageActivityFieldObjArray),
            'selected_freightage_loadertype_id' => $selectedFreightageLoaderTypeId,
            'freightage_loadertype' => json_encode($freightageLoaderTypeObjArray),
            'deliver_date_input' => $deliver_date_input,
            'number_of_request_input' => $numberOfRequestInput,
            'distance_by_kilometer' => $distanceByKilometer,
            'shipping_price' => $shippingCost['price'],
            'shipping_price_currency' => $shippingCost['currency'],
            'neshan_arc_image_src' => $save_url,
        ];

        // Save shipping details into DB
        $storeShippingDetails = $this->storeShippingDetails($shippingDetailsArray);

        // Return the number of request input as response
        return response($storeShippingDetails);
    }

    /**
     * Calculates the distance between two addresses and returns the shipping cost based on the distance.
     *
     * @param int $selectedOrderOriginAddressId The ID of the selected order's origin address
     * @param int $selectedOrderDestinationAddressId The ID of the selected order's destination address
     * @param int $selectedFreightageLoaderTypeId The ID of the selected freightage loader type
     *
     * @return float The shipping cost based on the distance
     */
    protected function calculateDistance($selectedOrderOriginAddressId, $selectedOrderDestinationAddressId, $selectedFreightageLoaderTypeId) {
        // Check if either of the selected addresses is not valid
        if ($selectedOrderOriginAddressId == 0 || $selectedOrderDestinationAddressId == 0) {
            return;
        }

        // Retrieve the latitude and longitude of the vendor outlet
        $vendor_outlet = Outlet::findOrFail($selectedOrderOriginAddressId, ["id", "latitude", "longitude"]);

        // Retrieve the latitude and longitude of the user outlet
        $user_outlet = Useroutlets::findOrFail($selectedOrderDestinationAddressId, ["id", "latitude", "longitude"]);

        // Create arrays for the origin and destination coordinates
        $origin = array('lt' => $vendor_outlet->latitude, 'ln' => $vendor_outlet->longitude);
        $destination = array('lt' => $user_outlet->latitude, 'ln' => $user_outlet->longitude);

        // Instantiate the NeshanApiService
        $neshanApiService = new NeshanApiService;

        // Get the distance between the origin and destination coordinates using Neshan API
        $neshan_response = $neshanApiService->GetCoordsDistance($origin, $destination);

        return $neshan_response;
    }

    /**
     * Convert base64 image to a jpg image and save it to the storage folder
     * 
     * @param object $shippingRowObject
     * @param int $order_vproduct_id
     * @return string|null
     */
    protected function convertBase64($shippingRowObject, $order_vproduct_id) {
        // Get the base64 encoded image source
        $neshan_arc_image_src = $shippingRowObject->neshan_arc_image_src;

        // Validate neshan arc image source
        if ($neshan_arc_image_src == null || $neshan_arc_image_src == '') {
            return null;
        }

        // Create a folder with the order_vproduct_id if it doesn't exist
        if (!LaravelFile::exists('storage/upload/shipping_map_images/' . $order_vproduct_id)) {
            LaravelFile::makeDirectory('storage/upload/shipping_map_images/' . $order_vproduct_id);
        }

        // Process the base64 image and save it as a jpg
        $image = str_replace('data:image/png;base64,', '', $neshan_arc_image_src);
        $image = str_replace(' ', '+', $image);
        $unique_image_name = hexdec(uniqid()) . time();
        $name_gen = $unique_image_name . '.' . 'jpg';
        Image::make($image)->fit(450, 450)->encode('jpg')->save('storage/upload/shipping_map_images/' . $order_vproduct_id . '/' . $name_gen);
        
        // Set the save url and return it
        $save_url = 'storage/upload/shipping_map_images/' . $order_vproduct_id . '/' . $name_gen;
        return $save_url;
    }

    /**
     * Store shipping details in the database.
     *
     * @param  array  $shippingDetailsArray
     * @return bool
     */
    protected function storeShippingDetails($shippingDetailsArray) {

        // Check if image exists and delete it
        $shippingItemExists = Shipping::where('selected_row_id', $shippingDetailsArray['selected_row_id'])
        ->where('order_vproduct_id', $shippingDetailsArray['order_vproduct_id'])
        ->first();
        
        if($shippingItemExists) { 
            unlink($shippingItemExists->neshan_arc_image_src);
        }

        $storeShippingDetails = Shipping::updateOrCreate(
            [
                'selected_row_id' => $shippingDetailsArray['selected_row_id']
            ],
            [
                'order_vproduct_id' => $shippingDetailsArray['order_vproduct_id'],
                'selected_row_id' => $shippingDetailsArray['selected_row_id'],
                'selected_order_origin_address_id' => $shippingDetailsArray['selected_order_origin_address_id'],
                'order_origin_address' => $shippingDetailsArray['order_origin_address'],
                'selected_order_destination_address_id' => $shippingDetailsArray['selected_order_destination_address_id'],
                'order_destination_address' => $shippingDetailsArray['order_destination_address'],
                'selected_freightage_information_id' => $shippingDetailsArray['selected_freightage_information_id'],
                'freightage_information' => $shippingDetailsArray['freightage_information'],
                'selected_freightage_activity_field_id' => $shippingDetailsArray['selected_freightage_activity_field_id'],
                'freightage_activity_field' => $shippingDetailsArray['freightage_activity_field'],
                'selected_freightage_loadertype_id' => $shippingDetailsArray['selected_freightage_loadertype_id'],
                'freightage_loadertype' => $shippingDetailsArray['freightage_loadertype'],
                'deliver_date_input' => $shippingDetailsArray['deliver_date_input'],
                'number_of_request_input' => $shippingDetailsArray['number_of_request_input'],
                'distance_by_kilometer' => $shippingDetailsArray['distance_by_kilometer'],
                'shipping_price' => $shippingDetailsArray['shipping_price'],
                'shipping_price_currency' => $shippingDetailsArray['shipping_price_currency'],
                'neshan_arc_image_src' => $shippingDetailsArray['neshan_arc_image_src'],
            ]
        );
      
        return $storeShippingDetails->wasChanged() || $storeShippingDetails->wasRecentlyCreated;
    }

    /**
     * Delete a shipping details item via AJAX request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteShippingDetailsItemAjax(Request $request) {

        // Set inital value
        $deletedItem = null;

        // Get the selected row id
        $selectedRowId = (int) Purify::clean($request->selectedRowId);

        // Get the order_vproduct_id
        $orderVproductId = (int) Purify::clean($request->orderVproductId);

        // Get the item from the Shipping Model
        $selectedItem = Shipping::where('selected_row_id', $selectedRowId)
        ->where('order_vproduct_id', $orderVproductId)
        ->first();

        // Get the user id from the order table and check if the user is eligible to update
        $user_id = OrderVproduct::findOrFail($orderVproductId)->order->user_id;
        if ($user_id != auth()->user()->id) {
            return;
        }

        // Check status, do not remove completed shipping items
        if($selectedItem->shipping_status == "processing") {
            // Remove the image from the server
            unlink($selectedItem->neshan_arc_image_src);
        
            // Delete the row item
            $deletedItem = $selectedItem->delete();

            // Get all items from the shipping model with the same orderVproductId           
            $allVproductItems = Shipping::where('order_vproduct_id', $orderVproductId)->orderBy('selected_row_id', 'asc')->get();

            // Reorganize selected_row_id for all items, because one of them has been deleted
            foreach ($allVproductItems as $key => $vproductItem) {
                $vproductItem->update([
                    'selected_row_id' => $key + 1
                ]);
            }
        }

        // Return the response
        return response($deletedItem);
    }

}
