<?php

namespace App\Http\Controllers\Backend\Representative;


use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Models\Representative;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

class RepresentativeController extends Controller
{
    public function RepresentativeDashboard()
    {
        $representativeData = auth()->user();
        $id = $representativeData->id;

        return view('representative.index', compact('representativeData'));
    } //End method

    public function RepresentativeDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //End method

    public function RepresentativeProfile()
    {
        $id = Auth::user()->id;
        $representativeData = User::find($id);

        $representative_sector_arr = explode(",", $representativeData->representative_sector);
        $representative_sector_cat_arr = [];
        foreach ($representative_sector_arr as $representative_sector_item) {
            $representative_sector_cat_arr[] = Category::find($representative_sector_item);
        }

        return view('representative.representative_profile_view', compact('representativeData', 'representative_sector_cat_arr'));
    } //End method

    public function RepresentativeProfileSettings()
    {
        $id = Auth::user()->id;
        $representativeData = User::find($id);

        $parentCategories = Category::where('parent', 0)->latest()->get()->reverse();

        // category for filter
        // $representative_sector_cat_arr_selected =  explode(",", $representativeData->representative_sector);
        // $filter_category_array = [];
        // foreach ($parentCategories as $parentCategory) {
        //     $all_children = Category::find($parentCategory->id)->child;
        //     $filter_category_array[] = array($parentCategory, $all_children);
        // }
        // category for filter

        return view('representative.representative_profile_settings', compact('representativeData', 'parentCategories'));
    } //End method

