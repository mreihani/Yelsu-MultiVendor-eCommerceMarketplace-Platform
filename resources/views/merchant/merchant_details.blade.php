@extends('frontend.main_theme')
@section('main')

<script>
    let outletsArr =  {!! json_encode($outletsArr) !!};
</script>

<main class="main">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>
                    <a href="{{route('merchant.all')}}">
                        لیست بازرگانان
                    </a>
                </li>
                <li>
                    {{$merchant->shop_name}} 
                </li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page content -->
    <div class="page-content mb-8">
        <div class="container">
            <div class="row gutter-lg">
                <aside class="sidebar left-sidebar vendor-sidebar sticky-sidebar-wrapper sidebar-fixed">

                    {{-- @php
                        $vendor_sector_arr = explode(",", $vendor->vendor_sector);
                        $vendor_sector_cat_arr = [];
                        foreach ($vendor_sector_arr as $vendor_sector_item) {
                            $vendor_sector_cat_arr[] = App\Models\Category::find($vendor_sector_item);
                        }
                    @endphp --}}

                    <!-- Start of Sidebar Overlay -->
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                    <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-right"></i></a>
                    <div class="sidebar-content">
                        <div class="sticky-sidebar">
                            <div class="widget widget-collapsible widget-categories">
                                <h3 class="widget-title"><span>زمینه فعالیت بازرگان</span></h3>
                                <ul class="widget-body filter-items search-ul">
                                    {{-- @foreach($vendor_sector_cat_arr as $vendor_sector_item)
                                    <a href="{{route('shop.category',['id'=> $vendor_sector_item->id])}}">
                                        {{$vendor_sector_item->category_name}}
                                    </a>
                                    @endforeach --}}
                                </ul>
                            </div>
                            <!-- End of Widget -->
                            {{-- <div class="widget widget-collapsible widget-contact">
                                <h3 class="widget-title"><span>تماس با تأمین کننده </span></h3>
                                <div class="widget-body">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="نام شما" />
                                    <input type="text" class="form-control" name="email" id="email_1"
                                        placeholder="you@example.com" />
                                    <textarea name="message" maxlength="1000" cols="25" rows="6"
                                        placeholder="پیام خود را بنویسید..." class="form-control"
                                        required="required"></textarea>
                                    <a href="#" class="btn btn-dark btn-rounded">ارسال پیام</a>
                                </div>
                            </div> --}}
                            <!-- End of Widget -->
                            {{-- <div class="widget widget-collapsible widget-time">
                                <h3 class="widget-title"><span>زمان فروشگاه </span></h3>
                                <ul class="widget-body">
                                    <li><label>شنبه </label></li>
                                    <li><label>یکشنبه</label></li>
                                    <li><label>دوشنبه</label></li>
                                    <li><label>سه شنبه</label></li>
                                    <li><label>چهارشنبه</label></li>
                                    <li><label>پنج شنبه</label></li>
                                    <li><label>جمعه</label></li>
                                </ul>
                            </div> --}}
                            <!-- End of Widget -->
                            {{-- <div class="widget widget-collapsible widget-products">
                                <h3 class="widget-title"><span>پرفروش ترین</span></h3>
                                <div class="widget-body">
                                    <div class="product product-widget">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="assets/images/shop/1.jpg" alt="Product" width="100"
                                                    height="106" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">تلویزیون 3 بعدی</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 80%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">2200000 تومان</div>
                                        </div>
                                    </div>
                                    <div class="product product-widget">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="assets/images/shop/2-1.jpg" alt="Product" width="100"
                                                    height="106" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">ساعت زنگ دار با لامپ</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 80%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <ins class="new-price">30000 تومان</ins><del
                                                    class="old-price">50000 تومان</del>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product product-widget">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="assets/images/shop/3.jpg" alt="Product" width="100"
                                                    height="106" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">لپ تاپ اپل </a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 60%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">4000000 تومان</div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- End of Widget -->
                            {{-- <div class="widget widget-collapsible widget-products">
                                <h3 class="widget-title"><span>امتیاز بالا </span></h3>
                                <div class="widget-body">
                                    <div class="product product-widget">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="assets/images/shop/12.jpg" alt="Product" width="100"
                                                    height="106" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">کوله پشتی ساده کلاسیک</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">85000 تومان</div>
                                        </div>
                                    </div>
                                    <div class="product product-widget">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="assets/images/shop/13.jpg" alt="Product" width="100"
                                                    height="106" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">ساعت هوشمند </a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">90000 تومان</div>
                                        </div>
                                    </div>
                                    <div class="product product-widget">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="assets/images/shop/20.jpg" alt="Product" width="100"
                                                    height="106" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">جا مدادی</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">118000 تومان</div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- End of Widget -->
                        </div>
                    </div>
                </aside>
                <!-- End of Sidebar -->

                <div class="main-content">
                    <div class="store store-banner mb-4">
                        <figure class="store-media">
                            <img src="{{(!empty($merchant->store_banner)) ? url('storage/upload/merchant_images/'.$merchant->store_banner) : url('storage/upload/no_image_store.jpg')}}" alt="merchant" width="930" height="446"
                                style="background-color: #414960;" />
                        </figure>
                        <div class="store-content">
                            <figure class="seller-brand">
                                <img src="{{(!empty($merchant->photo)) ? url('storage/upload/merchant_images/'.$merchant->photo) : url('storage/upload/no_image.jpg')}}" alt="Brand" width="80"
                                    height="80" />
                            </figure>
                            <h4 class="store-title">{{$merchant->shop_name}}</h4>
                            {{-- <ul class="seller-info-list list-style-none mb-6">
                                <li class="store-address">
                                    <i class="w-icon-map-marker"></i>
                                    {{$vendor->shop_address}}
                                </li>
                                <li class="store-phone">
                                    <a href="tel:{{$vendor->home_phone}}">
                                        <i class="w-icon-phone"></i>
                                        {{$vendor->home_phone}}
                                    </a>
                                </li>
                                <li class="store-rating">
                                    <i class="w-icon-star-full"></i>
                                    4.33 امتیاز از 3 بررسی
                                </li>
                                <li class="store-open">
                                    <i class="w-icon-cart"></i>
                                    فروشگاه باز است
                                </li>
                                
                            </ul> --}}
                            {{-- <div class="social-icons social-no-color border-thin">
                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="#" class="social-icon social-google w-icon-google"></a>
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                                <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                            </div> --}}
                        </div>
                    </div>
                    <!-- End of Store Banner -->

                    
                    <!-- Start of leaflet maps -->
                    @if(count($outletsArr))
                        <div class="container mt-10">
                            <div class="shop-default-category">                           
                                <h4 class="text-center">مکان یابی بازرگان</h4>
                                <div id="map"></div>
                            </div>
                        </div>
                    @endif
                    <!-- End of leaflet maps --> 


                    @if($merchant->vendor_description && $merchant->vendor_description_status == 'active')
                        <h2 class="title vendor-product-title mb-4">
                            <a href="#">اطلاعات بازرگان </a>
                        </h2>
                        <div class="product-wrapper row cols-md-12 cols-sm-12 cols-12" style="text-align: justify;">
                            {!! $merchant->vendor_description !!}
                        </div>
                    @endif

                    @if($merchant_product->count())
                    <h2 class="title vendor-product-title mb-4"><a href="#">محصولات </a></h2>
                    <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2">

                        @foreach ($merchant_product as $product)
                            
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="{{route('product.details',$product->product_slug)}}">
                                        <img src="{{(!empty($product->product_thumbnail)) ? url($product->product_thumbnail) : url('storage/upload/no_image_product.jpg')}}" alt="Product" width="300"
                                            height="338" />
                                    </a>
                                    {{-- <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                            title="افزودن به سبد "></a>
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="علاقه مندیها"></a>
                                        <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                            title="مقایسه"></a>
                                        <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                            title="نمایش سریع"></a>
                                    </div> --}}
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-name">
                                        <a href="{{route('product.details',$product->product_slug)}}">{{$product->product_name}}</a>
                                    </h3>
                                    {{-- <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="{{route('product.details',$product->product_slug)}}" class="rating-reviews">(3 نظر )</a>
                                    </div> --}}
                                    <div class="product-pa-wrapper">
                                        <div class="product-price">
                                            @if($product->single_price_with_commission != 0)
                                                <td>{{$product->single_price_with_commission}} {{$product->determine_product_currency()}}</td>
                                            @else
                                                <td>
                                                    <a href="tel:02126402540">
                                                        تماس بگیرید
                                                    </a>
                                                </td>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        
                    </div>
                    @endif
                </div>
                <!-- End of Main Content -->
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</main>

<script src="{{asset('frontend/assets/plugins/leaflet/leafletYelsuDetailPage.js')}}"></script>

@endsection