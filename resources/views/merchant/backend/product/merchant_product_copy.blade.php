@extends('merchant.merchant_dashboard')
@section('merchant')


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
                        <li class="breadcrumb-item text-muted">رونوشت محصول</li>
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
                <form class="form d-flex flex-column flex-lg-row" method="POST" action="{{route('merchant.storeCopy.product')}}" enctype="multipart/form-data">
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
                                        <input type="file" name="product_thumbnail" accept=".png, .jpg, .jpeg"/>
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
                                <select class="form-select mb-2" data-control="select2" name="product_status" data-hide-search="true" data-placeholder="انتخاب" id="kt_ecommerce_add_product_status_select">
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

                        <!--begin::دسته بندی & tags-->
                        <div class="card card-flush py-4">
                            <!--begin::کارت header-->

                            {{-- این رول برای اینه که چون فایل جاوا اسکریپت برای ایجکس یکسان است، باید مسیر کاربر کارشناس اول اش باشه که سیستم بتونه از طریق کنترلر کارشناس درخواست رو بگیره --}}
                            <input type="hidden" value="merchant" id="user-role">

                            {{-- این رول خود کاربر محصول است که از تابع کنترلر میاد میشینه و بعد میره روی ایجکس و مشخص میشه این رو آیا تامین کننده زده یا هر کسی --}}
                            <input type="hidden" value="merchant" id="product-user-role">

                            <div class="card-header">
                                <!--begin::کارت title-->
                                <div class="card-title required">
                                    <h2>انتخاب دسته بندی</h2>
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
                                            @include('merchant.body.layouts.merchant_product.edit-categories-group', ['categories' => $category[1]])
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
                        <!--begin::Template settings-->
                        
                        <!--end::Template settings-->
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
                                                <div class="text-muted fs-7">نام محصول مورد نیاز است و توصیه می شود منحصر به فرد باشد.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Tags-->
                                                <label class="required form-label">آدرس URL یا اسلاگ </label> (به عنوان مثال: steel-product)
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <input type="text" name="product_slug" class="form-control mb-2" placeholder="اسلاگ URL" value="{{$products->product_slug}}"/>
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">اسلاگ URL مورد نیاز است و توصیه می شود منحصر به فرد و انگلیسی باشد.</div>
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
                                    <!--begin::Media-->
                                    {{-- <div class="card card-flush py-4">
                                        <!--begin::کارت header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>رسانه</h2>
                                            </div>
                                        </div>
                                        <!--end::کارت header-->
                                        <!--begin::کارت body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-2">
                                                <!--begin::Dropzone-->
                                                <div class="dropzone" id="kt_ecommerce_add_product_media">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick">
                                                        <!--begin::Icon-->
                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Info-->
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">پرونده ها را اینجا رها کنید یا برای بارگذاری کلیک کنید.</h3>
                                                            <span class="fs-7 fw-semibold text-gray-400">اپلود فایل بیش از 10 تا</span>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Dropzone-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">گالری رسانه محصول را تنظیم کنید.</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::کارت header-->
                                    </div> --}}
                                    <!--end::Media-->
                                    <!--begin::قیمت گذاری-->
                                    <div class="card card-flush py-4">
                                        <!--begin::کارت header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>قیمت گذاری</h2>
                                            </div>
                                        </div>
                                        <!--end::کارت header-->
                                        <!--begin::کارت body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Tags-->
                                                <label class="required form-label">قیمت پایه بدون ارزش افزوده را وارد نمایید </label>
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <input type="text" name="selling_price" class="form-control mb-2" placeholder="قیمت محصول" value="{{$products->selling_price}}" />
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">قیمت محصول را وارد کنید</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            {{-- <div class="fv-row mb-10">
                                                <!--begin::Tags-->
                                                <label class="fs-6 fw-semibold mb-2">نوع تخفیف
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="انتخاب a discount type that will be applied to this product"></i></label>
                                                <!--End::Tags-->
                                                <!--begin::Row-->
                                                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                                    <!--begin::Col-->
                                                    <div class="col">
                                                        <!--begin::Option-->
                                                        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                                                            <!--begin::رادیو-->
                                                            <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                <input class="form-check-input" type="radio" name="discount_option" value="1" checked="checked" />
                                                            </span>
                                                            <!--end::رادیو-->
                                                            <!--begin::Info-->
                                                            <span class="ms-5">
                                                                <span class="fs-4 fw-bold text-gray-800 d-block">بدون تخفیف</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </label>
                                                        <!--end::Option-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col">
                                                        <!--begin::Option-->
                                                        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                                            <!--begin::رادیو-->
                                                            <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                <input class="form-check-input" type="radio" name="discount_option" value="2" />
                                                            </span>
                                                            <!--end::رادیو-->
                                                            <!--begin::Info-->
                                                            <span class="ms-5">
                                                                <span class="fs-4 fw-bold text-gray-800 d-block">درصدی</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </label>
                                                        <!--end::Option-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col">
                                                        <!--begin::Option-->
                                                        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                                            <!--begin::رادیو-->
                                                            <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                <input class="form-check-input" type="radio" name="discount_option" value="3" />
                                                            </span>
                                                            <!--end::رادیو-->
                                                            <!--begin::Info-->
                                                            <span class="ms-5">
                                                                <span class="fs-4 fw-bold text-gray-800 d-block">قیمت ثابت</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </label>
                                                        <!--end::Option-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div> --}}
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            {{-- <div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_percentage">
                                                <!--begin::Tags-->
                                                <label class="form-label">درصد تخفیف را تنظیم کنید</label>
                                                <!--end::Tags-->
                                                <!--begin::Slider-->
                                                <div class="d-flex flex-column text-center mb-5">
                                                    <div class="d-flex align-items-start justify-content-center mb-7">
                                                        <span class="fw-bold fs-3x" id="kt_ecommerce_add_product_discount_label">0</span>
                                                        <span class="fw-bold fs-4 mt-1 ms-2">%</span>
                                                    </div>
                                                    <div id="kt_ecommerce_add_product_discount_slider" class="noUi-sm"></div>
                                                </div>
                                                <!--end::Slider-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">درصد تخفیف را برای اعمال این محصول تعیین کنید.</div>
                                                <!--end::توضیحات-->
                                            </div> --}}
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            {{-- <div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_fixed">
                                                <!--begin::Tags-->
                                                <label class="form-label">ثابت قیمت با تخفیف</label>
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <input type="text" name="dicsounted_price" class="form-control mb-2" placeholder="قیمت تخفیف" />
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">قیمت محصول با تخفیف را تعیین کنید. محصول با قیمت ثابت تعیین شده کاهش می یابد</div>
                                                <!--end::توضیحات-->
                                            </div> --}}
                                            <!--end::Input group-->
                                            <!--begin::Tax-->
                                            {{-- <div class="d-flex flex-wrap gap-5">
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Tags-->
                                                    <label class="required form-label">کلاس مالیات</label>
                                                    <!--end::Tags-->
                                                    <!--begin::انتخاب2-->
                                                    <select class="form-select mb-2" name="tax" data-control="select2" data-hide-search="true" data-placeholder="انتخاب ">
                                                        <option></option>
                                                        <option value="0">Tax رایگان</option>
                                                        <option value="1">Taxable Goods</option>
                                                        <option value="2">دانلودable محصولات</option>
                                                    </select>
                                                    <!--end::انتخاب2-->
                                                    <!--begin::توضیحات-->
                                                    <div class="text-muted fs-7">طبقه مالیات محصول را تنظیم کنید.</div>
                                                    <!--end::توضیحات-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Tags-->
                                                    <label class="form-label">مقدار (%)</label>
                                                    <!--end::Tags-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control mb-2" value="" />
                                                    <!--end::Input-->
                                                    <!--begin::توضیحات-->
                                                    <div class="text-muted fs-7">مالیات بر ارزش افزوده محصول را تنظیم کنید.</div>
                                                    <!--end::توضیحات-->
                                                </div>
                                                <!--end::Input group-->
                                            </div> --}}
                                            <!--end:Tax-->
                                        </div>
                                        <!--end::کارت header-->
                                    </div>
                                    <!--end::قیمت گذاری-->
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
                                    <!--begin::Variations-->
                                    {{-- <div class="card card-flush py-4">
                                        <!--begin::کارت header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>متغیرها</h2>
                                            </div>
                                        </div>
                                        <!--end::کارت header-->
                                        <!--begin::کارت body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                                <!--begin::Tags-->
                                                <label class="form-label">افزودن محصول متغیرها</label>
                                                <!--end::Tags-->
                                                <!--begin::Repeater-->
                                                <div id="kt_ecommerce_add_product_options">
                                                    <!--begin::Form group-->
                                                    <div class="form-group">
                                                        <div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3">
                                                            <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
                                                                <!--begin::انتخاب2-->
                                                                <div class="w-100 w-md-200px">
                                                                    <select class="form-select" name="product_option" data-placeholder="یک متغییر انتخاب کنبد" data-kt-ecommerce-catalog-add-product="product_option">
                                                                        <option></option>
                                                                        <option value="color">Color</option>
                                                                        <option value="size">Size</option>
                                                                        <option value="material">Material</option>
                                                                        <option value="style">Style</option>
                                                                    </select>
                                                                </div>
                                                                <!--end::انتخاب2-->
                                                                <!--begin::Input-->
                                                                <input type="text" class="form-control mw-100 w-200px" name="product_option_value" placeholder="متغیر" />
                                                                <!--end::Input-->
                                                                <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                                                    <span class="svg-icon svg-icon-1">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                                                            <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Form group-->
                                                    <!--begin::Form group-->
                                                    <div class="form-group mt-5">
                                                        <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                                <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Add another variation</button>
                                                    </div>
                                                    <!--end::Form group-->
                                                </div>
                                                <!--end::Repeater-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::کارت header-->
                                    </div> --}}
                                    <!--end::Variations-->
                                    <!--begin::حمل دریایی-->
                                    {{-- <div class="card card-flush py-4">
                                        <!--begin::کارت header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>حمل دریایی</h2>
                                            </div>
                                        </div>
                                        <!--end::کارت header-->
                                        <!--begin::کارت body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Input-->
                                                <div class="form-check form-check-custom form-check-solid mb-2">
                                                    <input class="form-check-input" type="checkbox" id="kt_ecommerce_add_product_shipping_checkbox" value="1" />
                                                    <label class="form-check-label">این محصول فیزیکی می باشد</label>
                                                </div>
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">تنظیم کنید که آیا محصول یک کالای فیزیکی یا دیجیتالی است. محصولات فیزیکی ممکن است نیاز به حمل و نقل داشته باشند.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::حمل دریایی form-->
                                            <div id="kt_ecommerce_add_product_shipping" class="d-none mt-10">
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Tags-->
                                                    <label class="form-label">وزن</label>
                                                    <!--end::Tags-->
                                                    <!--begin::or-->
                                                    <input type="text" name="weight" class="form-control mb-2" placeholder="محصولات weight" value="" />
                                                    <!--end::or-->
                                                    <!--begin::توضیحات-->
                                                    <div class="text-muted fs-7">وزن محصول را بر حسب کیلوگرم (کیلوگرم) تنظیم کنید.</div>
                                                    <!--end::توضیحات-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row">
                                                    <!--begin::Tags-->
                                                    <label class="form-label">ابعاد</label>
                                                    <!--end::Tags-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                                                        <input type="number" name="width" class="form-control mb-2" placeholder="Width (w)" value="" />
                                                        <input type="number" name="height" class="form-control mb-2" placeholder="Height (h)" value="" />
                                                        <input type="number" name="length" class="form-control mb-2" placeholder="Lengtn (l)" value="" />
                                                    </div>
                                                    <!--end::Input-->
                                                    <!--begin::توضیحات-->
                                                    <div class="text-muted fs-7">ابعاد محصول را به سانتی متر (سانتی متر) وارد کنید.</div>
                                                    <!--end::توضیحات-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::حمل دریایی form-->
                                        </div>
                                        <!--end::کارت header-->
                                    </div> --}}
                                    <!--end::حمل دریایی-->
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
                            <a href="{{route('merchant.all.product')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">انصراف</a>
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


<!--begin::Vendors Javascript(used for this page only)-->
{{-- <script src="{{asset('adminbackend/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script> --}}
<!--end::Vendors Javascript-->
<!--begin::سفارشی Javascript(used for this page only)-->
{{-- <script src="{{asset('adminbackend/assets/js/custom/apps/ecommerce/catalog/save-product.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.js')}}"></script> --}}
<!--end::سفارشی Javascript-->

<script src="{{asset('adminbackend/assets/js/categoryFilterProduct.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/loadAttributeAjaxVendor.js')}}"></script>

@endsection