@extends('vendor.vendor_dashboard')
@section('vendor')

<!--begin:: TinyMCE-->
<script type="text/javascript">
    tinymce.init({
        selector: '#description',
        plugins: "directionality image link table media lists",
        toolbar: "undo redo | styleselect | bold italic underline | link image alignleft aligncenter alignright ltr rtl numlist bullist | fontsize",
        directionality: "rtl",
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
    });
</script>
<!--end:: TinyMCE-->

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"><a href="">درخواست همکاری شرکت باربری</a></h1>
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
                        <li class="breadcrumb-item text-muted">شرکت های باربری</li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">درخواست همکاری</li>
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
            @foreach($errors->all() as $error)
                <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
                    <h4 class="alert-title" style="color:#ffa800">
                        <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                        {{$error}}
                </div>
            @endforeach


            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::کاربران-->
                <div class="card card-flush">
                   
                    <!--begin::کارت body-->
                    <div class="pt-0">
                        <div class="card mb-5 mb-xl-10">
                            <!--begin::کارت header-->
                            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                                <!--begin::کارت title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">درخواست همکاری</h3>
                                </div>
                                <!--end::کارت title-->
                            </div>
                            <!--begin::کارت header-->
                            <!--begin::Content-->
                            <div id="kt_account_settings_profile_details" class="collapse show profileFieldOfActivityFreightagePage">
                                <!--begin::Form-->
                                <form id="kt_account_profile_details_form" class="form" method="POST" action={{route('vendor.update.freightage')}} enctype="multipart/form-data">
                                    @csrf
                                    <!--begin::کارت body-->

                                    <input type="hidden" value="{{$invitation->id}}" name="id">

                                    <div class="border-top p-9">

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Tags-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6 ">تصویر برند / لوگو شرکت حمل و نقل یا باربری</label>
                                            <!--end::Tags-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row d-flex align-items-center">
                                                <div class="form-group mb-5">
                                                    <div id="ShowImage" class="image-input-wrapper w-125px h-125px" style="background-image: url({{!empty($invitation->freightage->photo) ? url('storage/upload/freightage_images/' . $invitation->freightage->photo) : url('storage/upload/freightage_logo.png') }})"></div>
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Tags-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6 ">تصویر باربری / بنر باربری</label>
                                            <!--end::Tags-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row d-flex align-items-center">
                                                <div class="form-group mb-5">
                                                    <div id="ShowImage" class="image-input-wrapper w-400px h-194px storeBanner" style="background-image: url({{!empty($invitation->freightage->store_banner) ? url('storage/upload/freightage_images/' . $invitation->freightage->store_banner) : url('storage/upload/freghtage_banner.jpg') }})"></div>
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Tags-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6 ">نام شرکت باربری</label>
                                            <!--end::Tags-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row d-flex align-items-center">
                                                <div class="form-group mb-5">
                                                    <div>
                                                        {{$invitation->freightage->shop_name}}
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Tags-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6 ">آدرس شرکت باربری</label>
                                            <!--end::Tags-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row d-flex align-items-center">
                                                <div class="form-group mb-5">
                                                    <div>
                                                        {{$invitation->freightage->shop_address}}
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        @if($freightage_type_array)
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Tags-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6 ">زمینه فعالیت شرکت حمل و نقل یا باربری</label>
                                                <!--end::Tags-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row d-flex align-items-center">
                                                    <div class="form-group mb-5">
                                                        @foreach ($freightage_type_array as $freightage_type_item)
                                                        <div class="badge badge-light-primary">
                                                            {{$freightage_type_item}}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                        @endif

                                        <!--begin::Input group-->
                                        @if($freightage_loader_type_road_array)
                                            <div class="row mb-6">
                                                <!--begin::Tags-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6 ">نوع بارگیر حمل و نقل جاده ای</label>
                                                <!--end::Tags-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row d-flex align-items-center">
                                                    <div class="form-group mb-5">
                                                        @foreach ($freightage_loader_type_road_array as $freightage_type_item)
                                                        <div class="badge badge-light-primary">
                                                            {{$freightage_type_item}}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        @endif    
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        @if($freightage_loader_type_rail_array)
                                            <div class="row mb-6">
                                                <!--begin::Tags-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6 ">نوع بارگیر حمل و نقل ریلی</label>
                                                <!--end::Tags-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row d-flex align-items-center">
                                                    <div class="form-group mb-5">
                                                        @foreach ($freightage_loader_type_rail_array as $freightage_type_item)
                                                        <div class="badge badge-light-primary">
                                                            {{$freightage_type_item}}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        @endif    
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        @if($freightage_loader_type_sea_array)
                                            <div class="row mb-6">
                                                <!--begin::Tags-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6 ">نوع بارگیر حمل و نقل آبی / دریایی</label>
                                                <!--end::Tags-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row d-flex align-items-center">
                                                    <div class="form-group mb-5">
                                                        @foreach ($freightage_loader_type_sea_array as $freightage_type_item)
                                                        <div class="badge badge-light-primary">
                                                            {{$freightage_type_item}}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        @endif    
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        @if($freightage_loader_type_air_array)
                                            <div class="row mb-6">
                                                <!--begin::Tags-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6 ">نوع بارگیر حمل و نقل هوایی</label>
                                                <!--end::Tags-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row d-flex align-items-center">
                                                    <div class="form-group mb-5">
                                                        @foreach ($freightage_loader_type_air_array as $freightage_type_item)
                                                        <div class="badge badge-light-primary">
                                                            {{$freightage_type_item}}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        @endif    
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        @if($freightage_category_id)
                                            <div class="row mb-6">
                                                <!--begin::Tags-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6 ">دسته بندی مرتبط</label>
                                                <!--end::Tags-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row d-flex align-items-center">
                                                    <div class="form-group mb-5">
                                                        @foreach ($freightage_category_id as $category_item)
                                                        <div class="badge badge-light-primary">
                                                            {{$category_item->category_name}}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        @endif    
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        @if($invitation->description)
                                            <div class="row mb-6">
                                                <!--begin::Tags-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">ملاحظات</label>
                                                <!--end::Tags-->
                        
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <div class="form-group mb-5">
                                                        {!! $invitation->description !!}
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        @endif
                                        <!--end::Input group-->
                    
                                    </div>
                                    <!--end::کارت body-->
                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end">
                                        <a href="{{route('vendor.all.freightage.verified')}}" type="button" class="btn btn-light btn-active-light-primary me-2">بازگشت</a>
                                        @if(!$invitation->verified)
                                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">تأیید درخواست</button>
                                        @endif
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Content-->
                        </div>

                    </div>
                    <!--end::کارت body-->
                </div>
                <!--end::کاربران-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    
</div>


@endsection