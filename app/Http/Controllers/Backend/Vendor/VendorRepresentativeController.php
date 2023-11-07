<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Representative;
use Illuminate\Validation\Rule;
use App\Rules\PersonTypeValidation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Purify\Facades\Purify;
use App\Rules\RepresentativeGeolocation;
use App\Rules\RepresentativeGeolocationProduct;


class VendorRepresentativeController extends Controller
{
    public function VendorAllRepresentative() {
        $user_id = auth()->user()->id;
        $vendorData = auth()->user();

        $vendor_representatives = $vendorData->vendor_representatives;
        
        return view('vendor.backend.representative.representative_all', compact('vendorData', 'vendor_representatives'));
    }

    public function VendorAddRepresentative()
    {
        $user_id = auth()->user()->id;
        $vendorData = auth()->user();
        $vendor_products = Product::sort_products_by_last_category($vendorData->vendorProducts);

        $country_list = config("yelsu_location_array.countries");

        return view('vendor.backend.representative.representative_add', compact('vendorData', 'vendor_products', 'country_list'));
    }

    public function VendorStoreRepresentative(Request $request) {

        $incomingFields = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^[A-Za-z0-9]+(?:[_][A-Za-z0-9]+)*$/', 'min:5', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => 'required|min:8|max:20',
            'shop_name' => 'required',
            'shop_address' => 'required',
            'person_type' => new PersonTypeValidation($request),
            'specific_geolocation_validation' => new RepresentativeGeolocation($request),
            'product_obj_server' => ['required', new RepresentativeGeolocationProduct($request)],
        ], [
            'firstname.required' => 'لطفا نام کاربر را وارد نمایید.',
            'lastname.required' => 'لطفا نام خانوادگی کاربر را وارد نمایید.',
            'username.required' => 'لطفا نام کاربری را وارد نمایید.',
            'username.unique' => 'نام کاربری مورد نظر قبلا در سامانه ثبت شده است. لطفا نام کاربری دیگری انتخاب نمایید.',
            'username.min' => 'نام کاربری حداقل 5 کاراکتر باید باشد.',
            'username.regex' => 'نام کاربری فقط باید شامل حروف و اعداد انگلیسی باشد. !@#)($%^&-* و فاصله غیر مجاز است.',
            'email.required' => 'لطفا ایمیل کاربر را وارد نمایید.',
            'email.unique' => 'ایمیل مورد نظر قبلا در سامانه ثبت شده است. لطفا ایمیل دیگری انتخاب نمایید.',
            'email.email' => 'لطفا آدرس ایمیل صحیح وارد نمایید.',
            'password.required' => 'لطفا کلمه عبور کاربر را وارد نمایید.',
            'password.min' => 'کلمه عبور باید حداقل 8 کاراکتر باشد.',
            'password.max' => 'کلمه عبور باید حداکثر 20 کاراکتر باشد.',
            'shop_name.required' => 'لطفا نام فروشگاه یا شرکت را وارد نمایید.',
            'shop_address.required' => 'لطفا آدرس فروشگاه یا شرکت را وارد نمایید.',
            'product_obj_server.required' => 'لطفا حداقل یک محصول از جدول محصولات انتخاب نمایید.',
        ]);

        $user = User::create([
            'firstname' => Purify::clean($incomingFields['firstname']),
            'lastname' => Purify::clean($incomingFields['lastname']),
            'username' => Purify::clean($incomingFields['username']),
            'email' => Purify::clean($incomingFields['email']),
            'password' => Hash::make($incomingFields['password']),
            'role' => 'representative',
            'status' => 'active',
            'shop_name' => Purify::clean($incomingFields['shop_name']),
            'shop_address' => Purify::clean($incomingFields['shop_address']),
            'person_type' => Purify::clean($request->person_type),
            'national_code' => Purify::clean($request->national_code) ? Purify::clean($request->national_code) : null,
            'company_number' => Purify::clean($request->company_number) ? Purify::clean($request->company_number) : null,
            'agent_name' => Purify::clean($request->agent_name) ? Purify::clean($request->agent_name) : null,
        ]);

        $rep_user = $user->representative()->create([
            'user_id' => $user->id,
            'vendor_id' => auth()->user()->id,
            'representative_type' => Purify::clean($request->representative_type),
            'specific_geolocation_internal' => Purify::clean($request->specific_geolocation_internal) == "on" ? true : false,
            'specific_geolocation_external' => Purify::clean($request->specific_geolocation_external) == "on" ? true : false,
            'geolocation_permission_province' => (is_array($request->geolocation_permission_province) && !empty($request->geolocation_permission_province)) ? implode(",", Purify::clean($request->geolocation_permission_province)) : null,
            'geolocation_permission_city' => (is_array($request->geolocation_permission_city) && !empty($request->geolocation_permission_city)) ? implode(",", Purify::clean($request->geolocation_permission_city)) : null,
            'geolocation_permission_export_country' => (is_array($request->geolocation_permission_export_country) && !empty($request->geolocation_permission_export_country)) ? implode(",", Purify::clean($request->geolocation_permission_export_country)) : null,
        ]);

        $product_arr = [];
        foreach ($request->product_obj_server as $product_obj_json_item) {
            $product_obj_decoded = json_decode($product_obj_json_item);
            $product_arr[$product_obj_decoded->product_id] = array(
                "product_in_stock" => (int) $product_obj_decoded->product_in_stock != 0 ? (int) $product_obj_decoded->product_in_stock : null,
                "change_price_permission" => $product_obj_decoded->change_price_permission,
                "product_geolocation_permission_province" => (is_array($product_obj_decoded->product_geolocation_permission_province) && !empty($product_obj_decoded->product_geolocation_permission_province)) ? implode(",", $product_obj_decoded->product_geolocation_permission_province) : null,
                "product_geolocation_permission_city" => (is_array($product_obj_decoded->product_geolocation_permission_city) && !empty($product_obj_decoded->product_geolocation_permission_city)) ? implode(",", $product_obj_decoded->product_geolocation_permission_city) : null,
                "product_geolocation_permission_export_country" => (is_array($product_obj_decoded->product_geolocation_permission_export_country) && !empty($product_obj_decoded->product_geolocation_permission_export_country)) ? implode(",", $product_obj_decoded->product_geolocation_permission_export_country) : null,
                "product_specific_geolocation_internal" => $product_obj_decoded->product_specific_geolocation_internal,
                "product_specific_geolocation_external" => $product_obj_decoded->product_specific_geolocation_external,
            );
        }

        $rep_user->products()->attach($product_arr);

        return redirect(route('vendor.all.representative'))->with('success', 'حساب کاربری با موفقیت ایجاد گردید.');
    }

    public function VendorEditRepresentative($id)
    {
        $representative = Representative::find($id);
       
        $user_id = auth()->user()->id;
        $vendorData = auth()->user();

        $vendor_products = Product::sort_products_by_last_category($vendorData->vendorProducts);

        $province_list = config("yelsu_location_array.provinces");
        $country_list = config("yelsu_location_array.countries");

        return view('vendor.backend.representative.representative_edit', compact('vendorData', 'vendor_products', 'representative', 'province_list', 'country_list'));
    }

    public function VendorUpdateUserRepresentative(Request $request) {

        $representative_id = Purify::clean($request->representative_id);
        $representative = Representative::find($representative_id);

        $user_id = auth()->user()->id;
        $vendorData = auth()->user();
        
        $incomingFields = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^[A-Za-z0-9]+(?:[_][A-Za-z0-9]+)*$/', 'min:5', 'max:255', Rule::unique('users', 'username')->ignore($representative->user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($representative->user->id)],
            'password' => 'required|min:8|max:20',
            'shop_name' => 'required',
            'shop_address' => 'required',
            'person_type' => new PersonTypeValidation($request),
        ], [
            'firstname.required' => 'لطفا نام کاربر را وارد نمایید.',
            'lastname.required' => 'لطفا نام خانوادگی کاربر را وارد نمایید.',
            'username.required' => 'لطفا نام کاربری را وارد نمایید.',
            'username.unique' => 'نام کاربری مورد نظر قبلا در سامانه ثبت شده است. لطفا نام کاربری دیگری انتخاب نمایید.',
            'username.min' => 'نام کاربری حداقل 5 کاراکتر باید باشد.',
            'username.regex' => 'نام کاربری فقط باید شامل حروف و اعداد انگلیسی باشد. !@#)($%^&-* و فاصله غیر مجاز است.',
            'email.required' => 'لطفا ایمیل کاربر را وارد نمایید.',
            'email.unique' => 'ایمیل مورد نظر قبلا در سامانه ثبت شده است. لطفا ایمیل دیگری انتخاب نمایید.',
            'email.email' => 'لطفا آدرس ایمیل صحیح وارد نمایید.',
            'password.required' => 'لطفا کلمه عبور کاربر را وارد نمایید.',
            'password.min' => 'کلمه عبور باید حداقل 8 کاراکتر باشد.',
            'password.max' => 'کلمه عبور باید حداکثر 20 کاراکتر باشد.',
            'shop_name.required' => 'لطفا نام فروشگاه یا شرکت را وارد نمایید.',
            'shop_address.required' => 'لطفا آدرس فروشگاه یا شرکت را وارد نمایید.',
        ]);

        if ($incomingFields['password'] != 'password') {
            $representative->user->update([
                'firstname' => Purify::clean($incomingFields['firstname']),
                'lastname' => Purify::clean($incomingFields['lastname']),
                'username' => Purify::clean($incomingFields['username']),
                'email' => Purify::clean($incomingFields['email']),
                'password' => Hash::make($incomingFields['password']),
                'shop_name' => Purify::clean($incomingFields['shop_name']),
                'shop_address' => Purify::clean($incomingFields['shop_address']),
                'person_type' => Purify::clean($request->person_type),
                'national_code' => Purify::clean($request->national_code) ? Purify::clean($request->national_code) : null,
                'company_number' => Purify::clean($request->company_number) ? Purify::clean($request->company_number) : null,
                'agent_name' => Purify::clean($request->agent_name) ? Purify::clean($request->agent_name) : null,
            ]);
        } else {
            $representative->user->update([
                'firstname' => Purify::clean($incomingFields['firstname']),
                'lastname' => Purify::clean($incomingFields['lastname']),
                'username' => Purify::clean($incomingFields['username']),
                'email' => Purify::clean($incomingFields['email']),
                'shop_name' => Purify::clean($incomingFields['shop_name']),
                'shop_address' => Purify::clean($incomingFields['shop_address']),
                'person_type' => Purify::clean($request->person_type),
                'national_code' => Purify::clean($request->national_code) ? Purify::clean($request->national_code) : null,
                'company_number' => Purify::clean($request->company_number) ? Purify::clean($request->company_number) : null,
                'agent_name' => Purify::clean($request->agent_name) ? Purify::clean($request->agent_name) : null,
            ]);
        }

        $representative->update([
            'representative_type' => Purify::clean($request->representative_type),
        ]);

        return redirect(route('vendor.all.representative'))->with('success', 'حساب کاربری با موفقیت بروزرسانی گردید.');
    }

    private function VendorUpdateProductsRepresentativePrepareArray($representative_variable) {
        if(is_array($representative_variable) && !empty($representative_variable)) {
            $prepared_item = implode(",", Purify::clean($representative_variable));
        } elseif(is_array($representative_variable) && empty($representative_variable)) {
            $prepared_item = null;
        } else {
            $prepared_item = Purify::clean($representative_variable);
        }

        return $prepared_item;
    }

    public function VendorUpdateProductsRepresentative(Request $request) {
       
        $representative_id = Purify::clean($request->representative_id);
        $representative = Representative::find($representative_id);

        $user_id = auth()->user()->id;
        $vendorData = auth()->user();
        
        $incomingFields = $request->validate([
            'specific_geolocation_validation' => new RepresentativeGeolocation($request),
            'product_obj_server' => ['required', new RepresentativeGeolocationProduct($request)],
        ], [
            'product_obj_server.required' => 'لطفا حداقل یک محصول از جدول محصولات انتخاب نمایید.',
        ]);

        $representative->update([
            'specific_geolocation_internal' => Purify::clean($request->specific_geolocation_internal) == "on" ? true : false,
            'specific_geolocation_external' => Purify::clean($request->specific_geolocation_external) == "on" ? true : false,
            'geolocation_permission_province' => $this->VendorUpdateProductsRepresentativePrepareArray($request->geolocation_permission_province),
            'geolocation_permission_city' => $this->VendorUpdateProductsRepresentativePrepareArray($request->geolocation_permission_city),
            'geolocation_permission_export_country' => $this->VendorUpdateProductsRepresentativePrepareArray($request->geolocation_permission_export_country),
        ]);

        $product_arr = [];
        foreach ($request->product_obj_server as $product_obj_json_item) {
            $product_obj_decoded = json_decode($product_obj_json_item);
            $product_arr[$product_obj_decoded->product_id] = array(
                "product_in_stock" => (int) $product_obj_decoded->product_in_stock != 0 ? (int) $product_obj_decoded->product_in_stock : null,
                "change_price_permission" => $product_obj_decoded->change_price_permission,
                "product_geolocation_permission_province" => $this->VendorUpdateProductsRepresentativePrepareArray($product_obj_decoded->product_geolocation_permission_province),
                "product_geolocation_permission_city" => $this->VendorUpdateProductsRepresentativePrepareArray($product_obj_decoded->product_geolocation_permission_city),
                "product_geolocation_permission_export_country" => $this->VendorUpdateProductsRepresentativePrepareArray($product_obj_decoded->product_geolocation_permission_export_country),
                "product_specific_geolocation_internal" => $product_obj_decoded->product_specific_geolocation_internal,
                "product_specific_geolocation_external" => $product_obj_decoded->product_specific_geolocation_external,
            );
        }

        $representative->products()->detach();
        $representative->products()->attach($product_arr);

        return redirect(route('vendor.all.representative'))->with('success', 'اطلاعات عامل / نمایندگی با موفقیت بروزرسانی گردید.');
    }

    public function VendorDeleteRepresentative($id) {
        $representative = Representative::find($id);

        $representative->user->delete();

        return redirect(route('vendor.all.representative'))->with('success', 'حساب کاربری با موفقیت ایجاد گردید.');
    }
}
