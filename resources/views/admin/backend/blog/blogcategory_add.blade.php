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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن دسته بندی مقالات</h1>
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
                        <li class="breadcrumb-item text-muted">افزودن دسته بندی مقالات</li>
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
                <form method="post" action="{{route('store.blog.category')}}" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 ">
                        <!--begin::عمومی options-->
                        <div class="card card-flush py-5">
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="required form-label">نام دسته بندی</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="text" name="blog_category_name" class="form-control mb-2" placeholder="نام دسته بندی مقاله" value="" />
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">نام دسته مورد نیاز است و توصیه می شود منحصر به فرد باشد.</div>
                                        <!--end::توضیحات-->
                                    </div>
                                    <!--end::Input group-->
                            </div>
                            <!--end::کارت header-->
                        </div>
                        <!--end::عمومی options-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('admin.blog.category')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">انصراف</a>
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