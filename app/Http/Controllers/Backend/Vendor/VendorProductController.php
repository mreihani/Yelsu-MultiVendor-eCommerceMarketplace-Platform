<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use Illuminate\Validation\Rule;
use App\Rules\AttributeIsRequired;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Storage;

class VendorProductController extends Controller
{
    public function VendorAllProduct()
    {
        $user_id = Auth::user()->id;
        $vendorData = User::find($user_id);
        $selected_vendor_id_array = [];
        $vendor_products = [];

        $products = Product::latest()->get();

        foreach ($products as $product) {
            if (in_array($user_id, explode(",", $product->vendor_id))) {
                $vendor_products[] = $product;
            }
        }

        return view('vendor.backend.product.vendor_product_all', compact('vendor_products', 'vendorData'));
    }

    public function VendorAddProduct()
    {
        $user_id = Auth::user()->id;
        $vendorData = User::find($user_id);
        $allAttributes = Attribute::get();

        $vendorSectorArr = explode(",", $vendorData->vendor_sector);
        $parentCategories = Category::findRootCategoryArray($vendorSectorArr);

        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }

        return view('vendor.backend.product.vendor_product_add', compact('vendorData', 'allAttributes', 'filter_category_array', 'vendorSectorArr'));
    }

    public function VendorStoreProduct(Request $request)
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
            'vendor_id' => Auth::user()->id,
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

        return redirect()->route('vendor.all.product')->with('success', 'محصول مورد نظر با موفقیت ایجاد و پس از تایید کارشناس منتشر خواهد شد.');
    }

    public function VendorEditProduct($id)
    {
        $user_id = Auth::user()->id;
        $vendorData = User::find($user_id);
        
        $allAttributes = Attribute::get();
        $products = Product::findOrFail(Purify::clean($id));

        $vendorSectorArr = explode(",", $vendorData->vendor_sector);
        $parentCategories = Category::findRootCategoryArray($vendorSectorArr);

        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }

        return view('vendor.backend.product.vendor_product_edit', compact('vendorData', 'products', 'allAttributes', 'filter_category_array', 'vendorSectorArr'));
    }

    public function VendorUpdateProduct(Request $request)
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
        if ($product->vendor_id != Auth::user()->id) {
            return redirect()->route('vendor.all.product')->with('error', 'شما اجازه ویرایش این محصول را ندارید!');
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
                'short_desc' => $request->short_desc,
                'featured' => 1,
                'status' => Purify::clean($request->product_status) == 'active' ? 'active' : 'disabled',
                'unlimitedStock' => $request->unlimitedStock == 'active' ? 'active' : 'disabled',
                'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
                'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
                'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
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
            return redirect()->route('vendor.all.product')->with('success', 'محصول مورد نظر با موفقیت به‌روزرسانی و پس از تایید کارشناس منتشر خواهد شد.');
        }
        return redirect()->route('vendor.all.product')->with('success', 'محصول مورد نظر با موفقیت به‌روزرسانی گردید.');
    }

    public function VendorDeleteProduct($id)
    {
        $product = Product::findOrFail(Purify::clean($id));

        if ($product->vendor_id != Auth::user()->id) {
            return redirect()->route('vendor.all.product')->with('error', 'شما اجازه حذف این محصول را ندارید!');
        }

        $img = $product->product_thumbnail;
        $img_sm = $product->product_thumbnail_sm;
        unlink($img);
        unlink($img_sm);

        Product::findOrFail(Purify::clean($id))->delete();

        return redirect()->route('vendor.all.product')->with('success', 'محصول مورد نظر با موفقیت حذف گردید.');
    }

    public function VendorCopyProduct($id)
    {
        $user_id = Auth::user()->id;
        $vendorData = User::find($user_id);

        $products = Product::findOrFail(Purify::clean($id));
        $allAttributes = Attribute::get();

        $vendorSectorArr = explode(",", $vendorData->vendor_sector);
        $parentCategories = Category::findRootCategoryArray($vendorSectorArr);

        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }
        
        return view('vendor.backend.product.vendor_product_copy', compact('vendorData', 'products', 'allAttributes', 'filter_category_array', 'vendorSectorArr'));
    }

    public function VendorStoreCopyProduct(Request $request)
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
            'vendor_id' => Auth::user()->id,
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

        return redirect()->route('vendor.all.product')->with('success', 'محصول مورد نظر با موفقیت ایجاد و پس از تایید کارشناس منتشر خواهد شد.');
    }
}