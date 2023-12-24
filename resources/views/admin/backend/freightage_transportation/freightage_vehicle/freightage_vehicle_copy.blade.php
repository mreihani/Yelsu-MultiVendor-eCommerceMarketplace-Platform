@extends('admin.admin_dashboard')
@section('admin')

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن وسیله حمل</h1>
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
                        <li class="breadcrumb-item text-muted">مدیریت وسیله حمل کالا</li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">افزودن وسیله حمل کالا</li>
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
            @foreach($errors->all() as $error)
                <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5">
                    <h4 class="alert-title" style="color:#ffa800">
                        <i class="w-icon-exclamation-triangle"></i>هشدار!</h4>
                        {{$error}}
                </div>
            @endforeach
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl col-xl-8">
                <form method="post" action="{{route('admin.store-copy.freightage-vehicle')}}" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$fvehicle->id}}">
                  
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::عمومی options-->
                        <div class="card card-flush py-4">
                           
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Tags-->
                                    <label class="required form-label">نام وسیله حمل کالا</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <input type="text" name="value" class="form-control mb-2" placeholder="نام وسیله حمل کالا را وارد نمایید" value="{{old('value', $fvehicle->value)}}" />
                                    <!--end::Input-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fs-7">نام وسیله حمل کالا بایستی منحصر به فرد باشد.</div>
                                    <!--end::توضیحات-->
                                </div>

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Tags-->
                                    <label class="form-label">ملاحظات (اختیاری)</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <input type="text" name="description" class="form-control mb-2" placeholder="" value="{{old('description', $fvehicle->description)}}" />
                                    <!--end::Input-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fs-7">در صورت نیاز می توانید یادداشت خود را وارد نمایید.</div>
                                    <!--end::توضیحات-->
                                </div>

                                <!--begin::مدیریت حمل کالا-->
                                <div class="card card-flush py-4" id="transportation_section">

                                    <div class="pt-0" id="yelsu_freightage">
                                        <div class="row repeater-body">
                                            <div class="col-lg-10">
                                                <!--begin::freightage loader types data from database -->          
                                                @foreach($fvehicle->freightageloadertype as $freightageloadertype_item)
                                                    <div class="repeater">
                                                        <div data-repeatable="">
                                                            <fieldset class="row">
                                                                <!--begin::Row-->
                                                                <div class="row col-md-10 freightage-loader-repeater">
                                                                    <div class="col-md-6">
                                                                        <!--begin::کارت body-->
                                                                        <div class="mb-10 fv-row freightagetype_selection">
                                                                            <!--begin::Tags-->
                                                                            <label class="form-label">تعیین روش ارسال </label>
                                                                            <!--end::Tags-->
                                                                            <!--begin::Input-->
                                                                            <select class="js-example-basic-single form-control" name="freightagetype_id[]">
                                                                                <option value="0">روش ارسال را انتخاب نمایید</option>
                                                                                @foreach ($freightage_types as $freightage_type)
                                                                                    <option {{$freightage_type->id == $freightageloadertype_item->freightageType->id ? "selected" : ""}} value="{{$freightage_type->id}}">{{$freightage_type->value}}</option>
                                                                                @endforeach
                                                                            </select>    
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-10 fv-row freightageloadertype_selection">
                                                                            <!--begin::Tags-->
                                                                            <label class="form-label">تعیین نوع بارگیر </label>
                                                                            <!--end::Tags-->
                                                                            <!--begin::Input-->
                                                                            <select class="js-example-basic-single form-control" name="freightageloadertype_id[]">
                                                                                <option value="{{$freightageloadertype_item->id}}">{{$freightageloadertype_item->description}}</option>
                                                                            </select>
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                    </div>
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
                                                @endforeach
                                                <!--end::freightage loader types data from database -->            
                                            </div>

                                            <div class="col-lg-2 d-flex align-items-start mt-3">
                                                <button type="button" class="btn btn-sm btn-light-primary add-repeater-btn mt-7">
                                                    افزودن
                                                    <i class="bi bi-patch-plus-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::کارت header-->
                                </div>
                                <!--end::مدیریت حمل کالا-->

                            </div>
                            <!--end::کارت header-->
                        </div>
                        <!--end::عمومی options-->
                        
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('admin.all.freightage-vehicle')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">انصراف</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">ذخیره تغییرات</span>
                                <span class="indicator-progress">لطفا صبر کنید...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->

                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
            
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
        
    </div>
    <!--end::Content wrapper-->
   
</div>
<!--end:::Main-->


{{-- اسکریپت های مربوط به مدیریت حمل --}}
<script src="{{asset('adminbackend/assets/js/loadFreightageLoaderTypeAjaxAdmin.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/freightageRepeaterVendor.js')}}"></script>


@endsection