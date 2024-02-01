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
        ], [
            'home_phone.required' => 'لطفا شماره تلفن خود را وارد نمایید',
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
                return $cart['product']->price_with_commission * $cart['quantity'];
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
                    ['quantity' => $cart['quantity'], 'price' => $cart['product']->price_with_commission]
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
          
            $ResNum = Str::uuid()->toString();
            $sepGateway = new SepGatewayService($price * 10, $ResNum);
            $order->payments()->create([
                'resnumber' => $ResNum,
            ]);
            return $sepGateway->redirectToPayment();

        }
        return redirect(route('checkout'))->with('error', 'سبد خرید شما خالی است. لطفا محصول مورد نظر را انتخاب نمایید.');
    }

    public function callback(Request $request)
    {
        if($request->Status == 2) {
            $resNum = $request->ResNum;

            $payment = Payment::where('resnumber', $resNum)->firstOrFail();
            $amount = $payment->order->price;

            //$sepGateway = new SepGatewayService($amount * 10, $resNum);
           
            // $verifyTransactionSatus = $sepGateway->verify($request->RefNum);
            $verifyTransactionSatus = SepGatewayService::verify($request->RefNum);

            if($verifyTransactionSatus) {
                $payment->update(['status' => 1]);
                $payment->order()->update(['status' => 'paid']);

                // Subtract product stock values after successfull payments
                $cart = Cart::instance('default');
                $cartItems = $cart->all();
                foreach ($cartItems as $cartItem) {
                    $product = Product::find($cartItem['product']->id);
                    if ($product->unlimitedStock == 'disabled' && $product->product_qty != NULL) {
                        $product->product_qty = $product->product_qty - $cartItem['quantity'];

                        if ($product->product_qty < 0) {
                            $product->product_qty = 0;
                        }
                        $product->save();
                    }
                }

            $cart->flush();
            
            // ارسال پیامک دریافت سفارش
            event(new OrderEvent(['userinfo' => auth()->user(), 'orderid' => $payment->order()->first()->id]));

            return redirect(route('dashboard', ['type' => 'orders']))->with('success', 'سفارش شما با موفقیت ثبت گردید.');

            } else {
                return redirect(route('checkout'))->with('error', 'تراکنش لغو گردید. لطفا مجددا سعی نمایید.');
            }

        } else {
            return redirect(route('checkout'))->with('error', 'تراکنش لغو گردید. لطفا مجددا سعی نمایید.');
        }
        
    }
}