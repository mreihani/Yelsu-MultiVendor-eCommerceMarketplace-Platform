<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Models\Freightagetype;
use Illuminate\Validation\Rule;
use App\Models\Freightagevehicle;
use App\Http\Controllers\Controller;
use App\Models\Freightageloadertype;
use Stevebauman\Purify\Facades\Purify;

class AdminFreightageVehicleController extends Controller
{
    public function AllFreightageVehicle(Request $request)
    {
        $adminData = auth()->user();
        $freightage_vehicles = Freightagevehicle::all();

        return view('admin.backend.freightage_transportation.freightage_vehicle.freightage_vehicle_all', compact('freightage_vehicles', 'adminData'));
    }

    public function AddFreightageVehicle() {
        $adminData = auth()->user();

        // در صورتی که هیچ وسیله حملی از قبل تعیین نشده باشد باید با دریافت یک خطا به صفحه بارگیر بازگشت داده شود
        $freightage_loader_types = Freightageloadertype::all();
        if(!count($freightage_loader_types)) {
            return redirect(route('admin.all.freightage-loader-type'))->with('error', 'باید قبل از تعیین وسیله حمل کالا حداقل یک نوع بارگیر ایجاد نمایید.');
        }

        $freightage_types = Freightagetype::where("parent", 0)->get();
        
        return view('admin.backend.freightage_transportation.freightage_vehicle.freightage_vehicle_add', compact('freightage_types', 'adminData'));
    }

    public function StoreFreightageVehicle(Request $request) {
        $incomingFields = $request->validate([
            'value' => ['required', Rule::unique('freightagevehicles', 'value')],
            'freightageloadertype_id' => 'required',
        ], [
            'value.required' => 'لطفا نام وسیله حمل کالا را وارد نمایید.',
            'value.unique' => 'نام وسیله حمل کالا قبلا ثبت شده است. لطفا یک نام دیگر وارد نمایید.',
            'freightageloadertype_id.required' => 'لطفا نوع بارگیر را مشخص نمایید.'
        ]);

        Freightagevehicle::insert([
            'value' => Purify::clean($incomingFields['value']),
            'description' => Purify::clean($request->description) ?: NULL,
            'freightageloadertype_id' => Purify::clean($incomingFields['freightageloadertype_id']),
        ]);
       
        return redirect(route('admin.all.freightage-vehicle'))->with('success', 'وسیله حمل کالا با موفقیت ایجاد گردید.');
    }

    public function EditFreightageVehicle(Freightagevehicle $freightagevehicle) {
        $adminData = auth()->user();

        // در صورتی که هیچ وسیله حملی از قبل تعیین نشده باشد باید با دریافت یک خطا به صفحه بارگیر بازگشت داده شود
        $freightage_loader_types = Freightageloadertype::all();
        if(!count($freightage_loader_types)) {
            return redirect(route('admin.all.freightage-loader-type'))->with('error', 'باید قبل از تعیین وسیله حمل کالا حداقل یک نوع بارگیر ایجاد نمایید.');
        }

        $freightage_types = Freightagetype::where("parent", 0)->get();
        
        return view('admin.backend.freightage_transportation.freightage_vehicle.freightage_vehicle_edit', compact(
            'freightage_types',
            'adminData', 
            'freightagevehicle'
        ));
    }

    public function UpdateFreightageVehicle(Request $request) {

        $id = Purify::clean($request->id);

        $incomingFields = $request->validate([
            'value' => ['required', Rule::unique('freightagevehicles', 'value')->ignore($id)],
            'freightageloadertype_id' => 'required',
        ], [
            'value.required' => 'لطفا نام وسیله حمل کالا را وارد نمایید.',
            'value.unique' => 'نام وسیله حمل کالا قبلا ثبت شده است. لطفا یک نام دیگر وارد نمایید.',
            'freightageloadertype_id.required' => 'لطفا نوع بارگیر را مشخص نمایید.'
        ]);

        $freightagevehicle = Freightagevehicle::find($id);

        $freightagevehicle->update([
            'value' => Purify::clean($incomingFields['value']),
            'description' => Purify::clean($request->description) ?: NULL,
            'freightageloadertype_id' => Purify::clean($incomingFields['freightageloadertype_id']),
        ]);
       
        return redirect(route('admin.all.freightage-vehicle'))->with('success', 'وسیله حمل کالا با موفقیت بروز رسانی گردید.');
    }

    public function DeleteFreightageVehicle(Freightagevehicle $freightagevehicle) {
        $freightagevehicle->delete();

        return redirect(route('admin.all.freightage-vehicle'))->with('success', 'وسیله حمل کالا با موفقیت حذف گردید.');
    }

    public function GetFreightageLoaderAjax(Request $request) {
        $freightagetype_id = $request->freightagetype_id;
        $freightagetype = Freightagetype::find($freightagetype_id);
        $freightageLoaderTypes = $freightagetype->freightageLoaderTypeLastItems();

        return $freightageLoaderTypes;
    }

}
