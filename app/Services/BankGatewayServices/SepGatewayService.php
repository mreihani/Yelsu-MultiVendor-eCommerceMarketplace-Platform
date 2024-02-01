<?php

namespace App\Services\BankGatewayServices;

use Illuminate\Support\Facades\Http;

class SepGatewayService { 

    public function getToken() {
        $response = Http::post('https://sep.shaparak.ir/onlinepg/onlinepg', [
            "action" => "token",
            "TerminalId" => "13062424",
            "Amount" => 12000,
            "ResNum" => "1qaz@WSX",
            "RedirectUrl" => "https://yelsu.com/payment/callback",
            "CellNumber" => "9120000000"
        ]);
    }
    
}
