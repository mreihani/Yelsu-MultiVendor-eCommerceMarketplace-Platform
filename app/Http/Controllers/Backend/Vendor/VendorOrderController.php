<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

use App\Http\Controllers\Controller;

class VendorOrderController extends Controller
{
    public function ViewVendorOrders()
    {
        $user_id = Auth::user()->id;
        $vendorData = User::find($user_id);
        $orders = Order::orderBy('id', 'DESC')->where('status', request('type'))->get();

        return view('vendor.vendor_orderslist', compact('orders', 'vendorData'));
    }

    public function DestroyVendorOrder($id)
    {
        $user_id = Auth::user()->id;
        $order = Order::findOrFail(Purify::clean($id));

        foreach ($order->products()->get() as $item) {
            if ($item->vendor_id != $user_id) {
                return back();
            }
        }
        $order->delete();

        return back()->with('success', 'سفارش مورد نظر با موفقیت حذف گردید.');
    }

    public function ViewVendorOrderItem($id)
    {
        $user_id = Auth::user()->id;
        $vendorData = User::find($user_id);

        $order = Order::findOrFail(Purify::clean($id));
        return view('vendor.vendor_order_detail', compact('order', 'vendorData'));
    }

    public function ChangeVendorOrderStatus(Request $request)
    {
        $user_id = Auth::user()->id;
        $order = Order::findOrFail(Purify::clean($request->id));

        foreach ($order->products()->get() as $item) {
            if ($item->vendor_id != $user_id) {
                return back();
            }
        }
        $order->update(['status' => Purify::clean($request->status)]);

        return back()->with('success', 'سفارش مورد نظر با موفقیت به‌روزرسانی گردید.');
    }
}