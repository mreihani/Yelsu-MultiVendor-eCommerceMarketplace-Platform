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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"><a href="{{route('all.category')}}">مقالات</a></h1>
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
                        <li class="breadcrumb-item text-muted">مقالات</li>
                        <!--end::آیتم-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
 
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            @if(session()->has('success'))
                <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action me-5 ms-5">
                    <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
                </div>
            @endif
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::دسته بندی-->
                <div class="card card-flush">
                    <!--begin::کارت header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::کارت title-->
                        <div class="card-title">
                            <!--begin::جستجو-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="جستجو مقاله" />
                            </div>
                            <!--end::جستجو-->
                        </div>
                        <!--end::کارت title-->
                        <!--begin::کارت toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Add customer-->
                            <a href="{{route('add.blog.post')}}" class="btn btn-primary">افزودن مقاله</a>
                            <!--end::Add customer-->
                        </div>
                        <!--end::کارت toolbar-->
                    </div>
                    <!--end::کارت header-->
                    <!--begin::کارت body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-250px">عنوان مقاله</th>
                                    <th class="min-w-250px">نام نویسنده</th>
                                    <th class="min-w-150px">دسته بندی مقاله</th>
                                    <th class="min-w-150px text-center">وضعیت انتشار</th>
                                    <th class="text-end min-w-70px">عملیات</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($blogposts as $blogpost)
                                <!--begin::Table row Parent-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <!--end::Checkbox-->
                                    <!--begin::دسته بندی=-->
                                    <td>
                                        <div class="d-flex">
                                            <!--begin::Thumbnail-->
                                            <a href="{{route('home.blog.single',$blogpost->post_slug)}}" class="symbol symbol-50px">
                                                <span class="symbol-label" style="background-image:url({{!empty($blogpost->post_image) ? url($blogpost->post_image) : url(asset('storage/upload/no_image_product.jpg'))}});"></span>
                                            </a>
                                            <!--end::Thumbnail-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="{{route('home.blog.single',$blogpost->post_slug)}}" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="post_title">{{$blogpost->post_title}}</a>
                                                <!--end::Title-->
                                                <!--begin::توضیحات-->
                                                <a href="{{route('home.blog.single',$blogpost->post_slug)}}" class="text-gray-800 text-hover-primary fs-5 fw-bold" style="color:#bfbfbf !important" data-kt-ecommerce-product-filter="product_name"><div class="text-muted fs-7 fw-bold">{!! Str::limit((strip_tags($blogpost->post_short_description)), 50, $end='...') !!}</div></a>
                                                <!--end::توضیحات-->
                                            </div>
                                        </div>
                                    </td>
                                    <!--end::دسته بندی=-->

                                    <!--begin:: نام نویسنده =-->
                                     <td>
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success"><a href="">{{$blogpost->bloguser->firstname .' '. $blogpost->bloguser->lastname}}</a></div>
                                        <!--end::Badges-->
                                    </td>
                                    <!--end:: نام نویسنده =-->
                                    
                                    <!--begin::دسته بندی اصلی=-->
                                    <td>
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success"><a href="{{!empty($blogpost->blogcategory->id) ? route('blog.category', $blogpost->blogcategory->id) : ""}}">{{!empty($blogpost->blogcategory->blog_category_name) ? $blogpost->blogcategory->blog_category_name : ""}}</a></div>
                                        <!--end::Badges-->
                                    </td>
                                    <!--end::دسته بندی اصلی=-->

                                    <!--begin:: وضعیت انتشار =-->
                                    @if($blogpost->status !== 'active')
                                        <td class="text-center pe-0" data-order="در حال بازبینی">
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-warning">در حال بازبینی</div>
                                            <!--end::Badges-->
                                        </td>
                                    @else
                                        <td class="text-center pe-0" data-order="منتشر شده">
                                            <!--begin::Badges-->
                                            <div class="badge badge-success">منتشر شده</div>
                                            <!--end::Badges-->
                                        </td>
                                    @endif
                                    <!--end:: وضعیت انتشار =-->

                                    <!--begin::عملیات=-->
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">عملیات
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-5 m-0">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{route('edit.blog.post', $blogpost->id)}}" class="menu-link px-3">ویرایش</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{route('delete.blog.post', $blogpost->id)}}" class="menu-link px-3" onclick ="return confirm('آیا برای انجام این کار اطمینان دارید؟')">حذف</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::عملیات=-->
                                </tr>
                                <!--end::Table row Parent-->
                                
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::کارت body-->
                </div>
                <!--end::دسته بندی-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    
</div>

    <!--begin::سفارشی Javascript(used for this page only)-->
    <script src="{{asset('adminbackend/assets/js/custom/apps/ecommerce/catalog/categories.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.j')}}s"></script>
    <!--end::سفارشی Javascript-->

@endsection