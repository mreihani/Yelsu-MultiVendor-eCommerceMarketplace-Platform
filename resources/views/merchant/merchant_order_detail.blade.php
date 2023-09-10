@extends('merchant.merchant_dashboard')
@section('merchant')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">جزییات سفارش</h1>
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
                        <li class="breadcrumb-item text-muted">تجارت الکترونیک</li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">فروش</li>
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
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_637dc72eee6d1">
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
                                        <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="انتخاب گزینه" data-dropdown-parent="#kt_menu_637dc72eee6d1" data-allow-clear="true">
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
            <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5">
                <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
            </div>
            @endif
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Order details page-->
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-lg-n2 me-auto">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_summary">خلاصه سفارش</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            {{-- <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_history">تاریخچه سفارش</a>
                            </li> --}}
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin::Button-->
                        {{-- <a href="../../demo1/dist/apps/ecommerce/sales/listing.html" class="btn btn-icon btn-light btn-sm ms-auto me-lg-n7">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </a> --}}
                        <!--end::Button-->
                        <!--begin::Button-->
                        {{-- <a href="../../demo1/dist/apps/ecommerce/sales/edit-order.html" class="btn btn-success btn-sm me-lg-n7"> Order</a> --}}
                        <!--end::Button-->
                        <!--begin::Button-->
                        {{-- <a href="../../demo1/dist/apps/ecommerce/sales/add-order.html" class="btn btn-primary btn-sm">افزودن سفارش جدید</a> --}}
                        <!--end::Button-->
                    </div>
                    <!--begin::خلاصه سفارش-->
                    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                        <!--begin::Order details-->
                        <div class="card card-flush py-4 flex-row-fluid">
                            <!--begin::کارت header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>جزییات سفارش {{$order->id}}</h2>
                                </div>
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <!--begin::Table body-->
                                        <tbody class="fw-semibold text-gray-600">
                                            <!--begin::تاریخ-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="currentColor" />
                                                            <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->تاریخ افزودن</div>
                                                </td>
                                                <td class="fw-bold text-end">{{jdate($order->created_at)->format('Y/m/d')}}</td>
                                            </tr>
                                            <!--end::تاریخ-->
                                            <!--begin::روش پرداخت-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor" />
                                                            <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->روش پرداخت</div>
                                                </td>
                                                <td class="fw-bold text-end">آنلاین
                                                {{-- <img src="assets/media/svg/card-logos/visa.svg" class="w-50px ms-2" /></td> --}}
                                            </tr>
                                            <!--end::روش پرداخت-->
                                            <!--begin::تاریخ-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->روش حمل و نقل</div>
                                                </td>
                                                <td class="fw-bold text-end">نرخ حمل و نقل </td>
                                            </tr>
                                            <!--end::تاریخ-->
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::Order details-->
                        <!--begin::جزییات مشتری-->
                        <div class="card card-flush py-4 flex-row-fluid">
                            <!--begin::کارت header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>اطلاعات کاربر</h2>
                                </div>
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <!--begin::Table body-->
                                        <tbody class="fw-semibold text-gray-600">
                                            <!--begin::مشتری name-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor" />
                                                            <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor" />
                                                            <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->نام و نام خانوادگی </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <!--begin:: آواتار -->
                                                        {{-- <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                            <a href="../../demo1/dist/apps/ecommerce/customers/details.html">
                                                                <div class="symbol-label">
                                                                    <img src="assets/media/avatars/300-23.jpg" alt="علی کاربر" class="w-100" />
                                                                </div>
                                                            </a>
                                                        </div> --}}
                                                        <!--end::Avatar-->
                                                        <!--begin::نام-->
                                                        <a href="" class="text-gray-600 text-hover-primary">{{$order->user->firstname .' '. $order->user->lastname}}</a>
                                                        <!--end::نام-->
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--end::مشتری name-->
                                            <!--begin::مشتری email-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                            <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->ایمیل</div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-600 text-hover-primary">{{$order->user->email}}</a>
                                                </td>
                                            </tr>
                                            <!--end::روش پرداخت-->
                                            <!--begin::تاریخ-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->تلفن</div>
                                                </td>
                                                <td class="fw-bold text-end">{{$order->home_phone}}</td>
                                            </tr>
                                            <!--end::تاریخ-->
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::جزییات مشتری-->
                        <!--begin::اسناد-->
                        {{-- <div class="card card-flush py-4 flex-row-fluid">
                            <!--begin::کارت header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>تغییر وضعیت سفارش</h2>
                                </div>
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <div class="card card-flush py-4">
                                        <!--begin::کارت body-->
                                        <div class="card-body pt-0">
                                            <form action="{{route('merchant.order.changeStatus',$order->id)}}" method="POST">
                                            @csrf
                                            <!--begin::انتخاب2-->
                                            <select name="status" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="انتخاب " id="kt_ecommerce_add_category_status_select">
                                                <option></option>
                                                <option {{$order->status == 'paid' ? 'selected' : ''}} value="paid">پرداخت موفق</option>
                                                <option {{$order->status == 'unpaid' ? 'selected' : ''}} value="unpaid">پرداخت ناموفق</option>
                                                <option {{$order->status == 'preparation' ? 'selected' : ''}} value="preparation">در حال پردازش</option>
                                                <option {{$order->status == 'posted' ? 'selected' : ''}} value="posted">ارسال شده</option>
                                                <option {{$order->status == 'received' ? 'selected' : ''}} value="received">دریافت شده</option>
                                                <option {{$order->status == 'cancelled' ? 'selected' : ''}} value="cancelled">لغو شده</option>
                                            </select>
                                            <!--end::انتخاب2-->
                                 
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">
                                                        <span class="indicator-label">ذخیره تغییرات</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!--end::کارت body-->
                                    </div>
                                    <!--end::Table-->
                                </div>

                            </div>
                            <!--end::کارت body-->
                        </div> --}}
                        <!--end::اسناد-->
                    </div>
                    <!--end::خلاصه سفارش-->
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                            <!--begin::سفارشات-->
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                    <!--begin::پرداخت address-->
                                    @if ($order->user->home_city)
                                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                            <!--begin::برگشتground-->
                                            <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                                <img src="assets/media/icons/duotune/ecommerce/ecm001.svg" class="w-175px" />
                                            </div>
                                            <!--end::برگشتground-->
                                            <!--begin::کارت header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>آدرس محل سکونت کاربر</h2>
                                                </div>
                                            </div>
                                            <!--end::کارت header-->
                                            <!--begin::کارت body-->
                                            <div class="card-body pt-0">
                                                <table class="address-table">
                                                    <tbody>
                                                    
                                                        <tr>
                                                            <th>استان:</th>
                                                            <td>{{$order->user->home_province}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th>شهر:</th>
                                                            <td>{{$order->user->home_city}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th>آدرس: </th>
                                                            <td>{{$order->user->home_address}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>کد پستی :</th>
                                                            <td>{{$order->user->home_postalcode}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>تلفن: </th>
                                                            <td>{{$order->user->home_phone}}</td>
                                                        </tr>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::کارت body-->
                                        </div>
                                    @endif
                                    <!--end::پرداخت address-->
                                    <!--begin::حمل دریایی address-->
                                    @if ($order->user->shipping_city)
                                        <!--begin::حمل دریایی address-->
                                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                            <!--begin::برگشتground-->
                                            <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                                <img src="assets/media/icons/duotune/ecommerce/ecm006.svg" class="w-175px" />
                                            </div>
                                            <!--end::برگشتground-->
                                            <!--begin::کارت header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>آدرس ارسال سفارش</h2>
                                                </div>
                                            </div>
                                            <!--end::کارت header-->
                                            <!--begin::کارت body-->
                                            <div class="card-body pt-0">
                                                <table class="address-table">
                                                    <tbody>
                                                        <tr>
                                                            <th>استان:</th>
                                                            <td>{{$order->user->shipping_province}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th>شهر:</th>
                                                            <td>{{$order->user->shipping_city}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th>آدرس: </th>
                                                            <td>{{$order->user->shipping_address}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>کد پستی :</th>
                                                            <td>{{$order->user->shipping_postalcode}}</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::کارت body-->
                                        </div>
                                    @endif  
                                    <!--end::حمل دریایی address-->
                                </div>



                                <!--begin::جزئیات صورتحساب-->
                                <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                    <!--begin::کارت header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>جزئیات صورتحساب</h2>
                                        </div>
                                    </div>
                                    <!--end::کارت header-->
                                    <!--begin::کارت body-->
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="address-table">
                                                <tbody>
                                                    @if($order->person_type == "haghighi")
                                                        <tr>
                                                            <th>شخص حقیقی</th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>نام:</th>
                                                            <td>{{$order->firstname}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th>نام خانوادگی:</th>
                                                            <td>{{$order->lastname}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th>کد ملی: </th>
                                                            <td>{{$order->national_code}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>یادداشت سفارش: </th>
                                                            <td>{{$order->order_note}}</td>
                                                        </tr>
                                                    @elseif($order->person_type == "hoghoghi")
                                                    <tr>
                                                        <th>شخص حقوقی</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>نام شرکت:</th>
                                                        <td>{{$order->company_name}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th>شماره شناسه شرکت:</th>
                                                        <td>{{$order->company_number}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th>نام نماینده: </th>
                                                        <td>{{$order->agent_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>یادداشت سفارش: </th>
                                                        <td>{{$order->order_note}}</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::کارت body-->
                                </div>
                                <!--end::جزئیات صورتحساب-->


                                
                                <!--begin::محصولات لیست-->
                                <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                    <!--begin::کارت header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>سفارش {{$order->id}}</h2>
                                        </div>
                                    </div>
                                    <!--end::کارت header-->
                                    <!--begin::کارت body-->
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-175px">محصولات</th>
                                                        <th class="min-w-70px text-end">نام فروشنده</th>
                                                        <th class="min-w-100px text-end">SKU</th>
                                                        <th class="min-w-70px text-end">تعداد</th>
                                                        <th class="min-w-100px text-end">قیمت واحد</th>
                                                        <th class="min-w-100px text-end">کل</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-semibold text-gray-600">
                                                    @foreach ($order->products as $product)
                                                    <!--begin::محصولات-->
                                                    <tr>
                                                        <!--begin::product-->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Thumbnail-->
                                                                <a href="{{route('product.details',$product->product_slug)}}" class="symbol symbol-50px">
                                                                    <span class="symbol-label" style="background-image:url({{(!empty($product->product_thumbnail)) ? url($product->product_thumbnail) : url('storage/upload/no_image_product.jpg')}});"></span>
                                                                </a>
                                                                <!--end::Thumbnail-->
                                                                <!--begin::Title-->
                                                                <div class="ms-5">
                                                                    <a href="{{route('product.details',$product->product_slug)}}" class="fw-bold text-gray-600 text-hover-primary">{{$product->product_name}}</a>
                                                                    {{-- <div class="fs-7 text-muted">تحویل تاریخ: 23/11/2022</div> --}}
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </td>
                                                        <!--end::product-->
                                                        <!--begin::Vendor Name-->
                                                        @php
                                                            $user = App\Models\User::find($product->merchant_id);
                                                            if($user) {
                                                                $merchant_info = $user->firstname .' '. $user->lastname;
                                                            } else {
                                                                $merchant_info = "مدیریت";
                                                            }
                                                        @endphp 
                                                        <td class="text-end">{{$merchant_info}}</td>
                                                        <!--end::Vendor Name-->
                                                        <!--begin::SKU-->
                                                        <td class="text-end">{{$product->product_code}}</td>
                                                        <!--end::SKU-->
                                                        <!--begin::Quantity-->
                                                        <td class="text-end">{{$product->pivot->quantity}}</td>
                                                        <!--end::Quantity-->
                                                        <!--begin::قیمت-->
                                                        @if ($product->currency == 'toman')
                                                            <td class="text-end">{{$product->pivot->price}} تومان</td>
                                                        @elseif($product->currency == 'dollar')
                                                            <td class="text-end">{{$product->pivot->price}} دلار</td>
                                                        @elseif($product->currency == 'euro')
                                                            <td class="text-end">{{$product->pivot->price}} یورو</td>
                                                        @endif
                                                        <!--end::قیمت-->
                                                        <!--begin::کل-->
                                                        @if ($product->currency == 'toman')
                                                            <td class="text-end">{{$product->pivot->quantity * $product->pivot->price}} تومان</td>
                                                        @elseif($product->currency == 'dollar')
                                                            <td class="text-end">{{$product->pivot->quantity * $product->pivot->price}} دلار</td>
                                                        @elseif($product->currency == 'euro')
                                                            <td class="text-end">{{$product->pivot->quantity * $product->pivot->price}} یورو</td>
                                                        @endif
                                                        <!--end::کل-->
                                                    </tr>
                                                    @endforeach

                                                    <!--end::محصولات-->
                                                    <!--begin::جمع کل-->
                                                    {{-- <tr>
                                                        <td colspan="4" class="text-end">جمع کل</td>
                                                        <td class="text-end">{{$order->price}}</td>
                                                    </tr> --}}
                                                    <!--end::جمع کل-->
                                                    <!--begin::VAT-->
                                                    {{-- <tr>
                                                        <td colspan="4" class="text-end">VAT (0%)</td>
                                                        <td class="text-end">$0.00</td>
                                                    </tr> --}}
                                                    <!--end::VAT-->
                                                    <!--begin::حمل دریایی-->
                                                    {{-- <tr>
                                                        <td colspan="4" class="text-end">حمل دریایی نرخ</td>
                                                        <td class="text-end">$5.00</td>
                                                    </tr> --}}
                                                    <!--end::حمل دریایی-->
                                                    <!--begin::Grو total-->
                                                    <tr>
                                                        <td colspan="4" class="fs-3 text-dark text-end">کل</td>
                                                        <td class="text-dark fs-3 fw-bolder text-end">{{$order->price}} تومان</td>
                                                    </tr>
                                                    <!--end::Grو total-->
                                                </tbody>
                                                <!--end::Table head-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::کارت body-->
                                </div>
                                <!--end::محصولات لیست-->
                            </div>
                            <!--end::سفارشات-->
                        </div>
                        <!--end::Tab pane-->
                        <!--begin::Tab pane-->
                        {{-- <div class="tab-pane fade" id="kt_ecommerce_sales_order_history" role="tab-panel">
                            <!--begin::سفارشات-->
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::Order history-->
                                <div class="card card-flush py-4 flex-row-fluid">
                                    <!--begin::کارت header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>تاریخچه سفارش</h2>
                                        </div>
                                    </div>
                                    <!--end::کارت header-->
                                    <!--begin::کارت body-->
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-100px">تاریخ افزودن</th>
                                                        <th class="min-w-175px">نظر</th>
                                                        <th class="min-w-70px">وضعیت سفارش</th>
                                                        <th class="min-w-100px">اطلاع به مشتری</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-semibold text-gray-600">
                                                    <tr>
                                                        <!--begin::تاریخ-->
                                                        <td>23/11/2022</td>
                                                        <!--end::تاریخ-->
                                                        <!--begin::Comment-->
                                                        <td>تکمیل سفارش</td>
                                                        <!--end::Comment-->
                                                        <!--begin::وضعیت-->
                                                        <td>
                                                            <!--begin::Badges-->
                                                            <div class="badge badge-light-success">کامل شد</div>
                                                            <!--end::Badges-->
                                                        </td>
                                                        <!--end::وضعیت-->
                                                        <!--begin::مشتری Notified-->
                                                        <td>خیر</td>
                                                        <!--end::مشتری Notified-->
                                                    </tr>
                                                    <tr>
                                                        <!--begin::تاریخ-->
                                                        <td>22/11/2022</td>
                                                        <!--end::تاریخ-->
                                                        <!--begin::Comment-->
                                                        <td>سفارش دریافت شده توسط مشتری</td>
                                                        <!--end::Comment-->
                                                        <!--begin::وضعیت-->
                                                        <td>
                                                            <!--begin::Badges-->
                                                            <div class="badge badge-light-success">سفارش داده شده</div>
                                                            <!--end::Badges-->
                                                        </td>
                                                        <!--end::وضعیت-->
                                                        <!--begin::مشتری Notified-->
                                                        <td>بله</td>
                                                        <!--end::مشتری Notified-->
                                                    </tr>
                                                    <tr>
                                                        <!--begin::تاریخ-->
                                                        <td>21/11/2022</td>
                                                        <!--end::تاریخ-->
                                                        <!--begin::Comment-->
                                                        <td>سفارش از انبار ارسال می شود</td>
                                                        <!--end::Comment-->
                                                        <!--begin::وضعیت-->
                                                        <td>
                                                            <!--begin::Badges-->
                                                            <div class="badge badge-light-primary">در حال تحویل</div>
                                                            <!--end::Badges-->
                                                        </td>
                                                        <!--end::وضعیت-->
                                                        <!--begin::مشتری Notified-->
                                                        <td>بله</td>
                                                        <!--end::مشتری Notified-->
                                                    </tr>
                                                    <tr>
                                                        <!--begin::تاریخ-->
                                                        <td>20/11/2022</td>
                                                        <!--end::تاریخ-->
                                                        <!--begin::Comment-->
                                                        <td>پرداخت دریافت کرد</td>
                                                        <!--end::Comment-->
                                                        <!--begin::وضعیت-->
                                                        <td>
                                                            <!--begin::Badges-->
                                                            <div class="badge badge-light-primary">در حال پردازش</div>
                                                            <!--end::Badges-->
                                                        </td>
                                                        <!--end::وضعیت-->
                                                        <!--begin::مشتری Notified-->
                                                        <td>خیر</td>
                                                        <!--end::مشتری Notified-->
                                                    </tr>
                                                    <tr>
                                                        <!--begin::تاریخ-->
                                                        <td>19/11/2022</td>
                                                        <!--end::تاریخ-->
                                                        <!--begin::Comment-->
                                                        <td>در انتظار پرداخت</td>
                                                        <!--end::Comment-->
                                                        <!--begin::وضعیت-->
                                                        <td>
                                                            <!--begin::Badges-->
                                                            <div class="badge badge-light-warning">در انتظار</div>
                                                            <!--end::Badges-->
                                                        </td>
                                                        <!--end::وضعیت-->
                                                        <!--begin::مشتری Notified-->
                                                        <td>خیر</td>
                                                        <!--end::مشتری Notified-->
                                                    </tr>
                                                    <tr>
                                                        <!--begin::تاریخ-->
                                                        <td>18/11/2022</td>
                                                        <!--end::تاریخ-->
                                                        <!--begin::Comment-->
                                                        <td>بروز رسانی پرداخت</td>
                                                        <!--end::Comment-->
                                                        <!--begin::وضعیت-->
                                                        <td>
                                                            <!--begin::Badges-->
                                                            <div class="badge badge-light-warning">در انتظار</div>
                                                            <!--end::Badges-->
                                                        </td>
                                                        <!--end::وضعیت-->
                                                        <!--begin::مشتری Notified-->
                                                        <td>خیر</td>
                                                        <!--end::مشتری Notified-->
                                                    </tr>
                                                    <tr>
                                                        <!--begin::تاریخ-->
                                                        <td>17/11/2022</td>
                                                        <!--end::تاریخ-->
                                                        <!--begin::Comment-->
                                                        <td>منقضی شدن روش پرداخت</td>
                                                        <!--end::Comment-->
                                                        <!--begin::وضعیت-->
                                                        <td>
                                                            <!--begin::Badges-->
                                                            <div class="badge badge-light-danger">ناموفق</div>
                                                            <!--end::Badges-->
                                                        </td>
                                                        <!--end::وضعیت-->
                                                        <!--begin::مشتری Notified-->
                                                        <td>بله</td>
                                                        <!--end::مشتری Notified-->
                                                    </tr>
                                                    <tr>
                                                        <!--begin::تاریخ-->
                                                        <td>16/11/2022</td>
                                                        <!--end::تاریخ-->
                                                        <!--begin::Comment-->
                                                        <td>در انتظار پرداخت</td>
                                                        <!--end::Comment-->
                                                        <!--begin::وضعیت-->
                                                        <td>
                                                            <!--begin::Badges-->
                                                            <div class="badge badge-light-warning">در انتظار</div>
                                                            <!--end::Badges-->
                                                        </td>
                                                        <!--end::وضعیت-->
                                                        <!--begin::مشتری Notified-->
                                                        <td>خیر</td>
                                                        <!--end::مشتری Notified-->
                                                    </tr>
                                                    <tr>
                                                        <!--begin::تاریخ-->
                                                        <td>15/11/2022</td>
                                                        <!--end::تاریخ-->
                                                        <!--begin::Comment-->
                                                        <td>سفارش دریافت شده</td>
                                                        <!--end::Comment-->
                                                        <!--begin::وضعیت-->
                                                        <td>
                                                            <!--begin::Badges-->
                                                            <div class="badge badge-light-warning">در انتظار</div>
                                                            <!--end::Badges-->
                                                        </td>
                                                        <!--end::وضعیت-->
                                                        <!--begin::مشتری Notified-->
                                                        <td>بله</td>
                                                        <!--end::مشتری Notified-->
                                                    </tr>
                                                </tbody>
                                                <!--end::Table head-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::کارت body-->
                                </div>
                                <!--end::Order history-->
                                <!--begin::Order data-->
                                <div class="card card-flush py-4 flex-row-fluid">
                                    <!--begin::کارت header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>تاریخ سفارش</h2>
                                        </div>
                                    </div>
                                    <!--end::کارت header-->
                                    <!--begin::کارت body-->
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                                                <!--begin::Table body-->
                                                <tbody class="fw-semibold text-gray-600">
                                                    <!--begin::IP address-->
                                                    <tr>
                                                        <td class="text-muted">ادرس ای پی</td>
                                                        <td class="fw-bold text-end">172.68.221.26</td>
                                                    </tr>
                                                    <!--end::IP address-->
                                                    <!--begin::آی پی فوروارد شده-->
                                                    <tr>
                                                        <td class="text-muted">آی پی فوروارد شده</td>
                                                        <td class="fw-bold text-end">89.201.163.49</td>
                                                    </tr>
                                                    <!--end::آی پی فوروارد شده-->
                                                    <!--begin::کاربر agent-->
                                                    <tr>
                                                        <td class="text-muted">کاربر آژانس</td>
                                                        <td class="fw-bold text-end">Mozilla/5.0 (Windows NT 10.0; Win64; x64) اپلیکیشنleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36</td>
                                                    </tr>
                                                    <!--end::کاربر agent-->
                                                    <!--begin::Accept language-->
                                                    <tr>
                                                        <td class="text-muted">تایید زبان</td>
                                                        <td class="fw-bold text-end">en-GB,en-ایران;q=0.9,en;q=0.8</td>
                                                    </tr>
                                                    <!--end::Accept language-->
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::کارت body-->
                                </div>
                                <!--end::Order data-->
                            </div>
                            <!--end::سفارشات-->
                        </div> --}}
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                </div>
                <!--end::Order details page-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</div>


<!--begin::سفارشی Javascript(used for this page only)-->
<script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/new-target.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.js')}}"></script>
<!--end::سفارشی Javascript-->


@endsection