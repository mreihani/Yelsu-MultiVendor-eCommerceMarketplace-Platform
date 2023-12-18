<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Models\Freightagetype;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Freightageloadertype;
use Stevebauman\Purify\Facades\Purify;

class AdminFreightageLoaderTypeController extends Controller
{
    public function AllFreightageLoaderType(Request $request)
    {
        $adminData = auth()->user();
        $freightage_loader_types = Freightageloadertype::all();

        return view('admin.backend.freightage_transportation.freightage_loader_type.freightage_loader_type_all', compact('freightage_loader_types', 'adminData'));
    }

    public function AddFreightageLoaderType() {
        $adminData = auth()->user();
        $freightage_loader_types = Freightageloadertype::all();
        $freightage_types = Freightagetype::where('parent', 0)->get();
        
        // در صورتی که هیچ روش ارسالی از قبل تعیین نشده باشد باید با دریافت یک خطا به صفحه روش های ارسال بازگشت داده شود
        if(!count($freightage_types)) {
            return redirect(route('admin.all.freightage-type'))->with('error', 'باید قبل از تعیین نوع بارگیر حداقل یک روش ارسال اصلی ایجاد نمایید.');
        }

        return view('admin.backend.freightage_transportation.freightage_loader_type.freightage_loader_type_add', compact('freightage_types', 'adminData', 'freightage_loader_types'));
    }

    public function StoreFreightageLoaderType(Request $request) {
        $incomingFields = $request->validate([
            'value' => 'required',
            'description' => 'required',
        ], [
            'value.required' => 'لطفا نام بارگیر را وارد نمایید.',
            'value.unique' => 'نام بارگیر قبلا ثبت شده است. لطفا یک نام دیگر وارد نمایید.',
            'description.required' => 'نام کامل بارگیر را وارد نمایید.',
        ]);

        Freightageloadertype::insert([
            'value' => Purify::clean($incomingFields['value']),
            'description' => Purify::clean($incomingFields['description']) ?: NULL,
            'parent' => Purify::clean($request->parent) == 0 ? 0 : Purify::clean($request->parent),
            'min_capacity' => Purify::clean($request->min_capacity) ?: NULL,
            'max_capacity' => Purify::clean($request->max_capacity) ?: NULL,
            'length' => Purify::clean($request->length) ?: NULL,
            'width' => Purify::clean($request->width) ?: NULL,
            'height' => Purify::clean($request->height) ?: NULL,
            'min_volume' => Purify::clean($request->min_volume) ?: NULL,
            'max_volume' => Purify::clean($request->max_volume) ?: NULL,
            'freight_per_ton_intracity' => Purify::clean($request->freight_per_ton_intracity) ?: NULL,
            'freight_per_ton_intercity' => Purify::clean($request->freight_per_ton_intercity) ?: NULL,
            'blog_link' => Purify::clean($request->blog_link) ?: NULL,
            'freightagetype_id' => Purify::clean($request->freightagetype_id) ?: NULL,
            'last_child' => Purify::clean($request->last_child) == "on" ? 1 : 0,
            'freight_per_ton_currency' => Purify::clean($request->freight_per_ton_currency),
            'freight_per_ton_rail' => Purify::clean($request->freight_per_ton_rail) ?: NULL,
            'freight_per_ton_sea' => Purify::clean($request->freight_per_ton_sea) ?: NULL,
            'freight_per_kg_air' => Purify::clean($request->freight_per_kg_air) ?: NULL,
            'freight_per_kg_post' => Purify::clean($request->freight_per_kg_post) ?: NULL,
            'clearance_per_ton_rail' => Purify::clean($request->clearance_per_ton_rail) ?: NULL,
            'clearance_per_ton_sea' => Purify::clean($request->clearance_per_ton_sea) ?: NULL,
            'clearance_per_kg_air' => Purify::clean($request->clearance_per_kg_air) ?: NULL,
            'clearance_per_kg_post' => Purify::clean($request->clearance_per_kg_post) ?: NULL,
        ]);
       
        return redirect(route('admin.all.freightage-loader-type'))->with('success', 'بارگیر با موفقیت ایجاد گردید.');
    }

