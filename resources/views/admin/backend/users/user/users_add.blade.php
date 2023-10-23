@extends('admin.admin_dashboard')
@section('admin')


<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    @if(session()->has('success'))
        <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5  mt-5 mb-5">
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
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن کاربر </h1>
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
                        <li class="breadcrumb-item text-muted">مدیریت کاربران </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">افزودن کاربر</li>
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
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::کارت-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::کارت header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                        <!--begin::کارت title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">مشخصات کاربر</h3>
                        </div>
                        <!--end::کارت title-->
                    </div>
                    <!--begin::کارت header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form class="form" method="POST" action={{route('admin.users.store')}}>
                            @csrf
                            <input type="hidden" name='user_id' value="">
                            <!--begin::کارت body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="firstname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام کاربر را وارد نمایید" value="{{old('firstname')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام خانوادگی</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="lastname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام خانوادگی کاربر را وارد نمایید" value="{{old('lastname')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام کاربری</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="username" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام کاربری را وارد نمایید" value="{{old('username')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">ایمیل</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="email" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="email@example.com" value="{{old('email')}}" autocomplete="off" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">کلمه عبور</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="password" name="password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="کلمه عبور" value="password" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                
                                 <!--begin::Input group-->
                                 <div id="specialist_category_id" class="fv-row mb-7 fv-plugins-icon-container ">
                                    <!--begin::Tags-->
                                    <label class="required fw-semibold fs-6 mb-2">تعیین دسته بندی کارشناس</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <select class="form-control" name="specialist_category_id">
                                            <option value=0>بدون دسته بندی</option>
                                        @foreach ($categories as $key => $category)
                                            <option {{old('specialist_category_id') == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <div class="separator separator-dashed my-5"></div>

                                <!--begin::Input group-->
                                <div class="mb-7 mt-10">
                                    <!--begin::Tags-->
                                    <label class="required fw-semibold fs-6 mb-5">سطح دسترسی</label>
                                    <!--end::Tags-->
                                    <!--begin::سطح دسترسی-->
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::رادیو-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="role" type="radio" value="admin" id="kt_modal_update_role_option_0" >
                                            <!--end::Input-->
                                            <!--begin::Tags-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                <div class="fw-bold text-gray-800">مدیریت</div>
                                                <div class="text-gray-600"> برای مدیران شرکت</div>
                                            </label>
                                            <!--end::Tags-->
                                        </div>
                                        <!--end::رادیو-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::رادیو-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="role" type="radio" value="editor" id="kt_modal_update_role_option_1" >
                                            <!--end::Input-->
                                            <!--begin::Tags-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                <div class="fw-bold text-gray-800">نویسنده</div>
                                                <div class="text-gray-600">برای ایجاد کاربر نویسنده که دسترسی به بخش مقالات دارد</div>
                                            </label>
                                            <!--end::Tags-->
                                        </div>
                                        <!--end::رادیو-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::رادیو-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="role" type="radio" value="vendor" id="kt_modal_update_role_option_2" >
                                            <!--end::Input-->
                                            <!--begin::Tags-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_2">
                                                <div class="fw-bold text-gray-800">تأمین کننده</div>
                                                <div class="text-gray-600">برای ایجاد کاربر تأمین کننده که می تواند محصول منتشر و به فروش برساند</div>
                                            </label>
                                            <!--end::Tags-->
                                        </div>
                                        <!--end::رادیو-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::رادیو-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="role" type="radio" value="specialist" id="kt_modal_update_role_option_3" >
                                            <!--end::Input-->
                                            <!--begin::Tags-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_3">
                                                <div class="fw-bold text-gray-800">کارشناس فنی محصول</div>
                                                <div class="text-gray-600">برای ایجاد کاربر کارشناس که می تواند پاسخگوی کاربران پلتفرم باشد</div>
                                            </label>
                                            <!--end::Tags-->
                                        </div>
                                        <!--end::رادیو-->
                                    </div>
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::رادیو-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="role" type="radio" value="financial" id="kt_modal_update_role_option_4" >
                                            <!--end::Input-->
                                            <!--begin::Tags-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_4">
                                                <div class="fw-bold text-gray-800">کارشناس مالی</div>
                                                <div class="text-gray-600">برای ایجاد کارشناس امور مالی برای بررسی و تایید پرداخت ها</div>
                                            </label>
                                            <!--end::Tags-->
                                        </div>
                                        <!--end::رادیو-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::رادیو-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="role" type="radio" value="merchant" id="kt_modal_update_role_option_5" >
                                            <!--end::Input-->
                                            <!--begin::Tags-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_5">
                                                <div class="fw-bold text-gray-800">بازرگان</div>
                                                <div class="text-gray-600">بازرگان می تواند اقدام به ایجاد محصول و فعالیت به عنوان وارد یا صادر کننده نماید</div>
                                            </label>
                                            <!--end::Tags-->
                                        </div>
                                        <!--end::رادیو-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::رادیو-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="role" type="radio" value="retailer" id="kt_modal_update_role_option_6" >
                                            <!--end::Input-->
                                            <!--begin::Tags-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_6">
                                                <div class="fw-bold text-gray-800">خرده فروش</div>
                                                <div class="text-gray-600">می تواند اقدام به ایجاد محصول و فعالیت به عنوان خرده فروش نماید</div>
                                            </label>
                                            <!--end::Tags-->
                                        </div>
                                        <!--end::رادیو-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::رادیو-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="role" type="radio" value="freightage" id="kt_modal_update_role_option_7" >
                                            <!--end::Input-->
                                            <!--begin::Tags-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_7">
                                                <div class="fw-bold text-gray-800">باربری</div>
                                                <div class="text-gray-600">کاربر باربری میتواند در زمینه حمل کالا فعالیت نماید.</div>
                                            </label>
                                            <!--end::Tags-->
                                        </div>
                                        <!--end::رادیو-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::رادیو-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="role" type="radio" value="driver" id="kt_modal_update_role_option_8" >
                                            <!--end::Input-->
                                            <!--begin::Tags-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_8">
                                                <div class="fw-bold text-gray-800">راننده</div>
                                                <div class="text-gray-600">کاربر راننده میتواند در زمینه حمل کالا فعالیت نماید.</div>
                                            </label>
                                            <!--end::Tags-->
                                        </div>
                                        <!--end::رادیو-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::رادیو-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="role" type="radio" value="user" id="kt_modal_update_role_option_9" checked="checked">
                                            <!--end::Input-->
                                            <!--begin::Tags-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_9">
                                                <div class="fw-bold text-gray-800">کاربر عادی</div>
                                                <div class="text-gray-600">برای کاربر عادی</div>
                                            </label>
                                            <!--end::Tags-->
                                        </div>
                                        <!--end::رادیو-->
                                    </div>
                                    <!--end::Input row-->
                                   
                                    <!--end::سطح دسترسی-->
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::کارت body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{route('admin.users')}}" class="btn btn-light me-3">لغو</a>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره تغییرات</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::کارت-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    </div>

    <!--begin::سفارشی Javascript(used for this page only)-->
    {{-- <script src="{{asset('adminbackend/assets/js/custom/apps/ecommerce/catalog/محصولات.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('adminbackend/assets/s/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.js')}}"></script> --}}
    <!--end::سفارشی Javascript-->

    <script>
        $('#specialist_category_id').hide();   
        $(document).on("change", ".form-check-input", function (e) {
            if(e.target.value == 'specialist') {
                $('#specialist_category_id').slideDown();
            } else {
                $('#specialist_category_id').slideUp();
            }
        });

        
    </script>

@endsection