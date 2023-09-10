<?php

namespace App\Notifications\Channels;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;


class SmsChannel 
{
   public function send($notifible, Notification $notification) {
    
    $data = $notification->toFarazSms($notifible);
    $message = $data['text'];
    $number = $data['number'];
    
    // you api key that generated from panel
    $apiKey = config('services.farazsms.key');
    
    Http::get("http://ippanel.com:8080/?apikey=$apiKey&pid=8cme5bzgpkesx37&fnum=3000505&tnum=$number&p1=verification-code&v1=$message");
   }
}

