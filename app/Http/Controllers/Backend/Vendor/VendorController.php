<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\File;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\File as LaravelFile;

class VendorController extends Controller
{
    public function VendorDashboard()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.index', compact('vendorData'));
    } //End method

    public function VendorLogin()
    {
        return view('vendor.vendor_login');
    } //End method

    public function VendorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //End method

    public function VendorProfile()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        $vendor_sector_arr = explode(",", $vendorData->vendor_sector);
        $vendor_sector_cat_arr = [];
        foreach ($vendor_sector_arr as $vendor_sector_item) {
            $vendor_sector_cat_arr[] = Category::find($vendor_sector_item);
        }

        return view('vendor.vendor_profile_view', compact('vendorData', 'vendor_sector_cat_arr'));
    } //End method

    public function VendorProfileSettings()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        $parentCategories = Category::where('parent', 0)->latest()->get()->reverse();

        // category for filter
        $vendor_sector_cat_arr_selected =  explode(",", $vendorData->vendor_sector);
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }
        // category for filter
       
        return view('vendor.vendor_profile_settings', compact('vendorData', 'parentCategories', 'filter_category_array', 'vendor_sector_cat_arr_selected'));
    } //End method

    public function VendorProfileStore(Request $request)
    {
        $incomingFields = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'shop_address' => 'required',
            'shop_name' => 'required',
            'home_postalcode' => 'required',
        ], [
            'firstname.required' => 'لطفا نام خود را وارد نمایید.',
            'lastname.required' => 'لطفا نام خانوادگی خود را وارد نمایید.',
            'shop_address.required' => 'لطفا آدرس فروشگاه/شرکت خود را وارد نمایید.',
            'shop_name.required' => 'لطفا نام فروشگاه/شرکت خود را وارد نمایید.',
            'home_postalcode.required' => 'لطفا کد پستی خود را وارد نمایید.',
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

            if (Purify::clean($request->verification_company_registration_number) == null) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا شماره ثبت شرکت را وارد نمایید.');
            }

            if (Purify::clean($request->verification_company_national_code) == null) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا شماره شناسه شرکت را وارد نمایید.');
            }

            if (strlen(Purify::clean($request->verification_company_national_code)) != 11 || ! is_numeric(Purify::clean($request->verification_company_national_code))) {
                session()->flashInput($request->input());
                return back()->with('error', 'لطفا شماره شناسه صحیح وارد نمایید.');
            }

            // if (Purify::clean($request->verification_company_economic_code) == null) {
            //     session()->flashInput($request->input());
            //     return back()->with('error', 'لطفا کد اقتصادی شرکت را وارد نمایید.');
            // }
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

        if (Purify::clean($incomingFields['home_postalcode'])) {
            $data->home_postalcode = Purify::clean($incomingFields['home_postalcode']);
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

        if (Purify::clean($request->agent_name)) {
            $data->agent_name = Purify::clean($request->agent_name);
        }

        if (Purify::clean($request->file('photo'))) {
            $file = Purify::clean($request->file('photo'));

            if ($data->photo != null) {
                unlink('storage/upload/vendor_images/' . $data->photo);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(160)->encode('jpg')->save('storage/upload/vendor_images/' . $filename);
            $data['photo'] = $filename;
        }

        if (Purify::clean($request->file('store_banner'))) {
            $file = $request->file('store_banner');

            if ($data->store_banner != null) {
                unlink('storage/upload/vendor_images/' . $data->store_banner);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(930, 446)->encode('jpg')->save('storage/upload/vendor_images/' . $filename);
            $data['store_banner'] = $filename;
        }

        // بخش احراز هویت
        // ابتدا آی دی کاربر تامین کننده در جدول وندور ثبت می شود
        $vendor_object = Vendor::firstOrCreate([
            'user_id' => $id,
        ]);

        // شماره ثبت شرکت
        if (Purify::clean($request->verification_company_registration_number)) {
            $data->vendor->verification_company_registration_number = Purify::clean($request->verification_company_registration_number);
        }

        // شماره شناسه ملی شرکت
        if (Purify::clean($request->verification_company_national_code)) {
            $data->vendor->verification_company_national_code = Purify::clean($request->verification_company_national_code);
        }

        // کد اقتصادی شرکت
        if (Purify::clean($request->verification_company_economic_code)) {
            $data->vendor->verification_company_economic_code = Purify::clean($request->verification_company_economic_code);
        }

        // آدرس بر اساس استعلام سامانه ای وت
        if (Purify::clean($request->verification_company_evat_address)) {
            $data->vendor->verification_company_evat_address = Purify::clean($request->verification_company_evat_address);
        }

        // اینجا پوشه مدارک احراز هویت با توجه به نوع کاربر و شماره اش ساخته میشود
        if (! LaravelFile::exists(Storage::path("secret/identity_verification_documents/$data->role"))) {
            LaravelFile::makeDirectory(Storage::path("secret/identity_verification_documents/$data->role"));
        }
        if (! LaravelFile::exists(Storage::path("secret/identity_verification_documents/$data->role/$id"))) {
            LaravelFile::makeDirectory(Storage::path("secret/identity_verification_documents/$data->role/$id"));
        }

        // بارگذاری تصویر گواهی ارزش افزوده
        if (Purify::clean($request->file('verification_company_value_added_certificate'))) {
            $file = Purify::clean($request->file('verification_company_value_added_certificate'));
            if ($data->vendor->verification_company_value_added_certificate != null) {
                unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->vendor->verification_company_value_added_certificate));
            }
            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';
            Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
            $data->vendor->verification_company_value_added_certificate = $filename;
        }

        // تصویر ثبت نام مودیان مالیات بر ارزش افزوده
        if (Purify::clean($request->file('verification_company_value_added_registration_image'))) {
            $file = Purify::clean($request->file('verification_company_value_added_registration_image'));
            if ($data->vendor->verification_company_value_added_registration_image != null) {
                unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->vendor->verification_company_value_added_registration_image));
            }
            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';
            Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
            $data->vendor->verification_company_value_added_registration_image = $filename;
        }

        // تصویر کارت ملی شخص حقیقی
        if (Purify::clean($request->file('verification_company_national_card_image'))) {
            $file = Purify::clean($request->file('verification_company_national_card_image'));
            if ($data->vendor->verification_company_national_card_image != null) {
                unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->vendor->verification_company_national_card_image));
            }
            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';
            Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
            $data->vendor->verification_company_national_card_image = $filename;
        }

        

        // تصویر آخرین تغییرات روزنامه رسمی
        if (Purify::clean($request->file('verification_company_official_gazette_image'))) {
            $file = Purify::clean($request->file('verification_company_official_gazette_image'));
            if ($data->vendor->verification_company_official_gazette_image != null) {
                unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->vendor->verification_company_official_gazette_image));
            }
            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';
            Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
            $data->vendor->verification_company_official_gazette_image = $filename;
        }

        // تصویر آگهی تأسیس شرکت
        if (Purify::clean($request->file('verification_company_establishment_announcement'))) {
            $file = Purify::clean($request->file('verification_company_establishment_announcement'));
            if ($data->vendor->verification_company_establishment_announcement != null) {
                unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->vendor->verification_company_establishment_announcement));
            }
            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';
            Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
            $data->vendor->verification_company_establishment_announcement = $filename;
        }

        // تصویر آخرین پروانه بهره برداری
        if (Purify::clean($request->file('verification_company_operation_license'))) {
            $file = Purify::clean($request->file('verification_company_operation_license'));
            if ($data->vendor->verification_company_operation_license != null) {
                unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $data->vendor->verification_company_operation_license));
            }
            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';
            Image::make($file)->encode('jpg')->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));
            $data->vendor->verification_company_operation_license = $filename;
        }
        
        // دریافت آرایه اطلاعات مربوط به فرم ریپیتر صاحبین حق امضا
        if(!in_array(null, $request->vendor_signature_firstname)
        && !in_array(null, $request->vendor_signature_lastname)
        && $request->verification_company_national_card_image_all != null
        && !in_array(null, $request->verification_company_national_card_image_all)
        && count($request->vendor_signature_firstname) == count($request->vendor_signature_lastname)
        && count($request->vendor_signature_lastname) == count($request->verification_company_national_card_image_all)
        ) {
            $signature_firstname_array = Purify::clean($request->vendor_signature_firstname);
            $signature_lastname_array = Purify::clean($request->vendor_signature_lastname);
            $signature_national_code_array = Purify::clean($request->vendor_signature_national_code);
            
            if(!in_array(null, $data->vendor->vendor_signatures->pluck("verification_company_national_card_image_all")->toArray())) {
                foreach ($data->vendor->vendor_signatures as $vendor_signature_item) {
                    unlink(Storage::path("secret/identity_verification_documents/$data->role/$id/" . $vendor_signature_item->verification_company_national_card_image_all));
                }  
            }

            $data->vendor->vendor_signatures()->delete();

            foreach ($request->vendor_signature_firstname as $key => $signature_firstname_item) {

                $signature_item_created = $data->vendor->vendor_signatures()->create([
                    'vendor_id' => $vendor_object->id,
                    'vendor_signature_firstname' => $signature_firstname_array[$key],
                    'vendor_signature_lastname' => $signature_lastname_array[$key],
                    'vendor_signature_national_code' => $signature_national_code_array[$key],
                ]);

                // تصویر کارت ملی صاحبان حق امضا
                $unique_image_name = hexdec(uniqid());
                $filename = $unique_image_name . '.' . 'jpg';
                Image::make($request->verification_company_national_card_image_all[$key])->encode('jpg')->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(Storage::path("secret/identity_verification_documents/$data->role/$id/$filename"));

                $signature_item_created->verification_company_national_card_image_all = $filename;
                $signature_item_created->save();
            }
        }

        $data->vendor->save();
        $data->save();

        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');

    } //End method

    public function VendorProfileFieldOfActivity() {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        $parentCategories = Category::where('parent', 0)->latest()->get()->reverse();

        // category for filter
        $vendor_sector_cat_arr_selected =  explode(",", $vendorData->vendor_sector);
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }
        // category for filter

        return view('vendor.vendor_profile_field_of_activity', compact('vendorData', 'parentCategories', 'filter_category_array', 'vendor_sector_cat_arr_selected'));
    }

    public function VendorProfileFieldOfActivityStore(Request $request) {

        $data = auth()->user();

        if (Purify::clean($request->vendor_sector) != null) {
            $data->vendor_sector = implode(',', Purify::clean($request->vendor_sector));
        } else {
            return back()->with('error', 'لطفا زمینه فعالیت فروشنده را مشخص نمایید');
        }

        $data->save();
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    }

    public function VendorProfileFinancialStatement()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);
        return view('vendor.vendor_profile_financial_statement', compact('vendorData'));
    }

    public function VendorProfileFinancialStatementStore(Request $request)
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

    public function VendorAboutPage()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.vendor_pages.about_vendor', compact('vendorData'));
    } //End method

    public function VendorStoreAboutPage(Request $request)
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);
        $data = User::find($id);

        $incomingFields = $request->validate([
            'vendor_description' => 'required',
        ], [
            'vendor_description.required' => 'لطفا توضیحات فروشگاه را وارد نمایید.',
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
            return back()->with('success', 'اطلاعات با موفقیت ذخیره و پس از تایید کارشناس در صفحه هر محصول نمایش داده خواهد شد.');
        } else {
            return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
        }

    } //End method

    // media functions begin
    public function VendorMediaFiles()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        $files = File::latest()->get();

        return view('vendor.media.files', compact('vendorData', 'files'));
    }

    public function VendorMediaAddFiles()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.media.add', compact('vendorData'));
    }

    public function VendorMediaStoreFiles(Request $request)
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

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

        $actualfileName = Purify::clean($incomingFields['file_upload']->getClientOriginalName());
        $fileSize = Purify::clean($incomingFields['file_upload']->getSize());

        $image = Purify::clean($incomingFields['file_upload']);
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

        return redirect(route('vendor.media.files'))->with('success', 'فایل مورد نظر با موفقیت بارگذاری گردید.');
    }

    public function VendorDeleteFile($id)
    {
        $user_id = Auth::user()->id;
        $file = File::findOrFail(Purify::clean($id));
        $img = $file->fileName;

        if ($file->user_id == $user_id) {
            unlink($img);
            File::findOrFail($id)->delete();
        } else {
            return redirect(route('vendor.media.files'))->with('error', 'شما اجازه حذف این فایل را ندارید!');
        }

        return redirect(route('vendor.media.files'))->with('success', 'فایل مورد نظر با موفقیت حذف گردید.');
    }
    // media functions ends
}