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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">مدیریت کاربران</h1>
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
                        <li class="breadcrumb-item text-muted">کاربران</li>
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
                            <form action="{{route('admin.users.search')}}" method="GET">
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
                                    <input type="text" name="query" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو کاربر" />
                                </div>
                            </form>
                            <!--end::جستجو-->
                        </div>
                        <!--end::کارت title-->
                        <!--begin::کارت toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Add customer-->
                            <a href="{{route('admin.users.add')}}" class="btn btn-primary">افزودن کاربر</a>
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
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1">
                                        </div>
                                    </th>
                                    <th class="min-w-125px">کاربر</th>
                                    <th class="min-w-125px">سطح دسترسی</th>
                                    <th class="min-w-125px">نام کاربری</th>
                                    <th class="min-w-125px">دو مرحله ای</th>
                                    <th class="min-w-125px">تاریخ پیوستن</th>
                                    <th class="text-center min-w-100px">عملیات</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">

                                @foreach($users as $user)
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
                                                        {{-- <img src="{{!empty($user->photo) ? url('storage/upload/admin_images/' . $user->photo) : url('storage/upload/no_image.jpg') }}" alt="مرادی نیا" class="w-100"> --}}
                                                        <div class="symbol-label fs-3 bg-light-info text-info">{{mb_substr($user->lastname, 0, 1, "UTF-8")}}</div>
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::کاربر details-->
                                            <div class="d-flex flex-column">
                                                <a href="" class="text-gray-800 text-hover-primary mb-1">{{$user->firstname .' ' . $user->lastname}}</a>
                                                <span>{{$user->email}}</span>
                                            </div>
                                            <!--begin::کاربر details-->
                                        </td>
                                        <!--end::کاربر=-->
                                        <!--begin::سطح دسترسی=-->
                                        @if($user->role == 'admin')
                                            <td>مدیریت</td>    
                                        @elseif($user->role == 'vendor')
                                            <td>تأمین کننده</td>
                                        @elseif($user->role == 'user')
                                            <td>کاربر عادی</td>    
                                        @elseif($user->role == 'editor')
                                            <td>نویسنده</td>   
                                        @elseif($user->role == 'specialist')
                                            <td>کارشناس فنی محصول
                                                <div class="badge badge-light-primary fw-bold">{{$user->specialist_category->category_name}}</div>
                                            </td>    
                                        @elseif($user->role == 'financial')
                                            <td>کارشناس مالی</td>   
                                        @elseif($user->role == 'merchant')
                                            <td>بازرگان</td>         
                                        @elseif($user->role == 'retailer')
                                            <td>خرده فروش</td>                      
                                        @elseif($user->role == 'freightage')
                                            <td>باربری</td>                      
                                        @elseif($user->role == 'driver')
                                            <td>راننده</td>     
                                        @elseif($user->role == 'representative')
                                            <td>عامل / نمایندگی</td>                      
                                        @endif
                                        <!--end::سطح دسترسی=-->
                                        <!--begin::نام کاربری=-->
                                        <td>
                                            <div class="badge badge-light fw-bold">{{$user->username}}</div>
                                        </td>
                                        <!--end::نام کاربری=-->
                                        <!--begin::Two step=-->
                                        @if($user->twoStepAuth == 'active')
                                            <td>
                                                <div class="badge badge-light-success fw-bold">فعال</div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="badge badge-light-warning fw-bold">غیر فعال</div>
                                            </td>
                                        @endif  
                                        <!--end::Two step=-->
                                        <!--begin::پیوستنed-->
                                        <td>{{jdate($user->created_at)->format('Y/m/d')}}</td>
                                        <!--begin::پیوستنed-->
                                        <!--begin::عملیات=-->
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">عملیات
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
                                                    <a href="{{route('admin.user.edit',$user->id)}}" class="menu-link px-3">ویرایش</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{route('admin.user.delete',$user->id)}}" class="menu-link px-3" data-kt-users-table-filter="delete_row" onclick ="return confirm('آیا برای انجام این کار اطمینان دارید؟')">حذف</a>
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

                        <div class="toolbox toolbox-pagination d-flex justify-content-center mt-5">
                            {{$users->withQueryString()->links('vendor.pagination.backend-dashboard') }}
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
    <script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.j')}}s"></script>
    <!--end::سفارشی Javascript-->


@endsection