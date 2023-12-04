<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\ActiveCode;
use App\Models\Useroutlets;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Http;
use Stevebauman\Purify\Facades\Purify;
use App\Notifications\ActiveCodeNotification;

class UserController extends Controller
{
    public function UserDashboard()
    {
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);
        $request_type = Purify::clean(request('type'));

        $orders = Order::orderBy('id', 'DESC')->where('user_id', $user_id)->where('status', '=', 'paid')->orWhere('status', '=', 'preparation')->orWhere('status', '=', 'posted')->orWhere('status', '=', 'received')->get();

        return view('frontend.dashboard.dashboard', compact('userData', 'orders', 'request_type'));
    } //End method

    public function OrderView($id)
    {
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);
        $order = Order::findOrFail(Purify::clean($id));
        $useroutlet = Useroutlets::where('user_id', $user_id)->latest()->get();

        if ($order->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'سفارش یافت نشد.');
        }

        return view('frontend.dashboard.orderview', compact('userData', 'order', 'useroutlet'));
    }

    public function OrderViewChangeAddress(Request $request)
    {
        $incomingFields = $request->validate([
            'shipment' => 'required',
        ], [
            'shipment.required' => 'لطفا یک آدرس از لیست انتخاب نمایید.',
        ]);

        $order_id = (int) Purify::clean($request->order_id);
        $order_obj = Order::find($order_id);
        
        $useroutlet_id = (int) Purify::clean($incomingFields['shipment']);
        $useroutlet_obj = Useroutlets::find($useroutlet_id);

        if($useroutlet_obj) {
            $order_obj->update([
                'useroutlet_id' => $useroutlet_id,
                'order_shipping_location_name' => $useroutlet_obj->name,
                'order_shipping_country' => $useroutlet_obj->country,
                'order_shipping_province' => $useroutlet_obj->province,
                'order_shipping_city' => $useroutlet_obj->city,
                'order_shipping_address' => $useroutlet_obj->address,
                'order_shipping_postalcode' => $useroutlet_obj->postalcode,
                'order_shipping_phone' => $useroutlet_obj->phone,
                'order_shipping_fax' => $useroutlet_obj->fax,
                'order_shipping_latitude' => $useroutlet_obj->latitude,
                'order_shipping_longitude' => $useroutlet_obj->longitude,
            ]);
        }

        return back()->with('success', 'آدرس سفارش با موفقیت تغییر یافت.');
    }

    public function UserProfileStore(Request $request)
    {
        //Validation
        $incomingFields = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => ['required', Rule::unique('users', 'username')->ignore(Auth::user()->id)],
            'home_phone' => Purify::clean($request->home_phone) == '' ? '' : [env('IRANIAN_PHONE_REGEX')]
        ], [
            'firstname.required' => 'لطفا نام خود را وارد نمایید.',
            'lastname.required' => 'لطفا نام خانوادگی خود را وارد نمایید.',
            'username.required' => 'لطفا نام کاربری خود را وارد نمایید.',
            'username.unique' => 'نام کاربری مورد نظر شما قبلا ثبت شده است. لطفا یک نام کاربری دیگر وارد کنید.',
            'home_phone.regex' => 'لطفا شماره تلفن صحیح وارد نمایید.',
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->firstname = Purify::clean($incomingFields['firstname']);
        $data->lastname = Purify::clean($incomingFields['lastname']);
        $data->username = Purify::clean($incomingFields['username']);


        if (Purify::clean($request->twoStepAuth) == 'on' && Purify::clean($request->home_phone) == NULL) {
            $data->twoStepAuth = "inactive";
            return redirect(route('dashboard', ['type' => 'details']))->with('error', 'برای فعال سازی ورود دو مرحله ای ابتدا باید شماره تلفن خود را تایید و ذخیره کنید.');
        }

        if (Purify::clean($request->twoStepAuth) == NULL && Purify::clean($request->home_phone) != NULL) {
            $data->twoStepAuth = "inactive";
        }

        if (Purify::clean($request->twoStepAuth) == 'on' && $data->home_phone != NULL) {
            $data->twoStepAuth = "active";
        }

        if (Purify::clean($request->twoStepAuth) == 'on') {
            $request->session()->flash('twoStepAuth', "on");
        } else {
            $request->session()->flash('twoStepAuth', "off");
        }

        $data->save();

        if (($data->home_phone !== Purify::clean($request->home_phone) && Purify::clean($request->home_phone) !== NULL) || 
            ($data->home_phone == Purify::clean($request->home_phone) && Purify::clean($request->home_phone) !== NULL && !$data->phone_verified)){

            $request->session()->flash('home_phone', Purify::clean($request->home_phone));
            $code = ActiveCode::generateCode(Auth::user());

            $request->user()->notify(new ActiveCodeNotification($code, Purify::clean($request->home_phone)));

            return redirect(route('profile.2fa.phone'));
        }

        return redirect(route('dashboard', ['type' => 'details']))->with('success', 'اطلاعات با موفقیت ذخیره شد.');

    } //End method

    public function phoneVerifyResend(Request $request)
    {
        $request->session()->reflash();
        $home_phone = Purify::clean($request->session()->get('home_phone'));

        $code = ActiveCode::generateCode(Auth::user());
        Auth::user()->notify(new ActiveCodeNotification($code, $home_phone));

        return view('frontend.phone-verify', compact('home_phone'));
    }

    public function UserProfileStorePassword(Request $request)
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

        //Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make(($incomingFields['new_password']))
        ]);

        return redirect(route('dashboard', ['type' => 'details']))->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    } //End method

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //End method

    public function DashboardAddressAdd()
    {
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        $latitudeVal = NULL;
        $longitudeVal = NULL;

        return view('frontend.dashboard.myaccount_address_add', compact('userData', 'latitudeVal', 'longitudeVal'));
    } //End method

    public function DashboardAddressStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $incomingFields = $request->validate([
            'name' => 'required',
            'country' => 'required',
            'province' => 'required',
            'city' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'name.required' => 'لطفا عنوان محل مورد نظر را وارد نمایید.',
            'country.required' => 'لطفا کشور محل مورد نظر را وارد نمایید.',
            'province.required' => 'لطفا استان محل مورد نظر را وارد نمایید.',
            'city.required' => 'لطفا شهر محل مورد نظر راوارد نمایید.',
            'address.required' => 'لطفا آدرس محل مورد نظر را وارد نمایید.',
            'latitude.required' => 'لطفا عرض جغرافیایی محل مورد نظر را وارد نمایید.',
            'longitude.required' => 'لطفا طول جغرافیایی محل مورد نظر را وارد نمایید.',
        ]);

        Useroutlets::insert([
            'country' => Purify::clean($incomingFields['country']),
            'city' => Purify::clean($incomingFields['city']),
            'province' => Purify::clean($incomingFields['province']),
            'name' => Purify::clean($incomingFields['name']),
            'address' => Purify::clean($incomingFields['address']),
            'latitude' => Purify::clean($incomingFields['latitude']),
            'longitude' => Purify::clean($incomingFields['longitude']),
            'postalcode' => Purify::clean($request->postalcode) ? Purify::clean($request->postalcode) : NULL,
            'user_id' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect(route('dashboard', ['type' => 'addresses']))->with('success', 'آدرس مورد نظر با موفقیت ذخیره شد.');
    }
    public function DashboardAddressEdit($id)
    {
        $useroutlet = Useroutlets::find(Purify::clean($id));
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        $latitudeVal = $useroutlet->latitude;
        $longitudeVal = $useroutlet->longitude;

        if ($useroutlet->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'صفحه مورد نظر یافت نشد!');
        }

        return view('frontend.dashboard.myaccount_address_edit', compact('userData', 'latitudeVal', 'longitudeVal', 'useroutlet'));
    } //End method

    public function DashboardAddressUpdate(Request $request)
    {
        $user_id = Auth::user()->id;
        $useroutlet = Useroutlets::find(Purify::clean($request->id));

        $incomingFields = $request->validate([
            'name' => 'required',
            'country' => 'required',
            'province' => 'required',
            'city' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'name.required' => 'لطفا عنوان محل مورد نظر را وارد نمایید.',
            'country.required' => 'لطفا کشور محل مورد نظر را وارد نمایید.',
            'province.required' => 'لطفا استان محل مورد نظر را وارد نمایید.',
            'city.required' => 'لطفا شهر محل مورد نظر راوارد نمایید.',
            'address.required' => 'لطفا آدرس محل مورد نظر را وارد نمایید.',
            'latitude.required' => 'لطفا عرض جغرافیایی محل مورد نظر را وارد نمایید.',
            'longitude.required' => 'لطفا طول جغرافیایی محل مورد نظر را وارد نمایید.',
        ]);

        if ($useroutlet->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'شما اجازه انجام این کار را ندارید!.');
        }

        $useroutlet->update([
            'country' => Purify::clean($incomingFields['country']),
            'city' => Purify::clean($incomingFields['city']),
            'province' => Purify::clean($incomingFields['province']),
            'name' => Purify::clean($incomingFields['name']),
            'address' => Purify::clean($incomingFields['address']),
            'latitude' => Purify::clean($incomingFields['latitude']),
            'longitude' => Purify::clean($incomingFields['longitude']),
            'postalcode' => $request->postalcode ? Purify::clean($request->postalcode) : NULL,
            'user_id' => $user_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect(route('dashboard', ['type' => 'addresses']))->with('success', 'آدرس مورد نظر با موفقیت به روزرسانی شد.');
    }

    public function DashboardAddressDelete($id)
    {
        $user_id = Auth::user()->id;
        $useroutlet = Useroutlets::find(Purify::clean($id));

        if ($useroutlet->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'شما اجازه انجام این کار را ندارید!.');
        }

        $useroutlet->delete();

        return redirect(route('dashboard', ['type' => 'addresses']))->with('success', 'آدرس مورد نظر با موفقیت به حذف گردید.');
    } //End method

    public function getPhoneVerify(Request $request)
    {
        if (! Purify::clean($request->session()->has('home_phone'))) {
            return redirect(route('dashboard'));
        }

        $request->session()->reflash();

        $home_phone = $request->session()->get('home_phone');

        return view('frontend.phone-verify', compact('home_phone'));
    }

    public function postPhoneVerify(Request $request)
    {

        $user = Auth::user();

        $code_1 = Purify::clean($request->code_1);
        $code_2 = Purify::clean($request->code_2);
        $code_3 = Purify::clean($request->code_3);
        $code_4 = Purify::clean($request->code_4);
        $code_5 = Purify::clean($request->code_5);

        if ($code_1 == NULL || $code_2 == NULL || $code_3 == NULL || $code_4 == NULL || $code_5 == NULL) {
            $request->session()->reflash();
            return redirect(route('profile.2fa.phone'))->with('error', 'لطفا کد امنیتی را به درستی وارد نمایید.');
        }

        $verification_code = $code_1 . $code_2 . $code_3 . $code_4 . $code_5;
        $verification_code = (int) $verification_code;

        if (! Purify::clean($request->session()->has('home_phone'))) {
            return redirect(route('dashboard', ['type' => 'details']))->with('error', 'شماره تلفن ثبت نشد. لطفا مجددا اقدام نمایید.');
        }

        $status = ActiveCode::verifyCode($verification_code, $user);

        if ($status) {
            $user->activeCode()->delete();
            $user->update([
                'home_phone' => $request->session()->get('home_phone'),
                'phone_verified' => 1,
            ]);

            $request->session()->reflash();

            if ($request->session()->get('twoStepAuth') == 'on') {
                $user->update([
                    'twoStepAuth' => "active",
                ]);
            }

            $request->session()->flash('twoStepAuth', "off");

            return redirect(route('dashboard', ['type' => 'details']))->with('success', 'شماره تلفن با موفقیت ذخیره شد.');
        } else {
            $user->update([
                'twoStepAuth' => "inactive",
            ]);
            return redirect(route('dashboard', ['type' => 'details']))->with('error', 'شماره تلفن ثبت نشد. لطفا مجددا اقدام نمایید.');
        }

    }

    public function ShippingDetails($id) {

        $userData = auth()->user();
        $user_id = $userData->id;

        $order = Order::findOrFail(Purify::clean($id));

        $products = $order->products()->get();

        if ($order->user_id != $user_id) {
            return redirect(route('dashboard', ['type' => 'addresses']))->with('error', 'سفارش یافت نشد.');
        }

        return view('frontend.dashboard.shipping-details', compact('userData', 'order', 'products'));
    }

    public function GetVendorAddressAjax(Request $request) {

        $outlet_id = Purify::clean($request->outlet_id);
        $user_outlet_id = Purify::clean($request->user_outlet_id);

        $vendor_outlet = Outlet::findOrFail($outlet_id);
        // $user_outlet = Useroutlets::findOrFail($user_outlet_id);

        // $origin = array('lt' => $vendor_outlet->latitude, 'ln' => $vendor_outlet->longitude);
        // $destination = array('lt' => $user_outlet->latitude, 'ln' => $user_outlet->longitude);

        // $neshan_response = $this->GetCoordsDistance($origin, $destination);

        return response($vendor_outlet);
    }

    public function GetUserAddressAjax(Request $request) {

        $outlet_id = Purify::clean($request->outlet_id);
        $vendor_outlet_id = Purify::clean($request->vendor_outlet_id);

        $user_outlet = Useroutlets::findOrFail($outlet_id);

        return response($user_outlet);
    }

    public function GetCoordsDistance($origin, $destination) {
        $NESHAN_SERVICES_API_KEY = env('NESHAN_SERVICES_API_KEY');

        $origin_lt = $origin['lt'];
        $origin_ln = $origin['ln'];

        $destination_lt = $destination['lt'];
        $destination_ln = $destination['ln'];

        $neshan_response = Http::withHeaders(["Api-Key" => $NESHAN_SERVICES_API_KEY])->get("https://api.neshan.org/v1/distance-matrix/no-traffic?type=car&origins=$origin_lt,$origin_ln&destinations=$destination_lt,$destination_ln");

        return $neshan_response;
    }
}