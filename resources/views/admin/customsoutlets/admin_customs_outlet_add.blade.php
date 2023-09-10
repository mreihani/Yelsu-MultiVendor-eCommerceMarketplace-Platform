@extends('admin.admin_dashboard')
@section('admin')

<script src="{{asset('frontend/assets/plugins/leaflet/leaflet.js')}}"></script>   
{{-- <script src="{{asset('frontend/assets/plugins/leaflet/neshan.js')}}"></script>    --}}
<script src="{{asset('frontend/assets/plugins/leaflet/Control.Geocoder.js')}}"></script>

<script>
    let latitudeVal = null;
    let longitudeVal = null;
</script>

<!--begin:: TinyMCE-->
<script type="text/javascript">
    tinymce.init({
        selector: '#about_customs',
        plugins: "directionality image link table media lists",
        toolbar: "undo redo | styleselect | bold italic underline | link image alignleft aligncenter alignright ltr rtl numlist bullist | fontsize",
        directionality: "rtl",
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
    });
    tinymce.init({
        selector: '#customs_specs',
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن آدرس گمرک / بندر / منطقه آزاد</h1>
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
                        <li class="breadcrumb-item text-muted">موقعیت مکانی محل گمرک/بندر/منطقه آزاد </li>
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
            <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5 mt-5 mb-5">
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
                
                <!--begin::پایه info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::کارت header-->
                    {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                        <!--begin::کارت title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">اطلاعات و آدرس انبار / کارگاه / کارخانه</h3>
                        </div>
                        
                        <!--end::کارت title-->
                    </div> --}}
                    <!--begin::کارت header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show outlet-page">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form" method="POST" action={{route('admin.store.customsoutlet')}} enctype="multipart/form-data">
                            @csrf
                            <!--begin::کارت body-->
                            <div class="card-body border-top p-9">

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <h5 class="mb-6">مختصات مکانی مورد نظر را از روی نقشه انتخاب نمایید</h5>
                                    <div class="col-lg-12 fv-row">
                                        <div id="map"></div>
                                    </div>
                                    <!--end::Col-->   
                                    
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <h5 class="mb-6">مختصات مکانی مورد نظر را وارد نمایید</h5>
                                    <div class="row">
                                        <div class="col-lg-5 fv-row">
                                            <input placeholder="طول جغرافیایی / longitude" type="text" class="form-control form-control-lg form-control-solid" id="longitude" name="longitude">      
                                        </div>
                                        <div class="col-lg-5 fv-row">
                                            <input placeholder="عرض جغرافیایی / latitude" type="text" class="form-control form-control-lg form-control-solid" id="latitude" name="latitude">      
                                        </div>
                                        <div class="col-lg-2 fv-row text-end">
                                            <button onclick="updateCoords();" class="btn btn-primary"  id="update-coords" type="button">به روز رسانی</button>
                                        </div>
                                    </div>
                                    <!--end::Col-->   
                                </div>
                                <!--end::Input group-->

                                <h5 class="mb-10 mt-10">
                                    لطفا اطلاعات مربوط به محل انتخاب شده را وارد نمایید.
                                </h5>

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">بارگذاری تصویر اصلی</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 text-center">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                            <!--begin::نمایش existing avatar-->
                                            <div id="ShowImage" class="image-input-wrapper w-125px h-125px" style="background-image: url({{url('storage/upload/customs_default.png') }})"></div>
                                            <!--end::نمایش existing avatar-->
                                            <!--begin::Tags-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض آواتار">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input id="image" type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Tags-->
                                            <!--begin::انصراف-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::انصراف-->
                                            <!--begin::حذف-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::حذف-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text">نوع فایل مجاز برای آپلود: png, jpg, jpeg.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">تصویر سربرگ منطقه انتخاب شده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 text-center">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                            <!--begin::نمایش existing avatar-->
                                            <div id="ShowImage" class="image-input-wrapper w-400px h-194px storeBanner" style="background-image: url({{url('storage/upload/customs_default_banner.jpg') }})"></div>
                                            <!--end::نمایش existing avatar-->
                                            <!--begin::Tags-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض تصویر سربرگ گمرک">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input id="image" type="file" name="banner_photo" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="store_banner_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Tags-->
                                            <!--begin::انصراف-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::انصراف-->
                                            <!--begin::حذف-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::حذف-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text">ابعاد تصویر بایستی 930 در 446 پیکسل باشد.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">لطفا یکی از موارد رو به رو را انتخاب نمایید</label>
                                    <!--end::Tags-->
                                    <div class="col-lg-8 fv-row">
                                        <select id="customs_type" name="customs_type" class="form-control form-control-lg form-control-solid form-select">
                                            <option {{$type == 'customs' ? 'selected' : ''}} value="customs">گمرک</option>
                                            <option {{$type == 'port' ? 'selected' : ''}} value="port">بندر</option>
                                            <option {{$type == 'free_zone' ? 'selected' : ''}} value="free_zone">منطقه آزاد</option>
                                            <option {{$type == 'special_zone' ? 'selected' : ''}} value="special_zone">منطقه ویژه اقتصادی</option>
                                        </select>
                                    </div>
                                 </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">نام محل انتخاب شده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="نام محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">کشور محل انتخاب شده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" id="country" name="country" class="form-control form-control-lg form-control-solid" placeholder="کشور محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">استان محل انتخاب شده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" id="province" name="province" class="form-control form-control-lg form-control-solid" placeholder="استان محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">آدرس محل انتخاب شده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="address" id="address" class="form-control form-control-lg form-control-solid" placeholder="آدرس محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">کد پستی محل انتخاب شده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="postalcode" class="form-control form-control-lg form-control-solid" placeholder="کد پستی محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">شماره تلفن محل انتخاب شده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="phone" class="form-control form-control-lg form-control-solid" placeholder="شماره تلفن محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">فکس محل انتخاب شده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="fax" class="form-control form-control-lg form-control-solid" placeholder="شماره فکس محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">درباره محل انتخاب شده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <textarea name="about_customs" id="about_customs">
                                            {{old('about_customs') ?? old('about_customs')}}
                                        </textarea>
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">مشخصات و ویژگی های محل انتخاب شده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <textarea name="customs_specs" id="customs_specs">
                                            {{old('customs_specs') ?? old('customs_specs')}}
                                        </textarea>
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::کارت body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a type="reset" class="btn btn-light btn-active-light-primary me-2" href="{{route('admin.all.customsoutlet')}}">لغو</a>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره تغییرات</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::پایه info-->
               
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    
</div>

<!--leaflet JS-->
<script src="{{asset('frontend/assets/plugins/leaflet/leafletyelsucustoms.js')}}"></script>   

@endsection



