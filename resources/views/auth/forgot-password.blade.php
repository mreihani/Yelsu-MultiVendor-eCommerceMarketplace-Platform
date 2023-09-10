<!DOCTYPE html>
<html lang="en">

 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>پلتفرم اقتصادی یلسو</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('frontend/assets/images/icons/favicon.png')}}">

    <!-- WebFont.js -->
    {{-- <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700'] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[0];
            wf.src = '{{asset('frontend/assets/js/webfont.js')}}';
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script> --}}

    <link rel="preload" href="{{asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
            crossorigin="anonymous">
    <link rel="preload" href="{{asset('frontend/assets/fonts/wolmart87d5.woff?png09e')}}" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.css')}}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/magnific-popup/magnific-popup.min.css')}}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style-rtl.min.css')}}">
    
    <!-- jQuery -->
    <script src="{{asset('frontend/assets/vendor/jquery/jquery.min.js')}}"></script>
    
    <!-- Chat CSS and JS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/chat.css')}}">

    <!-- Lightbox CSS -->
    <link href="{{asset('frontend/assets/lightbox/src/css/lightbox.css')}}" rel="stylesheet" />

    {{-- @vite(['resources/js/app.js']) --}}
    <script src="{{asset('frontend/assets/js/axios.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/chatUX.js')}}"></script>
       
</head>

