<?php

namespace App\Http\Controllers\Backend\Vendor;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

use App\Http\Controllers\Controller;

class OutletController extends Controller
{
    public function VendorCreateOutlet()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        $vendor_sector_arr = explode(",", $vendorData->vendor_sector);
        $vendor_sector_cat_arr = Category::findRootCategoryArray($vendor_sector_arr);
        
        // category for filter
        $filter_category_array = [];
        foreach ($vendor_sector_cat_arr as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);

        }
        // category for filter

        return view('vendor.outlets.vendor_outlet_add', compact('vendorData', 'filter_category_array', 'vendor_sector_cat_arr'));
    }

    public function VendorStoreOutlet(Request $request)
    {
        $incomingFields = $request->validate([
            'shop_name' => 'required',
            'shop_address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'category_id' => 'required',
        ], [
            'shop_name.required' => 'لطفا نام فروشگاه / شرکت را وارد نمایید.',
            'shop_address.required' => 'لطفا آدرس فروشگاه / شرکت را وارد نمایید.',
            'latitude.required' => 'لطفا عرض جغرافیایی نقطه مورد نظر را وارد نمایید.',
            'longitude.required' => 'لطفا طول جغرافیایی نقطه مورد نظر را وارد نمایید.',
            'category_id.required' => 'لطفا زیر دسته فعالیت را انتخاب نمایید.',
        ]);

        // added recursive function to find root parent category
        $root_catgory_id = [];
        $categories = Category::latest()->get();
        foreach (Purify::clean($incomingFields['category_id']) as $category_item) {
            $category_by_id = Category::find($category_item);
            foreach ($categories as $categoryItem) {
                if ($category_by_id->parent == 0) {
                    $root_catgory_id[] = $category_by_id->id;
                    break;
                } else {
                    $category_by_id = Category::find($category_by_id->parent);
                }
            }
        }
        $root_catgory_id = array_unique($root_catgory_id);
        // end of - recursive function to find root parent category

        $selected_categories = array_merge($root_catgory_id, Purify::clean($incomingFields['category_id']));
        $category_id = implode(',', $selected_categories);

        Outlet::insert([
            'shop_name' => Purify::clean($incomingFields['shop_name']),
            'shop_address' => Purify::clean($incomingFields['shop_address']),
            'latitude' => Purify::clean($incomingFields['latitude']),
            'longitude' => Purify::clean($incomingFields['longitude']),
            'shop_postalcode' => Purify::clean($request->shop_postalcode) ? Purify::clean($request->shop_postalcode) : null,
            'shop_phone' => Purify::clean($request->shop_phone) ? Purify::clean($request->shop_phone) : null,
            'shop_fax' => Purify::clean($request->shop_fax) ? Purify::clean($request->shop_fax) : null,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'category_id' => $category_id,
        ]);

        return redirect(route('vendor.all.outlet'))->with('success', 'آدرس مورد نظر با موفقیت اضافه گردید.');
    }
    public function VendorAllOutlet()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        $outlets = Outlet::where('user_id', $id)->orderBy("id", 'asc')->get();

        return view('vendor.outlets.vendor_outlet_all', compact('vendorData', 'outlets'));
    }
    public function VendorEditOutlet($outlet_id)
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        $vendor_sector_arr = explode(",", $vendorData->vendor_sector);
        $vendor_sector_cat_arr = Category::findRootCategoryArray($vendor_sector_arr);

        // category for filter
        $filter_category_array = [];
        foreach ($vendor_sector_cat_arr as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);

        }
        // category for filter

        $outlet = Outlet::find(Purify::clean($outlet_id));

        if ($outlet->category_id) {
            $vendor_sector_cat_arr_selected = explode(",", $outlet->category_id);
        } else {
            $vendor_sector_cat_arr_selected = [];
        }

        return view('vendor.outlets.vendor_outlet_edit', compact('vendorData', 'outlet', 'filter_category_array', 'vendor_sector_cat_arr', 'vendor_sector_cat_arr_selected'));
    }
    public function VendorUpdateOutlet(Request $request)
    {

        $outlet_id = Purify::clean($request->outlet_id);

        $incomingFields = $request->validate([
            'shop_name' => 'required',
            'shop_address' => 'required',
            'category_id' => 'required',
        ], [
            'shop_name.required' => 'لطفا نام فروشگاه / شرکت را وارد نمایید.',
            'shop_address.required' => 'لطفا آدرس فروشگاه / شرکت را وارد نمایید.',
            'category_id.required' => 'لطفا زیر دسته فعالیت را انتخاب نمایید.',
        ]);


        // added recursive function to find root parent category
        $root_catgory_id = [];
        $categories = Category::latest()->get();
        foreach (Purify::clean($incomingFields['category_id']) as $category_item) {
            $category_by_id = Category::find($category_item);
            foreach ($categories as $categoryItem) {
                if ($category_by_id->parent == 0) {
                    $root_catgory_id[] = $category_by_id->id;
                    break;
                } else {
                    $category_by_id = Category::find($category_by_id->parent);
                }
            }
        }
        $root_catgory_id = array_unique($root_catgory_id);
        // end of - recursive function to find root parent category


        $selected_categories = array_merge($root_catgory_id, Purify::clean($incomingFields['category_id']));
        $category_id = implode(',', $selected_categories);


        if (Purify::clean($request->latitude) && Purify::clean($request->longitude)) {
            Outlet::findOrFail($outlet_id)->update([
                'shop_name' => Purify::clean($incomingFields['shop_name']),
                'shop_address' => Purify::clean($incomingFields['shop_address']),
                'latitude' => Purify::clean($request->latitude),
                'longitude' => Purify::clean($request->longitude),
                'shop_postalcode' => Purify::clean($request->shop_postalcode) ? Purify::clean($request->shop_postalcode) : null,
                'shop_phone' => Purify::clean($request->shop_phone) ? Purify::clean($request->shop_phone) : null,
                'shop_fax' => Purify::clean($request->shop_fax) ? Purify::clean($request->shop_fax) : null,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'category_id' => $category_id,
            ]);
        } else {
            Outlet::findOrFail($outlet_id)->update([
                'shop_name' => Purify::clean($incomingFields['shop_name']),
                'shop_address' => Purify::clean($incomingFields['shop_address']),
                'shop_postalcode' => Purify::clean($request->shop_postalcode) ? Purify::clean($request->shop_postalcode) : null,
                'shop_phone' => Purify::clean($request->shop_phone) ? Purify::clean($request->shop_phone) : null,
                'shop_fax' => Purify::clean($request->shop_fax) ? Purify::clean($request->shop_fax) : null,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'category_id' => $category_id,
            ]);
        }

        return redirect(route('vendor.all.outlet'))->with('success', 'آدرس مورد نظر با موفقیت به روز رسانی گردید.');
    }

    public function VendorDeleteOutlet($outlet_id)
    {
        Outlet::findOrFail(Purify::clean($outlet_id))->delete();
        return redirect(route('vendor.all.outlet'))->with('success', 'آدرس مورد نظر با موفقیت حذف گردید.');
    }

}