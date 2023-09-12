<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaptchaController extends Controller
{
    public function reloadCaptcha() {
        return response()->json(["captcha" => captcha_img(env("MEWEBSTUDIO_CAPTCHA", "default"))]);
    }
}