<body>
    <div class="page-wrapper">
        <!-- Start of Header -->
        @include('frontend.login.header')
        <!-- End of Header -->

        <!-- Start of Main -->
        <main class="main login-page">

           


            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">حساب کاربری</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{URL::to('/')}}">خانه </a></li>
                        <li>فراموشی رمز عبور</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            <div class="page-content">
                <div class="container">
                     @if(session()->has('success'))
                        <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5  mt-5 mb-5">
                            <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
                        </div>
                    @endif
                    <div class="login-popup">  
                        <ul class="nav text-uppercase">                   
                            <li class="nav-item">
                                <p class="nav-link">فراموشی رمز عبور</p>                               
                            </li>
                        </ul>                        
                        <div>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label>ایمیل *</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>                               
                                <button type="submit" class="btn btn-primary">بازیابی رمز عبور</button>
                            </form>
                        </div>                                                   
                    </div>
                </div>
            </div>
        </main>
        <!-- End of Main -->

        <!-- Start of Footer -->         
            @include('frontend.body.footer')
        <!-- End of Footer -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Start of Sticky Footer -->
    @include('frontend.body.layout.mobileStickyFooter')
    <!-- End of Sticky Footer -->

    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="بالا" role="button"> <i class="w-icon-angle-up"></i> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70"> <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle> </svg> </a>
    @include('frontend.body.layout.chat')
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay"></div>
        <!-- End of .mobile-menu-overlay -->

        <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
        <!-- End of .mobile-menu-close -->

        <div class="mobile-menu-container scrollable">
            <form action="#" method="get" class="input-wrapper">
                <input type="text" class="form-control" name="search" autocomplete="off"
                    placeholder="جستجو" required />
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>
            </form>
            <!-- End of Search Form -->
            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#main-menu" class="nav-link active">منوی اصلی </a>
                    </li>
                    <li class="nav-item">
                        <a href="#categories" class="nav-link">دسته بندیها </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="main-menu">
                    <ul class="mobile-menu">
                        <li><a href="demo1.html">خانه </a></li>
                        <li>
                            <a href="shop-banner-sidebar.html">فروشگاه </a>
                            <ul>
                                <li>
                                    <a href="#">صفحات فروشگاه </a>
                                    <ul>
                                        <li><a href="shop-banner-sidebar.html">بنر با نوار کناری</a></li>
                                        <li><a href="shop-boxed-banner.html">بنر باکسی </a></li>
                                        <li><a href="shop-fullwidth-banner.html">بنر تمام عرض </a></li>
                                        <li><a href="shop-horizontal-filter.html">فیلتر افقی <span class="tip tip-hot">داغ </span></a></li>
                                        <li><a href="shop-off-canvas.html">بدون نوار کناری <span class="tip tip-new">جدید </span></a></li>
                                        <li><a href="shop-infinite-scroll.html"> اسکرول بی نهایت آژاکس</a></li>
                                        <li><a href="shop-right-sidebar.html">سایدبار چپ </a></li>
                                        <li><a href="shop-both-sidebar.html">هر دو نوار کناری </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">چیدمان فروشگاه </a>
                                    <ul>
                                        <li><a href="shop-grid-3cols.html">3 حالت ستون ها </a></li>
                                        <li><a href="shop-grid-4cols.html">4 حالت ستون ها </a></li>
                                        <li><a href="shop-grid-5cols.html">5 حالت ستون ها </a></li>
                                        <li><a href="shop-grid-6cols.html">6 حالت ستون ها </a></li>
                                        <li><a href="shop-grid-7cols.html">7 حالت ستون ها </a></li>
                                        <li><a href="shop-grid-8cols.html">8 حالت ستون ها </a></li>
                                        <li><a href="shop-list.html">حالت فهرست</a></li>
                                        <li><a href="shop-list-sidebar.html">حالت فهرست با نوار کناری</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">صفحات محصول  </a>
                                    <ul>
                                        <li><a href="product-variable.html">محصول متغیر </a></li>
                                        <li><a href="product-featured.html">ویژه و جذاب </a></li>
                                        <li><a href="product-accordion.html">داده ها در آکاردئون</a></li>
                                        <li><a href="product-section.html">داده ها در بخش ها </a></li>
                                        <li><a href="product-swatch.html">نمونه تصویر </a></li>
                                        <li><a href="product-extended.html">اطلاعات گسترده </a>
                                        </li>
                                        <li><a href="product-without-sidebar.html">بدون نوار کناری </a></li>
                                        <li><a href="product-video.html">360<sup>درجه </sup>  ویدئو <span class="tip tip-new">جدید </span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">چیدمان محصول </a>
                                    <ul>
                                        <li><a href="product-default.html">پیشفرض <span class="tip tip-hot">داغ </span></a></li>
                                        <li><a href="product-vertical.html">شست عمودی </a></li>
                                        <li><a href="product-grid.html">تصاویر شبکه ای </a></li>
                                        <li><a href="product-masonry.html">ساختمانی </a></li>
                                        <li><a href="product-gallery.html">گالری </a></li>
                                        <li><a href="product-sticky-info.html">اطلاعات چسبناک </a></li>
                                        <li><a href="product-sticky-thumb.html">تصویر چسبناک </a></li>
                                        <li><a href="product-sticky-both.html">هردو چسبناک </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="vendor-dokan-store.html">فروشنده </a>
                            <ul>
                                <li>
                                    <a href="#">لیست فروشگاه </a>
                                    <ul>
                                        <li><a href="vendor-dokan-store-list.html">فهرست فروشگاه  1</a></li>
                                        <li><a href="vendor-wcfm-store-list.html">فهرست فروشگاه  2</a></li>
                                        <li><a href="vendor-wcmp-store-list.html">فهرست فروشگاه  3</a></li>
                                        <li><a href="vendor-wc-store-list.html">فهرست فروشگاه  4</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">فروشگاه فروشنده </a>
                                    <ul>
                                        <li><a href="vendor-dokan-store.html">فروشگاه فروشنده  1</a></li>
                                        <li><a href="vendor-wcfm-store-product-grid.html">فروشگاه فروشنده  2</a></li>
                                        <li><a href="vendor-wcmp-store-product-grid.html">فروشگاه فروشنده  3</a></li>
                                        <li><a href="vendor-wc-store-product-grid.html">فروشگاه فروشنده  4</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="blog.html">بلاگ </a>
                            <ul>
                                <li><a href="blog.html">کلاسیک </a></li>
                                <li><a href="blog-listing.html">لیستی </a></li>
                                <li>
                                    <a href="#">گرید </a>
                                    <ul>
                                        <li><a href="blog-grid-2cols.html">شبکه 2 ستون</a></li>
                                        <li><a href="blog-grid-3cols.html">شبکه 3 ستون</a></li>
                                        <li><a href="blog-grid-4cols.html">شبکه 4ستون</a></li>
                                        <li><a href="blog-grid-sidebar.html">سایدبار شبکه ای </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">ساختمانی </a>
                                    <ul>
                                        <li><a href="blog-masonry-2cols.html">ساختمانی 2 ستون </a></li>
                                        <li><a href="blog-masonry-3cols.html">ساختمانی 3 ستون </a></li>
                                        <li><a href="blog-masonry-4cols.html">ساختمانی 4ستون </a></li>
                                        <li><a href="blog-masonry-sidebar.html">نوار کناری ساختمانی </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">ماسک </a>
                                    <ul>
                                        <li><a href="blog-mask-grid.html">ماسک وبلاگ گرید </a></li>
                                        <li><a href="blog-mask-masonry.html">ماسک وبلاگ ساختمانی </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="post-single.html">تک نوشته </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="about-us.html">صفحات </a>
                            <ul>
                                
                                <li><a href="about-us.html">درباره ما </a></li>
                                <li><a href="become-a-vendor.html">فروشنده شوید </a></li>
                                <li><a href="contact-us.html">تماس با ما </a></li>
                                <li><a href="login.html">ورود </a></li>
                                <li><a href="faq.html">نقل و قل </a></li>
                                <li><a href="error-404.html">ارور 404</a></li>
                                <li><a href="coming-soon.html">به زودی </a></li>
                                <li><a href="wishlist.html">علاقه مندیها </a></li>
                                <li><a href="cart.html">سبد خرید </a></li>
                                <li><a href="checkout.html">پرداخت </a></li>
                                <li><a href="my-account.html">حساب من </a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="elements.html">المنت ها </a>
                            <ul>
                                <li><a href="element-products.html">محصولات </a></li>
                                <li><a href="element-titles.html">عناوین </a></li>
                                <li><a href="element-typography.html">تایپوگرافی </a></li>
                                <li><a href="element-categories.html">دسته بندی محصول </a></li>
                                <li><a href="element-buttons.html">دکمه ها </a></li>
                                <li><a href="element-accordions.html">آکاردئون </a></li>
                                <li><a href="element-alerts.html">هشدار و اعلان</a></li>
                                <li><a href="element-tabs.html">زبانه ها </a></li>
                                <li><a href="element-testimonials.html">مشتریان </a></li>
                                <li><a href="element-blog-posts.html">پست های وبلاگ </a></li>
                                <li><a href="element-instagrams.html">اینستاگرام </a></li>
                                <li><a href="element-cta.html">دکمه اقدام تماس</a></li>
                                <li><a href="element-vendors.html">فروشندگان </a></li>
                                <li><a href="element-icon-boxes.html">آیکن باکس </a></li>
                                <li><a href="element-icons.html">آیکن ها </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" id="categories">
                    <ul class="mobile-menu">
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-tshirt2"></i>مدل 
                            </a>
                            <ul>
                                <li>
                                    <a href="#">زنانه </a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">تازه رسیده ها </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">پرفروش ترین ها </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">پر طرفدار </a></li>
                                        <li><a href="shop-fullwidth-banner.html">تن پوش </a></li>
                                        <li><a href="shop-fullwidth-banner.html">کفش ها </a></li>
                                        <li><a href="shop-fullwidth-banner.html">کیسه ها </a></li>
                                        <li><a href="shop-fullwidth-banner.html">تجهیزات جانبی </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">جواهر و
                                                ساعت </a></li>
                                        <li><a href="shop-fullwidth-banner.html">ویژه </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">زنانه </a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">تازه رسیده ها </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">پرفروش ترین ها </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">پر طرفدار </a></li>
                                        <li><a href="shop-fullwidth-banner.html">تن پوش </a></li>
                                        <li><a href="shop-fullwidth-banner.html">کفش ها </a></li>
                                        <li><a href="shop-fullwidth-banner.html">کیسه ها </a></li>
                                        <li><a href="shop-fullwidth-banner.html">تجهیزات جانبی </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">جواهر و
                                                ساعت </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-home"></i>خانه و باغ
                            </a>
                            <ul>
                                <li>
                                    <a href="#">اتاق خواب </a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">تخت، قاب و پایه</a></li>
                                        <li><a href="shop-fullwidth-banner.html">کمد </a></li>
                                        <li><a href="shop-fullwidth-banner.html"> میزهای خواب </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">تخت و تخت کودک</a></li>
                                        <li><a href="shop-fullwidth-banner.html">اسلحه </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">هال </a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">میز های قهوه </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">صندلی </a></li>
                                        <li><a href="shop-fullwidth-banner.html">جداول </a></li>
                                        <li><a href="shop-fullwidth-banner.html">فوتون و مبل تختخواب شو</a></li>
                                        <li><a href="shop-fullwidth-banner.html">کابینت و صندوقچه</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">دفتر </a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">صندلی های اداری </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">میز </a></li>
                                        <li><a href="shop-fullwidth-banner.html">قفسه های کتاب </a></li>
                                        <li><a href="shop-fullwidth-banner.html">قفسه پوشه ها </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html"> اتاق استراحت
                                                جداول </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">آشپزخانه و غذاخوری</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">ست های غذاخوری </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">کابینت های نگهداری آشپزخانه</a></li>
                                        <li><a href="shop-fullwidth-banner.html">قفسه های بشرز </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">صندلی های غذاخوری </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">اتاق غذاخوری جداول </a></li>
                                        <li><a href="shop-fullwidth-banner.html">چهارپایه بار </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-electronics"></i>الکترونیک 
                            </a>
                            <ul>
                                <li>
                                    <a href="#">لپ تاپ و کامپیوتر</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">کامپیوترهای رومیزی</a></li>
                                        <li><a href="shop-fullwidth-banner.html">مانیتور </a></li>
                                        <li><a href="shop-fullwidth-banner.html">لپ تاپ </a></li>
                                        <li><a href="shop-fullwidth-banner.html">هارد دیسک و فضای ذخیره سازی</a></li>
                                        <li><a href="shop-fullwidth-banner.html">کامپیوتر تجهیزات جانبی </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">تلویزیون و ویدئو</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">تلویزیون ها </a></li>
                                        <li><a href="shop-fullwidth-banner.html">بلندگوهای صوتی خانگی</a></li>
                                        <li><a href="shop-fullwidth-banner.html">پروژکتورها </a></li>
                                        <li><a href="shop-fullwidth-banner.html">دستگاه های پخش رسانه</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">دوربین های دیجیتال</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">دوربین های دیجیتال SLR</a></li>
                                        <li><a href="shop-fullwidth-banner.html">دوربین های ورزشی و اکشن</a></li>
                                        <li><a href="shop-fullwidth-banner.html">لنزهای دوربین  </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">چاپگر عکس </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">کارت های حافظه دیجیتال</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">تلفن های همراه </a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">تلفن های حامل </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">گوشی های قفل نشده </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">قاب های گوشی و موبایل</a></li>
                                        <li><a href="shop-fullwidth-banner.html">شارژر تلفن همراه</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-furniture"></i> مبلمان
                            </a>
                            <ul>
                                <li>
                                    <a href="#">مبلمان </a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">مبل و کاناپه</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">صندلی </a></li>
                                        <li><a href="shop-fullwidth-banner.html">چارچوب های تخت </a></li>
                                        <li><a href="shop-fullwidth-banner.html">میزهای کنار تخت </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">میز آرایش</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">نورپردازی </a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">لامپ </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">لامپ ها </a></li>
                                        <li><a href="shop-fullwidth-banner.html">چراغ های سقفی </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">چراغ های دیواری </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">حمام نورپردازی </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">خانه تجهیزات جانبی </a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">تجهیزات جانبی تزئینی </a></li>
                                        <li><a href="shop-fullwidth-banner.html">شمع و نگهدارنده</a></li>
                                        <li><a href="shop-fullwidth-banner.html">عطر خانگی </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">آینه </a></li>
                                        <li><a href="shop-fullwidth-banner.html">ساعت ها </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">باغ و فضای باز</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">مبلمان باغ </a></li>
                                        <li><a href="shop-fullwidth-banner.html">ماشین های چمن زنی </a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">واشرهای تحت فشار</a></li>
                                        <li><a href="shop-fullwidth-banner.html">تمام ابزار باغبانی</a></li>
                                        <li><a href="shop-fullwidth-banner.html">غذاخوری در فضای باز</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-heartbeat"></i>سلامت و زیبایی
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-gift"></i>ایده های هدیه
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-gamepad"></i>اسباب بازی و بازی
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-ice-cream"></i>آشپزی 
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-ios"></i>گوشی های هوشمند 
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-camera"></i>دوربین و عکس 
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-ruby"></i>تجهیزات جانبی 
                            </a>
                        </li>
                        <li>
                            <a href="shop-banner-sidebar.html" class="font-weight-bold text-primary text-uppercase ls-25">
                                نمایش همه دسته بندیها <i class="w-icon-angle-left"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Mobile Menu -->

    <!-- Plugin JS File -->
    <script src="{{asset('frontend/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/main.min.js')}}"></script>

    <!-- Lightbox JS -->
    <script src="{{asset('frontend/assets/lightbox/src/js/lightbox.js')}}"></script>

</body>

 </html>