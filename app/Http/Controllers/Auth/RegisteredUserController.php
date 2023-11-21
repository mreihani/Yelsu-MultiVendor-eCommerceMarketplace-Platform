<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Driver;
use App\Models\Category;
use App\Models\Merchant;
use Illuminate\View\View;
use App\Models\Freightage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Stevebauman\Purify\Facades\Purify;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create() : View
    {
        $parentCategories = Category::where('parent', 0)->latest()->get()->reverse();

        return view('auth.register', compact('parentCategories'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) : RedirectResponse
    {
        $incomingFields = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^[A-Za-z0-9]+(?:[_][A-Za-z0-9]+)*$/', 'min:5', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => 'required|confirmed|min:8|max:20',
            'policyAgreement' => 'required',
            'captcha' => ['required', 'captcha'],
            'home_phone' => ['required', env('IRANIAN_PHONE_REGEX')],
        ], [
            'firstname.required' => 'لطفا نام خود را وارد نمایید.',
            'lastname.required' => 'لطفا نام خانوادگی خود را وارد نمایید.',
            'username.required' => 'لطفا نام کاربری خود را وارد نمایید.',
            'username.unique' => 'نام کاربری مورد نظر قبلا در سامانه ثبت شده است. لطفا نام کاربری دیگری انتخاب نمایید.',
            'username.min' => 'نام کاربری حداقل 5 کاراکتر باید باشد.',
            'username.regex' => 'نام کاربری فقط باید شامل حروف و اعداد انگلیسی باشد. !@#)($%^&-* و فاصله غیر مجاز است.',
            'email.required' => 'لطفا ایمیل خود را وارد نمایید.',
            'email.unique' => 'ایمیل مورد نظر قبلا در سامانه ثبت شده است. لطفا ایمیل دیگری انتخاب نمایید.',
            'email.email' => 'لطفا آدرس ایمیل صحیح وارد نمایید.',
            'password.required' => 'لطفا کلمه عبور خود را وارد نمایید.',
            'password.confirmed' => 'لطفا تکرار کلمه عبور را به درستی وارد نمایید.',
            'password.min' => 'کلمه عبور باید حداقل 8 کاراکتر باشد.',
            'password.max' => 'کلمه عبور باید حداکثر 20 کاراکتر باشد.',
            'policyAgreement.required' => 'لطفا موافقت نامه حفظ حریم خصوصی را تایید فرمایید.',
            'captcha.required' => 'لطفا عبارت امنیتی را وارد نمایید.',
            'captcha.captcha' => 'لطفا عبارت امنیتی را به درستی وارد نمایید.',
            'home_phone.required' => 'لطفا شماره تلفن همراه خود را وارد نمایید.',
            'home_phone.regex' => 'لطفا شماره تلفن صحیح وارد نمایید.',
        ]);

        if ($incomingFields->fails()) {
            return redirect()->to('/register')->withErrors($incomingFields)->withInput();
        }


        if (Purify::clean($request->check_user_type) == 2 || Purify::clean($request->check_user_type) == 3 || Purify::clean($request->check_user_type == 4) || Purify::clean($request->check_user_type) == 5 || Purify::clean($request->check_user_type) == 6) {
            if (Purify::clean($request->shop_name) == NULL) {
                return redirect('/register')->with('error', 'لطفا نام فروشگاه خود را وارد نمایید.')->withInput();
            } elseif (Purify::clean($request->shop_address) == NULL) {
                return redirect('/register')->with('error', 'لطفا آدرس فروشگاه خود را وارد نمایید.')->withInput();
            }
        }

        if (Purify::clean($request->check_user_type) == 2 || Purify::clean($request->check_user_type) == 4 || Purify::clean($request->check_user_type) == 5) {
            if (Purify::clean($request->vendor_sector) != NULL) {
                $vendor_sector = implode(',', Purify::clean($request->vendor_sector));
            } else {
                $vendor_sector = "";
                return redirect('/register')->with('error', 'لطفا زمینه فعالیت را مشخص نمایید.')->withInput();
            }
        }

        $parents_categories = Category::where('parent', 0)->get()->pluck('id')->join(", ");

        //Add id check for vendor or customer account type    
        if (Purify::clean($request->check_user_type) == 1) {
            $user = User::create([
                'firstname' => Purify::clean($request->firstname),
                'lastname' => Purify::clean($request->lastname),
                'username' => Purify::clean(strtolower($request->username)),
                'email' => Purify::clean(strtolower($request->email)),
                'password' => Hash::make(($request->password)),
                'role' => 'user',
                'shop_name' => Purify::clean($request->shop_name),
                'home_phone' => Purify::clean($request->home_phone),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } elseif (Purify::clean($request->check_user_type) == 2) {
            $user = User::create([
                'firstname' => Purify::clean($request->firstname),
                'lastname' => Purify::clean($request->lastname),
                'username' => Purify::clean(strtolower($request->username)),
                'shop_name' => Purify::clean($request->shop_name),
                'shop_address' => Purify::clean($request->shop_address),
                'email' => Purify::clean(strtolower($request->email)),
                'password' => Hash::make(($request->password)),
                'role' => 'vendor',
                'status' => 'inactive',
                'vendor_sector' => $vendor_sector,
                'home_phone' => Purify::clean($request->home_phone),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } elseif (Purify::clean($request->check_user_type) == 3) {
            $user = User::create([
                'firstname' => Purify::clean($request->firstname),
                'lastname' => Purify::clean($request->lastname),
                'username' => Purify::clean(strtolower($request->username)),
                'email' => Purify::clean(strtolower($request->email)),
                'password' => Hash::make(($request->password)),
                'role' => 'merchant',
                'shop_name' => Purify::clean($request->shop_name),
                'shop_address' => Purify::clean($request->shop_address),
                'status' => 'inactive',
                'home_phone' => Purify::clean($request->home_phone),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            Merchant::create([
                'user_id' => $user->id,
            ]);
        } elseif (Purify::clean($request->check_user_type) == 4) {
            $user = User::create([
                'firstname' => Purify::clean($request->firstname),
                'lastname' => Purify::clean($request->lastname),
                'username' => Purify::clean(strtolower($request->username)),
                'shop_name' => Purify::clean($request->shop_name),
                'shop_address' => Purify::clean($request->shop_address),
                'email' => Purify::clean(strtolower($request->email)),
                'password' => Hash::make(($request->password)),
                'role' => 'retailer',
                'status' => 'inactive',
                'vendor_sector' => $vendor_sector,
                'home_phone' => Purify::clean($request->home_phone),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } elseif (Purify::clean($request->check_user_type) == 5) {
            $user = User::create([
                'firstname' => Purify::clean($request->firstname),
                'lastname' => Purify::clean($request->lastname),
                'username' => Purify::clean(strtolower($request->username)),
                'email' => Purify::clean(strtolower($request->email)),
                'password' => Hash::make(($request->password)),
                'role' => 'freightage',
                'shop_name' => Purify::clean($request->shop_name),
                'shop_address' => Purify::clean($request->shop_address),
                'status' => 'inactive',
                'home_phone' => Purify::clean($request->home_phone),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            Freightage::create([
                'user_id' => $user->id,
                'category_id' => $vendor_sector,
                'category_id_temp' => $vendor_sector,
            ]);
        } elseif (Purify::clean($request->check_user_type) == 6) {
            $user = User::create([
                'firstname' => Purify::clean($request->firstname),
                'lastname' => Purify::clean($request->lastname),
                'username' => Purify::clean(strtolower($request->username)),
                'email' => Purify::clean(strtolower($request->email)),
                'password' => Hash::make(($request->password)),
                'role' => 'driver',
                'shop_name' => Purify::clean($request->shop_name),
                'shop_address' => Purify::clean($request->shop_address),
                'status' => 'inactive',
                'home_phone' => Purify::clean($request->home_phone),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            Driver::create([
                'user_id' => $user->id,
                'category_id' => $parents_categories,
                'category_id_temp' => $parents_categories,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'حساب کاربری با موفقیت ایجاد گردید.');
    }
}