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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">مدیریت بازرگانان</h1>
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
                        <li class="breadcrumb-item text-muted">تایید بازرگانان</li>
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

            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">

                
                <div class="card card-flush">
                    <!--begin::کارت header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::کارت title-->
                        <div class="card-title">
                            <!--begin::جستجو-->
                            <form action="{{route('admin.merchant.status.search')}}" method="GET">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span role="button" onclick="document.querySelector('form').submit();" class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" name="query" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو بازرگان" />
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
                                    <th class="min-w-150px">نام بازرگان</th>
                                    <th class="min-w-100px text-center">ایمیل بازرگان</th>
                                    {{-- <th class="min-w-100px">مشخصات بازرگان</th> --}}
                                    <th class="min-w-100px">وضعیت بازرگان</th>
                                    <th class="text-center min-w-100px">عملیات</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">

                                @foreach ($MerchantStatus as $key => $item)
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
                                                <a href="{{route('merchant.details',$item->id)}}" class="symbol symbol-50px">
                                                    <span class="symbol-label" style="background-image:url({{!empty($item->photo) ? asset('storage/upload/merchant_images/' . $item->photo) : url(asset('storage/upload/no_image.jpg'))}});"></span>
                                                </a>
                                                <!--end::Thumbnail-->
                                                <div class="ms-5">
                                                    <!--begin::Title-->
                                                    <a href="{{route('merchant.details',$item->id)}}" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-item-filter="item_name">{{$item->shop_name}}</a>
                                                    <!--end::Title-->
                                                    <!--begin::توضیحات-->
                                                    <div class="text-muted fs-7 fw-bold">{{($item->username)}}</div>
                                                    <!--end::توضیحات-->
                                                </div>
                                            </div>
                                        </td>
                                        <!--end::دسته بندی=-->

                                        <!--begin::نوع=-->
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-primary fs-7 m-1">
                                                {{$item->email}}
                                            </div>
                                            <!--end::Badges-->
                                        </td>
                                        <!--end::نوع=-->

                                        <!--begin::نوع=-->
                                        {{-- <td>
                                            <!--begin::Badges-->
                                                @if($item->person_type == 'haghighi' || $item->person_type == 'hoghoghi')
                                                    @if($item->person_type == 'haghighi')
                                                        @if($item->shop_name != NULL && $item->shop_address != NULL && $item->national_code != NULL)
                                                            <div class="badge badge-light-success fs-7 m-1">
                                                                تکمیل شده
                                                            </div>
                                                        @else
                                                            <div class="badge badge-light-danger fs-7 m-1">
                                                                ناقص
                                                            </div>
                                                        @endif
                                                    @elseif($item->person_type == 'hoghoghi')
                                                        @if($item->shop_name != NULL && $item->shop_address != NULL && $item->company_number != NULL)
                                                            <div class="badge badge-light-success fs-7 m-1">
                                                                تکمیل شده
                                                            </div>
                                                        @else
                                                            <div class="badge badge-light-danger fs-7 m-1">
                                                                ناقص
                                                            </div>
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="badge badge-light-danger fs-7 m-1">
                                                        ناقص
                                                    </div>
                                                @endif
                                            <!--end::Badges-->
                                        </td> --}}
                                        <!--end::نوع=-->


                                        @if($item->status === 'inactive')
                                        
                                        <!--begin::نوع=-->
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-danger fs-7 m-1">
                                                 غیر فعال</div>
                                            <!--end::Badges-->
                                        </td>
                                        <!--end::نوع=-->


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
                                                    <form action="{{route('admin.merchant.statusChange')}}" method="POST">
                                                        @csrf    
                                                        <input type="hidden" value="{{($item->id)}}" name="merchant_id">
            
                                                        <button type="submit" href="#" class="btn btn-sm menu-link">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                        
                                                        <!--end::Svg Icon-->
                                                        فعال‌سازی</button>
                                                    </form>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{route('admin.merchant.statusView', $item->id)}}" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">نمایش اطلاعات</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                        <!--end::عملیات=-->
                                   
                                        @elseif($item->status === 'active')
                                    
                                        
                                        <!--begin::نوع=-->
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success fs-7 m-1">
                                                فعال</div>
                                            <!--end::Badges-->
                                        </td>
                                        <!--end::نوع=-->


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
                                                    <form action="{{route('admin.merchant.statusChange')}}" method="POST">
                                                        @csrf    
                                                        <input type="hidden" value="{{($item->id)}}" name="merchant_id">
            
                                                        <button type="submit" href="#" class="btn btn-sm menu-link">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                        
                                                        <!--end::Svg Icon-->
                                                        غیر فعالسازی</button>
                                                    </form>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{route('admin.merchant.statusView', $item->id)}}" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">نمایش اطلاعات</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                        <!--end::عملیات=-->

                                    @endif
                                
                                    </tr>
                                    <!--end::Table row-->
                                @endforeach


                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->

                        <div class="toolbox toolbox-pagination d-flex justify-content-center mt-5">
                            {{$MerchantStatus->withQueryString()->links('vendor.pagination.backend-dashboard') }}
                        </div>

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