@extends('vendor.vendor_dashboard')
@section('vendor')


<!--begin:: TinyMCE-->
<script type="text/javascript">
    tinymce.init({
        selector: '#short_desc',
        plugins: "directionality image link table media lists",
        toolbar: "undo redo | styleselect | bold italic underline | link image alignleft aligncenter alignright ltr rtl numlist bullist | fontsize",
        directionality: "rtl",
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
    });
    tinymce.init({
        selector: '#long_desc',
        plugins: "directionality image link table media lists",
        toolbar: "undo redo | styleselect | bold italic underline | link image alignleft aligncenter alignright ltr rtl numlist bullist | fontsize",
        directionality: "rtl",
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
    });
    tinymce.init({
        selector: '#specification',
        plugins: "directionality image link table media lists",
        toolbar: "undo redo | styleselect | bold italic underline | link image alignleft aligncenter alignright ltr rtl numlist bullist | fontsize",
        directionality: "rtl",
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
    });
</script>
<!--end:: TinyMCE-->


<!-- SELECT2 -->
<link rel="stylesheet" type="text/css" href="{{asset('adminbackend/assets/plugins/custom/select2/select2.min.css')}}">
<script src="{{asset('adminbackend/assets/plugins/custom/select2/select2.min.js')}}"></script>

<!-- SELECT2 initialize -->
<script>
    $(document).ready(function() {
        $('.yelsu-select2-basic-single').select2();
    });
</script>



