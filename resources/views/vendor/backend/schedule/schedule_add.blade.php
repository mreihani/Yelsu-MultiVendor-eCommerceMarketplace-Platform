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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">مدریت زمان بندی محصولات</h1>
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
                        <li class="breadcrumb-item text-muted">زمان بندی محصولات</li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">مدیریت زمان بندی</li>
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
                <form class="form" method="POST" action={{route('vendor.store.schedule')}}>
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
                                        </div>
                                        <div class="product-wrapper row">
                                            <div class="product-wrap">
                                                <div class="product text-center">
                                                    <table class="display yelsuDataTables" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">ردیف</th>
                                                                <th class="all text-center">نام محصول</th>
                                                                <th class="all text-center">ظرفیت تحویل</th>
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
                                                                        @if(count($product_item->schedule) && $product_item->schedule->first()->product_deliver_capacity) 
                                                                            <span class="badge badge-warning product-stock-number-table">{{$product_item->schedule->first()->daily_deliver_capacity}}</span>
                                                                        @else
                                                                            <span class="badge badge-info product-stock-number-table">نامحدود</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-sm btn-dark m-1 edit-button-specification">
                                                                            <i class="bi bi-pencil-fill"></i>
                                                                            ویرایش
                                                                        </button>
                                                                        
                                                                        <input class="hidden-input-information" type="hidden" name="product_obj[]" value='{{json_encode([
                                                                                "product_id" => $product_item->id,
                                                                                "product_deliver_capacity" => count($product_item->schedule) && $product_item->schedule->first()->product_deliver_capacity ? true : false,
                                                                                "daily_deliver_capacity" => count($product_item->schedule) && $product_item->schedule->first()->daily_deliver_capacity ? $product_item->schedule->first()->daily_deliver_capacity : null,
                                                                                "specific_deliver_date" => count($product_item->schedule) && $product_item->schedule->first()->specific_deliver_date() ? $product_item->schedule->first()->specific_deliver_date() : null,
                                                                                "specific_deliver_capacity" => count($product_item->schedule) && $product_item->schedule->first()->specific_deliver_capacity() ? $product_item->schedule->first()->specific_deliver_capacity() : null,
                                                                            ])}}'>
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

                            <!--begin::Input group-->
                            <div class="row d-flex justify-content-end mx-5 px-4 pb-5">
                                <!--begin::Tags-->
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <label for="product-deliver-capacity">محدودیت ظرفیت تحویل</label>
                                    <input class="form-check-input w-45px h-30px mx-2" type="checkbox" id="product-deliver-capacity" name="product_deliver_capacity">
                                </div>
                                <!--end::Tags-->
                                <!--begin::توضیحات-->
                                <div class="mt-2 text-muted fs-7 p-0">با تأیید این گزینه روی این محصول محدودیت ظرفیت تحویل اعمال خواهد شد.</div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row d-flex justify-content-end mx-5 px-4 d-none" id="product-capacity-body">

                                <div class="separator my-10"></div>

                                <!--begin::Tags-->
                                <label class="col-lg-12 col-form-label fw-semibold fs-6 required">
                                    ظرفیت تحویل روزانه محصول را تعیین نمایید
                                </label>
                                <!--end::Tags-->

                                <!--begin::Row-->
                                <div class="row">
                                    <div class="row gutter-sm">        
                                        <!--begin::Input group-->
                                        <div class="row d-flex justify-content-end">
                                            <!--begin::Col-->
                                            <div class="col-lg-4" >
                                                <input name="daily_deliver_capacity" type="number" class="form-control form-control-solid" placeholder="به عنوان مثال 10000">
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                
                                <div class="separator my-10"></div>

                                <!--begin::Tags-->
                                <label class="col-lg-12 col-form-label fw-semibold fs-6">
                                    ظرفیت تحویل محصول برای تاریخ مورد نظر را تعیین نمایید
                                </label>
                                <!--end::Tags-->

                                <!--begin::Col-->
                                <div class="row repeater-body">
                                    <div class="col-lg-10">
                                        <div class="repeater-product">
                                            <div data-repeatable class="my-5">
                                                <fieldset class="row">
                                                    <!--begin::Row-->
                                                    <div class="row col-md-10">
                                                        <div class="row gutter-sm">        
                                                            <!--begin::Input group-->
                                                            <div class="row d-flex justify-content-end">
                                                                <!--begin::Col-->
                                                                <div class="col-lg-6" >
                                                                    <input name="specific_deliver_date[]" type="text" data-jdp="" data-jdp-min-date="today" data-jdp-only-date="" class="form-control form-control-solid" placeholder="تاریخ مورد نظر را انتخاب نمایید">
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-6" >
                                                                    <input name="specific_deliver_capacity[]" type="number" class="form-control form-control-solid" placeholder="ظرفیت تحویل محصول را وارد نمایید">
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
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center mt-3">
                                        <button type="button" class="btn btn-sm btn-light-primary add-repeater-btn">
                                            افزودن
                                            <i class="bi bi-patch-plus-fill"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2 text-muted fs-7">در صورتی که برای تاریخ به خصوصی قصد تعیین ظرفیت تحویل محصول دارید می توانید آن را از طریق فرم بالا تعیین نمایید، در غیر این صورت به صورت پیشفرض محاسبه بر اساس ظرفیت روزانه انجام خواهد شد.</div>
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
                                <a href="{{route('vendor.dashboard')}}" class="btn btn-light me-3">لغو</a>
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

    <script src="{{asset('adminbackend/assets/js/vendorSchedule.js')}}"></script>

@endsection