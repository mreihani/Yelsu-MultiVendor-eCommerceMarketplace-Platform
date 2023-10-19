<?php

namespace App\Notifications\Channels;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;


class SmsChannelUserAuth 
{
   public function send($notifible, Notification $notification) {
    $data = $notification->toFarazSms($notifible);
    
    $userinfo = $data['userinfo'];

    $number = $userinfo->home_phone;
    $user_fullname = $userinfo->firstname . " " . $userinfo->lastname;

    // کد پترن
    $pid = config('services.farazsms.pid.auth');

    // you api key that generated from panel
    $apiKey = config('services.farazsms.key');
   
    Http::get("http://ippanel.com:8080/?apikey=$apiKey&pid=$pid&fnum=3000505&tnum=$number&p1=user-name&v1=$user_fullname");
   }
}

