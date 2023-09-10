<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

use App\Http\Controllers\Controller;

class CartExportController extends Controller
{
    public function checkoutexport(Request $request)
    {
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        $product_id = (int) Purify::clean($request->product_id);
        $quantity = (int) Purify::clean($request->quantity);

        $product = Product::find($product_id);

        return view('frontend.ckeckoutExport', compact('userData', 'product', 'quantity'));
    }

    public function orderexport(Request $request)
    {
        if (Purify::clean($request->person_type) == 'haghighi') {
            if (Purify::clean($request->firstname) == NULL || Purify::clean($request->lastname) == NULL || Purify::clean($request->national_code) == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا تمامی موارد فرم جزئیات صورت حساب را به درستی تکمیل نمایید.');
            }
        } elseif (Purify::clean($request->person_type) == 'hoghoghi') {
            if (Purify::clean($request->company_name) == NULL || Purify::clean($request->company_number) == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا تمامی موارد فرم جزئیات صورت حساب را به درستی تکمیل نمایید.');
            }
        }
        if (Purify::clean($request->shipping_province) == NULL || Purify::clean($request->shipping_city) == NULL || Purify::clean($request->shipping_address) == NULL || Purify::clean($request->shipping_postalcode) == NULL || Purify::clean($request->shipping_phone) == NULL) {
            session()->flashInput($request->input());
            return back()->with('error', 'لطفا تمامی موارد فرم جزئیات صورت حساب را به درستی تکمیل نمایید.');
        }

        $product_id = (int) Purify::clean($request->product_id);
        $quantity = (int) Purify::clean($request->quantity);

        $product = Product::find($product_id);
        $product_slug = $product->product_slug;

        $product = collect(['product_item' => ['product' => $product, 'quantity' => $quantity]]);

        $orderItems = $product->mapWithKeys(function ($product) {
            return [
                $product['product']->id
                =>
                ['quantity' => $product['quantity'], 'price' => (int) $product['product']->selling_price]
            ];
        });

        $order = auth()->user()->order()->create([
            'status' => 'received',
            'price' => $orderItems->first()['price'],
            'person_type' => Purify::clean($request->person_type),
            'firstname' => Purify::clean($request->firstname),
            'lastname' => Purify::clean($request->lastname),
            'national_code' => Purify::clean($request->national_code),
            'company_name' => Purify::clean($request->company_name),
            'company_number' => Purify::clean($request->company_number),
            'agent_name' => Purify::clean($request->agent_name),
            'order_note' => Purify::clean($request->order_note),
        ]);

        $order->products()->attach($orderItems);

        return redirect(route('product.details', $product_slug))->with('success', 'سفارش شما با موفقیت ثبت گردید.');
    }

}