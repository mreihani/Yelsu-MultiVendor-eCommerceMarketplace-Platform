<?php

namespace App\Services\BankGatewayServices;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

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
    protected function getToken() {
        // Send a POST request to the specified endpoint with the required parameters
        $response = Http::post('https://sep.shaparak.ir/onlinepg/onlinepg', [
            "action" => "token",
            "TerminalId" => Config::get("yelsu-payment-gateway.sep.TerminalId"),
            "Amount" => $this->amount,
            "ResNum" => $this->ResNum,
            "RedirectUrl" => "https://yelsu.com/payment/callback",
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

    /**
     * Redirects to the payment page using the token obtained from the API.
     */
    public function redirectToPayment() {
        // Get the token from the API
        $token = $this->getToken();

        // If a valid token is obtained, redirect to the payment page
        if($token) {
            return redirect('https://sep.shaparak.ir/onlinepg/SendToken?token='.$token);
        }

        abort(404);
    }

    /**
     * Verify a transaction with the given amount and reference number.
     * This will avoid double spending.
     *
     * @param string $RefNum The reference number of the transaction
     */
    public static function verify($RefNum) {
        // Send a POST request to verify the transaction
        $response = Http::post('https://sep.shaparak.ir/verifyTxnRandomSessionkey/ipg/VerifyTransaction', [
            "RefNum" => $RefNum,
            "TerminalNumber" => Config::get("yelsu-payment-gateway.sep.TerminalId"),
        ]);
        
        // Get the response object
        return $response->object()->Success;
    }
    
}
