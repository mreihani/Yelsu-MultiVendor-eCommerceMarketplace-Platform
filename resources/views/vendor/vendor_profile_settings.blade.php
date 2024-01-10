@extends('vendor.vendor_dashboard')
@section('vendor')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">اکانت تنظیمات</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">خانه</a>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">اکانت</li>
                        <!--end::آیتم-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::فیلتر menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                        <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->فیلتر</a>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_637dc7ba89687">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">فیلتر تنظیمات</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Tags-->
                                    <label class="form-label fw-semibold">وضعیت:</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="انتخاب گزینه" data-dropdown-parent="#kt_menu_637dc7ba89687" data-allow-clear="true">
                                            <option></option>
                                            <option value="1">تایید شده</option>
                                            <option value="2">در انتظار</option>
                                            <option value="2">در حال پردازش</option>
                                            <option value="2">رد شد</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Tags-->
                                    <label class="form-label fw-semibold">نوع عضویت:</label>
                                    <!--end::Tags-->
                                    <!--begin::تنظیمات-->
                                    <div class="d-flex">
                                        <!--begin::تنظیمات-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                            <span class="form-check-label">نویسنده</span>
                                        </label>
                                        <!--end::تنظیمات-->
                                        <!--begin::تنظیمات-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                            <span class="form-check-label">مشتری</span>
                                        </label>
                                        <!--end::تنظیمات-->
                                    </div>
                                    <!--end::تنظیمات-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Tags-->
                                    <label class="form-label fw-semibold">اعلان ها:</label>
                                    <!--end::Tags-->
                                    <!--begin::Switch-->
                                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                        <label class="form-check-label">فعال</label>
                                    </div>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">ریست</button>
                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">تایید</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::فیلتر menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::اصلی button-->
                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">ساختن</a>
                    <!--end::اصلی button-->
                </div> --}}
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            @if(session()->has('success'))
            <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5 mt-5 mb-5">
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
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        @include('vendor.layouts.profileHeader')
                        <!--end::Details-->
                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{route('vendor.profile')}}">پروفایل من </a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="{{route('vendor.profileSettings')}}">تنظیمات</a>
                            </li>
                            <!--end::Nav item-->
                           
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{route('vendor.profileFieldOfActivity')}}">زمینه فعالیت</a>
                            </li>
                            <!--end::Nav item-->

                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{route('vendor.profileFinancialStatement')}}">صورتحساب</a>
                            </li>
                            <!--end::Nav item-->
                           
                           
                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::پایه info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::کارت header-->
                    <div class="card-title pt-5 mb-5" style="margin-right:25px;">
                        <h3 class="fw-bold m-0">تنظیمات پروفایل و احراز هویت</h3>
                        <span class="form-text" style="color: #ff7676">در صورت فعالیت در پلتفرم یلسو می بایست احراز هویت انجام شود</span>
                    </div>
                    
                    <!--begin::کارت header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form" method="POST" action={{route('vendor.profile.store')}} enctype="multipart/form-data">
                            @csrf
                            <!--begin::کارت body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">تصویر آواتار / پروفایل / لوگو</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                            <!--begin::نمایش existing avatar-->
                                            <div id="ShowImage" class="image-input-wrapper w-125px h-125px" style="background-image: url({{!empty($vendorData->photo) ? url('storage/upload/vendor_images/' . $vendorData->photo) : url('storage/upload/no_image.jpg') }})"></div>
                                            <!--end::نمایش existing avatar-->
                                            <!--begin::Tags-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض آواتار">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input id="image" type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Tags-->
                                            <!--begin::انصراف-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::انصراف-->
                                            <!--begin::حذف-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::حذف-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text">نوع فایل مجاز برای آپلود: png, jpg, jpeg.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">تصویر سربرگ فروشگاه / شرکت / کارخانه</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                            <!--begin::نمایش existing avatar-->
                                            <div id="ShowImage" class="image-input-wrapper w-400px h-194px storeBanner" style="background-image: url({{!empty($vendorData->store_banner) ? url('storage/upload/vendor_images/' . $vendorData->store_banner) : url('storage/upload/no_image_store.jpg') }})"></div>
                                            <!--end::نمایش existing avatar-->
                                            <!--begin::Tags-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض تصویر سربرگ فروشگاه">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input id="image" type="file" name="store_banner" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="store_banner_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Tags-->
                                            <!--begin::انصراف-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::انصراف-->
                                            <!--begin::حذف-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::حذف-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text">ابعاد تصویر بایستی 930 در 446 پیکسل باشد.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <!--begin::Input group-->
                                 <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">شخص حقیقی یا حقوقی</label>
                                    <!--end::Tags-->
                                    <div class="col-lg-8 fv-row">
                                        <select id="person" name="person_type" class="form-select form-select-lg form-control-solid">
                                            <option {{$vendorData->person_type == "haghighi" ? "selected" : ""}} value="haghighi">شخص حقیقی</option>
                                            <option {{$vendorData->person_type == "hoghoghi" ? "selected" : ""}} value="hoghoghi">شخص حقوقی</option>
                                        </select>
                                    </div>
                                 </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                 <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">عنوان فروشگاه / شرکت / کسب و کار</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="shop_name" class="form-control form-control-lg form-control-solid" placeholder="عنوان فروشگاه یا شرکت" value="{{$vendorData->shop_name}}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">آدرس پستی / دفتر مرکزی</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="shop_address" class="form-control form-control-lg form-control-solid" placeholder="آدرس فروشگاه / شرکت" value="{{$vendorData->shop_address}}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">کدپستی</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="home_postalcode" class="form-control form-control-lg form-control-solid" placeholder="کد پستی" value="{{$vendorData->home_postalcode}}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <div class="haghighi">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">نام</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <input type="text" name="firstname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام" value="{{$vendorData->firstname}}" />
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">نام خانوادگی</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <input type="text" name="lastname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام خانوادگی" value="{{$vendorData->lastname}}" />
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">کد ملی</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="national_code" class="form-control form-control-lg form-control-solid" placeholder="کد ملی" value="{{$vendorData->national_code}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                </div>

                                <div class="hoghoghi">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">شماره ثبت شرکت</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="verification_company_registration_number" class="form-control form-control-lg form-control-solid" placeholder="شماره ثبت شرکت" value="{{$vendorData->vendor ? $vendorData->vendor->verification_company_registration_number : ''}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">شماره شناسه ملی شرکت</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="verification_company_national_code" class="form-control form-control-lg form-control-solid" placeholder="شماره شناسه ملی شرکت" value="{{$vendorData->vendor ? $vendorData->vendor->verification_company_national_code : ''}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row ">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">کد اقتصادی شرکت</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="verification_company_economic_code" class="form-control form-control-lg form-control-solid" placeholder="کد اقتصادی شرکت" value="{{$vendorData->vendor ? $vendorData->vendor->verification_company_economic_code : ''}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--begin::Hint-->
                                    <div class="form-text">در صورتی که کد اقتصادی همان شناسه ملی است، باکس کد اقتصادی را خالی بگذارید.</div>
                                    <!--end::Hint-->
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6 mt-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">نام نماینده</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="agent_name" class="form-control form-control-lg form-control-solid" placeholder="نام نماینده" value="{{$vendorData->agent_name}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">آدرس بر اساس استعلام سامانه evat</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="verification_company_evat_address" class="form-control form-control-lg form-control-solid" placeholder="آدرس را وارد نمایید" value="{{$vendorData->vendor ? $vendorData->vendor->verification_company_evat_address : ''}}" />
                                        </div>
                                        <!--begin::Hint-->
                                        <div class="form-text">در صورتی که آدرس تغییر کرده باشد، بارگذاری روزنامه تغییرات آدرس، همراه با روزنامه رسمی الزامی است.</div>
                                        <!--end::Hint-->
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">مشخصات صاحبین حق امضا مطابق با روزنامه رسمی</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <!--begin::Col-->
                                            <div class="row repeater-body">
                                                <div class="col-lg-10">
                                                    <div class="repeater-product">
                                                        @if($vendorData->vendor && count($vendorData->vendor->vendor_signatures))
                                                            @foreach ($vendorData->vendor->vendor_signatures as $signature_item)
                                                                <div data-repeatable class="mb-5">
                                                                    <fieldset class="row">
                                                                        <!--begin::Row-->
                                                                        <div class="row col-md-10">
                                                                            <div class="row gutter-sm">        
                                                                                <!--begin::Input group-->
                                                                                <div class="row d-flex justify-content-end">
                                                                                    <!--begin::Col-->
                                                                                    <div class="col-lg-4" >
                                                                                        <input name="vendor_signature_firstname[]" type="text" class="form-control form-control-solid" placeholder="نام" value="{{$signature_item->vendor_signature_firstname}}">
                                                                                    </div>
                                                                                    <!--end::Col-->
                                                                                    <!--begin::Col-->
                                                                                    <div class="col-lg-4" >
                                                                                        <input name="vendor_signature_lastname[]" type="text" class="form-control form-control-solid" placeholder="نام خانوادگی" value="{{$signature_item->vendor_signature_lastname}}">
                                                                                    </div>
                                                                                    <!--end::Col-->
                                                                                    <!--begin::Col-->
                                                                                    <div class="col-lg-4" >
                                                                                        <input name="vendor_signature_national_code[]" type="number" class="form-control form-control-solid" placeholder="کد ملی" value="{{$signature_item->vendor_signature_national_code}}">
                                                                                    </div>
                                                                                    <!--end::Col-->
                                                                                </div>
                                                                                <!--end::Input group-->
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
                                                        @else
                                                            <div data-repeatable class="mb-5">
                                                                <fieldset class="row">
                                                                    <!--begin::Row-->
                                                                    <div class="row col-md-10">
                                                                        <div class="row gutter-sm">        
                                                                            <!--begin::Input group-->
                                                                            <div class="row d-flex justify-content-end">
                                                                                <!--begin::Col-->
                                                                                <div class="col-lg-4" >
                                                                                    <input name="vendor_signature_firstname[]" type="text" class="form-control form-control-solid" placeholder="نام">
                                                                                </div>
                                                                                <!--end::Col-->
                                                                                <!--begin::Col-->
                                                                                <div class="col-lg-4" >
                                                                                    <input name="vendor_signature_lastname[]" type="text" class="form-control form-control-solid" placeholder="نام خانوادگی">
                                                                                </div>
                                                                                <!--end::Col-->
                                                                                <!--begin::Col-->
                                                                                <div class="col-lg-4" >
                                                                                    <input name="vendor_signature_national_code[]" type="number" class="form-control form-control-solid" placeholder="کد ملی">
                                                                                </div>
                                                                                <!--end::Col-->
                                                                            </div>
                                                                            <!--end::Input group-->
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
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 d-flex align-items-start mt-1">
                                                    <button type="button" class="btn btn-sm btn-light-primary add-repeater-btn">
                                                        افزودن
                                                        <i class="bi bi-patch-plus-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                </div>

                                <!--begin::Menu separator-->
                                <div class="separator pt-5 mb-5 opacity-75"></div>
                                <!--end::Menu separator-->

                                <div class="card-title pt-5 mb-5 pb-5">
                                    <h3 class="fw-bold m-0">بارگذاری تصاویر احراز هویت</h3>
                                </div>

                                <div class="haghighi">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">بارگذاری تصویر گواهی ارزش افزوده</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <div class="form-text mb-2">
                                                در صورتی که شامل مالیات بر ارزش افزوده هستید، تصویر گواهی ارزش افزوده خود را در این قسمت بارگزاری نمایید. اگر گواهی ارزش افزوده خود را ندارید، در بخش بررسی ثبت نام الکترونیک مالیات بر ارزش افزوده، evat.ir با وارد کردن مشخصات موردنیاز، آنرا دریافت نمایید و سپس آن را در قالب یک عکس در این بخش بارگذاری کنید.
                                            </div>
                                            <input type="file" accept=".png, .jpg, .jpeg" class="form-control" id="verification_company_value_added_certificate" name="verification_company_value_added_certificate" />
                                            <div class="form-text">
                                                نوع فایل مجاز برای آپلود: png, jpg, jpeg.
                                            </div>

                                            <!--begin::نمایش existing avatar-->
                                            @if($vendorData->vendor && $vendorData->vendor->verification_company_value_added_certificate)
                                                <a class="d-flex justify-content-center" href="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_value_added_certificate])}}">
                                                    <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_value_added_certificate])}}" alt="">
                                                </a>
                                            @endif
                                            <!--end::نمایش existing avatar-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">بارگذاری تصویر پشت و روی کارت ملی شخص حقیقی </label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <div class="form-text mb-2">
                                                تصویر پشت و روی کارت ملی شخص حقیقی را در قالب یک عکس بارگذاری نمایید.
                                            </div>
                                            <input type="file" accept=".png, .jpg, .jpeg" class="form-control" id="verification_company_national_card_image" name="verification_company_national_card_image" />
                                            <div class="form-text">
                                                نوع فایل مجاز برای آپلود: png, jpg, jpeg.
                                            </div>

                                            <!--begin::نمایش existing avatar-->
                                            @if($vendorData->vendor && $vendorData->vendor->verification_company_national_card_image)
                                                <a class="d-flex justify-content-center" href="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_national_card_image])}}">
                                                    <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_national_card_image])}}" alt="">
                                                </a>
                                            @endif
                                            <!--end::نمایش existing avatar-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                </div>

                                <div class="hoghoghi">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">بارگذاری تصویر ثبت نام مودیان مالیات بر ارزش افزوده</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <div class="form-text mb-2">
                                                تصویری که از صفحه بررسی ثبت نام مودیان مالیات بر ارزش افزوده واقع در نشانی اینترنتی evat.ir با وارد کردن شماره شناسه ملی یا شماره اقتصادی دریافت نموده اید را در قالب یک عکس بارگزاری نمایید.
                                            </div>
                                            <input type="file" accept=".png, .jpg, .jpeg" class="form-control" id="verification_company_value_added_registration_image" name="verification_company_value_added_registration_image" />
                                            <div class="form-text">
                                                نوع فایل مجاز برای آپلود: png, jpg, jpeg.
                                            </div>

                                            <!--begin::نمایش existing avatar-->
                                            @if($vendorData->vendor && $vendorData->vendor->verification_company_value_added_registration_image)
                                                <a class="d-flex justify-content-center" href="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_value_added_registration_image])}}">
                                                    <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_value_added_registration_image])}}" alt="">
                                                </a>
                                            @endif
                                            <!--end::نمایش existing avatar-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">بارگذاری تصویر پشت و روی کارت ملی همه صاحبان حق امضا</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <div class="form-text mb-2">
                                                تصویر پشت و روی کارت ملی همه صاحبان حق امضا را در قالب یک عکس کنار هم بارگذاری نمایید.
                                            </div>
                                            <input type="file" accept=".png, .jpg, .jpeg" class="form-control" id="verification_company_national_card_image_all" name="verification_company_national_card_image_all" />
                                            <div class="form-text">
                                                نوع فایل مجاز برای آپلود: png, jpg, jpeg.
                                            </div>

                                            <!--begin::نمایش existing avatar-->
                                            @if($vendorData->vendor && $vendorData->vendor->verification_company_national_card_image_all)
                                                <a class="d-flex justify-content-center" href="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_national_card_image_all])}}">
                                                    <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_national_card_image_all])}}" alt="">
                                                </a>
                                            @endif
                                            <!--end::نمایش existing avatar-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">بارگذاری تصویر آخرین تغییرات روزنامه رسمی</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <div class="form-text mb-2">
                                                تصویر آخرین تغییرات روزنامه رسمی را بارگذاری نمایید.
                                            </div>
                                            <input type="file" accept=".png, .jpg, .jpeg" class="form-control" id="verification_company_official_gazette_image" name="verification_company_official_gazette_image" />
                                            <div class="form-text">
                                                نوع فایل مجاز برای آپلود: png, jpg, jpeg.
                                            </div>

                                            <!--begin::نمایش existing avatar-->
                                            @if($vendorData->vendor && $vendorData->vendor->verification_company_official_gazette_image)
                                                <a class="d-flex justify-content-center" href="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_official_gazette_image])}}">
                                                    <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_official_gazette_image])}}" alt="">
                                                </a>
                                            @endif
                                            <!--end::نمایش existing avatar-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">بارگذاری تصویر آگهی تأسیس شرکت</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <div class="form-text mb-2">
                                                تصویر آگهی تأسیس شرکت را بارگذاری نمایید.
                                            </div>
                                            <input type="file" accept=".png, .jpg, .jpeg" class="form-control" id="verification_company_establishment_announcement" name="verification_company_establishment_announcement" />
                                            <div class="form-text">
                                                نوع فایل مجاز برای آپلود: png, jpg, jpeg.
                                            </div>

                                            <!--begin::نمایش existing avatar-->
                                            @if($vendorData->vendor && $vendorData->vendor->verification_company_establishment_announcement)
                                                <a class="d-flex justify-content-center" href="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_establishment_announcement])}}">
                                                    <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_establishment_announcement])}}" alt="">
                                                </a>
                                            @endif
                                            <!--end::نمایش existing avatar-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">بارگذاری تصویر پروانه بهره برداری</label>
                                        <!--end::Tags-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <div class="form-text mb-2">
                                                تصویر پروانه بهره برداری را بارگذاری نمایید.
                                            </div>
                                            <input type="file" accept=".png, .jpg, .jpeg" class="form-control" id="verification_company_operation_license" name="verification_company_operation_license" />
                                            <div class="form-text">
                                                نوع فایل مجاز برای آپلود: png, jpg, jpeg.
                                            </div>

                                            <!--begin::نمایش existing avatar-->
                                            @if($vendorData->vendor && $vendorData->vendor->verification_company_operation_license)
                                                <a class="d-flex justify-content-center" href="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_operation_license])}}">
                                                    <img style="border: 3px solid var(--kt-body-bg); box-shadow: var(--kt-box-shadow);" class="mt-5 mb-5" width="250px" src="{{route('assets', [$vendorData->role, $vendorData->id, $vendorData->vendor->verification_company_operation_license])}}" alt="">
                                                </a>
                                            @endif
                                            <!--end::نمایش existing avatar-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                </div>

                            </div>
                            <!--end::کارت body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{route('vendor.profile')}}" type="button" class="btn btn-light btn-active-light-primary me-2">لغو</a>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره تغییرات</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::پایه info-->
               
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    
</div>

<script>
    let person_type = {!! json_encode($vendorData->person_type) !!};
   
    if(person_type == null) {
        $(".hoghoghi").hide();
    } else if(person_type == 'haghighi') {
        $(".hoghoghi").hide();
    } else if(person_type == 'hoghoghi') {
        $(".haghighi").hide();
    }

    $("#person").on("change", function () {
        if (this.value == "hoghoghi") {
            $(".haghighi").hide();
            $(".hoghoghi").show();
        } else if ("haghighi") {
            $(".haghighi").show();
            $(".hoghoghi").hide();
        }
    });

    // repeater form function
    $('.repeater-body').on('click', '.add-repeater-btn', function(e) {
        e.preventDefault();
        
        $this = $(this);

        $repeater = $this.closest(".repeater-body").find('[data-repeatable]').last();
        $clone = $repeater.first().clone();

        let input_element = $clone.find("input");
        input_element.val("");

        $clone.insertAfter($repeater);
    });

    // remove repeater function
    $(".repeater-product").click(function(e) {
        if($(e.target).hasClass("del-repeater-btn") && $(e.target).closest(".repeater-body").find($("[data-repeatable]")).length > 1) {
            $(e.target).closest('[data-repeatable]').remove();
        }
    });
</script>

@endsection



