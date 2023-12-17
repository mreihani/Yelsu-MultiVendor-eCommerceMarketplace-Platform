<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Models\Freightagetype;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Stevebauman\Purify\Facades\Purify;

class AdminFreightageTypeController extends Controller
{
    public function AllFreightageType(Request $request)
    {
        $adminData = auth()->user();
        $freightage_types = Freightagetype::all();

        return view('admin.backend.freightage_transportation.freightage_loader.freightage_loader_all', compact('freightage_types', 'adminData'));
    }

    public function AddFreightageType() {
        $adminData = auth()->user();
        $freightage_types = Freightagetype::all();

        return view('admin.backend.freightage_transportation.freightage_loader.freightage_loader_add', compact('freightage_types', 'adminData'));
    }

    public function StoreFreightageType(Request $request) {
        $incomingFields = $request->validate([
            'value' => ['required', Rule::unique('freightagetypes', 'value')],
        ], [
            'value.required' => 'لطفا نام روش ارسال کالا را وارد نمایید.',
            'value.unique' => 'نام روش ارسال کالا قبلا ثبت شده است. لطفا یک نام دیگر وارد نمایید.',
        ]);

        Freightagetype::insert([
            'value' => Purify::clean($incomingFields['value']),
            'description' => Purify::clean($request->description) ?: NULL,
            'parent' => Purify::clean($request->parent) == 0 ? 0 : Purify::clean($request->parent),
            'freightagetype_title' => Purify::clean($request->freightagetype_title),
        ]);
       
        return redirect(route('admin.all.freightage-type'))->with('success', 'روش ارسال کالا با موفقیت ایجاد گردید.');
    }

    public function EditFreightageType(Freightagetype $freightagetype) {
        $adminData = auth()->user();
        $freightage_types = Freightagetype::all();
        
        
        return view('admin.backend.freightage_transportation.freightage_loader.freightage_loader_edit', compact('freightage_types', 'adminData', 'freightagetype'));
    }

    public function UpdateFreightageType(Request $request) {

        $id = Purify::clean($request->id);

        $incomingFields = $request->validate([
            'value' => ['required', Rule::unique('freightagetypes', 'value')->ignore($id)],
        ], [
            'value.required' => 'لطفا نام روش ارسال کالا را وارد نمایید.',
            'value.unique' => 'نام روش ارسال کالا قبلا ثبت شده است. لطفا یک نام دیگر وارد نمایید.',
        ]);

        $freightagetype = Freightagetype::find($id);

        $freightagetype->update([
            'value' => Purify::clean($incomingFields['value']),
            'description' => Purify::clean($request->description) ?: NULL,
            'parent' => Purify::clean($request->parent) == 0 ? 0 : Purify::clean($request->parent),
            'freightagetype_title' => Purify::clean($request->freightagetype_title),
        ]);
       
        return redirect(route('admin.all.freightage-type'))->with('success', 'روش ارسال کالا با موفقیت بروز رسانی گردید.');
    }

    public function DeleteFreightageType(Freightagetype $freightagetype) {
        $freightagetype->delete();

        return redirect(route('admin.all.freightage-type'))->with('success', 'روش ارسال کالا با موفقیت حذف گردید.');
    }

}
