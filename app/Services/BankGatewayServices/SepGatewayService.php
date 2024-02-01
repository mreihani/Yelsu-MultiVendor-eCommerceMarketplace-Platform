<?php

namespace App\Services\BankGatewayServices;

use Illuminate\Support\Facades\Http;

class SepGatewayService { 

public $amount;
public $ResNum;

/**
 * Constructor method for initializing the amount and ResNum.
 *
 * @param int $amount The amount to be initialized.
 * @param string $ResNum The ResNum to be initialized.
 */
public function __construct(int $amount, string $ResNum) {
    $this->amount = $amount;
    $this->ResNum = $ResNum;
}

/**
 * Get a token from the specified endpoint.
 *
 * @return string|bool The token if the request is successful, false otherwise.
 */
public function getToken() {
    // Send a POST request to the specified endpoint with the required parameters
    $response = Http::post('https://sep.shaparak.ir/onlinepg/onlinepg', [
        "action" => "token",
        "TerminalId" => "13062424",
        "Amount" => $this->amount,
        "ResNum" => $this->ResNum,
        "RedirectUrl" => "https://yelsu.com/payment/callback",
        "CellNumber" => "9120000000"
    ]);

    // Get the response object
    $responseObject = $response->object();
    // Get the status from the response object
    $responseStatus = $responseObject->status;

    // Check if the response status is 1
    if($responseStatus == 1) {
        // Return the token from the response object
        return $responseObject->token;
    } else {
        // Return false if the response status is not 1
        return false;
    }
}
    
}
