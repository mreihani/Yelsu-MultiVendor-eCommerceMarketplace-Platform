@extends('vendor.vendor_dashboard')
@section('vendor')


<!--begin::JalaliDatePicker Plugin JS and CSS -->
<link href="{{asset('frontend/assets/plugins/JalaliDatePicker/jalalidatepicker.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('frontend/assets/plugins/JalaliDatePicker/jalalidatepicker.min.js')}}"></script>

<script>
    jalaliDatepicker.startWatch({
        minDate: "attr",
        maxDate: "attr",
        time:true
    }); 
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن کاربر </h1>
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
                        <li class="breadcrumb-item text-muted">افزودن کاربر</li>
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
                <form class="form" method="POST" action={{route('vendor.store.representative')}}>
                @csrf

                    <!--begin::کارت-->
                    <div class="card mb-5 mb-xl-10">

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
                            <div class="card-body border-top pt-0">

                                <!-- بخش مربوط به جدول محصولات --> 
                                @if(count($vendor_products))

                                    @foreach ($vendor_products as $category_id => $product_object_array)
                                
                                        <div class="yelsuDataTablesHead d-flex align-items-center mt-10">
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
                                        <div class="product-wrapper row">
                                            <div class="product-wrap">
                                                <div class="product text-center">
                                                    <table class="display yelsuDataTables" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">ردیف</th>
                                                                <th class="all text-center">نام محصول</th>
                                                                <th class="all text-center">تعداد / مقدار محصول اختصاص داده شده</th>
                                                                <th class="all text-center">قیمت</th>
                                                                <th class="all text-center">ویرایش محصول</th>
                                                                <th class="text-center">اطلاعات بیشتر</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($product_object_array as $product_key => $product_item)
                                                                <tr>
                                                                    <td>{{ $product_key + 1}}</td>
                                                                    <td>
                                                                        <a href="{{route('product.details', $product_item->product_slug)}}">
                                                                            {{$product_item->product_name}}
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge badge-info product-stock-number-table">نامحدود</span>
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
                                                                        <button type="button" class="btn btn-sm btn-dark m-1 edit-button-specification">
                                                                            <i class="bi bi-pencil-fill"></i>
                                                                            ویرایش
                                                                        </button>
                                                                        
                                                                        <input class="hidden-input-information" disabled type="hidden" name="product_obj[]" value='{{json_encode(["product_id" => $product_item->id, "product_in_stock" => "نامحدود", "change_price_permission" => false, "product_specific_geolocation_internal" => false, "product_specific_geolocation_external" => false, "product_geolocation_permission_city" => [], "product_geolocation_permission_export_country" => [], "product_geolocation_permission_province" => [] ])}}'>
                                                                        <input class="hidden-input-information-server" disabled type="hidden" name="product_obj_server[]" value='{{json_encode(["product_id" => $product_item->id, "product_in_stock" => "نامحدود", "change_price_permission" => false, "product_specific_geolocation_internal" => false, "product_specific_geolocation_external" => false, "product_geolocation_permission_city" => [], "product_geolocation_permission_export_country" => [], "product_geolocation_permission_province" => [] ])}}'>
                                                                    </td>
                                                                    <td></td>
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
                                <!--begin::Col-->
                                <div class="col-lg-6" >
                                    <input type="text" data-jdp="" data-jdp-min-date="today" data-jdp-only-date="" class="form-control form-control-solid" placeholder="زمان را انتخاب نمایید">
                                    <div class="mt-2 text-muted fs-7 p-0">ابتدای تاریخ مورد نظر را انتخاب نمایید.</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-6" >
                                    <input type="text" data-jdp="" data-jdp-min-date="today" data-jdp-only-date="" class="form-control form-control-solid" placeholder="زمان را انتخاب نمایید">
                                    <div class="mt-2 text-muted fs-7 p-0">انتهای تاریخ مورد نظر را انتخاب نمایید.</div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

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

    <script src="{{asset('frontend/assets/plugins/datatables/yelsuProductTablesVendor.js')}}"></script>

@endsection