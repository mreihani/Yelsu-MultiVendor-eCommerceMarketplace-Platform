@extends('freightage.freightage_dashboard')
@section('freightage')

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">اکانت تنظیمات</h1>
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
                        <li class="breadcrumb-item text-muted">اکانت</li>
                        <!--end::آیتم-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::فیلتر menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                        <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->فیلتر</a>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_637dc7ba89687">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">فیلتر تنظیمات</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Tags-->
                                    <label class="form-label fw-semibold">وضعیت:</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="انتخاب گزینه" data-dropdown-parent="#kt_menu_637dc7ba89687" data-allow-clear="true">
                                            <option></option>
                                            <option value="1">تایید شده</option>
                                            <option value="2">در انتظار</option>
                                            <option value="2">در حال پردازش</option>
                                            <option value="2">رد شد</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Tags-->
                                    <label class="form-label fw-semibold">نوع عضویت:</label>
                                    <!--end::Tags-->
                                    <!--begin::تنظیمات-->
                                    <div class="d-flex">
                                        <!--begin::تنظیمات-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                            <span class="form-check-label">نویسنده</span>
                                        </label>
                                        <!--end::تنظیمات-->
                                        <!--begin::تنظیمات-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                            <span class="form-check-label">مشتری</span>
                                        </label>
                                        <!--end::تنظیمات-->
                                    </div>
                                    <!--end::تنظیمات-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Tags-->
                                    <label class="form-label fw-semibold">اعلان ها:</label>
                                    <!--end::Tags-->
                                    <!--begin::Switch-->
                                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                        <label class="form-check-label">فعال</label>
                                    </div>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">ریست</button>
                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">تایید</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::فیلتر menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::اصلی button-->
                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">ساختن</a>
                    <!--end::اصلی button-->
                </div> --}}
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
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        @include('freightage.layouts.profileHeader')
                        <!--end::Details-->
                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{route('freightage.profile')}}">پروفایل من </a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{route('freightage.profileSettings')}}">تنظیمات</a>
                            </li>
                            <!--end::Nav item-->
                           
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="{{route('freightage.profileFieldOfActivity')}}">زمینه فعالیت</a>
                            </li>
                            <!--end::Nav item-->

                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{route('freightage.profileFinancialStatement')}}">صورتحساب</a>
                            </li>
                            <!--end::Nav item-->
                           
                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::پایه info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::کارت header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                        <!--begin::کارت title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">زمینه فعالیت</h3>
                        </div>
                        <!--end::کارت title-->
                    </div>
                    <!--begin::کارت header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show profileFieldOfActivityFreightagePage">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form" method="POST" action={{route('freightage.profileFieldOfActivity.store')}} enctype="multipart/form-data">
                            @csrf
                            <!--begin::کارت body-->
                            <div class="card-body border-top p-9">

                                @if($status == "inactive")
                                    <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
                                        <h4 class="alert-title" style="color:#ffa800">
                                            <i class="w-icon-exclamation-triangle"></i> توجه فرمایید!
                                        </h4>
                                        اطلاعات وارد شده در دست بررسی است. تنظیمات پس از تایید کارشناس اعمال خواهد شد.
                                    </div>
                                @endif

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">زمینه فعالیت شرکت حمل و نقل یا باربری</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <label class="form-label text-info">در کدام یک از موارد زیر فعالیت می نمایید؟ یک یا چند نوع را انتخاب کنید.</label>
                                        <div class="form-group mb-5">
                                            <ul class="list-style-none">
                                                @foreach($freightageTypeArray as $freightageTypeItem)
                                                    @if($freightageTypeItem->parent == 0)
                                                        @if($freightageTypeItem->getChildren())
                                                            <li class="filterButtonShopPage rootCat list-style-none">
                                                                @if(in_array($freightageTypeItem->id, $freightage_sector_arr))
                                                                    <input @checked(true) class="form-check-input" type="checkbox" name="type[]" value="{{$freightageTypeItem->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$freightageTypeItem->value}} 
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" name="type[]" value="{{$freightageTypeItem->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$freightageTypeItem->value}} 
                                                                @endif
                                                            </li>
                                                        @else
                                                            <li class="filterButtonShopPage rootCat list-style-none">
                                                                @if(in_array($freightageTypeItem->id, $freightage_sector_arr))
                                                                    <input @checked(true) class="form-check-input" type="checkbox" name="type[]" value="{{$freightageTypeItem->id}}"> {{$freightageTypeItem->value}} 
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" name="type[]" value="{{$freightageTypeItem->id}}"> {{$freightageTypeItem->value}} 
                                                                @endif
                                                            </li>
                                                        @endif

                                                        <div class="subCategoryBtn">
                                                            @include('freightage.layouts.field_of_activity.field-of-activity-type-group', ['items' => $freightageTypeItem->getChildren()])
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </ul>        
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6" id="loader_type_road" style="{{in_array(1, $freightage_sector_arr) ? '' : 'display: none;"'}}">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">انتخاب نوع بارگیر در حمل جاده ای</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="form-group mb-5">
                                            <label class="form-label text-info">به کدام یک از صاحبان خودروهای زیر می توانید خدمات دهید؟ حداقل یک یا چند نوع را انتخاب نمایید.</label>

                                            <ul class="list-style-none">
                                                @foreach($freightageLoaderTypeRoadArray as $freightageTypeItem)
                                                    @if($freightageTypeItem->parent == 0)
                                                        @if($freightageTypeItem->getChildren())
                                                            <li class="filterButtonShopPage rootCat list-style-none">
                                                                @if(in_array($freightageTypeItem->id, $loader_type_arr_selected))
                                                                    <input @checked(true) class="form-check-input" type="checkbox" name="loader_type[]" value="{{$freightageTypeItem->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$freightageTypeItem->value}} 
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" name="loader_type[]" value="{{$freightageTypeItem->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$freightageTypeItem->value}} 
                                                                @endif
                                                            </li>
                                                        @else
                                                            <li class="filterButtonShopPage rootCat list-style-none">
                                                                @if(in_array($freightageTypeItem->id, $loader_type_arr_selected))
                                                                    <input @checked(true) class="form-check-input" type="checkbox" name="loader_type[]" value="{{$freightageTypeItem->id}}"> {{$freightageTypeItem->value}} 
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" name="loader_type[]" value="{{$freightageTypeItem->id}}"> {{$freightageTypeItem->value}} 
                                                                @endif
                                                            </li>
                                                        @endif

                                                        <div class="subCategoryBtn">
                                                            @include('freightage.layouts.field_of_activity.field-of-activity-loader-type-road-group', ['items' => $freightageTypeItem->getChildren()])
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </ul>        
                                            
                                        </div>

                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Input group-->
                                <div class="row mb-6" id="loader_type_rail" style="{{in_array(7, $freightage_sector_arr) ? '' : 'display: none;"'}}">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">
                                        انتخاب نوع بارگیر حمل و نقل ریلی
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="حمل و نقل ریلی یکی از روش های حمل و نقل زمینی است که برای جابجایی بار و مسافر از خطوط راه آهن، قطار و ایستگاه های قطار استفاده می کند. حمل و نقل ریلی (railroad transportation) یکی از قسمتهای زنجیره لجستیکی حمل و نقل بار در سطح بین المللی است."></i>
                                    </label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="form-group mb-5">
                                            <label class="form-label text-info">به کدام یک از موارد زیر می توانید خدمات دهید؟</label>
                                            
                                            <ul class="list-style-none">
                                                @foreach($freightageLoaderTypeRailArray as $freightageTypeItem)
                                                    @if($freightageTypeItem->parent == 0)
                                                        @if($freightageTypeItem->getChildren())
                                                            <li class="filterButtonShopPage rootCat list-style-none">
                                                                @if(in_array($freightageTypeItem->id, $loader_type_rail_arr_selected))
                                                                    <input @checked(true) class="form-check-input" type="checkbox" name="loader_type_rail[]" value="{{$freightageTypeItem->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$freightageTypeItem->value}} 
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" name="loader_type_rail[]" value="{{$freightageTypeItem->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$freightageTypeItem->value}} 
                                                                @endif
                                                            </li>
                                                        @else
                                                            <li class="filterButtonShopPage rootCat list-style-none">
                                                                @if(in_array($freightageTypeItem->id, $loader_type_rail_arr_selected))
                                                                    <input @checked(true) class="form-check-input" type="checkbox" name="loader_type_rail[]" value="{{$freightageTypeItem->id}}"> {{$freightageTypeItem->value}} 
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" name="loader_type_rail[]" value="{{$freightageTypeItem->id}}"> {{$freightageTypeItem->value}} 
                                                                @endif
                                                            </li>
                                                        @endif

                                                        <div class="subCategoryBtn">
                                                            @include('freightage.layouts.field_of_activity.field-of-activity-loader-type-rail-group', ['items' => $freightageTypeItem->getChildren()])
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </ul>        
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Input group-->
                                <div class="row mb-6" id="loader_type_sea" style="{{in_array(8, $freightage_sector_arr) ? '' : 'display: none;"'}}">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">
                                        انتخاب نوع بارگیر حمل و نقل آبی / دریایی
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="حمل و نقل دریایی عبارتند از نقل و انتقال و جابجایی کالا و افراد از طریق شناور های دریایی مثل کشتی های باری، قایق، لنچ و… از کانال های آبی ، اقیانوس ها، دریاها و دریاچه ها. کالا هایی که از طریق حمل دریایی جابجا می شوند عموما تناژ بالایی دارند."></i>
                                    </label>
                                    
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="form-group mb-5">
                                            <label class="form-label text-info">به کدام یک از موارد زیر می توانید خدمات دهید؟</label>

                                            <ul class="list-style-none">
                                                @foreach($freightageLoaderTypeSeaArray as $freightageTypeItem)
                                                    @if($freightageTypeItem->parent == 0)
                                                        @if($freightageTypeItem->getChildren())
                                                            <li class="filterButtonShopPage rootCat list-style-none">
                                                                @if(in_array($freightageTypeItem->id, $loader_type_sea_arr_selected))
                                                                    <input @checked(true) class="form-check-input" type="checkbox" name="loader_type_sea[]" value="{{$freightageTypeItem->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$freightageTypeItem->value}} 
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" name="loader_type_sea[]" value="{{$freightageTypeItem->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$freightageTypeItem->value}} 
                                                                @endif
                                                            </li>
                                                        @else
                                                            <li class="filterButtonShopPage rootCat list-style-none">
                                                                @if(in_array($freightageTypeItem->id, $loader_type_sea_arr_selected))
                                                                    <input @checked(true) class="form-check-input" type="checkbox" name="loader_type_sea[]" value="{{$freightageTypeItem->id}}"> {{$freightageTypeItem->value}} 
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" name="loader_type_sea[]" value="{{$freightageTypeItem->id}}"> {{$freightageTypeItem->value}} 
                                                                @endif
                                                            </li>
                                                        @endif

                                                        <div class="subCategoryBtn">
                                                            @include('freightage.layouts.field_of_activity.field-of-activity-loader-type-sea-group', ['items' => $freightageTypeItem->getChildren()])
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </ul>        
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Input group-->
                                <div class="row mb-6" id="loader_type_air" style="{{in_array(9, $freightage_sector_arr) ? '' : 'display: none;"'}}">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">
                                        انتخاب نوع بارگیر حمل و نقل هوایی
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="همه‌ی کالاها را نمی‌توانید با حمل و نقل هوایی جا به جا کنید چرا که ورود برخی کالاها به ایران غیرقانونی است. در برخی موارد نیز قانون‌هایی برای جلوگیری از ورود برخی از کالاها به طور موقت تصویب می‌شود. احشام، مایعات، کالاهایی که اشعه ساطع می‌کنند، اسلحه، دارو و چند ماده دیگر، کالاهایی هستند که ورود آن‌ها به کشور نیازمند مجوز است."></i>
                                    </label>
                                    
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="form-group mb-5">
                                            <label class="form-label text-info">به کدام یک از موارد زیر می توانید خدمات دهید؟</label>

                                            <ul class="list-style-none">
                                                @foreach($freightageLoaderTypeAirArray as $freightageTypeItem)
                                                    @if($freightageTypeItem->parent == 0)
                                                        @if($freightageTypeItem->getChildren())
                                                            <li class="filterButtonShopPage rootCat list-style-none">
                                                                @if(in_array($freightageTypeItem->id, $loader_type_air_arr_selected))
                                                                    <input @checked(true) class="form-check-input" type="checkbox" name="loader_type_air[]" value="{{$freightageTypeItem->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$freightageTypeItem->value}} 
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" name="loader_type_air[]" value="{{$freightageTypeItem->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$freightageTypeItem->value}} 
                                                                @endif
                                                            </li>
                                                        @else
                                                            <li class="filterButtonShopPage rootCat list-style-none">
                                                                @if(in_array($freightageTypeItem->id, $loader_type_air_arr_selected))
                                                                    <input @checked(true) class="form-check-input" type="checkbox" name="loader_type_air[]" value="{{$freightageTypeItem->id}}"> {{$freightageTypeItem->value}} 
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" name="loader_type_air[]" value="{{$freightageTypeItem->id}}"> {{$freightageTypeItem->value}} 
                                                                @endif
                                                            </li>
                                                        @endif

                                                        <div class="subCategoryBtn">
                                                            @include('freightage.layouts.field_of_activity.field-of-activity-loader-type-air-group', ['items' => $freightageTypeItem->getChildren()])
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </ul>        
                                            
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
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="لطفا دسته بندی مرتبط با شرکت شرکت حمل و نقل یا باربری را از گزینه های روبه انتخاب نمایید."></i></label>
                                        </label>
                                        <!--end::Tags-->
                                       
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row mt-4">
                                            <label class="form-label text-info">یک یا چند زمینه از دسته بندی های زیر فعالیت دارید انتخاب نمایید.</label>
                                            <ul class="list-style-none">
                                                @foreach ($filter_category_array as $category)
                                                    <li class="filterButtonShopPage rootCat">
                                                        @if(in_array($category[0]->id, $category_sector_cat_arr_selected))
                                                            <input class="form-check-input" @checked(true) type="checkbox" name="category_id[]" value="{{$category[0]->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category[0]->category_name}} {{count($category[1]) ? "(".count($category[1])." زیر دسته)" : ''}}
                                                        @else
                                                            <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category[0]->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category[0]->category_name}} {{count($category[1]) ? "(".count($category[1])." زیر دسته)" : ''}}
                                                        @endif
                                                    </li>
                                                    <div class="subCategoryBtn">
                                                        @include('freightage.layouts.edit-categories-group', ['categories' => $category[1]])
                                                    </div>
                                                @endforeach
                                            </ul>      
                                        </div>
                                        <!--end::Col-->   
                                    </div>
                                @endif    
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                {{-- <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">انتخاب کارخانه / تولید کننده / تأمین کننده</label>
                                    <!--end::Tags-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="form-group mb-5">
                                            <label class="form-label text-info">در صورتی که فقط به تولید کننده / تأمین کننده خاصی خدمات می دهید آن را جستجو و انتخاب نمایید.</label>
                                            <select name="vendor_id[]" class="form-select mb-2" data-control="select2" data-placeholder="انتخاب تأمین کننده " data-allow-clear="true" multiple="multiple">
                                                @foreach ($vendorsName as $item)
                                                    <option {{in_array($item->id, $vendor_arr_selected) ? "selected" : ""}} value="{{$item->id}}">{{$item->firstname . " " . $item->lastname}}</option>
                                                @endforeach
                                            </select>
                                            <label style="font-size: 12px; color:red;" class="form-label">در صورتی که نام تولید کننده / تأمین کننده مورد نظر را از قسمت جستجو پیدا نکردید با پشتیبانی تماس حاصل فرمایید.</label>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div> --}}
                                <!--end::Input group-->

                            </div>
                            <!--end::کارت body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{route('freightage.profile')}}" type="button" class="btn btn-light btn-active-light-primary me-2">لغو</a>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره تغییرات</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::پایه info-->
               
                <!--begin::اعلان ها-->
                
                <!--end::اعلان ها-->
                <!--begin::ریست پسورد-->
                {{-- <div class="card mb-5 mb-xl-10">
                    
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">تغییر کلمه عبور</h3>
                        </div>
                    </div>
                    
                    <div id="kt_signin_password_edit" class="flex-row-fluid m-10">
                        
                        <form  class="form fv-plugins-bootstrap5 fv-plugins-framework" method="POST" action="{{route('vendor.update.password')}}">
                            @csrf
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="fv-row mb-0 fv-plugins-icon-container">
                                        <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">کلمه عبور فعلی</label>
                                        <input type="password" class="form-control form-control-lg form-control-solid" name="old_password" id="currentpassword">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-0 fv-plugins-icon-container">
                                        <label for="newpassword" class="form-label fs-6 fw-bold mb-3">کلمه عبور جدید</label>
                                        <input type="password" class="form-control form-control-lg form-control-solid" name="new_password" id="newpassword">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-0 fv-plugins-icon-container">
                                        <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">تکرار کلمه عبور جدید</label>
                                        <input type="password" class="form-control form-control-lg form-control-solid" name="new_password_confirmation" id="confirmpassword">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                </div>
                            </div>
                            <div class="form-text mb-5">کلمه عبور باید حداقل 8 کاراکتر باشد</div>
                            <div class="d-flex">
                                <button id="kt_password_submit" type="submit" class="btn btn-primary me-2 px-6">بروزرسانی کلمه عبور</button>
                                <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">انصراف</button>
                            </div>
                        </form>
                       
                    </div>
                    
                </div> --}}
               
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    
</div>

