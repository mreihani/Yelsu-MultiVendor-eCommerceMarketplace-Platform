<!DOCTYPE html>
<html lang="en">

 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    {{-- <title>وولمارت - قدرتمند ترین قالب چند منظوره فروشگاهی html</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES"> --}}

    {!! SEO::generate() !!}    

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/animate/animate.min.css')}}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style-rtl.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/nouislider/nouislider.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/magnific-popup/magnific-popup.min.css')}}">
    
    <!-- Lightbox CSS -->
    <link href="{{asset('frontend/assets/lightbox/src/css/lightbox.css')}}" rel="stylesheet" />

    <!-- Chat CSS and JS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/chat.css')}}">
    <script src="{{asset('frontend/assets/js/axios.min.js')}}"></script>
    {{-- @vite(['resources/js/app.js']) --}}

    <!-- Neshan -->
    <link href="{{asset('frontend/assets/plugins/leaflet/leaflet.css')}}" rel="stylesheet" type="text/css" />  
    <link href="{{asset('frontend/assets/plugins/leaflet/Control.Geocoder.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('frontend/assets/plugins/leaflet/leaflet.js')}}"></script> 

    <!-- jQuery -->
    <script src="{{asset('frontend/assets/vendor/jquery/jquery.min.js')}}"></script>

    <!--begin::DataTables Plugin CSS -->
    <link href="{{asset('frontend/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/assets/plugins/datatables/responsive.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>

    <!--begin::DataTables Plugin JS -->
    <script src="{{asset('frontend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('frontend/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    
    <script src="{{asset('frontend/assets/js/chatUX.js')}}"></script>

    <!-- SELECT2 -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminbackend/assets/plugins/custom/select2/select2.min.css')}}">
    <script src="{{asset('adminbackend/assets/plugins/custom/select2/select2.min.js')}}"></script>

    <!--begin:: product details min value initiation -->
    <script>
        let productInitialPriceValue;
    </script>
</head>

<body class="my-account">   
    <div class="page-wrapper">
        <!-- Start of Header -->
        @include("frontend.dashboard.header")
        <!-- End of Header -->

        <!-- Start of Main -->
        @yield('main')
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
    @include('frontend.body.layout.chat')
    <a id="scroll-top" class="scroll-top" href="#top" title="بالا" role="button"> <i class="w-icon-angle-up"></i> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70"> <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle> </svg> </a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    @include('frontend.body.layout.main_page_mobile_menu')
    <!-- End of Mobile Menu -->
    
    <!-- Plugin JS File -->

    <script src="{{asset('frontend/assets/js/miniCart.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/sticky/sticky.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/jquery.plugin/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/nouislider/nouislider.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/zoom/jquery.zoom.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/jquery.countdown/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/main.min.js')}}"></script>

    <!-- Lightbox JS -->
    <script src="{{asset('frontend/assets/lightbox/src/js/lightbox.js')}}"></script>
    

</body>


 </html>