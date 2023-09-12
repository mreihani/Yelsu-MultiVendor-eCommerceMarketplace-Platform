<?php

namespace App\Http\Controllers\Auth;

use App\Models\Category;
use Illuminate\View\View;
use App\Models\ActiveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Stevebauman\Purify\Facades\Purify;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ActiveCodeNotification;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create() : View
    {
        $parentCategories = Category::where('parent', 0)->latest()->get()->reverse();

        return view('auth.login', compact('parentCategories'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request) : RedirectResponse
    {
        $incomingFields = $request->validate([
            'captcha' => ['required', 'captcha'],
        ], [
            'captcha.required' => 'لطفا عبارت امنیتی را وارد نمایید.',
            'captcha.captcha' => 'لطفا عبارت امنیتی را به درستی وارد نمایید.',
        ]);

        if (Purify::clean($request->email) == NULL || ($request->password) == NULL) {
            return redirect('/login')->with('error', 'لطفا اطلاعات ورود را به درستی وارد نمایید.')->withInput();
        }

        $request->authenticate();

        if ($request->user()->twoStepAuth == 'active') {

            $request->session()->flash('auth', [
                'user_id' => $request->user()->id,
                'remember' => $request->has('remember')
            ]);

            $code = ActiveCode::generateCode(Purify::clean($request->user()));
            $home_phone = Purify::clean($request->user()->home_phone);
            $current_user = Purify::clean($request->user());

            Auth::guard('web')->logout();
            $current_user->notify(new ActiveCodeNotification($code, $home_phone));

            return redirect(route('2fa.token'));
        }


        $url = '';
        if (Purify::clean($request->user()->role) === 'admin') {
            $url = '/dashboard';
        } elseif (Purify::clean($request->user()->role) === 'vendor') {
            $url = '/dashboard';
        } elseif (Purify::clean($request->user()->role) === 'editor') {
            $url = '/dashboard';
        } elseif (Purify::clean($request->user()->role) === 'specialist') {
            $url = '/dashboard';
        } elseif (Purify::clean($request->user()->role) === 'financial') {
            $url = '/dashboard';
        } else {
            $url = '/dashboard';
        }

        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request) : RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}