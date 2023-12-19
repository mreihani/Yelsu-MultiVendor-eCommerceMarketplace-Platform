<?php

namespace App\Http\Controllers\Backend\Driver;

use App\Models\File;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Freightagetype;
use App\Http\Controllers\Controller;
use App\Models\Freightageloadertype;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as LaravelFile;

class DriverController extends Controller
{
    public function DriverDashboard()
    {
        $id = Auth::user()->id;
        $driverData = User::find($id);

        return view('driver.index', compact('driverData'));
    } //End method
    public function DriverDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //End method

    public function DriverProfile()
    {
        $id = Auth::user()->id;
        $driverData = User::find($id);

        $driver_sector_arr = explode(",", $driverData->driver->type);

        return view('driver.driver_profile_view', compact('driverData', 'driver_sector_arr'));
    } //End method

    public function DriverProfileSettings()
    {
        $id = Auth::user()->id;
        $driverData = User::find($id);

        $driver_sector_arr = explode(",", $driverData->driver->type);

        return view('driver.driver_profile_settings', compact('driverData', 'driver_sector_arr'));
    } //End method

    public function DriverProfileStore(Request $request)
    {
        $incomingFields = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'shop_address' => 'required',
            'photo' => ['image', 'max:5000'],
            'store_banner' => ['image', 'max:5000'],
            'verification_id_card' => ['image', 'max:5000'],
            'verification_applicant_image' => ['image', 'max:5000'],
            'verification_company_documents' => ['image', 'max:5000'],
            'verification_company_extra_documents' => ['image', 'max:5000'],
        ], [
            'firstname.required' => 'لطفا نام خود را وارد نمایید.',
            'lastname.required' => 'لطفا نام خانوادگی خود را وارد نمایید.',
            'shop_address.required' => 'لطفا آدرس محل سکونت را وارد نمایید.',
            'photo.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'photo.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
            'store_banner.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'store_banner.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
            'verification_id_card.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'verification_id_card.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
            'verification_applicant_image.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'verification_applicant_image.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
            'verification_company_documents.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'verification_company_documents.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
            'verification_company_extra_documents.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'verification_company_extra_documents.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
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

        // if (Purify::clean($incomingFields['shop_name'])) {
        //     $data->shop_name = Purify::clean($incomingFields['shop_name']);
        // }

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
                unlink('storage/upload/driver_images/' . $data->photo);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(160)->encode('jpg')->save('storage/upload/driver_images/' . $filename);
            $data['photo'] = $filename;
        }

