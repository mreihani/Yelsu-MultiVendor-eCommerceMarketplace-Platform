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
        $vendorsName = User::where('role', 'vendor')->where('status', 'active')->latest()->get();

        $categories = Category::latest()->get()->reverse();

        $allAttributes = Attribute::get();

        return view('admin.backend.product.product_add', compact('adminData', 'categories', 'vendorsName', 'allAttributes'));
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
        $selected_category_array = [];
        $nonselected_category_array = [];

        $selected_vendor_array = [];
        $nonselected_vendor_array = [];

        $user_id = Auth::user()->id;
        $adminData = User::find($user_id);

        $vendorsName = User::where('role', 'vendor')->where('status', 'active')->latest()->get();
        $categories = Category::latest()->get()->reverse();
        $products = Product::findOrFail(Purify::clean($id));
        $selected_cat_id_array = explode(",", $products->category_id);

        $selected_vendor_id_array = explode(",", $products->vendor_id);

        foreach ($categories as $category_item) {
            if (in_array($category_item->id, $selected_cat_id_array)) {
                $selected_category_array[] = $category_item;
            } else {
                $nonselected_category_array[] = $category_item;
            }
        }

        foreach ($vendorsName as $vendor_item) {
            if (in_array($vendor_item->id, $selected_vendor_id_array)) {
                $selected_vendor_array[] = $vendor_item;
            } else {
                $nonselected_vendor_array[] = $vendor_item;
            }
        }

        $allAttributes = Attribute::get();

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
        // با توجه به نوع هر کاربر میاد ویژگی رو نمایش میده

        return view('admin.backend.product.product_edit', compact('adminData', 'categories', 'vendorsName', 'products', 'categories', 'selected_category_array', 'nonselected_category_array', 'selected_vendor_array', 'nonselected_vendor_array', 'allAttributes', 'role', 'vendor_sector'));
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
}