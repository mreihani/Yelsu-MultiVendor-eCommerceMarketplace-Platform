@extends('specialist.specialist_dashboard')
@section('specialist')

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
                <form method="post" action="{{route('specialist.store.copy.attribute')}}" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value={{$attribute->id}}>
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 ">

                        <div class="card card-flush py-5">
                            <!--begin::کارت body-->
                            <div class="card-body py-0">
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Tags-->
                                    <label class="required mb-1">نام دسته بندی مرتبط با ویژگی</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <input @readonly(true) type="text" name="attribute_category_name" class="form-control mb-2" placeholder="" value="{{old('attribute_category_name', $attribute->attribute_category_name)}}" />
                                    <!--end::Input-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fs-7">نام دسته بندی به صورت خودکار پس از انتخاب دسته بندی بر اساس <a href="#goToCategoriesSection"><u>آخرین زیر دسته</u></a> در پایین صفحه تعیین می گردد.</div>
                                    <!--end::توضیحات-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::کارت header-->
                        </div>

                        <div class="card card-flush py-5">
                            <!--begin::کارت body-->
                            <div class="card-body pt-0 pb-0">
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Tags-->
                                    <label class="required mb-1">لیست ویژگی های انتخاب شده</label>
                                    <!--end::Tags-->

                                    <!--begin::list table-->
                                    <div class="card-body pt-0 pb-0">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                                            <!--begin::Table head-->
                                            <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="">ردیف</th>
                                                    <th class="text-center">نام ویژگی</th>
                                                    <th class="min-w-250px text-center">مقادیر ویژگی</th>
                                                    <th class="w-250px text-center">عملیات</th>
                                                </tr>
                                                <!--end::Table row-->
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="fw-semibold text-gray-600 repeater" id="sortable">
                                                <!--begin::Table row Parent-->
                                                @foreach ($attribute->items()->orderBy('attribute_item_order')->get() as $key => $item)

                                                @php
                                                    $attribute_list_array = [
                                                        'id' => $item->id,
                                                        'attribute_item_name' => $item->attribute_item_name,
                                                        'attribute_item_description' => $item->attribute_item_description,
                                                        'attribute_item_keyword' => $item->attribute_item_keyword,
                                                        'value' => $item->values()->get()->pluck('value','id'),
                                                        'attribute_item_required' => $item->attribute_item_required,
                                                        'disabled_attribute' => $item->disabled_attribute,
                                                        'show_in_product_page' => $item->show_in_product_page,
                                                        'show_in_table_page' => $item->show_in_table_page,
                                                        'multiple_selection_attribute' => $item->multiple_selection_attribute,
                                                        'attribute_item_type' => $item->attribute_item_type,
                                                    ];
                                                    
                                                    $attribute_list_array = json_encode($attribute_list_array);
                                                @endphp


                                                <tr data-repeatable="" class="repeater-tr">
                                                    <!--begin::Checkbox-->
                                                    <td>
                                                        <div class="fw-bold">
                                                            {{$key + 1}}
                                                        </div>
                                                    </td>
                                                    <!--end::Checkbox-->
                                        
                                                    <!--begin::دسته بندی=-->
                                                    <td>
                                                        <div class="ms-5 text-center fw-bold">
                                                            <!--begin::Title-->
                                                            {{$item->attribute_item_name}}
                                                            <!--end::Title-->
                                                        </div>
                                                    </td>
                                                    <!--end::دسته بندی=-->
                                        
                                                    <!--begin::دسته بندی=-->
                                                    <td>
                                                        <div class="ms-5 text-center fw-bold">
                                                            <!--begin::Title-->
                                                            {{$item->attribute_item_type == "dropdown" ? $item->values->pluck('value')->join('، ') : 'ورودی دلخواه'}}
                                                            <!--end::Title-->
                                                        </div>
                                                    </td>
                                                    <!--end::دسته بندی=-->
                                        
                                                    <!--begin::عملیات=-->
                                                    <td class="text-center">
                                                        <div class="menu-item px-3">
                                                            <a class="btn btn-sm btn-info m-1 edit-button-attribute" href="#goToAttributeItemNameSection">
                                                                <i class="bi bi-pencil-fill"></i>
                                                                ویرایش
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-danger m-1 delete-button-attribute">
                                                                <i class="bi bi-trash-fill"></i>
                                                                حذف
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <!--end::عملیات=-->
                                        
                                                    <!--begin::فرم مخفی=-->
                                                    <input type="hidden" value="{{$attribute_list_array}}" name="attribute_list_array[]">
                                                    <!--end::فرم مخفی=-->
                                                </tr>
                                                @endforeach
                                                <!--end::Table row Parent-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::list table-->

                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::کارت header-->
                        </div>

                        <!--begin::عمومی options-->
                        <div class="card card-flush py-5" id="goToAttributeItemNameSection">

                            <div class="alert alert-warning mx-5 mt-5" id="attribute-item-name-empty-warning" role="alert" style="display: none;">
                                نام ویژگی نمی تواند خالی باشد. لطفا آن را تعیین نمایید.
                            </div>

                            <div class="alert alert-warning mx-5 mt-5" id="attribute-item-description-empty-warning" role="alert" style="display: none;">
                                توضیحات ویژگی نمی تواند خالی باشد. لطفا آن را تعیین نمایید.
                            </div>

                            <div class="alert alert-warning mx-5 mt-5" id="attribute-item-specification-empty-warning" role="alert" style="display: none;">
                                مشخصات ویژگی نمی تواند خالی باشد. لطفا آن را تعیین نمایید.
                            </div>

                            <!--begin::کارت body-->
                            <div class="card-body pt-5">
                                    <!--begin::Input group-->
                                    <div class="fv-row">
                                        <!--begin::Tags-->
                                        <label class="required mb-1">نام ویژگی</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="text" name="attribute_item_name" class="form-control mb-2" placeholder="به عنوان مثال: رنگ، واحد اندازه گیری، نوع بسته بندی و ..." value="{{old('attribute_item_name')}}" />
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
                                    <input type="text" name="attribute_item_description" class="form-control mb-2" placeholder="به عنوان مثال: این ویژگی فقط برای دسته بندی میلگرد آجدار استفاده می شود" value="{{old('attribute_item_description')}}" />
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
                                    <label class="mb-1">کلمه کلیدی ویژگی (به انگلیسی وارد شود)</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <input list="attribute_item_keyword_list" name="attribute_item_keyword" class="form-control mb-2" placeholder="به عنوان مثال: color برای رنگ" value="{{old('attribute_item_keyword')}}" />
                                    <datalist id="attribute_item_keyword_list">
                                        @foreach ($attribute_item_keyword_list as $attribute_item_keyword_item)
                                        <option value="{{$attribute_item_keyword_item}}">
                                        @endforeach
                                    </datalist>
                                    <!--end::Input-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fs-7">برای ویژگی هایی که نیاز به قرارگیری در یک مکان خاصی در صفحات وبسایت نیاز دارند، بایستی یک کلمه کلیدی به انگلیسی تعیین گردد.</div>
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
                                        <input class="form-check-input w-45px h-30px mr-3 ml-3" type="checkbox" id="requiredAttribute" name="attribute_item_required" {{old('attribute_item_required') == "on" ? "checked" : ""}} >
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
                                    <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                        <label style="margin-left:10px;" for="disabled_attribute">ویژگی غیر فعال</label>
                                        <input class="form-check-input w-45px h-30px mr-3 ml-3" type="checkbox" id="disabled_attribute" name="disabled_attribute" {{old('disabled_attribute') == "on" ? "checked" : ""}} >
                                    </div>
                                    <!--end::Tags-->
                                    <!--begin::توضیحات-->
                                    <div class="mt-2 text-muted fs-7">با غیر فعال شدن یک ویژگی، آن ویژگی در صفحه افزودن محصول برای سایر کاربران غیر قابل ویرایش خواهد بود و صرفا جنبه اطلاع رسانی به کاربر را دارد.</div>
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
                                        <label style="margin-left:10px;" for="show_in_product_page">نمایش ویژگی در صفحه محصول</label>
                                        <input class="form-check-input w-45px h-30px mr-3 ml-3" type="checkbox" id="show_in_product_page" name="show_in_product_page" {{old('show_in_product_page') == "on" ? "checked" : ""}} >
                                    </div>
                                    <!--end::Tags-->
                                    <!--begin::توضیحات-->
                                    <div class="mt-2 text-muted fs-7">اگر قصد نمایش ویژگی در صفحه محصول را دارید این گزینه را فعال نمایید.</div>
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
                                        <label style="margin-left:10px;" for="show_in_table_page">نمایش ویژگی در جدول محصولات</label>
                                        <input class="form-check-input w-45px h-30px mr-3 ml-3" type="checkbox" id="show_in_table_page" name="show_in_table_page" {{old('show_in_table_page') == "on" ? "checked" : ""}} >
                                    </div>
                                    <!--end::Tags-->
                                    <!--begin::توضیحات-->
                                    <div class="mt-2 text-muted fs-7">اگر قصد نمایش ویژگی در جدول محصولات را دارید این گزینه را فعال نمایید.</div>
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
                                        <label style="margin-left:10px;" for="multiple_selection_attribute">ویژگی چندگانه</label>
                                        <input class="form-check-input w-45px h-30px mr-3 ml-3" type="checkbox" id="multiple_selection_attribute" name="multiple_selection_attribute" {{old('multiple_selection_attribute') == "on" ? "checked" : ""}} >
                                    </div>
                                    <!--end::Tags-->
                                    <!--begin::توضیحات-->
                                    <div class="mt-2 text-muted fs-7">ویژگی هایی که در صفحه ایجاد و ثبت سفارش محصول قابلیت انتخاب توسط کاربر دارد. به عنوان مثال، تأمین کننده چند رنگ مختلف همزمان به محصول خود نسبت می دهد، کاربر خریدار یک رنگ را انتخاب و ثبت سفارش می نماید.</div>
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
                                    <label class="mb-2">نوع ویژگی</label>
                                    <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                        <div class="d-flex">
                                            <!--begin::رادیو-->
                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="radio" value="dropdown" name="attribute_item_type" id="attribute_type_dropdown" checked="checked">
                                                <label class="form-check-label" for="attribute_type_dropdown">از پیش تعریف شده</label>
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input" type="radio" value="input_field" name="attribute_item_type" id="attribute_type_input_field">
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
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div data-repeater-list="kt_docs_repeater_basic">
                                                <div data-repeater-item>
                                                    <div class="row mt-4">
                                                        <div class="col-md-8">
                                                            <input type="text" name="value" class="form-control mb-2 mb-md-0" placeholder="مشخصات ویژگی مورد نظر" />
                                                        </div>
                                                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger">
                                                                <i class="bi bi-patch-minus-fill"></i>
                                                                حذف
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-flex justify-content-center mt-5">
                                            <div class="form-group" style="direction: ltr;">
                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                افزودن جزئیات ویژگی
                                                <i class="bi bi-patch-plus-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Form group-->
                            </div>
                            <!--end::Repeater-->

                            <div class="separator separator-dashed my-6"></div>
                            
                            <!--begin::Form group-->
                            <div class="form-group card-body pt-5">

                                <button type="button" class="btn btn-sm btn-primary" id="repeater-btn">
                                <i class="bi bi-plus-square"></i>
                                افزودن به لیست ویژگی ها
                                </button>

                                <button type="button" class="btn btn-sm btn-success mx-1" id="repeater-btn-save-changes" style="display: none;">
                                <i class="bi bi-save"></i>
                                ذخیره تغییرات
                                </button>

                                <button type="button" class="btn btn-sm btn-dark mx-1" id="repeater-btn-discard-changes" style="display: none;">
                                <i class="bi bi-x-square"></i>
                                انصراف
                                </button>

                                <!--begin::توضیحات-->
                                <div class="mt-2 text-muted fs-7">با کلیک روی این دکمه می توانید ویژگی تعریف شده را در "لیست ویژگی های انتخاب شده" قرار داده و در نهایت در سامانه ذخیره نمایید.</div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::Form group-->

                        </div>
                        <!--end::عمومی options-->

                        <div class="card card-flush py-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group card-body ">
                                        <label class="required">ویژگی مورد نظر برای کدام یک از حساب های کاربری زیر فعال شود؟</label>
                                        <div class="form-check form-check-custom form-check-solid mt-2">
                                            <input name="role[]" class="form-check-input" type="checkbox" value="admin" id="form_checkbox" {{in_array('admin', explode(',',$attribute->role)) ? 'checked' : ''}} />
                                            <label class="form-check-label" for="form_checkbox">
                                                مدیر
                                            </label>
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid mt-2">
                                            <input name="role[]" class="form-check-input" type="checkbox" value="specialist" id="form_checkbox" {{in_array('specialist', explode(',',$attribute->role)) ? 'checked' : ''}} />
                                            <label class="form-check-label" for="form_checkbox">
                                                کارشناس
                                            </label>
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid mt-2">
                                            <input name="role[]" class="form-check-input" type="checkbox" value="vendor" id="form_checkbox" {{in_array('vendor', explode(',',$attribute->role)) ? 'checked' : ''}} />
                                            <label class="form-check-label" for="form_checkbox">
                                                تأمین کننده
                                            </label>
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid mt-2">
                                            <input name="role[]" class="form-check-input" type="checkbox" value="merchant" id="form_checkbox" {{in_array('merchant', explode(',',$attribute->role)) ? 'checked' : ''}} />
                                            <label class="form-check-label" for="form_checkbox">
                                                بازرگان
                                            </label>
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid mt-2">
                                            <input name="role[]" class="form-check-input" type="checkbox" value="retailer" id="form_checkbox" {{in_array('retailer', explode(',',$attribute->role)) ? 'checked' : ''}} />
                                            <label class="form-check-label" for="form_checkbox">
                                                عمده / خرده فروش
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6" id="goToCategoriesSection">
                                    <div class="form-group card-body ">
                                        <label class="required">لطفا ارتباط ویژگی با زمینه فعالیت حساب کاربری مدنظر (کارشناس، تأمین کننده، عمده یا خرده فروش) را انتخاب نمایید.</label>
                                        <ul class="list-style-none mt-4">
                                            @foreach ($filter_category_array as $category)
                                                <li class="filterButtonShopPage rootCat">
                                                    <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category[0]->category_name}} {{count($category[1]) ? "(".count($category[1])." زیر دسته)" : ''}}
                                                </li>
                                                <div class="subCategoryBtn">
                                                    @include('specialist.body.layouts.specialist_attributes.edit-categories-group', ['categories' => $category[1]])
                                                </div>
                                            @endforeach
                                        </ul>      
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('specialist.all.attribute')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">انصراف</a>
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


<script src="{{asset('adminbackend/assets/js/categoryFilterAttribute.js')}}"></script>

{{-- تمام فایل های جاوااسکریپتی مربوط به بخش ویژگی ها --}}
<script src="{{asset('adminbackend/assets/js/attributeFormRepeater.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/formrepeater.bundle.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/attributeFormFunctions.js')}}"></script>


@endsection

