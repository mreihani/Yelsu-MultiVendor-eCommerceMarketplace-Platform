<!DOCTYPE html>
<html lang="en">
    
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    {{-- <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description"
        content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES"> --}}

    {!! SEO::generate() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('frontend/assets/images/icons/favicon.png')}}">

    <!-- WebFont.js -->
    {{-- <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700,800'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '{{asset('frontend/assets/js/webfont.js')}}';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script> --}}

    <link rel="preload" href="{{asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{asset('frontend/assets/fonts/wolmart87d5.ttf?png09e')}}" as="font" type="font/ttf" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/fontawesome-free/css/all.min.css')}}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.css')}}">
    

    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/animate/animate.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/magnific-popup/magnific-popup.min.css')}}"> --}}

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/demo13.min.css')}}">

    <script src="{{asset('frontend/assets/vendor/jquery/jquery.min.js')}}"></script>      
    
    <!-- Lightbox CSS -->
    <link href="{{asset('frontend/assets/lightbox/src/css/lightbox.css')}}" rel="stylesheet" />
    
    <!-- Chat CSS and JS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/chat.css')}}">
    <script src="{{asset('frontend/assets/js/axios.min.js')}}"></script>
    {{-- @vite(['resources/js/app.js']) --}}
    
    <script src="{{asset('frontend/assets/js/chatUX.js')}}"></script>

    <script>
        let productInitialPriceValue;
    </script>
    
</head>

