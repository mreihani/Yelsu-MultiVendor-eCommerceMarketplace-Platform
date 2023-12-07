@extends('freightage.freightage_dashboard')
@section('freightage')

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"><a href="">درخواست همکاری با تأمین کنندگان</a></h1>
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
                        <li class="breadcrumb-item text-muted">تأمین کنندگان</li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">لیست شرکت ها</li>
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
                                    <h3 class="fw-bold m-0">ارسال درخواست همکاری با تأمین کننده</h3>
                                </div>
                                <!--end::کارت title-->
                            </div>
                            <!--begin::کارت header-->
                            <!--begin::Content-->
                            <div id="kt_account_settings_profile_details" class="collapse show profileFieldOfActivityFreightagePage">
                                <!--begin::Form-->
                                <form id="kt_account_profile_details_form" class="form" method="POST" action={{route('freightage.update.vendor-request')}} enctype="multipart/form-data">
                                    @csrf
                                    <!--begin::کارت body-->

                                    <input type="hidden" value="{{$invitation->id}}" name="id">

                                    <div class="border-top p-9">
                    
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Tags-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6 required">انتخاب کارخانه / تولید کننده / تأمین کننده</label>
                                            <!--end::Tags-->
                    
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <div class="form-group mb-5">
                                                    <label class="form-label text-info">تولید کننده / تأمین کننده مورد نظر را جستجو و انتخاب نمایید.</label>
                                                    <select name="vendor_id" class="form-select mb-2" data-control="select2" data-placeholder="انتخاب تأمین کننده " data-allow-clear="true">
                                                        @foreach ($vendorsName as $item)
                                                            <option {{$item->id == $invitation->vendor_user_id ? "selected" : ""}} value="{{$item->id}}">{{$item->shop_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label style="font-size: 12px; color:red;" class="form-label">در صورتی که نام تولید کننده / تأمین کننده مورد نظر را از قسمت جستجو پیدا نکردید با پشتیبانی تماس حاصل فرمایید.</label>
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Tags-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">ملاحظات (اختیاری)</label>
                                            <!--end::Tags-->
                    
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <div class="form-group mb-5">
                                                    <label class="form-label text-info">در صورت نیاز می توانید توضیحات درخواست خود را برای تأمین کننده مورد نظر ارسال نمایید.</label>

                                                    <textarea name="description" id="description">
                                                        {{old('description', $invitation->description)}}
                                                    </textarea>
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                    
                                    </div>
                                    <!--end::کارت body-->
                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end">
                                        <a href="{{route('freightage.all.vendor-request')}}" type="button" class="btn btn-light btn-active-light-primary me-2">لغو</a>
                                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">بروزرسانی درخواست</button>
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