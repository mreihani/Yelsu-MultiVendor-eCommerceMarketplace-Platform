<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\VendorScheduleDailyDeliveryCapacityValidation;

class VendorScheduleController extends Controller
{
    public function VendorAddSchedule() {
        $vendorData = auth()->user();

        $vendor_products = Product::sort_products_by_last_category($vendorData->vendorProducts);

        return view('vendor.backend.schedule.schedule_add', compact('vendorData', 'vendor_products'));
    }

    public function VendorStoreSchedule(Request $request) {

        $incomingFields = $request->validate([
            'product_obj' => new VendorScheduleDailyDeliveryCapacityValidation($request),
        ], [
            ''
        ]);

        dd(json_decode($request->product_obj[0]));
    }
}
