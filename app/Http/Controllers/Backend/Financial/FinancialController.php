<?php

namespace App\Http\Controllers\Backend\Financial;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

use App\Http\Controllers\Controller;

class FinancialController extends Controller
{
    public function FinancialDashboard()
    {
        $id = Auth::user()->id;
        $financialData = User::find($id);

        return view('financial.index', compact('financialData'));
    } //End method

    public function FinancialDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    } //End method

    public function FinancialProfile()
    {
        $id = Auth::user()->id;
        $financialData = User::find($id);

        return view('financial.financial_profile_view', compact('financialData'));
    } //End method

    public function FinancialProfileSettings()
    {
        $id = Auth::user()->id;
        $financialData = User::find($id);

        return view('financial.financial_profile_settings', compact('financialData'));
    } //End method

    public function FinancialProfileStore(Request $request)
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

        if ($incomingFields['firstname']) {
            $data->firstname = Purify::clean($incomingFields['firstname']);
        }

        if ($incomingFields['lastname']) {
            $data->lastname = Purify::clean($incomingFields['lastname']);
        }

        if (Purify::clean($request->photo)) {
            $file = Purify::clean($request->photo);

            if ($data->photo != NULL) {
                unlink('storage/upload/financial_images/' . $data->photo);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(160)->encode('jpg')->save('storage/upload/financial_images/' . $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');

    } //End method

    public function FinancialUpdatePassword(Request $request)
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
}