<script>
    let person_type = {!! json_encode($freightageData->person_type) !!};
   
    if(person_type == null) {
        $(".hoghoghi").hide();
    } else if(person_type == 'haghighi') {
        $(".hoghoghi").hide();
    } else if(person_type == 'hoghoghi') {
        $(".haghighi").hide();
    }

    $("#person").on("change", function () {
        if (this.value == "hoghoghi") {
            $(".haghighi").hide();
            $(".hoghoghi").show();
        } else if ("haghighi") {
            $(".haghighi").show();
            $(".hoghoghi").hide();
        }
    });
</script>


<script>
$(document).on('click', "input[name='type[]']", function(e) {
    if($(e.target).is(":checked")) {
        if($(e.target).val() == 1 || $(e.target).val() == 2 || $(e.target).val() == 3 || $(e.target).val() == 4 || $(e.target).val() == 5 || $(e.target).val() == 6) {
            $("#loader_type_road").slideDown();
        } else if ($(e.target).val() == 7) {
            $("#loader_type_rail").slideDown();
        } else if ($(e.target).val() == 8) {
            $("#loader_type_sea").slideDown();
        } else if ($(e.target).val() == 9) {
            $("#loader_type_air").slideDown();
        }
    } else {
        if($(e.target).val() == 1) {
            $("#loader_type_road").slideUp();
        } else if ($(e.target).val() == 7) {
            $("#loader_type_rail").slideUp();
        } else if ($(e.target).val() == 8) {
            $("#loader_type_sea").slideUp();
        } else if ($(e.target).val() == 9) {
            $("#loader_type_air").slideUp();
        }
    }
});
</script>

<script src="{{asset('adminbackend/assets/js/categoryFilter.js')}}"></script>

@endsection