    public function EditFreightageLoaderType(Freightageloadertype $freightageLoadertype) {
        $adminData = auth()->user();
        $freightage_loader_types = $freightageLoadertype->freightageType->freightageLoaderType;
       
        $freightage_types = Freightagetype::where('parent', 0)->get();
        
        // در صورتی که هیچ روش ارسالی از قبل تعیین نشده باشد باید با دریافت یک خطا به صفحه روش های ارسال بازگشت داده شود
        if(!count($freightage_types)) {
            return redirect(route('admin.all.freightage-type'))->with('error', 'باید قبل از تعیین نوع بارگیر حداقل یک روش ارسال اصلی ایجاد نمایید.');
        }
        
        return view('admin.backend.freightage_transportation.freightage_loader_type.freightage_loader_type_edit', compact(
            'freightage_types', 
            'adminData', 
            'freightageLoadertype',
            'freightage_loader_types'
        ));
    }

    public function UpdateFreightageLoaderType(Request $request) {
        
        $id = Purify::clean($request->id);

        $incomingFields = $request->validate([
            'value' => 'required',
            'description' => 'required',
        ], [
            'value.required' => 'لطفا نام بارگیر را وارد نمایید.',
            'value.unique' => 'نام بارگیر قبلا ثبت شده است. لطفا یک نام دیگر وارد نمایید.',
            'description.required' => 'نام کامل بارگیر را وارد نمایید.',
        ]);

        $freightageLoadertype = Freightageloadertype::find($id);

        $freightageLoadertype->update([
            'value' => Purify::clean($incomingFields['value']),
            'description' => Purify::clean($incomingFields['description']) ?: NULL,
            'parent' => Purify::clean($request->parent) == 0 ? 0 : Purify::clean($request->parent),
            'min_capacity' => Purify::clean($request->min_capacity) ?: NULL,
            'max_capacity' => Purify::clean($request->max_capacity) ?: NULL,
            'length' => Purify::clean($request->length) ?: NULL,
            'width' => Purify::clean($request->width) ?: NULL,
            'height' => Purify::clean($request->height) ?: NULL,
            'min_volume' => Purify::clean($request->min_volume) ?: NULL,
            'max_volume' => Purify::clean($request->max_volume) ?: NULL,
            'freight_per_ton_intracity' => Purify::clean($request->freight_per_ton_intracity) ?: NULL,
            'freight_per_ton_intercity' => Purify::clean($request->freight_per_ton_intercity) ?: NULL,
            'blog_link' => Purify::clean($request->blog_link) ?: NULL,
            'freightagetype_id' => Purify::clean($request->freightagetype_id) ?: NULL,
            'last_child' => Purify::clean($request->last_child) == "on" ? 1 : 0,
            'freight_per_ton_currency' => Purify::clean($request->freight_per_ton_currency),
            'freight_per_ton_rail' => Purify::clean($request->freight_per_ton_rail) ?: NULL,
            'freight_per_ton_sea' => Purify::clean($request->freight_per_ton_sea) ?: NULL,
            'freight_per_kg_air' => Purify::clean($request->freight_per_kg_air) ?: NULL,
            'freight_per_kg_post' => Purify::clean($request->freight_per_kg_post) ?: NULL,
            'clearance_per_ton_rail' => Purify::clean($request->clearance_per_ton_rail) ?: NULL,
            'clearance_per_ton_sea' => Purify::clean($request->clearance_per_ton_sea) ?: NULL,
            'clearance_per_kg_air' => Purify::clean($request->clearance_per_kg_air) ?: NULL,
            'clearance_per_kg_post' => Purify::clean($request->clearance_per_kg_post) ?: NULL,
        ]);
       
        return redirect(route('admin.all.freightage-loader-type'))->with('success', 'بارگیر با موفقیت بروز رسانی گردید.');
    }

    public function DeleteFreightageLoaderType(Freightageloadertype $freightageLoadertype) {
        $freightageLoadertype->delete();

        return redirect(route('admin.all.freightage-loader-type'))->with('success', 'بارگیر با موفقیت حذف گردید.');
    }

    public function GetFreightageLoaderAjaxAll(Request $request) {
        $freightagetype_id = $request->freightagetype_id;
        $freightagetype = Freightagetype::find($freightagetype_id);
        $freightageLoaderTypes = $freightagetype->freightageLoaderType;

        return $freightageLoaderTypes;
    }

}
