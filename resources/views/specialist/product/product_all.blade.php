@extends('specialist.specialist_dashboard')
@section('specialist')

@if(Route::currentRouteName() == 'specialist.all.product')    
    <style>
        .dataTables_length label { display:none;}
        #kt_ecommerce_category_table_paginate .pagination { display:none;}
    </style>
@endif

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"><a href="">محصولات</a></h1>
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
                        <li class="breadcrumb-item text-muted"> محصولات</li>
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
            @if(session()->has('success'))
                <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action me-5 ms-5">
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
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::دسته بندی-->
                <div class="card card-flush">
                    <!--begin::کارت header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::کارت title-->
                        <div class="card-title">
                            <!--begin::جستجو-->
                            <form action="{{route('specialist.all.product.search')}}" method="GET">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span role="button" onclick="document.querySelector('form').submit();" class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    {{-- <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو محصول" /> --}}
                                    <input type="text" name="q" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو محصول" />
                                </div>
                            </form>       
                            <!--end::جستجو-->
                        </div>
                        <!--end::کارت title-->
                        <!--begin::کارت toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Add customer-->
                            <a href="{{route('specialist.add.product')}}" class="btn btn-primary">افزودن محصول</a>
                            <!--end::Add customer-->
                        </div>
                        <!--end::کارت toolbar-->
                    </div>
                    <!--end::کارت header-->
                    <!--begin::کارت body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_محصولات_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-200px">محصولات</th>
                                    <th class="text-center min-w-100px">نام / وضعیت کاربر</th>
                                    <th class="min-w-100px text-center">نوع کاربر</th>
                                    <th class="text-center min-w-200px">کدینگ محصول</th>
                                    <th class="text-end min-w-70px">موجودی انبار</th>
                                    <th class="text-end min-w-100px">قیمت</th>
                                    {{-- <th class="text-end min-w-100px">رتبه بندی</th> --}}
                                    <th class="text-end min-w-100px">وضعیت</th>
                                    <th class="text-end min-w-70px">عملیات</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->


                            <!--begin::Table body-->
                            
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">

                                @foreach ($products as $key => $item)
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <!--end::Checkbox-->
                                    <!--begin::دسته بندی=-->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin::Thumbnail-->
                                            <a href="{{$item->status == 'active' ? route('product.details', $item->product_slug) : ''}}" class="symbol symbol-50px">
                                                <span class="symbol-label" style="background-image:url({{asset($item->product_thumbnail_sm)}});"></span>
                                            </a>
                                            <!--end::Thumbnail-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="{{$item->status == 'active' ? route('product.details', $item->product_slug) : ''}}" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">{{$item->product_name}}</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <!--end::دسته بندی=-->
                                    <!--begin::کدینگ دسته بندی=-->
                                    <td class="pe-0 text-center">
                                        @if($item->vendor_id != NULL)
                                            {{$item->vendor->shop_name}}
                                            @if ($item->vendor->status == 'active')
                                                <div class="badge badge-primary">
                                                    <a class="text-white" href="{{route('vendor.details', $item->vendor->id)}}">
                                                        <span class="fw-bold">فعال</span>
                                                    </a>
                                                </div>
                                            @else 
                                                <div class="badge badge-danger">
                                                    <a class="text-white" href="{{route('vendor.details', $item->vendor->id)}}">
                                                        <span class="fw-bold">غیر فعال</span>
                                                    </a>
                                                </div>
                                            @endif
                                        @elseif($item->retailer_id != NULL)
                                            {{$item->retailer->shop_name}}
                                            @if ($item->retailer->status == 'active')
                                                <div class="badge badge-primary">
                                                    <a class="text-white" href="{{route('retailer.details', $item->retailer->id)}}">
                                                        <span class="fw-bold">فعال</span>
                                                    </a>
                                                </div>
                                            @else 
                                                <div class="badge badge-danger">
                                                    <a class="text-white" href="{{route('retailer.details', $item->retailer->id)}}">
                                                        <span class="fw-bold">غیر فعال</span>
                                                    </a>
                                                </div>
                                            @endif
                                        @elseif($item->merchant_id != NULL)
                                            {{$item->merchant->shop_name}}
                                            @if ($item->merchant->status == 'active')
                                                <div class="badge badge-primary">
                                                    <a class="text-white" href="{{route('merchant.details', $item->merchant->id)}}">
                                                        <span class="fw-bold">فعال</span>
                                                    </a>
                                                </div>
                                            @else 
                                                <div class="badge badge-danger">
                                                    <a class="text-white" href="{{route('merchant.details', $item->merchant->id)}}">
                                                        <span class="fw-bold">غیر فعال</span>
                                                    </a>
                                                </div>
                                            @endif
                                        @elseif($item->vendor_id == NULL && $item->merchant_id == NULL && $item->retailer_id == NULL)
                                            <div class="badge badge-secondary">
                                                <span class="fw-bold">یلسو</span>
                                            </div>
                                        @endif
                                    </td>
                                    <!--end::کدینگ دسته بندی=-->

                                    <!--begin::نوع کاربر=-->
                                    <td class="pe-0 text-center">
                                        {{$item->user}}
                                        @if($item->vendor_id != NULL)
                                            <div class="badge badge-secondary">
                                                <span class="fw-bold">تأمین کننده</span>
                                            </div>
                                        @elseif($item->retailer_id != NULL)
                                            <div class="badge badge-secondary">
                                                <span class="fw-bold">خرده فروش</span>
                                            </div>
                                        @elseif($item->merchant_id != NULL)
                                            <div class="badge badge-secondary">
                                                <span class="fw-bold">بازرگان</span>
                                            </div>
                                        @elseif($item->vendor_id == NULL && $item->merchant_id == NULL && $item->retailer_id == NULL)
                                            <div class="badge badge-secondary">
                                                <span class="fw-bold">مدیریت</span>
                                            </div>
                                        @endif
                                    </td>
                                    <!--end::نوع کاربر=-->

                                    <!--begin::کدینگ دسته بندی=-->
                                    <td class="pe-0 text-center">
                                        <span class="fw-bold">{{$item->category_id}}</span>
                                    </td>
                                    <!--end::کدینگ دسته بندی=-->

                                    <!--begin::تعداد=-->
                                    <td class="text-end pe-0" data-order="30">
                                        <span class="fw-bold ms-3">{{$item->product_qty == NULL || $item->unlimitedStock == 'active' ? 'نامحدود' : ($item->product_qty != 0 ? $item->product_qty : 'ناموجود')}}</span>
                                    </td>
                                    <!--end::تعداد=-->
                                    <!--begin::قیمت=-->
                                    <td class="text-end pe-0">{{$item->selling_price}} {{$item->determine_product_currency()}}</td>
                                    <!--end::قیمت=-->
                                    <!--begin::rating-->
                                    {{-- <td class="text-end pe-0" data-order="rating-4">
                                        <div class="rating justify-content-end">
                                            <div class="rating-label checked">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <div class="rating-label checked">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <div class="rating-label checked">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <div class="rating-label checked">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <div class="rating-label">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                        </div>
                                    </td> --}}
                                    <!--end::rating-->
                                    <!--begin::وضعیت=-->
                                    @if($item->status !== 'active')
                                    <td class="text-end pe-0" data-order="در حال بازبینی">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-warning">در حال بازبینی</div>
                                        <!--end::Badges-->
                                    </td>
                                    @else
                                    <td class="text-end pe-0" data-order="منتشر شده">
                                        <!--begin::Badges-->
                                        <div class="badge badge-success">منتشر شده</div>
                                        <!--end::Badges-->
                                    </td>
                                    @endif
                                    <!--end::وضعیت=-->
                                    <!--begin::عملیات=-->
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">عملیات
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-5 m-0">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{route('specialist.edit.product',$item->id)}}" class="menu-link px-3">ویرایش</a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{route('specialist.delete.product',$item->id)}}" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row" onclick ="return confirm('آیا برای انجام این کار اطمینان دارید؟')">حذف</a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{route('specialist.copy.product',$item->id)}}" class="menu-link px-3">رونوشت</a>
                                            </div>
                                            <!--end::Menu item-->

                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::عملیات=-->
                                </tr>
                                <!--end::Table row-->
                                @endforeach
                            </tbody>
                            <!--end::Table body-->

                        </table>
                        <!--end::Table-->

                        @if(Route::currentRouteName() == 'specialist.all.product')    
                            <div class="toolbox toolbox-pagination d-flex justify-content-center mt-5">
                                {{$products->links('vendor.pagination.backend-dashboard')}}
                            </div>
                        @endif

                    </div>
                    <!--end::کارت body-->
                </div>
                <!--end::دسته بندی-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

</div>

    <!--begin::سفارشی Javascript(used for this page only)-->
    <script src="{{asset('adminbackend/assets/js/custom/apps/ecommerce/catalog/categories.js')}}"></script>
    {{-- <script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script> --}}
    {{-- <script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script> --}}
    {{-- <script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script> --}}
    {{-- <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script> --}}
    {{-- <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script> --}}
    {{-- <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.j')}}s"></script> --}}
    <!--end::سفارشی Javascript-->

@endsection