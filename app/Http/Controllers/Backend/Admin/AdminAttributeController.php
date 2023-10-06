<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeItem;
use App\Models\AttributeValue;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class AdminAttributeController extends Controller
{
    public function AllAttribute()
    {
        $adminData = auth()->user();
        $attributes = Attribute::get();

        return view('admin.backend.attribute.attribute_all', compact('adminData', 'attributes'));
    }

    public function AddAttribute()
    {
        $adminData = auth()->user();
        $parentCategories = Category::where('parent', 0)->get();

        // category for filter
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }
        
        // دریافت لیستی از کلمات کلیدی
        $attribute_item_keyword_list = collect();
        foreach (Attribute::with('items')->get() as $attribute_item_keyword) {
            $attribute_item_keyword_list->push($attribute_item_keyword->items->pluck('attribute_item_keyword'));
        }
        $attribute_item_keyword_list = $attribute_item_keyword_list->flatten()->unique();
        
        return view('admin.backend.attribute.attribute_add', compact('adminData', 'parentCategories', 'filter_category_array', 'attribute_item_keyword_list'));
    }

    public function StoreAttribute(Request $request)
    {
        $incomingFields = $request->validate([
            'role' => ['required', 'array'],
            'attribute_category_name' => 'required',
            'category_id' => 'required',
            'attribute_list_array' => 'required',
        ], [
            'role.required' => 'لطفا حساب کاربری مرتبط با ویژگی را انتخاب نمایید.',
            'role.array' => 'لطفا حساب کاربری صحیح را وارد نمایید.',
            'attribute_category_name.required' => 'لطفا نام دسته بندی را انتخاب نمایید.',
            'category_id.required' => 'لطفا زمینه فعالیت مرتبط با حساب کاربری را انتخاب نمایید.',
            'attribute_list_array.required' => 'لیست ویژگی ها نمی تواند خالی باشد!',
        ]);

        $attribute = Attribute::firstOrCreate([
            'attribute_category_name' => Purify::clean($incomingFields['attribute_category_name']),
            'role' => implode(',', Purify::clean($incomingFields['role'])),
            'category_id' => (int) Purify::clean($incomingFields['category_id']),
        ]);
        
        foreach ($incomingFields['attribute_list_array'] as $key => $attribute_list_item) {
            $attribute_item = $attribute->items()->create([
                'attribute_id' => $attribute->id,
                'attribute_item_name' => Purify::clean(json_decode($attribute_list_item)->attribute_item_name),
                'attribute_item_description' => Purify::clean(json_decode($attribute_list_item)->attribute_item_description),
                'attribute_item_keyword' => Purify::clean(json_decode($attribute_list_item)->attribute_item_keyword),
                'attribute_item_required' => Purify::clean(json_decode($attribute_list_item)->attribute_item_required) ? 1 : 0,
                'attribute_item_type' => Purify::clean(json_decode($attribute_list_item)->attribute_item_type),
                'show_in_table_page' => Purify::clean(json_decode($attribute_list_item)->show_in_table_page) ? 1 : 0,
                'show_in_product_page' => Purify::clean(json_decode($attribute_list_item)->show_in_product_page) ? 1 : 0,
                'disabled_attribute' => Purify::clean(json_decode($attribute_list_item)->disabled_attribute) ? 1 : 0,
                'multiple_selection_attribute' => Purify::clean(json_decode($attribute_list_item)->multiple_selection_attribute) ? 1 : 0,
                'attribute_list_array' => Purify::clean($request->attribute_list_array[$key]),
                'attribute_item_order' => $key + 1,
            ]);

            if(Purify::clean(json_decode($attribute_list_item)->attribute_item_type) == "dropdown") {
                foreach (json_decode($attribute_list_item)->value as $value) {
                    $attribute_item->values()->firstOrCreate([
                        'attribute_item_id' => $attribute_item->id,
                        'value' => $value
                    ]);
                }
            } else {
                $attribute_item->values()->firstOrCreate([
                    'attribute_item_id' => $attribute_item->id,
                    'value' => "دلخواه"
                ]);
            }
        }
        
        return redirect(route('all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت ایجاد گردید.');
    }

    public function EditAttribute($id)
    {
        $adminData = auth()->user();
        $parentCategories = Category::where('parent', 0)->get();
        $attribute = Attribute::find(Purify::clean($id));
        
        // category for filter
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }
        
        // دریافت لیستی از کلمات کلیدی
        $attribute_item_keyword_list = collect();
        foreach (Attribute::with('items')->get() as $attribute_item_keyword) {
            $attribute_item_keyword_list->push($attribute_item_keyword->items->pluck('attribute_item_keyword'));
        }
        $attribute_item_keyword_list = $attribute_item_keyword_list->flatten()->unique();
       
        return view('admin.backend.attribute.attribute_edit', compact('adminData', 'parentCategories', 'attribute', 'filter_category_array', 'attribute_item_keyword_list'));
    }

    public function UpdateAttribute(Request $request)
    {
        $incomingFields = $request->validate([
            'role' => ['required', 'array'],
            'attribute_category_name' => 'required',
            'category_id' => 'required',
            'attribute_list_array' => 'required',
        ], [
            'role.required' => 'لطفا حساب کاربری مرتبط با ویژگی را انتخاب نمایید.',
            'role.array' => 'لطفا حساب کاربری صحیح را وارد نمایید.',
            'attribute_category_name.required' => 'لطفا نام دسته بندی را انتخاب نمایید.',
            'category_id.required' => 'لطفا زمینه فعالیت مرتبط با حساب کاربری را انتخاب نمایید.',
            'attribute_list_array.required' => 'لیست ویژگی ها نمی تواند خالی باشد!',
        ]);

        $attribute = Attribute::find(Purify::clean(($request->id)));

        $attribute->update([
            'attribute_category_name' => Purify::clean($incomingFields['attribute_category_name']),
            'role' => implode(',', Purify::clean($incomingFields['role'])),
            'category_id' => (int) Purify::clean($incomingFields['category_id']),
        ]);

        $ignore_delete_attribute_item_array = [];
        foreach ($incomingFields['attribute_list_array'] as $key => $attribute_list_item) {
            $id = (int) json_decode($attribute_list_item)->id;

            // اگر آیتم ویژگی از قبل وجود داشته باشد یک شماره شناسایی دارد که از فرانت به اینجا ارسال می شود، در صورت وجود مقایر آن آیتم ویژگی فقط بروز رسانی می شوند و چیزی حذف نمی گردد
            if($id) {
                $attribute_item = AttributeItem::find($id);
                $attribute_item->update([
                    'attribute_id' => $attribute->id,
                    'attribute_item_name' => Purify::clean(json_decode($attribute_list_item)->attribute_item_name),
                    'attribute_item_description' => Purify::clean(json_decode($attribute_list_item)->attribute_item_description),
                    'attribute_item_keyword' => Purify::clean(json_decode($attribute_list_item)->attribute_item_keyword),
                    'attribute_item_required' => Purify::clean(json_decode($attribute_list_item)->attribute_item_required) ? 1 : 0,
                    'attribute_item_type' => Purify::clean(json_decode($attribute_list_item)->attribute_item_type),
                    'show_in_table_page' => Purify::clean(json_decode($attribute_list_item)->show_in_table_page) ? 1 : 0,
                    'show_in_product_page' => Purify::clean(json_decode($attribute_list_item)->show_in_product_page) ? 1 : 0,
                    'disabled_attribute' => Purify::clean(json_decode($attribute_list_item)->disabled_attribute) ? 1 : 0,
                    'multiple_selection_attribute' => Purify::clean(json_decode($attribute_list_item)->multiple_selection_attribute) ? 1 : 0,
                    'attribute_list_array' => Purify::clean($request->attribute_list_array[$key]),
                    'attribute_item_order' => $key + 1,
                ]);

                // این بخش مربوط به آیتم ویژگی هایی هست که جدیدا به لیست وارد شدند و شماره شناسایی ندارند
            } else {
                $attribute_item = $attribute->items()->updateOrCreate([
                    'attribute_id' => $attribute->id,
                    'attribute_item_name' => Purify::clean(json_decode($attribute_list_item)->attribute_item_name),
                    'attribute_item_description' => Purify::clean(json_decode($attribute_list_item)->attribute_item_description),
                    'attribute_item_keyword' => Purify::clean(json_decode($attribute_list_item)->attribute_item_keyword),
                    'attribute_item_required' => Purify::clean(json_decode($attribute_list_item)->attribute_item_required) ? 1 : 0,
                    'attribute_item_type' => Purify::clean(json_decode($attribute_list_item)->attribute_item_type),
                    'show_in_table_page' => Purify::clean(json_decode($attribute_list_item)->show_in_table_page) ? 1 : 0,
                    'show_in_product_page' => Purify::clean(json_decode($attribute_list_item)->show_in_product_page) ? 1 : 0,
                    'disabled_attribute' => Purify::clean(json_decode($attribute_list_item)->disabled_attribute) ? 1 : 0,
                    'multiple_selection_attribute' => Purify::clean(json_decode($attribute_list_item)->multiple_selection_attribute) ? 1 : 0,
                    'attribute_list_array' => Purify::clean($request->attribute_list_array[$key]),
                    'attribute_item_order' => $key + 1,
                ]);
            }

            if(Purify::clean(json_decode($attribute_list_item)->attribute_item_type) == "dropdown") {

                $ignore_delete_attribute_value_array = [];

                // تهیه یک لیست از مقادیر ویژگی ها
                $attibute_value_collection = !empty(AttributeItem::find($id)) ? AttributeItem::find($id)->values()->pluck('value')->toArray() : [];

                foreach (json_decode($attribute_list_item)->value as $value) {
                   
                    // مقادیر ویژگی که برابر باشند را نادیده میگیرد، به جای حذف آن ها
                    if(in_array($value, $attibute_value_collection)) {
                        $ignore_delete_attribute_value_array[] = $attribute_item->values()->where('value', $value)->get()->first()->id;
                        continue;
                    }

                    // مقادیر ویژگی هایی که جدیدا ثبت شده اند را اضافه می کند
                    $attribute_value_item_id = $attribute_item->values()->insertGetId([
                        'attribute_item_id' => $attribute_item->id,
                        'value' => $value
                    ]);

                    // لیستی از ویژگی هایی که نباید پاک شوند تهیه می شود، که شامل جدید ها و موارد قدیمی می شود
                    $ignore_delete_attribute_value_array[] = $attribute_value_item_id;
                }

                // پاک کردن مقادیر ویژگی ها
                $attribute_item->values()->whereNotIn('id', $ignore_delete_attribute_value_array)->delete();
                
            } else {
                // موارد ورودی دلخواه را ایجاد می کند
                $attribute_item->values()->updateOrCreate([
                    'attribute_item_id' => $attribute_item->id,
                    'value' => "دلخواه"
                ]);
            }

            // تهیه لیستی از آیتم ویژگی هایی که نباید پاک شوند
            $ignore_delete_attribute_item_array[] = $attribute_item->id;
        }

        // آیتم ویژگی های اضافه را پاک می کند
        $attribute->items()->whereNotIn('id', $ignore_delete_attribute_item_array)->delete();

        return redirect(route('all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت بروزرسانی گردید.');
    }

    public function CopyAttribute($id) {
        $adminData = auth()->user();
        $parentCategories = Category::where('parent', 0)->get();
        $attribute = Attribute::find(Purify::clean($id));

        // category for filter
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);

        }

        // دریافت لیستی از کلمات کلیدی
        $attribute_item_keyword_list = collect();
        foreach (Attribute::with('items')->get() as $attribute_item_keyword) {
            $attribute_item_keyword_list->push($attribute_item_keyword->items->pluck('attribute_item_keyword'));
        }
        $attribute_item_keyword_list = $attribute_item_keyword_list->flatten()->unique();

        return view('admin.backend.attribute.attribute_copy', compact('adminData', 'parentCategories', 'attribute', 'filter_category_array', 'attribute_item_keyword_list'));
    }

    public function StoreCopyAttribute(Request $request) {
        $incomingFields = $request->validate([
            'role' => ['required', 'array'],
            'attribute_category_name' => 'required',
            'category_id' => 'required',
            'attribute_list_array' => 'required',
        ], [
            'role.required' => 'لطفا حساب کاربری مرتبط با ویژگی را انتخاب نمایید.',
            'role.array' => 'لطفا حساب کاربری صحیح را وارد نمایید.',
            'attribute_category_name.required' => 'لطفا نام دسته بندی را انتخاب نمایید.',
            'category_id.required' => 'لطفا زمینه فعالیت مرتبط با حساب کاربری را انتخاب نمایید.',
            'attribute_list_array.required' => 'لیست ویژگی ها نمی تواند خالی باشد!',
        ]);

        $attribute = Attribute::firstOrCreate([
            'attribute_category_name' => Purify::clean($incomingFields['attribute_category_name']),
            'role' => implode(',', Purify::clean($incomingFields['role'])),
            'category_id' => (int) Purify::clean($incomingFields['category_id']),
        ]);
        
        foreach ($incomingFields['attribute_list_array'] as $key => $attribute_list_item) {
            $attribute_item = $attribute->items()->create([
                'attribute_id' => $attribute->id,
                'attribute_item_name' => Purify::clean(json_decode($attribute_list_item)->attribute_item_name),
                'attribute_item_description' => Purify::clean(json_decode($attribute_list_item)->attribute_item_description),
                'attribute_item_keyword' => Purify::clean(json_decode($attribute_list_item)->attribute_item_keyword),
                'attribute_item_required' => Purify::clean(json_decode($attribute_list_item)->attribute_item_required) ? 1 : 0,
                'attribute_item_type' => Purify::clean(json_decode($attribute_list_item)->attribute_item_type),
                'show_in_table_page' => Purify::clean(json_decode($attribute_list_item)->show_in_table_page) ? 1 : 0,
                'show_in_product_page' => Purify::clean(json_decode($attribute_list_item)->show_in_product_page) ? 1 : 0,
                'disabled_attribute' => Purify::clean(json_decode($attribute_list_item)->disabled_attribute) ? 1 : 0,
                'multiple_selection_attribute' => Purify::clean(json_decode($attribute_list_item)->multiple_selection_attribute) ? 1 : 0,
                'attribute_list_array' => Purify::clean($request->attribute_list_array[$key]),
                'attribute_item_order' => $key + 1,
            ]);

            if(Purify::clean(json_decode($attribute_list_item)->attribute_item_type) == "dropdown") {
                foreach (json_decode($attribute_list_item)->value as $value) {
                    $attribute_item->values()->firstOrCreate([
                        'attribute_item_id' => $attribute_item->id,
                        'value' => $value
                    ]);
                }
            } else {
                $attribute_item->values()->firstOrCreate([
                    'attribute_item_id' => $attribute_item->id,
                    'value' => "دلخواه"
                ]);
            }
        }
        
        return redirect(route('all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت ایجاد گردید.');
    }

    public function DeleteAttribute($id)
    {
        $attribute = Attribute::find(Purify::clean(($id)));
        $attribute->delete();

        return redirect(route('all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت حذف گردید.');
    }

}