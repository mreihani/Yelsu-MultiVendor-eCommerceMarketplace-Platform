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
        $attributes = Attribute::get();

        return view('specialist.attribute.attribute_all', compact('specialistData', 'attributes'));
    }

    public function AddAttribute()
    {
        $specialistData = auth()->user();

        // category for filter
        $parentCategories = $specialistData->specialist_category;
        $all_children = Category::find($parentCategories->id)->child;
        $filter_category_array[] = array($parentCategories, $all_children);
        // category for filter

        return view('specialist.attribute.attribute_add', compact('specialistData', 'parentCategories', 'filter_category_array'));
    }

    public function StoreAttribute(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'role' => ['required', 'array'],
            'category_id' => ['required', 'array'],
            'attribute_type' => 'required',
        ], [
            'name.required' => 'لطفا نام ویژگی را وارد نمایید.',
            'description.required' => 'لطفا توضیحات ویژگی را وارد نمایید.',
            'role.required' => 'لطفا حساب کاربری مرتبط با ویژگی را انتخاب نمایید.',
            'role.array' => 'لطفا حساب کاربری صحیح را وارد نمایید.',
            'category_id.required' => 'لطفا زمینه فعالیت مرتبط با حساب کاربری را انتخاب نمایید.',
            'category_id.array' => 'لطفا زمینه فعالیت صحیح را وارد نمایید.',
            'attribute_type.required' => 'لطفا نوع ویژگی را وارد نمایید.',
        ]);

        if($request->kt_docs_repeater_basic[0]["value"] == null && $request->attribute_type == "dropdown") {
            return back()->with('error','لطفا مشخصات یا جزئیات ویژگی مورد نظر را وارد نمایید.')->withInput();
        }
        
        $attribute = Attribute::firstOrCreate([
            'name' => Purify::clean($incomingFields['name']),
            'description' => Purify::clean($incomingFields['description']),
            'required' => Purify::clean($request->required) == "on" ? "true" : "false",
            'role' => implode(',', Purify::clean($incomingFields['role'])),
            'category_id' => implode(',', Purify::clean($incomingFields['category_id'])),
            'attribute_type' =>  Purify::clean($incomingFields['attribute_type']),
        ]);

        if($incomingFields['attribute_type'] == "dropdown") {
            foreach ($request->kt_docs_repeater_basic as $value) {
                $attribute->values()->firstOrCreate([
                    'value' => Purify::clean($value['value'])
                ]);
            }
        } else {
            $attribute->values()->firstOrCreate([
                'value' => "دلخواه"
            ]);
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
        // category for filter

        return view('specialist.attribute.attribute_edit', compact('specialistData', 'parentCategories', 'attribute', 'filter_category_array'));
    }

    public function UpdateAttribute(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'role' => ['required', 'array'],
            'category_id' => ['required', 'array'],
        ], [
            'name.required' => 'لطفا نام ویژگی را وارد نمایید.',
            'description.required' => 'لطفا توضیحات ویژگی را وارد نمایید.',
            'role.required' => 'لطفا حساب کاربری مرتبط با ویژگی را انتخاب نمایید.',
            'role.array' => 'لطفا حساب کاربری صحیح را وارد نمایید.',
            'category_id.required' => 'لطفا زمینه فعالیت مرتبط با حساب کاربری را انتخاب نمایید.',
            'category_id.array' => 'لطفا زمینه فعالیت صحیح را وارد نمایید.',
        ]);

        $attribute = Attribute::find(Purify::clean(($request->id)));

        $attribute->update([
            'name' => Purify::clean($incomingFields['name']),
            'description' => Purify::clean($incomingFields['description']),
            'required' => Purify::clean($request->required) == "on" ? "true" : "false",
            'role' => implode(',', Purify::clean($incomingFields['role'])),
            'category_id' => implode(',', Purify::clean($incomingFields['category_id'])),
        ]);

        $attribute->values()->delete();

        if($attribute->attribute_type == "dropdown") {
            foreach ($request->kt_docs_repeater_basic as $value) {
                $attribute->values()->firstOrCreate([
                    'value' => Purify::clean($value['value'])
                ]);
            }
        } else {
            $attribute->values()->firstOrCreate([
                'value' => "دلخواه"
            ]);
        }

        return redirect(route('specialist.all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت بروزرسانی گردید.');
    }

    public function DeleteAttribute($id)
    {
        $attribute = Attribute::find(Purify::clean(($id)));
        $attribute->delete();

        return redirect(route('specialist.all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت حذف گردید.');
    }
}