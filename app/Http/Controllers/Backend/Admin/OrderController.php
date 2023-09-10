<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function ViewOrders()
    {
        $user_id = Auth::user()->id;
        $adminData = User::find($user_id);

        $orders = Order::orderBy('id', 'DESC')->where('status', Purify::clean(request('type')))->get();

        return view('admin.backend.orders.orderslist', compact('orders', 'adminData'));
    }

    public function DestroyOrder(Request $request)
    {
        $order = Order::findOrFail(Purify::clean($request->id));
        $order->delete();
        return back()->with('success', 'سفارش مورد نظر با موفقیت حذف گردید.');
    }

    public function ViewOrderItem($id)
    {
        $user_id = Auth::user()->id;
        $adminData = User::find($user_id);

        $order = Order::findOrFail(Purify::clean($id));
        return view('admin.backend.orders.orderdetail', compact('order', 'adminData'));
    }

    public function ChangeOrderStatus(Request $request)
    {
        $order = Order::findOrFail(Purify::clean($request->id));
        $order->update(['status' => $request->status]);

        return back()->with('success', 'سفارش مورد نظر با موفقیت به‌روزرسانی گردید.');
    }
}