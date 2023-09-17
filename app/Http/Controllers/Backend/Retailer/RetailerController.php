<?php

namespace App\Http\Controllers\Backend\Retailer;

use Carbon\Carbon;
use App\Models\File;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\Retaileroutlet;
use App\Models\CategoryProduct;
use Illuminate\Validation\Rule;
use App\Rules\AttributeIsRequired;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\File as LaravelFile;

class RetailerController extends Controller
{
    public function RetailerDashboard()
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);

        return view('retailer.index', compact('retailerData'));
    } //End method
    public function RetailerDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //End method

    public function RetailerProfile()
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);

        $retailer_sector_arr = explode(",", $retailerData->vendor_sector);
        $retailer_sector_cat_arr = [];
        foreach ($retailer_sector_arr as $retailer_sector_item) {
            $retailer_sector_cat_arr[] = Category::find($retailer_sector_item);
        }

        return view('retailer.retailer_profile_view', compact('retailerData', 'retailer_sector_cat_arr'));
    } //End method

    public function RetailerProfileSettings()
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);

        $parentCategories = Category::where('parent', 0)->latest()->get()->reverse();

        $retailer_sector_arr = explode(",", $retailerData->vendor_sector);
        $retailer_sector_cat_id_arr = [];
        foreach ($retailer_sector_arr as $retailer_sector_item) {
            $retailer_sector_cat_id_arr[] = Category::find($retailer_sector_item)->id;
        }

        return view('retailer.retailer_profile_settings', compact('retailerData', 'parentCategories', 'retailer_sector_cat_id_arr'));
    } //End method

    public function RetailerProfileStore(Request $request)
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

        if (Purify::clean($request->person_type) == 'haghighi') {

            if (Purify::clean($request->national_code) == null) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا کد ملی خود را وارد نمایید.');
            }

            if (strlen(Purify::clean($request->national_code)) != 10 || ! is_numeric(Purify::clean($request->national_code))) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا کد ملی صحیح وارد نمایید.');
            }

        } elseif (Purify::clean($request->person_type) == 'hoghoghi') {

            if (Purify::clean($request->company_number) == null) {
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

        if (Purify::clean($request->file('photo'))) {
            $file = Purify::clean($request->file('photo'));

            if (Purify::clean($data->photo) != null) {
                unlink('storage/upload/retailer_images/' . $data->photo);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(160)->encode('jpg')->save('storage/upload/retailer_images/' . $filename);
            $data['photo'] = $filename;
        }

        if (Purify::clean($request->file('store_banner'))) {
            $file = Purify::clean($request->file('store_banner'));

            if ($data->store_banner != null) {
                unlink('storage/upload/retailer_images/' . $data->store_banner);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(930, 446)->encode('jpg')->save('storage/upload/retailer_images/' . $filename);
            $data['store_banner'] = $filename;
        }

        if (Purify::clean($request->vendor_sector) != null) {
            $data->vendor_sector = implode(',', Purify::clean($request->vendor_sector));
        } else {
            return back()->with('error', 'لطفا زمینه فعالیت فروشنده را مشخص نمایید');
        }

        $data->save();
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');

    } //End method

    public function RetailerProfileFinancialStatement()
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);
        return view('retailer.retailer_profile_financial_statement', compact('retailerData'));
    }
    public function RetailerProfileFinancialStatementStore(Request $request)
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
            $data->cart_number = null;
        }

        $data->save();
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    } //End method

    public function RetailerAboutPage()
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);

        return view('retailer.retailer_pages.about_retailer', compact('retailerData'));
    } //End method

    public function RetailerStoreAboutPage(Request $request)
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);
        $data = User::find($id);

        $incomingFields = $request->validate([
            'vendor_description' => 'required',
        ], [
            'vendor_description.required' => 'لطفا توضیحات فروشگاه را وارد نمایید.',
        ]);

        if ($data->vendor_description == ($request->vendor_description)) {
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

        $data->vendor_description = ($incomingFields['vendor_description']);

        $data->save();

        if ($product_verification_changed == true) {
            return back()->with('success', 'اطلاعات با موفقیت ذخیره و پس از تایید کارشناس در صفحه هر محصول نمایش داده خواهد شد.');
        } else {
            return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
        }

    } //End method

    public function RetailerMediaFiles()
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);

        $files = File::latest()->get();

        return view('retailer.media.files', compact('retailerData', 'files'));
    }
    public function RetailerMediaAddFiles()
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);

        return view('retailer.media.add', compact('retailerData'));
    }

    public function RetailerMediaStoreFiles(Request $request)
    {

        $id = Auth::user()->id;
        $retailerData = User::find($id);

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

        $image = Purify::clean($incomingFields['file_upload']);
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

        return redirect(route('retailer.media.files'))->with('success', 'فایل مورد نظر با موفقیت بارگذاری گردید.');
    }

    public function RetailerDeleteFile($id)
    {
        $user_id = Auth::user()->id;
        $file = File::findOrFail(Purify::clean($id));
        $img = $file->fileName;

        if ($file->user_id == $user_id) {
            unlink($img);
            File::findOrFail($id)->delete();
        } else {
            return redirect(route('retailer.media.files'))->with('error', 'شما اجازه حذف این فایل را ندارید!');
        }

        return redirect(route('retailer.media.files'))->with('success', 'فایل مورد نظر با موفقیت حذف گردید.');
    }
    // media functions ends

    public function RetailerAllProduct()
    {
        $user_id = Auth::user()->id;
        $retailerData = User::find($user_id);
        $selected_retailer_id_array = [];
        $retailer_products = [];

        $products = Product::latest()->get();

        foreach ($products as $product) {
            if (in_array($user_id, explode(",", $product->retailer_id))) {
                $retailer_products[] = $product;
            }
        }

        return view('retailer.backend.product.retailer_product_all', compact('retailer_products', 'retailerData'));
    }

    public function RetailerAddProduct()
    {
        $user_id = Auth::user()->id;
        $retailerData = User::find($user_id);
        $categories = Category::latest()->get();

        // added recursive function to find all the categories related to specialist category
        $category_hierarchy_arr = [];
        $retailerSectorArr = explode(",", $retailerData->vendor_sector);

        foreach ($categories as $category_item) {
            $category_by_id = Category::find($category_item->id);
            if ($category_item->parentCategoryExists($category_item->id)) {
                foreach ($categories as $categoryItem) {
                    if ($category_by_id->parent == 0) {
                        $root_catgory_obj = $category_by_id;
                        break;
                    } else {
                        $category_by_id = Category::find($category_by_id->parent);
                    }
                }

                if (in_array($root_catgory_obj->id, $retailerSectorArr)) {
                    $category_hierarchy_arr[] = $category_item;
                }
            }
        }
        foreach ($retailerSectorArr as $retailerSectorItem) {
            array_push($category_hierarchy_arr, Category::find($retailerSectorItem));
        }
        $categories = array_reverse($category_hierarchy_arr);
        // end of - recursive function

        $allAttributes = Attribute::get();

        return view('retailer.backend.product.retailer_product_add', compact('retailerData', 'categories', 'allAttributes'));
    }

    public function RetailerStoreProduct(Request $request)
    {
        $incomingFields = $request->validate([
            'product_thumbnail' => ['required', 'image', 'max:5000'],
            'category_id' => 'required',
            'product_name' => ['required', Rule::unique('products', 'product_name')],
            'product_slug' => ['required', Rule::unique('products', 'product_slug')],
            'selling_price' => ['required', 'numeric'],
            'attribute' => new AttributeIsRequired()
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

        $image = Purify::clean($incomingFields['product_thumbnail']);
        $unique_image_name = hexdec(uniqid()) . time();
        $name_gen = $unique_image_name . '.' . 'jpg';
        $name_gen_sm = $unique_image_name . '_sm.' . 'jpg';
        Image::make($image)->fit(880, 990)->encode('jpg')->save('storage/upload/products/thumbnail/' . $name_gen);
        Image::make($image)->fit(222, 250)->encode('jpg')->save('storage/upload/products/thumbnail/' . $name_gen_sm);
        $save_url = 'storage/upload/products/thumbnail/' . $name_gen;
        $save_url_sm = 'storage/upload/products/thumbnail/' . $name_gen_sm;


        $product_id = Product::insertGetId([
            'category_id' => $category_id,
            'parent_category_id' => $parent_category_id ?? NULL,
            'parent_category_name' => $parent_category_name ?? NULL,
            'product_name' => Purify::clean($incomingFields['product_name']),
            'product_slug' => strtolower(str_replace(' ', '-', Purify::clean($incomingFields['product_slug']))),
            'product_code' => Purify::clean($request->product_code),
            'selling_price' => Purify::clean($incomingFields['selling_price']),
            'long_desc' => ($request->long_desc),
            'retailer_id' => Auth::user()->id,
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
            'currency' => Purify::clean($request['currency']),
            'measurement' => Purify::clean($request['measurement']) ?? "none",
            'packing' => Purify::clean($request['packing']) ?? "none",
            'specification' => ($request->specification),
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
            foreach (Purify::clean($request->attribute) as $key => $attribute) {
                $attribute_in_loop = Attribute::find($key);
                if($attribute_in_loop->attribute_type == "dropdown" && $attribute["value_id"] != 'none') {
                    $attributes[$key] = array("value_id" => (int) $attribute["value_id"], "value" => NULL);
                } elseif($attribute_in_loop->attribute_type == "input_field" && $attribute["value"] != '') {
                    $attributes[$key] = array("value_id" => (int) $attribute["value_id"], "value" => Purify::clean($attribute["value"]));
                }
            }
            if (count($attributes) ) {
                $product->attributes()->attach($attributes);
            }
        }    
        // بخش مدیریت ویژگی ها

        return redirect()->route('retailer.all.product')->with('success', 'محصول مورد نظر با موفقیت ایجاد و پس از تایید کارشناس منتشر خواهد شد.');
    }

    public function RetailerEditProduct($id)
    {
        $selected_category_array = [];
        $nonselected_category_array = [];

        $user_id = Auth::user()->id;
        $retailerData = User::find($user_id);

        $retailersName = User::where('role', 'retailer')->where('status', 'active')->latest()->get();
        $categories = Category::latest()->get();

        // added recursive function to find all the categories related to specialist category
        $category_hierarchy_arr = [];
        $retailerSectorArr = explode(",", $retailerData->vendor_sector);

        foreach ($categories as $category_item) {
            $category_by_id = Category::find($category_item->id);
            if ($category_item->parentCategoryExists($category_item->id)) {
                foreach ($categories as $categoryItem) {
                    if ($category_by_id->parent == 0) {
                        $root_catgory_obj = $category_by_id;
                        break;
                    } else {
                        $category_by_id = Category::find($category_by_id->parent);
                    }
                }

                if (in_array($root_catgory_obj->id, $retailerSectorArr)) {
                    $category_hierarchy_arr[] = $category_item;
                }
            }
        }
        foreach ($retailerSectorArr as $retailerSectorItem) {
            array_push($category_hierarchy_arr, Category::find($retailerSectorItem));
        }
        $categories = array_reverse($category_hierarchy_arr);
        // end of - recursive function

        // these lines of code are all for category dropdown select form
        $products = Product::findOrFail(Purify::clean($id));
        $selected_cat_id_array = explode(",", $products->category_id);
        $selected_retailer_id_array = explode(",", $products->retailer_id);
        foreach ($categories as $category_item) {
            if (in_array($category_item->id, $selected_cat_id_array)) {
                $selected_category_array[] = $category_item;
            } else {
                $nonselected_category_array[] = $category_item;
            }
        }

        $allAttributes = Attribute::get();

        return view('retailer.backend.product.retailer_product_edit', compact('retailerData', 'categories', 'retailersName', 'products', 'categories', 'selected_category_array', 'nonselected_category_array', 'allAttributes'));
    }

    public function RetailerUpdateProduct(Request $request)
    {
        $product_id = Purify::clean($request->id);

        $incomingFields = $request->validate([
            'category_id' => 'required',
            'product_name' => ['required', Rule::unique('products', 'product_name')->ignore($product_id)],
            'product_slug' => ['required', Rule::unique('products', 'product_slug')->ignore($product_id)],
            'selling_price' => ['required', 'numeric'],
            'attribute' => new AttributeIsRequired()
        ], [
            'category_id.required' => 'لطفا یک دسته بندی مرتبط برای محصول انتخاب نمایید.',
            'product_name.required' => 'لطفا نام محصول را وارد نمایید.',
            'product_name.unique' => 'نام محصول قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
            'product_slug.required' => 'لطفا اسلاگ را وارد نمایید.',
            'product_slug.unique' => 'اسلاگ قبلا ثبت شده است. لطفا یک عبارت دیگر وارد کنید.',
            'selling_price.required' => 'لطفا قیمت محصول را وارد نمایید.',
            'selling_price.numeric' => 'لطفا قیمت محصول را به درستی وارد نمایید.',
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
        if ($product->retailer_id != Auth::user()->id) {
            return redirect()->route('retailer.all.product')->with('error', 'شما اجازه ویرایش این محصول را ندارید!');
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
            || $product->currency != Purify::clean($request->currency)
            || $product->measurement != Purify::clean($request->measurement)
            || $product->packing != Purify::clean($request->packing)
            || $product->specification != ($request->specification)
            || $product->unlimitedStock != Purify::clean($request->unlimitedStock)
            || $product->status != Purify::clean($request->product_status)
            || $image
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

        if ($image) {

            $unique_image_name = hexdec(uniqid()) . time();
            $name_gen = $unique_image_name . '.' . 'jpg';
            $name_gen_sm = $unique_image_name . '_sm.' . 'jpg';
            Image::make($image)->fit(880, 990)->encode('jpg')->save('storage/upload/products/thumbnail/' . $name_gen);
            Image::make($image)->fit(222, 250)->encode('jpg')->save('storage/upload/products/thumbnail/' . $name_gen_sm);
            $save_url = 'storage/upload/products/thumbnail/' . $name_gen;
            $save_url_sm = 'storage/upload/products/thumbnail/' . $name_gen_sm;

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
                'currency' => Purify::clean($request['currency']),
                'measurement' => Purify::clean($request['measurement']) ?? "none",
                'packing' => Purify::clean($request['packing']) ?? "none",
                'specification' => ($request->specification),
                'product_verification' => Purify::clean($product_verification),
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
                'currency' => Purify::clean($request['currency']),
                'measurement' => Purify::clean($request['measurement']) ?? "none",
                'packing' => Purify::clean($request['packing']) ?? "none",
                'specification' => ($request->specification),
                'product_verification' => Purify::clean($product_verification),
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
            foreach (Purify::clean($request->attribute) as $key => $attribute) {
                $attribute_in_loop = Attribute::find($key);
                if($attribute_in_loop->attribute_type == "dropdown" && $attribute["value_id"] != 'none') {
                    $attributes[$key] = array("value_id" => (int) $attribute["value_id"], "value" => NULL);
                } elseif($attribute_in_loop->attribute_type == "input_field" && $attribute["value"] != '') {
                    $attributes[$key] = array("value_id" => (int) $attribute["value_id"], "value" => Purify::clean($attribute["value"]));
                }
            }
            $product->attributes()->detach();
            if (count($attributes) ) {
                $product->attributes()->sync($attributes);
            }
        }    
        // بخش مدیریت ویژگی ها

        if ($product_verification == 'inactive') {
            return redirect()->route('retailer.all.product')->with('success', 'محصول مورد نظر با موفقیت به‌روزرسانی و پس از تایید کارشناس منتشر خواهد شد.');
        }
        return redirect()->route('retailer.all.product')->with('success', 'محصول مورد نظر با موفقیت به‌روزرسانی گردید.');
    }

    public function RetailerDeleteProduct($id)
    {
        $product = Product::findOrFail(Purify::clean($id));

        if ($product->retailer_id != Auth::user()->id) {
            return redirect()->route('retailer.all.product')->with('error', 'شما اجازه حذف این محصول را ندارید!');
        }

        $img = $product->product_thumbnail;
        $img_sm = $product->product_thumbnail_sm;
        unlink($img);
        unlink($img_sm);

        Product::findOrFail($id)->delete();

        return redirect()->route('retailer.all.product')->with('success', 'محصول مورد نظر با موفقیت حذف گردید.');
    }

    public function RetailerCopyProduct($id)
    {
        $selected_category_array = [];
        $nonselected_category_array = [];

        $user_id = Auth::user()->id;
        $retailerData = User::find($user_id);

        $retailersName = User::where('role', 'retailer')->where('status', 'active')->latest()->get();
        $categories = Category::latest()->get();
        $products = Product::findOrFail(Purify::clean($id));
        $selected_cat_id_array = explode(",", $products->category_id);

        $selected_retailer_id_array = explode(",", $products->retailer_id);

        foreach ($categories as $category_item) {
            if (in_array($category_item->id, $selected_cat_id_array)) {
                $selected_category_array[] = $category_item;
            } else {
                $nonselected_category_array[] = $category_item;
            }
        }

        $allAttributes = Attribute::get();

        return view('retailer.backend.product.retailer_product_copy', compact('retailerData', 'categories', 'retailersName', 'products', 'categories', 'selected_category_array', 'nonselected_category_array', 'allAttributes'));
    }

    public function RetailerStoreCopyProduct(Request $request)
    {

        $incomingFields = $request->validate([
            'category_id' => 'required',
            'product_name' => ['required', Rule::unique('products', 'product_name')],
            'product_slug' => ['required', Rule::unique('products', 'product_slug')],
            'selling_price' => ['required', 'numeric'],
            'attribute' => new AttributeIsRequired()
        ], [
            'category_id.required' => 'لطفا یک دسته بندی مرتبط برای محصول انتخاب نمایید.',
            'product_name.required' => 'لطفا نام محصول را وارد نمایید.',
            'product_name.unique' => 'نام محصول قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
            'product_slug.required' => 'لطفا اسلاگ را وارد نمایید.',
            'product_slug.unique' => 'اسلاگ قبلا ثبت شده است. لطفا یک عبارت دیگر وارد کنید.',
            'selling_price.required' => 'لطفا قیمت محصول را وارد نمایید.',
            'selling_price.numeric' => 'لطفا قیمت محصول را به درستی وارد نمایید.',
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

        if (Purify::clean($request->product_thumbnail)) {
            $image = Purify::clean($request->product_thumbnail);

            $unique_image_name = hexdec(uniqid()) . time();
            $name_gen = $unique_image_name . '.' . 'jpg';
            $name_gen_sm = $unique_image_name . '_sm.' . 'jpg';
            Image::make($image)->fit(880, 990)->encode('jpg')->save('storage/upload/products/thumbnail/' . $name_gen);
            Image::make($image)->fit(222, 250)->encode('jpg')->save('storage/upload/products/thumbnail/' . $name_gen_sm);
            $save_url = 'storage/upload/products/thumbnail/' . $name_gen;
            $save_url_sm = 'storage/upload/products/thumbnail/' . $name_gen_sm;
        } else {
            $unique_image_name = hexdec(uniqid()) . time();
            $name_gen = $unique_image_name . '.' . 'jpg';
            $name_gen_sm = $unique_image_name . '_sm.' . 'jpg';

            \File::copy(Purify::clean($request->old_image), 'storage/upload/products/thumbnail/' . $name_gen);
            \File::copy(Purify::clean($request->old_image_sm), 'storage/upload/products/thumbnail/' . $name_gen_sm);

            $save_url = 'storage/upload/products/thumbnail/' . $name_gen;
            $save_url_sm = 'storage/upload/products/thumbnail/' . $name_gen_sm;
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
            'retailer_id' => Auth::user()->id,
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
            'currency' => Purify::clean($request['currency']),
            'measurement' => Purify::clean($request['measurement']) ?? "none",
            'packing' => Purify::clean($request['packing']) ?? "none",
            'specification' => ($request->specification),
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
            foreach (Purify::clean($request->attribute) as $key => $attribute) {
                $attribute_in_loop = Attribute::find($key);
                if($attribute_in_loop->attribute_type == "dropdown" && $attribute["value_id"] != 'none') {
                    $attributes[$key] = array("value_id" => (int) $attribute["value_id"], "value" => NULL);
                } elseif($attribute_in_loop->attribute_type == "input_field" && $attribute["value"] != '') {
                    $attributes[$key] = array("value_id" => (int) $attribute["value_id"], "value" => Purify::clean($attribute["value"]));
                }
            }
            if (count($attributes) ) {
                $product->attributes()->attach($attributes);
            }
        }    
        // بخش مدیریت ویژگی ها
        
        return redirect()->route('retailer.all.product')->with('success', 'محصول مورد نظر با موفقیت ایجاد و پس از تایید کارشناس منتشر خواهد شد.');
    }

    public function ViewRetailerOrders()
    {
        $user_id = Auth::user()->id;
        $retailerData = User::find($user_id);
        $orders = Order::orderBy('id', 'DESC')->where('status', Purify::clean(request('type')))->get();

        return view('retailer.retailer_orderslist', compact('orders', 'retailerData'));
    }

    public function DestroyRetailerOrder($id)
    {
        $user_id = Auth::user()->id;
        $order = Order::findOrFail(Purify::clean($id));

        foreach ($order->products()->get() as $item) {
            if ($item->retailer_id != $user_id) {
                return back();
            }
        }
        $order->delete();

        return back()->with('success', 'سفارش مورد نظر با موفقیت حذف گردید.');
    }

    public function ViewRetailerOrderItem($id)
    {
        $user_id = Auth::user()->id;
        $retailerData = User::find($user_id);

        $order = Order::findOrFail(Purify::clean($id));
        return view('retailer.retailer_order_detail', compact('order', 'retailerData'));
    }

    public function ChangeRetailerOrderStatus(Request $request)
    {
        $user_id = Auth::user()->id;
        $order = Order::findOrFail(Purify::clean($request->id));

        foreach ($order->products()->get() as $item) {
            if ($item->retailer_id != $user_id) {
                return back();
            }
        }
        $order->update(['status' => $request->status]);

        return back()->with('success', 'سفارش مورد نظر با موفقیت به‌روزرسانی گردید.');
    }

    public function RetailerCreateOutlet()
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);

        $retailer_sector_arr = explode(",", $retailerData->vendor_sector);
        $retailer_sector_cat_arr = [];
        foreach ($retailer_sector_arr as $retailer_sector_item) {
            $retailer_sector_cat_arr[] = Category::find($retailer_sector_item);
        }

        // category for filter
        $filter_category_array = [];
        foreach ($retailer_sector_cat_arr as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);

        }
        // category for filter

        return view('retailer.outlets.retailer_outlet_add', compact('retailerData', 'filter_category_array', 'retailer_sector_cat_arr'));
    } //End method

    public function RetailerStoreOutlet(Request $request)
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

        Retaileroutlet::insert([
            'shop_name' => Purify::clean($incomingFields['shop_name']),
            'shop_address' => Purify::clean($incomingFields['shop_address']),
            'latitude' => Purify::clean($incomingFields['latitude']),
            'longitude' => Purify::clean($incomingFields['longitude']),
            'shop_postalcode' => Purify::clean($request->shop_postalcode) ? Purify::clean($request->shop_postalcode) : NULL,
            'shop_phone' => Purify::clean($request->shop_phone) ? Purify::clean($request->shop_phone) : NULL,
            'shop_fax' => Purify::clean($request->shop_fax) ? Purify::clean($request->shop_fax) : NULL,
            'user_id' => Auth::user()->id,
            'category_id' => $category_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect(route('retailer.all.outlet'))->with('success', 'آدرس مورد نظر با موفقیت اضافه گردید.');
    } //End method

    public function RetailerAllOutlet()
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);

        $outlets = Retaileroutlet::where('user_id', $id)->orderBy("id", 'asc')->get();

        return view('retailer.outlets.retailer_outlet_all', compact('retailerData', 'outlets'));
    } //End method

    public function RetailerEditOutlet($outlet_id)
    {
        $id = Auth::user()->id;
        $retailerData = User::find($id);

        $outlet = Retaileroutlet::find(Purify::clean($outlet_id));

        $retailer_sector_arr = explode(",", $retailerData->vendor_sector);

        foreach ($retailer_sector_arr as $retailer_sector_item) {
            $retailer_sector_cat_arr[] = Category::find($retailer_sector_item);
        }

        // category for filter
        $filter_category_array = [];
        foreach ($retailer_sector_cat_arr as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);

        }
        // category for filter

        $outlet = Retaileroutlet::find(Purify::clean($outlet_id));

        if ($outlet->category_id) {
            $retailer_sector_cat_arr_selected = explode(",", $outlet->category_id);
        } else {
            $retailer_sector_cat_arr_selected = [];
        }

        return view('retailer.outlets.retailer_outlet_edit', compact('retailerData', 'outlet', 'filter_category_array', 'retailer_sector_cat_arr', 'retailer_sector_cat_arr_selected'));
    } //End method

    public function RetailerUpdateOutlet(Request $request)
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
            Retaileroutlet::findOrFail($outlet_id)->update([
                'shop_name' => Purify::clean($incomingFields['shop_name']),
                'shop_address' => Purify::clean($incomingFields['shop_address']),
                'latitude' => Purify::clean($request->latitude),
                'longitude' => Purify::clean($request->longitude),
                'shop_postalcode' => Purify::clean($request->shop_postalcode) ? Purify::clean($request->shop_postalcode) : NULL,
                'shop_phone' => Purify::clean($request->shop_phone) ? Purify::clean($request->shop_phone) : NULL,
                'shop_fax' => Purify::clean($request->shop_fax) ? Purify::clean($request->shop_fax) : NULL,
                'user_id' => Auth::user()->id,
                'category_id' => $category_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Retaileroutlet::findOrFail($outlet_id)->update([
                'shop_name' => Purify::clean($incomingFields['shop_name']),
                'shop_address' => Purify::clean($incomingFields['shop_address']),
                'shop_postalcode' => Purify::clean($request->shop_postalcode) ? Purify::clean($request->shop_postalcode) : NULL,
                'shop_phone' => Purify::clean($request->shop_phone) ? Purify::clean($request->shop_phone) : NULL,
                'shop_fax' => Purify::clean($request->shop_fax) ? Purify::clean($request->shop_fax) : NULL,
                'user_id' => Auth::user()->id,
                'category_id' => $category_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect(route('retailer.all.outlet'))->with('success', 'آدرس مورد نظر با موفقیت به روز رسانی گردید.');
    } //End method

    public function RetailerDeleteOutlet($outlet_id)
    {
        Retaileroutlet::findOrFail(Purify::clean($outlet_id))->delete();

        return redirect(route('retailer.all.outlet'))->with('success', 'آدرس مورد نظر با موفقیت حذف گردید.');
    } //End method
}