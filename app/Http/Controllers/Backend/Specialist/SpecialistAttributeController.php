<?php

namespace App\Http\Controllers\Backend\Specialist;

use App\Models\Attribute;
use App\Models\User;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class SpecialistAttributeController extends Controller
{
    public function AllAttribute()
    {
        $specialistData = auth()->user();
        $rawAttributes = Attribute::get();

        $attributes = [];
        foreach ($rawAttributes as $attribute) {
            $root_category_id = Category::findRootCategory($attribute->category_id)->id;
            if($specialistData->specialist_category_id == $root_category_id) {
                $attributes[] = $attribute;
            }
        }
        
        return view('specialist.attribute.attribute_all', compact('specialistData', 'attributes'));
    }

    public function AddAttribute()
    {
        $specialistData = auth()->user();

        // category for filter
        $parentCategories = $specialistData->specialist_category;
        $all_children = Category::find($parentCategories->id)->child;
        $filter_category_array[] = array($parentCategories, $all_children);

        return view('specialist.attribute.attribute_add', compact('specialistData', 'parentCategories', 'filter_category_array'));
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
                'attribute_item_name' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_name),
                'attribute_item_description' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_description),
                'attribute_item_required' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_required) ? 1 : 0,
                'attribute_item_type' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_type),
                'show_in_table_page' => Purify::clean(json_decode($attribute_list_item)[0]->show_in_table_page) ? 1 : 0,
                'show_in_product_page' => Purify::clean(json_decode($attribute_list_item)[0]->show_in_product_page) ? 1 : 0,
                'disabled_attribute' => Purify::clean(json_decode($attribute_list_item)[0]->disabled_attribute) ? 1 : 0,
                'multiple_selection_attribute' => Purify::clean(json_decode($attribute_list_item)[0]->multiple_selection_attribute) ? 1 : 0,
                'attribute_list_array' => Purify::clean($request->attribute_list_array[$key])
            ]);

            if(Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_type) == "dropdown") {
                foreach (json_decode($attribute_list_item)[0]->value as $value) {
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

        return redirect(route('specialist.all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت ایجاد گردید.');
    }

    public function EditAttribute($id)
    {
        $specialistData = auth()->user();
        $parentCategories = Category::where('parent', 0)->get();
        $attribute = Attribute::find(Purify::clean($id));

        // category for filter
        $parentCategories = $specialistData->specialist_category;
        $all_children = Category::find($parentCategories->id)->child;
        $filter_category_array[] = array($parentCategories, $all_children);

        // عدم دسترسی به ویژگی غیر مرتبط با کارشناس غیر مرتبط
        $root_category_id = Category::findRootCategory($attribute->category_id)->id;
        if($specialistData->specialist_category_id != $root_category_id) {
            return redirect(route('specialist.all.attribute'))->with('error', 'ویژگی مورد نظر یافت نشد.');
        }

        return view('specialist.attribute.attribute_edit', compact('specialistData', 'parentCategories', 'attribute', 'filter_category_array'));
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

        $attribute->items()->delete();

        foreach ($incomingFields['attribute_list_array'] as $key => $attribute_list_item) {
            $attribute_item = $attribute->items()->create([
                'attribute_id' => $attribute->id,
                'attribute_item_name' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_name),
                'attribute_item_description' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_description),
                'attribute_item_required' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_required) ? 1 : 0,
                'attribute_item_type' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_type),
                'show_in_table_page' => Purify::clean(json_decode($attribute_list_item)[0]->show_in_table_page) ? 1 : 0,
                'show_in_product_page' => Purify::clean(json_decode($attribute_list_item)[0]->show_in_product_page) ? 1 : 0,
                'disabled_attribute' => Purify::clean(json_decode($attribute_list_item)[0]->disabled_attribute) ? 1 : 0,
                'multiple_selection_attribute' => Purify::clean(json_decode($attribute_list_item)[0]->multiple_selection_attribute) ? 1 : 0,
                'attribute_list_array' => Purify::clean($request->attribute_list_array[$key])
            ]);

            if(Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_type) == "dropdown") {
                foreach (json_decode($attribute_list_item)[0]->value as $value) {
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

        return redirect(route('specialist.all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت بروزرسانی گردید.');
    }

    public function CopyAttribute($id) {
        $specialistData = auth()->user();
        $parentCategories = Category::where('parent', 0)->get();
        $attribute = Attribute::find(Purify::clean($id));

        // category for filter
        $parentCategories = $specialistData->specialist_category;
        $all_children = Category::find($parentCategories->id)->child;
        $filter_category_array[] = array($parentCategories, $all_children);

        // عدم دسترسی به ویژگی غیر مرتبط با کارشناس غیر مرتبط
        $root_category_id = Category::findRootCategory($attribute->category_id)->id;
        if($specialistData->specialist_category_id != $root_category_id) {
            return redirect(route('specialist.all.attribute'))->with('error', 'ویژگی مورد نظر یافت نشد.');
        }
        return view('specialist.attribute.attribute_copy', compact('specialistData', 'parentCategories', 'attribute', 'filter_category_array'));
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
                'attribute_item_name' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_name),
                'attribute_item_description' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_description),
                'attribute_item_required' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_required) ? 1 : 0,
                'attribute_item_type' => Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_type),
                'show_in_table_page' => Purify::clean(json_decode($attribute_list_item)[0]->show_in_table_page) ? 1 : 0,
                'show_in_product_page' => Purify::clean(json_decode($attribute_list_item)[0]->show_in_product_page) ? 1 : 0,
                'disabled_attribute' => Purify::clean(json_decode($attribute_list_item)[0]->disabled_attribute) ? 1 : 0,
                'multiple_selection_attribute' => Purify::clean(json_decode($attribute_list_item)[0]->multiple_selection_attribute) ? 1 : 0,
                'attribute_list_array' => Purify::clean($request->attribute_list_array[$key])
            ]);

            if(Purify::clean(json_decode($attribute_list_item)[0]->attribute_item_type) == "dropdown") {
                foreach (json_decode($attribute_list_item)[0]->value as $value) {
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

        return redirect(route('specialist.all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت ایجاد گردید.');
    }

    public function DeleteAttribute($id)
    {
        $attribute = Attribute::find(Purify::clean(($id)));
        $attribute->delete();

        return redirect(route('specialist.all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت حذف گردید.');
    }
}