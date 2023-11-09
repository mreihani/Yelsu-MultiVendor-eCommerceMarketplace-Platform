@extends('representative.representative_dashboard')
@section('representative')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">لیست سفارشات</h1>
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
                        <li class="breadcrumb-item text-muted">سفارشات</li>
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
            @if(session()->has('success'))
            <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5">
                <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
            </div>
            @endif
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::محصولات-->
                <div class="card card-flush">
                    <!--begin::کارت header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::کارت title-->
                        <div class="card-title">
                            <!--begin::جستجو-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو " />
                            </div>
                            <!--end::جستجو-->
                        </div>
                        <!--end::کارت title-->
                        <!--begin::کارت toolbar-->
                        
                        <!--end::کارت toolbar-->
                    </div>
                    <!--end::کارت header-->
                    <!--begin::کارت body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="text-center min-w-70px">شناسه سفارش</th>
                                    <th class="text-center min-w-70px">نام و نام خانوادگی خریدار</th>
                                    <th class="text-center min-w-70px">وضعیت سفارش</th>
                                    <th class="text-center min-w-100px">مبلغ کل سفارش</th>
                                    <th class="text-center min-w-100px">تاریخ ثبت سفارش</th>
                                    {{-- <th class="text-center min-w-100px">تاریخ بروزرسانی</th> --}}
                                    <th class="text-center min-w-100px">عملیات</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">
                               
                            @if (count($orders))
                                @foreach ($orders as $order)
                                
                                @php
                                $orderBelongsToVendor = false;
                                foreach ($order->products as $product) {
                                    if($product->representative_id == $representativeData->id) {
                                        $orderBelongsToVendor = true;
                                        break;
                                    }
                                }
                                @endphp

                                @if ($orderBelongsToVendor)
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <!--end::Checkbox-->
                                    <!--begin::شناسه سفارش=-->
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">{{$order->id}}</a>
                                    </td>
                                    <!--end::شناسه سفارش=-->
                                    <!--begin::مشتری=-->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: آواتار -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../demo1/dist/apps/user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        {{-- <img src="{{!empty($order->user->photo) ? url('storage/upload/admin_images/' . $order->user->photo) : url('storage/upload/no_image.jpg') }}" alt="{{$order->user->firstname .' '. $order->user->lastname}}" class="w-100"> --}}
                                                        <div class="symbol-label fs-3 bg-light-info text-info">{{mb_substr($order->user->lastname, 0, 1, "UTF-8")}}</div>
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <div class="ms-5">
                                    
                                                <!--begin::Title-->
                                                <a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{$order->user->firstname .' '. $order->user->lastname}}</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <!--end::مشتری=-->
                                        <!--begin::وضعیت=-->
                                        @if($order->status == 'paid')
                                            <td class="text-end pe-0" data-order="پرداخت موفق">
                                                <!--begin::Badges-->
                                                <div class="badge badge-light-success">پرداخت موفق</div>
                                                <!--end::Badges-->
                                            </td>    
                                            @elseif(($order->status == 'unpaid'))
                                            <td class="text-end pe-0" data-order="پرداخت ناموفق">
                                                <!--begin::Badges-->
                                                <div class="badge badge-light-dark">پرداخت ناموفق</div>
                                                <!--end::Badges-->
                                            </td> 
                                            @elseif(($order->status == 'preparation'))
                                            <td class="text-end pe-0" data-order="در حال پردازش">
                                                <!--begin::Badges-->
                                                <div class="badge badge-light-info">در حال پردازش</div>
                                                <!--end::Badges-->
                                            </td>
                                            @elseif(($order->status == 'posted'))
                                            <td class="text-end pe-0" data-order="ارسال شده">
                                                <!--begin::Badges-->
                                                <div class="badge badge-light-primary">ارسال شده</div>
                                                <!--end::Badges-->
                                            </td>        
                                            @elseif(($order->status == 'received'))
                                            <td class="text-end pe-0" data-order="دریافت شده">
                                                <!--begin::Badges-->
                                                <div class="badge badge-light-primary">دریافت شده</div>
                                                <!--end::Badges-->
                                            </td> 
                                            @elseif(($order->status == 'cancelled'))
                                            <td class="text-end pe-0" data-order="سفارش لغو شده">
                                                <!--begin::Badges-->
                                                <div class="badge badge-light-danger">سفارش لغو شده</div>
                                                <!--end::Badges-->
                                            </td> 
                                            @endif

                                        <!--end::وضعیت=-->
                                        <!--begin::کل=-->
                                        <td class="text-end pe-0">
                                            <span class="fw-bold">{{$order->price}} {{$order->products[0]->determine_product_currency()}}</span>
                                        </td>
                                        <!--end::کل=-->
                                        <!--begin::تاریخ افزودن=-->
                                        <td class="text-end" data-order="{{jdate($order->created_at)->format('Y/m/d')}}">
                                            <span class="fw-bold">{{jdate($order->created_at)->format('Y/m/d')}}</span>
                                        </td>
                                        <!--end::تاریخ افزودن=-->
                                        <!--begin::تاریخ اصلاح شد=-->
                                        {{-- <td class="text-end" data-order="{{jdate($order->updated_at)->format('Y/m/d')}}">
                                            <span class="fw-bold">{{jdate($order->updated_at)->format('Y/m/d')}}</span>
                                        </td> --}}
                                        <!--end::تاریخ اصلاح شد=-->
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
                                                    <form action="{{route('representative.orders.view', $order->id)}}" method="GET" id="viewOrder">
                                                        @csrf
                                                    </form>
                                                    <a onclick="document.getElementById('viewOrder').submit();" href="{{route('representative.orders.view', $order->id)}}" class="menu-link px-3">جزئیات سفارش</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <form action="{{route('representative.orders.destroy', $order->id)}}" method="POST" id="deleteOrder-{{$order->id}}">
                                                        @csrf
                                                    </form>
                                                    <a onclick="document.getElementById('deleteOrder-{{$order->id}}').submit(); return confirm('آیا برای انجام این کار اطمینان دارید؟');" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row" onclick ="return confirm('آیا برای انجام این کار اطمینان دارید؟')">حذف</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                        <!--end::عملیات=-->
                                    </tr>
                                    <!--end::Table row-->
                                @endif
                                @endforeach  
                            @endif

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::کارت body-->
                </div>
                <!--end::محصولات-->
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