@extends('admin.admin_dashboard')
@section('admin')

<!--begin:: (SELECT2 search module)-->
<!--begin:: CSS(SELECT2 search module)-->
<link href="{{asset('adminbackend/assets/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!--end:: CSS-->

<!--begin:: Javascript(SELECT2 search module)-->
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/select2.min.js')}}"></script>
<!--end:: Javascript-->

<!--begin:: SELECT2-->
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<!--end:: SELECT2-->

<!--begin:: TinyMCE-->
<script type="text/javascript">
    tinymce.init({
        selector: '#category_description',
        plugins: "directionality image link table media lists",
        toolbar: "undo redo | styleselect | bold italic underline | link image alignleft aligncenter alignright ltr rtl numlist bullist | fontsizeinput | forecolor backcolor",
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن دسته بندی</h1>
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
                        <li class="breadcrumb-item text-muted">افزودن دسته بندی</li>
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
            <div id="kt_app_content_container" class="app-container container-xxl">
                <form method="post" action="{{route('store.category')}}" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
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
                                <style>.image-input-placeholder { background-image: url({{asset('storage/upload/no_image_product.jpg')}}); } [data-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
                                <!--end::Image input placeholder-->
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <!--begin::نمایش existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::نمایش existing avatar-->
                                    <!--begin::Tags-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض آواتار">
                                        <!--begin::Icon-->
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--end::Icon-->
                                        <!--begin::Inputs-->
                                        <input type="file" name="category_image" accept=".png, .jpg, .jpeg" />
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
                                <div class="text-muted fs-7">تصویر کوچک دسته را تنظیم کنید. فقط فایل های تصویری *.png، *.jpg و *.jpeg پذیرفته می شوند</div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::Thumbnail settings-->
                        <!--begin::وضعیت-->
                        
                        <!--end::وضعیت-->
                        
                    </div>
                    <!--end::کناری column-->
                    <!--begin::Main column-->

                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
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
                                        <label class="required form-label">نام دسته بندی</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="text" name="category_name" class="form-control mb-2" placeholder="نام دسته بندی محصول" value="" />
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">نام دسته مورد نیاز است و توصیه می شود منحصر به فرد باشد.</div>
                                        <!--end::توضیحات-->
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="required form-label">توضیحات دسته بندی</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <textarea name="category_description" id="category_description">{{old('category_description')}}</textarea>
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">برای مشاهده بهتر، یک توضیح برای دسته تنظیم کنید.</div>
                                        <!--end::توضیحات-->
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="required form-label">تعیین دسته مادر </label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <select class="js-example-basic-single form-control" name="parent">
                                                <option value="0">دسته اصلی</option>
                                            @foreach ($categories as $key => $category)
                                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                            </div>
                            <!--end::کارت header-->
                        </div>
                        <!--end::عمومی options-->
                        <!--begin::Meta options-->
                        
                        <!--end::Meta options-->
                        
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('all.category')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">انصراف</a>
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


<!--begin::سفارشی Javascript(used for this page only)-->
<script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.js')}}"></script>
<!--end::سفارشی Javascript-->



@endsection