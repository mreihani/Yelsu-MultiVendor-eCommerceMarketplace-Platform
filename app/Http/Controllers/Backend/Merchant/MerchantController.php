<?php

namespace App\Http\Controllers\Backend\Merchant;

use App\Models\File;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeItem;
use App\Models\Merchantoutlet;
use Illuminate\Support\Carbon;
use App\Models\CategoryProduct;
use Illuminate\Validation\Rule;
use App\Rules\AttributeIsRequired;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\File as LaravelFile;

class MerchantController extends Controller
{
    public function MerchantDashboard()
    {
        $id = Auth::user()->id;
        $merchantData = User::find($id);

        return view('merchant.index', compact('merchantData'));
    } //End method

    public function MerchantDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //End method

    public function MerchantProfile()
    {
        $id = Auth::user()->id;
        $merchantData = User::find($id);

        return view('merchant.merchant_profile_view', compact('merchantData'));
    } //End method

    public function MerchantProfileSettings()
    {
        $id = Auth::user()->id;
        $merchantData = User::find($id);

        return view('merchant.merchant_profile_settings', compact('merchantData'));
    } //End method

    public function MerchantProfileStore(Request $request)
    {

        $incomingFields = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'shop_address' => 'required',
            'shop_name' => 'required',
        ], [
            'firstname.required' => 'لطفا نام خود را وارد نمایید.',
            'lastname.required' => 'لطفا نام خانوادگی خود را وارد نمایید.',
            'shop_address.required' => 'لطفا آدرس فروشگاه/شرکت خود را وارد نمایید.',
            'shop_name.required' => 'لطفا نام فروشگاه/شرکت خود را وارد نمایید.',
        ]);

        if (Purify::clean($request->merchant_type) == 'none') {
            session()->flashInput($request->input());
            return back()->with('error', 'لطفا زمینه فعالیت بازرگان را مشخص نمایید.');
        }

        if (Purify::clean($request->person_type) == 'haghighi') {

            if (Purify::clean($request->national_code) == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا کد ملی خود را وارد نمایید.');
            }

            if (strlen(Purify::clean($request->national_code)) != 10 || ! is_numeric(Purify::clean($request->national_code))) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا کد ملی صحیح وارد نمایید.');
            }

        } elseif (Purify::clean($request->person_type) == 'hoghoghi') {

            if (Purify::clean($request->company_number) == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا شماره شناسه شرکت راوارد نمایید.');
            }

            if (strlen(Purify::clean($request->company_number)) != 11 || ! is_numeric(Purify::clean($request->company_number))) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا شماره شناسه صحیح وارد نمایید.');
            }
        }

        $id = Auth::user()->id;
        $data = User::find($id);

        if (Purify::clean($incomingFields['firstname'])) {
            $data->firstname = Purify::clean($incomingFields['firstname']);
        }

        if (Purify::clean($incomingFields['lastname'])) {
            $data->lastname = Purify::clean($incomingFields['lastname']);
        }

        if (Purify::clean($incomingFields['shop_address'])) {
            $data->shop_address = Purify::clean($incomingFields['shop_address']);
        }

        if (Purify::clean($incomingFields['shop_name'])) {
            $data->shop_name = Purify::clean($incomingFields['shop_name']);
        }

        if (Purify::clean($request->person_type)) {
            $data->person_type = Purify::clean($request->person_type);
        }

        if (Purify::clean($request->national_code)) {
            $data->national_code = Purify::clean($request->national_code);
        }

        if (Purify::clean($request->company_number)) {
            $data->company_number = Purify::clean($request->company_number);
        }

        if (Purify::clean($request->agent_name)) {
            $data->agent_name = Purify::clean($request->agent_name);
        }

        if (Purify::clean($request->merchant_type)) {
            $data->merchantUser()->update([
                'merchant_type' => Purify::clean($request->merchant_type),
            ]);
        }

        if (Purify::clean($request->file('photo'))) {
            $file = Purify::clean($request->file('photo'));

            if ($data->photo != NULL) {
                unlink('storage/upload/merchant_images/' . $data->photo);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(160)->encode('jpg')->save('storage/upload/merchant_images/' . $filename);
            $data['photo'] = $filename;
        }

        if (Purify::clean($request->file('store_banner'))) {
            $file = Purify::clean($request->file('store_banner'));

            if ($data->store_banner != NULL) {
                unlink('storage/upload/merchant_images/' . $data->store_banner);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(930, 446)->encode('jpg')->save('storage/upload/merchant_images/' . $filename);
            $data['store_banner'] = $filename;
        }

        $data->save();
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');

    } //End method

    public function MerchantProfileFinancialStatement()
    {
        $id = Auth::user()->id;
        $merchantData = User::find($id);
        return view('merchant.merchant_profile_financial_statement', compact('merchantData'));
    } //End method

    public function MerchantProfileFinancialStatementStore(Request $request)
    {

        $incomingFields = $request->validate([
            'shaba_number' => 'required|digits:24',
            'cart_owner_info' => 'required',
            'cart_bank_info' => 'required',
        ], [
            'shaba_number.required' => 'لطفا شماره شبا را وارد نمایید.',
            'shaba_number.digits' => 'لطفا شماره شبا صحبح وارد نمایید.',
            'cart_owner_info.required' => 'لطفا نام و نام خانوادگی صاحب حساب / شرکت را وارد نمایید.',
            'cart_bank_info.required' => 'لطفا نام بانک را وارد نمایید.',
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);

        $data->shaba_number = Purify::clean($incomingFields['shaba_number']);
        $data->cart_owner_info = Purify::clean($incomingFields['cart_owner_info']);
        $data->cart_bank_info = Purify::clean($incomingFields['cart_bank_info']);

        if (Purify::clean($request->cart_number)) {
            if (strlen(Purify::clean($request->cart_number)) == 16 && is_numeric(Purify::clean($request->cart_number))) {
                $data->cart_number = Purify::clean($request->cart_number);
            } else {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا شماره کارت صحیح وارد نمایید.');
            }
        } else {
            $data->cart_number = NULL;
        }

        $data->save();
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    } //End method

    public function MerchantAllProduct()
    {
        $user_id = Auth::user()->id;
        $merchantData = User::find($user_id);
        $selected_merchant_id_array = [];
        $merchant_products = [];

        $products = Product::latest()->get();

        foreach ($products as $product) {
            if (in_array($user_id, explode(",", $product->merchant_id))) {
                $merchant_products[] = $product;
            }
        }

        return view('merchant.backend.product.merchant_product_all', compact('merchant_products', 'merchantData'));
    } //End method

    public function MerchantAddProduct()
    {
        $user_id = Auth::user()->id;
        $merchantData = User::find($user_id);

        $parentCategories = Category::where('parent', 0)->get();
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }

        return view('merchant.backend.product.merchant_product_add', compact('merchantData', 'filter_category_array'));
    } //End method

    public function MerchantStoreProduct(Request $request)
    {
        $incomingFields = $request->validate([
            'product_thumbnail' => ['required', 'image', 'max:5000'],
            'category_id' => 'required',
            'product_name' => ['required', Rule::unique('products', 'product_name')],
            'product_slug' => ['required', Rule::unique('products', 'product_slug')],
            'selling_price' => ['required', 'numeric'],
            'attribute' => ['required', new AttributeIsRequired()],
        ], [
            'product_thumbnail.required' => 'لطفا تصویر محصول را بارگذاری نمایید.',
            'product_thumbnail.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'product_thumbnail.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
            'category_id.required' => 'لطفا یک دسته بندی مرتبط برای محصول انتخاب نمایید.',
            'product_name.required' => 'لطفا نام محصول را وارد نمایید.',
            'product_name.unique' => 'نام محصول قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
            'product_slug.required' => 'لطفا اسلاگ را وارد نمایید.',
            'product_slug.unique' => 'اسلاگ قبلا ثبت شده است. لطفا یک عبارت دیگر وارد کنید.',
            'selling_price.required' => 'لطفا قیمت محصول را وارد نمایید.',
            'selling_price.numeric' => 'لطفا قیمت محصول را به درستی وارد نمایید.',
            'attribute.required' => 'لطفا حداقل یک ویژگی مرتبط با محصول انتخاب نمایید.',
        ]);

        // create string of category id which is array, to store the string into DB
        if (Purify::clean($incomingFields['category_id'])) {
            $category_id = implode(',', Purify::clean($incomingFields['category_id']));
        } else {
            $category_id = "";
        }

        // calculate root category name and id
        $parent_category_name = NULL;
        $parent_category_id = NULL;
        if (Purify::clean($incomingFields['category_id'])) {
            foreach (Purify::clean($incomingFields['category_id']) as $cat_id_item) {
                $cat_item_obj = Category::find($cat_id_item);
                if ((int) $cat_item_obj->parent == 0) {
                    $parent_category_name = $cat_item_obj->category_name;
                    $parent_category_id = $cat_item_obj->id;
                }
            }
        }

        // check if user has forgotten to select a root category item
        if ($parent_category_id == NULL) {
            return back()->with('error', 'لطفا دسته بندی اصلی مرتبط با محصول را انتخاب نمایید.')->withInput();
        }

        // get current user id and create a folder with id
        $current_user_id = auth()->user()->id;
        if (! LaravelFile::exists('storage/upload/products/thumbnail/' . $current_user_id)) {
            LaravelFile::makeDirectory('storage/upload/products/thumbnail/' . $current_user_id);
        }

        $image = Purify::clean($incomingFields['product_thumbnail']);
        $unique_image_name = hexdec(uniqid()) . time();
        $name_gen = $unique_image_name . '.' . 'jpg';
        $name_gen_sm = $unique_image_name . '_sm.' . 'jpg';
        Image::make($image)->fit(880, 990)->encode('jpg')->save('storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen);
        Image::make($image)->fit(222, 250)->encode('jpg')->save('storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen_sm);
        $save_url = 'storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen;
        $save_url_sm = 'storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen_sm;


        $product_id = Product::insertGetId([
            'category_id' => $category_id,
            'parent_category_id' => $parent_category_id ?? NULL,
            'parent_category_name' => $parent_category_name ?? NULL,
            'product_name' => Purify::clean($incomingFields['product_name']),
            'product_slug' => strtolower(str_replace(' ', '-', Purify::clean($incomingFields['product_slug']))),
            'product_code' => Purify::clean($request->product_code),
            'selling_price' => Purify::clean($incomingFields['selling_price']),
            'long_desc' => ($request->long_desc),
            'merchant_id' => Auth::user()->id,
            'product_thumbnail' => $save_url,
            'product_thumbnail_sm' => $save_url_sm,
            'product_qty' => Purify::clean($request->product_qty) >= 0 ? Purify::clean($request->product_qty) : 0,
            'short_desc' => ($request->short_desc),
            'featured' => 1,
            'status' => Purify::clean($request->product_status) == 'active' ? 'active' : 'disabled',
            'unlimitedStock' => Purify::clean($request->unlimitedStock) == 'active' ? 'active' : 'disabled',
            'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
            'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
            'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
            'specification' => ($request->specification),
            'owner_id' => Auth::user()->id,
            'trading_method' => Purify::clean($request->trading_method),
            'product_verification' => 'inactive',
        ]);

        if (Purify::clean($incomingFields['category_id'])) {
            foreach (Purify::clean($incomingFields['category_id']) as $cat_id) {
                CategoryProduct::insert([
                    'category_id' => $cat_id,
                    'product_id' => $product_id,
                ]);
            }
        }

        // بخش مدیریت ویژگی ها
        if($request->attribute) {
            $product = Product::find($product_id);

            $attributes = [];
            $attribute_id = collect($request->attribute)->keys()->first();
            foreach (Purify::clean(collect($request->attribute)->first()) as $key => $attribute_item) {
                $attribute_in_loop = AttributeItem::find($key);
                if($attribute_in_loop->attribute_item_type == "dropdown" && $attribute_item["attribute_value_id"] != 'none' && !$attribute_in_loop->multiple_selection_attribute && !$attribute_in_loop->disabled_attribute) {
                    $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_item["attribute_value_id"], "attribute_value" => NULL);
                    
                } elseif($attribute_in_loop->attribute_item_type == "dropdown" && count(collect($attribute_item["attribute_value_id"])) > 1 && $attribute_in_loop->multiple_selection_attribute && !$attribute_in_loop->disabled_attribute) {
                    // به خاطر گزینه چندگانه باید همه مقادیر وارد گردد
                    foreach ($attribute_item["attribute_value_id"] as $attribute_value_id_key => $attribute_value_id_item) {
                        if($attribute_value_id_key == 0) {
                            continue;
                        }
                        $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_value_id_item, "attribute_value" => NULL);
                    }

                } elseif($attribute_in_loop->attribute_item_type == "input_field" && $attribute_item["attribute_value"] != '' && !$attribute_in_loop->multiple_selection_attribute && !$attribute_in_loop->disabled_attribute) {
                    $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_item["attribute_value_id"], "attribute_value" => Purify::clean($attribute_item["attribute_value"]));
                }
            }

            if (count($attributes) ) {
                foreach ($attributes as $attribute_item) {
                    $product->attributes()->attach($attribute_item);
                }
            }
        }   
        // بخش مدیریت ویژگی ها

        $product->searchable();

        return redirect()->route('merchant.all.product')->with('success', 'محصول مورد نظر با موفقیت ایجاد و پس از تایید کارشناس منتشر خواهد شد.');
    } //End method

    public function MerchantEditProduct($id)
    {
        $user_id = Auth::user()->id;
        $merchantData = User::find($user_id);
        $products = Product::findOrFail(Purify::clean($id));
        $allAttributes = AttributeItem::find($products->attributes()->pluck('attribute_item_id'));

        $parentCategories = Category::where('parent', 0)->get();
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }

        return view('merchant.backend.product.merchant_product_edit', compact('merchantData', 'products', 'allAttributes', 'filter_category_array'));
    } //End method

    public function MerchantUpdateProduct(Request $request)
    {
        $product_id = Purify::clean($request->id);

        $incomingFields = $request->validate([
            'category_id' => 'required',
            'product_name' => ['required', Rule::unique('products', 'product_name')->ignore($product_id)],
            'product_slug' => ['required', Rule::unique('products', 'product_slug')->ignore($product_id)],
            'selling_price' => ['required', 'numeric'],
            'attribute' => ['required', new AttributeIsRequired()],
        ], [
            'category_id.required' => 'لطفا یک دسته بندی مرتبط برای محصول انتخاب نمایید.',
            'product_name.required' => 'لطفا نام محصول را وارد نمایید.',
            'product_name.unique' => 'نام محصول قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
            'product_slug.required' => 'لطفا اسلاگ را وارد نمایید.',
            'product_slug.unique' => 'اسلاگ قبلا ثبت شده است. لطفا یک عبارت دیگر وارد کنید.',
            'selling_price.required' => 'لطفا قیمت محصول را وارد نمایید.',
            'attribute.required' => 'لطفا حداقل یک ویژگی مرتبط با محصول انتخاب نمایید.',
        ]);

        // create string of category id which is array, to store the string into DB
        if (Purify::clean($incomingFields['category_id'])) {
            $category_id = implode(',', Purify::clean($incomingFields['category_id']));
        } else {
            $category_id = "";
        }

        // calculate root category name and id
        $parent_category_name = NULL;
        $parent_category_id = NULL;
        if (Purify::clean($incomingFields['category_id'])) {
            foreach (Purify::clean($incomingFields['category_id']) as $cat_id_item) {
                $cat_item_obj = Category::find($cat_id_item);
                if ((int) $cat_item_obj->parent == 0) {
                    $parent_category_name = $cat_item_obj->category_name;
                    $parent_category_id = $cat_item_obj->id;
                }
            }
        }

        // check if user has forgotten to select a root category item
        if ($parent_category_id == NULL) {
            return back()->with('error', 'لطفا دسته بندی اصلی مرتبط با محصول را انتخاب نمایید.')->withInput();
        }

        $image = Purify::clean($request->file('product_thumbnail'));

        // here check if maclicious user enters unrelated product ID to edit its content
        $product = Product::findOrFail($product_id);
        if ($product->merchant_id != Auth::user()->id) {
            return redirect()->route('merchant.all.product')->with('error', 'شما اجازه ویرایش این محصول را ندارید!');
        }

        // specialist verification section
        $category_id_arr_db = explode(",", $product->category_id);
        if ($category_id_arr_db != Purify::clean($request->category_id)
            || $product->product_name != Purify::clean($request->product_name)
            || $product->product_slug != Purify::clean($request->product_slug)
            || $product->product_code != Purify::clean($request->product_code)
            || $product->long_desc != ($request->long_desc)
            || $product->product_qty != Purify::clean($request->product_qty)
            || $product->short_desc != ($request->short_desc)
            || $product->meta_title != Purify::clean($request->meta_title)
            || $product->meta_description != Purify::clean($request->meta_description)
            || $product->meta_keywords != Purify::clean($request->meta_keywords)
            || $product->specification != ($request->specification)
            || $product->unlimitedStock != Purify::clean($request->unlimitedStock)
            || $product->status != Purify::clean($request->product_status)
            || $image
            || Product::checkIfAttributeHasChanged($request->attribute, $product_id)
        ) {
            $product_verification = "inactive";
        } else {
            if ($product->product_verification == "active") {
                $product_verification = "active";
            } else {
                $product_verification = "inactive";
            }
        }
        // specialist verification section

        // get current user id and create a folder with id
        $current_user_id = auth()->user()->id;
        if (! LaravelFile::exists('storage/upload/products/thumbnail/' . $current_user_id)) {
            LaravelFile::makeDirectory('storage/upload/products/thumbnail/' . $current_user_id);
        }

        if ($image) {

            $unique_image_name = hexdec(uniqid()) . time();
            $name_gen = $unique_image_name . '.' . 'jpg';
            $name_gen_sm = $unique_image_name . '_sm.' . 'jpg';
            Image::make($image)->fit(880, 990)->encode('jpg')->save('storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen);
            Image::make($image)->fit(222, 250)->encode('jpg')->save('storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen_sm);
            $save_url = 'storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen;
            $save_url_sm = 'storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen_sm;

            $old_img = Purify::clean($request->old_image);
            if (file_exists($old_img)) {
                unlink($old_img);
                unlink(Purify::clean($request->old_image_sm));
            }

            Product::findOrFail($product_id)->update([
                'category_id' => $category_id,
                'parent_category_id' => $parent_category_id ?? NULL,
                'parent_category_name' => $parent_category_name ?? NULL,
                'product_name' => Purify::clean($incomingFields['product_name']),
                'product_slug' => strtolower(str_replace(' ', '-', Purify::clean($incomingFields['product_slug']))),
                'product_code' => Purify::clean($request->product_code),
                'selling_price' => Purify::clean($incomingFields['selling_price']),
                'long_desc' => ($request->long_desc),
                'product_thumbnail' => $save_url,
                'product_thumbnail_sm' => $save_url_sm,
                'product_qty' => Purify::clean($request->product_qty) >= 0 ? Purify::clean($request->product_qty) : 0,
                'short_desc' => ($request->short_desc),
                'featured' => 1,
                'status' => Purify::clean($request->product_status) == 'active' ? 'active' : 'disabled',
                'unlimitedStock' => Purify::clean($request->unlimitedStock) == 'active' ? 'active' : 'disabled',
                'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
                'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
                'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
                'specification' => ($request->specification),
                'product_verification' => Purify::clean($product_verification),
                'trading_method' => Purify::clean($request->trading_method),
            ]);

        } else {

            Product::findOrFail($product_id)->update([
                'category_id' => $category_id,
                'parent_category_id' => $parent_category_id ?? NULL,
                'parent_category_name' => $parent_category_name ?? NULL,
                'product_name' => Purify::clean($incomingFields['product_name']),
                'product_slug' => strtolower(str_replace(' ', '-', Purify::clean($incomingFields['product_slug']))),
                'product_code' => Purify::clean($request->product_code),
                'selling_price' => Purify::clean($incomingFields['selling_price']),
                'long_desc' => ($request->long_desc),
                'product_qty' => Purify::clean($request->product_qty) >= 0 ? Purify::clean($request->product_qty) : 0,
                'short_desc' => ($request->short_desc),
                'featured' => 1,
                'status' => Purify::clean($request->product_status) == 'active' ? 'active' : 'disabled',
                'unlimitedStock' => Purify::clean($request->unlimitedStock) == 'active' ? 'active' : 'disabled',
                'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
                'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
                'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
                'specification' => ($request->specification),
                'product_verification' => Purify::clean($product_verification),
                'trading_method' => Purify::clean($request->trading_method),
            ]);
        }

        if (Purify::clean($incomingFields['category_id'])) {
            foreach (Purify::clean($incomingFields['category_id']) as $cat_id) {
                CategoryProduct::where('product_id', $product_id)->delete();
            }

            foreach (Purify::clean($incomingFields['category_id']) as $cat_id) {
                CategoryProduct::insert([
                    'category_id' => $cat_id,
                    'product_id' => $product_id,
                ]);
            }
        } elseif (empty(Purify::clean($incomingFields['category_id']))) {
            CategoryProduct::where('product_id', $product_id)->delete();
        }

        // بخش مدیریت ویژگی ها
        if($request->attribute) {
            $product = Product::find($product_id);

            $attributes = [];
            $attribute_id = collect($request->attribute)->keys()->first();
            foreach (Purify::clean(collect($request->attribute)->first()) as $key => $attribute_item) {
                $attribute_in_loop = AttributeItem::find($key);
                if($attribute_in_loop->attribute_item_type == "dropdown" && $attribute_item["attribute_value_id"] != 'none' && !$attribute_in_loop->multiple_selection_attribute) {
                    if(!$attribute_in_loop->disabled_attribute) {
                        // برای ویژگی هایی که غیر فعال نیستن
                        $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_item["attribute_value_id"], "attribute_value" => NULL);
                    } elseif($attribute_in_loop->disabled_attribute && $product->attributes()->where('attribute_item_id', $key)->first() != null) {
                        // برای ویژگی هایی که غیر فعال شده اند
                        $attributes[][$attribute_id] = array(
                            // چون ویژگی غیر فعال شده میاد از دیتابیس اون مورد رو جایگزین می کنه
                            "attribute_item_id" => (int) $product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_item_id,
                            "attribute_value_id" => (int) $product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_value_id,
                            "attribute_value" => NULL
                        );
                    }
                } elseif($attribute_in_loop->attribute_item_type == "dropdown" && count(collect($attribute_item["attribute_value_id"])) > 1 && $attribute_in_loop->multiple_selection_attribute) {
                    // به خاطر گزینه چندگانه باید همه مقادیر وارد گردد

                    if(!$attribute_in_loop->disabled_attribute) {
                        // برای ویژگی هایی که غیر فعال نیستن
                        foreach ($attribute_item["attribute_value_id"] as $attribute_value_id_key => $attribute_value_id_item) {
                            if($attribute_value_id_key == 0) {
                                continue;
                            }
                            $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_value_id_item, "attribute_value" => NULL
                            );
                        }
                    } elseif($attribute_in_loop->disabled_attribute && $product->attributes()->where('attribute_item_id', $key)->first() != null) {
                        // برای ویژگی هایی که غیر فعال شده اند
                        foreach ($product->attributes()->where('attribute_item_id', $key)->pluck('attribute_value_id') as $attribute_value_id_key => $attribute_value_id_item) {
                            
                            $attributes[][$attribute_id] = array(
                                "attribute_item_id" => (int) $product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_item_id, 
                                "attribute_value_id" => (int) $attribute_value_id_item, 
                                "attribute_value" => NULL
                            );
                        }
                        
                    }

                } elseif($attribute_in_loop->attribute_item_type == "input_field" && $attribute_item["attribute_value"] != '' && !$attribute_in_loop->multiple_selection_attribute) {
                    if(!$attribute_in_loop->disabled_attribute) {
                        // برای ویژگی هایی که غیر فعال نیستن
                        $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_item["attribute_value_id"], "attribute_value" => Purify::clean($attribute_item["attribute_value"]));
                    } elseif($attribute_in_loop->disabled_attribute && $product->attributes()->where('attribute_item_id', $key)->first() != null) {
                        // برای ویژگی هایی که غیر فعال شده اند
                        $attributes[][$attribute_id] = array(
                            "attribute_item_id" => (int) $product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_item_id, 
                            "attribute_value_id" => (int) $product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_value_id,
                            "attribute_value" => (int) $product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_value
                        );
                    }
                }
            }

            $product->attributes()->detach();
            if (count($attributes) ) {
                foreach ($attributes as $attribute_item) {
                    $product->attributes()->attach($attribute_item);
                }
            }
        }    
        // بخش مدیریت ویژگی ها

        if ($product_verification == 'inactive') {
            return redirect()->route('merchant.all.product')->with('success', 'محصول مورد نظر با موفقیت به‌روزرسانی و پس از تایید کارشناس منتشر خواهد شد.');
        }

        

        return redirect()->route('merchant.all.product')->with('success', 'محصول مورد نظر با موفقیت به‌روزرسانی گردید.');
    } //End method

    public function MerchantDeleteProduct($id)
    {
        $product = Product::findOrFail(Purify::clean($id));

        if ($product->merchant_id != Auth::user()->id) {
            return redirect()->route('merchant.all.product')->with('error', 'شما اجازه حذف این محصول را ندارید!');
        }

        $img = $product->product_thumbnail;
        $img_sm = $product->product_thumbnail_sm;
        unlink($img);
        unlink($img_sm);

        Product::findOrFail(Purify::clean($id))->delete();

        return redirect()->route('merchant.all.product')->with('success', 'محصول مورد نظر با موفقیت حذف گردید.');
    } //End method

    public function MerchantCopyProduct($id)
    {
        $user_id = Auth::user()->id;
        $merchantData = User::find($user_id);

        $categories = Category::latest()->get();
        $products = Product::findOrFail(Purify::clean($id));
       
        $allAttributes = AttributeItem::find($products->attributes()->pluck('attribute_item_id'));

        $parentCategories = Category::where('parent', 0)->get();
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }

        return view('merchant.backend.product.merchant_product_copy', compact('merchantData', 'filter_category_array', 'products','allAttributes'));
    } //End method

    public function MerchantStoreCopyProduct(Request $request)
    {
        $incomingFields = $request->validate([
            'category_id' => 'required',
            'product_name' => ['required', Rule::unique('products', 'product_name')],
            'product_slug' => ['required', Rule::unique('products', 'product_slug')],
            'selling_price' => ['required', 'numeric'],
            'attribute' => ['required', new AttributeIsRequired()],
        ], [
            'category_id.required' => 'لطفا یک دسته بندی مرتبط برای محصول انتخاب نمایید.',
            'product_name.required' => 'لطفا نام محصول را وارد نمایید.',
            'product_name.unique' => 'نام محصول قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
            'product_slug.required' => 'لطفا اسلاگ را وارد نمایید.',
            'product_slug.unique' => 'اسلاگ قبلا ثبت شده است. لطفا یک عبارت دیگر وارد کنید.',
            'selling_price.required' => 'لطفا قیمت محصول را وارد نمایید.',
            'selling_price.numeric' => 'لطفا قیمت محصول را به درستی وارد نمایید.',
            'attribute.required' => 'لطفا حداقل یک ویژگی مرتبط با محصول انتخاب نمایید.',
        ]);

        // create string of category id which is array, to store the string into DB
        if (Purify::clean($incomingFields['category_id'])) {
            $category_id = implode(',', Purify::clean($incomingFields['category_id']));
        } else {
            $category_id = "";
        }

        // calculate root category name and id
        $parent_category_name = NULL;
        $parent_category_id = NULL;
        if (Purify::clean($incomingFields['category_id'])) {
            foreach (Purify::clean($incomingFields['category_id']) as $cat_id_item) {
                $cat_item_obj = Category::find($cat_id_item);
                if ((int) $cat_item_obj->parent == 0) {
                    $parent_category_name = $cat_item_obj->category_name;
                    $parent_category_id = $cat_item_obj->id;
                }
            }
        }

        // check if user has forgotten to select a root category item
        if ($parent_category_id == NULL) {
            return back()->with('error', 'لطفا دسته بندی اصلی مرتبط با محصول را انتخاب نمایید.')->withInput();
        }

        // get current user id and create a folder with id
        $current_user_id = auth()->user()->id;
        if (! LaravelFile::exists('storage/upload/products/thumbnail/' . $current_user_id)) {
            LaravelFile::makeDirectory('storage/upload/products/thumbnail/' . $current_user_id);
        }

        if (Purify::clean($request->product_thumbnail)) {
            $image = Purify::clean($request->product_thumbnail);

            $unique_image_name = hexdec(uniqid());
            $name_gen = $unique_image_name . '.' . 'jpg';
            $name_gen_sm = $unique_image_name . '_sm.' . 'jpg';
            Image::make($image)->fit(880, 990)->encode('jpg')->save('storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen);
            Image::make($image)->fit(222, 250)->encode('jpg')->save('storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen_sm);
            $save_url = 'storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen;
            $save_url_sm = 'storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen_sm;
        } else {
            $unique_image_name = hexdec(uniqid());
            $name_gen = $unique_image_name . '.' . 'jpg';
            $name_gen_sm = $unique_image_name . '_sm.' . 'jpg';

            \File::copy(Purify::clean($request->old_image), 'storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen);
            \File::copy(Purify::clean($request->old_image_sm), 'storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen_sm);

            $save_url = 'storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen;
            $save_url_sm = 'storage/upload/products/thumbnail/' . $current_user_id . "/" . $name_gen_sm;
        }

        $product_id = Product::insertGetId([
            'category_id' => $category_id,
            'parent_category_id' => $parent_category_id ?? NULL,
            'parent_category_name' => $parent_category_name ?? NULL,
            'product_name' => Purify::clean($incomingFields['product_name']),
            'product_slug' => strtolower(str_replace(' ', '-', Purify::clean($incomingFields['product_slug']))),
            'product_code' => Purify::clean($request->product_code),
            'selling_price' => Purify::clean($incomingFields['selling_price']),
            'long_desc' => ($request->long_desc),
            'merchant_id' => Auth::user()->id,
            'product_thumbnail' => $save_url,
            'product_thumbnail_sm' => $save_url_sm,
            'product_qty' => Purify::clean($request->product_qty) >= 0 ? Purify::clean($request->product_qty) : 0,
            'short_desc' => ($request->short_desc),
            'featured' => 1,
            'status' => Purify::clean($request->product_status) == 'active' ? 'active' : 'disabled',
            'unlimitedStock' => Purify::clean($request->unlimitedStock) == 'active' ? 'active' : 'disabled',
            'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
            'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
            'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
            'specification' => ($request->specification),
            'owner_id' => Auth::user()->id,
            'trading_method' => Purify::clean($request->trading_method),
        ]);

        if (Purify::clean($incomingFields['category_id'])) {
            foreach (Purify::clean($incomingFields['category_id']) as $cat_id) {
                CategoryProduct::insert([
                    'category_id' => $cat_id,
                    'product_id' => $product_id,
                ]);
            }
        }

        // بخش مدیریت ویژگی ها
        if($request->attribute) {

            $host_product = Product::find(Purify::clean((int) $request->id));
            $product = Product::find($product_id);

            $attributes = [];
            $attribute_id = collect($request->attribute)->keys()->first();
            foreach (Purify::clean(collect($request->attribute)->first()) as $key => $attribute_item) {
                $attribute_in_loop = AttributeItem::find($key);
                if($attribute_in_loop->attribute_item_type == "dropdown" && $attribute_item["attribute_value_id"] != 'none' && !$attribute_in_loop->multiple_selection_attribute) {
                    if(!$attribute_in_loop->disabled_attribute) {
                        // برای ویژگی هایی که غیر فعال نیستن
                        $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_item["attribute_value_id"], "attribute_value" => NULL);
                    } elseif($attribute_in_loop->disabled_attribute && $product->attributes()->where('attribute_item_id', $key)->first() != null) {
                        // برای ویژگی هایی که غیر فعال شده اند
                        $attributes[][$attribute_id] = array(
                            // چون ویژگی غیر فعال شده میاد از دیتابیس اون مورد رو جایگزین می کنه
                            "attribute_item_id" => (int) $host_product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_item_id,
                            "attribute_value_id" => (int) $host_product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_value_id,
                            "attribute_value" => NULL
                        );
                    }
                } elseif($attribute_in_loop->attribute_item_type == "dropdown" && count(collect($attribute_item["attribute_value_id"])) > 1 && $attribute_in_loop->multiple_selection_attribute) {
                    // به خاطر گزینه چندگانه باید همه مقادیر وارد گردد

                    if(!$attribute_in_loop->disabled_attribute) {
                        // برای ویژگی هایی که غیر فعال نیستن
                        foreach ($attribute_item["attribute_value_id"] as $attribute_value_id_key => $attribute_value_id_item) {
                            if($attribute_value_id_key == 0) {
                                continue;
                            }
                            $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_value_id_item, "attribute_value" => NULL
                            );
                        }
                    } elseif($attribute_in_loop->disabled_attribute && $product->attributes()->where('attribute_item_id', $key)->first() != null) {
                        // برای ویژگی هایی که غیر فعال شده اند
                        foreach ($host_product->attributes()->where('attribute_item_id', $key)->pluck('attribute_value_id') as $attribute_value_id_key => $attribute_value_id_item) {
                            
                            $attributes[][$attribute_id] = array(
                                "attribute_item_id" => (int) $host_product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_item_id, 
                                "attribute_value_id" => (int) $attribute_value_id_item, 
                                "attribute_value" => NULL
                            );
                        }
                        
                    }

                } elseif($attribute_in_loop->attribute_item_type == "input_field" && $attribute_item["attribute_value"] != '' && !$attribute_in_loop->multiple_selection_attribute) {
                    if(!$attribute_in_loop->disabled_attribute) {
                        // برای ویژگی هایی که غیر فعال نیستن
                        $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_item["attribute_value_id"], "attribute_value" => Purify::clean($attribute_item["attribute_value"]));
                    } elseif($attribute_in_loop->disabled_attribute && $product->attributes()->where('attribute_item_id', $key)->first() != null) {
                        // برای ویژگی هایی که غیر فعال شده اند
                        $attributes[][$attribute_id] = array(
                            "attribute_item_id" => (int) $host_product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_item_id, 
                            "attribute_value_id" => (int) $host_product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_value_id,
                            "attribute_value" => (int) $host_product->attributes()->where('attribute_item_id', $key)->first()->pivot->attribute_value
                        );
                    }
                }
            }

            $product->attributes()->detach();
            if (count($attributes) ) {
                foreach ($attributes as $attribute_item) {
                    $product->attributes()->attach($attribute_item);
                }
            }
        }    
        // بخش مدیریت ویژگی ها

        $product->searchable();

        return redirect()->route('merchant.all.product')->with('success', 'محصول مورد نظر با موفقیت ایجاد و پس از تایید کارشناس منتشر خواهد شد.');
    } //End method

    public function LoadAttributes(Request $request) {
        $role = Purify::clean($request->role);

        $selected_categories_id = (int) Purify::clean($request->id);
        $attributes = Category::find($selected_categories_id)->attributes()->get();
        $attribute_items = Category::find($selected_categories_id)->attributes()->with('items')->get()->pluck('items')->flatten();

        // اینجا چک میکند که آیا موردی پیدا می شود یا خیر، اگر نشد روی ایجکس قفل نکند
        if(!sizeof($attributes)) {
            return response(['attributes' => null]);
        }

        // اینجا برای هر ویژگی چک کن که آیا مجاز به استفاده از اون ویژگی هست یا خیر
        $user_role_permission = true;
        if(!in_array($role, explode(',', $attributes[0]->role))) {
            $user_role_permission = false;
        } 
        foreach ($attribute_items as $attribute_item) {
            if($user_role_permission && ($attributes[0]->category_id == $selected_categories_id)){
                $attribute_item->push(['values' => $attribute_item->values]);
                $category_related_attributes_arr[] = $attribute_item;
            }
        }    

        // این بخش مربوط به برگشت مقادیر ست شده روی هر اتریبیوت است
        if($request->product_id) {
            // پیدا کردن اتریبیوت های ست شده روی یک محصول
            $product_id = (int) Purify::clean($request->product_id);
            $product_selected_attribute_array = Product::find($product_id)->attribute_items_obj_array();
            // ایجاد یک آرایه از آی دی مقادیر انتخاب شده برای هر اتریبیوت
            $product_selected_attribute_value_id_array = [];
            foreach ($product_selected_attribute_array as $product_selected_attribute_item) {
                foreach ($product_selected_attribute_item['attribute_value_obj'] as $key => $value_item) {
                    $product_selected_attribute_value_id_array[] = $product_selected_attribute_item['attribute_value_obj'][$key]['id'];
                }
            }
        } else {
            $product_selected_attribute_array = [];
            $product_selected_attribute_value_id_array = [];
        }
        
        return response(['attributes' => $category_related_attributes_arr, 'product_selected_attribute_array' => $product_selected_attribute_array, 'product_selected_attribute_value_id_array' => $product_selected_attribute_value_id_array]);
    }

    public function ViewMerchantOrders()
    {
        $user_id = Auth::user()->id;
        $merchantData = User::find($user_id);
        $orders = Order::orderBy('id', 'DESC')->where('status', Purify::clean(request('type')))->get();
        
        return view('merchant.merchant_orderslist', compact('orders', 'merchantData'));
    } //End method

    public function DestroyMerchantOrder($id)
    {
        $user_id = Auth::user()->id;
        $order = Order::findOrFail(Purify::clean($id));

        foreach ($order->products()->get() as $item) {
            if ($item->merchant_id != $user_id) {
                return back();
            }
        }
        $order->delete();

        return back()->with('success', 'سفارش مورد نظر با موفقیت حذف گردید.');
    } //End method

    public function ViewMerchantOrderItem($id)
    {
        $user_id = Auth::user()->id;
        $merchantData = User::find($user_id);

        $order = Order::findOrFail(Purify::clean($id));
        return view('merchant.merchant_order_detail', compact('order', 'merchantData'));
    } //End method

    public function ChangeMerchantOrderStatus(Request $request)
    {
        $user_id = Auth::user()->id;
        $order = Order::findOrFail(Purify::clean($request->id));

        foreach ($order->products()->get() as $item) {
            if ($item->merchant_id != $user_id) {
                return back();
            }
        }
        $order->update(['status' => $request->status]);

        return back()->with('success', 'سفارش مورد نظر با موفقیت به‌روزرسانی گردید.');
    } //End method

    public function MerchantAboutPage()
    {
        $id = Auth::user()->id;
        $merchantData = User::find($id);

        return view('merchant.merchant_pages.about_merchant', compact('merchantData'));
    } //End method

    public function MerchantStoreAboutPage(Request $request)
    {
        $id = Auth::user()->id;
        $merchantData = User::find($id);
        $data = User::find($id);

        $incomingFields = $request->validate([
            'merchant_description' => 'required',
        ], [
            'merchant_description.required' => 'لطفا توضیحات بازرگان را وارد نمایید.',
        ]);

        if ($data->vendor_description == ($request->merchant_description)) {
            if ($data->vendor_description_status == 'active') {
                $data->vendor_description_status = 'active';
                $product_verification_changed = false;
            } else {
                $data->vendor_description_status = 'inactive';
                $product_verification_changed = true;
            }
        } else {
            $data->vendor_description_status = 'inactive';
            $product_verification_changed = true;
        }

        $data->vendor_description = ($incomingFields['merchant_description']);

        $data->save();

        if ($product_verification_changed == true) {
            return back()->with('success', 'اطلاعات با موفقیت ذخیره و پس از تایید کارشناس در صفحه هر محصول نمایش داده خواهد شد.');
        } else {
            return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
        }

    } //End method

    public function MerchantCreateOutlet()
    {
        $id = Auth::user()->id;
        $merchantData = User::find($id);

        return view('merchant.outlets.merchant_outlet_add', compact('merchantData'));
    } //End method

    public function MerchantStoreOutlet(Request $request)
    {

        $incomingFields = $request->validate([
            'shop_name' => 'required',
            'shop_address' => 'required',
            'latitude' => 'required',
        ], [
            'shop_name.required' => 'لطفا نام فروشگاه / شرکت را وارد نمایید.',
            'shop_address.required' => 'لطفا آدرس فروشگاه / شرکت را وارد نمایید.',
            'latitude.required' => 'لطفا مکان فروشگاه / شرکت را از روی نقشه انتخاب نمایید.',
        ]);


        Merchantoutlet::insert([
            'shop_name' => Purify::clean($incomingFields['shop_name']),
            'shop_address' => Purify::clean($incomingFields['shop_address']),
            'latitude' => Purify::clean($incomingFields['latitude']),
            'longitude' => Purify::clean($request->longitude),
            'shop_postalcode' => Purify::clean($request->shop_postalcode) ? Purify::clean($request->shop_postalcode) : NULL,
            'shop_phone' => Purify::clean($request->shop_phone) ? Purify::clean($request->shop_phone) : NULL,
            'shop_fax' => Purify::clean($request->shop_fax) ? Purify::clean($request->shop_fax) : NULL,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect(route('merchant.all.outlet'))->with('success', 'آدرس مورد نظر با موفقیت اضافه گردید.');
    } //End method

    public function MerchantAllOutlet()
    {
        $id = Auth::user()->id;
        $merchantData = User::find($id);

        $outlets = Merchantoutlet::where('user_id', $id)->orderBy("id", 'asc')->get();

        return view('merchant.outlets.merchant_outlet_all', compact('merchantData', 'outlets'));
    } //End method

    public function MerchantEditOutlet($outlet_id)
    {
        $id = Auth::user()->id;
        $merchantData = User::find($id);

        $outlet = Merchantoutlet::find(Purify::clean($outlet_id));

        return view('merchant.outlets.merchant_outlet_edit', compact('merchantData', 'outlet'));
    } //End method

    public function MerchantUpdateOutlet(Request $request)
    {

        $outlet_id = Purify::clean($request->outlet_id);

        $incomingFields = $request->validate([
            'shop_name' => 'required',
            'shop_address' => 'required',
        ], [
            'shop_name.required' => 'لطفا نام فروشگاه / شرکت را وارد نمایید.',
            'shop_address.required' => 'لطفا آدرس فروشگاه / شرکت را وارد نمایید.',
        ]);


        if (Purify::clean($request->latitude) && Purify::clean($request->longitude)) {
            Merchantoutlet::findOrFail($outlet_id)->update([
                'shop_name' => Purify::clean($incomingFields['shop_name']),
                'shop_address' => Purify::clean($incomingFields['shop_address']),
                'latitude' => Purify::clean($request->latitude),
                'longitude' => Purify::clean($request->longitude),
                'shop_postalcode' => Purify::clean($request->shop_postalcode) ? Purify::clean($request->shop_postalcode) : NULL,
                'shop_phone' => Purify::clean($request->shop_phone) ? Purify::clean($request->shop_phone) : NULL,
                'shop_fax' => Purify::clean($request->shop_fax) ? Purify::clean($request->shop_fax) : NULL,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Merchantoutlet::findOrFail($outlet_id)->update([
                'shop_name' => Purify::clean($incomingFields['shop_name']),
                'shop_address' => Purify::clean($incomingFields['shop_address']),
                'shop_postalcode' => Purify::clean($request->shop_postalcode) ? Purify::clean($request->shop_postalcode) : NULL,
                'shop_phone' => Purify::clean($request->shop_phone) ? Purify::clean($request->shop_phone) : NULL,
                'shop_fax' => Purify::clean($request->shop_fax) ? Purify::clean($request->shop_fax) : NULL,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect(route('merchant.all.outlet'))->with('success', 'آدرس مورد نظر با موفقیت به روز رسانی گردید.');
    } //End method

    public function MerchantDeleteOutlet($outlet_id)
    {
        Merchantoutlet::findOrFail(Purify::clean($outlet_id))->delete();

        return redirect(route('merchant.all.outlet'))->with('success', 'آدرس مورد نظر با موفقیت حذف گردید.');
    } //End method

    // media functions begin
    public function MerchantMediaFiles()
    {

        $id = Auth::user()->id;
        $merchantData = User::find($id);

        $files = File::latest()->get();

        return view('merchant.media.files', compact('merchantData', 'files'));
    } //End method

    public function MerchantMediaAddFiles()
    {
        $id = Auth::user()->id;
        $merchantData = User::find($id);

        return view('merchant.media.add', compact('merchantData'));
    } //End method

    public function MerchantMediaStoreFiles(Request $request)
    {

        $id = Auth::user()->id;
        $merchantData = User::find($id);

        $incomingFields = $request->validate([
            'file_upload' => ['required', 'image', 'max:5000'],
        ], [
            'file_upload.required' => 'لطفا تصویر را بارگذاری نمایید.',
            'file_upload.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'file_upload.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
        ]);

        if (! LaravelFile::exists('storage/upload/media_files/' . $id)) {
            LaravelFile::makeDirectory('storage/upload/media_files/' . $id);
        }

        $actualfileName = Purify::clean($incomingFields['file_upload']->getClientOriginalName());
        $fileSize = Purify::clean($incomingFields['file_upload']->getSize());

        $image = $incomingFields['file_upload'];
        $name_gen = hexdec(uniqid()) . '.' . 'jpg';
        Image::make($image)->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg')->save('storage/upload/media_files/' . $id . '/' . $name_gen);

        $save_url = 'storage/upload/media_files/' . $id . '/' . $name_gen;


        File::insert([
            'fileName' => $save_url,
            'user_id' => $id,
            'actualfileName' => $actualfileName,
            'fileSize' => $fileSize / 1000,
        ]);

        return redirect(route('merchant.media.files'))->with('success', 'فایل مورد نظر با موفقیت بارگذاری گردید.');
    } //End method

    public function MerchantDeleteFile($id)
    {
        $user_id = Auth::user()->id;
        $file = File::findOrFail(Purify::clean($id));
        $img = $file->fileName;

        if ($file->user_id == $user_id) {
            unlink($img);
            File::findOrFail($id)->delete();
        } else {
            return redirect(route('merchant.media.files'))->with('error', 'شما اجازه حذف این فایل را ندارید!');
        }

        return redirect(route('merchant.media.files'))->with('success', 'فایل مورد نظر با موفقیت حذف گردید.');
    } //End method

    // media functions ends

}