<?php

namespace App\Http\Controllers\Backend\Specialist;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Customsoutlet;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

use App\Http\Controllers\Controller;

class SpeclialistCustomsController extends Controller
{
    public function SpeclialistAllCustomsOutlet()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        if (! Purify::clean(request('type'))) {
            $customoutlets = Customsoutlet::orderBy("id", 'ASC')->get();
        } else {
            $customoutlets = Customsoutlet::orderBy("id", 'ASC')->where('customs_type', Purify::clean(request('type')))->get();
        }

        return view('specialist.customsoutlets.specialist_customs_all', compact('specialistData', 'customoutlets'));
    }

    public function SpeclialistCreateCustomsOutlet()
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);
        $type = Purify::clean(request('type'));

        return view('specialist.customsoutlets.specialist_customs_outlet_add', compact('specialistData', 'type'));
    }

    public function SpeclialistStoreCustomsOutlet(Request $request)
    {
        $incomingFields = $request->validate([
            'photo' => ['required', 'image', 'max:5000'],
            'banner_photo' => ['required', 'image', 'max:5000'],
            'country' => 'required',
            'province' => 'required',
            'name' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'photo.required' => 'لطفا تصویر اصلی گمرک را بارگذاری نمایید.',
            'photo.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'photo.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
            'banner_photo.required' => 'لطفا تصویر بنر گمرک را بارگذاری نمایید.',
            'banner_photo.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'banner_photo.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
            'country.required' => 'لطفا کشور محل انتخاب شده را وارد نمایید.',
            'province.required' => 'لطفا استان محل انتخاب شده را وارد نمایید.',
            'name.required' => 'لطفا نام منطقه انتخاب شده را وارد نمایید.',
            'address.required' => 'لطفا آدرس محل انتخاب شده را وارد نمایید.',
            'latitude.required' => 'لطفا عرض جغرافیایی را وارد نمایید.',
            'longitude.required' => 'لطفا طول جغرافیایی را وارد نمایید.',
        ]);

        $image = Purify::clean($incomingFields['photo']);
        $unique_image_name = hexdec(uniqid()) . time();
        $name_gen = $unique_image_name . '.' . 'jpg';
        Image::make($image)->fit(160)->encode('jpg')->save('storage/upload/customs_images/' . $name_gen);
        $save_url = 'storage/upload/customs_images/' . $name_gen;

        $banner_image = Purify::clean($incomingFields['banner_photo']);
        $unique_banner_image_name = hexdec(uniqid()) . time();
        $banner_name_gen = $unique_banner_image_name . '.' . 'jpg';
        Image::make($banner_image)->fit(930, 446)->encode('jpg')->save('storage/upload/customs_images/' . $banner_name_gen);
        $banner_save_url = 'storage/upload/customs_images/' . $banner_name_gen;

        Customsoutlet::insert([
            'customs_type' => Purify::clean($request->customs_type),
            'country' => Purify::clean($incomingFields['country']),
            'province' => Purify::clean($incomingFields['province']),
            'name' => Purify::clean($incomingFields['name']),
            'address' => Purify::clean($incomingFields['address']),
            'latitude' => Purify::clean($incomingFields['latitude']),
            'longitude' => Purify::clean($request->longitude),
            'postalcode' => Purify::clean($request->postalcode) ? Purify::clean($request->postalcode) : NULL,
            'phone' => Purify::clean($request->phone) ? Purify::clean($request->phone) : NULL,
            'fax' => Purify::clean($request->fax) ? Purify::clean($request->fax) : NULL,
            'about_customs' => ($request->about_customs) ? ($request->about_customs) : NULL,
            'customs_specs' => ($request->customs_specs) ? ($request->customs_specs) : NULL,
            'photo' => $save_url,
            'banner_photo' => $banner_save_url,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect(route('specialist.all.customsoutlet'))->with('success', 'آدرس مورد نظر با موفقیت اضافه گردید.');
    }

    public function SpeclialistEditCustomsOutlet($outlet_id)
    {
        $id = Auth::user()->id;
        $specialistData = User::find($id);

        $outlet = Customsoutlet::find(Purify::clean($outlet_id));

        return view('specialist.customsoutlets.specialist_customs_edit', compact('specialistData', 'outlet'));
    }
    public function SpeclialistUpdateCustomsOutlet(Request $request)
    {
        $outlet_id = Purify::clean($request->outlet_id);
        $outlet = Customsoutlet::find($outlet_id);

        $incomingFields = $request->validate([
            'country' => 'required',
            'province' => 'required',
            'name' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'country.required' => 'لطفا کشور محل انتخاب شده را وارد نمایید.',
            'province.required' => 'لطفا استان محل انتخاب شده را وارد نمایید.',
            'name.required' => 'لطفا نام منطقه انتخاب شده را وارد نمایید.',
            'address.required' => 'لطفا آدرس محل انتخاب شده را وارد نمایید.',
            'latitude.required' => 'لطفا عرض جغرافیایی را وارد نمایید.',
            'longitude.required' => 'لطفا طول جغرافیایی را وارد نمایید.',
        ]);

        $outlet->country = Purify::clean($incomingFields['country']);
        $outlet->province = Purify::clean($incomingFields['province']);
        $outlet->name = Purify::clean($incomingFields['name']);
        $outlet->address = Purify::clean($incomingFields['address']);
        $outlet->longitude = Purify::clean($request->longitude);
        $outlet->latitude = Purify::clean($request->latitude);
        $outlet->customs_type = Purify::clean($request->customs_type);
        $outlet->postalcode = Purify::clean($request->postalcode);
        $outlet->phone = Purify::clean($request->phone);
        $outlet->fax = Purify::clean($request->fax);
        $outlet->about_customs = ($request->about_customs);
        $outlet->customs_specs = ($request->customs_specs);

        if (Purify::clean($request->file('photo'))) {
            if ($outlet->photo != null) {
                unlink($outlet->photo);
            }
            $image = Purify::clean($request->photo);
            $unique_image_name = hexdec(uniqid()) . time();
            $name_gen = $unique_image_name . '.' . 'jpg';
            Image::make($image)->fit(160)->encode('jpg')->save('storage/upload/customs_images/' . $name_gen);
            $save_url = 'storage/upload/customs_images/' . $name_gen;
            $outlet->photo = $save_url;
        }
        if (Purify::clean($request->file('banner_photo'))) {
            if ($outlet->banner_photo != null) {
                unlink($outlet->banner_photo);
            }
            $banner_image = Purify::clean($request->banner_photo);
            $unique_banner_image_name = hexdec(uniqid()) . time();
            $banner_name_gen = $unique_banner_image_name . '.' . 'jpg';
            Image::make($banner_image)->fit(930, 446)->encode('jpg')->save('storage/upload/customs_images/' . $banner_name_gen);
            $banner_save_url = 'storage/upload/customs_images/' . $banner_name_gen;
            $outlet->banner_photo = $banner_save_url;
        }

        $outlet->save();

        return redirect(route('specialist.all.customsoutlet'))->with('success', 'آدرس مورد نظر با موفقیت به روز رسانی گردید');
    }

    public function SpeclialistDeleteCustomsOutlet($outlet_id)
    {
        $outlet_item = Customsoutlet::findOrFail(Purify::clean($outlet_id));
        if ($outlet_item->photo != null) {
            unlink($outlet_item->photo);
        }
        if ($outlet_item->banner_photo != null) {
            unlink($outlet_item->banner_photo);
        }
        $outlet_item->delete();

        return redirect(route('specialist.all.customsoutlet'))->with('success', 'آدرس مورد نظر با موفقیت حذف گردید.');
    }


}