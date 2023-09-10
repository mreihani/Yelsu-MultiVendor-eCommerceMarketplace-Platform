@extends('admin.admin_dashboard')
@section('admin')


<!--begin:: TinyMCE-->
<script type="text/javascript">
    tinymce.init({
        selector: '#vendor_description',
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">تایید اطلاعات راننده</h1>
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
                        <li class="breadcrumb-item text-muted">درباره راننده</li>
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
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form" method="POST" action="{{route('admin.driver.profile.verify.store')}}">
                            @csrf
                            <input type="hidden" value="{{$id}}" name="id">
                            <!--begin::کارت body-->
                            <div class="card-body border-top p-9">
                                <h5 class="mb-10">
                                    لطفا اطلاعات راننده را مطالعه و تایید نمایید.
                                </h5>

                                <!--begin::Input group-->
                                <div id="kt_account_settings_profile_details" class="collapse show profileFieldOfActivityFreightagePage">
                                    <!--begin::Form-->
                                        <!--begin::کارت body-->
                                        <div class="card-body border-top p-9">
            
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Tags-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6 required">زمینه فعالیت راننده</label>
                                                <!--end::Tags-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <label class="form-label text-info">در کدام یک از موارد زیر فعالیت می نمایید؟ یک یا چند نوع را انتخاب کنید.</label>
                                                    <div class="form-group mb-5">
                                                        <li class="filterButtonShopPage rootCat list-style-none mt-5 ">
                                                            <input type="checkbox" name="type[]" value="1" {{in_array(1, $driver_sector_arr) ? 'checked' : ''}}> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> زمینی 
                                                        </li>
            
                                                       
                                                        <div class="subCategoryBtn">
                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="type[]" value="2" {{in_array(2, $driver_sector_arr) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> جاده ای 
                                                            </li>
            
                                                            <div class="subCategoryBtn">
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 70px;">
                                                                    <input type="checkbox" name="type[]" value="3" {{in_array(3, $driver_sector_arr) ? 'checked' : ''}}> شهری
                                                                </li>
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 70px;">
                                                                    <input type="checkbox" name="type[]" value="4" {{in_array(4, $driver_sector_arr) ? 'checked' : ''}}> بین شهری
                                                                </li>
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 70px;">
                                                                    <input type="checkbox" name="type[]" value="5" {{in_array(5, $driver_sector_arr) ? 'checked' : ''}}> بین المللی
                                                                </li>
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 70px;">
                                                                    <input type="checkbox" name="type[]" value="9" {{in_array(9, $driver_sector_arr) ? 'checked' : ''}}> محموله ترافیکی 
                                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="محموله ترافیکی چیست؟ به طور خلاصه به باری که عرض و طول آن از حد مجاز بیرون بزند بار ترافیکی گفته می‌شود. یعنی اگر عرض بار بیشتر از ۲.۶۰ متر و ارتفاع بیشتر از ۳ متر باشد محموله ترافیکی می‌شود. حمل محموله های ترافیکی از جمله مقولاتی است که نیاز به خدمات حرفه ای و ماشین های مخصوص دارد."></i></label>
                                                                </li>
                                                            </div>
                                                           
                                                        </div>   
            
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
            
                                            <!--begin::Input group-->
                                            <div class="row mb-6" id="loader_type_road" style="{{in_array(1, $driver_sector_arr) ? '' : 'display: none;"'}}">
                                                <!--begin::Tags-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6 required">انتخاب نوع بارگیر در حمل جاده ای</label>
                                                <!--end::Tags-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <div class="form-group mb-5">
                                                        <label class="form-label text-info">به کدام یک از صاحبان خودروهای زیر می توانید خدمات دهید؟ حداقل یک یا چند نوع را انتخاب نمایید.</label>
                                                        <li class="filterButtonShopPage rootCat list-style-none mt-5 "> 
                                                            <input type="checkbox" name="loader_type[]" value="1" {{in_array(1, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> تریلی 
                                                        </li>
                                                        
                                                        <div class="subCategoryBtn">
                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="2" {{in_array(2, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> کفی 
                                                            </li>

                                                            <div class="subCategoryBtn">
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="3" {{in_array(3, $loader_type_arr_selected) ? 'checked' : ''}}> طول 12.20 
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="4" {{in_array(4, $loader_type_arr_selected) ? 'checked' : ''}}> طول 12.60
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="5" {{in_array(5, $loader_type_arr_selected) ? 'checked' : ''}}> طول 13.60
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="6" {{in_array(6, $loader_type_arr_selected) ? 'checked' : ''}}> طول 11
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="7" {{in_array(7, $loader_type_arr_selected) ? 'checked' : ''}}> طول 9
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="8" {{in_array(8, $loader_type_arr_selected) ? 'checked' : ''}}> کفی کشویی
                                                                </li>
                                                            </div>   

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="9" {{in_array(9, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> بغلدار
                                                            </li>

                                                            <div class="subCategoryBtn">
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="10" {{in_array(10, $loader_type_arr_selected) ? 'checked' : ''}}> طول 12.20 
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="11" {{in_array(11, $loader_type_arr_selected) ? 'checked' : ''}}> طول 12.60
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="12" {{in_array(12, $loader_type_arr_selected) ? 'checked' : ''}}> طول 13.60
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="13" {{in_array(13, $loader_type_arr_selected) ? 'checked' : ''}}> طول 11
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="14" {{in_array(14, $loader_type_arr_selected) ? 'checked' : ''}}> طول 9
                                                                </li>
                                                            </div>   
                                                            
                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="15" {{in_array(15, $loader_type_arr_selected) ? 'checked' : ''}}> تیغه
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="16" {{in_array(16, $loader_type_arr_selected) ? 'checked' : ''}}> کمپرسی
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="52" {{in_array(52, $loader_type_arr_selected) ? 'checked' : ''}}> بونکر
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="53" {{in_array(53, $loader_type_arr_selected) ? 'checked' : ''}}> تانکر
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="17" {{in_array(17, $loader_type_arr_selected) ? 'checked' : ''}}> یخچالی
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="18" {{in_array(18, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> چادری
                                                            </li>

                                                            <div class="subCategoryBtn">
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="19" {{in_array(19, $loader_type_arr_selected) ? 'checked' : ''}}> ارتفاع 2.70 
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="20" {{in_array(20, $loader_type_arr_selected) ? 'checked' : ''}}> ارتفاع 2.90
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="21" {{in_array(21, $loader_type_arr_selected) ? 'checked' : ''}}> ارتفاع 3
                                                                </li>
                                                            </div>   
                                                        </div>   

                                                        {{-- بوژی --}}

                                                        <li class="filterButtonShopPage rootCat list-style-none"> 
                                                            <input type="checkbox" name="loader_type[]" value="54" {{in_array(54, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> بوژی 
                                                        </li>

                                                        <div class="subCategoryBtn">
                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="55" {{in_array(55, $loader_type_arr_selected) ? 'checked' : ''}}> بوژی 2 محور با طول ۱۶ متر و عرض ۲.۷ متر با وزن ۴۰ تن 
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="56" {{in_array(56, $loader_type_arr_selected) ? 'checked' : ''}}> بوژی 3 محور با طول ۱۸ متر و عرض ۳ متر با وزن ۵۰ تن
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="57" {{in_array(57, $loader_type_arr_selected) ? 'checked' : ''}}> بوژی 5 محور با طول ۵۰ متر با وزن ۶۲ تن
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="58" {{in_array(58, $loader_type_arr_selected) ? 'checked' : ''}}>  بوژی ۸ محور با وزن ۱۰۰ تن
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="59" {{in_array(59, $loader_type_arr_selected) ? 'checked' : ''}}>  بوژی 11 محور با طول ۱۱ و عرض ۳ متر با بار ۹۶ تن
                                                            </li>
                                                        </div>   

                                                        {{-- بوژی --}}

                                                        {{-- کمر شکن --}}

                                                        <li class="filterButtonShopPage rootCat list-style-none"> 
                                                            <input type="checkbox" name="loader_type[]" value="60" {{in_array(60, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> کمر شکن 
                                                        </li>

                                                        <div class="subCategoryBtn">
                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="61" {{in_array(61, $loader_type_arr_selected) ? 'checked' : ''}}> کمر شکن 2 محور با طول 12 متر و عرض 2.6 
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="62" {{in_array(62, $loader_type_arr_selected) ? 'checked' : ''}}> کمر شکن 3 محور با طول 14 متر و عرض ۳ متر
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="63" {{in_array(63, $loader_type_arr_selected) ? 'checked' : ''}}>  کمر شکن 4 محور 32 چرخ با طول 15.5 متر و عرض 3.4 متر
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="64" {{in_array(64, $loader_type_arr_selected) ? 'checked' : ''}}> کمر شکن 11 محور با طول 19 متر و عرض 3.1 متر
                                                            </li>
                                                        </div>   

                                                        {{-- کمر شکن --}}

                                                        <li class="filterButtonShopPage rootCat list-style-none">
                                                            <input type="checkbox" name="loader_type[]" value="22" {{in_array(22, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> جفت 
                                                        </li>

                                                        <div class="subCategoryBtn">
                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="23" {{in_array(23, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> روباز 
                                                            </li>

                                                            <div class="subCategoryBtn">
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="24" {{in_array(24, $loader_type_arr_selected) ? 'checked' : ''}}> معمولی 
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="25" {{in_array(25, $loader_type_arr_selected) ? 'checked' : ''}}> بغل باز شو
                                                                </li>
                                                            </div>   

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="26" {{in_array(26, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> مسقف
                                                            </li>

                                                            <div class="subCategoryBtn">
                                                                <li class="filterButtonShopPage list-style-none" style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="27" {{in_array(27, $loader_type_arr_selected) ? 'checked' : ''}}> چادری 
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="28" {{in_array(28, $loader_type_arr_selected) ? 'checked' : ''}}> فلزی
                                                                </li>
                                                            </div>   

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="29" {{in_array(29, $loader_type_arr_selected) ? 'checked' : ''}}> کمپرسی
                                                            </li>
                                                        </div>   

                                                        <li class="filterButtonShopPage rootCat list-style-none">
                                                            <input type="checkbox" name="loader_type[]" value="30" {{in_array(30, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> تک 
                                                        </li>

                                                        <div class="subCategoryBtn">
                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="31" {{in_array(31, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> روباز 
                                                            </li>

                                                            <div class="subCategoryBtn">
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="32" {{in_array(32, $loader_type_arr_selected) ? 'checked' : ''}}> معمولی 
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="33" {{in_array(33, $loader_type_arr_selected) ? 'checked' : ''}}> بغل باز شو
                                                                </li>
                                                            </div>   

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="34" {{in_array(34, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> مسقف
                                                            </li>

                                                            <div class="subCategoryBtn">
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="35" {{in_array(35, $loader_type_arr_selected) ? 'checked' : ''}}> چادری 
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="36" {{in_array(36, $loader_type_arr_selected) ? 'checked' : ''}}> فلزی
                                                                </li>
                                                            </div>   

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="37" {{in_array(37, $loader_type_arr_selected) ? 'checked' : ''}}> کمپرسی
                                                            </li>
                                                        </div>

                                                        <li class="filterButtonShopPage rootCat list-style-none">
                                                            <input type="checkbox" name="loader_type[]" value="38" {{in_array(38, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> خاور و کامیونت 
                                                        </li>

                                                        <div class="subCategoryBtn">
                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="39" {{in_array(39, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> روباز 
                                                            </li>

                                                            <div class="subCategoryBtn">
                                                                <li class="filterButtonShopPage list-style-none" style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="40" {{in_array(40, $loader_type_arr_selected) ? 'checked' : ''}}> 5 تن به بالا 
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="41" {{in_array(41, $loader_type_arr_selected) ? 'checked' : ''}}> زیر 5 تن
                                                                </li>
                                                            </div>   

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="42" {{in_array(42, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> مسقف
                                                            </li>

                                                            <div class="subCategoryBtn">
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="43" {{in_array(43, $loader_type_arr_selected) ? 'checked' : ''}}> اتاق بزرگ 
                                                                </li>

                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="44" {{in_array(44, $loader_type_arr_selected) ? 'checked' : ''}}> 5 تن به بالا 
                                                                </li>
                
                                                                <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                    <input type="checkbox" name="loader_type[]" value="45" {{in_array(45, $loader_type_arr_selected) ? 'checked' : ''}}> زیر 5 تن
                                                                </li>
                                                            </div>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="46" {{in_array(46, $loader_type_arr_selected) ? 'checked' : ''}}> کمپرسی
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="47" {{in_array(47, $loader_type_arr_selected) ? 'checked' : ''}}> یخچال دار
                                                            </li>
                                                        </div>

                                                        <li class="filterButtonShopPage rootCat list-style-none">
                                                            <input type="checkbox" name="loader_type[]" value="48" {{in_array(48, $loader_type_arr_selected) ? 'checked' : ''}}> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> وانت و نیسان 
                                                        </li>

                                                        <div class="subCategoryBtn">
                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="49" {{in_array(49, $loader_type_arr_selected) ? 'checked' : ''}}> نیسان 
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="50" {{in_array(50, $loader_type_arr_selected) ? 'checked' : ''}}> نیسان یخچالی
                                                            </li>

                                                            <li class="filterButtonShopPage list-style-none " style="margin-right: 35px;">
                                                                <input type="checkbox" name="loader_type[]" value="51" {{in_array(51, $loader_type_arr_selected) ? 'checked' : ''}}> وانت
                                                            </li>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                
                                            <!--begin::Input group-->
                                            @if (count($vendor_sector_cat_arr))
                                                <div class="row mb-6">
                                                    <!--begin::Tags-->
                                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">
                                                        انتخاب دسته بندی مرتبط
                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="لطفا دسته بندی مرتبط با راننده را از گزینه های روبه انتخاب نمایید."></i></label>
                                                    </label>
                                                    <!--end::Tags-->
                                                   
                                                    <!--begin::Col-->
                                                    <div class="col-lg-8 fv-row mt-4">
                                                        <ul class="list-style-none">
                                                            @foreach ($filter_category_array as $category)
                                                                <li class="filterButtonShopPage rootCat">
                                                                    @if(in_array($category[0]->id, $category_sector_cat_arr_selected))
                                                                        <input @checked(true) type="checkbox" name="category_id[]" value="{{$category[0]->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category[0]->category_name}} {{count($category[1]) ? "(".count($category[1])." زیر دسته)" : ''}}
                                                                    @else
                                                                        <input type="checkbox" name="category_id[]" value="{{$category[0]->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category[0]->category_name}} {{count($category[1]) ? "(".count($category[1])." زیر دسته)" : ''}}
                                                                    @endif
                                                                </li>
                                                                <div class="subCategoryBtn">
                                                                    @include('driver.layouts.edit-categories-group', ['categories' => $category[1]])
                                                                </div>
                                                            @endforeach
                                                        </ul>      
                                                    </div>
                                                    <!--end::Col-->   
                                                </div>
                                            @endif    
                                            <!--end::Input group-->
            
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Tags-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">انتخاب تأمین کننده</label>
                                                <!--end::Tags-->
            
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <div class="form-group mb-5">
                                                        <label class="form-label">در صورتی که فقط به تولید کننده / تأمین کننده خاصی خدمات می دهید آن را جستجو و انتخاب نمایید.</label>
                                                        <select name="vendor_id[]" class="form-select mb-2" data-control="select2" data-placeholder="انتخاب تأمین کننده " data-allow-clear="true" multiple="multiple">
                                                            @foreach ($vendorsName as $item)
                                                                <option {{in_array($item->id, $vendor_arr_selected) ? "selected" : ""}} value="{{$item->id}}">{{$item->firstname . " " . $item->lastname}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
            
                                        </div>
                                        <!--end::کارت body-->
                                    <!--end::Form-->
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::کارت body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a type="reset" class="btn btn-light btn-active-light-primary me-2" href="{{route('admin.driver.profile.verifyAll')}}">لغو</a>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">تایید و انتشار</button>
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

<script>
    $(document).on('click', "input[name='type[]']", function(e) {
        if($(e.target).is(":checked")) {
            if($(e.target).val() == 1 || $(e.target).val() == 2 || $(e.target).val() == 3 || $(e.target).val() == 4 || $(e.target).val() == 5 || $(e.target).val() == 9) {
                $("#loader_type_road").slideDown();
            } else if ($(e.target).val() == 6) {
                $("#loader_type_rail").slideDown();
            } else if ($(e.target).val() == 8) {
                $("#loader_type_sea").slideDown();
            } else if ($(e.target).val() == 7) {
                $("#loader_type_air").slideDown();
            }
        } else {
            if($(e.target).val() == 1) {
                $("#loader_type_road").slideUp();
            } else if ($(e.target).val() == 6) {
                $("#loader_type_rail").slideUp();
            } else if ($(e.target).val() == 8) {
                $("#loader_type_sea").slideUp();
            } else if ($(e.target).val() == 7) {
                $("#loader_type_air").slideUp();
            }
        }
    });
</script>

<script src="{{asset('adminbackend/assets/js/categoryFilter.js')}}"></script>

@endsection



