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

        $vendorSectorArr = explode(",", $vendorData->vendor_sector);
        $parentCategories = Category::findRootCategoryArray($vendorSectorArr);

        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }

        return view('vendor.outlets.vendor_outlet_add', compact('vendorData', 'filter_category_array', 'vendorSectorArr'));
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
            'category_id' => implode(",",Purify::clean($incomingFields['category_id'])),
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

        $vendorSectorArr = explode(",", $vendorData->vendor_sector);
        $parentCategories = Category::findRootCategoryArray($vendorSectorArr);

        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }

        $outlet = Outlet::find(Purify::clean($outlet_id));

        if ($outlet->category_id) {
            $outletSectorArr = explode(",", $outlet->category_id);
        } else {
            $outletSectorArr = [];
        }

        return view('vendor.outlets.vendor_outlet_edit', compact('vendorData', 'outlet', 'filter_category_array', 'vendorSectorArr', 'outletSectorArr'));
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
                'category_id' => implode(",",Purify::clean($incomingFields['category_id'])),
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
                'category_id' => implode(",",Purify::clean($incomingFields['category_id'])),
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