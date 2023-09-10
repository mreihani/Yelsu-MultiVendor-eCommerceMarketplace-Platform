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
                            <img width="125" height="125" src="{{!empty($data->photo) ? url('storage/upload/driver_images/' . $data->photo) : url('storage/upload/driver_logo.png') }}" alt="">
                        </span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تصویر سربرگ شرکت باربری</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <span class="fw-bold fs-6 text-gray-800">
                            <img width="400" height="194" src="{{!empty($data->store_banner) ? url('storage/upload/driver_images/' . $data->store_banner) : url('storage/upload/freghtage_banner.jpg') }}" alt="">
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
                    <label class="col-lg-6 fw-semibold text-muted">شماره شناسه شرکت</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->company_number ?? 'ثبت نشده'}}</span>
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
                    <label class="col-lg-6 fw-semibold text-muted">زمینه فعالیت شرکت باربری</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        @if($data->driver->type_temp)
                            @foreach($driver_sector_arr as $driver_sector_item)
                                <div class="badge badge-light-primary fw-bold">
                                    {{$driver_sector_item == 1 ? "زمینی" : ''}}
                                    {{$driver_sector_item == 2 ? "جاده ای" : ''}}
                                    {{$driver_sector_item == 3 ? "شهری" : ''}}
                                    {{$driver_sector_item == 4 ? "بین شهری" : ''}}
                                    {{$driver_sector_item == 5 ? "بین المللی" : ''}}
                                    {{$driver_sector_item == 6 ? "ریلی" : ''}}
                                    {{$driver_sector_item == 7 ? "هوایی" : ''}}
                                    {{$driver_sector_item == 8 ? "آبی" : ''}}
                                    {{$driver_sector_item == 9 ? "محموله ترافیکی" : ''}}
                                </div>
                            @endforeach
                        @else    
                            <span>ثبت نشده</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">دسته بندی مرتبط</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        @if($data->driver->category_id_temp)
                            @foreach(explode(",", $data->driver->category_id_temp) as $category_id)
                                @if(App\Models\Category::find($category_id))
                                    <div class="badge badge-light-primary fw-bold">
                                        {{App\Models\Category::find($category_id)->category_name}}
                                    </div>
                                @endif
                            @endforeach
                        @else    
                            <span>ثبت نشده</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-6 fw-semibold text-muted">تأمین کننده مرتبط با باربری</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row">
                        @if($data->driver->vendor_id_temp)
                            @foreach(explode(",", $data->driver->vendor_id_temp) as $vendor_id)
                                <div class="badge badge-light-primary fw-bold">
                                    {{App\Models\User::find($vendor_id)->shop_name}}
                                </div>
                            @endforeach
                        @else    
                            <span>ثبت نشده</span>
                        @endif
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
               
            </div>
            <!--end::کارت body-->
        </div>
        <!--end::details نمایش-->
        
    </div>
    <!--end::Content container-->
</div>

    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.js')}}"></script>
 
@endsection