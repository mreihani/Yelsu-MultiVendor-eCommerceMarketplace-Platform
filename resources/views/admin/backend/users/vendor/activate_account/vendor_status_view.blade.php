@extends('admin.admin_dashboard')
@section('admin')


<div id="kt_app_content" class="app-content flex-column-fluid">

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <!--begin::details نمایش-->
        <div class="card mb-5 mb-xl-10 mt-9" id="kt_profile_details_view">
           
            <!--begin::کارت body-->
            <div class="card-body p-9">
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تصویر آواتار</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <span class="fw-bold fs-6 text-gray-800">
                            <img width="125" height="125" src="{{!empty($data->photo) ? url('storage/upload/vendor_images/' . $data->photo) : url('storage/upload/no_image.jpg') }}" alt="">
                        </span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تصویر سربرگ فروشگاه</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <span class="fw-bold fs-6 text-gray-800">
                            <img width="400" height="194" src="{{!empty($data->store_banner) ? url('storage/upload/vendor_images/' . $data->store_banner) : url('storage/upload/no_image_store.jpg') }}" alt="">
                        </span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">نام کامل</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <span class="fw-bold fs-6 text-gray-800">{{$data->firstname . " " . $data->lastname}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">نام کاربری</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        {{$data->username ?? 'ثبت نشده'}}
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">ایمیل</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->email ?? 'ثبت نشده'}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">شماره تلفن
                    </label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 d-flex align-items-center">
                        @if($data->home_phone)
                            <span class="fw-bold fs-6 text-gray-800 me-2">{{$data->home_phone ?? 'ثبت نشده'}}</span>
                        @else
                            ثبت نشده    
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">نام فروشگاه / شرکت</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->shop_name ?? 'ثبت نشده'}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">آدرس فروشگاه / شرکت</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->shop_address ?? 'ثبت نشده'}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">زمینه فعالیت فروشگاه
                    
                    </label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        @foreach($vendor_sector_cat_arr as $vendor_sector_item)
                            <div class="badge badge-light-primary fw-bold">
                                <a href="{{route('shop.category',['id'=> $vendor_sector_item->id])}}">
                                    {{$vendor_sector_item->category_name}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">شخص حقیقی یا حقوقی</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        @if($data->person_type == "haghighi") 
                            <span class="fw-semibold text-gray-800 fs-6">حقیقی</span>
                        @elseif($data->person_type == "hoghoghi")
                            <span class="fw-semibold text-gray-800 fs-6">حقوقی</span>
                        @else
                            <span class="fw-semibold text-gray-800 fs-6">ثبت نشده</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">کد ملی</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->national_code ?? 'ثبت نشده'}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">شماره ثبت شرکت</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->vendor ? $data->vendor->verification_company_registration_number : 'ثبت نشده'}}</span>
                        
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">شماره شناسه ملی شرکت</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->vendor ? $data->vendor->verification_company_national_code : 'ثبت نشده'}}</span>
                        
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">کد اقتصادی شرکت</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->vendor ? $data->vendor->verification_company_economic_code : 'ثبت نشده'}}</span>
                        
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">آدرس بر اساس استعلام سامانه evat</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->vendor ? $data->vendor->verification_company_evat_address : 'ثبت نشده'}}</span>
                        
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">مشخصات صاحبین حق امضا مطابق با روزنامه رسمی</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        @if($data->vendor && count($data->vendor->vendor_signatures))
                            @foreach ($data->vendor->vendor_signatures as $signature_item)
                                <span class="fw-semibold text-gray-800 fs-6">
                                    {{$signature_item->vendor_signature_firstname}} {{$signature_item->vendor_signature_lastname}} {{$signature_item->vendor_signature_national_code}}
                                </span>
                                <br>
                            @endforeach
                        @else 
                            <span class="fw-semibold text-gray-800 fs-6">
                                ثبت نشده
                            </span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">نام نماینده</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->agent_name ?? 'ثبت نشده'}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">شماره شبا</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->shaba_number ?? 'ثبت نشده'}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">شماره کارت</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->cart_number ?? 'ثبت نشده'}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">نام و نام خانوادگی صاحب حساب / شرکت</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->cart_owner_info ?? 'ثبت نشده'}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">نام بانک</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->cart_bank_info ?? 'ثبت نشده'}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
               
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تصویر گواهی ارزش افزوده</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        @if($data->vendor && $data->vendor->verification_company_value_added_certificate)
                            <a class="d-flex justify-content-start" href="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_value_added_certificate])}}">
                                <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_value_added_certificate])}}" alt="">
                            </a>
                        @else 
                            <span class="fw-semibold text-gray-800 fs-6">ثبت نشده</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تصویر ثبت نام مودیان مالیات بر ارزش افزوده</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        @if($data->vendor && $data->vendor->verification_company_value_added_registration_image)
                            <a class="d-flex justify-content-start" href="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_value_added_registration_image])}}">
                                <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_value_added_registration_image])}}" alt="">
                            </a>
                        @else 
                            <span class="fw-semibold text-gray-800 fs-6">ثبت نشده</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تصویر پشت و روی کارت ملی شخص حقیقی</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        @if($data->vendor && $data->vendor->verification_company_national_card_image)
                            <a class="d-flex justify-content-start" href="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_national_card_image])}}">
                                <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_national_card_image])}}" alt="">
                            </a>
                        @else 
                            <span class="fw-semibold text-gray-800 fs-6">ثبت نشده</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تصویر پشت و روی کارت ملی شخص حقوقی</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        @if($data->vendor && $data->vendor->verification_company_national_card_image_all)
                            <a class="d-flex justify-content-start" href="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_national_card_image_all])}}">
                                <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_national_card_image_all])}}" alt="">
                            </a>
                        @else 
                            <span class="fw-semibold text-gray-800 fs-6">ثبت نشده</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تصویر آخرین تغییرات روزنامه رسمی</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        @if($data->vendor && $data->vendor->verification_company_official_gazette_image)
                            <a class="d-flex justify-content-start" href="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_official_gazette_image])}}">
                                <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_official_gazette_image])}}" alt="">
                            </a>
                        @else 
                            <span class="fw-semibold text-gray-800 fs-6">ثبت نشده</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تصویر آگهی تأسیس شرکت</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        @if($data->vendor && $data->vendor->verification_company_establishment_announcement)
                            <a class="d-flex justify-content-start" href="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_establishment_announcement])}}">
                                <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_establishment_announcement])}}" alt="">
                            </a>
                        @else 
                            <span class="fw-semibold text-gray-800 fs-6">ثبت نشده</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تصویر پروانه بهره برداری</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        @if($data->vendor && $data->vendor->verification_company_operation_license)
                            <a class="d-flex justify-content-start" href="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_operation_license])}}">
                                <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$data->role, $data->id, $data->vendor->verification_company_operation_license])}}" alt="">
                            </a>
                        @else 
                            <span class="fw-semibold text-gray-800 fs-6">ثبت نشده</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

            </div>
            <!--end::کارت body-->
        </div>
        <!--end::details نمایش-->
        
    </div>
    <!--end::Content container-->
</div>

    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.js')}}"></script>
 
@endsection