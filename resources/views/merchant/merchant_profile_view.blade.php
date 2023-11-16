@extends('merchant.merchant_dashboard')
@section('merchant')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                @include('merchant.layouts.profileHeader')
                <!--end::Details-->
                <!--begin::Navs-->
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="{{route('merchant.profile')}}">پروفایل من </a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{route('merchant.profileSettings')}}">تنظیمات</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{route('merchant.profileFinancialStatement')}}">صورتحساب</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                   
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    
                    <!--end::Nav item-->
                </ul>
                <!--begin::Navs-->
            </div>
        </div>
        <!--end::Navbar-->
        <!--begin::details نمایش-->
        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <!--begin::کارت header-->
            <div class="card-header cursor-pointer">
                <!--begin::کارت title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">جزییات پروفایل</h3>
                </div>
                <!--end::کارت title-->
                <!--begin::Actions-->
                <a href="{{route('merchant.profileSettings')}}" class="btn btn-sm btn-primary align-self-center">ویرایش اطلاعات</a>
                <!--end::Actions-->
            </div>
            <!--begin::کارت header-->
            <!--begin::کارت body-->
            <div class="card-body p-9">
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-4 fw-semibold text-muted">نام کامل</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bold fs-6 text-gray-800">{{$merchantData->firstname . " " . $merchantData->lastname}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-4 fw-semibold text-muted">نام کاربری</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{$merchantData->username}}</a>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-4 fw-semibold text-muted">ایمیل</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$merchantData->email}}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-4 fw-semibold text-muted">شماره تلفن
                        {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="شماره تلفن باید فعال باشد"></i> --}}
                    </label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8 d-flex align-items-center">
                        @if($merchantData->home_phone && $merchantData->phone_verified)
                            <span class="fw-bold fs-6 text-gray-800 me-2">{{$merchantData->home_phone}}</span><span class="badge badge-success">تایید شده</span>
                        @else
                            <span>لطفا از بخش <a href="{{route('dashboard',['type' => 'details'])}}">جزئیات حساب</a> اقدام به ثبت و تایید شماره تلفن نمایید</span>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                {{-- <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-4 fw-semibold text-muted">آدرس دفتر مرکزی
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="آدرس دفتر مرکزی "></i>
                    </label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bold fs-6 text-gray-800">{{$merchantData->shop_address}}</span>
                    </div>
                    <!--end::Col-->
                </div> --}}
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Tags-->
                    <label class="col-lg-4 fw-semibold text-muted">زمینه فعالیت بازرگان
                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="زمینه فعالیت می تواند صادرات، واردات یا هر دو باشد"></i></label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        @if($merchantData->merchantUser->merchant_type == 'none')
                            <div class="badge badge-light-warning fw-bold">
                                نامشخص
                            </div>
                        @elseif($merchantData->merchantUser->merchant_type == 'import')
                            <div class="badge badge-light-primary fw-bold">
                                واردات
                            </div>
                        @elseif($merchantData->merchantUser->merchant_type == 'export')
                            <div class="badge badge-light-primary fw-bold">
                                صادرات
                            </div>
                        @elseif($merchantData->merchantUser->merchant_type == 'both')
                            <div class="badge badge-light-primary fw-bold">
                                واردات و صادرات
                            </div>
                        @endif
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                
                <!--end::Input group-->
                <!--begin::Notice-->
                {{-- <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">ما به توجه شما نیاز داریم</h4>
                            <div class="fs-6 text-gray-700">پرداخت شما رد شد. برای شروع استفاده از ابزار لطفا
                            <a class="fw-bold" href="../../demo1/dist/account/billing.html">روش پرداخت</a>.</div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div> --}}
                <!--end::Notice-->
            </div>
            <!--end::کارت body-->
        </div>
        <!--end::details نمایش-->
        <!--begin::Row-->
        {{-- <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-xl-8 mb-xl-10">
                <!--begin::Chart widget 5-->
                <div class="card card-flush h-lg-100">
                    <!--begin::Header-->
                    <div class="card-header flex-nowrap pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">بالا خریدن دسته بندی ها</span>
                            <span class="text-gray-400 pt-2 fw-semibold fs-6">8k بازدید کننده اجتماعی</span>
                        </h3>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Menu-->
                            <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                <span class="svg-icon svg-icon-1 svg-icon-gray-300 me-n1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                                        <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                        <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                        <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <!--begin::Menu 2-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">عملیات سریع</div>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator mb-3 opacity-75"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">تیکت جدید</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">جدید مشتری</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                    <!--begin::Menu item-->
                                    <a href="#" class="menu-link px-3">
                                        <span class="menu-title">گروه جدید</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <!--end::Menu item-->
                                    <!--begin::Menu sub-->
                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">گروه مدیر</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">گروه عضوها</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu sub-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator mt-3 opacity-75"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content px-3 py-3">
                                        <a class="btn btn-primary btn-sm px-4" href="#">Generate گزارشات</a>
                                    </div>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu 2-->
                            <!--end::Menu-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-5 ps-6">
                        <div id="kt_charts_widget_5" class="min-h-auto"></div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Chart widget 5-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-4 mb-5 mb-xl-10">
                <!--begin::Engage widget 1-->
                <div class="card h-md-100">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column flex-center">
                        <!--begin::Heading-->
                        <div class="mb-2">
                            <!--begin::Title-->
                            <h1 class="fw-semibold text-gray-800 text-center lh-lg">آیا سعی کرده ای
                            <br />new
                            <span class="fw-bolder">نرم افزار موبایل?</span></h1>
                            <!--end::Title-->
                            <!--begin::Illustration-->
                            <div class="py-10 text-center">
                                <img src="{{asset('adminbackend/assets/media/svg/illustrations/easy/1.svg')}}" class="theme-light-show w-200px" alt="" />
                                <img src="{{asset('adminbackend/assets/media/svg/illustrations/easy/1-dark.svg')}}" class="theme-dark-show w-200px" alt="" />
                            </div>
                            <!--end::Illustration-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Links-->
                        <div class="text-center mb-1">
                            <!--begin::Link-->
                            <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_create_app" data-bs-toggle="modal">تلاش مجدد</a>
                            <!--end::Link-->
                            <!--begin::Link-->
                            <a class="btn btn-sm btn-light" href="../../demo1/dist/apps/invoices/view/invoice-1.html">اطلاعات بیشتر</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Links-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Engage widget 1-->
            </div>
            <!--end::Col-->
        </div> --}}
        <!--end::Row-->
        <!--begin::Row-->
        {{-- <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-xl-4">
                <!--begin::لیست widget 5-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-7">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">محصولات تحویل</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">1 میلیون محصول تا کنون ارسال شده است</span>
                        </h3>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="btn btn-sm btn-light">جزییات سفارش</a>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Scroll-->
                        <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                            <!--begin::آیتم-->
                            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                <!--begin::Info-->
                                <div class="d-flex flex-stack mb-3">
                                    <!--begin::Wrapper-->
                                    <div class="me-3">
                                        <!--begin::Icon-->
                                        <img src="{{asset('adminbackend/assets/media/stock/ecommerce/210.gif')}}" class="w-50px ms-n1 me-1" alt="" />
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">فیل 1802</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Actions-->
                                    <div class="m-0">
                                        <!--begin::Menu-->
                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                                                    <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">عملیات سریع</div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">تیکت جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">جدید مشتری</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">گروه جدید</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate گزارشات</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Info-->
                                <!--begin::مشتری-->
                                <div class="d-flex flex-stack">
                                    <!--begin::نام-->
                                    <span class="text-gray-400 fw-bold">به:
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">جیسون بورن</a></span>
                                    <!--end::نام-->
                                    <!--begin::Tags-->
                                    <span class="badge badge-light-success">سفارش داده شده</span>
                                    <!--end::Tags-->
                                </div>
                                <!--end::مشتری-->
                            </div>
                            <!--end::آیتم-->
                            <!--begin::آیتم-->
                            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                <!--begin::Info-->
                                <div class="d-flex flex-stack mb-3">
                                    <!--begin::Wrapper-->
                                    <div class="me-3">
                                        <!--begin::Icon-->
                                        <img src="{{asset('adminbackend/assets/media/stock/ecommerce/209.gif')}}" class="w-50px ms-n1 me-1" alt="" />
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">لباس</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Actions-->
                                    <div class="m-0">
                                        <!--begin::Menu-->
                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                                                    <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">عملیات سریع</div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">تیکت جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">جدید مشتری</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">گروه جدید</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate گزارشات</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Info-->
                                <!--begin::مشتری-->
                                <div class="d-flex flex-stack">
                                    <!--begin::نام-->
                                    <span class="text-gray-400 fw-bold">به:
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">دورانت</a></span>
                                    <!--end::نام-->
                                    <!--begin::Tags-->
                                    <span class="badge badge-light-primary">حمل دریایی</span>
                                    <!--end::Tags-->
                                </div>
                                <!--end::مشتری-->
                            </div>
                            <!--end::آیتم-->
                            <!--begin::آیتم-->
                            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                <!--begin::Info-->
                                <div class="d-flex flex-stack mb-3">
                                    <!--begin::Wrapper-->
                                    <div class="me-3">
                                        <!--begin::Icon-->
                                        <img src="{{asset('adminbackend/assets/media/stock/ecommerce/214.gif')}}" class="w-50px ms-n1 me-1" alt="" />
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">تی شرت زرد</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Actions-->
                                    <div class="m-0">
                                        <!--begin::Menu-->
                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                                                    <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">عملیات سریع</div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">تیکت جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">جدید مشتری</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">گروه جدید</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate گزارشات</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Info-->
                                <!--begin::مشتری-->
                                <div class="d-flex flex-stack">
                                    <!--begin::نام-->
                                    <span class="text-gray-400 fw-bold">به:
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">علی کاربر</a></span>
                                    <!--end::نام-->
                                    <!--begin::Tags-->
                                    <span class="badge badge-light-danger">تایید شده</span>
                                    <!--end::Tags-->
                                </div>
                                <!--end::مشتری-->
                            </div>
                            <!--end::آیتم-->
                            <!--begin::آیتم-->
                            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                <!--begin::Info-->
                                <div class="d-flex flex-stack mb-3">
                                    <!--begin::Wrapper-->
                                    <div class="me-3">
                                        <!--begin::Icon-->
                                        <img src="{{asset('adminbackend/assets/media/stock/ecommerce/211.gif')}}" class="w-50px ms-n1 me-1" alt="" />
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">فیل 1802</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Actions-->
                                    <div class="m-0">
                                        <!--begin::Menu-->
                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                                                    <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">عملیات سریع</div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">تیکت جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">جدید مشتری</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">گروه جدید</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate گزارشات</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Info-->
                                <!--begin::مشتری-->
                                <div class="d-flex flex-stack">
                                    <!--begin::نام-->
                                    <span class="text-gray-400 fw-bold">به:
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">محمد ابراهیمی</a></span>
                                    <!--end::نام-->
                                    <!--begin::Tags-->
                                    <span class="badge badge-light-success">سفارش داده شده</span>
                                    <!--end::Tags-->
                                </div>
                                <!--end::مشتری-->
                            </div>
                            <!--end::آیتم-->
                            <!--begin::آیتم-->
                            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                <!--begin::Info-->
                                <div class="d-flex flex-stack mb-3">
                                    <!--begin::Wrapper-->
                                    <div class="me-3">
                                        <!--begin::Icon-->
                                        <img src="{{asset('adminbackend/assets/media/stock/ecommerce/215.gif')}}" class="w-50px ms-n1 me-1" alt="" />
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">لباس</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Actions-->
                                    <div class="m-0">
                                        <!--begin::Menu-->
                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                                                    <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">عملیات سریع</div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">تیکت جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">جدید مشتری</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">گروه جدید</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate گزارشات</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Info-->
                                <!--begin::مشتری-->
                                <div class="d-flex flex-stack">
                                    <!--begin::نام-->
                                    <span class="text-gray-400 fw-bold">به:
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">محمد رضایی</a></span>
                                    <!--end::نام-->
                                    <!--begin::Tags-->
                                    <span class="badge badge-light-primary">حمل دریایی</span>
                                    <!--end::Tags-->
                                </div>
                                <!--end::مشتری-->
                            </div>
                            <!--end::آیتم-->
                            <!--begin::آیتم-->
                            <div class="border border-dashed border-gray-300 rounded px-7 py-3">
                                <!--begin::Info-->
                                <div class="d-flex flex-stack mb-3">
                                    <!--begin::Wrapper-->
                                    <div class="me-3">
                                        <!--begin::Icon-->
                                        <img src="{{asset('adminbackend/assets/media/stock/ecommerce/192.gif')}}" class="w-50px ms-n1 me-1" alt="" />
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">تی شرت زرد</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Actions-->
                                    <div class="m-0">
                                        <!--begin::Menu-->
                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                                                    <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">عملیات سریع</div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">تیکت جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">جدید مشتری</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">گروه جدید</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate گزارشات</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Info-->
                                <!--begin::مشتری-->
                                <div class="d-flex flex-stack">
                                    <!--begin::نام-->
                                    <span class="text-gray-400 fw-bold">به:
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">اتنا رضایی</a></span>
                                    <!--end::نام-->
                                    <!--begin::Tags-->
                                    <span class="badge badge-light-danger">تایید شده</span>
                                    <!--end::Tags-->
                                </div>
                                <!--end::مشتری-->
                            </div>
                            <!--end::آیتم-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::لیست widget 5-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <!--begin::Table Widget 5-->
                <div class="card card-flush h-xl-100">
                    <!--begin::کارت header-->
                    <div class="card-header pt-7">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">گزارش استوک</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">کل 2,356 قلم موجود در انبار</span>
                        </h3>
                        <!--end::Title-->
                        <!--begin::Actions-->
                        <div class="card-toolbar">
                            <!--begin::فیلترها-->
                            <div class="d-flex flex-stack flex-wrap gap-4">
                                <!--begin::Destination-->
                                <div class="d-flex align-items-center fw-bold">
                                    <!--begin::Tags-->
                                    <div class="text-muted fs-7 me-2">دسته بندی</div>
                                    <!--end::Tags-->
                                    <!--begin::انتخاب-->
                                    <select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="انتخاب ">
                                        <option></option>
                                        <option value="مشاهده همه" selected="selected">مشاهده همه</option>
                                        <option value="a">دسته بندی A</option>
                                        <option value="b">دسته بندی B</option>
                                    </select>
                                    <!--end::انتخاب-->
                                </div>
                                <!--end::Destination-->
                                <!--begin::وضعیت-->
                                <div class="d-flex align-items-center fw-bold">
                                    <!--begin::Tags-->
                                    <div class="text-muted fs-7 me-2">وضعیت</div>
                                    <!--end::Tags-->
                                    <!--begin::انتخاب-->
                                    <select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="انتخاب " data-kt-table-widget-5="filter_status">
                                        <option></option>
                                        <option value="مشاهده همه" selected="selected">مشاهده همه</option>
                                        <option value="موجود">موجود</option>
                                        <option value="ناموجود">ناموجود</option>
                                        <option value="موجودی کم">موجودی کم</option>
                                    </select>
                                    <!--end::انتخاب-->
                                </div>
                                <!--end::وضعیت-->
                                <!--begin::جستجو-->
                                <a href="../../demo1/dist/apps/ecommerce/catalog/products.html" class="btn btn-light btn-sm">نمایش </a>
                                <!--end::جستجو-->
                            </div>
                            <!--begin::فیلترها-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::کارت header-->
                    <!--begin::کارت body-->
                    <div class="card-body">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px">آیتم</th>
                                    <th class="text-end pe-3 min-w-100px">محصولات شناسه</th>
                                    <th class="text-end pe-3 min-w-150px">تاریخ افزودن</th>
                                    <th class="text-end pe-3 min-w-100px">قیمت</th>
                                    <th class="text-end pe-3 min-w-50px">وضعیت</th>
                                    <th class="text-end pe-0 min-w-25px">تعداد</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <!--begin::آیتم-->
                                    <td>
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Macbook Air M1</a>
                                    </td>
                                    <!--end::آیتم-->
                                    <!--begin::محصولات شناسه-->
                                    <td class="text-end">#XGY-356</td>
                                    <!--end::محصولات شناسه-->
                                    <!--begin::تاریخ added-->
                                    <td class="text-end">02 فروردین, 2022</td>
                                    <!--end::تاریخ added-->
                                    <!--begin::قیمت-->
                                    <td class="text-end">$1,230</td>
                                    <!--end::قیمت-->
                                    <!--begin::وضعیت-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">موجود</span>
                                    </td>
                                    <!--end::وضعیت-->
                                    <!--begin::تعداد-->
                                    <td class="text-end" data-order="58">
                                        <span class="text-dark fw-bold">58 مورد</span>
                                    </td>
                                    <!--end::تعداد-->
                                </tr>
                                <tr>
                                    <!--begin::آیتم-->
                                    <td>
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Surface Laptop 4</a>
                                    </td>
                                    <!--end::آیتم-->
                                    <!--begin::محصولات شناسه-->
                                    <td class="text-end">#YHD-047</td>
                                    <!--end::محصولات شناسه-->
                                    <!--begin::تاریخ added-->
                                    <td class="text-end">01 فروردین, 2022</td>
                                    <!--end::تاریخ added-->
                                    <!--begin::قیمت-->
                                    <td class="text-end">$1,060</td>
                                    <!--end::قیمت-->
                                    <!--begin::وضعیت-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-danger">ناموجود</span>
                                    </td>
                                    <!--end::وضعیت-->
                                    <!--begin::تعداد-->
                                    <td class="text-end" data-order="0">
                                        <span class="text-dark fw-bold">0 مورد</span>
                                    </td>
                                    <!--end::تعداد-->
                                </tr>
                                <tr>
                                    <!--begin::آیتم-->
                                    <td>
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Logitech MX 250</a>
                                    </td>
                                    <!--end::آیتم-->
                                    <!--begin::محصولات شناسه-->
                                    <td class="text-end">#SRR-678</td>
                                    <!--end::محصولات شناسه-->
                                    <!--begin::تاریخ added-->
                                    <td class="text-end">24 اسفند, 2022</td>
                                    <!--end::تاریخ added-->
                                    <!--begin::قیمت-->
                                    <td class="text-end">$64</td>
                                    <!--end::قیمت-->
                                    <!--begin::وضعیت-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">موجود</span>
                                    </td>
                                    <!--end::وضعیت-->
                                    <!--begin::تعداد-->
                                    <td class="text-end" data-order="290">
                                        <span class="text-dark fw-bold">290 مورد</span>
                                    </td>
                                    <!--end::تعداد-->
                                </tr>
                                <tr>
                                    <!--begin::آیتم-->
                                    <td>
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">AudioEngine HD3</a>
                                    </td>
                                    <!--end::آیتم-->
                                    <!--begin::محصولات شناسه-->
                                    <td class="text-end">#PXF-578</td>
                                    <!--end::محصولات شناسه-->
                                    <!--begin::تاریخ added-->
                                    <td class="text-end">24 اسفند, 2022</td>
                                    <!--end::تاریخ added-->
                                    <!--begin::قیمت-->
                                    <td class="text-end">$1,060</td>
                                    <!--end::قیمت-->
                                    <!--begin::وضعیت-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-danger">ناموجود</span>
                                    </td>
                                    <!--end::وضعیت-->
                                    <!--begin::تعداد-->
                                    <td class="text-end" data-order="46">
                                        <span class="text-dark fw-bold">46 مورد</span>
                                    </td>
                                    <!--end::تعداد-->
                                </tr>
                                <tr>
                                    <!--begin::آیتم-->
                                    <td>
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">HP Hyper LTR</a>
                                    </td>
                                    <!--end::آیتم-->
                                    <!--begin::محصولات شناسه-->
                                    <td class="text-end">#PXF-778</td>
                                    <!--end::محصولات شناسه-->
                                    <!--begin::تاریخ added-->
                                    <td class="text-end">16 دی, 2022</td>
                                    <!--end::تاریخ added-->
                                    <!--begin::قیمت-->
                                    <td class="text-end">$4500</td>
                                    <!--end::قیمت-->
                                    <!--begin::وضعیت-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">موجود</span>
                                    </td>
                                    <!--end::وضعیت-->
                                    <!--begin::تعداد-->
                                    <td class="text-end" data-order="78">
                                        <span class="text-dark fw-bold">78 مورد</span>
                                    </td>
                                    <!--end::تعداد-->
                                </tr>
                                <tr>
                                    <!--begin::آیتم-->
                                    <td>
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary">Dell 32</a>
                                    </td>
                                    <!--end::آیتم-->
                                    <!--begin::محصولات شناسه-->
                                    <td class="text-end">#XGY-356</td>
                                    <!--end::محصولات شناسه-->
                                    <!--begin::تاریخ added-->
                                    <td class="text-end">22 آذر, 2022</td>
                                    <!--end::تاریخ added-->
                                    <!--begin::قیمت-->
                                    <td class="text-end">$1,060</td>
                                    <!--end::قیمت-->
                                    <!--begin::وضعیت-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-warning">موجودی کم</span>
                                    </td>
                                    <!--end::وضعیت-->
                                    <!--begin::تعداد-->
                                    <td class="text-end" data-order="8">
                                        <span class="text-dark fw-bold">8 مورد</span>
                                    </td>
                                    <!--end::تعداد-->
                                </tr>
                                <tr>
                                    <!--begin::آیتم-->
                                    <td>
                                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-dark text-hover-primary"> Pixel 6 </a>
                                    </td>
                                    <!--end::آیتم-->
                                    <!--begin::محصولات شناسه-->
                                    <td class="text-end">#XVR-425</td>
                                    <!--end::محصولات شناسه-->
                                    <!--begin::تاریخ added-->
                                    <td class="text-end">27 آذر, 2022</td>
                                    <!--end::تاریخ added-->
                                    <!--begin::قیمت-->
                                    <td class="text-end">$1,060</td>
                                    <!--end::قیمت-->
                                    <!--begin::وضعیت-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">موجود</span>
                                    </td>
                                    <!--end::وضعیت-->
                                    <!--begin::تعداد-->
                                    <td class="text-end" data-order="124">
                                        <span class="text-dark fw-bold">124 مورد</span>
                                    </td>
                                    <!--end::تعداد-->
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::کارت body-->
                </div>
                <!--end::Table Widget 5-->
            </div>
            <!--end::Col-->
        </div> --}}
        <!--end::Row-->
    </div>
    <!--end::Content container-->
</div>

@endsection