<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{route('vendor.dashboard')}}">
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
    @if($vendorData->status == 'active')
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
                        <a class="menu-link {{Route::currentRouteName() == 'vendor.dashboard' ? 'active' : ''}}" href="{{route('vendor.dashboard')}}">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                            </svg>
                            <span style="margin-right:4px;">
                                پیشخوان تأمین کننده
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
                        <span class="menu-heading fw-bold text-uppercase fs-7">صفحات حساب کاربری</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->              
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'vendor.profile' ? 'show' : ''}} {{Route::currentRouteName() == 'vendor.profileSettings' ? 'show' : ''}} {{Route::currentRouteName() == 'vendor.profileFinancialStatement' ? 'show' : ''}}">
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
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.profile' ? 'active' : ''}}" href="{{route('vendor.profile')}}">
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
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.profileSettings' ? 'active' : ''}}" href="{{route('vendor.profileSettings')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">تنظیمات</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.profileFinancialStatement' ? 'active' : ''}}" href="{{route('vendor.profileFinancialStatement')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">صورتحساب</span>
                            </a>
                            <!--end:Menu link-->
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
                        <span class="menu-heading fw-bold text-uppercase fs-7">صفحات فروشگاه</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
                    {{Route::currentRouteName() == 'vendor.all.product' ? 'show' : ''}} 
                    {{Route::currentRouteName() == 'vendor.add.product' ? 'show' : ''}}
                    {{Route::currentRouteName() == 'vendor.orders' ? 'show' : ''}}
                    {{Route::currentRouteName() == 'vendor.add.schedule' ? 'show' : ''}}
                    ">
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
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'vendor.all.product' ? 'show' : ''}} {{Route::currentRouteName() == 'vendor.add.product' ? 'show' : ''}}">
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
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'vendor.all.product' ? 'active' : ''}}" href="{{route('vendor.all.product')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">محصولات</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'vendor.add.product' ? 'active' : ''}}" href="{{route('vendor.add.product')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">افزودن محصول</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'vendor.add.schedule' ? 'show' : ''}}">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">زمان بندی تحویل محصولات</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">

                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{Route::currentRouteName() == 'vendor.add.schedule' ? 'active' : ''}}" href="{{route("vendor.add.schedule")}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">مدریت زمان بندی</span>
                                    </a>
                                    <!--end:Menu link-->
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
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'vendor.orders' ? 'show' : ''}}">
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
                                    <a class="menu-link {{$orderURL == "type=paid" ? 'active' : ''}}" href="{{route('vendor.orders',['type' => 'paid'])}}">
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
                                    <a class="menu-link {{$orderURL == "type=unpaid" ? 'active' : ''}}" href="{{route('vendor.orders',['type' => 'unpaid'])}}">
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
                                    <a class="menu-link {{$orderURL == "type=preparation" ? 'active' : ''}}" href="{{route('vendor.orders',['type' => 'preparation'])}}">
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
                                    <a class="menu-link {{$orderURL == "type=posted" ? 'active' : ''}}" href="{{route('vendor.orders',['type' => 'posted'])}}">
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
                                    <a class="menu-link {{$orderURL == "type=received" ? 'active' : ''}}" href="{{route('vendor.orders',['type' => 'received'])}}">
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
                                    <a class="menu-link {{$orderURL == "type=cancelled" ? 'active' : ''}}" href="{{route('vendor.orders',['type' => 'cancelled'])}}">
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
                        <!--begin:Menu item-->
                        {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">مشتریان</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="../../demo1/dist/apps/ecommerce/customers/listing.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">لیست مشتریان</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="../../demo1/dist/apps/ecommerce/customers/details.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">جزییات مشتریان</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div> --}}
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">گزارشات</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="../../demo1/dist/apps/ecommerce/reports/view.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">محصولات مشاهده شده</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="../../demo1/dist/apps/ecommerce/reports/sales.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">فروش</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="../../demo1/dist/apps/ecommerce/reports/returns.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">برگشتی ها</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="../../demo1/dist/apps/ecommerce/reports/customer-orders.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">مشتری سفارشات</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="../../demo1/dist/apps/ecommerce/reports/shipping.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">حمل دریایی</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div> --}}
                        <!--end:Menu item-->
                       
                    </div>
                    <!--end:Menu sub-->

                </div>
                <!--end:Menu item-->


                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'vendor.about' ? 'show' : ''}}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"></path>
                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">اطلاعات تأمین کننده</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion ">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.about' ? 'active' : ''}}" href="{{route('vendor.about')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">درباره تأمین کننده</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->

                
                <!--begin:Menu item-->
                {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 7H2V11H22V7Z" fill="currentColor" />
                                    <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مدیریت فاکتور</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">نمایش فاکتور ها</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="../../demo1/dist/apps/invoices/view/invoice-1.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">فاکتور1</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="../../demo1/dist/apps/invoices/view/invoice-2.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">فاکتور2</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="../../demo1/dist/apps/invoices/view/invoice-3.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">فاکتور 3</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="../../demo1/dist/apps/invoices/create.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">ساختن فاکتور</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div> --}}
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">تنظیمات مکانی فروشگاه</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->              
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'vendor.create.outlet' ? 'show' : ''}} {{Route::currentRouteName() == 'vendor.all.outlet' ? 'show' : ''}}">
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
                        <span class="menu-title">مدیریت آدرس ها</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.create.outlet' ? 'active' : ''}}" href="{{route('vendor.create.outlet')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">افزودن مختصات مکانی</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.all.outlet' ? 'active' : ''}}" href="{{route('vendor.all.outlet')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">نمایش آدرس های ثبت شده</span>
                            </a>
                            <!--end:Menu link-->
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
                        <span class="menu-heading fw-bold text-uppercase fs-7">تنظیمات نمایندگی / عاملیت فروش</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'vendor.add.representative' ? 'show' : ''}} {{Route::currentRouteName() == 'vendor.all.representative' ? 'show' : ''}}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                            <svg width="20" height="20" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 33V15" stroke="#9d9da699" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="10" y="9" width="28" height="6" fill="#fff" stroke="#9d9da699" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 32L14 25H33.9743L40 32" stroke="#9d9da699" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="4" y="33" width="8" height="8" fill="#fff" stroke="#9d9da699" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="20" y="33" width="8" height="8" fill="#fff" stroke="#9d9da699" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="36" y="33" width="8" height="8" fill="#fff" stroke="#9d9da699" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">نمایندگی / عاملیت فروش</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.add.representative' ? 'active' : ''}}" href="{{route("vendor.add.representative")}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">افزودن نماینده / عامل فروش</span>
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
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.all.representative' ? 'active' : ''}}" href="{{route("vendor.all.representative")}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">لیست نمایندگان / عاملیت فروش</span>
                            </a>
                            <!--end:Menu link-->
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
                        <span class="menu-heading fw-bold text-uppercase fs-7">مدیریت شرکت های حمل و نقل</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                            <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon glyph">
                                <path d="M21.89,11.55,20.17,8.1A2,2,0,0,0,18.38,7H17V6a2,2,0,0,0-2-2H4A2,2,0,0,0,2,6V16a2,2,0,0,0,2,2H5.18a3,3,0,0,0,5.64,0h2.36a3,3,0,0,0,5.64,0H20a2,2,0,0,0,2-2V12A1,1,0,0,0,21.89,11.55ZM8,18a1,1,0,1,1,1-1A1,1,0,0,1,8,18Zm8,0a1,1,0,1,1,1-1A1,1,0,0,1,16,18Zm4-2H18.83s0-.05,0-.08a3.78,3.78,0,0,0-.17-.35l-.11-.21a3.29,3.29,0,0,0-.33-.41.8.8,0,0,0-.13-.13,3.29,3.29,0,0,0-.41-.33l-.21-.11-.35-.17-.08,0V9h1.39L20,12.24Z" style="fill:#b8b8b8">
                                </path>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">شرکت های حمل و نقل</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.all.freightage.verified' ? 'active' : ''}}" href="{{route("vendor.all.freightage.verified")}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title"> لیست شرکت های تأیید شده</span>
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
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.all.freightage.not-verified' ? 'active' : ''}}" href="{{route("vendor.all.freightage.not-verified")}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">لیست شرکت های تأیید نشده</span>
                            </a>
                            <!--end:Menu link-->
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
                        <span class="menu-heading fw-bold text-uppercase fs-7">مانیتورینگ فروش (بزودی)</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                            <svg width="20px" height="20px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#b8b8b8"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Layer_2" data-name="Layer 2"> <g id="invisible_box" data-name="invisible box"> <rect width="48" height="48" fill="none"></rect> </g> <g id="Health_Icons" data-name="Health Icons"> <g> <path d="M43,4H5A2.9,2.9,0,0,0,2,7V18.9H7.3l1.8-3.7a1.9,1.9,0,0,1,1.8-1.1,2.1,2.1,0,0,1,1.8,1.1l2.9,6.1,4.8-10.2a2,2,0,0,1,3.6,0l3.7,7.8H30a2,2,0,0,1,0,4H26.4a2.2,2.2,0,0,1-1.8-1.2l-2.4-5L17.4,26.9A2.1,2.1,0,0,1,15.6,28a1.9,1.9,0,0,1-1.8-1.1l-2.9-6.1-.5.9a2,2,0,0,1-1.8,1.2H2V35a3,3,0,0,0,3,3H43a3,3,0,0,0,3-3V7A2.9,2.9,0,0,0,43,4ZM29.4,31.4A2,2,0,0,1,28,32H24a2,2,0,0,1-2-2,1.7,1.7,0,0,1,.6-1.4A2,2,0,0,1,24,28h4a2,2,0,0,1,2,2A1.7,1.7,0,0,1,29.4,31.4Zm10,0A2,2,0,0,1,38,32H34a2,2,0,0,1-2-2,1.7,1.7,0,0,1,.6-1.4A2,2,0,0,1,34,28h4a2,2,0,0,1,2,2A1.7,1.7,0,0,1,39.4,31.4Z"></path> <path d="M37,40H11a2,2,0,0,0,0,4H37a2,2,0,0,0,0-4Z"></path> </g> </g> </g> </g></svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مانیتورینگ فروش</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link " href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">فروش روزانه/ ماهیانه/سالیانه</span>
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
                            <a class="menu-link " href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">تحویل روزانه/ ماهیانه/سالیانه</span>
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
                            <a class="menu-link " href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">فروش نمایندگی  / عاملین</span>
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
                            <a class="menu-link " href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">فروش منطقه جغرافیایی</span>
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
                            <a class="menu-link " href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">گزارشات باربریها</span>
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
                            <a class="menu-link " href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">رصد رانندگان</span>
                            </a>
                            <!--end:Menu link-->
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
                        <span class="menu-heading fw-bold text-uppercase fs-7">مدیریت مناقصه ها / مزایده ها (بزودی)</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                            <svg fill="#b8b8b8" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M475.542,203.546c-15.705-15.707-38.776-18.531-57.022-9.796L296.42,71.648c8.866-18.614,5.615-41.609-9.775-56.999 c-19.528-19.531-51.307-19.531-70.837,0L144.97,85.486c-19.529,19.529-19.529,51.307,0,70.836 c15.351,15.353,38.31,18.678,56.999,9.775l25.645,25.645L14.902,404.454c-19.575,19.574-19.578,51.259,0,70.836 c19.575,19.576,51.259,19.579,70.837,0l212.712-212.711l25.642,25.641c-8.868,18.615-5.617,41.609,9.774,57 c9.46,9.46,22.039,14.672,35.419,14.672s25.957-5.21,35.418-14.672l70.837-70.837 C495.072,254.853,495.072,223.077,475.542,203.546z M192.196,132.71c-6.51,6.509-17.103,6.507-23.613,0 c-6.509-6.511-6.509-17.102,0-23.612l70.837-70.837c6.509-6.509,17.1-6.512,23.612,0c6.51,6.51,6.51,17.102,0.001,23.612 L192.196,132.71z M62.127,451.676c-6.526,6.525-17.086,6.526-23.612,0c-6.525-6.525-6.526-17.087,0-23.612l212.712-212.712 l23.612,23.613L62.127,451.676z M227.614,144.516l11.805-11.807l35.419-35.419L392.9,215.353l-47.224,47.225L227.614,144.516z M451.931,250.772l-70.837,70.837c-6.526,6.526-17.086,6.526-23.612,0c-6.51-6.51-6.51-17.103,0-23.613l70.838-70.837 c6.524-6.526,17.086-6.525,23.611,0C458.457,233.684,458.457,244.245,451.931,250.772z"></path> </g> </g> <g> <g> <path d="M461.691,411.822H328.12c-27.619,0-50.089,22.47-50.089,50.089v33.393c0,9.221,7.476,16.696,16.696,16.696h200.357 c9.221,0,16.696-7.476,16.696-16.696v-33.393C511.781,434.292,489.311,411.822,461.691,411.822z M478.388,478.607H311.424v-16.696 c0-9.206,7.49-16.696,16.696-16.696h133.571c9.206,0,16.696,7.49,16.696,16.696V478.607z"></path> </g> </g> </g></svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مدیریت مناقصه ها / مزایده ها </span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                  
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">مناقصه ها</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">ثبت مناقصه</span>
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
                                    <a class="menu-link " href="">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">شرکت در مناقصه</span>
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

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">مزایده ها</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">ثبت مزایده</span>
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
                                    <a class="menu-link " href="">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">شرکت در مزایده</span>
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
                        <span class="menu-heading fw-bold text-uppercase fs-7">مدیریت ارتباط با مشتریان CRM (بزودی)</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                            <svg fill="#b8b8b8" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M494.933,23.893H17.067C7.641,23.893,0,31.535,0,40.96v430.08c0,9.425,7.641,17.067,17.067,17.067h477.867 c9.425,0,17.067-7.641,17.067-17.067V40.96C512,31.535,504.359,23.893,494.933,23.893z M138.809,453.973H34.133V149.049h104.676 V453.973z M477.867,453.973H172.942V149.049h304.924V453.973z M477.867,114.916H155.886H34.133V58.027h443.733V114.916z"></path> </g> </g> <g> <g> <circle cx="64.865" cy="86.446" r="11.378"></circle> </g> </g> <g> <g> <circle cx="110.376" cy="86.446" r="11.378"></circle> </g> </g> <g> <g> <circle cx="155.887" cy="86.446" r="11.378"></circle> </g> </g> <g> <g> <path d="M106.567,201.387H66.834c-8.761,0-16.447,6.418-17.408,15.126c-1.135,10.295,6.894,19.008,16.96,19.008h39.732 c8.761,0,16.447-6.418,17.408-15.126C124.662,210.1,116.631,201.387,106.567,201.387z"></path> </g> </g> <g> <g> <path d="M106.567,284.444H66.834c-8.761,0-16.447,6.418-17.408,15.126c-1.135,10.295,6.894,19.008,16.96,19.008h39.732 c8.761,0,16.447-6.418,17.408-15.126C124.662,293.158,116.631,284.444,106.567,284.444z"></path> </g> </g> <g> <g> <path d="M106.567,367.502H66.834c-8.761,0-16.447,6.418-17.408,15.126c-1.135,10.295,6.894,19.008,16.96,19.008h39.732 c8.761,0,16.447-6.418,17.408-15.126C124.662,376.215,116.631,367.502,106.567,367.502z"></path> </g> </g> <g> <g> <path d="M367.857,301.1c41.653-38.535,14.341-108.5-42.453-108.5c-56.818,0-84.095,69.973-42.453,108.5 c-12.365,11.439-20.125,27.789-20.125,45.922v45.511c0,9.425,7.641,17.067,17.067,17.067h91.022 c9.425,0,17.067-7.641,17.067-17.067v-45.511C387.982,328.888,380.223,312.54,367.857,301.1z M325.409,227.136 c37.59,0,37.59,56.889,0,56.889S287.818,227.136,325.409,227.136z M353.849,375.467H296.96v-27.857 c0-14.513,11.791-27.864,26.263-28.95c16.665-1.249,30.626,11.957,30.626,28.363V375.467z"></path> </g> </g> </g></svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مدیریت CRM</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                  
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">ارتباط با مشتری</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">نمایش ارتباطات</span>
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
                        <span class="menu-heading fw-bold text-uppercase fs-7">مدیریت تخفیفات (بزودی)</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                            <svg width="20px" height="20px" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 3.91992H6C3.79086 3.91992 2 5.71078 2 7.91992V17.9199C2 20.1291 3.79086 21.9199 6 21.9199H18C20.2091 21.9199 22 20.1291 22 17.9199V7.91992C22 5.71078 20.2091 3.91992 18 3.91992Z" stroke="#b8b8b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M7 17.9199L17 7.91992" stroke="#b8b8b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8 11.9199C9.10457 11.9199 10 11.0245 10 9.91992C10 8.81535 9.10457 7.91992 8 7.91992C6.89543 7.91992 6 8.81535 6 9.91992C6 11.0245 6.89543 11.9199 8 11.9199Z" stroke="#b8b8b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16 17.9199C17.1046 17.9199 18 17.0245 18 15.9199C18 14.8154 17.1046 13.9199 16 13.9199C14.8954 13.9199 14 14.8154 14 15.9199C14 17.0245 14.8954 17.9199 16 17.9199Z" stroke="#b8b8b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مدیریت تخفیفات</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link " href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">ایجاد کد تخفیف</span>
                            </a>
                            <!--end:Menu link-->
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
                        <span class="menu-heading fw-bold text-uppercase fs-7">مدیریت شرکت بازرسی محصول</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                            <svg fill="#b8b8b8" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_476_"> <path id="XMLID_477_" d="M152.552,140.717c0.956-0.794,1.931-1.565,2.92-2.319c0.107-0.082,0.214-0.165,0.321-0.247 c0.968-0.731,1.951-1.441,2.948-2.133c0.134-0.092,0.267-0.185,0.399-0.277c0.989-0.679,1.992-1.338,3.01-1.977 c0.145-0.091,0.291-0.182,0.436-0.273c1.021-0.633,2.054-1.248,3.101-1.841c0.143-0.081,0.285-0.16,0.429-0.24 c1.064-0.595,2.14-1.172,3.23-1.725c0.118-0.06,0.238-0.118,0.357-0.178c1.123-0.564,2.259-1.108,3.409-1.626 c0.068-0.031,0.138-0.06,0.206-0.09c1.2-0.536,2.412-1.05,3.639-1.534c0.002-0.001,0.006-0.002,0.008-0.003 c1.213-0.479,2.441-0.928,3.68-1.355c0.096-0.033,0.189-0.067,0.283-0.1c1.186-0.404,2.383-0.78,3.59-1.136 c0.15-0.044,0.3-0.09,0.45-0.134c1.177-0.34,2.365-0.654,3.561-0.947c0.182-0.044,0.363-0.089,0.545-0.133 c1.185-0.282,2.379-0.539,3.581-0.774c0.192-0.038,0.386-0.075,0.578-0.111c1.206-0.228,2.42-0.431,3.642-0.61 c0.188-0.027,0.374-0.052,0.561-0.079c1.239-0.173,2.486-0.324,3.74-0.446c0.162-0.016,0.324-0.028,0.485-0.043 c1.29-0.119,2.587-0.214,3.892-0.278c0.105-0.005,0.211-0.007,0.316-0.012c1.368-0.062,2.743-0.098,4.127-0.098 c2.568,0,5.111,0.114,7.625,0.325c0.139,0.012,0.276,0.024,0.414,0.037c12.23,1.083,23.756,4.61,34.086,10.093 c0,0,0.002,0,0.002,0.001c1.293,0.686,2.566,1.402,3.819,2.148c0.003,0.001,0.005,0.003,0.007,0.004 c1.253,0.746,2.486,1.521,3.699,2.324c0.002,0.001,0.004,0.002,0.006,0.004c1.213,0.804,2.406,1.637,3.576,2.497 c0.002,0.001,0.002,0.001,0.004,0.003c2.344,1.723,4.602,3.556,6.766,5.493V106.06V75.001c0-8.284-6.716-15-15-15h-45v-45 c0-8.284-6.716-15-15-15H75c-8.284,0-15,6.716-15,15v45H15c-8.284,0-15,6.716-15,15V235c0,8.284,6.716,15,15,15h81.834h32.524 c-4.578-9.212-7.624-19.318-8.806-29.988c0-0.008-0.002-0.016-0.002-0.024c-0.088-0.797-0.166-1.597-0.233-2.399 c-0.001-0.014-0.003-0.028-0.004-0.042c-0.066-0.802-0.123-1.606-0.169-2.414c-0.001-0.029-0.004-0.057-0.005-0.086 c-0.046-0.828-0.082-1.659-0.105-2.492c-0.001-0.027-0.003-0.054-0.003-0.081c-0.023-0.822-0.035-1.646-0.035-2.473 c0-0.767,0.01-1.531,0.029-2.293c0.018-0.721,0.046-1.44,0.081-2.156c0.001-0.036,0.002-0.073,0.004-0.109 c0.07-1.405,0.177-2.8,0.31-4.187c0.011-0.107,0.018-0.215,0.029-0.323c0.135-1.354,0.305-2.697,0.499-4.032 c0.014-0.093,0.025-0.186,0.039-0.278c0.192-1.288,0.415-2.566,0.66-3.835c0.026-0.133,0.05-0.266,0.077-0.399 c0.246-1.244,0.521-2.478,0.818-3.703c0.035-0.148,0.071-0.297,0.107-0.445c0.303-1.215,0.629-2.421,0.979-3.616 c0.043-0.145,0.087-0.291,0.13-0.436c0.359-1.201,0.74-2.391,1.147-3.57c0.043-0.124,0.087-0.246,0.13-0.37 c0.421-1.201,0.863-2.391,1.332-3.567c0.033-0.081,0.066-0.161,0.1-0.242c0.49-1.218,1.002-2.425,1.543-3.616 c0.004-0.009,0.009-0.019,0.014-0.028c1.108-2.439,2.325-4.818,3.639-7.135c0.037-0.065,0.073-0.131,0.109-0.196 c0.626-1.096,1.277-2.176,1.946-3.243c0.064-0.102,0.128-0.206,0.192-0.308c0.658-1.039,1.338-2.063,2.037-3.072 c0.084-0.121,0.168-0.242,0.252-0.363c0.696-0.996,1.413-1.977,2.148-2.943c0.092-0.12,0.184-0.239,0.275-0.358 c0.742-0.965,1.502-1.916,2.283-2.85c0.088-0.105,0.178-0.21,0.267-0.315c0.796-0.945,1.61-1.874,2.444-2.785 c0.068-0.075,0.139-0.148,0.208-0.224c0.864-0.936,1.745-1.858,2.648-2.757c0.025-0.025,0.052-0.05,0.076-0.075 c1.858-1.847,3.798-3.612,5.811-5.292C152.426,140.824,152.488,140.77,152.552,140.717z M90,60.001v-30h90v30H90z"></path> <path id="XMLID_481_" d="M325.606,304.393l-20.815-20.815l-21.434-21.432c-5.837,8.198-13.014,15.375-21.211,21.213l21.432,21.432 l20.815,20.815C307.322,328.535,311.161,330,315,330s7.678-1.464,10.606-4.393C331.465,319.748,331.465,310.251,325.606,304.393z"></path> <path id="XMLID_482_" d="M209.996,150c-0.957,0-1.907,0.028-2.854,0.072c-0.711,0.035-1.418,0.089-2.122,0.149 c-0.191,0.016-0.384,0.026-0.575,0.043c-23.102,2.121-42.395,17.338-50.425,38.162c-0.013,0.033-0.026,0.066-0.04,0.1 c-0.285,0.744-0.557,1.494-0.813,2.251c-0.021,0.062-0.045,0.124-0.066,0.186c-0.268,0.805-0.526,1.616-0.762,2.436 c-0.032,0.11-0.064,0.22-0.094,0.331c-0.186,0.655-0.361,1.314-0.524,1.977c-0.043,0.179-0.082,0.359-0.124,0.538 c-0.235,0.998-0.442,2.006-0.626,3.023c-0.076,0.419-0.158,0.836-0.226,1.259c-0.064,0.405-0.116,0.814-0.173,1.222 c-0.071,0.522-0.141,1.046-0.199,1.573c-0.042,0.374-0.078,0.751-0.113,1.127c-0.056,0.602-0.102,1.207-0.139,1.814 c-0.02,0.313-0.042,0.626-0.057,0.941c-0.042,0.927-0.07,1.858-0.07,2.795c0,15.37,5.785,29.384,15.29,40 c10.985,12.271,26.942,20,44.71,20s33.724-7.729,44.71-20c9.504-10.616,15.29-24.63,15.29-40 C269.996,176.862,243.133,150,209.996,150z"></path> </g> </g></svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">مدیریت شرکت بازرسی محصول</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link " href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">لیست شرکت های تأیید شده</span>
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
                            <a class="menu-link " href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">لیست شرکت های تأیید نشده</span>
                            </a>
                            <!--end:Menu link-->
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
                        <span class="menu-heading fw-bold text-uppercase fs-7">مدیریت فایل</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::currentRouteName() == 'vendor.media.add' ? 'show' : ''}} {{Route::currentRouteName() == 'vendor.media.files' ? 'show' : ''}}">
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
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.media.add' ? 'active' : ''}}" href="{{route('vendor.media.add')}}">
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
                            <a class="menu-link {{Route::currentRouteName() == 'vendor.media.files' ? 'active' : ''}}" href="{{route('vendor.media.files')}}">
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
    @else
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expو="false">
                <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                    
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">حساب کاربری شما غیر فعال است!</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>

                </div>
            </div>
        </div>
    </div>            
    @endif
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    
    <!--end::Footer-->
</div>