        if (Purify::clean($request->file('store_banner'))) {
            $file = Purify::clean($request->file('store_banner'));

            if ($data->store_banner != null) {
                unlink('storage/upload/driver_images/' . $data->store_banner);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(930, 446)->encode('jpg')->save('storage/upload/driver_images/' . $filename);
            $data['store_banner'] = $filename;
        }

        // اینجا پوشه مدارک احراز هویت با توجه به نوع کاربر و شماره اش ساخته میشود
        if (! LaravelFile::exists(Storage::path("secret/identity_verification_documents/$data->role"))) {
            LaravelFile::makeDirectory(Storage::path("secret/identity_verification_documents/$data->role"));
        }
        if (! LaravelFile::exists(Storage::path("secret/identity_verification_documents/$data->role/$id"))) {
            LaravelFile::makeDirectory(Storage::path("secret/identity_verification_documents/$data->role/$id"));
        }

        if (Purify::clean($request->file('verification_id_card'))) {
            $file = Purify::clean($request->file('verification_id_card'));
            if ($data->driver->verification_id_card != null) {
                unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->driver->verification_id_card));
            }
            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';
            Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
            $data->driver->verification_id_card = $filename;
            $data->driver->save();
        }

        if (Purify::clean($request->file('verification_applicant_image'))) {
            $file = Purify::clean($request->file('verification_applicant_image'));
            if ($data->driver->verification_applicant_image != null) {
                unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->driver->verification_applicant_image));
            }
            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';
            Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
            $data->driver->verification_applicant_image = $filename;
            $data->driver->save();
        }

        // if (Purify::clean($request->file('verification_company_activity_license'))) {
        //     $file = Purify::clean($request->file('verification_company_activity_license'));
        //     if ($data->driver->verification_company_activity_license != null) {
        //         unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->driver->verification_company_activity_license));
        //     }
        //     $unique_image_name = hexdec(uniqid());
        //     $filename = $unique_image_name . '.' . 'jpg';
        //     Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
        //     $data->driver->verification_company_activity_license = $filename;
        //     $data->driver->save();
        // }

        // if (Purify::clean($request->file('verification_company_establishment_announcement'))) {
        //     $file = Purify::clean($request->file('verification_company_establishment_announcement'));
        //     if ($data->driver->verification_company_establishment_announcement != null) {
        //         unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->driver->verification_company_establishment_announcement));
        //     }
        //     $unique_image_name = hexdec(uniqid());
        //     $filename = $unique_image_name . '.' . 'jpg';
        //     Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
        //     $data->driver->verification_company_establishment_announcement = $filename;
        //     $data->driver->save();
        // }

        // if (Purify::clean($request->file('verification_company_value_added_certificate'))) {
        //     $file = Purify::clean($request->file('verification_company_value_added_certificate'));
        //     if ($data->driver->verification_company_value_added_certificate != null) {
        //         unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->driver->verification_company_value_added_certificate));
        //     }
        //     $unique_image_name = hexdec(uniqid());
        //     $filename = $unique_image_name . '.' . 'jpg';
        //     Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
        //     $data->driver->verification_company_value_added_certificate = $filename;
        //     $data->driver->save();
        // }

        $data->save();

        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');

    } //End method

    public function profileFieldOfActivity()
    {
        $id = Auth::user()->id;
        $driverData = User::find($id);

        // category for filter
        $vendor_sector_cat_arr = Category::where('parent', 0)->get();

        $filter_category_array = [];
        foreach ($vendor_sector_cat_arr as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }
        // category for filter

        $vendorsName = User::where('role', 'vendor')->where('status', 'active')->get();

        $status = $driverData->driver->status;

        if ($status == "active") {
            $driver_sector_arr = explode(",", $driverData->driver->type);
            $category_sector_cat_arr_selected = explode(',', $driverData->driver->category_id);
            $vendor_arr_selected = explode(',', $driverData->driver->vendor_id);
            $loader_type_arr_selected = explode(',', $driverData->driver->freightage_loader_type);
        } else {
            $driver_sector_arr = explode(",", $driverData->driver->type_temp);
            $category_sector_cat_arr_selected = explode(',', $driverData->driver->category_id_temp);
            $vendor_arr_selected = explode(',', $driverData->driver->vendor_id_temp);
            $loader_type_arr_selected = explode(',', $driverData->driver->freightage_loader_type_temp);
        }

        $driverTypeArray = Freightagetype::where('freightagetype_title', 'road')->get();
        $driverLoaderTypeRoadArray = Freightageloadertype::whereRelation('freightageType', 'freightagetype_title', '=', 'road')->get();
       
        return view('driver.driver_profile_field_of_activity', compact('driverData', 'driver_sector_arr', 'vendor_sector_cat_arr', 'filter_category_array', 'vendorsName', 'category_sector_cat_arr_selected', 'vendor_arr_selected', 'status', 'loader_type_arr_selected', 'driverTypeArray', 'driverLoaderTypeRoadArray'));
    } //End method

    public function profileFieldOfActivityStore(Request $request)
    {
        $incomingFields = $request->validate([
            'type' => 'required',
            'loader_type' => 'required',
            'category_id' => 'required',
        ], [
            'type.required' => 'لطفا زمینه فعالیت باربری را انتخاب نمایید.',
            'loader_type.required' => 'لطفا نوع بارگیر در حمل جاده ای را انتخاب نمایید.',
            'category_id.required' => 'لطفا حداقل یک دسته بندی مرتبط با باربری را انتخاب نمایید.',
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);

        // اگر کاربری تنظیماتی رو دوباره اعمال کرد نباید اتفاقی بیفته
        if (Purify::clean($incomingFields['type']) != explode(',', $data->driver->type) || Purify::clean($incomingFields['category_id']) != explode(',', $data->driver->category_id) || Purify::clean($request->vendor_id) != explode(',', $data->driver->vendor_id) || Purify::clean($request->loader_type) != explode(',', $data->driver->freightage_loader_type)) {
            $data->driver->type_temp = implode(',', Purify::clean($incomingFields['type']));
            $data->driver->category_id_temp = implode(',', Purify::clean($incomingFields['category_id']));
            $data->driver->vendor_id_temp = $request->vendor_id ? implode(',', Purify::clean($request->vendor_id)) : NULL;
            $data->driver->freightage_loader_type_temp = $request->loader_type ? implode(',', Purify::clean($request->loader_type)) : NULL;
            $data->driver->status = "inactive";

            $data->driver->save();
        }

        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    } //End method

    public function DriverProfileFinancialStatement()
    {
        $id = Auth::user()->id;
        $driverData = User::find($id);
        return view('driver.driver_profile_financial_statement', compact('driverData'));
    }
    public function DriverProfileFinancialStatementStore(Request $request)
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

    public function DriverAboutPage()
    {
        $id = Auth::user()->id;
        $driverData = User::find($id);

        return view('driver.driver_pages.about_driver', compact('driverData'));
    } //End method

    public function DriverStoreAboutPage(Request $request)
    {
        $id = Auth::user()->id;
        $driverData = User::find($id);
        $data = User::find($id);

        $incomingFields = $request->validate([
            'vendor_description' => 'required',
        ], [
            'vendor_description.required' => 'لطفا توضیحات باربری را وارد نمایید.',
        ]);

        if ($data->vendor_description == ($request->vendor_description)) {
            if ($data->vendor_description_status == 'active') {
                $data->vendor_description_status = 'active';
                $product_verification_changed = false;
            } else {
                $data->vendor_description_status = 'inactive';
                $product_verification_changed = true;
            }
        } else {
            $data->vendor_description_status = 'inactive';
            $product_verification_changed = true;
        }

        $data->vendor_description = ($incomingFields['vendor_description']);

        $data->save();

        if ($product_verification_changed == true) {
            return back()->with('success', 'اطلاعات با موفقیت ذخیره و پس از تایید کارشناس در صفحه شرکت باربری نمایش داده خواهد شد.');
        } else {
            return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
        }

    } //End method

    public function DriverMediaFiles()
    {
        $id = Auth::user()->id;
        $driverData = User::find($id);

        $files = File::latest()->get();

        return view('driver.media.files', compact('driverData', 'files'));
    }
    public function DriverMediaAddFiles()
    {
        $id = Auth::user()->id;
        $driverData = User::find($id);

        return view('driver.media.add', compact('driverData'));
    }

    public function DriverMediaStoreFiles(Request $request)
    {

        $id = Auth::user()->id;
        $driverData = User::find($id);

        $incomingFields = $request->validate([
            'file_upload' => ['required', 'image', 'max:5000'],
        ], [
            'file_upload.required' => 'لطفا تصویر را بارگذاری نمایید.',
            'file_upload.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'file_upload.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
        ]);

        if (! LaravelFile::exists('storage/upload/media_files/' . $id)) {
            LaravelFile::makeDirectory('storage/upload/media_files/' . $id);
        }

        $actualfileName = $incomingFields['file_upload']->getClientOriginalName();
        $fileSize = $incomingFields['file_upload']->getSize();

        $image = $incomingFields['file_upload'];
        $name_gen = hexdec(uniqid()) . '.' . 'jpg';
        Image::make($image)->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg')->save('storage/upload/media_files/' . $id . '/' . $name_gen);

        $save_url = 'storage/upload/media_files/' . $id . '/' . $name_gen;


        File::insert([
            'fileName' => $save_url,
            'user_id' => $id,
            'actualfileName' => $actualfileName,
            'fileSize' => $fileSize / 1000,
        ]);

        return redirect(route('driver.media.files'))->with('success', 'فایل مورد نظر با موفقیت بارگذاری گردید.');
    }

    public function DriverDeleteFile($id)
    {
        $user_id = Auth::user()->id;
        $file = File::findOrFail($id);
        $img = $file->fileName;

        if ($file->user_id == $user_id) {
            unlink($img);
            File::findOrFail($id)->delete();
        } else {
            return redirect(route('driver.media.files'))->with('error', 'شما اجازه حذف این فایل را ندارید!');
        }

        return redirect(route('driver.media.files'))->with('success', 'فایل مورد نظر با موفقیت حذف گردید.');
    }
    // media functions ends

}