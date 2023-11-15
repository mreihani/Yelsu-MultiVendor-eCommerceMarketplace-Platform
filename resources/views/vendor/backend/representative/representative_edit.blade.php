@extends('vendor.vendor_dashboard')
@section('vendor')

<script>
    let person_type = {!! json_encode($representative->user->person_type) !!}
</script>

{{-- این استایل فقط برای جدول دیتاتیبلز این صفحه است --}}
<link href="{{asset('frontend/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">

    @if(session()->has('success'))
        <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5  mt-5 mb-5">
            <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
        </div>
    @endif

    @if(session()->has('error'))
        <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
            <h4 class="alert-title" style="color:#ffa800">
                <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                {{session('error')}}
        </div>
    @endif

    @foreach($errors->all() as $error)
        <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
            <h4 class="alert-title" style="color:#ffa800">
                <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                {{$error}}
        </div>
    @endforeach

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">ویرایش کاربر </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">
                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">خانه</a>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">مدیریت کاربران </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">ویرایش کاربر</li>
                        <!--end::آیتم-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <form class="form" method="POST" action={{route('vendor.update.user.representative')}}>
                    <input type="hidden" name="representative_id" value="{{$representative->id}}">
                    @csrf
                    <!--begin::کارت-->
                    <div class="card mb-5 mb-xl-10">
                        <!--begin::کارت header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                            <!--begin::کارت title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">مشخصات کاربر</h3>
                            </div>
                            <!--end::کارت title-->
                        </div>
                        <!--begin::کارت header-->
                        <!--begin::Content-->
                        <div class="collapse show">
                            <!--begin::کارت body-->
                            <div class="card-body border-top pb-0">

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نوع حساب کاربری</label>
                                    <!--end::Tags-->
                                    <div class="col-lg-10 fv-row">
                                        <select name="representative_type" class="form-select form-select-lg form-control-solid">
                                            <option {{$representative->representative_type == "agency" ? "selected" : ""}} value="agency">عاملیت</option>
                                            <option {{$representative->representative_type == "delegation" ? "selected" : ""}} value="delegation">نمایندگی</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <div class="separator separator-dashed my-5 pt-5"></div>            
                            
                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="firstname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام کاربر را وارد نمایید" value="{{$representative->user->firstname, old('firstname')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام خانوادگی</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="lastname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام خانوادگی کاربر را وارد نمایید" value="{{$representative->user->lastname, old('lastname')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">شماره تلفن همراه</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="number" name="home_phone" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="شماره تلفن کاربر را وارد نمایید" value="{{$representative->user->home_phone, old('home_phone')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <div class="separator separator-dashed my-5 pt-5"></div>

                                <!--begin::Input group-->
                                <div class="row mb-6 pt-5">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نوع شخص</label>
                                    <!--end::Tags-->
                                    <div class="col-lg-10 fv-row">
                                        <select id="person" name="person_type" class="form-select form-select-lg form-control-solid">
                                            <option {{$representative->user->person_type == "haghighi" ? "selected" : ""}} value="haghighi">شخص حقیقی</option>
                                            <option {{$representative->user->person_type == "hoghoghi" ? "selected" : ""}} value="hoghoghi">شخص حقوقی</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->                                

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10 haghighi">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">کد ملی</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="number" name="national_code" class="form-control form-control-lg form-control-solid" placeholder="کد ملی" value="{{$representative->user->national_code, old('national_code')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10 hoghoghi">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">شماره شناسه شرکت</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="number" name="company_number" class="form-control form-control-lg form-control-solid" placeholder="شماره شناسه شرکت" value="{{$representative->user->company_number, old('company_number')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10 hoghoghi">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">نام نماینده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="agent_name" class="form-control form-control-lg form-control-solid" placeholder="نام نماینده" value="{{$representative->user->agent_name, old('agent_name')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <div class="separator separator-dashed my-5 pt-5"></div>                              

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام فروشگاه / شرکت</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="shop_name" class="form-control form-control-lg form-control-solid" placeholder="نام فروشگاه یا شرکت" value="{{$representative->user->shop_name, old('shop_name')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">آدرس دفتر مرکزی</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="shop_address" class="form-control form-control-lg form-control-solid" placeholder="آدرس فروشگاه / شرکت" value="{{$representative->user->shop_address, old('shop_address')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <div class="separator separator-dashed my-5 pt-5"></div>

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام کاربری (حداقل 5 کاراکتر)</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="username" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام کاربری را وارد نمایید" value="{{$representative->user->username, old('username')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">ایمیل</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="email" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="email@example.com" value="{{$representative->user->email, old('email')}}" autocomplete="off" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">کلمه عبور (حداقل 8 کاراکتر)</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="password" name="password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="کلمه عبور" value="password" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->  
                                                
                                <!--begin::Input group-->
                                <div class="form-group">
                                    <!--begin::Content-->
                                    <div class="collapse show">
                                        <!--begin::Actions-->
                                        <div class="card-footer d-flex justify-content-end px-9">
                                            <a href="{{route('vendor.all.representative')}}" class="btn btn-light me-3">لغو</a>
                                            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                </div>
                                <!--end::Input group-->  

                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::کارت-->
                </form>    

                <form class="form" method="POST" action={{route('vendor.update.products.representative')}}>
                    <input type="hidden" name="representative_id" value="{{$representative->id}}">
                    @csrf

                    <!--begin::کارت-->
                    <div class="card mb-5 mb-xl-10">

                        <!--begin::کارت header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                            <!--begin::کارت title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">مجوز موقعیت جغرافیایی فعالیت (برای تمام محصولات)</h3>
                            </div>
                            <!--end::کارت title-->
                        </div>
                        <!--begin::کارت header-->

                        <!--begin::Content-->
                        <div class="collapse show">
                            <!--begin::کارت body-->
                            <div class="card-body border-top pt-0 pb-0">
                                <!--begin::Input group-->
                                <div class="row d-flex justify-content-end pt-5">

                                    {{-- این فقط برای اعتبارسنجی این دو فرم کاربرد دارد که باید حداقل یکی از این دو مورد داخلی یا خارجی را فعال کند --}}
                                    <input type="hidden" name="specific_geolocation_validation">

                                    <!--begin::Input group-->
                                    <div class="row d-flex justify-content-end mx-5 px-4 pt-3">
                                        <!--begin::Tags-->
                                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                            <label for="specific_geolocation_internal">فروش داخل کشور</label>
                                            <input class="form-check-input w-45px h-30px mx-2" type="checkbox" id="specific_geolocation_internal" name="specific_geolocation_internal" {{$representative->specific_geolocation_internal ? "checked" : ""}}>
                                        </div>
                                        <!--end::Tags-->
                                        <!--begin::توضیحات-->
                                        <div class="mt-2 text-muted fs-7 p-0">با تأیید این گزینه موقعیت جغرافیایی در داخل کشور اعمال خواهد شد.</div>
                                        <!--end::توضیحات-->
                                    </div>
                                    <!--end::Input group-->

                                    <div class="specific_geolocation_internal_body" style="{{$representative->specific_geolocation_internal ? "" : "display:none;"}}">
                                        <!--begin::Tags-->
                                        <label class="col-lg-12 col-form-label fw-semibold fs-6">
                                            موقعیت جغرافیایی محصول مورد نظر را از طریق انتخاب استان و شهر تعیین نمایید
                                        </label>
                                        <!--end::Tags-->

                                        <!--begin::Col-->
                                        {{-- <div class="row repeater-body">
                                            <div class="col-lg-10">
                                                <div class="repeater">
                                                    <div data-repeatable class="my-2">
                                                        <fieldset class="row">
                                                            <!--begin::Row-->
                                                            <div class="row col-md-10">
                                                                <div class="row gutter-sm ir-select">        
                                                                    <label class="col-md-2 d-flex align-items-center">استان</label>                  
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <div class="select-box">
                                                                                <select name="geolocation_permission_province[]" class="ir-province form-control form-control-md"></select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <label class="col-md-2 d-flex align-items-center">شهر</label>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <select name="geolocation_permission_city[]" class="ir-city form-control form-control-md"></select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Row-->
                                                            <div class="col-md-2 d-flex align-items-center">
                                                                <button type="button" class="btn btn-sm btn-light-danger del-repeater-btn">
                                                                    حذف
                                                                    <i class="bi bi-patch-minus-fill"></i>
                                                                </button>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 d-flex align-items-start mt-3">
                                                <button type="button" class="btn btn-sm btn-light-primary add-repeater-btn">
                                                    افزودن
                                                    <i class="bi bi-patch-plus-fill"></i>
                                                </button>
                                            </div>
                                        </div> --}}
                                        <!--end::Col-->

                                        <div class="row repeater-body">
                                            <div class="col-lg-10">
                                                <div class="repeater">
                                                    @foreach ($representative->getUserGeolocationInfo("internal") as $geolocation_item)
                                                        <div data-repeatable="" class="my-2">
                                                            <fieldset class="row">
                                                                <!--begin::Row-->
                                                                <div class="row col-md-10">
                                                                    <div class="row gutter-sm ir-select">        
                                                                        <label class="col-md-2 d-flex align-items-center">استان</label>                  
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <div class="select-box">
                                                                                    <select name="geolocation_permission_province[]" class="ir-province form-control form-control-md">
                                                                                        <option value=""></option>
                                                                                        @foreach ($province_list as $province_name_item)
                                                                                            <option {{$province_name_item == $geolocation_item["province"] ? "selected" : ""}} value="{{$province_name_item}}">
                                                                                                {{$province_name_item}}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <label class="col-md-2 d-flex align-items-center">شهر</label>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <select name="geolocation_permission_city[]" class="ir-city form-control form-control-md">
                                                                                    <option value="{{$geolocation_item["city"]}}">
                                                                                        {{$geolocation_item["city"]}}
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->
                                                                <div class="col-md-2 d-flex align-items-center">
                                                                    <button type="button" class="btn btn-sm btn-light-danger del-repeater-btn">
                                                                        حذف
                                                                        <i class="bi bi-patch-minus-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-lg-2 d-flex align-items-start mt-3">
                                                <button type="button" class="btn btn-sm btn-light-primary add-repeater-btn">
                                                    افزودن
                                                    <i class="bi bi-patch-plus-fill"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row d-flex justify-content-end mx-5 px-4 pt-5">
                                        <!--begin::Tags-->
                                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                            <label for="specific_geolocation_external">فروش خارج از کشور</label>
                                            <input class="form-check-input w-45px h-30px mx-2" type="checkbox" id="specific_geolocation_external" name="specific_geolocation_external" {{$representative->specific_geolocation_external ? "checked" : ""}}>
                                        </div>
                                        <!--end::Tags-->
                                        <!--begin::توضیحات-->
                                        <div class="mt-2 text-muted fs-7 p-0">با تأیید این گزینه موقعیت جغرافیایی در خارج از کشور اعمال خواهد شد.</div>
                                        <!--end::توضیحات-->
                                    </div>
                                    <!--end::Input group-->

                                    <div class="specific_geolocation_external_body" style="{{$representative->specific_geolocation_external ? "" : "display:none;"}}">
                                        <!--begin::Tags-->
                                        <label class="col-lg-12 col-form-label fw-semibold fs-6 mt-5 pt-5">
                                            موقعیت جغرافیایی محصول مورد نظر را از طریق انتخاب کشور تعیین نمایید
                                        </label>
                                        <!--end::Tags-->

                                        <select class="form-select export-countries-dropdown" name="geolocation_permission_export_country[]" multiple aria-label="multiple select example" dir="ltr">
                                            @foreach ($country_list as $country_name_item)
                                                <option {{in_array($country_name_item, $representative->getUserGeolocationInfo("external")->toArray()) ? "selected" : ""}} value="{{$country_name_item}}">{{$country_name_item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                               
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::Content-->

                        <div class="separator separator-dashed my-5 pt-5"></div>

                        <!--begin::کارت header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                            <!--begin::کارت title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">محصول مورد نظر را از جدول زیر انتخاب نمایید</h3>
                            </div>
                            <!--end::کارت title-->
                        </div>
                        <!--begin::کارت header-->

                        <!--begin::Content-->
                        <div class="collapse show">
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">

                                <!-- بخش مربوط به جدول محصولات --> 
                                @if(count($vendor_products))

                                    @foreach ($vendor_products as $category_id => $product_object_array)
                                
                                        <div class="yelsuDataTablesHead d-flex align-items-center">
                                            <div class="vendor-image-div">
                                                @if(!empty($vendorData->photo))
                                                    <img alt="Logo" src="{{url('storage/upload/vendor_images/' . $vendorData->photo)}}"/>
                                                @else
                                                    <img alt="Logo" src="{{asset('frontend/assets/images/demos/demo13/logo_cropped.png')}}"/>
                                                @endif

                                                <a href="{{route('shop.category', ['id'=> $category_id])}}">  {{App\Models\Category::find($category_id)->category_name}} </a>
                                            </div>

                                            <div class="value-added-tax-div">
                                                <input type="checkbox" class="value_added_tax_btn">
                                                <label for="value_added_tax">نمایش قیمت با ارزش افزوده</label>
                                            </div>
                                        </div>
                                        <div class="product-wrapper row pb-5">
                                            <div class="product-wrap">
                                                <div class="product text-center">
                                                    <table class="display yelsuDataTables" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">
                                                                    <input class="form-check-input product-bulk-action" type="checkbox">
                                                                </th>
                                                                <th class="text-center">ردیف</th>
                                                                <th class="all text-center">نام محصول</th>
                                                                {{-- @if(count(App\Models\Category::find($category_id)->attributes))
                                                                    @foreach (App\Models\Category::find($category_id)->attributes->first()->items->where('show_in_table_page', 1)->sortBy('attribute_item_order', SORT_NUMERIC) as $attribute_header_key => $attribute_header_items)
                                                                        <th class="text-center">
                                                                            {{$attribute_header_items->attribute_item_name}} 
                                                                        </th> 
                                                                    @endforeach
                                                                @endif --}}
                                                                <th class="all text-center">تعداد / مقدار محصول اختصاص داده شده</th>
                                                                <th class="all text-center">مجوز تغییر قیمت</th>
                                                                <th class="all text-center">فروش داخل کشور</th>
                                                                <th class="all text-center">فروش خارج از کشور</th>
                                                                <th class="all text-center">قیمت</th>
                                                                <th class="all text-center">ویرایش محصول</th>
                                                                <th class="text-center">اطلاعات بیشتر</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($product_object_array as $product_key => $product_item)
                                                                <tr>
                                                                    <td>
                                                                        <input {{ in_array($product_item->id, $representative->products()->pluck("id")->toArray()) ? "checked" : ""}} class="form-check-input" type="checkbox" value="{{$product_item->id}}">
                                                                    </td>
                                                                    <td>{{ $product_key + 1}}</td>
                                                                    <td>
                                                                        <a href="{{route('product.details', $product_item->product_slug)}}">
                                                                            {{$product_item->product_name}}
                                                                        </a>
                                                                    </td>
                                                                    {{-- @if(count(App\Models\Category::find($category_id)->attributes))
                                                                        @foreach (App\Models\Category::find($category_id)->attributes->first()->items->where('show_in_table_page', 1)->sortBy('attribute_item_order', SORT_NUMERIC) as $attribute_row_key => $attribute_row_items)
                                                                            <td>
                                                                                @if(in_array($attribute_row_items->id, $product_item->table_attribute_items_obj_array()->keys()->toArray()))
                                                                                    @if ($attribute_row_items->attribute_item_type == "dropdown")
                                                                                        {{collect($product_item->table_attribute_items_obj_array()[$attribute_row_items->id]['attribute_value_obj'])->pluck('value')->join('، ')}} 
                                                                                    @else
                                                                                        {{$product_item->table_attribute_items_obj_array()[$attribute_row_items->id]['attribute_value']}} 
                                                                                    @endif
                                                                                @else 
                                                                                    ناموجود
                                                                                @endif
                                                                            </td> 
                                                                        @endforeach
                                                                    @endif     --}}
                                                                    <td>
                                                                        <span class="badge badge-info product-stock-number-table">نامحدود</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge badge-secondary change-price-permission-table">خیر</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge badge-secondary product-specific-geolocation-internal-table">خیر</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge badge-secondary product-specific-geolocation-external-table">خیر</span>
                                                                    </td>
                                                                    @if($product_item->selling_price != 0)
                                                                        <input type="hidden" value="{{$product_item->selling_price}}" class="price_before_value_added_tax">
                                                                        <input type="hidden" value="{{$product_item->determine_product_value_added_tax_by_percent()}}" class="price_after_value_added_tax">
                                                                        <td>
                                                                            <span class="price_tag">{{number_format($product_item->selling_price, 0, '', ',')}}</span> {{$product_item->determine_product_currency()}}
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <a href="tel:02191692471">
                                                                                تماس بگیرید
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                    
                                                                    <td>
                                                                        <button {{in_array($product_item->id, $representative->products()->pluck("id")->toArray()) ? "" : "disabled"}} type="button" class="btn btn-sm btn-dark m-1 edit-button-specification">
                                                                            <i class="bi bi-pencil-fill"></i>
                                                                            ویرایش
                                                                        </button>
                                                                        <input class="hidden-input-information" {{in_array($product_item->id, $representative->products()->pluck("id")->toArray()) ? "" : "disabled"}} type="hidden" name="product_obj[]" value='{{ json_encode(App\Models\Product::determine_representative_product_array($product_item, $representative), JSON_UNESCAPED_UNICODE) }}'>
                                                                        <input class="hidden-input-information-server" {{in_array($product_item->id, $representative->products()->pluck("id")->toArray()) ? "" : "disabled"}} type="hidden" name="product_obj_server[]" value='{{ json_encode(App\Models\Product::determine_representative_selected_product_server_array($product_item, $representative), JSON_UNESCAPED_UNICODE) }}'>
                                                                    </td>
                                                                    <td></td>
                                                                    {{-- @dd(count($representative->products()->where("product_id", $product_item->id)->get())) --}}
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <!-- پایان بخش مربوط به جدول محصولات --> 
                                                                                                                
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::Content-->

                        <div class="form-group">
                            <!--begin::Content-->
                            <div class="collapse show">
                                <!--begin::Actions-->
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <a href="{{route('vendor.all.representative')}}" class="btn btn-light me-3">لغو</a>
                                    <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Content-->
                        </div>
                        
                    </div>
                    <!--end::کارت-->


                    <!--begin::کارت-->
                    <div class="card mb-5 mb-xl-10" id="product-edit-specification-section" style="display: none;">

                        <!--begin::کارت header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-controls="kt_account_profile_details">
                            <!--begin::کارت title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">تنظیمات مورد نظر را پس از اعمال ذخیره نمایید</h3>
                            </div>
                            <!--end::کارت title-->
                        </div>
                        <!--begin::کارت header-->

                        <!--begin::Content-->
                        <div class="collapse show">
                            <!--begin::Actions-->

                            <!--begin::Input group-->
                            <div class="row card-footer d-flex justify-content-end">
                                <!--begin::Tags-->
                                <label class="col-lg-8 col-form-label fw-semibold fs-6">تعداد محصول اختصاص داده شده (در صورت نامحدود بودن این فیلد را خالی بگذارید)</label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-4" style="padding-left: 28px;" >
                                    <input type="number" class="form-control form-control-solid" placeholder="تعداد مورد نظر را وارد نمایید" name="product_in_stock" id="product_in_stock">
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row d-flex justify-content-end mx-5 px-4 pb-5">
                                <!--begin::Tags-->
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <label for="change-price-permission">مجوز تغییر قیمت</label>
                                    <input class="form-check-input w-45px h-30px mx-2" type="checkbox" id="change-price-permission" name="change_price_permission">
                                </div>
                                <!--end::Tags-->
                                <!--begin::توضیحات-->
                                <div class="mt-2 text-muted fs-7 p-0">با تأیید این گزینه به عاملیت / نمایندگی اجازه تغییر قیمت این محصول داده خواهد شد.</div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row d-flex justify-content-end mx-5 px-4 py-5">
                                <!--begin::Tags-->
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <label for="product_specific_geolocation_internal">فروش داخل کشور</label>
                                    <input class="form-check-input w-45px h-30px mx-2" type="checkbox" id="product_specific_geolocation_internal" name="product_specific_geolocation_internal">
                                </div>
                                <!--end::Tags-->
                                <!--begin::توضیحات-->
                                <div class="mt-2 text-muted fs-7 p-0">با تأیید این گزینه موقعیت جغرافیایی به صورت اختصاصی برای این محصول در داخل کشور اعمال خواهد شد.</div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::Input group-->
                            
                            <div class="product_specific_geolocation_internal_body" style="display: none;">
                                <!--begin::Input group-->
                                <div class="row d-flex justify-content-end mx-5 px-4 py-5">
                                    <!--begin::Tags-->
                                    <label class="col-lg-12 col-form-label fw-semibold fs-6">
                                        موقعیت جغرافیایی محصول مورد نظر را از طریق انتخاب استان و شهر تعیین نمایید
                                    </label>
                                    <!--end::Tags-->

                                    <!--begin::Col-->
                                    <div class="row repeater-body">
                                        <div class="col-lg-10">
                                            <div class="repeater-product">
                                                <div data-repeatable class="my-2">
                                                    <fieldset class="row">
                                                        <!--begin::Row-->
                                                        <div class="row col-md-10">
                                                            <div class="row gutter-sm ir-select">        
                                                                <label class="col-md-2 d-flex align-items-center">استان</label>                  
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="select-box">
                                                                            <select name="product_geolocation_permission_province[]" class="ir-province form-control form-control-md"></select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <label class="col-md-2 d-flex align-items-center">شهر</label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <select name="product_geolocation_permission_city[]" class="ir-city form-control form-control-md"></select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Row-->
                                                        <div class="col-md-2 d-flex align-items-center">
                                                            <button type="button" class="btn btn-sm btn-light-danger del-repeater-btn">
                                                                حذف
                                                                <i class="bi bi-patch-minus-fill"></i>
                                                            </button>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 d-flex align-items-start mt-3">
                                            <button type="button" class="btn btn-sm btn-light-primary add-repeater-btn">
                                                افزودن
                                                <i class="bi bi-patch-plus-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>

                            <!--begin::Input group-->
                            <div class="row d-flex justify-content-end mx-5 px-4 py-5">
                                <!--begin::Tags-->
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <label for="product_specific_geolocation_external">فروش خارج از کشور</label>
                                    <input class="form-check-input w-45px h-30px mx-2" type="checkbox" id="product_specific_geolocation_external" name="product_specific_geolocation_external">
                                </div>
                                <!--end::Tags-->
                                <!--begin::توضیحات-->
                                <div class="mt-2 text-muted fs-7 p-0">با تأیید این گزینه موقعیت جغرافیایی به صورت اختصاصی برای این محصول در خارج از کشور اعمال خواهد شد.</div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::Input group-->

                            <div class="product_specific_geolocation_external_body" style="display: none;">
                                <!--begin::Input group-->
                                <div class="row d-flex justify-content-end mx-5 px-4 py-2">
                                    <!--begin::Tags-->
                                    <label class="col-lg-12 col-form-label fw-semibold fs-6 mt-5 pt-5">
                                        موقعیت جغرافیایی محصول مورد نظر را از طریق انتخاب کشور تعیین نمایید
                                    </label>
                                    <!--end::Tags-->
                                    
                                    <select class="form-select product-export-countries-dropdown" name="product_geolocation_permission_export_country[]" multiple aria-label="multiple select example" dir="ltr">
                                        @foreach ($country_list as $country_name_item)
                                            <option value="{{$country_name_item}}">{{$country_name_item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--end::Input group-->
                            </div>

                            <div class="form-group card-body">
                                <button type="button" class="btn btn-sm btn-success mx-1" id="list-btn-save-changes">
                                <i class="bi bi-save"></i>
                                ذخیره تغییرات
                                </button>

                                <button type="button" class="btn btn-sm btn-dark mx-1" id="list-btn-discard-changes">
                                <i class="bi bi-x-square"></i>
                                انصراف
                                </button>

                                <div class="mt-2 text-muted fs-7">با کلیک روی این دکمه می توانید مشخصات تعریف شده برای آن محصول را ذخیره نمایید.</div>
                            </div>

                            <!--end::Actions-->
                        </div>
                        <!--end::Content-->

                        

                    </div>
                    <!--end::کارت-->

                    <!--begin::کارت-->
                     <div class="card mb-5 mb-xl-10">
                        <!--begin::Content-->
                        {{-- <div class="collapse show">
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{route('vendor.all.representative')}}" class="btn btn-light me-3">لغو</a>
                                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                            </div>
                            <!--end::Actions-->
                        </div> --}}
                        <!--end::Content-->
                    </div>
                    <!--end::کارت-->

                </form>
                <!--end::Form-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    </div>

    <script src="{{asset('frontend/assets/js/cityDropdown.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/vendorRepresentative.js')}}"></script>

    <script src="{{asset('frontend/assets/plugins/datatables/yelsuProductTablesVendor.js')}}"></script>

@endsection