<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Payment;
use App\Models\Product;
use App\Helpers\Cart\Cart;
use App\Models\Useroutlets;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $incomingFields = $request->validate([
            'home_phone' => 'required',
            'address_title' => Purify::clean(request()->shipment) == 0 ? 'required' : '',
            'country' => Purify::clean(request()->shipment) == 0 ? 'required' : '',
            'province' => Purify::clean(request()->shipment) == 0 ? 'required' : '',
            'city' => Purify::clean(request()->shipment) == 0 ? 'required' : '',
            'address' => Purify::clean(request()->shipment) == 0 ? 'required' : '',
            'latitude' => Purify::clean(request()->shipment) == 0 ? 'required' : '',
            'longitude' => Purify::clean(request()->shipment) == 0 ? 'required' : '',
        ], [
            'home_phone.required' => 'لطفا شماره تلفن خود را وارد نمایید',
            'address_title.required' => 'لطفا عنوان محل مورد نظر را وارد نمایید.',
            'country.required' => 'لطفا کشور محل مورد نظر را وارد نمایید.',
            'province.required' => 'لطفا استان محل مورد نظر را وارد نمایید.',
            'city.required' => 'لطفا شهر محل مورد نظر راوارد نمایید.',
            'address.required' => 'لطفا آدرس محل مورد نظر را وارد نمایید.',
            'latitude.required' => 'لطفا عرض جغرافیایی محل مورد نظر را وارد نمایید.',
            'longitude.required' => 'لطفا طول جغرافیایی محل مورد نظر را وارد نمایید.',
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
            if (Purify::clean($request->company_name) == NULL || Purify::clean($request->company_number) == NULL) {
                session()->flashInput($request->input());
                return redirect(route('checkout'))->with('error', 'لطفا اطلاعات شخص حقوقی را به درستی وارد نمایید.');
            }
        }

        $cart = Cart::instance('default');
        $cartItems = $cart->all();

        if ($cartItems->count()) {
            $price = $cartItems->sum(function ($cart) {
                return $cart['product']->selling_price * $cart['quantity'];
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
                    ['quantity' => $cart['quantity'], 'price' => $cart['product']->selling_price]
                ];
            });


            if (Purify::clean($request->shipment) != 0) {
                $useroutlet_id = Purify::clean($request->shipment);
            } else {
                $useroutlet_id = Useroutlets::insertGetId([
                    'country' => Purify::clean($incomingFields['country']),
                    'city' => Purify::clean($incomingFields['city']),
                    'province' => Purify::clean($incomingFields['province']),
                    'name' => Purify::clean($incomingFields['address_title']),
                    'address' => Purify::clean($incomingFields['address']),
                    'latitude' => Purify::clean($incomingFields['latitude']),
                    'longitude' => Purify::clean($incomingFields['longitude']),
                    'postalcode' => Purify::clean($request->postalcode) ? Purify::clean($request->postalcode) : NULL,
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            $order = auth()->user()->order()->create([
                'status' => 'unpaid',
                'price' => $price,
                'person_type' => Purify::clean($request->person_type),
                'firstname' => Purify::clean($request->firstname),
                'lastname' => Purify::clean($request->lastname),
                'national_code' => Purify::clean($request->national_code),
                'company_name' => Purify::clean($request->company_name),
                'company_number' => Purify::clean($request->company_number),
                'agent_name' => Purify::clean($request->agent_name),
                'order_note' => Purify::clean($request->order_note),
                'home_phone' => Purify::clean($incomingFields['home_phone']),
                'useroutlet_id' => $useroutlet_id,
            ]);

            $order->products()->attach($orderItems);

            // Create new invoice.
            $invoice = (new Invoice)->amount(1000);
            return ShetabitPayment::callbackUrl(route('payment.callback'))->purchase($invoice, function ($driver, $transactionId) use ($order, $cart, $invoice) {
                $order->payments()->create([
                    'resnumber' => $invoice->getUuid(),
                ]);

                //$cart->flush();
            })->pay()->render();


        }
        return redirect(route('checkout'))->with('error', 'سبد خرید شما خالی است. لطفا محصول مورد نظر را انتخاب نمایید.');
    }

    public function callback(Request $request)
    {
        try {
            $payment = Payment::where('resnumber', Purify::clean($request->clientrefid))->firstOrFail();

            // $payment->order->price
            $receipt = ShetabitPayment::amount(1000)->transactionId(Purify::clean($request->clientrefid))->verify();

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
            //return redirect('shop');

            return redirect(route('dashboard', ['type' => 'orders']))->with('success', 'سفارش شما با موفقیت ثبت گردید.');

        } catch (InvalidPaymentException $exception) {
            //return $exception->getMessage();

            return redirect(route('checkout'))->with('error', 'تراکنش لغو گردید. لطفا مجددا سعی نمایید.');
        }
    }
}