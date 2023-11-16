@extends('admin.admin_dashboard')
@section('admin')

@if(Route::currentRouteName() == 'visit.all')    
    <style>
        .dataTables_length label { display:none;}
        #kt_ecommerce_category_table_paginate .pagination { display:none;}
    </style>
@endif

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">اطلاعات بازدید</h1>
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
                        <li class="breadcrumb-item text-muted">بازدید ها</li>
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
                            <form action="{{route('admin.visit.search')}}" method="GET">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span role="button" onclick="document.querySelector('form').submit();" class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    {{-- <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو کاربر" /> --}}
                                    <input type="text" name="q" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو کاربر" />
                                </div>
                            </form>
                            <!--end::جستجو-->
                        </div>
                        <!--end::کارت title-->
                        <!--begin::کارت toolbar-->
                        {{-- <div class="card-toolbar">
                            <!--begin::Add customer-->
                            <a href="{{route('admin.users.add')}}" class="btn btn-primary">افزودن کاربر</a>
                            <!--end::Add customer-->
                        </div> --}}
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
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1">
                                        </div>
                                    </th>
                                    <th class="">مشخصات کاربر</th>
                                    <th class="min-w-100px">
                                        آدرس
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="برای نمایش آدرس مورد نظر نشانه گر را روی دکمه کپی شناور کنید."></i>
                                    </th>
                                    <th class="">دستگاه</th>
                                    <th class="">پلتفرم</th>
                                    <th class="">مرورگر</th>
                                    <th class="">
                                        آدرس ip
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="برای کسب اطلاعات جغرافیایی ip مورد نظر روی آن کلیک نمایید."></i>
                                    </th>
                                    <th class="">تاریخ بازدید</th>
                                    <th class="">ساعت بازدید</th>
                                    <th class="text-center min-w-100px">
                                        عملیات
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="برای نمایش تمامی بازدید های یک فرد یا ip مشخص بر روی دکمه 'نمایش بازدید ها' کلیک نمایید."></i>
                                    </th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">

                                @foreach($visits as $visit)
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Checkbox-->
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1">
                                            </div>
                                        </td>
                                        <!--end::Checkbox-->
                                        <!--begin::کاربر=-->
                                        <td class="d-flex align-items-center">
                                            <!--begin:: آواتار -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="">
                                                    <div class="symbol-label">
                                                        <div class="symbol-label fs-3 bg-light-info text-info">
                                                            @if($visit->user)
                                                                {{mb_substr($visit->user->lastname, 0, 1, "UTF-8")}}
                                                            @else
                                                                ن
                                                            @endif
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::کاربر details-->
                                            <div class="d-flex flex-column">
                                                <div class="text-gray-800 mb-1" data-toggle="tooltip" data-placement="top" title="{{$visit->user ? $visit->user->email : ""}}">
                                                    {{$visit->user ? ($visit->user->firstname .' ' . $visit->user->lastname) : "نامشخص"}}
                                                </div>
                                                
                                                <span>
                                                    <!--begin::سطح دسترسی=-->
                                                    @if($visit->user && $visit->user->role == 'admin')
                                                        <div class="badge badge-light-success fw-bold">
                                                            مدیریت
                                                        </div>
                                                    @elseif($visit->user && $visit->user->role == 'vendor')
                                                        <div class="badge badge-light-info fw-bold">
                                                            تأمین کننده
                                                        </div>
                                                    @elseif($visit->user && $visit->user->role == 'visit->user')
                                                        <div class="badge badge-light-warning fw-bold">
                                                            کاربر عادی 
                                                        </div>
                                                    @elseif($visit->user && $visit->user->role == 'editor')
                                                        <div class="badge badge-light-info fw-bold">
                                                            نویسنده
                                                        </div>
                                                    @elseif($visit->user && $visit->user->role == 'specialist')
                                                        <div class="badge badge-light-primary fw-bold">کارشناس {{$visit->user->specialist_category->category_name}}</div>
                                                    @elseif($visit->user && $visit->user->role == 'financial')
                                                        <div class="badge badge-light-info fw-bold">
                                                            کارشناس مالی
                                                        </div> 
                                                    @elseif($visit->user && $visit->user->role == 'merchant')
                                                        <div class="badge badge-light-info fw-bold">
                                                            بازرگان
                                                        </div>  
                                                    @elseif($visit->user && $visit->user->role == 'retailer')
                                                        <div class="badge badge-light-info fw-bold">
                                                            خرده فروش
                                                        </div>     
                                                    @elseif($visit->user && $visit->user->role == 'freightage')
                                                        <div class="badge badge-light-info fw-bold">
                                                            باربری
                                                        </div>   
                                                    @elseif($visit->user && $visit->user->role == 'driver')
                                                        <div class="badge badge-light-info fw-bold">
                                                            راننده
                                                        </div>   
                                                    @elseif($visit->user && $visit->user->role == 'representative')
                                                        <div class="badge badge-light-info fw-bold">
                                                            عامل / نمایندگی
                                                        </div>   
                                                    @elseif(!$visit->user)
                                                        <div class="badge badge-light fw-bold">
                                                            نامشخص
                                                        </div>    
                                                    @endif
                                                    <!--end::سطح دسترسی=-->
                                                </span>
                                                
                                            </div>
                                            <!--begin::کاربر details-->
                                        </td>
                                        <!--end::کاربر=-->
                                       
                                        <!--begin::Two step=-->
                                        <td>
                                            <button type="button" class="copyBtn btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="{{$visit->url}}">
                                                کپی کنید
                                            </button>
                                            <input type="hidden" value="{{$visit->url}}">
                                        </td>
                                        <!--end::Two step=-->

                                        <!--begin::پیوستنed-->
                                        <td>
                                            <div class="badge badge-light fw-bold">{{$visit->device ?: ''}}</div>
                                        </td>
                                        <!--begin::پیوستنed-->

                                        <!--begin::پیوستنed-->
                                        <td>
                                            <div class="badge badge-light fw-bold">{{$visit->platform ?: ''}}</div>
                                        </td>
                                        <!--begin::پیوستنed-->

                                        <!--begin::پیوستنed-->
                                        <td>
                                            <div class="badge badge-light fw-bold">{{$visit->browser ?: ''}}</div>
                                        </td>
                                        <!--begin::پیوستنed-->

                                        <!--begin::پیوستنed-->
                                        <td>
                                            {{-- <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="top" title="{{\Location::get($visit->ip) ? $visit->determine_ip_location() : "نامشخص"}}">
                                                {{$visit->ip}}
                                            </button> --}}
                                            
                                            <a href="{{"https://tools.keycdn.com/geo?host=$visit->ip"}}" class="btn btn-sm btn-light-info" target="_blank" data-toggle="tooltip" data-placement="top" title="{{$visit->determine_ip_location()}}">
                                                {{$visit->ip}}
                                            </a>
                                        </td>
                                        <!--begin::پیوستنed-->

                                        <!--begin::پیوستنed-->
                                        <td>
                                            <div class="badge badge-light fw-bold">
                                                {{jdate($visit->created_at)->format('Y/m/d')}}
                                            </div>
                                        </td>
                                        <!--begin::پیوستنed-->

                                        <!--begin::پیوستنed-->
                                        <td>
                                            <div class="badge badge-light fw-bold">
                                                {{jdate($visit->created_at)->format('H:i:m')}}
                                            </div>
                                        </td>
                                        <!--begin::پیوستنed-->

                                        <!--begin::عملیات=-->
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm {{!$visit->user ? "disabled" : ""}}" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">عملیات
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-5 m-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon--></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    @if($visit->user)
                                                        <a href="{{route('admin.visit.statusView', $visit->user->id)}}" class="menu-link px-3">نمایش اطلاعات</a>
                                                    @else
                                                        <a href="" class="menu-link px-3">نمایش اطلاعات</a>
                                                    @endif
                                                </div>
                                                <!--end::Menu item-->

                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    @if($visit->user)
                                                        <a href="{{route('admin.visit.id', $visit->user->id)}}" class="menu-link px-3">نمایش بازدیدها</a>
                                                    @else
                                                        <a href="" class="menu-link px-3">نمایش بازدیدها</a>
                                                    @endif
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

                        @if(Route::currentRouteName() == 'visit.all')    
                            <div class="toolbox toolbox-pagination d-flex justify-content-center mt-5">
                                {{$visits->links('vendor.pagination.backend-dashboard')}}
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
    {{-- <script src="{{asset('adminbackend/assets/js/custom/apps/ecommerce/catalog/categories.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.j')}}s"></script> --}}
    <!--end::سفارشی Javascript-->

    <script>
        $(document).on("click", ".copyBtn", function (e) {
            let image_address = $(e.target).next('input').val();
            
            $(".copyBtn").removeClass('btn-primary');
            $(".copyBtn").addClass('btn-secondary');
            $(".copyBtn").text('کپی کنید');
            $(e.target).text('کپی شد!');
            $(e.target).removeClass('btn-secondary');
            $(e.target).addClass('btn-primary');
    
            var temp = $("<input>");
            $("body").append(temp);
            temp.val(image_address).select();
            document.execCommand("copy");
            temp.remove();
        })
    </script>

@endsection