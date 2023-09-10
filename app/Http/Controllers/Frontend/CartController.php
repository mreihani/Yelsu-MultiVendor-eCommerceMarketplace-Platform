<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Product;
use App\Helpers\Cart\Cart;
use App\Models\Useroutlets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        $data = $request->validate([
            'quantity' => 'required',
            'id' => 'required',
        ]);

        $product = Product::findOrFail(Purify::clean($data['id']));

        if (Cart::has($product)) {
            if (Cart::count($product) < $product->product_qty || $product->product_qty == NULL || $product->unlimitedStock == 'active') {
                Cart::update($product, Purify::clean($data['quantity']));
            }
        } else {
            Cart::put([
                'quantity' => Purify::clean($data['quantity']),
            ],
                $product
            );
        }

        return response(['status' => 'success', 'cartCountProducts' => Cart::countCartItems()]);
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function minicart()
    {
        $productsArray = [];
        foreach (Cart::all() as $cart) {
            if (isset($cart['product'])) {
                $product = $cart['product'];
                $productsArray[] = ['products' => $product, 'cart' => $cart];
            }
        }
        return $productsArray;
    }

    public function quantityChange(Request $request)
    {
        $data = $request->validate([
            'quantity' => 'required',
            'id' => 'required',
            // 'cart' => 'required'
        ]);

        if (Cart::has(Purify::clean($data['id']))) {
            Cart::update(Purify::clean($data['id']), [
                'quantity' => Purify::clean($data['quantity'])
            ]);

            return response(['status' => 'success']);
        }

        return response(['status' => 'success', 'cartCountProducts' => Cart::countCartItems()]);
    }

    public function deleteFromCart($id)
    {
        Cart::delete(Purify::clean($id));

        return back();
    }

    public function deleteAllFromCart()
    {
        Cart::deleteAll();

        return back();
    }

    public function checkoutCreate()
    {
        if (Cart::countCartItems() > 0) {
            $user_id = Auth::user()->id;
            $userData = User::find($user_id);

            $latitudeVal = NULL;
            $longitudeVal = NULL;

            $useroutlet = Useroutlets::where('user_id', $user_id)->latest()->get();

            return view('frontend.checkout', compact('userData', 'latitudeVal', 'longitudeVal', 'useroutlet'));
        } else {
            return redirect()->to('/');
        }
    }


}