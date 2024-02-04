<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Payment;
use App\Models\Product;
use App\Events\OrderEvent;
use App\Helpers\Cart\Cart;
use App\Models\Useroutlets;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use App\Rules\PersonTypeValidation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use App\Services\BankGatewayServices\SepGatewayService;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $incomingFields = $request->validate([
            'home_phone' => 'required',
            'person_type' => new PersonTypeValidation($request),
            'selected_gateway' => 'required',
        ], [
            'home_phone.required' => 'لطفا شماره تلفن خود را وارد نمایید',
            'selected_gateway.required' => 'درگاه پرداخت را انتخاب نمایید',
        ]);

        if (Purify::clean($request->person_type) == 'haghighi') {
            if (Purify::clean($request->firstname) == NULL) {
                session()->flashInput($request->input());
                return redirect(route('checkout'))->with('error', 'لطفا نام خود را وارد نمایید.');
            }
            if (Purify::clean($request->lastname) == NULL) {
                session()->flashInput($request->input());
                return redirect(route('checkout'))->with('error', 'لطفا نام خانوادگی خود را وارد نمایید.');
            }
            if (Purify::clean($request->national_code) == NULL) {
                session()->flashInput($request->input());
                return redirect(route('checkout'))->with('error', 'لطفا کد ملی خود را وارد نمایید.');
            }
        } elseif (Purify::clean($request->person_type) == 'hoghoghi') {
            if (Purify::clean($request->shop_name) == NULL || Purify::clean($request->company_number) == NULL) {
                session()->flashInput($request->input());
                return redirect(route('checkout'))->with('error', 'لطفا اطلاعات شخص حقوقی را به درستی وارد نمایید.');
            }
        }

        $cart = Cart::instance('default');
        $cartItems = $cart->all();
        $user = auth()->user();

        if ($cartItems->count()) {
            $price = $cartItems->sum(function ($cart) {
                return $cart['product']->price_with_commission_value_added * $cart['quantity'];
            });

            // Here check if available in stock - Dont forget to show notification
            foreach ($cartItems as $cartItem) {
                $stockAvailable = $cartItem['product']->product_qty;
                if (($stockAvailable != NULL && $stockAvailable < $cartItem['quantity']) && ($cartItem['product']->unlimitedStock == 'disabled' && $stockAvailable < $cartItem['quantity'])) {
                    return redirect(route('checkout'))->with('error', 'محصول انتخاب شده از تعداد موجود در انبار بیشتر است. لطفا مجددا سعی نمایید.');
                }
            }

            $orderItems = $cartItems->mapWithKeys(function ($cart) {
                return [
                    $cart['product']->id
                    =>
                    ['quantity' => $cart['quantity'], 'price' => $cart['product']->price_with_commission_value_added]
                ];
            });

            if($request->person_type && $request->person_type == "haghighi") {

                $user->update([
                    'person_type' => $request->person_type ? Purify::clean($request->person_type) : NULL,
                    'firstname' => $request->firstname ? Purify::clean($request->firstname) : NULL,
                    'lastname' => $request->lastname ? Purify::clean($request->lastname) : NULL,
                    'national_code' => $request->national_code ? Purify::clean($request->national_code) : NULL,
                ]);

            } elseif($request->person_type && $request->person_type == "hoghoghi") {

                $user->update([
                    'person_type' => $request->person_type ? Purify::clean($request->person_type) : NULL,
                    'shop_name' => $request->shop_name ? Purify::clean($request->shop_name) : NULL,
                    'company_number' => $request->company_number ? Purify::clean($request->company_number) : NULL,
                    'agent_name' => $request->agent_name ? Purify::clean($request->agent_name) : NULL,
                ]);

            }
            
            $order = auth()->user()->order()->create([
                'status' => 'unpaid',
                'price' => $price,
                'order_note' => Purify::clean($request->order_note),
                'home_phone' => Purify::clean($incomingFields['home_phone']),
            ]);

            $order->products()->attach($orderItems);
          
            // Get cart id number
            $cartIdNumber = $cartItems->keys()->first();

            // Create a new res number to send it to the bank servers
            $ResNum = Str::uuid()->toString();
           
            // Create a new payment and save resNum parameter it to the database
            $order->payments()->create([
                'resnumber' => $ResNum,
            ]);

            // Get the selected gateway
            if($incomingFields["selected_gateway"] == "sep") {
                // Create an instance of SepGatewayService, and initialize it, passing the price and ResNum
                $bankGatewayObj = new SepGatewayService($price * 10, $ResNum);
            } else {
                // Add safety mechanism if the user manipulated HTML form and sent irrelevant information
                abort(404);
            }

            // Redirect to bank servers
            return $bankGatewayObj->redirectToPayment();
        }

        return redirect(route('checkout'))->with('error', 'سبد خرید شما خالی است. لطفا محصول مورد نظر را انتخاب نمایید.');
    }

    /**
     * Handle the callback from the payment gateway.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request)
    {
        // If status is equql to 2, then payment is successfull
        if($request->Status == 2) {

            // Get the incoming resNum parameter
            $resNum = $request->ResNum;

            // Get the payment by incoming resNum parameter
            $payment = Payment::where('resnumber', $resNum)->firstOrFail();

            // IMPORTANT:
            // This will avoid double spending. 
            // Imagine user has opened multiple windows to pay at the same time, this line will prevent that.
            if($payment->order->status == "paid") {
                // Redirect to the dashboard
                return redirect(route('checkout'))->with('error', 'تراکنش لغو گردید. پرداخت قبلا انجام شده است.');
            }

            // Verify the transaction
            $RefNum = $request->RefNum;
            $verifyTransactionSatus = SepGatewayService::verify($RefNum);

            // If the transaction is successfull after verification.
            if($verifyTransactionSatus) {
                
                // Retrieve all required parameters from POST request
                $terminal_id = $request->TerminalId;
                $trance_no = $request->TraceNo;
                $amount = $request->Amount;
                $rrn = $request->Rrn;
                $secure_pan = $request->SecurePan;

                // Update the payment parameters in DB
                $payment->update([
                    'status' => 1,
                    'terminal_id' => $terminal_id,
                    'refnumber' => $RefNum,
                    'trance_no' => $trance_no,
                    'amount' => $amount,
                    'rrn' => $rrn,
                    'secure_pan' => $secure_pan,
                ]);

                // Update the order status
                $payment->order()->update(['status' => 'paid']);

                // Subtract product stock values after successfull payments
                $this->subtractStock();

                // Send an event to the user and let him know the order is being processed
                event(new OrderEvent(['userinfo' => auth()->user(), 'orderid' => $payment->order()->first()->id]));

                // Redirect to the dashboard
                return redirect(route('dashboard', ['type' => 'orders']))->with('success', 'سفارش شما با موفقیت ثبت گردید.');
            } 
        }

        // Redirect to the checkout page with error
        return redirect(route('checkout'))->with('error', 'تراکنش لغو گردید. لطفا مجددا سعی نمایید.');
    }

    /**
     * Subtracts the quantity of products in the cart from the available stock.
     */
    public function subtractStock() {
        // Get the default cart instance
        $cart = Cart::instance('default');
        // Get all items in the cart
        $cartItems = $cart->all();
    
        // Loop through each item in the cart
        foreach ($cartItems as $cartItem) {
            // Find the product by its ID
            $product = Product::find($cartItem['product']->id);
            
            // Check if the product has limited stock and a specified quantity
            if ($product->unlimitedStock == 'disabled' && $product->product_qty != NULL) {
                // Subtract the quantity of the cart item from the product's available stock
                $product->product_qty = $product->product_qty - $cartItem['quantity'];
                
                // Ensure the product's available stock does not go below 0
                if ($product->product_qty < 0) {
                    $product->product_qty = 0;
                }
                
                // Save the updated product
                $product->save();
            }
        }

        // Clear the cart
        $cart->flush();
    }

}