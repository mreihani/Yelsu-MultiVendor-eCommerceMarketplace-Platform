<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorScheduleController extends Controller
{
    public function VendorAddSchedule() {
        $vendorData = auth()->user();

        $vendor_products = Product::sort_products_by_last_category($vendorData->vendorProducts);

        return view('vendor.backend.schedule.schedule_add', compact('vendorData', 'vendor_products'));
    }
}