<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    @foreach($errors->all() as $error)
        <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
            <h4 class="alert-title" style="color:#ffa800">
                <i class="w-icon-exclamation-triangle"></i>هشدار!</h4>
                {{$error}}
        </div>
    @endforeach
    @if(session()->has('error'))
        <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
            <h4 class="alert-title" style="color:#ffa800">
                <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                {!! session('error') !!}
        </div>
    @endif
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">محصولات</h1>
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
                        <li class="breadcrumb-item text-muted">ویرایش محصول</li>
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
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Form-->
                <form class="form d-flex flex-column flex-lg-row" method="POST" action="{{route('vendor.update.product')}}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="old_image" value="{{$products->product_thumbnail}}">
                    <input type="hidden" name="old_image_sm" value="{{$products->product_thumbnail_sm}}">
                    <input type="hidden" name="id" value={{$products->id}} id="product_id">

                    <!--begin::کناری column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::کارت header-->
                            <div class="card-header">
                                <!--begin::کارت title-->
                                <div class="card-title">
                                    <h2>تصویر محصول</h2>
                                </div>
                                <!--end::کارت title-->
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <!--begin::Image input placeholder-->
                                <style>.image-input-placeholder { background-image: url({{!empty($products->product_thumbnail) ? url($products->product_thumbnail) : url(asset('storage/upload/no_image_product.jpg'))}}); } [data-theme="dark"] .image-input-placeholder { background-image: url({{!empty($products->product_thumbnail) ? url($products->product_thumbnail) : url(asset('storage/upload/no_image_product.jpg'))}}); }</style>
                                <!--end::Image input placeholder-->
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <!--begin::نمایش existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::نمایش existing avatar-->
                                    <!--begin::Tags-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض آواتار">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="product_thumbnail" accept=".png, .jpg, .jpeg" />
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
                                <!--begin::توضیحات-->
                                <div class="text-muted fs-7">تصویر بندانگشتی محصول را تنظیم کنید. فقط فایل های تصویری *.png، *.jpg و *.jpeg پذیرفته می شوند</div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::Thumbnail settings-->
                        
                        <!--begin::وضعیت-->
                        <div class="card card-flush py-4">
                            <!--begin::کارت header-->
                            <div class="card-header">
                                <!--begin::کارت title-->
                                <div class="card-title">
                                    <h2>وضعیت</h2>
                                </div>
                                <!--end::کارت title-->
                                <!--begin::کارت toolbar-->
                                <div class="card-toolbar">
                                    <div class="rounded-circle {{$products->status == 'active' ? "bg-success" : "bg-warning"}} w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                </div>
                                <!--begin::کارت toolbar-->
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                <!--begin::انتخاب2-->
                                <select class="form-select mb-2" name="product_status" data-hide-search="true" data-placeholder="انتخاب">
                                    <option value="active" {{$products->status == 'active' ? "selected" : ""}}>منتشر شده</option>
                                    <option value="disabled" {{$products->status == 'disabled' ? "selected" : ""}}>در حال بازبینی</option>
                                </select>
                                <!--end::انتخاب2-->
                                <!--begin::توضیحات-->
                                <div class="text-muted fs-7">وضعیت محصول را تنظیم کنید.</div>
                                <!--end::توضیحات-->
                                <!--begin::تاریخpicker-->
                                <div class="d-none mt-10">
                                    <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">انتخاب publishing date و time</label>
                                    <input class="form-control" id="kt_ecommerce_add_product_status_datepicker" placeholder="انتخاب تاریخ & time" />
                                </div>
                                <!--end::تاریخpicker-->
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::وضعیت-->
                        
                        <!--begin::نوع فروش-->
                        <div class="card card-flush py-4">
                            <!--begin::کارت header-->
                            <div class="card-header">
                                <!--begin::کارت title-->
                                <div class="card-title">
                                    <h2>نوع فروش</h2>
                                </div>
                                <!--end::کارت title-->
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                <!--begin::انتخاب2-->
                                <select class="form-select mb-2" name="trading_method" data-hide-search="true" data-placeholder="انتخاب">
                                    <option value="internal" {{$products->trading_method == 'internal' ? "selected" : ""}}>داخلی</option>
                                    <option value="export" {{$products->trading_method == 'export' ? "selected" : ""}}>صادراتی</option>
                                    <option value="import" {{$products->trading_method == 'import' ? "selected" : ""}}>وارداتی</option>
                                </select>
                                <!--end::انتخاب2-->
                                <!--begin::توضیحات-->
                                <div class="text-muted fs-7">محصول برای فروش داخل کشور یا صادرات</div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::نوع فروش-->

                        <!--begin::دسته بندی & tags-->
                        <div class="card card-flush py-4">
                            <!--begin::کارت header-->

                           {{-- این رول برای اینه که چون فایل جاوا اسکریپت برای ایجکس یکسان است، باید مسیر کاربر کارشناس اول اش باشه که سیستم بتونه از طریق کنترلر کارشناس درخواست رو بگیره --}}
                           <input type="hidden" value="vendor" id="user-role">

                           {{-- این رول خود کاربر محصول است که از تابع کنترلر میاد میشینه و بعد میره روی ایجکس و مشخص میشه این رو آیا تامین کننده زده یا هر کسی --}}
                           <input type="hidden" value="vendor" id="product-user-role">

                            <div class="card-header">
                                <!--begin::کارت title-->
                                <div class="card-title required">
                                    <h2>انتخاب دسته بندی</h2>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="در صورتی که دسته بندی مورد نظر در لیست زیر قرار ندارد، ابتدا آن را از بخش تنظیمات حساب کاربری انتخاب نمایید تا در لیست زیر فراخوانی گردد."></i>
                                </div>
                                <!--end::کارت title-->
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                <ul class="list-style-none mt-4">
                                    @foreach ($filter_category_array as $category)
                                        <li class="filterButtonShopPage rootCat">
                                            @if(in_array($category[0]->id, $products->categories()->pluck('id')->toArray()))
                                                <input class="form-check-input" @checked(true) type="checkbox" name="category_id[]" value="{{$category[0]->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category[0]->category_name}} {{count($category[1]) ? "(".count($category[1])." زیر دسته)" : ''}}
                                            @else
                                                <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category[0]->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category[0]->category_name}} {{count($category[1]) ? "(".count($category[1])." زیر دسته)" : ''}}
                                            @endif
                                        </li>
                                        <div class="subCategoryBtn">
                                            @include('vendor.body.layouts.vendor_product.edit-categories-group', ['categories' => $category[1]])
                                        </div>
                                    @endforeach
                                </ul>   
                            </div>
                            <!--end::کارت body-->

                        </div>
                        <!--end::دسته بندی & tags-->

                        <!--begin::لوپ ویژگی ها-->
                        <div id="attribute-loop">
                            @foreach ($allAttributes as $attributeKey => $attribute)
                                <div class="card card-flush py-4 mt-10">
                                    <!--begin::کارت header-->
                                    <div class="card-header">
                                        <!--begin::کارت title-->
                                        <div class="card-title {{$attribute->attribute_item_required == true ? "required" : ""}}">
                                            <h2>{{$attribute->attribute_item_name}}</h2>
                                        </div>
                                        <!--end::کارت title-->
                                    </div>
                                    <!--end::کارت header-->

                                    <!--begin::کارت body-->
                                    <div class="card-body pt-0">
                                        <div>
                                            <!--begin::Input group-->
                                            <!--begin::انتخاب2-->
                                            @if($attribute->attribute_item_type == "dropdown" && !$attribute->multiple_selection_attribute)
                                                <select style="{{$attribute->disabled_attribute ? 'pointer-events: none; background-color:#eff2f5;' : ''}}" class="form-select mb-2" name="attribute[{{$attribute->attributes->id}}][{{$attribute->id}}][attribute_value_id]" data-hide-search="true" data-placeholder="انتخاب" >
                                                    @if($attribute->attribute_item_required == false)
                                                        <option value="none" selected="selected">هیچ کدام</option>
                                                    @endif
                                                    @foreach ($attribute->values as $item)
                                                        @if(in_array($item->id, $products->attributes()->pluck('attribute_value_id')->toArray()))
                                                            <option @selected(true) value="{{$item->id}}">{{$item->value}}</option>
                                                        @else
                                                            <option value="{{$item->id}}">{{$item->value}} </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @elseif($attribute->attribute_item_type == "dropdown" && $attribute->multiple_selection_attribute)    
                                                <input type="hidden" name="attribute[{{$attribute->attributes->id}}][{{$attribute->id}}][attribute_value_id][]" value="none" checked="true">
                                                @foreach ($attribute->values as $item)
                                                    @if(in_array($item->id, $products->attributes()->pluck('attribute_value_id')->toArray()))
                                                        <li class="list-style-none mt-4">
                                                            <input style="{{$attribute->disabled_attribute ? 'pointer-events: none; background-color:#eff2f5; border-color:#eff2f5;' : ''}}" @checked(true) class="form-check-input" type="checkbox" name="attribute[{{$attribute->attributes->id}}][{{$attribute->id}}][attribute_value_id][]" value="{{$item->id}}"> {{$item->value}} 
                                                        </li>
                                                    @else
                                                        <li class="list-style-none mt-4">
                                                            <input style="{{$attribute->disabled_attribute ? 'pointer-events: none; background-color:#eff2f5; border-color:#eff2f5;' : ''}}" class="form-check-input" type="checkbox" name="attribute[{{$attribute->attributes->id}}][{{$attribute->id}}][attribute_value_id][]" value="{{$item->id}}"> {{$item->value}} 
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @elseif($attribute->attribute_item_type == "input_field")
                                                <input style="{{$attribute->disabled_attribute ? 'pointer-events: none; background-color:#eff2f5;' : ''}}" type="text" name="attribute[{{$attribute->attributes->id}}][{{$attribute->id}}][attribute_value]" class="form-control mb-2" placeholder="مقدار ویژگی مورد نظر را وارد نمایید" value="{{count($products->attributes()->where('attribute_item_id', $attribute->id)->get()) ? $products->attributes()->where('attribute_item_id', $attribute->id)->get()->first()->pivot->attribute_value : ""}}"/>
                                                <input type="hidden" name="attribute[{{$attribute->attributes->id}}][{{$attribute->id}}][attribute_value_id]" value="{{$attribute->values[0]->id}}">
                                            @endif
                                            <!--end::انتخاب2-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7 mt-5">{{$attribute->attribute_item_description}}</div>
                                            <!--end::توضیحات-->
                                            <!--end::Input group-->
                                        </div>
                                    </div>
                                    <!--end::کارت body-->
                                </div>
                            @endforeach
                        </div>
                        <!--end::لوپ ویژگی ها-->

                    </div>
                    <!--end::کناری column-->
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">ایجاد آگهی محصول</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">بهتر دیده شدن آگهی</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::عمومی options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::کارت header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>عمومی</h2>
                                            </div>
                                        </div>
                                        <!--end::کارت header-->
                                        <!--begin::کارت body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Tags-->
                                                <label class="required form-label">نام محصول </label>
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <input type="text" name="product_name" class="form-control mb-2" placeholder="نام محصول" value="{{$products->product_name}}"/>
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7"> 
                                                    نام محصول مورد نیاز است و توصیه می شود منحصر به فرد باشد.
                                                    نحوه نوشتن نام محصول به شرح زیر است:
                                                </div>
                                                <br>
                                                <div class="text-muted fs-7">
                                                    نام زیر دسته+نام کارخانه یا تأمین کننده+شماره یا مشخصات محصول
                                                    به عنوان مثال:
                                                    میلگرد آجدار ذوب آهن اصفهان شماره 12
                                                </div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Tags-->
                                                <label class="required form-label">آدرس URL یا اسلاگ </label>
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <input type="text" name="product_slug" class="form-control mb-2" placeholder="اسلاگ URL" value="{{$products->product_slug}}"/>
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">اسلاگ URL مورد نیاز است و توصیه می شود منحصر به فرد و انگلیسی باشد.</div>
                                                <br>
                                                <div class="text-muted fs-7">
                                                    این عبارت بایستی به ترتیب از نام زیر دسته محصول به انگلیسی، نام کارخانه یا تأمین کننده و شماره یا مشخصات محصول تشکیل شود. به عنوان مثال برای میلگرد آجدار ذوب آهن اصفهان شماره 12 می توان از ترکیب زیر استفاده کرد:
                                                </div>
                                                <div class="text-muted fs-7" style="text-align: left;">
                                                    ribbed-rebar-zob-ahan-esfehan-12
                                                </div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                           <!--begin::Input group-->
                                           <div class="mb-10">
                                            <!--begin::Tags-->
                                            <label class="form-label">توضیحات کوتاه:</label>
                                            <!--end::Tags-->
                                            <!--begin::or-->
                                            <textarea name="short_desc" id="short_desc">{{$products->short_desc}}</textarea>
                                            <!--end::or-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">برای دید بهتر، توضیحاتی را برای محصول تنظیم کنید.</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mt-10">
                                            <!--begin::Tags-->
                                            <label class="form-label">توضیحات تکمیلی:</label>
                                            <!--end::Tags-->
                                            <!--begin::or-->
                                            <textarea name="long_desc" id="long_desc">{{$products->long_desc}}</textarea>
                                            <!--end::or-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">برای دید بهتر، توضیحاتی را برای محصول تنظیم کنید.</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mt-10">
                                            <!--begin::Tags-->
                                            <label class="form-label">مشخصات محصول:</label>
                                            <!--end::Tags-->
                                            <!--begin::or-->
                                                <textarea name="specification" id="specification">{{old('specification') ? old('specification') : $products->specification}}</textarea>
                                            <!--end::or-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">مشخصات محصول را وارد نمایید.</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->
                                        
                                        </div>
                                        <!--end::کارت header-->
                                    </div>
                                    <!--end::عمومی options-->

                                    <!--begin::مدیریت حمل کالا-->
                                    @if(count($vendorData->vendor_outlets))
                                        <div class="card card-flush py-4" id="transportation_section">

                                            <!--begin::کارت header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>مدیریت روش های ارسال کالا</h2>
                                                </div>
                                            </div>
                                            <!--end::کارت header-->

                                            <div class="card-body pt-0 ">
                                                <!--begin::Input group-->
                                                <div class="fv-row">
                                                    <!--begin::Tags-->
                                                    <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                        <label style="margin-left:10px;" for="userHasVehicle">وسیله حمل دارم</label>
                                                        <input class="form-check-input w-45px h-30px mr-3 ml-3" type="checkbox" id="userHasVehicle" name="user_has_vehicle" {{!count($products->freightageloadertype) ? "checked" : ""}}>
                                                    </div>
                                                    <!--end::Tags-->
                                                    <!--begin::توضیحات-->
                                                    <div class="mt-2 text-muted fs-7">اگر وسیله حمل کالا توسط تأمین کننده برای محصول مورد نظر فراهم می گردد، این گزینه را فعال نمایید.</div>
                                                    <!--end::توضیحات-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>

                                            <div class="card-body pt-0" id="yelsu_freightage">
                                                
                                                <input type="hidden" value="{{json_encode($freightage_types->map->only('id', 'value'))}}" id="freightage-type-object">
                                                <input type="hidden" value="{{json_encode($vendorData->vendor_outlets->map->only('id','shop_name'))}}" id="origin-loadertype-outlet">

                                                <div class="separator pt-5 mb-5 opacity-75"></div>

                                                <p>لطفا روش ارسال و نوع بارگیر مورد نظر خود را از فرم زیر انتخاب نمایید.</p>
                                               
                                                <div class="row repeater-body pt-5">
                                                    <div class="col-lg-10">
                                                        <!--begin::freightage loader types data from database -->            
                                                        <div class="repeater">
                                                            @foreach($products->freightageloadertype as $freightageloadertype_item)
                                                                <div data-repeatable="" class="mb-10 notice bg-light-primary rounded border-primary border border-dashed p-6">
                                                                    <fieldset class="row">
                                                                        <!--begin::Row-->
                                                                        <div class="row col-md-12 freightage-loader-repeater">
                                                                            <div class="col-md-12">
                                                                                <!--begin::کارت body-->
                                                                                <div class="mb-10 fv-row">
                                                                                    <!--begin::Tags-->
                                                                                    <label class="form-label">تعیین مبدا سفارش </label>
                                                                                    <!--end::Tags-->
                                                                                    <!--begin::Input-->
                                                                                    <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="origin_loadertype_outlet[]" style="width: 100%">
                                                                                        <option value="0">مبدا سفارش را انتخاب نمایید</option>
                                                                                        @foreach ($vendorData->vendor_outlets->map->only("id","shop_name","shop_address") as $origin_loadertype_outlet_item)
                                                                                            <option {{$freightageloadertype_item->origin_loadertype_outlet == $origin_loadertype_outlet_item['id'] ? "selected" : ""}} value="{{$origin_loadertype_outlet_item['id']}}">{{$origin_loadertype_outlet_item['shop_name']}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <!--end::Input-->
                                                                                </div>
                                                                                <!--end::Input group-->
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <!--begin::کارت body-->
                                                                                <div class="mb-10 fv-row freightagetype_selection">
                                                                                    <!--begin::Tags-->
                                                                                    <label class="form-label">تعیین روش ارسال </label>
                                                                                    <!--end::Tags-->
                                                                                    <!--begin::Input-->
                                                                                    <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="freightagetype_id[]">
                                                                                        <option value="0">روش ارسال را انتخاب نمایید</option>
                                                                                        @foreach ($freightage_types as $freightage_type)
                                                                                            <option {{$freightage_type->id == $freightageloadertype_item->loader_type->freightageType->id ? "selected" : ""}} value="{{$freightage_type->id}}">{{$freightage_type->value}}</option>
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
                                                                                    <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="freightageloadertype_id[]">
                                                                                        <option value="{{$freightageloadertype_item->loader_type->id}}">{{$freightageloadertype_item->loader_type->description}}</option>
                                                                                    </select>
                                                                                    <!--end::Input-->
                                                                                </div>
                                                                                <!--end::Input group-->
                                                                            </div>
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </fieldset>
                                                                    <fieldset class="row d-flex justify-content-end ">
                                                                        <div class="col-md-5">
                                                                            <!--begin::Tags-->
                                                                            <label class="form-label">تعیین حداقل مقدار</label>
                                                                            <!--end::Tags-->
                                                                            
                                                                            <!--begin::Input-->
                                                                            <input type="text" class="form-control form-control-sm" name="loader_type_min[]" placeholder="به عنوان مثال: 1000" value="{{$freightageloadertype_item->loader_type_min}}">
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <!--begin::Tags-->
                                                                            <label class="form-label">تعیین حداکثر مقدار</label>
                                                                            <!--end::Tags-->
                                                                            
                                                                            <!--begin::Input-->
                                                                            <input type="text" class="form-control form-control-sm" name="loader_type_max[]" placeholder="به عنوان مثال: 5000" value="{{$freightageloadertype_item->loader_type_max}}">
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <div class="col-md-2 d-flex align-items-end">
                                                                            <button type="button" class="btn btn-sm btn-light-danger del-repeater-btn">
                                                                                حذف
                                                                                <i class="bi bi-patch-minus-fill"></i>
                                                                            </button>
                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                            @endforeach

                                                            @if(!count($products->freightageloadertype))
                                                                <div data-repeatable="" class="mb-10 notice bg-light-primary rounded border-primary border border-dashed p-6">
                                                                    <fieldset class="row">
                                                                        <!--begin::Row-->
                                                                        <div class="row col-md-12 freightage-loader-repeater">
                                                                            <div class="col-md-12">
                                                                                <!--begin::کارت body-->
                                                                                <div class="mb-10 fv-row">
                                                                                    <!--begin::Tags-->
                                                                                    <label class="form-label">تعیین مبدا سفارش </label>
                                                                                    <!--end::Tags-->
                                                                                    <!--begin::Input-->
                                                                                    <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="origin_loadertype_outlet[]" style="width: 100%">
                                                                                        <option value="0">مبدا سفارش را انتخاب نمایید</option>
                                                                                        @foreach ($vendorData->vendor_outlets->map->only("id","shop_name","shop_address") as $origin_loadertype_outlet_item)
                                                                                            <option value="{{$origin_loadertype_outlet_item['id']}}">{{$origin_loadertype_outlet_item['shop_name']}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <!--end::Input-->
                                                                                </div>
                                                                                <!--end::Input group-->
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <!--begin::کارت body-->
                                                                                <div class="mb-10 fv-row freightagetype_selection">
                                                                                    <!--begin::Tags-->
                                                                                    <label class="form-label">تعیین روش ارسال </label>
                                                                                    <!--end::Tags-->
                                                                                    <!--begin::Input-->
                                                                                    <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="freightagetype_id[]" style="width: 100%">
                                                                                        <option value="0">روش ارسال را انتخاب نمایید</option>
                                                                                        @foreach ($freightage_types as $freightage_type)
                                                                                            <option value="{{$freightage_type->id}}">{{$freightage_type->value}}</option>
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
                                                                                    <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="freightageloadertype_id[]" style="width: 100%">
                                                                                        <option value="0">نوع بارگیر را انتخاب نمایید</option>
                                                                                    </select>
                                                                                    <!--end::Input-->
                                                                                </div>
                                                                                <!--end::Input group-->
                                                                            </div>
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </fieldset>
                                                                    <fieldset class="row d-flex justify-content-end ">
                                                                        <div class="col-md-5">
                                                                            <!--begin::Tags-->
                                                                            <label class="form-label">تعیین حداقل مقدار</label>
                                                                            <!--end::Tags-->
                                                                            
                                                                            <!--begin::Input-->
                                                                            <input type="text" class="form-control form-control-sm" name="loader_type_min[]" placeholder="به عنوان مثال: 1000">
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <!--begin::Tags-->
                                                                            <label class="form-label">تعیین حداکثر مقدار</label>
                                                                            <!--end::Tags-->
                                                                            
                                                                            <!--begin::Input-->
                                                                            <input type="text" class="form-control form-control-sm" name="loader_type_max[]" placeholder="به عنوان مثال: 5000">
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <div class="col-md-2 d-flex align-items-end">
                                                                            <button type="button" class="btn btn-sm btn-light-danger del-repeater-btn">
                                                                                حذف
                                                                                <i class="bi bi-patch-minus-fill"></i>
                                                                            </button>
                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                            @endif
                                                            
                                                        </div>
                                                        <!--end::freightage loader types data from database -->        
                                                        
                                                    </div>
        
                                                    <div class="col-lg-2 d-flex align-items-start mt-3">
                                                        <button type="button" class="btn btn-sm btn-light-primary add-repeater-btn mt-5">
                                                            افزودن
                                                            <i class="bi bi-patch-plus-fill"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::کارت header-->
                                        </div>
                                    @endif    
                                    <!--end::مدیریت حمل کالا-->

                                    <!--begin::ثبت نقاط مرتبط با محصول-->
                                    @if(count($vendorData->vendor_outlets))
                                        <div class="card card-flush py-4" id="product-outlet-body">

                                            <!--begin::کارت header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>ثبت قیمت با توجه به موقعیت مکانی محصول</h2>
                                                </div>
                                            </div>
                                            <!--end::کارت header-->

                                            <div class="card-body pt-0 pb-0">
                                                <!--begin::Tags-->
                                                <label class="form-label">لطفا موقعیت های مکانی که این محصول را از آنجا به فروش می رسانید انتخاب و <u>قیمت پایه</u> (بدون ارزش افزوده) را وارد نمایید.</label>
                                                <!--end::Tags-->
                                            </div>

                                            <div class="card-body pt-0 ">
                                                <!--begin::Input group-->
                                                <div class="fv-row">
                                                    @foreach($vendorData->vendor_outlets as $outlet_item)
                                                        <div class="row mt-2 outlet-row">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <input {{in_array($outlet_item->id, $products->outlets->pluck('id')->toArray()) ? "checked" : ""}} class="form-check-input product_outlet_checkbox" type="checkbox" name="product_outlet_id[]" value="{{$outlet_item->id}}">
                                                                <span class="form-check-label" style="margin-right: 5px;">
                                                                    {{$outlet_item->shop_name}}
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 d-flex align-items-center outlet-address {{!in_array($outlet_item->id, $products->outlets->pluck('id')->toArray()) ? 'text-muted' : ''}}">
                                                                آدرس:
                                                                {{$outlet_item->shop_address}}
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input {{!in_array($outlet_item->id, $products->outlets->pluck('id')->toArray()) ? 'disabled' : ''}} type="number" class="form-control product_outlet_selling_price" name="product_outlet_selling_price[]" placeholder="قیمت پایه" value="{{$products->outlets->where('id', $outlet_item->id)->first() ? $products->outlets->where('id', $outlet_item->id)->first()->pivot->selling_price : ''}}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!--end::Input group-->

                                                <div class="d-flex align-items-center justify-content-between border border-dashed border-gray-300 rounded px-7 py-3 mt-10">
                                                    <!--begin::Title-->
                                                    <div class="fs-5 text-dark text-hover-primary fw-semibold w-375px ">
                                                        
                                                        <svg fill="#000000" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                            viewBox="0 0 512 512" xml:space="preserve">
                                                            <g>
                                                                <g>
                                                                    <path d="M187.935,136.886c-28.148,0-51.049,22.9-51.049,51.049c0,28.148,22.9,51.047,51.049,51.047
                                                                        c28.148,0,51.049-22.9,51.049-51.047C238.984,159.787,216.084,136.886,187.935,136.886z M187.937,204.95
                                                                        c-9.383,0-17.016-7.632-17.016-17.015c0-9.383,7.633-17.016,17.016-17.016c9.383,0,17.016,7.633,17.016,17.016
                                                                        C204.953,197.317,197.319,204.95,187.937,204.95z"/>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <g>
                                                                    <path d="M324.066,273.017c-28.148,0-51.049,22.9-51.049,51.047c0,28.148,22.9,51.049,51.049,51.049
                                                                        c28.148,0,51.049-22.9,51.049-51.049C375.115,295.916,352.214,273.017,324.066,273.017z M324.066,341.08
                                                                        c-9.383,0-17.016-7.633-17.016-17.016c0-9.383,7.633-17.015,17.016-17.015c9.383,0,17.016,7.633,17.016,17.015
                                                                        C341.082,333.447,333.449,341.08,324.066,341.08z"/>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <g>
                                                                    <path d="M340.222,171.784c-6.644-6.644-17.419-6.644-24.064,0L171.771,316.171c-6.645,6.644-6.645,17.419,0,24.064
                                                                        c3.323,3.323,7.678,4.985,12.032,4.985c4.354,0,8.71-1.662,12.032-4.985l144.388-144.387
                                                                        C346.868,189.203,346.868,178.428,340.222,171.784z"/>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <g>
                                                                    <path d="M256.001,0C114.843,0,0.002,114.84,0.002,255.999c0,52.1,15.442,101.818,44.77,144.491L1.877,486.277
                                                                        c-3.221,6.441-2.236,14.189,2.493,19.62C7.807,509.844,12.725,512,17.777,512c1.9,0,3.82-0.306,5.685-0.935l102.502-34.619
                                                                        c39.336,23.284,84.11,35.552,130.037,35.552C397.158,511.999,512,397.159,512,255.999S397.16,0,256.001,0z M256.001,476.453
                                                                        c-42.028,0-82.923-11.927-118.266-34.491c-2.891-1.846-6.214-2.793-9.565-2.793c-1.911,0-3.832,0.307-5.686,0.934l-69.517,23.478
                                                                        l28.398-56.794c3.013-6.027,2.36-13.241-1.689-18.627c-28.87-38.408-44.129-84.109-44.129-132.16
                                                                        c0-121.558,98.895-220.454,220.454-220.454s220.454,98.896,220.454,220.454S377.559,476.453,256.001,476.453z"/>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <span id="commission-type-title">
                                                            میزان کمیسیون {{$products->determine_product_commission_type() == "percent_commission" ? "(درصدی)" : "(ثابت)"}}
                                                        </span>
                                                    </div>
                                                    <!--end::Title-->
    
                                                    <input type="hidden" value="{{$products->determine_product_commission()}}" id="product_commission" commission-type="{{$products->determine_product_commission_type()}}">
    
                                                    <!--begin::پردازش-->
                                                    <div class="pe-2">
                                                        <span id="commission_value" class="badge badge-light-primary">
                                                            {{$products->determine_product_commission()}} {{$products->determine_product_commission_type() == "percent_commission" ? "درصد" : ""}}
                                                        </span>
                                                    </div>
                                                    <!--end::پردازش-->
                                                </div>

                                            </div>
                                            <!--end::کارت header-->
                                        </div>
                                    @else
                                        <div class="card card-flush py-4">
                                            <!--begin::کارت header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>ثبت قیمت با توجه به موقعیت مکانی تحویل محصول</h2>
                                                </div>
                                            </div>
                                            <!--end::کارت header-->

                                            <div class="card-body pt-0 pb-0">
                                                <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.1" d="M3 12C3 4.5885 4.5885 3 12 3C19.4115 3 21 4.5885 21 12C21 19.4115 19.4115 21 12 21C4.5885 21 3 19.4115 3 12Z" fill="#323232"></path> <path d="M12 8L12 13" stroke="#323232" stroke-width="2" stroke-linecap="round"></path> <path d="M12 16V15.9888" stroke="#323232" stroke-width="2" stroke-linecap="round"></path> <path d="M3 12C3 4.5885 4.5885 3 12 3C19.4115 3 21 4.5885 21 12C21 19.4115 19.4115 21 12 21C4.5885 21 3 19.4115 3 12Z" stroke="#323232" stroke-width="2"></path> </g></svg>
                                                <!--begin::Tags-->
                                                <label class="form-label">لطفا برای ثبت قیمت بر روی کالا، ابتدا از بخش <a href="{{route('vendor.all.outlet')}}">مدیریت آدرس ها</a> حداقل یک آدرس اضافه نمایید.</label>
                                                <!--end::Tags-->
                                            </div>

                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="fv-row">
                                                    
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::کارت header-->
                                        </div>
                                    @endif
                                    <!--end::ثبت نقاط مرتبط با محصول-->
                                </div>
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::Inventory-->
                                    <div class="card card-flush py-4">
                                        <!--begin::کارت header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>موجودی</h2>
                                            </div>
                                        </div>
                                        <!--end::کارت header-->
                                        <!--begin::کارت body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Tags-->
                                                <label class="form-label">کد محصول</label>
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <input type="text" name="product_code" class="form-control mb-2" placeholder="کد محصول را وارد کنید" value="{{$products->product_code}}" />
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">کد محصول را وارد کنید</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Tags-->
                                                <label class="form-label">بارکد</label>
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <input type="text" name="sku" class="form-control mb-2" placeholder="شماره بارکد" value="" />
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">شماره بارکد را وارد کنید</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Tags-->
                                                <label class="form-label">تعداد</label>
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <div class="d-flex gap-3">
                                                    <input type="number" name="product_qty" class="form-control mb-2" placeholder="موجودی انبار" value="{{$products->product_qty}}" />
                                                </div>
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">مقدار محصول را وارد کنید</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Tags-->
                                                <label class="form-label">
                                                به مشتریان اجازه دهید محصولاتی را خریداری کنند که موجودی آنها تمام شده است؟
                                                </label>
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <div class="form-check form-check-custom form-check-solid mb-2">
                                                    <input class="form-check-input" type="checkbox" name="unlimitedStock" value="active" {{$products->unlimitedStock == 'active' ? 'checked' : ''}}/>
                                                    <label class="form-check-label">بله</label>
                                                </div>
                                                <!--end::Input-->
                                              
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::کارت header-->
                                    </div>
                                    <!--end::Inventory-->
                                    
                                    <!--begin::Meta options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::کارت header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2> تنظیمات متا</h2>
                                            </div>
                                        </div>
                                        <!--end::کارت header-->
                                        <!--begin::کارت body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Tags-->
                                                <label class="form-label">برچسب متا تایتل</label>
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control mb-2" name="meta_title" placeholder="نام متا تگ" value="{{old('meta_title') ? old('meta_title') : $products->meta_title}}"/>
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">یک عنوان متا تگ تنظیم کنید. توصیه می شود کلمات کلیدی ساده و دقیق باشند.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Tags-->
                                                <label class="form-label">توضیحات متا تگ</label>
                                                <!--end::Tags-->
                                                <!--begin::or-->
                                                <textarea class="form-control mb-2" name="meta_description" placeholder="توضیحات متا">{{old('meta_description') ? old('meta_description') : $products->meta_description}}</textarea>
                                                <!--end::or-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">برای افزایش رتبه سئو، توضیحات متا تگ را برای محصول تنظیم کنید.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div>
                                                <!--begin::Tags-->
                                                <label class="form-label">کلمات کلیدی</label>
                                                <!--end::Tags-->
                                                <!--begin::or-->
                                                <input id="kt_ecommerce_add_product_meta_keywords" name="meta_keywords" class="form-control mb-2" placeholder="قیمت میلگرد، قیمت سیمان، قیمت تیرآهن"  value="{{old('meta_keywords') ? old('meta_keywords') : $products->meta_keywords}}"/>
                                                <!--end::or-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">لیستی از کلمات کلیدی که محصول به آنها مرتبط است تنظیم کنید. کلمات کلیدی را با اضافه کردن ویرگول <code>،</code> مرتب کنید
                                                </div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::کارت header-->
                                    </div>
                                    <!--end::Meta options-->
                                </div>
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('vendor.all.product')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">انصراف</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">ذخیره تغییرات</span>
                                <span class="indicator-progress">لطفا صبر کنید...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    
</div>


<script src="{{asset('adminbackend/assets/js/categoryFilterProduct.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/loadAttributeAjaxVendor.js')}}"></script>

{{-- اسکریپت های مربوط به مدیریت حمل --}}
<script src="{{asset('adminbackend/assets/js/vendorHasVehicleState.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/LoadFreightageLoaderTypeAjaxVendor.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/freightageRepeaterVendor.js')}}"></script>

{{-- اسکریپت های مربوط به ثبت موقعیت مکانی محصول --}}
<script src="{{asset('adminbackend/assets/js/vendorProductOutletForm.js')}}"></script>

@endsection