    public function RepresentativeProfileStore(Request $request)
    {
        $incomingFields = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'shop_address' => 'required',
            'shop_name' => 'required',
        ], [
            'firstname.required' => 'لطفا نام خود را وارد نمایید.',
            'lastname.required' => 'لطفا نام خانوادگی خود را وارد نمایید.',
            'shop_address.required' => 'لطفا آدرس فروشگاه/شرکت خود را وارد نمایید.',
            'shop_name.required' => 'لطفا نام فروشگاه/شرکت خود را وارد نمایید.',
        ]);

        if (Purify::clean($request->person_type) == 'haghighi') {

            if (Purify::clean($request->national_code) == null) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا کد ملی خود را وارد نمایید.');
            }

            if (strlen(Purify::clean($request->national_code)) != 10 || ! is_numeric(Purify::clean($request->national_code))) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا کد ملی صحیح وارد نمایید.');
            }

        } elseif (Purify::clean($request->person_type) == 'hoghoghi') {

            if (Purify::clean($request->company_number) == null) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا شماره شناسه شرکت راوارد نمایید.');
            }

            if (strlen(Purify::clean($request->company_number)) != 11 || ! is_numeric(Purify::clean($request->company_number))) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا شماره شناسه صحیح وارد نمایید.');
            }
        }

        $id = Auth::user()->id;
        $data = User::find($id);

        if (Purify::clean($incomingFields['firstname'])) {
            $data->firstname = Purify::clean($incomingFields['firstname']);
        }

        if (Purify::clean($incomingFields['lastname'])) {
            $data->lastname = Purify::clean($incomingFields['lastname']);
        }

        if (Purify::clean($incomingFields['shop_address'])) {
            $data->shop_address = Purify::clean($incomingFields['shop_address']);
        }

        if (Purify::clean($incomingFields['shop_name'])) {
            $data->shop_name = Purify::clean($incomingFields['shop_name']);
        }

        if (Purify::clean($request->person_type)) {
            $data->person_type = Purify::clean($request->person_type);
        }

        if (Purify::clean($request->national_code)) {
            $data->national_code = Purify::clean($request->national_code);
        }

        if (Purify::clean($request->company_number)) {
            $data->company_number = Purify::clean($request->company_number);
        }

        if (Purify::clean($request->agent_name)) {
            $data->agent_name = Purify::clean($request->agent_name);
        }

        if (Purify::clean($request->file('photo'))) {
            $file = Purify::clean($request->file('photo'));

            if ($data->photo != null) {
                unlink('storage/upload/representative_images/' . $data->photo);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(160)->encode('jpg')->save('storage/upload/representative_images/' . $filename);
            $data['photo'] = $filename;
        }

        if (Purify::clean($request->file('store_banner'))) {
            $file = $request->file('store_banner');

            if ($data->store_banner != null) {
                unlink('storage/upload/representative_images/' . $data->store_banner);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(930, 446)->encode('jpg')->save('storage/upload/representative_images/' . $filename);
            $data['store_banner'] = $filename;
        }


        $data->save();
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');

    } //End method

    public function RepresentativeProfileFinancialStatement()
    {
        $id = Auth::user()->id;
        $representativeData = User::find($id);
        return view('representative.representative_profile_financial_statement', compact('representativeData'));
    }

    public function RepresentativeProfileFinancialStatementStore(Request $request)
    {
        $incomingFields = $request->validate([
            'shaba_number' => 'required|digits:24',
            'cart_owner_info' => 'required',
            'cart_bank_info' => 'required',
        ], [
            'shaba_number.required' => 'لطفا شماره شبا را وارد نمایید.',
            'shaba_number.digits' => 'لطفا شماره شبا صحبح وارد نمایید.',
            'cart_owner_info.required' => 'لطفا نام و نام خانوادگی صاحب حساب / شرکت را وارد نمایید.',
            'cart_bank_info.required' => 'لطفا نام بانک را وارد نمایید.',
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);

        $data->shaba_number = Purify::clean($incomingFields['shaba_number']);
        $data->cart_owner_info = Purify::clean($incomingFields['cart_owner_info']);
        $data->cart_bank_info = Purify::clean($incomingFields['cart_bank_info']);

        if (Purify::clean($request->cart_number)) {
            if (strlen(Purify::clean($request->cart_number)) == 16 && is_numeric(Purify::clean($request->cart_number))) {
                $data->cart_number = Purify::clean($request->cart_number);
            } else {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا شماره کارت صحیح وارد نمایید.');
            }
        } else {
            $data->cart_number = null;
        }

        $data->save();
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    } //End method

    public function RepresentativeAllProduct()
    {
        $user_id = Auth::user()->id;
        $representativeData = User::find($user_id);
        
        $representative_products = $representativeData->representative->products()->get();

        return view('representative.backend.product.representative_product_all', compact('representative_products', 'representativeData'));
    }

    public function RepresentativeEditProduct($id)
    {
        $user_id = Auth::user()->id;
        $representativeData = User::find($user_id);
        
        $representative_product = $representativeData->representative->products()->where("product_id", $id)->first();
        
        if(!in_array($id, $representativeData->representative->products()->pluck('id')->toArray()) || !$representativeData->representative->products()->where('product_id', $id)->first()->pivot->change_price_permission) {
            return redirect(route('representative.all.product'))->with('error', 'شما اجازه دسترسی به محصول مورد نظر را ندارید!');
        }

        return view('representative.backend.product.representative_product_edit', compact('representativeData', 'representative_product'));
    }

    public function RepresentativeUpdateProduct(Request $request)
    {
        $product_id = Purify::clean($request->product_id);
        $user_id = Auth::user()->id;
        $representativeData = User::find($user_id);
        $representative_product = $representativeData->representative->products()->where("product_id", $product_id)->first();
        
        $incomingFields = $request->validate([
            'selling_price' => 'required',
        ], [
            'selling_price.required' => 'لطفا قیمت محصول را وارد نمایید.',
        ]);
        
        if(!in_array($product_id, $representativeData->representative->products()->pluck('id')->toArray()) || !$representativeData->representative->products()->where('product_id', $product_id)->first()->pivot->change_price_permission) {
            return redirect(route('representative.all.product'))->with('error', 'شما اجازه دسترسی به محصول مورد نظر را ندارید!');
        }

        Product::find($product_id)->update(['selling_price' => Purify::clean($incomingFields['selling_price'])]);

        return redirect()->route('representative.all.product')->with('success', 'محصول مورد نظر با موفقیت به‌روزرسانی گردید.');
    }

    public function ViewRepresentativeOrders()
    {
        $user_id = Auth::user()->id;
        $representativeData = User::find($user_id);
        $orders = Order::orderBy('id', 'DESC')->where('status', request('type'))->get();

        return view('representative.representative_orderslist', compact('orders', 'representativeData'));
    }

    public function DestroyRepresentativeOrder($id)
    {
        $user_id = Auth::user()->id;
        $order = Order::findOrFail(Purify::clean($id));

        foreach ($order->products()->get() as $item) {
            if ($item->representative_id != $user_id) {
                return back();
            }
        }
        $order->delete();

        return back()->with('success', 'سفارش مورد نظر با موفقیت حذف گردید.');
    }

    public function ViewRepresentativeOrderItem($id)
    {
        $user_id = Auth::user()->id;
        $representativeData = User::find($user_id);

        $order = Order::findOrFail(Purify::clean($id));
        return view('representative.representative_order_detail', compact('order', 'representativeData'));
    }

    public function ChangeRepresentativeOrderStatus(Request $request)
    {
        $user_id = Auth::user()->id;
        $order = Order::findOrFail(Purify::clean($request->id));

        foreach ($order->products()->get() as $item) {
            if ($item->representative_id != $user_id) {
                return back();
            }
        }
        $order->update(['status' => Purify::clean($request->status)]);

        return back()->with('success', 'سفارش مورد نظر با موفقیت به‌روزرسانی گردید.');
    }
}
