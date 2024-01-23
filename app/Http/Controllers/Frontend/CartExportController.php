<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Product;
use App\Models\Useroutlets;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class CartExportController extends Controller
{
    public function checkoutexport(Request $request)
    {
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        $product_id = (int) Purify::clean($request->product_id);
        $quantity = (int) Purify::clean($request->quantity);

        $product = Product::find($product_id);

        $latitudeVal = NULL;
        $longitudeVal = NULL;

        $useroutlet = Useroutlets::where('user_id', $user_id)->latest()->get();

        return view('frontend.ckeckoutExport', compact('userData', 'product', 'quantity', 'latitudeVal', 'longitudeVal', 'useroutlet'));
    }

    public function orderexport(Request $request)
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
                return back()->with('error', 'لطفا نام خود را وارد نمایید.');
            }
            if (Purify::clean($request->lastname) == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا نام خانوادگی خود را وارد نمایید.');
            }
            if (Purify::clean($request->national_code) == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا کد ملی خود را وارد نمایید.');
            }
        } elseif (Purify::clean($request->person_type) == 'hoghoghi') {
            if (Purify::clean($request->company_name) == NULL || Purify::clean($request->company_number) == NULL) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا اطلاعات شخص حقوقی را به درستی وارد نمایید.');
            }
        }

        $product_id = (int) Purify::clean($request->product_id);
        $quantity = (int) Purify::clean($request->quantity);

        $product = Product::find($product_id);
        $product_slug = $product->product_slug;

        $product = collect(['product_item' => ['product' => $product, 'quantity' => $quantity]]);

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

        $orderItems = $product->mapWithKeys(function ($product) {
            return [
                $product['product']->id
                =>
                ['quantity' => $product['quantity'], 'price' => (int) $product['product']->price_with_commission]
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
            'useroutlet_id' => $useroutlet_id,
        ]);

        $order->products()->attach($orderItems);

        return redirect(route('product.details', $product_slug))->with('success', 'سفارش شما با موفقیت ثبت گردید.');
    }

}