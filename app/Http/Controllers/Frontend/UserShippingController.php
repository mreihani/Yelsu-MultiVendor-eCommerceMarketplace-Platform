<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\Useroutlets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stevebauman\Purify\Facades\Purify;
use App\Services\NeshanServices\NeshanApiService;

class UserShippingController extends Controller
{
    public function ShippingDetails($id) {

        $userData = auth()->user();
        $user_id = $userData->id;

        $order = Order::findOrFail(Purify::clean($id));

        $products = $order->products()->get();

        if ($order->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'سفارش یافت نشد.');
        }

        return view('frontend.dashboard.shipping-details', compact('userData', 'order', 'products'));
    }

    public function GetVendorAddressAjax(Request $request, NeshanApiService $neshanApiService) {

        $outlet_id = Purify::clean($request->outlet_id);
        $user_outlet_id = Purify::clean($request->user_outlet_id);

        $vendor_outlet = Outlet::findOrFail($outlet_id);
        $user_outlet = Useroutlets::findOrFail($user_outlet_id);

        $origin = array('lt' => $vendor_outlet->latitude, 'ln' => $vendor_outlet->longitude);
        $destination = array('lt' => $user_outlet->latitude, 'ln' => $user_outlet->longitude);

        $neshan_response = $neshanApiService->GetCoordsDistance($origin, $destination);
        $image_arc_src = $neshanApiService->GetNeshanArcMapImage($origin, $destination);

        return response(["vendor_outlet" => $vendor_outlet, "neshan_response" => $neshan_response, "image_arc_src" => $image_arc_src]);
    }

    public function GetUserAddressAjax(Request $request, NeshanApiService $neshanApiService) {

        $outlet_id = Purify::clean($request->outlet_id);
        $user_outlet_id = Purify::clean($request->user_outlet_id);

        $vendor_outlet = Outlet::findOrFail($outlet_id);
        $user_outlet = Useroutlets::findOrFail($user_outlet_id);

        $origin = array('lt' => $vendor_outlet->latitude, 'ln' => $vendor_outlet->longitude);
        $destination = array('lt' => $user_outlet->latitude, 'ln' => $user_outlet->longitude);

        $neshan_response = $neshanApiService->GetCoordsDistance($origin, $destination);
        $image_arc_src = $neshanApiService->GetNeshanArcMapImage($origin, $destination);

        return response(["user_outlet" => $user_outlet, "neshan_response" => $neshan_response, "image_arc_src" => $image_arc_src]);
    }

    public function GetFreightageInformationAjax(Request $request) {
        $freightage_id = Purify::clean($request->freightage_id);
        $freightage_obj = User::find($freightage_id)->verified_freightages_with_freightage_id->first()->getFreightageTypeParent();

        return response($freightage_obj);
    }

}
