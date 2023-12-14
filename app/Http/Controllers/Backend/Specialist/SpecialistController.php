<?php

namespace App\Http\Controllers\Backend\Specialist;

use App\Models\Chat;
use App\Models\File;
use App\Models\User;
use App\Models\Driver;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Freightage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AttributeItem;
use App\Models\CategoryProduct;
use Illuminate\Validation\Rule;
use App\Rules\AttributeIsRequired;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File as LaravelFile;
use App\Services\Users\Driver\DriverTypeServices\DriverTypeService;
use App\Services\Users\Driver\DriverTypeServices\DriverTypeRoadService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeAirService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeSeaService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeRailService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeRoadService;

class SpecialistController extends Controller
{

    /**************************************
    Start of General User Application Section 
    **************************************/

    public function SpecialistDashboard()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        return view('specialist.index', compact('specialistData'));
    } //End method

    public function SpecialistDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    } //End method

    public function SpecialistProfile()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        return view('specialist.specialist_profile_view', compact('specialistData'));
    } //End method

    public function SpecialistProfileSettings()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        return view('specialist.specialist_profile_settings', compact('specialistData'));
    } //End method

    public function SpecialistProfileStore(Request $request)
    {
        $incomingFields = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ], [
            'firstname.required' => 'لطفا نام خود را وارد نمایید.',
            'lastname.required' => 'لطفا نام خانوادگی خود را وارد نمایید.',
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);

        if (Purify::clean($incomingFields['firstname'])) {
            $data->firstname = Purify::clean($incomingFields['firstname']);
        }

        if (Purify::clean($incomingFields['lastname'])) {
            $data->lastname = Purify::clean($incomingFields['lastname']);
        }

        if (Purify::clean($request->photo)) {
            $file = Purify::clean($request->photo);

            if ($data->photo != NULL) {
                unlink('storage/upload/specialist_images/' . $data->photo);
            }

            $unique_image_name = hexdec(uniqid()) . time();
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(160)->encode('jpg')->save('storage/upload/specialist_images/' . $filename);
            //$file->move(public_path('storage/upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');

    } //End method

    public function SpecialistUpdatePassword(Request $request)
    {

        //Validation
        $incomingFields = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8|max:20',
        ], [
            'old_password.required' => 'لطفا کلمه عبور فعلی خود را وارد نمایید.',
            'new_password.required' => 'لطفا کلمه عبور جدید را وارد نمایید.',
            'new_password.confirmed' => 'لطفا تکرار کلمه عبور جدید را به درستی وارد نمایید.',
            'new_password.min' => 'کلمه عبور جدید باید حداقل 8 کاراکتر باشد.',
            'new_password.max' => 'کلمه عبور جدید باید حداکثر 20 کاراکتر باشد.',
        ]);

        //Match the old password
        if (! Hash::check(($incomingFields['old_password']), Auth::user()->password)) {
            return back()->with('error', 'لطفا کلمه عبور فعلی خود را به درستی وارد نمایید.');
        }

        //Update the now password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make(($incomingFields['new_password']))
        ]);
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    } //End method

    /**************************************
     End of General User Application Section 
     **************************************/

    /**************************************
     Start of Category Section 
     **************************************/

    public function SpecialistAllCategory(Request $request)
    {
        $category_id_filter = $request->id;

        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $categories = Category::where('id', $specialistData->specialist_category_id)->latest()->get();
        
        if (Purify::clean(request('filter_id'))) {
            $filter_id = Purify::clean(request('filter_id'));
            $categories = Category::where('id', $filter_id)->orderBy('parent', 'DESC')->get();
        }

        return view('specialist.category.category_all', compact('categories', 'specialistData'));
    } // end of Category section


    public function SpecialistAddCategory()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $categories = Category::latest()->get();

        // added recursive function to find all the categories related to specialist category
        $category_hierarchy_arr = [];
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
                if ($root_catgory_obj->id == $specialistData->specialist_category_id) {
                    $category_hierarchy_arr[] = $category_item;
                }
            }
        }
        array_push($category_hierarchy_arr, Category::find($specialistData->specialist_category_id));
        $categories = array_reverse($category_hierarchy_arr);
        // end of - recursive function

        return view('specialist.category.category_add', compact('specialistData', 'categories'));
    }

    public function SpecialistStoreCategory(Request $request)
    {
        $incomingFields = $request->validate([
            'category_image' => 'required',
            'category_name' => ['required', Rule::unique('categories', 'category_name')],
        ], [
            'category_image.required' => 'لطفا تصویر دسته بندی را بارگذاری نمایید.',
            'category_name.required' => 'لطفا نام دسته بندی را وارد نمایید.',
            'category_name.unique' => 'نام دسته بندی قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
        ]);


        $image = Purify::clean($incomingFields['category_image']);
        $name_gen = hexdec(uniqid()) . '.' . 'jpg';
        Image::make($image)->fit(217, 221)->encode('jpg')->save('storage/upload/category/' . $name_gen);

        $save_url = 'storage/upload/category/' . $name_gen;

        Category::insert([
            'category_name' => Purify::clean($incomingFields['category_name']),
            'category_image' => $save_url,
            'category_slug' => strtolower(str_replace('', '-', Purify::clean($incomingFields['category_name']))),
            'category_description' => ($request->category_description),
            'parent' => Purify::clean($request->parent) == 0 ? 0 : Purify::clean($request->parent),
            'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
            'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
            'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
        ]);

        return redirect(route('specialist.all.category'))->with('success', 'دسته بندی مورد نظر با موفقیت ایجاد گردید.');
    }

    public function SpecialistEditCategory($id)
    {
        $categories_id_array = [];
        $nonselected_category_array = [];

        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $category = Category::findOrFail(Purify::clean($id));
        $categories = Category::latest()->get();

        // added recursive function to find all the categories related to specialist category
        $category_hierarchy_arr = [];
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
                if ($root_catgory_obj->id == $specialistData->specialist_category_id) {
                    $category_hierarchy_arr[] = $category_item;
                }
            }
        }
        array_push($category_hierarchy_arr, Category::find($specialistData->specialist_category_id));
        $categories = array_reverse($category_hierarchy_arr);
        // end of - recursive function

        // find category that is selected by user and saved into DB, then show it on the frontend dropdown
        $parent_id = $category->parent;
        if ($parent_id != NULL) {
            $selected_category = Category::findOrFail($parent_id);
        } else {
            $selected_category = NULL;
        }

        // create an array of categories that do not match requested category ID
        foreach ($categories as $category_item) {
            if (Purify::clean($id) != $category_item->id) {
                $categories_id_array[] = $category_item->id;
            }
        }

        // find and excude categories that are not selected by user, then show it on the frontend dropdown
        foreach ($categories_id_array as $category_item) {
            if ($parent_id !== $category_item) {
                $nonselected_category_array[] = Category::findOrFail($category_item);
            }
        }

        return view('specialist.category.category_edit', compact('category', 'categories', 'specialistData', 'selected_category', 'nonselected_category_array'));
    }

    public function SpecialistUpdateCategory(Request $request)
    {

        $incomingFields = $request->validate([
            'category_name' => 'required',
        ], [
            'category_name.required' => 'لطفا نام دسته بندی را وارد نمایید.',
        ]);

        $cat_id = Purify::clean($request->id);
        $old_img = Purify::clean($request->old_image);

        // here stop specialist to edit 1 to 8 important categories
        $parentCategories = Category::where('parent',0)->pluck('id')->toArray();
        if (in_array(Purify::clean($request->id), $parentCategories)) {
            return redirect(route('specialist.all.category'))->with('error', 'شما اجازه ویرایش این دسته بندی را ندارید!');
        }

        // here check if maclicious user enters unrelated category ID to change its content
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        if (Category::findRootCategory($cat_id)->id != $specialistData->specialist_category_id) {
            return redirect(route('specialist.all.category'))->with('error', 'شما اجازه ویرایش این دسته بندی را ندارید!');
        }

        if ($request->file('category_image')) {
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . 'jpg';
            Image::make($image)->fit(217, 221)->encode('jpg')->save('storage/upload/category/' . $name_gen);
            $save_url = 'storage/upload/category/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Category::findOrFail($cat_id)->update([
                'category_name' => Purify::clean($incomingFields['category_name']),
                'category_image' => $save_url,
                'category_slug' => strtolower(str_replace('', '-', $incomingFields['category_name'])),
                'category_description' => ($request->category_description),
                'parent' => Purify::clean($request->parent) == 0 ? 0 : Purify::clean($request->parent),
                'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
                'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
                'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
            ]);

        } else {
            Category::findOrFail($cat_id)->update([
                'category_name' => Purify::clean($incomingFields['category_name']),
                'category_slug' => strtolower(str_replace('', '-', Purify::clean($incomingFields['category_name']))),
                'category_description' => ($request->category_description),
                'parent' => Purify::clean($request->parent) == 0 ? 0 : Purify::clean($request->parent),
                'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
                'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
                'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
            ]);
        }

        return redirect(route('specialist.all.category'))->with('success', 'دسته بندی مورد نظر با موفقیت به‌روزرسانی گردید.');
    }

    public function SpecialistDeleteCategory($id)
    {
        return redirect(route('specialist.all.category'))->with('error', 'شما اجازه حذف این دسته بندی را ندارید!');

        // here stop specialist to delete 1 to 8 important categories
        if (Purify::clean($id) == 1 || Purify::clean($id) == 2 || Purify::clean($id) == 3 || Purify::clean($id) == 4 || Purify::clean($id) == 5 || Purify::clean($id) == 6 || Purify::clean($id) == 7 || Purify::clean($id) == 8) {
            return redirect(route('specialist.all.category'))->with('error', 'شما اجازه حذف این دسته بندی را ندارید!');
        }

        // here check if maclicious user enters unrelated category ID to delete its content
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        if (Category::findRootCategory(Purify::clean($id))->id != $specialistData->specialist_category_id) {
            return redirect(route('specialist.all.category'))->with('error', 'شما اجازه حذف این دسته بندی را ندارید!');
        }

        $products = Category::with('products')->where('id', Purify::clean($id))->get();
        $products = $products[0]->products;

        foreach ($products as $product) {
            $category_array = explode(',', $product->category_id);
            if (in_array(Purify::clean($id), $category_array)) {
                $category_array = array_diff($category_array, array(Purify::clean($id)));
                $category_string = implode(',', $category_array);
                $product->update(['category_id' => $category_string]);
            }
        }


        $category = Category::findOrFail(Purify::clean($id));
        $img = $category->category_image;
        unlink($img);

        Category::findOrFail(Purify::clean($id))->delete();

        return redirect(route('specialist.all.category'))->with('success', 'دسته بندی مورد نظر با موفقیت حذف گردید.');
    }

    /**************************************
    End of Category Section 
    **************************************/

    /**************************************
    Start of Product Section 
    **************************************/

    // this function is for products that require specialist confirmation
    public function SpecialistAllProduct()
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        $products = Product::where([
            ['product_verification', '=', 'active'],
            ['vendor_id', '!=', NULL],
        ])->Orwhere([
                    ['product_verification', '=', 'active'],
                    ['retailer_id', '!=', NULL],
                ])->Orwhere([
                    ['product_verification', '=', 'inactive'],
                    ['vendor_id', '=', NULL],
                    ['retailer_id', '=', NULL],
                ])->latest()->get();

        // check if product matches specialist category
        $products_array = [];
        foreach ($products as $product) {
            $product_category_arr = explode(",", $product->category_id);
            if (in_array($specialistData->specialist_category_id, $product_category_arr)) {
                $products_array[] = $product;
            }
        }
        $products = $products_array;
        // end of check if product matches specialist category

        // add custom pagination for related users
        $relatedproductsArr = new Collection($products);
        $totalGroup = count($relatedproductsArr);
        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page');
        $products = new LengthAwarePaginator($relatedproductsArr->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        // add custom pagination for related users

        return view('specialist.product.product_all', compact('products', 'specialistData'));
    }

    public function SpecialistAllProductSearch(Request $request)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        $query_string = Purify::clean($request['query']);

        // check if product matches specialist category
        $products_id_array = [];
        $all_products = Product::all();
        foreach ($all_products as $product) {
            if ($specialistData->specialist_category_id == $product->parent_category_id) {
                $products_id_array[] = $product->id;
            }
        }
        // end of check if product matches specialist category

        $products = Product::search($query_string)->whereIn('id', $products_id_array)->paginate(10);

        return view('specialist.product.product_all', compact('products', 'specialistData'));
    }

    public function SpecialistAddProduct()
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        
        $allAttributes = Attribute::get();
        $specialist_category_obj = Category::find($specialistData->specialist_category_id);

        $filter_category_array = [];
        $all_children = $specialist_category_obj->child;
        $filter_category_array[] = array($specialist_category_obj, $all_children);
       
        return view('specialist.product.product_add', compact('specialistData', 'allAttributes', 'filter_category_array'));
    }

    public function SpecialistStoreProduct(Request $request)
    {
        $incomingFields = $request->validate([
            'product_thumbnail' => 'required',
            'category_id' => 'required',
            'product_name' => ['required', Rule::unique('products', 'product_name')],
            'product_slug' => ['required', Rule::unique('products', 'product_slug')],
            'selling_price' => 'required',
            'attribute' => ['required', new AttributeIsRequired()],
        ], [
            'product_thumbnail.required' => 'لطفا تصویر محصول را بارگذاری نمایید.',
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
            'owner_id' => 1,
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
            $product = Product::find($product_id);

            $attributes = [];
            $attribute_id = collect($request->attribute)->keys()->first();
            foreach (Purify::clean(collect($request->attribute)->first()) as $key => $attribute_item) {
                $attribute_in_loop = AttributeItem::find($key);
                if($attribute_in_loop->attribute_item_type == "dropdown" && $attribute_item["attribute_value_id"] != 'none' && !$attribute_in_loop->multiple_selection_attribute) {
                    $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_item["attribute_value_id"], "attribute_value" => NULL);
                } elseif($attribute_in_loop->attribute_item_type == "dropdown" && count(collect($attribute_item["attribute_value_id"])) > 1 && $attribute_in_loop->multiple_selection_attribute) {
                    // به خاطر گزینه چندگانه باید همه مقادیر وارد گردد
                    foreach ($attribute_item["attribute_value_id"] as $attribute_value_id_key => $attribute_value_id_item) {
                        if($attribute_value_id_key == 0) {
                            continue;
                        }
                        $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_value_id_item, "attribute_value" => NULL);
                    }

                } elseif($attribute_in_loop->attribute_item_type == "input_field" && $attribute_item["attribute_value"] != '' && !$attribute_in_loop->multiple_selection_attribute) {
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
        
        return redirect(route('specialist.all.product'))->with('success', 'محصول مورد نظر با موفقیت ایجاد گردید.');
    }

    public function SpecialistEditProduct($id)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $specialist_category_obj = Category::find($specialistData->specialist_category_id);

        $filter_category_array = [];
        $all_children = $specialist_category_obj->child;
        $filter_category_array[] = array($specialist_category_obj, $all_children);

        // these lines of code are all for category dropdown select form
        $products = Product::findOrFail(Purify::clean($id));

        $allAttributes = AttributeItem::find($products->attributes()->pluck('attribute_item_id'));

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
            $role = $specialistData->role;
            $vendor_sector = NULL;
        }

        return view('specialist.product.product_edit', compact('specialistData', 'products', 'allAttributes', 'role', 'vendor_sector', 'filter_category_array'));
    }

    public function SpecialistUpdateProduct(Request $request)
    {
        $product_id = Purify::clean($request->id);

        $incomingFields = $request->validate([
            'category_id' => 'required',
            'product_name' => ['required', Rule::unique('products', 'product_name')->ignore($product_id)],
            'product_slug' => ['required', Rule::unique('products', 'product_slug')->ignore($product_id)],
            'selling_price' => 'required',
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

        $product = Product::findOrFail($product_id);

        // product verification functions
        if ($product->vendor_id != NULL || $product->retailer_id != NULL) {
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

        // here check if maclicious user enters unrelated product ID to edit its content
        if (Auth::user()->specialist_category_id != Product::find($product_id)->parent_category_id) {
            return redirect()->route('specialist.all.product')->with('error', 'شما اجازه ویرایش این محصول را ندارید!');
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
                'product_verification' => $product_verification,
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
                'product_verification' => $product_verification,
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
                    $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_item["attribute_value_id"], "attribute_value" => NULL);
                } elseif($attribute_in_loop->attribute_item_type == "dropdown" && count(collect($attribute_item["attribute_value_id"])) > 1 && $attribute_in_loop->multiple_selection_attribute) {
                    // به خاطر گزینه چندگانه باید همه مقادیر وارد گردد
                    foreach ($attribute_item["attribute_value_id"] as $attribute_value_id_key => $attribute_value_id_item) {
                        if($attribute_value_id_key == 0) {
                            continue;
                        }
                        $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_value_id_item, "attribute_value" => NULL);
                    }

                } elseif($attribute_in_loop->attribute_item_type == "input_field" && $attribute_item["attribute_value"] != '' && !$attribute_in_loop->multiple_selection_attribute) {
                    $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_item["attribute_value_id"], "attribute_value" => Purify::clean($attribute_item["attribute_value"]));
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

        if ($product_verification_changed == true) {

            if ($product->vendor_id != NULL) {
                return redirect(route('specialist.vendor.product.verifyAll'))->with('success', 'محصول مورد نظر با موفقیت منتشر گردید.');
            } elseif ($product->retailer_id != NULL) {
                return redirect(route('specialist.retailer.product.verifyAll'))->with('success', 'محصول مورد نظر با موفقیت منتشر گردید.');
            }

        } else {
            return redirect(route('specialist.all.product'))->with('success', 'محصول مورد نظر با موفقیت به‌روزرسانی گردید.');
        }

    }

    public function SpecialistDeleteProduct($id)
    {
        $product = Product::findOrFail(Purify::clean($id));

        // here check if maclicious user enters unrelated product ID to delete its content
        if (Auth::user()->specialist_category_id != $product->parent_category_id) {
            return redirect()->route('specialist.all.product')->with('error', 'شما اجازه حذف این محصول را ندارید!');
        }

        $img = $product->product_thumbnail;
        $img_sm = $product->product_thumbnail_sm;
        unlink($img);
        unlink($img_sm);

        Product::findOrFail($id)->delete();

        return redirect(route('specialist.all.product'))->with('success', 'محصول مورد نظر با موفقیت حذف گردید.');
    }

    public function SpecialistCopyProduct($id) {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $specialist_category_obj = Category::find($specialistData->specialist_category_id);

        $filter_category_array = [];
        $all_children = $specialist_category_obj->child;
        $filter_category_array[] = array($specialist_category_obj, $all_children);

        // these lines of code are all for category dropdown select form
        $products = Product::findOrFail(Purify::clean($id));

        $allAttributes = AttributeItem::find($products->attributes()->pluck('attribute_item_id'));

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
            $role = $specialistData->role;
            $vendor_sector = NULL;
        }

        return view('specialist.product.product_copy', compact('specialistData', 'products', 'allAttributes', 'role', 'vendor_sector', 'filter_category_array'));
    }

    public function SpecialistStoreCopyProduct(Request $request) {

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
            'owner_id' => 1,
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
            $product = Product::find($product_id);

            $attributes = [];
            $attribute_id = collect($request->attribute)->keys()->first();
            foreach (Purify::clean(collect($request->attribute)->first()) as $key => $attribute_item) {
                $attribute_in_loop = AttributeItem::find($key);
                if($attribute_in_loop->attribute_item_type == "dropdown" && $attribute_item["attribute_value_id"] != 'none' && !$attribute_in_loop->multiple_selection_attribute) {
                    $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_item["attribute_value_id"], "attribute_value" => NULL);
                } elseif($attribute_in_loop->attribute_item_type == "dropdown" && count(collect($attribute_item["attribute_value_id"])) > 1 && $attribute_in_loop->multiple_selection_attribute) {
                    // به خاطر گزینه چندگانه باید همه مقادیر وارد گردد
                    foreach ($attribute_item["attribute_value_id"] as $attribute_value_id_key => $attribute_value_id_item) {
                        if($attribute_value_id_key == 0) {
                            continue;
                        }
                        $attributes[][$attribute_id] = array("attribute_item_id" => $key, "attribute_value_id" => (int) $attribute_value_id_item, "attribute_value" => NULL);
                    }

                } elseif($attribute_in_loop->attribute_item_type == "input_field" && $attribute_item["attribute_value"] != '' && !$attribute_in_loop->multiple_selection_attribute) {
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

        return redirect(route('specialist.all.product'))->with('success', 'محصول مورد نظر با موفقیت ایجاد گردید.');
    }

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

    /**************************************
    End of Product Section 
    **************************************/

    /**************************************
    Start of User Management Section 
    **************************************/

    public function SpecialistVendorStatus()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $VendorStatus = User::where('role', 'vendor')->latest()->get();

        // add custom pagination for related users
        $relatedVendorsArr = [];
        foreach ($VendorStatus as $item) {
            $vendor_sector_arr = explode(",", $item->vendor_sector);
            if (in_array($specialistData->specialist_category_id, $vendor_sector_arr)) {
                $relatedVendorsArr[] = $item;
            }
        }
        $products_arr = new Collection($relatedVendorsArr);
        $totalGroup = count($products_arr);
        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page');
        $relatedVendors = new LengthAwarePaginator($products_arr->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        // add custom pagination for related users

        return view('specialist.users.vendor.activate_account.vendor_status', compact('relatedVendors', 'specialistData'));
    } //End method

    public function SpecialistVendorStatusSearch(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $query_string = Purify::clean($request['query']);

        // add search for related users      
        $relatedVendorsIds = [];
        $all_vendors = User::where('role','vendor')->get();
        foreach ($all_vendors as $item) {
            $vendor_sector_arr = explode(",", $item->vendor_sector);
            if (in_array($specialistData->specialist_category_id, $vendor_sector_arr)) {
                $relatedVendorsIds[] = $item->id;
            }
        }      
        // add search for related users

        $relatedVendors = User::search($query_string)->whereIn('id', $relatedVendorsIds)->paginate(10);

        return view('specialist.users.vendor.activate_account.vendor_status', compact('relatedVendors', 'specialistData'));
    } //End method

    public function SpecialistVendorStatusChange(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $vendor_id = Purify::clean($request->vendor_id);
        $data = User::find($vendor_id);
        $vendor_sector_arr = explode(",", $data->vendor_sector);

        // here check if maclicious user enters unrelated vendor ID to change its status
        if (! in_array($specialistData->specialist_category_id, $vendor_sector_arr)) {
            return back()->with('error', 'زمینه کاری کارشناس با تأمین کننده تطابق ندارد.');
        }

        if ($data['status'] === "inactive") {
            $data['status'] = "active";
        } else {
            $data['status'] = "inactive";
        }

        $data->save();
        return redirect()->back()->with('success', 'وضعیت تأمین کننده با موفقیت تغییر داده شد.');
    } //End method

    public function SpecialistVendorStatusView($id)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $data = User::find(Purify::clean($id));

        $vendor_sector_arr = explode(",", $data->vendor_sector);
        $vendor_sector_cat_arr = [];
        foreach ($vendor_sector_arr as $vendor_sector_item) {
            $vendor_sector_cat_arr[] = Category::find($vendor_sector_item);
        }

        return view('specialist.users.vendor.activate_account.vendor_status_view', compact('data', 'specialistData', 'vendor_sector_cat_arr'));
    } //End method

    public function SpecialistRetailerStatus()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $RetailerStatus = User::where('role', 'retailer')->latest()->get();

        // add custom pagination for related users
        $relatedRetailersArr = [];
        foreach ($RetailerStatus as $item) {
            $retailer_sector_arr = explode(",", $item->vendor_sector);
            if (in_array($specialistData->specialist_category_id, $retailer_sector_arr)) {
                $relatedRetailersArr[] = $item;
            }
        }
        $products_arr = new Collection($relatedRetailersArr);
        $totalGroup = count($products_arr);
        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page');
        $relatedRetailers = new LengthAwarePaginator($products_arr->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        // add custom pagination for related users

        return view('specialist.users.retailer.activate_account.retailer_status', compact('relatedRetailers', 'specialistData'));
    } //End method

    public function SpecialistRetailerStatusSearch(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $query_string = Purify::clean($request['query']);
    
        // add search for related users
        $relatedRetailersIds = [];
        $all_retailers = User::where('role','retailer')->get();
        foreach ($all_retailers as $item) {
            $retailer_sector_arr = explode(",", $item->vendor_sector);
            if (in_array($specialistData->specialist_category_id, $retailer_sector_arr)) {
                $relatedRetailersIds[] = $item->id;
            }
        }
        // add search for related users

        $relatedRetailers = User::search($query_string)->whereIn('id', $relatedRetailersIds)->paginate(10);

        return view('specialist.users.retailer.activate_account.retailer_status', compact('relatedRetailers', 'specialistData'));
    } //End method

    public function SpecialistRetailerStatusChange(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $retailer_id = Purify::clean($request->retailer_id);
        $data = User::find($retailer_id);
        $retailer_sector_arr = explode(",", $data->vendor_sector);

        // here check if maclicious user enters unrelated retailer ID to change its status
        if (! in_array($specialistData->specialist_category_id, $retailer_sector_arr)) {
            return back()->with('error', 'زمینه کاری کارشناس با فروشنده تطابق ندارد.');
        }

        if ($data['status'] === "inactive") {
            $data['status'] = "active";
        } else {
            $data['status'] = "inactive";
        }

        $data->save();
        return redirect()->back()->with('success', 'وضعیت فروشنده با موفقیت تغییر داده شد.');
    } //End method

    public function SpecialistRetailerStatusView($id)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $data = User::find(Purify::clean($id));

        $retailer_sector_arr = explode(",", $data->vendor_sector);
        $retailer_sector_cat_arr = [];
        foreach ($retailer_sector_arr as $retailer_sector_item) {
            $retailer_sector_cat_arr[] = Category::find($retailer_sector_item);
        }

        return view('specialist.users.retailer.activate_account.retailer_status_view', compact('data', 'specialistData', 'retailer_sector_cat_arr'));
    } //End method

    // مربوط به شرکت باربری
    public function SpecialistFreightageStatus()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $FreightageStatus = User::where('role', 'freightage')->latest()->get();

        // add custom pagination for related users
        $relatedFreightagesArr = [];
        foreach ($FreightageStatus as $item) {
            $freightage_sector_arr = explode(",", $item->freightage->category_id);
            if (in_array($specialistData->specialist_category_id, $freightage_sector_arr)) {
                $relatedFreightagesArr[] = $item;
            }
        }
        $products_arr = new Collection($relatedFreightagesArr);
        $totalGroup = count($products_arr);
        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page');
        $relatedFreightages = new LengthAwarePaginator($products_arr->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        // add custom pagination for related users

        return view('specialist.users.freightage.activate_account.freightage_status', compact('relatedFreightages', 'specialistData'));
    } //End method

    public function SpecialistFreightageStatusSearch(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $query_string = Purify::clean($request['query']);

        // add search for related users
        $relatedFreightagesIds = [];
        $all_freightages = User::where('role','freightage')->get();
        foreach ($all_freightages as $item) {
            $freightage_sector_arr = explode(",", $item->freightage->category_id);
            if (in_array($specialistData->specialist_category_id, $freightage_sector_arr)) {
                $relatedFreightagesIds[] = $item->id;
            }
        }
        // add search for related users

        $relatedFreightages = User::search($query_string)->whereIn('id', $relatedFreightagesIds)->paginate(10);

        return view('specialist.users.freightage.activate_account.freightage_status', compact('relatedFreightages', 'specialistData'));
    } //End method

    public function SpecialistFreightageStatusChange(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $freightage_id = Purify::clean($request->freightage_id);
        $data = User::find($freightage_id);
        $freightage_sector_arr = explode(",", $data->freightage->category_id);

        // here check if maclicious user enters unrelated freightage ID to change its status
        if (! in_array($specialistData->specialist_category_id, $freightage_sector_arr)) {
            return back()->with('error', 'زمینه کاری کارشناس با شرکت باربری تطابق ندارد.');
        }

        if ($data['status'] === "inactive") {
            $data['status'] = "active";
        } else {
            $data['status'] = "inactive";
        }

        $data->save();
        return redirect()->back()->with('success', 'وضعیت شرکت باربری با موفقیت تغییر داده شد.');
    } //End method

    public function SpecialistFreightageStatusView($id)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $data = User::find(Purify::clean($id));

        $freightage_sector_arr = explode(",", $data->freightage->type_temp);

        return view('specialist.users.freightage.activate_account.freightage_status_view', compact('data', 'specialistData', 'freightage_sector_arr'));
    } //End method
    // مربوط به شرکت باربری

    public function SpecialistDriverStatus()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $DriverStatus = User::where('role', 'driver')->latest()->paginate(10);

        return view('specialist.users.driver.activate_account.driver_status', compact('DriverStatus', 'specialistData'));
    } //End method

    public function SpecialistDriverStatusSearch(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $query_string = Purify::clean($request['query']);

        // add search for related users
        $relatedDriverIds = [];
        $all_drivers = User::where('role','driver')->get();
        foreach ($all_drivers as $item) {
            $driver_sector_arr = explode(",", $item->driver->category_id);
            if (in_array($specialistData->specialist_category_id, $driver_sector_arr)) {
                $relatedDriverIds[] = $item->id;
            }
        }
        // add search for related users

        $DriverStatus = User::search($query_string)->whereIn('id', $relatedDriverIds)->paginate(10);

        return view('specialist.users.driver.activate_account.driver_status', compact('DriverStatus', 'specialistData'));
    } //End method

    public function SpecialistDriverStatusChange(Request $request)
    {
        $driver_id = Purify::clean($request->driver_id);
        $data = User::find($driver_id);

        if ($data['status'] === "inactive") {
            $data['status'] = "active";
        } else {
            $data['status'] = "inactive";
        }

        $data->save();
        return redirect()->back()->with('success', 'وضعیت باربری با موفقیت تغییر داده شد.');
    } //End method

    public function SpecialistDriverStatusView($id)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $data = User::find(Purify::clean($id));

        $driver_sector_arr = explode(",", $data->driver->type_temp);

        return view('specialist.users.driver.activate_account.driver_status_view', compact('data', 'specialistData', 'driver_sector_arr'));
    } //End method

    public function SpecialistVendorProductVerifyAll()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $productsDB = Product::where('product_verification', 'inactive')->whereNot('vendor_id', NULL)->latest()->get();

        $products = [];
        foreach ($productsDB as $product) {
            $vendor_sector_arr = explode(",", $product->vendor->vendor_sector);
            if (in_array($specialistData->specialist_category_id, $vendor_sector_arr) && ($product->parent_category_id == $specialistData->specialist_category_id)) {
                $products[] = $product;
            }
        }

        return view('specialist.product.product_verify.vendor.product_verify_all', compact('specialistData', 'products'));
    }

    public function SpecialistRetailerProductVerifyAll()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $productsDB = Product::where('product_verification', 'inactive')->whereNot('retailer_id', NULL)->latest()->get();

        $products = [];
        foreach ($productsDB as $product) {
            $retailer_sector_arr = explode(",", $product->retailer->vendor_sector);
            if (in_array($specialistData->specialist_category_id, $retailer_sector_arr) && ($product->parent_category_id == $specialistData->specialist_category_id)) {
                $products[] = $product;
            }
        }

        return view('specialist.product.product_verify.retailer.product_verify_all', compact('specialistData', 'products'));
    }

    public function SpecialistVendorAboutVerifyAll()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $users = User::where('role', 'vendor')->where('status', 'active')->where('vendor_description_status', 'inactive')->latest()->get();

        // add custom pagination for related users
        $relatedVendorsArr = [];
        foreach ($users as $item) {
            $vendor_sector_arr = explode(",", $item->vendor_sector);
            if (in_array($specialistData->specialist_category_id, $vendor_sector_arr)) {
                $relatedVendorsArr[] = $item;
            }
        }
        $users_arr = new Collection($relatedVendorsArr);
        $totalGroup = count($users_arr);
        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page');
        $relatedVendors = new LengthAwarePaginator($users_arr->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        // add custom pagination for related users

        return view('specialist.users.vendor.verify_about.vendor_about_status', compact('specialistData', 'relatedVendors'));
    }

    public function SpecialistVendorAboutVerifyAllSearch(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $query_string = Purify::clean($request['query']);
        
        // add search for related users
        $relatedVendorsIds = [];
        $allVendors = User::where('role', 'vendor')->where('status','active')->where('vendor_description_status','inactive')->get();
        foreach ($allVendors as $item) {
            $vendor_sector_arr = explode(",", $item->vendor_sector);
            if (in_array($specialistData->specialist_category_id, $vendor_sector_arr)) {
                $relatedVendorsIds[] = $item->id;
            }
        }
        // add search for related users

        $relatedVendors = User::search($query_string)->whereIn('id',$relatedVendorsIds)->paginate(10);

        return view('specialist.users.vendor.verify_about.vendor_about_status', compact('specialistData', 'relatedVendors'));
    } //End method

    public function SpecialistVendorAboutVerify($id)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        $vendorData = User::find((int) Purify::clean($id));

        return view('specialist.users.vendor.verify_about.about_vendor', compact('specialistData', 'id', 'vendorData'));
    }

    public function SpecialistVendorAboutVerifyStore(Request $request)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $id = Purify::clean($request->id);
        $data = User::find((int) $id);

        $incomingFields = $request->validate([
            'vendor_description' => 'required',
        ], [
            'vendor_description.required' => 'لطفا توضیحات فروشگاه را وارد نمایید.',
        ]);

        $vendor_sector_arr = explode(",", $data->vendor_sector);
        if (! in_array($specialistData->specialist_category_id, $vendor_sector_arr)) {
            return redirect()->route('specialist.vendor.about.verifyAll')->with('error', 'شما اجازه ویرایش اطلاعات این تأمین کننده را ندارید!');
        }

        $data->vendor_description = ($incomingFields['vendor_description']);
        $data->vendor_description_status = 'active';
        $data->save();

        return redirect()->route('specialist.vendor.about.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
    }

    public function SpecialistRetailerAboutVerifyAll()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $users = User::where('role', 'retailer')->where('status', 'active')->where('vendor_description_status', 'inactive')->latest()->get();

        // add custom pagination for related users
        $relatedRetailersArr = [];
        foreach ($users as $item) {
            $retailer_sector_arr = explode(",", $item->vendor_sector);
            if (in_array($specialistData->specialist_category_id, $retailer_sector_arr)) {
                $relatedRetailersArr[] = $item;
            }
        }
        $users_arr = new Collection($relatedRetailersArr);
        $totalGroup = count($users_arr);
        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page');
        $relatedRetailers = new LengthAwarePaginator($users_arr->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        // add custom pagination for related users

        return view('specialist.users.retailer.verify_about.retailer_about_status', compact('specialistData', 'relatedRetailers'));
    }
    public function SpecialistRetailerAboutVerifyAllSearch(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $query_string = Purify::clean($request['query']);
        
        // add search for related users
        $relatedRetailersIds = [];
        $allRetailers = User::where('role', 'retailer')->where('status','active')->where('vendor_description_status','inactive')->get();
        foreach ($allRetailers as $item) {
            $vendor_sector_arr = explode(",", $item->vendor_sector);
            if (in_array($specialistData->specialist_category_id, $vendor_sector_arr)) {
                $relatedRetailersIds[] = $item->id;
            }
        }
        // add search for related users

        $relatedRetailers = User::search($query_string)->whereIn('id',$relatedRetailersIds)->paginate(10);
        // add search for related users

        return view('specialist.users.retailer.verify_about.retailer_about_status', compact('specialistData', 'relatedRetailers'));
    } //End method

    public function SpecialistRetailerAboutVerify($id)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        $retailerData = User::find((int) Purify::clean($id));

        return view('specialist.users.retailer.verify_about.about_retailer', compact('specialistData', 'id', 'retailerData'));
    }

    public function SpecialistRetailerAboutVerifyStore(Request $request)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $id = Purify::clean($request->id);
        $data = User::find((int) $id);

        $incomingFields = $request->validate([
            'vendor_description' => 'required',
        ], [
            'vendor_description.required' => 'لطفا توضیحات فروشگاه را وارد نمایید.',
        ]);

        $retailer_sector_arr = explode(",", $data->vendor_sector);
        if (! in_array($specialistData->specialist_category_id, $retailer_sector_arr)) {
            return redirect()->route('specialist.retailer.about.verifyAll')->with('error', 'شما اجازه ویرایش اطلاعات این فروشنده را ندارید!');
        }

        $data->vendor_description = ($incomingFields['vendor_description']);
        $data->vendor_description_status = 'active';
        $data->save();

        return redirect()->route('specialist.retailer.about.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
    }

    public function SpecialistFreightageAboutVerifyAll()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $users = User::where('role', 'freightage')->where('status', 'active')->where('vendor_description_status', 'inactive')->latest()->get();

        // add custom pagination for related users
        $relatedFreightagesArr = [];
        foreach ($users as $item) {
            $freightage_sector_arr = explode(",", $item->freightage->category_id);
            if (in_array($specialistData->specialist_category_id, $freightage_sector_arr)) {
                $relatedFreightagesArr[] = $item;
            }
        }
        $users_arr = new Collection($relatedFreightagesArr);
        $totalGroup = count($users_arr);
        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page');
        $relatedFreightages = new LengthAwarePaginator($users_arr->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        // add custom pagination for related users

        return view('specialist.users.freightage.verify_about.freightage_about_status', compact('specialistData', 'relatedFreightages'));
    }
    public function SpecialistFreightageAboutVerifyAllSearch(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $query_string = Purify::clean($request['query']);
        
        // add search for related users
        $relatedFreightageIds = [];
        $allFreightages = User::where('role', 'freightage')->where('status','active')->where('vendor_description_status','inactive')->get();
        foreach ($allFreightages as $item) {
            $vendor_sector_arr = explode(",", $item->freightage->category_id);
            if (in_array($specialistData->specialist_category_id, $vendor_sector_arr)) {
                $relatedFreightageIds[] = $item->id;
            }
        }
        // add search for related users

        $relatedFreightages = User::search($query_string)->whereIn('id', $relatedFreightageIds)->paginate(10);
        // add search for related users

        return view('specialist.users.freightage.verify_about.freightage_about_status', compact('specialistData', 'relatedFreightages'));
    } //End method

    public function SpecialistFreightageAboutVerify($id)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        $freightageData = User::find((int) Purify::clean($id));

        return view('specialist.users.freightage.verify_about.about_freightage', compact('specialistData', 'id', 'freightageData'));
    }

    public function SpecialistFreightageAboutVerifyStore(Request $request)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $id = Purify::clean($request->id);
        $data = User::find((int) $id);

        $incomingFields = $request->validate([
            'vendor_description' => 'required',
        ], [
            'vendor_description.required' => 'لطفا توضیحات شرکت باربری را وارد نمایید.',
        ]);

        $freightage_sector_arr = explode(",", $data->freightage->category_id);
        if (! in_array($specialistData->specialist_category_id, $freightage_sector_arr)) {
            return redirect()->route('specialist.freightage.about.verifyAll')->with('error', 'شما اجازه ویرایش اطلاعات این شرکت باربری را ندارید!');
        }

        $data->vendor_description = ($incomingFields['vendor_description']);
        $data->vendor_description_status = 'active';
        $data->save();

        return redirect()->route('specialist.freightage.about.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
    }

    public function SpecialistDriverAboutVerifyAll()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $users = User::where('role', 'driver')->where('status', 'active')->where('vendor_description_status', 'inactive')->latest()->paginate(10);

        return view('specialist.users.driver.verify_about.driver_about_status', compact('specialistData', 'users'));
    }
    public function SpecialistDriverAboutVerifyAllSearch(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $query_string = Purify::clean($request['query']);
        
        // add search for related users
        $relatedDriverIds = [];
        $allDrivers = User::where('role', 'driver')->where('status','active')->where('vendor_description_status','inactive')->get();
        foreach ($allDrivers as $item) {
            $vendor_sector_arr = explode(",", $item->freightage->category_id);
            if (in_array($specialistData->specialist_category_id, $vendor_sector_arr)) {
                $relatedDriverIds[] = $item->id;
            }
        }
        // add search for related users
        $users = User::search($query_string)->whereIn('id', $relatedDriverIds)->paginate(10);

        return view('specialist.users.driver.verify_about.driver_about_status', compact('specialistData', 'users'));
    }

    public function SpecialistDriverAboutVerify($id)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        $driverData = User::find((int) Purify::clean($id));

        return view('specialist.users.driver.verify_about.about_driver', compact('specialistData', 'id', 'driverData'));
    }

    public function SpecialistDriverAboutVerifyStore(Request $request)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);

        $id = Purify::clean($request->id);
        $data = User::find((int) $id);

        $incomingFields = $request->validate([
            'vendor_description' => 'required',
        ], [
            'vendor_description.required' => 'لطفا توضیحات شرکت باربری را وارد نمایید.',
        ]);


        $data->vendor_description = ($incomingFields['vendor_description']);
        $data->vendor_description_status = 'active';
        $data->save();

        return redirect()->route('specialist.driver.about.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
    }

    public function SpecialistFreightageProfileVerifyAll()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $users = User::where('role', 'freightage')->latest()->get();

        // add custom pagination for related users
        $relatedFreightagesArr = [];
        foreach ($users as $item) {
            $freightage_sector_arr = explode(",", $item->freightage->category_id);
            if (in_array($specialistData->specialist_category_id, $freightage_sector_arr) && $item->freightage->status == "inactive") {
                $relatedFreightagesArr[] = $item;
            }
        }
        $users_arr = new Collection($relatedFreightagesArr);
        $totalGroup = count($users_arr);
        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page');
        $relatedFreightages = new LengthAwarePaginator($users_arr->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        // add custom pagination for related users

        return view('specialist.users.freightage.profile_field_of_activity.freightage_activity_status', compact('specialistData', 'relatedFreightages'));
    }

    public function SpecialistFreightageProfileVerifyAllSearch(Request $request)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $query_string = Purify::clean($request['query']);

        $relatedFreightagesIds = [];
        $freightages = User::where('role','freightage')->get();
        foreach ($freightages as $user) {
            $freightage_sector_arr = explode(",", $user->freightage->category_id);
            if ($user->freightage->status == "inactive" && in_array($specialistData->specialist_category_id, $freightage_sector_arr)) {
                $relatedFreightagesIds[] = $user->id;
            }
            
        }
        $relatedFreightages = User::search($query_string)->whereIn('id', $relatedFreightagesIds)->paginate(10);
        

        return view('specialist.users.freightage.profile_field_of_activity.freightage_activity_status', compact('specialistData', 'relatedFreightages'));
    }

    public function SpecialistFreightageProfileVerify($id)
    {
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        $freightageData = User::find((int) Purify::clean($id));

        $freightage_sector_arr = explode(",", $freightageData->freightage->type_temp);

        // category for filter
        $vendor_sector_cat_arr = Category::where('parent', 0)->get();

        $filter_category_array = [];
        foreach ($vendor_sector_cat_arr as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }
        // category for filter

        $vendorsName = User::where('role', 'vendor')->where('status', 'active')->get();

        $category_sector_cat_arr_selected = explode(',', $freightageData->freightage->category_id_temp);
        $vendor_arr_selected = explode(',', $freightageData->freightage->vendor_id_temp);

        $loader_type_arr_selected = explode(',', $freightageData->freightage->freightage_loader_type_temp);

        $loader_type_rail_arr_selected = explode(',', $freightageData->freightage->freightage_loader_type_rail_temp);
        $loader_type_sea_arr_selected = explode(',', $freightageData->freightage->freightage_loader_type_sea_temp);
        $loader_type_air_arr_selected = explode(',', $freightageData->freightage->freightage_loader_type_air_temp);

        $freightageTypeArray = FreightageTypeService::getFreightageTypeArray();
        $freightageLoaderTypeRoadArray = FreightageTypeRoadService::getFreightageLoaderTypeRoadArray();
        $freightageLoaderTypeRailArray = FreightageTypeRailService::getFreightageLoaderTypeRailArray();
        $freightageLoaderTypeSeaArray = FreightageTypeSeaService::getFreightageLoaderTypeSeaArray();
        $freightageLoaderTypeAirArray = FreightageTypeAirService::getFreightageLoaderTypeAirArray();

        return view('specialist.users.freightage.profile_field_of_activity.activity_freightage', compact('specialistData', 'id', 'freightageData', 'freightage_sector_arr', 'vendor_sector_cat_arr', 'filter_category_array', 'vendorsName', 'category_sector_cat_arr_selected', 'vendor_arr_selected', 'loader_type_arr_selected', 'loader_type_rail_arr_selected', 'loader_type_sea_arr_selected', 'loader_type_air_arr_selected', 'freightageTypeArray', 'freightageLoaderTypeRoadArray', 'freightageLoaderTypeRailArray', 'freightageLoaderTypeSeaArray', 'freightageLoaderTypeAirArray'));
    }

    public function SpecialistFreightageProfileVerifyStore(Request $request)
    {
        $incomingFields = $request->validate([
            'type' => 'required',
            'category_id' => 'required',
        ], [
            'type.required' => 'لطفا زمینه فعالیت باربری را انتخاب نمایید.',
            'category_id.required' => 'لطفا حداقل یک دسته بندی مرتبط با باربری را انتخاب نمایید.',
        ]);

        // زمینه فعالیت زمینی
        if (in_array(1, $incomingFields['type'])) {
            if ($request->loader_type == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا نوع بارگیر در حمل جاده ای را مشخص نمایید.');
            }
        }

        // زمینه فعالیت ریلی
        if (in_array(6, $incomingFields['type'])) {
            if ($request->loader_type_rail == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا نوع بارگیر در حمل ریلی را مشخص نمایید.');
            }
        }

        // زمینه فعالیت آبی
        if (in_array(8, $incomingFields['type'])) {
            if ($request->loader_type_sea == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا نوع بارگیر در حمل آبی را مشخص نمایید.');
            }
        }

        // زمینه فعالیت هوایی
        if (in_array(7, $incomingFields['type'])) {
            if ($request->loader_type_air == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا نوع بارگیر در حمل هوایی را مشخص نمایید.');
            }
        }

        $freightage_id = Purify::clean($request->freightage_id);
        $data = User::find($freightage_id);

        // here check if maclicious user enters unrelated freightage ID to change its status
        $user_id = Auth::user()->id;
        $specialistData = User::find($user_id);
        $freightage_sector_arr = explode(",", $data->freightage->category_id);
        if (! in_array($specialistData->specialist_category_id, $freightage_sector_arr)) {
            return back()->with('error', 'زمینه کاری کارشناس با شرکت باربری تطابق ندارد.');
        }

        $data->freightage->type = implode(',', Purify::clean($incomingFields['type']));
        $data->freightage->category_id = implode(',', Purify::clean($incomingFields['category_id']));
        $data->freightage->vendor_id = $request->vendor_id ? implode(',', Purify::clean($request->vendor_id)) : NULL;
        $data->freightage->freightage_loader_type = $request->loader_type ? implode(',', Purify::clean($request->loader_type)) : NULL;
        $data->freightage->freightage_loader_type_rail = $request->loader_type_rail ? implode(',', Purify::clean($request->loader_type_rail)) : NULL;
        $data->freightage->freightage_loader_type_sea = $request->loader_type_sea ? implode(',', Purify::clean($request->loader_type_sea)) : NULL;
        $data->freightage->freightage_loader_type_air = $request->loader_type_air ? implode(',', Purify::clean($request->loader_type_air)) : NULL;

        $data->freightage->type_temp = implode(',', Purify::clean($incomingFields['type']));
        $data->freightage->category_id_temp = implode(',', Purify::clean($incomingFields['category_id']));
        $data->freightage->vendor_id_temp = $request->vendor_id ? implode(',', Purify::clean($request->vendor_id)) : NULL;
        $data->freightage->freightage_loader_type_temp = $request->loader_type ? implode(',', Purify::clean($request->loader_type)) : NULL;
        $data->freightage->freightage_loader_type_rail_temp = $request->loader_type_rail ? implode(',', Purify::clean($request->loader_type_rail)) : NULL;
        $data->freightage->freightage_loader_type_sea_temp = $request->loader_type_sea ? implode(',', Purify::clean($request->loader_type_sea)) : NULL;
        $data->freightage->freightage_loader_type_air_temp = $request->loader_type_air ? implode(',', Purify::clean($request->loader_type_air)) : NULL;

        $data->freightage->status = "active";

        $data->freightage->save();

        return redirect()->route('specialist.freightage.profile.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
    }

    public function SpecialistDriverProfileVerifyAll()
    {
        $specialistData = auth()->user();

        $users = Driver::where('status', 'inactive')->latest()->paginate(10);

        return view('specialist.users.driver.profile_field_of_activity.driver_activity_status', compact('specialistData', 'users'));
    }

    public function SpecialistDriverProfileVerifyAllSearch(Request $request)
    {
        $specialistData = auth()->user();
        $query_string = Purify::clean($request['query']);

        // $users_driver = User::where([
        //     ['username', 'like', "%{$query_string}%"],
        //     ['role', '=', "driver"],
        // ])->OrWhere([
        //             ['firstname', 'like', "%{$query_string}%"],
        //             ['role', '=', "driver"],
        //         ])->OrWhere([
        //             ['lastname', 'like', "%{$query_string}%"],
        //             ['role', '=', "driver"],
        //         ])->OrWhere([
        //             ['shop_name', 'like', "%{$query_string}%"],
        //             ['role', '=', "driver"],
        //         ])->OrWhere([
        //             ['email', 'like', "%{$query_string}%"],
        //             ['role', '=', "driver"],
        //         ])->get();

        // $users = [];

        // foreach ($users_driver as $user) {
        //     if ($user->driver->status == "inactive") {
        //         $users[] = $user->driver;
        //     }
        // }

        $relatedDriversIds = [];
        $drivers = User::where('role','driver')->get();
        foreach ($drivers as $user) {
            $driver_sector_arr = explode(",", $user->driver->category_id);
            if ($user->driver->status == "inactive" && in_array($specialistData->specialist_category_id, $driver_sector_arr)) {
                $relatedDriversIds[] = $user->id;
            }
            
        }
        $users = User::search($query_string)->whereIn('id', $relatedDriversIds)->paginate(10);

        return view('specialist.users.driver.profile_field_of_activity.driver_activity_status', compact('specialistData', 'users'));
    }

    public function SpecialistDriverProfileVerify($id)
    {
        $specialistData = auth()->user();
        $driverData = User::find((int) Purify::clean($id));

        $driver_sector_arr = explode(",", $driverData->driver->type_temp);
        // category for filter
        $vendor_sector_cat_arr = Category::where('parent', 0)->get();

        $filter_category_array = [];
        foreach ($vendor_sector_cat_arr as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }
        // category for filter

        $vendorsName = User::where('role', 'vendor')->where('status', 'active')->get();

        $category_sector_cat_arr_selected = explode(',', $driverData->driver->category_id_temp);
        $vendor_arr_selected = explode(',', $driverData->driver->vendor_id_temp);

        $loader_type_arr_selected = explode(',', $driverData->driver->freightage_loader_type_temp);

        $driverTypeArray = DriverTypeService::getDriverTypeArray();
        $driverLoaderTypeRoadArray = DriverTypeRoadService::getDriverLoaderTypeRoadArray();

        return view('specialist.users.driver.profile_field_of_activity.activity_driver', compact('specialistData', 'id', 'driverData', 'driver_sector_arr', 'vendor_sector_cat_arr', 'filter_category_array', 'vendorsName', 'category_sector_cat_arr_selected', 'vendor_arr_selected', 'loader_type_arr_selected', 'driverTypeArray', 'driverLoaderTypeRoadArray'));
    }

    public function SpecialistDriverProfileVerifyStore(Request $request)
    {
        $incomingFields = $request->validate([
            'type' => 'required',
            'category_id' => 'required',
        ], [
            'type.required' => 'لطفا زمینه فعالیت راننده را انتخاب نمایید.',
            'category_id.required' => 'لطفا حداقل یک دسته بندی مرتبط با راننده را انتخاب نمایید.',
        ]);

        // زمینه فعالیت زمینی
        if (in_array(1, $incomingFields['type'])) {
            if ($request->loader_type == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا نوع بارگیر در حمل جاده ای را مشخص نمایید.');
            }
        }

        $data = Driver::find(Purify::clean($request->id));

        $data->type = implode(',', Purify::clean($incomingFields['type']));
        $data->category_id = implode(',', Purify::clean($incomingFields['category_id']));
        $data->vendor_id = $request->vendor_id ? implode(',', Purify::clean($request->vendor_id)) : NULL;
        $data->freightage_loader_type = $request->loader_type ? implode(',', Purify::clean($request->loader_type)) : NULL;

        $data->type_temp = implode(',', Purify::clean($incomingFields['type']));
        $data->category_id_temp = implode(',', Purify::clean($incomingFields['category_id']));
        $data->vendor_id_temp = $request->vendor_id ? implode(',', Purify::clean($request->vendor_id)) : NULL;
        $data->freightage_loader_type_temp = $request->loader_type ? implode(',', Purify::clean($request->loader_type)) : NULL;

        $data->status = "active";

        $data->save();

        return redirect()->route('specialist.driver.profile.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
    }
    /**************************************
    End of User Management Section 
    **************************************/


    /**************************************
    Start of Chat Section 
    **************************************/

    // توابع ریفرکتور
    protected function getMessageObj($userId, $otherUserId) {
        $messagesObjJdate = [];
        $roomId = "";
        $messageStatus = false;

        $temp_chat_reults = Chat::all();

        $ChatObj1 = Chat::where('userId', '=', $userId)->where('otherUserId', '=', $otherUserId)->latest()->get();
        $ChatObj2 = Chat::where('userId', '=', $otherUserId)->where('otherUserId', '=', $userId)->latest()->get();

        if ($ChatObj1->count() || $ChatObj2->count()) {

            if ((! $temp_chat_reults->count())) {
                $roomId = 1;
            } else {
                if ($ChatObj1->count()) {
                    $roomId = $ChatObj1[0]->roomId;
                } elseif ($ChatObj2->count()) {
                    $roomId = $ChatObj2[0]->roomId;
                }
            }

            $messagesObj = Chat::where('roomId', $roomId)->get();

            // این وضعیت پیام برای اینه که وقتی پیام جدید میاد صفحه اسکرول کنه پایین، اگر نباشه صفحه همینجوری می چسبه به پایین
            if (Session::get('messageCount' . $roomId) && $messagesObj->count() != Session::get('messageCount' . $roomId)) {
                $messageStatus = true;
            }
            Session::put('messageCount' . $roomId, $messagesObj->count());

            foreach ($messagesObj as $messageItem) {
                $messagesCollection = collect($messageItem);
                $messagesObjJdate[] = $messagesCollection->put('jdate', jdate($messageItem->created_at)->ago());
            }
        } else {
            $messagesObjJdate = NULL;
        }

        return array("messagesObjJdate" => $messagesObjJdate, "roomId" => $roomId, "messageStatus" => $messageStatus);
    }
    // توابع ریفرکتور


    // این تابع برای بارگذاری اولیه صفحه چت خصوصی است
    public function SpecialistPrivateChat()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $roomArr = [];
        $chatArr = [];

        $userChats = Chat::where('userId', $id)->orWhere('otherUserId', $id)->latest()->get();

        foreach ($userChats as $chatItem) {
            $roomArr[] = $chatItem->roomId;
        }
        $roomArr = array_unique($roomArr);

        foreach ($roomArr as $roomItem) {
            $chatItem = Chat::where('roomId', $roomItem)->latest()->get();

            if ($chatItem->last()->userId == $id) {
                $actuallyOtherUserId = $chatItem->last()->otherUserId;
            } else {
                $actuallyOtherUserId = $chatItem->last()->userId;
            }

            // با استفاده از این مشخص میشه کاربر ورود کرده یا خیر
            $uuidArraySize = sizeof(explode("-", $actuallyOtherUserId));

            // کاربر ورود کرده است
            if ($uuidArraySize == 1) {
                $otherUserObj = User::find($actuallyOtherUserId)->only('id', 'firstname', 'lastname', 'email', 'home_phone');
            } else {
                // کاربر ناشناس است
                $otherUserObjDB = Chat::where('userId', $actuallyOtherUserId)->first();
                $otherUserObj = array('firstname' => $otherUserObjDB->firstname, 'lastname' => $otherUserObjDB->lastname, 'id' => $actuallyOtherUserId, 'email' => $otherUserObjDB->email, 'home_phone' => $otherUserObjDB->home_phone);
            }

            $collectionInput = array('otherUserObj' => $otherUserObj, 'latestTime' => jdate($chatItem->last()->created_at)->ago());
            $chatItem->push($collectionInput);

            $chatArr[] = $chatItem;
        }

        
        return view('specialist.chat.chat', compact('specialistData', 'chatArr'));
    }

    // این تابع برای دریافت لیست کل چت ها است
    public function SpecialistPrivateChatAutoFetch()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $roomArr = [];
        $chatArr = [];

        $userChats = Chat::where('userId', $id)->orWhere('otherUserId', $id)->latest()->get();

        foreach ($userChats as $chatItem) {
            $roomArr[] = $chatItem->roomId;
        }
        $roomArr = array_unique($roomArr);

        // create array of all chats
        foreach ($roomArr as $roomItem) {
            $chatItem = Chat::where('roomId', $roomItem)->latest()->get();

            if ($chatItem->last()->userId == $id) {
                $actuallyOtherUserId = $chatItem->last()->otherUserId;
            } else {
                $actuallyOtherUserId = $chatItem->last()->userId;
            }

            $uuidArraySize = sizeof(explode("-", $actuallyOtherUserId));

            if ($uuidArraySize == 1) {
                $otherUserObj = User::find($actuallyOtherUserId)->only('id', 'firstname', 'lastname', 'email', 'home_phone');
            } else {
                $otherUserObjDB = Chat::where('userId', $actuallyOtherUserId)->first();
                $otherUserObj = array('firstname' => $otherUserObjDB->firstname, 'lastname' => $otherUserObjDB->lastname, 'id' => $actuallyOtherUserId, 'email' => $otherUserObjDB->email, 'home_phone' => $otherUserObjDB->home_phone);
            }

            $collectionInput = array('otherUserObj' => $otherUserObj, 'latestTime' => jdate($chatItem->last()->created_at)->ago());
            $chatItem->push($collectionInput);

            $chatArr[] = $chatItem;
        }

        //Long polling functionality
        // $chatStatus = false;
        // $attempts = 1;
        // while($chatStatus == false && $attempts <= 5) {
        //     sleep(2);
            
        //     $userChats = Chat::where('otherUserId', $id)->latest()->get();
        //     if (Session::get('newChatMessage') && $userChats->count() != Session::get('newChatMessage')) {
        //         $chatStatus = true;
        //     }
        //     Session::put('newChatMessage', $userChats->count());
        //     $attempts++;
        // }

        return response(['chatArr' => $chatArr, 'totalUnreadMessages' => Chat::where('otherUserId', $id)->latest()->get()->count()]);
    }

    // این تابع برای دریافت چت یک کاربر به خصوص است
    public function fetchSingleMessage(Request $request)
    {
        $otherUserId = Purify::clean($request->otherUserId);

        $uuidArraySize = sizeof(explode("-", $otherUserId));

        if ($uuidArraySize == 1) {
            $otherUserObj = User::find($otherUserId,['id','firstname','lastname']);
        } else {
            $otherUserObjDB = Chat::where('userId', $otherUserId)->first();
            $otherUserObj = array('firstname' => $otherUserObjDB->firstname, 'lastname' => $otherUserObjDB->lastname, 'id' => $otherUserId, 'email' => $otherUserObjDB->email, 'home_phone' => $otherUserObjDB->home_phone);
        }

        $userId = auth()->user()->id;

        $messageObj = $this->getMessageObj($userId, $otherUserId);
        $messagesObjJdate = $messageObj["messagesObjJdate"];

        return response(['otherUserObj' => $otherUserObj, 'messagesObj' => $messagesObjJdate, 'userId' => $userId]);
    }

    // long polling interval for single chat item
    public function fetchSingleMessageLongPolling(Request $request)
    {
        $otherUserId = Purify::clean($request->otherUserId);

        $uuidArraySize = sizeof(explode("-", $otherUserId));

        if ($uuidArraySize == 1) {
            $otherUserObj = User::find($otherUserId,['id','firstname','lastname']);
        } else {
            $otherUserObjDB = Chat::where('userId', $otherUserId)->first();
            $otherUserObj = array('firstname' => $otherUserObjDB->firstname, 'lastname' => $otherUserObjDB->lastname, 'id' => $otherUserId, 'email' => $otherUserObjDB->email, 'home_phone' => $otherUserObjDB->home_phone);
        }

        $userId = auth()->user()->id;

        $messageObj = $this->getMessageObj($userId, $otherUserId);
        $messagesObjJdate = $messageObj["messagesObjJdate"];
        $roomId = $messageObj["roomId"];
        $messageStatus = $messageObj["messageStatus"];

        // Long polling functionality
        // $attempts = 1;
        // while($messageStatus == false && $attempts <= 5) {
        //     sleep(2);

        //     $messageObj = $this->getMessageObj($userId, $otherUserId);
        //     $messagesObjJdate = $messageObj["messagesObjJdate"];
        //     $roomId = $messageObj["roomId"];
        //     $messageStatus = $messageObj["messageStatus"];

        //     $attempts++;
        // }

        // تابع مربوط به سین شدن پیام طرف مقابل
        $otherUserObjMessages = Chat::where('roomId', $roomId)->where('userId', $otherUserId)->get();
        foreach ($otherUserObjMessages as $otherUserObjMessage) {
            $otherUserObjMessage->update([
                'seen' => 1,
            ]);
        }

        return response(['otherUserObj' => $otherUserObj, 'messagesObj' => $messagesObjJdate, 'userId' => $userId, 'messageStatus' => $messageStatus]);
    }

    /**************************************
    End of Chat Section 
    **************************************/

    /**************************************
    Start of Media Section 
    **************************************/

    public function SpecialistMediaFiles()
    {

        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $files = File::latest()->get();

        return view('specialist.media.files', compact('specialistData', 'files'));
    }

    public function SpecialistMediaAddFiles()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        return view('specialist.media.add', compact('specialistData'));
    }

    public function SpecialistMediaStoreFiles(Request $request)
    {

        $id = Auth::user()->id;
        $specialistData = User::find($id);

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

        return redirect(route('specialist.media.files'))->with('success', 'فایل مورد نظر با موفقیت بارگذاری گردید.');
    }

    public function SpecialistDeleteFile($id)
    {
        $user_id = Auth::user()->id;
        $file = File::findOrFail(Purify::clean($id));
        $img = $file->fileName;

        if ($file->user_id == $user_id || $file->user_id == 0) {
            unlink($img);
            File::findOrFail($id)->delete();
        } else {
            return redirect(route('specialist.media.files'))->with('error', 'شما اجازه حذف این فایل را ندارید!');
        }

        return redirect(route('specialist.media.files'))->with('success', 'فایل مورد نظر با موفقیت حذف گردید.');
    }

    /**************************************
    End of Media Section 
    **************************************/

}