<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Attribute;
use App\Models\User;

use App\Models\Category;
use Illuminate\Http\Request;
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

        return view('admin.backend.attribute.attribute_add', compact('adminData', 'parentCategories'));
    }

    public function StoreAttribute(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'kt_docs_repeater_basic' => ['required', 'array'],
            'role' => ['required', 'array'],
            'category_id' => ['required', 'array'],
        ], [
            'name.required' => 'لطفا نام ویژگی را وارد نمایید.',
            'description.required' => 'لطفا توضیحات ویژگی را وارد نمایید.',
            'kt_docs_repeater_basic.required' => 'لطفا مشخصات یا جزئیات ویژگی مورد نظر را وارد نمایید.',
            'kt_docs_repeater_basic.array' => 'لطفا مشخصات صحیح ویژگی را وارد نمایید.',
            'role.required' => 'لطفا حساب کاربری مرتبط با ویژگی را انتخاب نمایید.',
            'role.array' => 'لطفا حساب کاربری صحیح را وارد نمایید.',
            'category_id.required' => 'لطفا زمینه فعالیت مرتبط با حساب کاربری را انتخاب نمایید.',
            'category_id.array' => 'لطفا زمینه فعالیت صحیح را وارد نمایید.',
        ]);

        $attribute = Attribute::firstOrCreate([
            'name' => Purify::clean($incomingFields['name']),
            'description' => Purify::clean($incomingFields['description']),
            'required' => Purify::clean($request->required) == "on" ? "true" : "false",
            'role' => implode(',', Purify::clean($incomingFields['role'])),
            'category_id' => implode(',', Purify::clean($incomingFields['category_id'])),
        ]);

        foreach ($incomingFields['kt_docs_repeater_basic'] as $value) {
            $attribute->values()->firstOrCreate([
                'value' => Purify::clean($value['value'])
            ]);
        }

        return redirect(route('all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت ایجاد گردید.');
    }

    public function EditAttribute($id)
    {
        $adminData = auth()->user();
        $parentCategories = Category::where('parent', 0)->get();
        $attribute = Attribute::find(Purify::clean($id));

        return view('admin.backend.attribute.attribute_edit', compact('adminData', 'parentCategories', 'attribute'));
    }

    public function UpdateAttribute(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required'], 
            'description' => ['required'],
            'kt_docs_repeater_basic' => ['required', 'array'],
            'role' => ['required', 'array'],
            'category_id' => ['required', 'array'],
        ], [
            'name.required' => 'لطفا نام ویژگی را وارد نمایید.',
            'name.unique' => 'نام ویژگی قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
            'description.required' => 'لطفا توضیحات ویژگی را وارد نمایید.',
            'kt_docs_repeater_basic.required' => 'لطفا مشخصات یا جزئیات ویژگی مورد نظر را وارد نمایید.',
            'kt_docs_repeater_basic.array' => 'لطفا مشخصات صحیح ویژگی را وارد نمایید.',
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

        foreach ($incomingFields['kt_docs_repeater_basic'] as $value) {
            $attribute->values()->firstOrCreate([
                'value' => Purify::clean($value['value'])
            ]);
        }

        return redirect(route('all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت بروزرسانی گردید.');
    }

    public function DeleteAttribute($id)
    {
        $attribute = Attribute::find(Purify::clean(($id)));
        $attribute->delete();

        return redirect(route('all.attribute'))->with('success', 'ویژگی مورد نظر با موفقیت حذف گردید.');
    }

}