@extends('specialist.specialist_dashboard')
@section('specialist')


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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">چت خصوصی</h1> 
                    
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
                        <li class="breadcrumb-item text-muted">چت</li>
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
                <!--begin::قالب بندی-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                        <!--begin::تماس با ما-->
                        <div class="card card-flush">
                            <!--begin::کارت header-->
                            <div class="card-header pt-7" id="kt_chat_contacts_header">
                                <!--begin::Form-->
                                <form class="w-100 position-relative" autocomplete="off">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid px-15" name="search" value="" placeholder="با نام کاربری یا ایمیل جستجو کنید ...">
                                    <!--end::Input-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            <div class="card-body pt-5" id="kt_chat_contacts_body">
                                <!--begin::لیست-->
                                <div id='chatListAutoFetch' class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px" style="max-height: 605px;">
                                    <!--begin::user-->
                                    @if(count($chatArr))
                                        @foreach ($chatArr as $chatItem)
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle">
                                                        <span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">{{mb_substr($chatItem->last()['otherUserObj']['lastname'], 0, 1, "UTF-8")}}</span>
                                                    </div>
                                                    
                                                    <!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-5">
                                                        <input type="hidden" value="{{$chatItem->last()['otherUserObj']['id']}}">
                                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2 userChatItem">{{$chatItem->last()['otherUserObj']['firstname'] . ' ' . $chatItem->last()['otherUserObj']['lastname']}}</a>
                                                        <div class="fw-semibold text-muted">{{$chatItem->last()['otherUserObj']['email']}}</div>
                                                        @if($chatItem->last()['otherUserObj']['home_phone'])
                                                        <div class="fw-semibold text-muted">{{$chatItem->last()['otherUserObj']['home_phone']}}</div>
                                                        @endif
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-7 mb-1">{{$chatItem->last()['latestTime']}}</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        @endforeach
                                    @else
                                        <h2 style="color:rgb(95, 95, 95);" class="text-center">هیچ پیامی یافت نشد!</h2>
                                    @endif
                                    <!--end::user-->
                                </div>
                                <!--end::لیست-->
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::تماس با ما-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                        <!--begin::Messenger-->
                        <div class="card" id="kt_chat_messenger">
                            <!--begin::کارت header-->
                            <div class="card-header" id="kt_chat_messenger_header">
                                <!--begin::Title-->
                                <div class="card-title">
                                    <!--begin::user-->
                                    <div class="d-flex justify-content-center flex-column me-3">
                                        <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1 otherUserName"></a>
                                        <!--begin::Info-->
                                        {{-- <div class="mb-0 lh-1">
                                            <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                                            <span class="fs-7 fw-semibold text-muted">فعال</span>
                                        </div> --}}
                                        <!--end::Info-->
                                    </div>
                                    <!--end::user-->
                                </div>
                                <!--end::Title-->
                                <!--begin::کارت toolbar-->
                                {{-- <div class="card-toolbar">
                                    <!--begin::Menu-->
                                    <div class="me-n3">
                                        <button class="btn btn-sm btn-icon btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="bi bi-three-dots fs-2"></i>
                                        </button>
                                        <!--begin::Menu 3-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                                            <!--begin::Heading-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">تماس با ما</div>
                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search"> افزودن تماس با ما</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link flex-stack px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">دعوت
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="یک ایمیل تماس برای ارسال دعوتنامه مشخص کنید" data-bs-original-title="یک ایمیل تماس برای ارسال دعوتنامه مشخص کنید" data-kt-initialized="1"></i></a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">گروه ها</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" data-bs-original-title="بزودی" data-kt-initialized="1">ساختن گروه</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" data-bs-original-title="بزودی" data-kt-initialized="1">دعوت اعضا</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" data-bs-original-title="بزودی" data-kt-initialized="1">تنظیمات</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3 my-1">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" data-bs-original-title="بزودی" data-kt-initialized="1">تنظیمات</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 3-->
                                    </div>
                                    <!--end::Menu-->
                                </div> --}}
                                <!--end::کارت toolbar-->
                            </div>
                            <!--end::کارت header-->
                            <!--begin::کارت body-->
                            
                            {{-- @if(count($chatArr)) --}}
                            <div id="startInfo" class="d-flex justify-content-center align-items-center" style="text-align:center; height:250px; margin-top:30px;">
                                <h2 style="color:rgb(95, 95, 95);">لطفا برای بارگذاری اطلاعات پیام از ستون سمت راست بر روی شخص مورد نظر کلیک کنید</h2>
                            </div>
                            <div class="card-body" id="kt_chat_messenger_body">
                                <!--begin::پیام ها-->
                                <div id="listMessages" class="scroll-y me-n5 pe-5 h-lg-auto chatBodyScroll" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px">
                                                           
                                </div>
                                <!--end::پیام ها-->
                            </div>
                            {{-- @endif --}}
                            <!--end::کارت body-->
                            <!--begin::کارت footer-->
                            <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                <!--begin::Input-->
                                <textarea id="inputMessage" class="form-control form-control-flush mb-3" rows="1" data-kt-element="input" placeholder="نوشتن پیام"></textarea>
                                <!--end::Input-->
                                <!--begin:Toolbar-->
                                <div class="d-flex flex-stack">
                                    
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center me-2">
                                        {{-- <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" aria-label="بزودی" data-bs-original-title="بزودی" data-kt-initialized="1">
                                            <i class="bi bi-paperclip fs-3"></i>
                                        </button> --}}
                                        {{-- <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" aria-label="بزودی" data-bs-original-title="بزودی" data-kt-initialized="1">
                                            <i class="bi bi-upload fs-3"></i>
                                        </button> --}}
                                    </div>
                                    <!--end::Actions-->
                                    <!--begin::ارسال-->
                                    <button id="inputMessageBtn" class="btn btn-primary" type="button" data-kt-element="send">ارسال</button>
                                    <!--end::ارسال-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::کارت footer-->
                        </div>
                        <!--end::Messenger-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::قالب بندی-->
                <!--begin::Modals-->
                <!--begin::Modal - نمایش users-->
                <div class="modal fade" id="kt_modal_view_users" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header pb-0 border-0 justify-content-end">
                                <!--begin::Close-->
                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--begin::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                                <!--begin::Heading-->
                                <div class="text-center mb-13">
                                    <!--begin::Title-->
                                    <h1 class="mb-3">مرور کاربران</h1>
                                    <!--end::Title-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fw-semibold fs-5">اگر به اطلاعات بیشتری نیاز دارید ، لطفاً این مورد را بررسی کنید 
                                    <a href="#" class="link-primary fw-bold">لیست کاربران</a>.</div>
                                    <!--end::توضیحات-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::users-->
                                <div class="mb-15">
                                    <!--begin::لیست-->
                                    <div class="mh-375px scroll-y me-n7 pe-7">
                                        <!--begin::user-->
                                        <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="">
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-6">
                                                    <!--begin::نام-->
                                                    <a href="#" class="d-flex align-items-center fs-5 fw-bold text-dark text-hover-primary">مرادی نیا
                                                    <span class="badge badge-light fs-8 fw-semibold ms-2">کارگردان هنری</span></a>
                                                    <!--end::نام-->
                                                    <!--begin::ایمیل-->
                                                    <div class="fw-semibold text-muted">smith@kpmg.com</div>
                                                    <!--end::ایمیل-->
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Stats-->
                                            <div class="d-flex">
                                                <!--begin::فروش-->
                                                <div class="text-end">
                                                    <div class="fs-5 fw-bold text-dark">$23,000</div>
                                                    <div class="fs-7 text-muted">فروش</div>
                                                </div>
                                                <!--end::فروش-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::user-->
                                        <!--begin::user-->
                                        <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-danger text-danger fw-semibold">M</span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-6">
                                                    <!--begin::نام-->
                                                    <a href="#" class="d-flex align-items-center fs-5 fw-bold text-dark text-hover-primary">میلاد مرادی
                                                    <span class="badge badge-light fs-8 fw-semibold ms-2">بازاریابی تحلیلی</span></a>
                                                    <!--end::نام-->
                                                    <!--begin::ایمیل-->
                                                    <div class="fw-semibold text-muted">melody@altbox.com</div>
                                                    <!--end::ایمیل-->
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Stats-->
                                            <div class="d-flex">
                                                <!--begin::فروش-->
                                                <div class="text-end">
                                                    <div class="fs-5 fw-bold text-dark">$50,500</div>
                                                    <div class="fs-7 text-muted">فروش</div>
                                                </div>
                                                <!--end::فروش-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::user-->
                                        <!--begin::user-->
                                        <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="">
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-6">
                                                    <!--begin::نام-->
                                                    <a href="#" class="d-flex align-items-center fs-5 fw-bold text-dark text-hover-primary">جلالی
                                                    <span class="badge badge-light fs-8 fw-semibold ms-2">مهندس نرم افزار</span></a>
                                                    <!--end::نام-->
                                                    <!--begin::ایمیل-->
                                                    <div class="fw-semibold text-muted">max@kt.com</div>
                                                    <!--end::ایمیل-->
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Stats-->
                                            <div class="d-flex">
                                                <!--begin::فروش-->
                                                <div class="text-end">
                                                    <div class="fs-5 fw-bold text-dark">$75,900</div>
                                                    <div class="fs-7 text-muted">فروش</div>
                                                </div>
                                                <!--end::فروش-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::user-->
                                        <!--begin::user-->
                                        <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="">
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-6">
                                                    <!--begin::نام-->
                                                    <a href="#" class="d-flex align-items-center fs-5 fw-bold text-dark text-hover-primary">محسن برومند
                                                    <span class="badge badge-light fs-8 fw-semibold ms-2">توسعه دهنده وب</span></a>
                                                    <!--end::نام-->
                                                    <!--begin::ایمیل-->
                                                    <div class="fw-semibold text-muted">sean@dellito.com</div>
                                                    <!--end::ایمیل-->
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Stats-->
                                            <div class="d-flex">
                                                <!--begin::فروش-->
                                                <div class="text-end">
                                                    <div class="fs-5 fw-bold text-dark">$10,500</div>
                                                    <div class="fs-7 text-muted">فروش</div>
                                                </div>
                                                <!--end::فروش-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::user-->
                                    </div>
                                    <!--end::لیست-->
                                </div>
                                <!--end::users-->
                                <!--begin::Notice-->
                                <div class="d-flex justify-content-between">
                                    <!--begin::Tags-->
                                    <div class="fw-semibold">
                                        <label class="fs-6">افزودن کاربران</label>
                                        <div class="fs-7 text-muted">اگر به اطلاعات بیشتری نیاز دارید ، لطفا برنامه ریزی بودجه را بررسی کنید</div>
                                    </div>
                                    <!--end::Tags-->
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" checked="checked">
                                        <span class="form-check-label fw-semibold text-muted">همه بدهکار هستیم</span>
                                    </label>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - نمایش users-->
                <!--begin::Modal - Users جستجو-->
                <div class="modal fade" id="kt_modal_users_search" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header pb-0 border-0 justify-content-end">
                                <!--begin::Close-->
                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--begin::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                                <!--begin::Content-->
                                <div class="text-center mb-13">
                                    <h1 class="mb-3">جستجو کاربران</h1>
                                    <div class="text-muted fw-semibold fs-5">همکاران را به حرفه خود دعوت کنید</div>
                                </div>
                                <!--end::Content-->
                                <!--begin::جستجو-->
                                <div id="kt_modal_users_search_hوler" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline">
                                    <!--begin::Form-->
                                    <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
                                        <!--begin::Hidden input(Added to disable form autocomplete)-->
                                        <input type="hidden">
                                        <!--end::Hidden input-->
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="با نام کاربری ، نام کامل یا ایمیل جستجو کنید ..." data-kt-search-element="input">
                                        <!--end::Input-->
                                        <!--begin::Spinner-->
                                        <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                                            <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                                        </span>
                                        <!--end::Spinner-->
                                        <!--begin::ریست-->
                                        <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <!--end::ریست-->
                                    </form>
                                    <!--end::Form-->
                                    <!--begin::Wrapper-->
                                    <div class="py-5">
                                        <!--begin::پیشنهادات-->
                                        <div data-kt-search-element="suggestions">
                                            <!--begin::Heading-->
                                            <h3 class="fw-semibold mb-5">اخیراً جستجو شده:</h3>
                                            <!--end::Heading-->
                                            <!--begin::users-->
                                            <div class="mh-375px scroll-y me-n7 pe-7">
                                                <!--begin::user-->
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle me-5">
                                                        <img alt="Pic" src="">
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold">
                                                        <span class="fs-6 text-gray-800 me-2">مرادی نیا</span>
                                                        <span class="badge badge-light">کارگردان هنری</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </a>
                                                <!--end::user-->
                                                <!--begin::user-->
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle me-5">
                                                        <span class="symbol-label bg-light-danger text-danger fw-semibold">M</span>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold">
                                                        <span class="fs-6 text-gray-800 me-2">میلاد مرادی</span>
                                                        <span class="badge badge-light">بازاریابی تحلیلی</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </a>
                                                <!--end::user-->
                                                <!--begin::user-->
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle me-5">
                                                        <img alt="Pic" src="">
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold">
                                                        <span class="fs-6 text-gray-800 me-2">جلالی</span>
                                                        <span class="badge badge-light">مهندس نرم افزار</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </a>
                                                <!--end::user-->
                                                <!--begin::user-->
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle me-5">
                                                        <img alt="Pic" src="">
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold">
                                                        <span class="fs-6 text-gray-800 me-2">محسن برومند</span>
                                                        <span class="badge badge-light">توسعه دهنده وب</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </a>
                                                <!--end::user-->
                                                <!--begin::user-->
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle me-5">
                                                        <img alt="Pic" src="">
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold">
                                                        <span class="fs-6 text-gray-800 me-2">احمد موسوی</span>
                                                        <span class="badge badge-light">طراح یو ای و یوایکس</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </a>
                                                <!--end::user-->
                                            </div>
                                            <!--end::users-->
                                        </div>
                                        <!--end::پیشنهادات-->
                                        <!--begin::Results(add d-none to below element to hide the کاربران list by default)-->
                                        <div data-kt-search-element="results" class="d-none">
                                            <!--begin::users-->
                                            <div class="mh-375px scroll-y me-n7 pe-7">
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="0">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='0']" value="0">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <img alt="Pic" src="">
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">مرادی نیا</a>
                                                            <div class="fw-semibold text-muted">smith@kpmg.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-10-848v" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2" selected="selected" data-select2-id="select2-data-12-ldy3">مدیر</option>
                                                            <option value="3">متفرقه</option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-11-2geu" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-um4l-container" aria-controls="select2-um4l-container"><span class="select2-selection__rendered" id="select2-um4l-container" role="textbox" aria-readonly="true" title="مدیر">مدیر</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="1">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='1']" value="1">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <span class="symbol-label bg-light-danger text-danger fw-semibold">M</span>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">میلاد مرادی</a>
                                                            <div class="fw-semibold text-muted">melody@altbox.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-13-w7p2" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1" selected="selected" data-select2-id="select2-data-15-5xcr">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3">متفرقه</option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-14-gq05" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-42fr-container" aria-controls="select2-42fr-container"><span class="select2-selection__rendered" id="select2-42fr-container" role="textbox" aria-readonly="true" title="مهمان">مهمان</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="2">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='2']" value="2">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <img alt="Pic" src="">
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">جلالی</a>
                                                            <div class="fw-semibold text-muted">max@kt.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-16-qbgb" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3" selected="selected" data-select2-id="select2-data-18-zf94">متفرقه </option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-17-dliv" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-18j8-container" aria-controls="select2-18j8-container"><span class="select2-selection__rendered" id="select2-18j8-container" role="textbox" aria-readonly="true" title="متفرقه ">متفرقه </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="3">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='3']" value="3">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <img alt="Pic" src="">
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">محسن برومند</a>
                                                            <div class="fw-semibold text-muted">sean@dellito.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-19-p21f" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2" selected="selected" data-select2-id="select2-data-21-an8l">مدیر</option>
                                                            <option value="3">متفرقه</option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-20-760u" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-jceq-container" aria-controls="select2-jceq-container"><span class="select2-selection__rendered" id="select2-jceq-container" role="textbox" aria-readonly="true" title="مدیر">مدیر</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="4">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='4']" value="4">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <img alt="Pic" src="">
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">احمد موسوی</a>
                                                            <div class="fw-semibold text-muted">brian@exchange.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-22-4fhk" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3" selected="selected" data-select2-id="select2-data-24-8wlt">متفرقه </option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-23-f341" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-fuey-container" aria-controls="select2-fuey-container"><span class="select2-selection__rendered" id="select2-fuey-container" role="textbox" aria-readonly="true" title="متفرقه ">متفرقه </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="5">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='5']" value="5">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <span class="symbol-label bg-light-warning text-warning fw-semibold">C</span>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">میکائیل کرمانی</a>
                                                            <div class="fw-semibold text-muted">mik@pex.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-25-7mns" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2" selected="selected" data-select2-id="select2-data-27-coo5">مدیر</option>
                                                            <option value="3">متفرقه</option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-26-ey5y" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-nnxf-container" aria-controls="select2-nnxf-container"><span class="select2-selection__rendered" id="select2-nnxf-container" role="textbox" aria-readonly="true" title="مدیر">مدیر</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="6">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='6']" value="6">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <img alt="Pic" src="">
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">محمد رصایی</a>
                                                            <div class="fw-semibold text-muted">f.mit@kpmg.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-28-n50j" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3" selected="selected" data-select2-id="select2-data-30-80dx">متفرقه </option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-29-ud4m" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-231g-container" aria-controls="select2-231g-container"><span class="select2-selection__rendered" id="select2-231g-container" role="textbox" aria-readonly="true" title="متفرقه ">متفرقه </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="7">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='7']" value="7">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <span class="symbol-label bg-light-danger text-danger fw-semibold">O</span>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">امید وحیدی</a>
                                                            <div class="fw-semibold text-muted">olivia@corpmail.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-31-7hkt" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2" selected="selected" data-select2-id="select2-data-33-64ar">مدیر</option>
                                                            <option value="3">متفرقه</option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-32-rjcr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-pno0-container" aria-controls="select2-pno0-container"><span class="select2-selection__rendered" id="select2-pno0-container" role="textbox" aria-readonly="true" title="مدیر">مدیر</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="8">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='8']" value="8">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <span class="symbol-label bg-light-primary text-primary fw-semibold">N</span>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">محسن برومند</a>
                                                            <div class="fw-semibold text-muted">owen.neil@gmail.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-34-2hfx" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1" selected="selected" data-select2-id="select2-data-36-le8g">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3">متفرقه</option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-35-6zfg" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-7kpe-container" aria-controls="select2-7kpe-container"><span class="select2-selection__rendered" id="select2-7kpe-container" role="textbox" aria-readonly="true" title="مهمان">مهمان</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="9">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='9']" value="9">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <img alt="Pic" src="">
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">علی کاربر</a>
                                                            <div class="fw-semibold text-muted">dam@consilting.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-37-n48z" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3" selected="selected" data-select2-id="select2-data-39-dkwr">متفرقه </option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-38-hnzg" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-dfah-container" aria-controls="select2-dfah-container"><span class="select2-selection__rendered" id="select2-dfah-container" role="textbox" aria-readonly="true" title="متفرقه ">متفرقه </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="10">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='10']" value="10">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <span class="symbol-label bg-light-danger text-danger fw-semibold">E</span>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">الهام بارانی</a>
                                                            <div class="fw-semibold text-muted">emma@intenso.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-40-fbr6" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2" selected="selected" data-select2-id="select2-data-42-9q5n">مدیر</option>
                                                            <option value="3">متفرقه</option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-41-xe7r" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-acyp-container" aria-controls="select2-acyp-container"><span class="select2-selection__rendered" id="select2-acyp-container" role="textbox" aria-readonly="true" title="مدیر">مدیر</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="11">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='11']" value="11">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <img alt="Pic" src="">
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">آنا کوهی</a>
                                                            <div class="fw-semibold text-muted">ana.cf@limtel.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-43-mxhb" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1" selected="selected" data-select2-id="select2-data-45-qzmh">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3">متفرقه</option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-44-mfat" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-22cy-container" aria-controls="select2-22cy-container"><span class="select2-selection__rendered" id="select2-22cy-container" role="textbox" aria-readonly="true" title="مهمان">مهمان</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="12">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='12']" value="12">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <span class="symbol-label bg-light-info text-info fw-semibold">A</span>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">رابرت دو</a>
                                                            <div class="fw-semibold text-muted">robert@benko.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-46-ccte" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3" selected="selected" data-select2-id="select2-data-48-x0x9">متفرقه </option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-47-f4gm" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-2pvl-container" aria-controls="select2-2pvl-container"><span class="select2-selection__rendered" id="select2-2pvl-container" role="textbox" aria-readonly="true" title="متفرقه ">متفرقه </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="13">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='13']" value="13">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <img alt="Pic" src="">
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">جواد مولای</a>
                                                            <div class="fw-semibold text-muted">miller@mapple.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-49-bqib" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3" selected="selected" data-select2-id="select2-data-51-rpr3">متفرقه </option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-50-q7l5" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-dka8-container" aria-controls="select2-dka8-container"><span class="select2-selection__rendered" id="select2-dka8-container" role="textbox" aria-readonly="true" title="متفرقه ">متفرقه </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="14">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='14']" value="14">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <span class="symbol-label bg-light-success text-success fw-semibold">L</span>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">لقمان کامرانی</a>
                                                            <div class="fw-semibold text-muted">lucy.m@fentech.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-52-t3f1" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2" selected="selected" data-select2-id="select2-data-54-mv4k">مدیر</option>
                                                            <option value="3">متفرقه</option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-53-pn0h" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-8x9c-container" aria-controls="select2-8x9c-container"><span class="select2-selection__rendered" id="select2-8x9c-container" role="textbox" aria-readonly="true" title="مدیر">مدیر</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="15">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='15']" value="15">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <img alt="Pic" src="">
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">احسان ورزقانی</a>
                                                            <div class="fw-semibold text-muted">ethan@loop.com.au</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-55-o0ex" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1" selected="selected" data-select2-id="select2-data-57-jio4">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3">متفرقه</option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-56-l4w3" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-l2to-container" aria-controls="select2-l2to-container"><span class="select2-selection__rendered" id="select2-l2to-container" role="textbox" aria-readonly="true" title="مهمان">مهمان</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                                <!--begin::Separator-->
                                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                                <!--end::Separator-->
                                                <!--begin::user-->
                                                <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="16">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='16']" value="16">
                                                        </label>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            <span class="symbol-label bg-light-danger text-danger fw-semibold">O</span>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-5">
                                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">امید وحیدی</a>
                                                            <div class="fw-semibold text-muted">olivia@corpmail.com</div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Access menu-->
                                                    <div class="ms-2 w-100px">
                                                        <select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-58-e4x7" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                            <option value="1">مهمان</option>
                                                            <option value="2">مدیر</option>
                                                            <option value="3" selected="selected" data-select2-id="select2-data-60-3n9o">متفرقه </option>
                                                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="rtl" data-select2-id="select2-data-59-dkqs" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-fj1i-container" aria-controls="select2-fj1i-container"><span class="select2-selection__rendered" id="select2-fj1i-container" role="textbox" aria-readonly="true" title="متفرقه ">متفرقه </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <!--end::Access menu-->
                                                </div>
                                                <!--end::user-->
                                            </div>
                                            <!--end::users-->
                                            <!--begin::Actions-->
                                            <div class="d-flex flex-center mt-15">
                                                <button type="reset" id="kt_modal_users_search_reset" data-bs-dismiss="modal" class="btn btn-active-light me-3">انصراف</button>
                                                <button type="submit" id="kt_modal_users_search_submit" class="btn btn-primary">کاربران انتخاب شده را اضافه کنید</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Results-->
                                        <!--begin::Empty-->
                                        <div data-kt-search-element="empty" class="text-center d-none">
                                            <!--begin::Message-->
                                            <div class="fw-semibold py-10">
                                                <div class="text-gray-600 fs-3 mb-2">هیچ کاربری پیدا نشد</div>
                                                <div class="text-muted fs-6">Try to search by username, full name or email...</div>
                                            </div>
                                            <!--end::Message-->
                                            <!--begin::Illustration-->
                                            <div class="text-center px-5">
                                                <img src="" alt="" class="w-100 h-200px h-sm-325px">
                                            </div>
                                            <!--end::Illustration-->
                                        </div>
                                        <!--end::Empty-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::جستجو-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Users جستجو-->
                <!--end::Modals-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</div>

    <!--begin::سفارشی Javascript(used for this page only)-->
    {{-- <script src="{{asset('adminbackend/assets/js/custom/apps/ecommerce/catalog/categories.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.j')}}s"></script> --}}
    <!--end::سفارشی Javascript-->

    <script src="{{asset('frontend/assets/js/chatSPUX.js')}}"></script>
@endsection