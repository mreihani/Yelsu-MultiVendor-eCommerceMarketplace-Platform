<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorRepresentativeController extends Controller
{
    public function VendorAddRepresentative()
    {
        $user_id = auth()->user()->id;
        $vendorData = auth()->user();
        $vendor_products = Product::sort_products_by_last_category($vendorData->vendorProducts);
        
        return view('vendor.backend.representative.representative_add', compact('vendorData', 'vendor_products'));
    }
}
