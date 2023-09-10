@extends('editor.editor_dashboard')
@section('editor')

<!--begin:: TinyMCE-->
<script type="text/javascript">
        tinymce.init({
            selector: '#post_short_description',
            plugins: "directionality image link table media lists",
            toolbar: "undo redo | styleselect | bold italic underline | link image alignleft aligncenter alignright ltr rtl numlist bullist | fontsize",
            directionality: "rtl",
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
        });
        tinymce.init({
            selector: '#post_long_description',
            plugins: "directionality image link table media lists",
            toolbar: "undo redo | styleselect | bold italic underline | link image alignleft aligncenter alignright ltr rtl numlist bullist| fontsize",
            directionality: "rtl",
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
        });
</script>
<!--end:: TinyMCE-->

<!--begin:: Javascript(SELECT2 search module)-->
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/select2.min.js')}}"></script>
<!--end:: Javascript-->

<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن مقاله</h1>
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
                        <li class="breadcrumb-item text-muted">افزودن مقاله</li>
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
                <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
                    <h4 class="alert-title" style="color:#ffa800">
                        <i class="w-icon-exclamation-triangle"></i>هشدار!</h4>
                        {{$error}}
                </div>
            @endforeach

            @if(session()->has('error'))
                <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5  mt-5 mb-5">
                    <h4 class="alert-title" style="color:#ffa800">
                        <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                        {{session('error')}}
                </div>
            @endif
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Form-->
                <form class="form d-flex flex-column flex-lg-row" method="POST" action="{{route('editor.store.blog.post')}}" enctype="multipart/form-data">
                    @csrf
                    <!--begin::کناری column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::کارت header-->
                            <div class="card-header">
                                <!--begin::کارت title-->
                                <div class="card-title">
                                    <h2>تصویر شاخص</h2>
                                </div>
                                <!--end::کارت title-->
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <!--begin::Image input placeholder-->
                                <style>.image-input-placeholder { background-image: url({{asset('storage/upload/no_image_product.jpg')}}); } [data-theme="dark"] .image-input-placeholder { background-image: url({{asset('storage/upload/no_image_product.jpg')}}); }</style>
                                <!--end::Image input placeholder-->
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <!--begin::نمایش existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::نمایش existing avatar-->
                                    <!--begin::Tags-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض آواتار">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="post_image" accept=".png, .jpg, .jpeg" />
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
                                <div class="text-muted fs-7">تصویر بندانگشتی مقاله را تنظیم کنید. فقط فایل های تصویری *.png، *.jpg و *.jpeg پذیرفته می شوند</div>
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
                                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_status"></div>
                                </div>
                                <!--begin::کارت toolbar-->
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                <!--begin::انتخاب2-->
                                <select class="form-select mb-2" data-control="select2" name="status" data-hide-search="true" data-placeholder="انتخاب" id="kt_ecommerce_add_status_select">
                                    <option></option>
                                    <option value="active" selected="selected">منتشر شده</option>
                                    <option value="disabled">در حال بازبینی</option>
                                </select>
                                <!--end::انتخاب2-->
                                <!--begin::توضیحات-->
                                <div class="text-muted fs-7">وضعیت انتشار مقاله را تنظیم کنید.</div>
                                <!--end::توضیحات-->
                                <!--begin::تاریخpicker-->
                                <div class="d-none mt-10">
                                    <label for="kt_ecommerce_add_status_datepicker" class="form-label">انتخاب publishing date و time</label>
                                    <input class="form-control" id="kt_ecommerce_add_status_datepicker" placeholder="انتخاب تاریخ & time" />
                                </div>
                                <!--end::تاریخpicker-->
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::وضعیت-->
                        <!--begin::دسته بندی & tags-->
                        <div class="card card-flush py-4">
                            <!--begin::کارت header-->
                            <div class="card-header">
                                <!--begin::کارت title-->
                                <div class="card-title">
                                    <h2>دسته بندی مقاله</h2>
                                </div>
                                <!--end::کارت title-->
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                <div>
                                    <!--begin::Input group-->
                                    <!--begin::انتخاب2-->
                                        <select class="js-example-basic-single form-control" name="category_id">
                                            {{-- @if($selected_category)
                                                <option value="0">دسته اصلی</option>
                                                <option value="{{$selected_category->id}}" selected>{{$selected_category->category_name}}</option>
                                            @else
                                                <option value="0">دسته اصلی</option>    
                                            @endif --}}
                                            
                                            {{-- @foreach ($nonselected_category_array as $key => $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>   
                                            @endforeach --}}
                                            
                                            <option value="0">بدون دسته بندی</option>
                                            @foreach ($blogcategories as $blogcategory)
                                                <option value="{{$blogcategory->id}}">{{$blogcategory->blog_category_name}}</option>
                                            @endforeach
                                        </select>
                                    <!--end::انتخاب2-->
                                <!--begin::توضیحات-->
                                <div class="text-muted fs-7 mb-7">مقاله را به یک دسته اضافه کنید.</div>
                                <!--end::توضیحات-->
                                <!--end::Input group-->
                                <!--begin::Button-->
                                <a href="{{route('add.blog.category')}}" class="btn btn-light-primary btn-sm mb-10">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->ایجاد دسته بندی جدید</a>
                                <!--end::Button-->
                                </div>
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::دسته بندی & tags-->
                    </div>
                    <!--end::کناری column-->
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">عمومی</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">پیشرفته</a>
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
                                                <label class="required form-label">عنوان مقاله</label>
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <input type="text" name="post_title" class="form-control mb-2" placeholder="عنوان مقاله" value="{{old('post_title')}}"/>
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">عنوان مقاله مورد نیاز است و توصیه می شود منحصر به فرد باشد.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                             <div class="mb-10 fv-row">
                                                <!--begin::Tags-->
                                                <label class="required form-label">آدرس URL یا اسلاگ </label> (به عنوان مثال: rebar-companies)
                                                <!--end::Tags-->
                                                <!--begin::Input-->
                                                <input type="text" name="post_slug" class="form-control mb-2" placeholder="اسلاگ URL" value="{{old('post_slug')}}"/>
                                                <!--end::Input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">اسلاگ URL مورد نیاز است و توصیه می شود منحصر به فرد و انگلیسی باشد.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div>
                                                <!--begin::Tags-->
                                                <label class="form-label">خلاصه مقاله</label>
                                                <!--end::Tags-->
                                                <!--begin::or-->
                                                <textarea name="post_short_description" id="post_short_description">{{old('post_short_description')}}</textarea>
                                                <!--end::or-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">برای دید بهتر، توضیحاتی را برای مقاله تنظیم کنید.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mt-10">
                                                <!--begin::Tags-->
                                                <label class="form-label">مقاله کامل</label>
                                                <!--end::Tags-->
                                                <!--begin::or-->
                                                    <textarea name="post_long_description" id="post_long_description">{{old('post_long_description')}}</textarea>
                                                <!--end::or-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">برای دید بهتر، توضیحاتی را برای مقاله تنظیم کنید.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::کارت header-->
                                    </div>
                                    <!--end::عمومی options-->
                                </div>
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">

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
                                                <input type="text" class="form-control mb-2" name="meta_title" placeholder="نام متا تگ" value="{{old('meta_title')}}"/>
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
                                                    <textarea class="form-control mb-2" name="meta_description" placeholder="توضیحات متا">{{old('meta_description')}}</textarea>
                                                <!--end::or-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">برای افزایش رتبه سئو، توضیحات متا تگ را برای مقاله تنظیم کنید.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div>
                                                <!--begin::Tags-->
                                                <label class="form-label">کلمات کلیدی</label>
                                                <!--end::Tags-->
                                                <!--begin::or-->
                                                <input id="kt_ecommerce_add_product_meta_keywords" name="meta_keywords" class="form-control mb-2" placeholder="انواع میلگرد، نحوه تولید سیمان، تیرآهن لانه زنبوری" value="{{old('meta_keywords')}}"/>
                                                <!--end::or-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">لیستی از کلمات کلیدی که مقاله به آنها مرتبط است تنظیم کنید. کلمات کلیدی را با اضافه کردن ویرگول <code>،</code> مرتب کنید
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
                            <a href="{{route('editor.blog.post')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">انصراف</a>
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
    <script src="{{asset('adminbackend/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::سفارشی Javascript(used for this page only)-->
    <script src="{{asset('adminbackend/assets/js/custom/apps/ecommerce/catalog/save-product.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.js')}}"></script>
    <!--end::سفارشی Javascript-->

@endsection