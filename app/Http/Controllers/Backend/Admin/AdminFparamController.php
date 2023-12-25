<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Fparam;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Stevebauman\Purify\Facades\Purify;


class AdminFparamController extends Controller
{
    public function AllFreightageParameter(Request $request)
    {
        $adminData = auth()->user();
        $freightage_parameters = Fparam::all();

        return view('admin.backend.freightage_transportation.freightage_parameters.freightage_parameters_all', compact('freightage_parameters', 'adminData'));
    }

    public function AddFreightageParameter() {
        $adminData = auth()->user();

        return view('admin.backend.freightage_transportation.freightage_parameters.freightage_parameters_add', compact('adminData'));
    }

    public function StoreFreightageParameter(Request $request) {
        $incomingFields = $request->validate([
            'title' => ['required', Rule::unique('fparams', 'title')],
            'keyword' => ['required', Rule::unique('fparams', 'keyword')],
            'value' => 'required',
        ], [
            'title.required' => 'لطفا عنوان ضریب حمل کالا را وارد نمایید.',
            'title.unique' => 'عنوان ضریب حمل کالا قبلا ثبت شده است. لطفا یک عنوان دیگر وارد نمایید.',
            'keyword.required' => 'لطفا کلمه کلیدی ضریب حمل کالا را وارد نمایید.',
            'keyword.unique' => 'کلمه کلیدی ضریب حمل کالا قبلا ثبت شده است. لطفا یک عبارت دیگر وارد نمایید.',
            'value.required' => 'لطفا مقدار ضریب را وارد نمایید.'
        ]);

        $fparam = Fparam::create([
            'title' => Purify::clean($incomingFields['title']),
            'keyword' => Purify::clean($incomingFields['keyword']),
            'value' => Purify::clean($incomingFields['value']),
        ]);

        return redirect(route('admin.all.freightage-param'))->with('success', 'ضریب حمل کالا با موفقیت ایجاد گردید.');
    }

    public function EditFreightageParameter(Fparam $fparam) {
        $adminData = auth()->user();

        return view('admin.backend.freightage_transportation.freightage_parameters.freightage_parameters_edit', compact(
            'adminData', 
            'fparam'
        ));
    }

    public function UpdateFreightageParameter(Request $request) {

        $id = Purify::clean($request->id);

        $incomingFields = $request->validate([
            'title' => ['required', Rule::unique('fparams', 'title')->ignore($id)],
            'keyword' => ['required', Rule::unique('fparams', 'keyword')->ignore($id)],
            'value' => 'required',
        ], [
            'title.required' => 'لطفا عنوان ضریب حمل کالا را وارد نمایید.',
            'title.unique' => 'عنوان ضریب حمل کالا قبلا ثبت شده است. لطفا یک عنوان دیگر وارد نمایید.',
            'keyword.required' => 'لطفا کلمه کلیدی ضریب حمل کالا را وارد نمایید.',
            'keyword.unique' => 'کلمه کلیدی ضریب حمل کالا قبلا ثبت شده است. لطفا عبارت دیگری را وارد نمایید.',
            'value.required' => 'لطفا مقدار ضریب را وارد نمایید.'
        ]);

        $fparam = Fparam::find($id);

        $fparam->update([
            'title' => Purify::clean($incomingFields['title']),
            'keyword' => Purify::clean($incomingFields['keyword']),
            'value' => Purify::clean($incomingFields['value']),
        ]);

        return redirect(route('admin.all.freightage-param'))->with('success', 'ضریب حمل کالا با موفقیت بروز رسانی گردید.');
    }

    public function DeleteFreightageParameter(Fparam $fparam) {
        $fparam->delete();

        return redirect(route('admin.all.freightage-param'))->with('success', 'ضریب حمل کالا با موفقیت حذف گردید.');
    }
}
