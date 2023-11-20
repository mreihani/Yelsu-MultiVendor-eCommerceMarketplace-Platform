@extends('admin.admin_dashboard')
@section('admin')

<style>
    .dataTables_length label { display:none;}
    #kt_ecommerce_category_table_paginate .pagination { display:none;}
</style>

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">مدیریت شرکت باربری</h1>
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
                        <li class="breadcrumb-item text-muted">مدیریت کاربر</li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">تایید اطلاعات شرکت باربری</li>
                        <!--end::آیتم-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">

            

    <!--begin::Content wrapper-->
   
<!--begin::دسته بندی-->
<div class="d-flex flex-column flex-column-fluid">
    
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

            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">

                
                <div class="card card-flush">
                    <!--begin::کارت header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::کارت title-->
                        <div class="card-title">
                            <!--begin::جستجو-->
                            <form action="{{route('admin.freightage.profile.verifyAll.search')}}" method="GET">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span role="button" onclick="document.querySelector('form').submit();" class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    {{-- <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو شرکت باربری" /> --}}
                                    <input type="text" name="query" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو شرکت باربری" />
                                </div>
                            </form>    
                            <!--end::جستجو-->
                        </div>
                        <!--end::کارت title-->
                        <!--begin::کارت toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Add customer-->
                            
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
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-250px">شرکت باربری</th>
                                    <th class="min-w-150px text-center">ایمیل شرکت باربری</th>
                                    <th class="min-w-150px text-center">تلفن شرکت باربری</th>
                                    <th class="text-center min-w-70px">عملیات</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($users as $key => $item)
                                    
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
                                                <div class="d-flex">
                                                    <!--begin::Thumbnail-->
                                                    <a href="{{route('freightage.details', $item->id)}}" class="symbol symbol-50px">
                                                        <span class="symbol-label" style="background-image:url({{!empty($item->photo) ? asset('storage/upload/freightage_images/' . $item->photo) : url(asset('storage/upload/no_image.jpg'))}});"></span>
                                                    </a>
                                                    <!--end::Thumbnail-->
                                                    <div class="ms-5">
                                                        <!--begin::Title-->
                                                        <a href="{{route('freightage.details',$item->id)}}" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-item-filter="item_name">{{$item->shop_name}}</a>
                                                        <!--end::Title-->
                                                        <!--begin::توضیحات-->
                                                        <div class="text-muted fs-7 fw-bold">{{($item->username)}}</div>
                                                        <!--end::توضیحات-->
                                                    </div>
                                                </div>
                                            </td>
                                            <!--end::دسته بندی=-->

                                            <!--begin::نوع=-->
                                            <td class="pe-0 text-center">
                                                <a href="mailto:{{$item->email}}">
                                                    <span class="fw-bold">{{$item->email}}</span>
                                                </a>
                                            </td>
                                            <!--end::نوع=-->

                                            <!--begin::نوع=-->
                                            <td class="pe-0 text-center">
                                                <a href="tel:{{$item->home_phone}}">
                                                    <span class="fw-bold">{{$item->home_phone}}</span>
                                                </a>
                                            </td>
                                            <!--end::نوع=-->


                                            <!--begin::عملیات=-->
                                            <td class="text-end">
                                                <a class="btn btn-sm btn-primary" href="{{route('admin.freightage.profile.verify', $item->id)}}" class="menu-link px-3">بررسی </a>

                                                {{-- <form action="{{route('admin.vendor.statusChange')}}" method="POST">
                                                @csrf    
                    
                                                <input type="hidden" value="{{($item->id)}}" name="vendor_id">
                                                
                                                <button type="submit"  class="btn btn-sm btn-light btn-active-light-success">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                
                                                <!--end::Svg Icon-->
                                                فعال‌سازی</button>
                                                </form> --}}
                                            </td>
                                            <!--end::عملیات=-->
                                        </tr>
                                        <!--end::Table row-->
                                    
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                           
                        </table>

                        <div class="toolbox toolbox-pagination d-flex justify-content-center mt-5">
                            {{$users->withQueryString()->links('vendor.pagination.backend-dashboard') }}
                        </div>
                        
                        <!--end::Table-->
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
    {{-- <script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script> --}}
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.j')}}s"></script>
    <!--end::سفارشی Javascript-->

@endsection