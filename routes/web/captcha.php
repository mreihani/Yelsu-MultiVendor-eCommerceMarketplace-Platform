<?php
use App\Http\Controllers\Frontend\CaptchaController;

Route::get('reload-captcha', [CaptchaController::class, 'reloadCaptcha']);