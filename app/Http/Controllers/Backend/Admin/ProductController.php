<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use Illuminate\Validation\Rule;
use App\Rules\AttributeIsRequired;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $user_id = Auth::user()->id;
        $adminData = User::find($user_id);

        $products = Product::where([
            ['product_verification', '=', 'active'],
            ['vendor_id', '!=', NULL],
        ])->Orwhere([
                    ['product_verification', '=', 'active'],
                    ['merchant_id', '!=', NULL],
                ])->Orwhere([
                    ['product_verification', '=', 'active'],
                    ['retailer_id', '!=', NULL],
                ])->Orwhere([
                    ['product_verification', '=', 'inactive'],
                    ['vendor_id', '=', NULL],
                    ['merchant_id', '=', NULL],
                    ['retailer_id', '=', NULL],
                ])->latest()->paginate(10);

        return view('admin.backend.product.product_all', compact('products', 'adminData'));
    }

    public function AllProductSearch(Request $request)
    {
        $user_id = Auth::user()->id;
        $adminData = User::find($user_id);
        $query_string = Purify::clean($request->q);

        $products = Product::where([
            ['product_name', 'like', "%{$query_string}%"],
            ['product_verification', '=', 'active'],
            ['vendor_id', '!=', NULL],
        ])->Orwhere([
                    ['product_name', 'like', "%{$query_string}%"],
                    ['product_verification', '=', 'active'],
                    ['merchant_id', '!=', NULL],
                ])->Orwhere([
                    ['product_name', 'like', "%{$query_string}%"],
                    ['product_verification', '=', 'active'],
                    ['retailer_id', '!=', NULL],
                ])->Orwhere([
                    ['product_name', 'like', "%{$query_string}%"],
                    ['product_verification', '=', 'inactive'],
                    ['vendor_id', '=', NULL],
                    ['merchant_id', '=', NULL],
                    ['retailer_id', '=', NULL],
                ])->latest()->get();

        return view('admin.backend.product.product_all', compact('products', 'adminData'));
    }

    public function AddProduct()
    {
        $user_id = Auth::user()->id;
        $adminData = User::find($user_id);

        $allAttributes = Attribute::get();

        $parentCategories = Category::where('parent', 0)->get();
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }

        return view('admin.backend.product.product_add', compact('adminData', 'filter_category_array', 'allAttributes'));
    }

    public function StoreProduct(Request $request)
    {
        $incomingFields = $request->validate([
            'product_thumbnail' => 'required',
            'category_id' => 'required',
            'product_name' => ['required', Rule::unique('products', 'product_name')],
            'product_slug' => ['required', Rule::unique('products', 'product_slug')],
            'selling_price' => 'required',
            'attribute' => new AttributeIsRequired()
        ], [
            'product_thumbnail.required' => 'لطفا تصویر محصول را بارگذاری نمایید.',
            'category_id.required' => 'لطفا یک دسته بندی مرتبط برای محصول انتخاب نمایید.',
            'product_name.required' => 'لطفا نام محصول را وارد نمایید.',
            'product_name.unique' => 'نام محصول قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
            'product_slug.required' => 'لطفا اسلاگ را وارد نمایید.',
            'product_slug.unique' => 'اسلاگ قبلا ثبت شده است. لطفا یک عبارت دیگر وارد کنید.',
            'selling_price.required' => 'لطفا قیمت محصول را وارد نمایید.',
        ]);

        if (Purify::clean($incomingFields['category_id'])) {
            $category_id = implode(',', Purify::clean($incomingFields['category_id']));
        } else {
            $category_id = "";
        }

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
            // 'vendor_id' => $vendor_id,
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

        return redirect(route('all.product'))->with('success', 'محصول مورد نظر با موفقیت ایجاد گردید.');
    }

    public function EditProduct($id)
    {
        $user_id = Auth::user()->id;
        $adminData = User::find($user_id);
        
        $products = Product::findOrFail(Purify::clean($id));
        $allAttributes = $products->attributes;

        // با توجه به نوع هر کاربر میاد ویژگی رو نمایش میده
        if($products->vendor_id != NULL) {
            $role = "vendor" ;
            $vendor_sector = $products->vendor->vendor_sector;
        } elseif($products->merchant_id != NULL) {
            $role = "merchant" ;
            $vendor_sector = NULL;
        } elseif($products->retailer_id != NULL) {
            $role = "retailer" ;
            $vendor_sector = $products->retailer->vendor_sector;
        } else {
            $role = $adminData->role;
            $vendor_sector = NULL;
        }
        
        $parentCategories = $vendor_sector != NULL ? Category::findRootCategoryArray(explode(",", $vendor_sector)) : Category::where('parent', 0)->get();
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }

        return view('admin.backend.product.product_edit', compact('adminData', 'products', 'allAttributes', 'role', 'vendor_sector', 'filter_category_array'));
    }

    public function UpdateProduct(Request $request)
    {
        $product_id = Purify::clean($request->id);

        $incomingFields = $request->validate([
            'category_id' => 'required',
            'product_name' => ['required', Rule::unique('products', 'product_name')->ignore($product_id)],
            'product_slug' => ['required', Rule::unique('products', 'product_slug')->ignore($product_id)],
            'selling_price' => 'required',
            'attribute' => new AttributeIsRequired()
        ], [
            'category_id.required' => 'لطفا یک دسته بندی مرتبط برای محصول انتخاب نمایید.',
            'product_name.required' => 'لطفا نام محصول را وارد نمایید.',
            'product_name.unique' => 'نام محصول قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
            'product_slug.required' => 'لطفا اسلاگ را وارد نمایید.',
            'product_slug.unique' => 'اسلاگ قبلا ثبت شده است. لطفا یک عبارت دیگر وارد کنید.',
            'selling_price.required' => 'لطفا قیمت محصول را وارد نمایید.',
        ]);

        // product verification functions
        $product = Product::findOrFail($product_id);
        if ($product->vendor_id != NULL || $product->merchant_id != NULL || $product->retailer_id != NULL) {
            $product_verification = "active";
        } else {
            $product_verification = "inactive";
        }
        if ($product->product_verification != $product_verification) {
            $product_verification_changed = true;
        } else {
            $product_verification_changed = false;
        }
        // product verification functions

        if (Purify::clean($incomingFields['category_id'])) {
            $category_id = implode(',', Purify::clean($incomingFields['category_id']));
        } else {
            $category_id = "";
        }

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

        if ($parent_category_id == NULL) {
            return back()->with('error', 'لطفا دسته بندی اصلی مرتبط با محصول را انتخاب نمایید.')->withInput();
        }

        if (Purify::clean($request->vendor_id)) {
            $vendor_id = implode(',', Purify::clean($request->vendor_id));
        } else {
            $vendor_id = NULL;
        }

        $image = Purify::clean($request->file('product_thumbnail'));

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
                // 'vendor_id' => $vendor_id,
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
                // 'vendor_id' => $vendor_id,
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

        if ($product_verification_changed == true) {
            if ($product->vendor_id != NULL) {
                return redirect(route('admin.vendor.product.verifyAll'))->with('success', 'محصول مورد نظر با موفقیت منتشر گردید.');
            } elseif ($product->merchant_id != NULL) {
                return redirect(route('admin.merchant.product.verifyAll'))->with('success', 'محصول مورد نظر با موفقیت منتشر گردید.');
            } elseif ($product->retailer_id != NULL) {
                return redirect(route('admin.retailer.product.verifyAll'))->with('success', 'محصول مورد نظر با موفقیت منتشر گردید.');
            }
        } else {
            return redirect(route('all.product'))->with('success', 'محصول مورد نظر با موفقیت به‌روزرسانی گردید.');
        }
    }

    public function DeleteProduct($id)
    {
        $product = Product::findOrFail(Purify::clean($id));
        $img = $product->product_thumbnail;
        $img_sm = $product->product_thumbnail_sm;
        unlink($img);
        unlink($img_sm);

        Product::findOrFail(Purify::clean($id))->delete();

        return redirect(route('all.product'))->with('success', 'محصول مورد نظر با موفقیت حذف گردید.');
    }

    public function LoadAttributes(Request $request) {
        $role = Purify::clean($request->role);

        $selected_attributes_arr = [];
        $selected_categories_arr = $request->id;

        $allAttributes = Attribute::all(['attribute_type', 'description', 'id', 'name', 'required', 'role', 'category_id']);
        foreach ($allAttributes as $attribute) {

            // اینجا برای هر ویژگی چک کن که آیا مجاز به استفاده از اون ویژگی هست یا خیر
            $user_role_permission = true;
            if(!in_array($role, explode(',', $attribute->role))) {
                $user_role_permission = false;
            } 
            
            if($user_role_permission && User::canVendorSeeAttribute($attribute->category_id, implode(',', $selected_categories_arr))){
                $attribute->push(['values' => $attribute->values]);
                $selected_attributes_arr[] = $attribute;
            }
        }
        
        $duplicated_parent = Category::duplicatedParentCategory($selected_categories_arr);

        return response(['attributes' => $selected_attributes_arr, 'duplicated_parent' => $duplicated_parent]);
    }
}