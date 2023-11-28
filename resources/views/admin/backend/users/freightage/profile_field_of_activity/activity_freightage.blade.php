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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">تایید اطلاعات شرکت باربری</h1>
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
                        <li class="breadcrumb-item text-muted">درباره شرکت باربری</li>
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
                        <form id="kt_account_profile_details_form" class="form" method="POST" action="{{route('admin.freightage.profile.verify.store')}}">
                            @csrf
                            <input type="hidden" value="{{$id}}" name="id">
                            <!--begin::کارت body-->
                            <div class="card-body border-top p-9">
                                <h5 class="mb-10">
                                    لطفا اطلاعات شرکت باربری را مطالعه و تایید نمایید.
                                </h5>

                                <!--begin::Input group-->
                                <div id="kt_account_settings_profile_details" class="collapse show profileFieldOfActivityFreightagePage">
                                    <!--begin::Form-->
                                        <!--begin::کارت body-->
                                        <div class="card-body border-top p-9">
            
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
                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="لطفا دسته بندی مرتبط با شرکت باربری را از گزینه های روبه انتخاب نمایید."></i></label>
                                                    </label>
                                                    <!--end::Tags-->
                                                   
                                                    <!--begin::Col-->
                                                    <div class="col-lg-8 fv-row mt-4">
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
                                <a type="reset" class="btn btn-light btn-active-light-primary me-2" href="{{route('admin.freightage.profile.verifyAll')}}">لغو</a>
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



