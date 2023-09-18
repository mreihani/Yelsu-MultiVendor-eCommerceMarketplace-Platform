@extends('admin.admin_dashboard')
@section('admin')

<!--begin:: (SELECT2 search module)-->

<!--begin:: CSS(SELECT2 search module)-->
<link href="{{asset('adminbackend/assets/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--end:: CSS-->

<!--begin:: Javascript(SELECT2 search module)-->
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/select2.min.js')}}"></script>
<!--end:: Javascript-->

<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<!--end:: SELECT2-->


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن ویژگی </h1>
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
                        <li class="breadcrumb-item text-muted">افزودن ویژگی </li>
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
            @if(session()->has('error'))
                <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
                    <h4 class="alert-title" style="color:#ffa800">
                        <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                        {{session('error')}}
                </div>
            @endif
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl col-xl-8">
                <form method="post" action="{{route('store.attribute')}}" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 ">
                        <!--begin::عمومی options-->
                        <div class="card card-flush py-5">
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row">
                                        <!--begin::Tags-->
                                        <label class="required mb-1">نام ویژگی</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="text" name="name" class="form-control mb-2" placeholder="به عنوان مثال: رنگ، واحد اندازه گیری، نوع بسته بندی و ..." value="{{old('name')}}" />
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">نام ویژگی مورد نظر را وارد نمایید.</div>
                                        <!--end::توضیحات-->
                                    </div>
                                    <!--end::Input group-->
                            </div>
                            <!--end::کارت header-->

                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Tags-->
                                    <label class="required mb-1">توضیحات ویژگی</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <input type="text" name="description" class="form-control mb-2" placeholder="به عنوان مثال: این ویژگی فقط برای دسته بندی میلگرد آجدار استفاده می شود" value="{{old('description')}}" />
                                    <!--end::Input-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fs-7">ارتباط ویژگی مورد نظر با دسته بندی مرتبط با آن را شرح دهید.</div>
                                    <!--end::توضیحات-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::کارت header-->

                            <!--begin::کارت body-->
                             <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Tags-->
                                    <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                        <label style="margin-left:10px;" for="requiredAttribute">ویژگی اجباری</label>
                                        <input class="form-check-input w-45px h-30px mr-3 ml-3" type="checkbox" id="requiredAttribute" name="required" {{old('required') == "on" ? "checked" : ""}} >
                                    </div>
                                    <!--end::Tags-->
                                    <!--begin::توضیحات-->
                                    <div class="mt-2 text-muted fs-7">اگر ویژگی مورد نظر باید در صفحه افزودن آگهی حتما انتخاب شود گزینه اجباری را فعال نمایید. به عنوان مثال نوع واحد پولی یک ویژگی اجباری است که کاربر بایستی یکی از موارد را انتخاب نماید.</div>
                                    <!--end::توضیحات-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::کارت header-->
                            
                            <!--begin::کارت body-->
                             <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Tags-->
                                    <label class="mb-2" for="requiredAttribute">نوع ویژگی</label>
                                    <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                        <div class="d-flex">
                                            <!--begin::رادیو-->
                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="radio" value="dropdown" name="attribute_type" id="attribute_type_dropdown" checked="checked">
                                                <label class="form-check-label" for="attribute_type_dropdown">از پیش تعریف شده</label>
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input" type="radio" value="input_field" name="attribute_type" id="attribute_type_input_field">
                                                <label class="form-check-label" for="attribute_type_input_field">ورودی دلخواه</label>
                                            </div>
                                            <!--end::رادیو-->
                                        </div>
                                    </div>
                                    <!--end::Tags-->
                                    <!--begin::توضیحات-->
                                    <div class="mt-2 text-muted fs-7">با انتخاب گزینه از پیش تعریف شده، کاربر فقط می تواند یکی از مواردی که در سامانه ثبت شده را انتخاب کند. با انتخاب ورودی دلخواه، کاربر هر مقداری که در نظر دارد را می تواند از طریق یک فرم ورودی به سامانه وارد نماید.</div>
                                    <!--end::توضیحات-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::کارت header-->

                            <!--begin::Repeater-->
                            <div id="kt_docs_repeater_basic">
                                <!--begin::Form group-->
                                <div class="form-group card-body">
                                    <label class="required">لطفا جزئیات ویژگی را مشخص نمایید. به عنوان مثال اگر رنگ را مد نظر دارید، به ترتیب آبی، قرمز، زرد و ... را از طریق دکمه افزودن جزئیات ویژگی وارد کنید.</label>
                                    <div data-repeater-list="kt_docs_repeater_basic">
                                        <div data-repeater-item>
                                            <div class="form-group row mt-4">
                                                <div class="col-md-10">
                                                    <input type="text" name="value" class="form-control mb-2 mb-md-0" placeholder="مشخصات یا جزئیات ویژگی مورد نظر" />
                                                </div>
                                                <div class="col-md-2 d-flex justify-content-end align-items-center">
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger">
                                                        حذف
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Form group-->
        
                                <!--begin::Form group-->
                                <div class="form-group card-body" style="direction: ltr;">
                                    <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                    <i class="ki-duotone ki-plus fs-3"></i>
                                    افزودن جزئیات ویژگی
                                    </a>
                                </div>
                                <!--end::Form group-->
                            </div>
                            <!--end::Repeater-->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group card-body ">
                                        <label class="required">ویژگی مورد نظر برای کدام یک از حساب های کاربری زیر فعال شود؟</label>
                                        <div class="form-check form-check-custom form-check-solid mt-2">
                                            <input name="role[]" class="form-check-input" type="checkbox" value="admin" id="form_checkbox" @checked(true) />
                                            <label class="form-check-label" for="form_checkbox">
                                                مدیر
                                            </label>
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid mt-2">
                                            <input name="role[]" class="form-check-input" type="checkbox" value="specialist" id="form_checkbox" @checked(true) />
                                            <label class="form-check-label" for="form_checkbox">
                                                کارشناس
                                            </label>
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid mt-2">
                                            <input name="role[]" class="form-check-input" type="checkbox" value="vendor" id="form_checkbox" />
                                            <label class="form-check-label" for="form_checkbox">
                                                تأمین کننده
                                            </label>
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid mt-2">
                                            <input name="role[]" class="form-check-input" type="checkbox" value="merchant" id="form_checkbox" />
                                            <label class="form-check-label" for="form_checkbox">
                                                بازرگان
                                            </label>
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid mt-2">
                                            <input name="role[]" class="form-check-input" type="checkbox" value="retailer" id="form_checkbox" />
                                            <label class="form-check-label" for="form_checkbox">
                                                عمده / خرده فروش
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group card-body ">
                                        <label class="required">لطفا ارتباط ویژگی با زمینه فعالیت حساب کاربری مدنظر (کارشناس، تأمین کننده، عمده یا خرده فروش) را انتخاب نمایید.</label>
                                        <ul class="list-style-none mt-4">
                                            @foreach ($filter_category_array as $category)
                                                <li class="filterButtonShopPage rootCat">
                                                    <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category[0]->id}}"> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> {{$category[0]->category_name}} {{count($category[1]) ? "(".count($category[1])." زیر دسته)" : ''}}
                                                </li>
                                                <div class="subCategoryBtn">
                                                    @include('admin.body.layouts.categories-group', ['categories' => $category[1]])
                                                </div>
                                            @endforeach
                                        </ul>      
                                    </div>
                                </div>
                            </div>
                                

                        </div>
                        <!--end::عمومی options-->

                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('all.attribute')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">انصراف</a>
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

<script>
    $("input[name='attribute_type']").on('change', function(e) {
        if(e.target.value == "dropdown") {
            $("#kt_docs_repeater_basic").toggle();
        } else {
            $("#kt_docs_repeater_basic").toggle();
        }
    });
</script>

<script src="{{asset('adminbackend/assets/js/attributeFormRepeater.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/formrepeater.bundle.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/categoryFilterAttribute.js')}}"></script>

@endsection