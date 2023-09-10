<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\ActiveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use App\Notifications\ActiveCodeNotification;

class AuthTokenController extends Controller
{
    public function getToken(Request $request)
    {
        if (! $request->session()->has('auth')) {
            return redirect(route('login'));
        }

        $request->session()->reflash();

        $user = User::findOrFail(($request->session()->get('auth.user_id')));
        $home_phone = $user->home_phone;

        return view('auth.token', compact('home_phone'));
    }

    public function postToken(Request $request)
    {

        $code_1 = Purify::clean($request->code_1);
        $code_2 = Purify::clean($request->code_2);
        $code_3 = Purify::clean($request->code_3);
        $code_4 = Purify::clean($request->code_4);
        $code_5 = Purify::clean($request->code_5);

        if ($code_1 == NULL || $code_2 == NULL || $code_3 == NULL || $code_4 == NULL || $code_5 == NULL) {
            $request->session()->reflash();
            return redirect(route('2fa.token'))->with('error', 'لطفا کد امنیتی را به درستی وارد نمایید.');
        }

        $verification_code = $code_1 . $code_2 . $code_3 . $code_4 . $code_5;
        $verification_code = (int) $verification_code;

        if (! $request->session()->has('auth')) {
            Auth::guard('web')->logout();
            return redirect(route('login'));
        }

        $user = User::findOrFail($request->session()->get('auth.user_id'));
        $status = ActiveCode::verifyCode($verification_code, $user);

        if (! $status) {
            Auth::guard('web')->logout();
            return redirect(route('login'))->with('error', 'لطفا کد امنیتی را به درستی وارد نمایید.');
        }

        if (auth()->loginUsingId($user->id, $request->session()->get('auth.remember'))) {
            $user->activeCode()->delete();
            return redirect('/');
        }

        return redirect(route('login'));
    }

    public function phoneVerifyResend(Request $request)
    {
        $request->session()->reflash();

        $user = User::findOrFail(Purify::clean($request->session()->get('auth.user_id')));
        $home_phone = $user->home_phone;

        $code = ActiveCode::generateCode($user);
        $user->notify(new ActiveCodeNotification($code, $home_phone));

        return view('auth.token', compact('home_phone'));
    }
}