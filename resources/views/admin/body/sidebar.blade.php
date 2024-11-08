<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{route('admin.dashboard')}}">
            <img alt="Logo" src="{{asset('adminbackend/assets/media/logos/default-dark.svg')}}" class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="{{asset('adminbackend/assets/media/logos/default-small.svg')}}" class="h-20px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expو="false">
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">
                            <a href="{{URL::to('https://yelsu.com/')}}">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.1" d="M17.7218 8.08382L14.7218 5.29811C13.4309 4.09937 12.7854 3.5 12 3.5C11.2146 3.5 10.5691 4.09937 9.2782 5.29811L6.2782 8.08382C5.64836 8.66867 5.33345 8.96109 5.16672 9.34342C5 9.72575 5 10.1555 5 11.015V16.9999C5 18.8856 5 19.8284 5.58579 20.4142C6.17157 20.9999 7.11438 20.9999 9 20.9999H9.75V16.9999C9.75 15.7573 10.7574 14.7499 12 14.7499C13.2426 14.7499 14.25 15.7573 14.25 16.9999V20.9999H15C16.8856 20.9999 17.8284 20.9999 18.4142 20.4142C19 19.8284 19 18.8856 19 16.9999L19 11.015C19 10.1555 19 9.72575 18.8333 9.34342C18.6666 8.96109 18.3516 8.66866 17.7218 8.08382Z" fill="#0795e8"/>
                                    <path d="M19 9L19 17C19 18.8856 19 19.8284 18.4142 20.4142C17.8284 21 16.8856 21 15 21L14 21L10 21L9 21C7.11438 21 6.17157 21 5.58579 20.4142C5 19.8284 5 18.8856 5 17L5 9" stroke="#0795e8" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="M3 11L7.5 7L10.6713 4.18109C11.429 3.50752 12.571 3.50752 13.3287 4.18109L16.5 7L21 11" stroke="#0795e8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 21V17C10 15.8954 10.8954 15 12 15V15C13.1046 15 14 15.8954 14 17V21" stroke="#0795e8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                صفحه اصلی سایت
                            </a>
                        </span>
                    </div>
                    <!--end:Menu content-->

                    <!--begin:Menu content-->
                    <div>
                        <a class="menu-link {{Route::currentRouteName() == 'admin.dashboard' ? 'active' : ''}}" href="{{route('admin.dashboard')}}">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                            </svg>
                            <span style="margin-right:4px;">
                                پیشخوان مدیریت
                            </span>
                        </a>
                    </div>
                    <!--end:Menu content-->

                </div>
                <!--end:Menu item-->
                
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">آمار و اطلاعات پلتفرم</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('admin/visit/all') ? 'show' : '' }} {{Route::currentRouteName() == 'admin.chart.unique.visitors' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.chart.visits' ? 'show' : ''}}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.0021 10.9128V3.01281C13.0021 2.41281 13.5021 1.91281 14.1021 2.01281C16.1021 2.21281 17.9021 3.11284 19.3021 4.61284C20.7021 6.01284 21.6021 7.91285 21.9021 9.81285C22.0021 10.4129 21.5021 10.9128 20.9021 10.9128H13.0021Z" fill="currentColor"></path>
                                    <path opacity="0.3" d="M11.0021 13.7128V4.91283C11.0021 4.31283 10.5021 3.81283 9.90208 3.91283C5.40208 4.51283 1.90209 8.41284 2.00209 13.1128C2.10209 18.0128 6.40208 22.0128 11.3021 21.9128C13.1021 21.8128 14.7021 21.3128 16.0021 20.4128C16.5021 20.1128 16.6021 19.3128 16.1021 18.9128L11.0021 13.7128Z" fill="currentColor"></path>
                                    <path opacity="0.3" d="M21.9021 14.0128C21.7021 15.6128 21.1021 17.1128 20.1021 18.4128C19.7021 18.9128 19.0021 18.9128 18.6021 18.5128L13.0021 12.9128H20.9021C21.5021 12.9128 22.0021 13.4128 21.9021 14.0128Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">اطلاعات بازدید پلتفرم</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ Request::is('admin/visit/all') ? 'active' : '' }}" href="{{route('visit.all')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">لیست کلیه بازدید ها</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.chart.unique.visitors' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.chart.visits' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">نمودار بازدید ها</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.chart.visits' ? 'active' : ''}}" href="{{route('admin.chart.visits')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">بازدید ها</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.chart.unique.visitors' ? 'active' : ''}}" href="{{route('admin.chart.unique.visitors')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">بازدید کنندگان یکتا</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                       
                    </div>
                    <!--end:Menu sub-->

                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">صفحات حساب کاربری</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('admin/profile') ? 'show' : '' }} {{ Request::is('admin/settings') ? 'show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="currentColor" />
                                    <path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="currentColor" />
                                    <path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="currentColor" />
                                    <path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">حساب کاربری</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ Request::is('admin/profile') ? 'active' : '' }}" href="{{route('admin.profile')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">پروفایل من</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ Request::is('admin/settings') ? 'active' : '' }}" href="{{route('admin.profileSettings')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">تنظیمات</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        
                        <!--end:Menu item-->
                        
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
               
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">صفحات فروشگاه</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'all.product' ? 'show' : ''}} {{Route::currentRouteName() == 'add.product' ? 'show' : ''}} {{Route::currentRouteName() == 'all.category' ? 'show' : ''}} {{Route::currentRouteName() == 'add.category' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.orders' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.vendor.product.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.product.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'all.product.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.retailer.product.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'add.attribute' ? 'show' : ''}} {{Route::currentRouteName() == 'all.attribute' ? 'show' : ''}}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" />
                                    <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" />
                                    <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مدیریت فروشگاه</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'all.product' ? 'show' : ''}} {{Route::currentRouteName() == 'add.product' ? 'show' : ''}} {{Route::currentRouteName() == 'all.category' ? 'show' : ''}} {{Route::currentRouteName() == 'add.category' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.vendor.product.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.product.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'all.product.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.retailer.product.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'add.attribute' ? 'show' : ''}} {{Route::currentRouteName() == 'all.attribute' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">فروشگاه</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">

                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'all.category' ? 'show' : ''}} {{Route::currentRouteName() == 'add.category' ? 'show' : ''}} ">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">مدیریت دسته بندی ها</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'add.category' ? 'active' : ''}}" href="{{route('add.category')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">افزودن دسته بندی</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'all.category' ? 'active' : ''}}" href="{{route('all.category')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">دسته بندی ها</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                </div>
                                <!--end:Menu sub-->
                            </div>    
                            <!--end:Menu item-->    

                            <!--begin:Menu item-->
                             <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'add.attribute' ? 'show' : ''}} {{Route::currentRouteName() == 'all.attribute' ? 'show' : ''}}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">مدیریت ویژگی ها</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'add.attribute' ? 'active' : ''}}" href="{{route("add.attribute")}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">افزودن ویژگی</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'all.attribute' ? 'active' : ''}}" href="{{route("all.attribute")}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">ویژگی ها</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                </div>
                                <!--end:Menu sub-->
                            </div>    
                            <!--end:Menu item-->   

                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'all.product' ? 'show' : ''}} {{Route::currentRouteName() == 'add.product' ? 'show' : ''}} {{Route::currentRouteName() == 'all.product.search' ? 'show' : ''}}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">مدیریت محصولات</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'add.product' ? 'active' : ''}}" href="{{route('add.product')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">افزودن محصول</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'all.product' ? 'active' : ''}} {{Route::currentRouteName() == 'all.product.search' ? 'active' : ''}}" href="{{route('all.product')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">محصولات منتشر شده</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                </div>
                                <!--end:Menu sub-->
                            </div>    
                            <!--end:Menu item-->   

                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.vendor.product.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.product.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.retailer.product.verifyAll' ? 'show' : ''}}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">تایید محصولات</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.vendor.product.verifyAll' ? 'active' : ''}}" href="{{route('admin.vendor.product.verifyAll')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">تأمین کننده</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.merchant.product.verifyAll' ? 'active' : ''}}" href="{{route('admin.merchant.product.verifyAll')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">بازرگان</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.retailer.product.verifyAll' ? 'active' : ''}}" href="{{route('admin.retailer.product.verifyAll')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">خرده فروش</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                </div>
                                <!--end:Menu sub-->
                            </div>    
                            <!--end:Menu item-->   
                                
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                        @php
                            $url = url()->full();
                            $orderURL = parse_url($url, PHP_URL_QUERY);
                        @endphp

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.orders' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">سفارشات</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{$orderURL == "type=paid" ? 'active' : ''}}" href="{{route('admin.orders',['type' => 'paid'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">سفارشات پرداخت موفق</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{$orderURL == "type=unpaid" ? 'active' : ''}}" href="{{route('admin.orders',['type' => 'unpaid'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">سفارشات پرداخت ناموفق</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{$orderURL == "type=preparation" ? 'active' : ''}}" href="{{route('admin.orders',['type' => 'preparation'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">سفارشات در حال پردازش</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{$orderURL == "type=posted" ? 'active' : ''}}" href="{{route('admin.orders',['type' => 'posted'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">سفارشات ارسال شده</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->

                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{$orderURL == "type=received" ? 'active' : ''}}" href="{{route('admin.orders',['type' => 'received'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">سفارشات دریافت شده</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->

                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{$orderURL == "type=cancelled" ? 'active' : ''}}" href="{{route('admin.orders',['type' => 'cancelled'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">سفارشات لغو شده</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                        
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">صفحات بلاگ</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.blog.post' ? 'show' : ''}} {{Route::currentRouteName() == 'add.blog.post' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.blog.category' ? 'show' : ''}} {{Route::currentRouteName() == 'add.blog.category' ? 'show' : ''}}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"></path>
                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مدیریت مقالات</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.blog.post' ? 'show' : ''}} {{Route::currentRouteName() == 'add.blog.post' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">مقالات</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'add.blog.post' ? 'active' : ''}}" href="{{route('add.blog.post')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">افزودن مقاله</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.blog.post' ? 'active' : ''}}" href="{{route('admin.blog.post')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">لیست مقالات</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                       <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.blog.category' ? 'show' : ''}} {{Route::currentRouteName() == 'add.blog.category' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">دسته بندی مقالات</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'add.blog.category' ? 'active' : ''}}" href="{{route('add.blog.category')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">افزودن دسته بندی</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.blog.category' ? 'active' : ''}}" href="{{route('admin.blog.category')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">لیست دسته بندی مقالات</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">کاربران</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.users' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.users.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.users.add' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.vendor.status' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.status' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.vendor.about.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.about.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.vendor.status.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.status.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.about.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.vendor.about.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.retailer.status' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.retailer.status.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.retailer.about.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.retailer.about.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.status.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.status' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.status.search' ? 'show' : ''}}{{Route::currentRouteName() == 'admin.freightage.about.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.about.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.profile.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.profile.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.status.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.status' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.status.search' ? 'show' : ''}}  {{Route::currentRouteName() == 'admin.driver.about.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.about.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.profile.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.profile.verifyAll.search' ? 'show' : ''}}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs029.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.5 11C8.98528 11 11 8.98528 11 6.5C11 4.01472 8.98528 2 6.5 2C4.01472 2 2 4.01472 2 6.5C2 8.98528 4.01472 11 6.5 11Z" fill="currentColor" />
                                    <path opacity="0.3" d="M13 6.5C13 4 15 2 17.5 2C20 2 22 4 22 6.5C22 9 20 11 17.5 11C15 11 13 9 13 6.5ZM6.5 22C9 22 11 20 11 17.5C11 15 9 13 6.5 13C4 13 2 15 2 17.5C2 20 4 22 6.5 22ZM17.5 22C20 22 22 20 22 17.5C22 15 20 13 17.5 13C15 13 13 15 13 17.5C13 20 15 22 17.5 22Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مدیریت کاربران</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.users' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.users.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.users.add' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">مدیریت کلیه کاربران</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">

                                <!--begin:Menu item-->
                                <div class="menu-item">

                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.users.add' ? 'active' : ''}}" href="{{route('admin.users.add')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">افزودن کاربر </span>
                                    </a>
                                    <!--end:Menu link-->

                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.users' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.users.search' ? 'active' : ''}}" href="{{route('admin.users')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">لیست کاربران </span>
                                    </a>
                                    <!--end:Menu link-->

                                </div>
                                <!--end:Menu item-->

                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu sub-->

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.vendor.status' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.status' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.vendor.status.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.status.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.retailer.status' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.status.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.status' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.status.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.status.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.status' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.status.search' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">تایید حساب کاربران</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">

                                <!--begin:Menu item-->
                                <div class="menu-item">

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.vendor.status' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.vendor.status.search' ? 'active' : ''}}" href="{{route('admin.vendor.status')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">تأمین کنندگان</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.merchant.status' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.merchant.status.search' ? 'active' : ''}}" href="{{route('admin.merchant.status')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">بازرگانان</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.retailer.status' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.retailer.status.search' ? 'active' : ''}}" href="{{route('admin.retailer.status')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">خرده فروشان</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.freightage.status' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.freightage.status.search' ? 'active' : ''}}" href="{{route('admin.freightage.status')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">شرکت های باربری</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.driver.status' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.driver.status.search' ? 'active' : ''}}" href="{{route('admin.driver.status')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">رانندگان</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                        
                                </div>
                                <!--end:Menu item-->

                            </div>    
                            <!--end:Menu item-->    

                        </div>
                        <!--end:Menu sub-->

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.vendor.about.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.about.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.merchant.about.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.vendor.about.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.retailer.about.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.retailer.about.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.about.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.about.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.about.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.about.verifyAll.search' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">تایید فرم اطلاعات کاربران</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">

                                <!--begin:Menu item-->
                                <div class="menu-item">

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.vendor.about.verifyAll' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.vendor.about.verifyAll.search' ? 'active' : ''}}" href="{{route('admin.vendor.about.verifyAll')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">تأمین کنندگان</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.merchant.about.verifyAll' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.merchant.about.verifyAll.search' ? 'active' : ''}}" href="{{route('admin.merchant.about.verifyAll')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">بازرگانان</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.retailer.about.verifyAll' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.retailer.about.verifyAll.search' ? 'active' : ''}}" href="{{route('admin.retailer.about.verifyAll')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">خرده فروشان</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.freightage.about.verifyAll' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.freightage.about.verifyAll.search' ? 'active' : ''}}" href="{{route('admin.freightage.about.verifyAll')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">شرکت های باربری</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.driver.about.verifyAll' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.driver.about.verifyAll.search' ? 'active' : ''}}" href="{{route('admin.driver.about.verifyAll')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">رانندگان</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                        
                                </div>
                                <!--end:Menu item-->

                            </div>    
                            <!--end:Menu item-->    

                        </div>
                        <!--end:Menu sub-->

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.freightage.profile.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.freightage.profile.verifyAll.search' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.profile.verifyAll' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.driver.profile.verifyAll.search' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">تایید صفحات حساب کاربری</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">

                                <!--begin:Menu item-->
                                <div class="menu-item">

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.freightage.profile.verifyAll' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.freightage.profile.verifyAll.search' ? 'active' : ''}}" href="{{route('admin.freightage.profile.verifyAll')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">زمینه فعالیت باربری</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{Route::currentRouteName() == 'admin.driver.profile.verifyAll' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.driver.profile.verifyAll.search' ? 'active' : ''}}" href="{{route('admin.driver.profile.verifyAll')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">زمینه فعالیت راننده</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                        
                                </div>
                                <!--end:Menu item-->

                            </div>    
                            <!--end:Menu item-->    

                        </div>
                        <!--end:Menu sub-->


                    </div>
                    <!--end:Menu item-->
                </div>

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">حمل و نقل</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
                {{Route::currentRouteName() == 'admin.all.freightage-type' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.add.freightage-type' ? 'show' : ''}}
                {{Route::currentRouteName() == 'admin.all.freightage-loader-type' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.add.freightage-loader-type' ? 'show' : ''}}
                {{Route::currentRouteName() == 'admin.all.freightage-vehicle' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.add.freightage-vehicle' ? 'show' : ''}}
                {{Route::currentRouteName() == 'admin.all.freightage-param' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.add.freightage-param' ? 'show' : ''}}
                ">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs029.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 512 512"><title>Logistics</title><polygon points="99 244.145 160 279.363 160 208.921 99 173.702 99 244.145" fill="#000000" style="fill: rgb(158, 158, 158);"></polygon><polygon points="203.371 147.589 142.376 182.804 166.611 196.796 227.606 161.581 203.371 147.589" fill="#000000" style="fill: rgb(158, 158, 158);"></polygon><polygon points="174 279.363 235 244.145 235 173.702 174 208.921 174 279.363" fill="#000000" style="fill: rgb(158, 158, 158);"></polygon><polygon points="189.371 139.506 166.611 126.366 105.616 161.581 128.376 174.721 189.371 139.506" fill="#000000" style="fill: rgb(158, 158, 158);"></polygon><path d="M425.76,254.571a34.048,34.048,0,0,0-1.9-7.025A33.029,33.029,0,0,0,393.358,227H393v74h40.879Z" fill="#000000" style="fill: rgb(158, 158, 158);"></path><rect x="337" y="227" width="42" height="74" fill="#000000" style="fill: rgb(158, 158, 158);"></rect><path d="M400.127,431.229a35.889,35.889,0,0,0,35.678-34.842c.008-.308.007-.579.007-.843a35.686,35.686,0,1,0-71.371,0c0,.264,0,.535.007.8A35.9,35.9,0,0,0,400.127,431.229Z" fill="#000000" style="fill: rgb(158, 158, 158);"></path><path d="M445.825,315H337v75h13.816a49.673,49.673,0,0,1,98.622,0H479V357.378C479,335.04,460.448,315,445.825,315Z" fill="#000000" style="fill: rgb(158, 158, 158);"></path><path d="M84.6,361.865c.034-.037.07-.187.105-.223.073-.079.144-.21.214-.281a49.64,49.64,0,0,1,71.981-.044c.07.072.14.139.209.212.035.037.076.3.11.339a48.358,48.358,0,0,1,13,28.132H323V343H33v47H71.6A48.362,48.362,0,0,1,84.6,361.865Z" fill="#000000" style="fill: rgb(158, 158, 158);"></path><path d="M85.234,396.343a35.688,35.688,0,0,0,71.357.044c.009-.308.008-.579.008-.843a35.546,35.546,0,0,0-9.607-24.347l-.1-.105c-.045-.045-.064-.066-.108-.112a35.654,35.654,0,0,0-51.745,0l-.132.136-.076.08h0a35.546,35.546,0,0,0-9.605,24.347C85.228,395.808,85.227,396.079,85.234,396.343Z" fill="#000000" style="fill: rgb(158, 158, 158);"></path><path d="M300,113.945A32.827,32.827,0,0,0,267.048,81H66.175A33.017,33.017,0,0,0,33,113.945V329H300ZM249,248.187a7.19,7.19,0,0,1-3.694,6.062l-75.1,43.3a7.176,7.176,0,0,1-3.548.938,7.085,7.085,0,0,1-3.524-.938l-74.818-43.3A6.836,6.836,0,0,1,85,248.187v-86.6a6.824,6.824,0,0,1,3.306-6.062l74.9-43.3a6.908,6.908,0,0,1,6.952,0l75.17,43.3a7.162,7.162,0,0,1,3.67,6.062Z" fill="#000000" style="fill: rgb(158, 158, 158);"></path></svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مدیریت حمل کالا</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.all.freightage-type' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.add.freightage-type' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                                    <span class="svg-icon svg-icon-2">
                                    
                                        <svg fill="#b8b8b8" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 256 198.9" xml:space="preserve" stroke="#b8b8b8"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M128.3,70.3c15.2,0,27.4-12.2,27.4-27.4s-12.1-27.4-27.4-27.4c-15.2,0-27.4,12.2-27.4,27.4 C100.9,58.1,113.2,70.3,128.3,70.3z M64.6,149.7H15.3c-16,0-16.9-24.4,0.3-24.4h42.7l24.5-36.1c7.2-9.9,15.5-14.6,27.1-14.6h36.5 c11.7,0,19.9,4.3,27.1,14.6l24.6,36.1h43c17.2,0,16.2,24.4,0.6,24.4h-49.3c-3.9,0-8.6-1.4-11.4-5.6l-18.8-26.8l-0.1,81.6H94.8 l-0.1-81.6l-18.8,26.8C73.2,148.3,68.5,149.7,64.6,149.7z"></path> <path d="M19.1,89.6v5.7c0,3.2-2.6,5.7-5.7,5.7s-5.7-2.5-5.7-5.7v-5.7H2V71.1l0,0c0-4.1,2.7-7.4,6.5-8.5l6.7-15.8c1-2.3,3.2-4,5.9-4 h25c2.7,0,4.9,1.6,5.9,4l6.6,15.8c3.7,1,6.5,4.4,6.5,8.5l0,0v18.5h-5.8v5.7c0,3.2-2.6,5.7-5.7,5.7c-3.2,0-5.7-2.5-5.7-5.7v-5.7H19.1 z M13.8,80.4c3.2,0,5.7-2.6,5.7-5.7S16.9,69,13.8,69S8,71.5,8,74.7C8,77.9,10.6,80.4,13.8,80.4 M58.6,74.7c0-3.2-2.6-5.7-5.7-5.7 s-5.7,2.6-5.7,5.7s2.6,5.7,5.7,5.7s5.7-3.6,5.7-6.7 M50.8,61.5l-5.1-12.2c-0.2-0.6-0.8-1-1.5-1H22.8c-0.7,0-1.3,0.4-1.5,1l-5.1,12.2 C16.3,61.5,50.8,61.5,50.8,61.5z"></path> <path d="M252.4,50.6c4.7-4.7-1.8-10.7-6.4-6.1l-16.8,16.9l-38.7-10.2l-6.5,6.5l31.9,16.8l-13,12.9l-10-1.2l-5.1,5.1l11.3,5.9l6,11.4 l5.1-5.1l-1.2-9.9l12.9-12.9l16.4,31.7l6.5-6.5l-9.7-38L252.4,50.6z"></path> <g id="shopping_cart"> </g> <g id="cross"> </g> <g id="leaf"> </g> </g></svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">مدیریت روش های ارسال</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.add.freightage-type' ? 'active' : ''}}" href="{{route('admin.add.freightage-type')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">افزودن روش ارسال</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.all.freightage-type' ? 'active' : ''}}" href="{{route('admin.all.freightage-type')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">نمایش روش های ارسال</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                        </div>
                        <!--end:Menu item-->

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.all.freightage-loader-type' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.add.freightage-loader-type' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg fill="#b8b8b8" width="20px" height="20px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style> .cls-1 { fill: none; } </style> </defs> <path d="M17,13V6H8V22H24V13ZM10,8h5v5H10Zm0,7h5v5H10Zm12,5H17V15h5Z" transform="translate(0 0)"></path> <path d="M28,11H19V2h9ZM21,9h5V4H21Z" transform="translate(0 0)"></path> <path d="M28,20H26v2h2v6H4V22H6V20H4a2.0024,2.0024,0,0,0-2,2v6a2.0024,2.0024,0,0,0,2,2H28a2.0024,2.0024,0,0,0,2-2V22A2.0024,2.0024,0,0,0,28,20Z" transform="translate(0 0)"></path> <circle cx="7" cy="25" r="1"></circle> <rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1" width="32" height="32"></rect> </g></svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">مدیریت نوع بارگیر</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.add.freightage-loader-type' ? 'active' : ''}}" href="{{route('admin.add.freightage-loader-type')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">افزودن نوع بارگیر</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.all.freightage-loader-type' ? 'active' : ''}}" href="{{route('admin.all.freightage-loader-type')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">نمایش انواع بارگیر</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                        </div>
                        <!--end:Menu item-->

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.all.freightage-vehicle' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.add.freightage-vehicle' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon glyph">
                                            <path d="M21.89,11.55,20.17,8.1A2,2,0,0,0,18.38,7H17V6a2,2,0,0,0-2-2H4A2,2,0,0,0,2,6V16a2,2,0,0,0,2,2H5.18a3,3,0,0,0,5.64,0h2.36a3,3,0,0,0,5.64,0H20a2,2,0,0,0,2-2V12A1,1,0,0,0,21.89,11.55ZM8,18a1,1,0,1,1,1-1A1,1,0,0,1,8,18Zm8,0a1,1,0,1,1,1-1A1,1,0,0,1,16,18Zm4-2H18.83s0-.05,0-.08a3.78,3.78,0,0,0-.17-.35l-.11-.21a3.29,3.29,0,0,0-.33-.41.8.8,0,0,0-.13-.13,3.29,3.29,0,0,0-.41-.33l-.21-.11-.35-.17-.08,0V9h1.39L20,12.24Z" style="fill:#b8b8b8">
                                            </path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">مدیریت وسیله حمل کالا</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.add.freightage-vehicle' ? 'active' : ''}}" href="{{route('admin.add.freightage-vehicle')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">افزودن وسیله حمل کالا</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.all.freightage-vehicle' ? 'active' : ''}}" href="{{route('admin.all.freightage-vehicle')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">نمایش وسایل حمل</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                        </div>
                        <!--end:Menu item-->

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.all.freightage-param' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.add.freightage-param' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg fill="#b8b8b8" width="20px" height="20px" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m23 14.91a6.55 6.55 0 1 1 -6.52 6.55 6.53 6.53 0 0 1 6.52-6.55zm20.7 15.72a.58.58 0 0 0 0-.84l-4.12-4.12a.59.59 0 0 0 -.42-.18.61.61 0 0 0 -.43.18l-11.34 11.38-1.7 5.69a.8.8 0 0 0 .79 1 .55.55 0 0 0 .18 0l5.69-1.74zm-1.45-7.75 4.15 4.12a.63.63 0 0 0 .43.18.59.59 0 0 0 .42-.18c.73-.73 2.06-1.94 2.06-1.94a2 2 0 0 0 0-2.91l-2.18-2.15a2 2 0 0 0 -1.41-.54 2.34 2.34 0 0 0 -1.5.54s-1.33 1.31-1.93 2a.58.58 0 0 0 0 .88zm-2.15-14.61h-34.1a4 4 0 0 0 -3.93 4v19.07a4 4 0 0 0 3.93 3.94h18.84l3.95-3.94h-18.25a4.53 4.53 0 0 0 -4.54-4.58v-9.88a4.53 4.53 0 0 0 4.56-4.57h25a4.53 4.53 0 0 0 4.56 4.57v3l3.88-3.97v-3.6a4 4 0 0 0 -3.9-4.04z"></path></g></svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">ضرایب محاسباتی حمل</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.add.freightage-param' ? 'active' : ''}}" href="{{route('admin.add.freightage-param')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">افزودن ضریب حمل کالا</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'admin.all.freightage-param' ? 'active' : ''}}" href="{{route('admin.all.freightage-param')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">نمایش ضریب حمل کالا</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                        </div>
                        <!--end:Menu item-->
                    </div>
                </div>

               
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">تنظیمات مکانی گمرک/بنادر/مناطق آزاد</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                @php
                    $url = url()->full();
                    $customsURL = parse_url($url, PHP_URL_QUERY);
                @endphp

                <!--begin:Menu item-->              
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.create.customsoutlet' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.all.customsoutlet' ? 'show' : ''}}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.7 4.19995L4 6.30005V18.8999L8.7 16.8V19L3.1 21.5C2.6 21.7 2 21.4 2 20.8V6C2 5.4 2.3 4.89995 2.9 4.69995L8.7 2.09998V4.19995Z" fill="currentColor"></path>
                                    <path d="M15.3 19.8L20 17.6999V5.09992L15.3 7.19989V4.99994L20.9 2.49994C21.4 2.29994 22 2.59989 22 3.19989V17.9999C22 18.5999 21.7 19.1 21.1 19.3L15.3 21.8998V19.8Z" fill="currentColor"></path>
                                    <path opacity="0.3" d="M15.3 7.19995L20 5.09998V17.7L15.3 19.8V7.19995Z" fill="currentColor"></path>
                                    <path opacity="0.3" d="M8.70001 4.19995V2L15.4 5V7.19995L8.70001 4.19995ZM8.70001 16.8V19L15.4 22V19.8L8.70001 16.8Z" fill="currentColor"></path>
                                    <path opacity="0.3" d="M8.7 16.8L4 18.8999V6.30005L8.7 4.19995V16.8Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مدیریت مناطق</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{Route::currentRouteName() == 'admin.create.customsoutlet' ? 'active' : ''}}" href="{{route('admin.create.customsoutlet')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">افزودن مختصات مکانی جدید</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->

                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{(Route::currentRouteName() == 'admin.all.customsoutlet') && (!$customsURL) ? 'active' : ''}}" href="{{route('admin.all.customsoutlet')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">نمایش تمامی مناطق</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        
                    </div>
                    <!--end:Menu sub-->

                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{$customsURL == "type=customs" ? 'show' : ''}} {{$customsURL == "type=port" ? 'show' : ''}} {{$customsURL == "type=free_zone" ? 'show' : ''}} {{$customsURL == "type=special_zone" ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">نمایش منطقه بر اساس نوع</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{$customsURL == "type=customs" ? 'active' : ''}}" href="{{route('admin.all.customsoutlet',['type' => 'customs'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">گمرک</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->

                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{$customsURL == "type=port" ? 'active' : ''}}" href="{{route('admin.all.customsoutlet',['type' => 'port'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">بنادر</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->

                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{$customsURL == "type=free_zone" ? 'active' : ''}}" href="{{route('admin.all.customsoutlet',['type' => 'free_zone'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">مناطق آزاد</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->    

                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{$customsURL == "type=special_zone" ? 'active' : ''}}" href="{{route('admin.all.customsoutlet',['type' => 'special_zone'])}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">مناطق ویژه اقتصادی</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->   

                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">مدیریت فایل</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'admin.media.files' ? 'show' : ''}} {{Route::currentRouteName() == 'admin.media.add' ? 'show' : ''}}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"></path>
                                    <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">گالری تصاویر</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{Route::currentRouteName() == 'admin.media.add' ? 'active' : ''}}" href="{{route('admin.media.add')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">افزودن تصویر به گالری</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{Route::currentRouteName() == 'admin.media.files' ? 'active' : ''}}" href="{{route('admin.media.files')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">مدیریت گالری</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->

                </div>
                <!--end:Menu item-->

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    
    <!--end::Footer-->
</div>