<body class="home">
    <div class="page-wrapper">
        <h1 class="d-none">یل سو</h1>
        <main class="main d-flex">
            <!-- Start of Sidebar -->
            @include('frontend.body.sidebar')
            <!-- End of Sidebar -->
            <div class="main-content">
                <div class="banner top-banner banner-fixed">
                    <figure class="banner-media">
                        <img src="{{asset('frontend/assets/images/demos/demo13/banner/top-banner2.jpg')}}" alt="Banner" width="1597"
                            height="70" />
                    </figure>
                    @if(Auth::check())
                        <div class="banner-content d-flex align-items-center x-50 y-50 ml-4">
                            <h5 class="banner-price-info font-weight-normal" style="color: white">
                                {{Auth::user()->firstname}} {{Auth::user()->lastname}}
                                به پلتفرم یلسو
                                خوش آمدید!
                            </h5>
                            <a href="{{URL::to('/dashboard')}}" class="btn btn-sm btn-white btn-outline btn-rounded btn-icon-right">
                                پیشخوان <i class="w-icon-long-arrow-left"></i>
                            </a>
                            <i class="w-icon-cart text-white"></i>
                        </div>
                    @else
                        <div class="banner-content d-flex align-items-center x-50 y-50 ml-4">
                            <h5 class="banner-price-info font-weight-normal" style="color: white">
                                برای استفاده از امکانات پلتفرم تجاری یلسو هم اکنون   <span class="text-primary text-uppercase font-weight-bolder"><a href="{{URL::to('/register')}}">عضو</a></span> شوید!
                            </h5>
                            <a href="{{URL::to('/register')}}" class="btn btn-sm btn-white btn-outline btn-rounded btn-icon-right">
                                عضویت <i class="w-icon-long-arrow-left"></i>
                            </a>
                            <i class="w-icon-cart text-white"></i>
                        </div>
                    @endif
                    <a href="#" class="banner-close">
                        <i class="close-icon"></i>
                    </a>
                </div>
                <header class="header">
                    <div class="header-top">
                        <div class="container">
                            <div class="header-left">
                                <p class="welcome-msg ls-25">پلتفرم اقتصادی یلسو - مثل آب خوردن و با سرعت باد خرید کنید!</p>
                            </div>
                            <div class="header-right">
                                {{-- <a href="#">
                                    <i class="w-icon-sale"></i>
                                    <span class="d-md-show">معاملات روزانه</span>
                                </a> --}}
                                <a href="{{route('dashboard',['type' => 'orders'])}}">
                                    <i class="w-icon-orders mt-0"></i>
                                    <span class="d-md-show">پیگیری سفارش</span>
                                </a>
                                <span class="divider d-lg-show"></span>
                                <a href="{{URL::to('/blog')}}" class="d-lg-show">بلاگ </a>
                                @guest
                                <a href="{{URL::to('/register')}}" class="d-lg-show">فروشنده شوید </a>
                                @endguest
                                <a href="{{URL::to('/about-us')}}" class="d-lg-show">درباره ما </a>
                                <a id="chatBtnContact" href="#">
                                    <i class="w-icon-exclamation-circle"></i>
                                    <span class="d-md-show">نیاز به کمک دارید</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End of Header Top -->
                        @include('frontend.body.header')
                    <!-- End of Header Middle -->
                </header>

                    @yield('main')

                        

                <!-- Start of Footer -->
                @include('frontend.body.footer')
                <!-- End of Footer -->
            </div>
        </main>
    </div>
    <!-- End of Page-wrapper -->

    <!-- Start of Sticky Footer -->
    @include('frontend.body.layout.mobileStickyFooter')
    <!-- End of Sticky Footer -->

    <!-- Start of Chat Element -->
    @include('frontend.body.layout.chat')
    <!-- End of Chat Element -->


    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top d-none" href="#top" title="بالا" role="button">
        <i class="w-icon-angle-up"></i>
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
                r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg>
    </a>
    <!-- End of Scroll Top -->
    <!-- Start of Newsletter popup -->
    {{-- <div class="newsletter-popup mfp-hide">
        <div class="newsletter-content">
            <h4 class="text-uppercase font-weight-normal ls-25">دریافت کنید<span class="text-primary">25% تخفیف</span></h4>
            <h2 class="ls-25">در وولمارت ثبت نام کنید</h2>
            <p class="text-light ls-10">برای دریافت به‌روزرسانی‌های پیشنهادات ویژه، در خبرنامه بازار وولمارت مشترک شوید.</p>
            <form action="#" method="get" class="input-wrapper input-wrapper-inline input-wrapper-round">
                <input type="email" class="form-control email font-size-md" name="email" id="email2"
                    placeholder="آدرس ایمیل شما " required="">
                <button class="btn btn-dark" type="submit">ارسال </button>
            </form>
            <div class="form-checkbox d-flex align-items-center">
                <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup"
                    required="">
                <label for="hide-newsletter-popup" class="font-size-sm text-light">دیگر این پنجره بازشو نشان داده نشود.</label>
            </div>
        </div>
    </div> --}}
    <!-- End of Newsletter popup -->
    <!-- Start of Quick View -->
    <div class="product product-single product-popup">
        <div class="row gutter-lg">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="product-gallery product-gallery-sticky">
                    <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                        <div class="swiper-wrapper row cols-1 gutter-no">
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="{{asset('frontend/assets/images/products/popup/1-440x494.jpg')}}"
                                        data-zoom-image="assets/images/products/popup/1-800x900.jpg"
                                        alt="Water Boil Black Utensil" width="800" height="900">
                                </figure>
                            </div>
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="{{asset('frontend/assets/images/products/popup/2-440x494.jpg')}}"
                                        data-zoom-image="assets/images/products/popup/2-800x900.jpg"
                                        alt="Water Boil Black Utensil" width="800" height="900">
                                </figure>
                            </div>
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="{{asset('frontend/assets/images/products/popup/3-440x494.jpg')}}"
                                        data-zoom-image="assets/images/products/popup/3-800x900.jpg"
                                        alt="Water Boil Black Utensil" width="800" height="900">
                                </figure>
                            </div>
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="{{asset('frontend/assets/images/products/popup/4-440x494.jpg')}}"
                                        data-zoom-image="assets/images/products/popup/4-800x900.jpg"
                                        alt="Water Boil Black Utensil" width="800" height="900">
                                </figure>
                            </div>
                        </div>
                        <button class="swiper-button-next"></button>
                        <button class="swiper-button-prev"></button>
                    </div>
                    <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                        'navigation': {
                            'nextEl': '.swiper-button-next',
                            'prevEl': '.swiper-button-prev'
                        }
                    }">
                        <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                            <div class="product-thumb swiper-slide">
                                <img src="{{asset('frontend/assets/images/products/popup/1-103x116.jpg')}}" alt="Product Thumb" width="103"
                                    height="116">
                            </div>
                            <div class="product-thumb swiper-slide">
                                <img src="{{asset('frontend/assets/images/products/popup/2-103x116.jpg')}}" alt="Product Thumb" width="103"
                                    height="116">
                            </div>
                            <div class="product-thumb swiper-slide">
                                <img src="{{asset('frontend/assets/images/products/popup/3-103x116.jpg')}}" alt="Product Thumb" width="103"
                                    height="116">
                            </div>
                            <div class="product-thumb swiper-slide">
                                <img src="{{asset('frontend/assets/images/products/popup/4-103x116.jpg')}}" alt="Product Thumb" width="103"
                                    height="116">
                            </div>
                        </div>
                        <button class="swiper-button-next"></button>
                        <button class="swiper-button-prev"></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 overflow-hidden p-relative">
                <div class="product-details scrollable pl-0">
                    <h2 class="product-title">ساعت مچی مشکی الکترونیکی</h2>
                    <div class="product-bm-wrapper">
                        <figure class="brand">
                            <img src="{{asset('frontend/assets/images/products/brand/brand-1.jpg')}}" alt="Brand" width="102" height="48" />
                        </figure>
                        <div class="product-meta">
                            <div class="product-categories">
                                دسته بندی: 
                                <span class="product-category"><a href="#">الکترونیک </a></span>
                            </div>
                            <div class="product-sku">
                               کد:  <span>MS46891340</span>
                            </div>
                        </div>
                    </div>

                    <hr class="product-divider">

                    <div class="product-price">80000 تومان </div>

                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 80%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="#" class="rating-reviews">(3 نظر )</a>
                    </div>

                    <div class="product-short-desc">
                        <ul class="list-type-check list-style-none">
                            <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است..</li>
                            <li>چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی.</li>
                            <li>مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد..</li>
                        </ul>
                    </div>

                    <hr class="product-divider">

                    <div class="product-form product-variation-form product-color-swatch">
                        <label>رنگ :</label>
                        <div class="d-flex align-items-center product-variations">
                            <a href="#" class="color" style="background-color: #ffcc01"></a>
                            <a href="#" class="color" style="background-color: #ca6d00;"></a>
                            <a href="#" class="color" style="background-color: #1c93cb;"></a>
                            <a href="#" class="color" style="background-color: #ccc;"></a>
                            <a href="#" class="color" style="background-color: #333;"></a>
                        </div>
                    </div>
                    <div class="product-form product-variation-form product-size-swatch">
                        <label class="mb-1">سایز :</label>
                        <div class="flex-wrap d-flex align-items-center product-variations">
                            <a href="#" class="size">کوچک </a>
                            <a href="#" class="size">متوسط </a>
                            <a href="#" class="size">بزرگ </a>
                            <a href="#" class="size">خبلی بزرگ </a>
                        </div>
                        <a href="#" class="product-variation-clean">پاک کردن همه </a>
                    </div>

                    <div class="product-variation-price">
                        <span></span>
                    </div>

                    <div class="product-form">
                        <div class="product-qty-form">
                            <div class="input-group">
                                <input class="quantity form-control" type="number" min="1" max="10000000">
                                <button class="quantity-plus w-icon-plus"></button>
                                <button class="quantity-minus w-icon-minus"></button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-cart">
                            <i class="w-icon-cart"></i>
                            <span>افزودن به سبد  </span>
                        </button>
                    </div>

                    <div class="social-links-wrapper">
                        <div class="social-links">
                            <div class="social-icons social-no-color border-thin">
                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                <a href="#" class="social-icon social-youtube fab fa-linkedin-in"></a>
                            </div>
                        </div>
                        <span class="divider d-xs-show"></span>
                        <div class="product-link-wrapper d-flex">
                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                            <a href="#"
                                class="btn-product-icon btn-compare btn-icon-left w-icon-compare"><span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Quick view -->
    
    <!-- Plugin JS File -->

    <script src="{{asset('frontend/assets/vendor/sticky/sticky.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/jquery.plugin/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/skrollr/skrollr.min.js')}}"></script>
    {{-- <script src="{{asset('frontend/assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script> --}}
    <script src="{{asset('frontend/assets/vendor/zoom/jquery.zoom.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/jquery.countdown/jquery.countdown.min.js')}}"></script>


    <!-- Swiper carousel JS -->
    {{-- <script src="{{asset('frontend/assets/vendor/flickity/flickity.pkgd.min.js')}}"></script> --}}
    <script src="{{asset('frontend/assets/js/tabbedCarousel.js')}}"></script>
    
 
    <!-- Main JS -->
    <script src="{{asset('frontend/assets/js/main.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/miniCart.js')}}"></script>

    <!-- Lightbox JS -->
    <script src="{{asset('frontend/assets/lightbox/src/js/lightbox.js')}}"></script>
    
</body>


 </html>