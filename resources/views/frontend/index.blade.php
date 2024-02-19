@extends('frontend.master_dashboard')
@section('main')

<div class="container homePage">
    <!-- Beginning of Intro Banner Group -->
    <div class="row grid intro-banner-group pt-1 appear-animate">
        @include('frontend.home.home_slider')
        @include('frontend.home.intro_banner_group_1')
        @include('frontend.home.intro_banner_group_2')
        @include('frontend.home.intro_banner_group_3')
        @include('frontend.home.intro_banner_group_4')
        <div class="grid-space col-1"></div>
    </div>

    <!-- Start of Shop Category -->
    <h2 class="title pr-4 mt-10">دسته بندی محصولات و تجهیزات</h2>
    <div class="container">
        <div class="shop-default-category category-ellipse-section mb-6" style="border-bottom:none;">                           
            <div style="display:flex; flex-wrap:wrap; justify-content: center;">
                @if(count($parentCategories))
                    @foreach ($parentCategories as $parentCategory)                    
                        <div class="swiper-slide" style="width: 110px; margin:5px 15px;">
                            <div class="category category-ellipse">
                                <figure class="category-media">
                                    <a href='{{route('shop.category',['id'=> $parentCategory->id])}}'>
                                        <img src="{{!empty($parentCategory->category_image) ? asset($parentCategory->category_image) : asset('storage/upload/no_image.jpg') }}" alt="Categroy" width="190" height="190" style="background-color: #5C92C0;">
                                    </a>
                                </figure>
                                <div class="category-content">
                                    <h4 class="category-name">
                                        <a href='{{route('shop.category',['id'=> $parentCategory->id])}}'>{{$parentCategory->category_name}} </a>
                                    </h4>
                                </div>
                            </div>
                        </div>                    
                    @endforeach
                @endif
            </div>                      
        </div>
    </div>
    <!-- End of Shop Category -->

    <!-- End of Intro Banner Group -->
    <div class="swiper-container swiper-theme icon-box-wrapper appear-animate br-sm bg-white mt-6 mb-8"
        data-swiper-options="{
        'loop': false,
        'spaceBetween': 0,
        'breakpoints': {
            '0': {
                'slidesPerView': 1
            },
            '576': {
                'slidesPerView': 2
            },
            '768': {
                'slidesPerView': 3
            },
            '992': {
                'slidesPerView': 4
            },
            '1200': {
                'slidesPerView': 5
            },
            '1500': {
                'slidesPerView': 5
            }
        }
        }">
        <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
            <div class="swiper-slide icon-box icon-box-side text-dark">
                <a href="">
                    <span class="icon-box-icon icon-payment">
                        <i class="w-icon-money text-dark"></i>
                    </span>
                </a>
                <div class="icon-box-content">
                    <a href="">
                        <h4 class="icon-box-title">پرداخت امن / تضمین دریافت</h4>
                    </a>
                    <a href="">
                        <p class="text-default">ما تضمین می کنیم</p>
                    </a>
                </div>
            </div>
            <div class="swiper-slide icon-box icon-box-side text-dark">
                <a href="{{route('blog.creditPurchase')}}">
                    <span class="icon-box-icon icon-payment">
                        <i class="w-icon-service text-dark"></i>
                    </span>
                </a>
                <div class="icon-box-content">
                    <a href="{{route('blog.creditPurchase')}}">
                        <h4 class="icon-box-title">خرید اعتباری</h4>
                    </a>
                    <a href="{{route('blog.creditPurchase')}}">
                        <p class="text-default">با اعتبارت خرید کن</p>
                    </a>
                </div>
            </div>
            <div class="swiper-slide icon-box icon-box-side text-dark icon-box-money">
                <span class="icon-box-icon">
                    <i class="w-icon-honour"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title">گواهی کیفیت</h4>
                    <p class="text-default">هنگام خرید محصول</p>
                </div>
            </div>
            <div class="swiper-slide icon-box icon-box-side text-dark icon-box-chat mt-0">
                <span class="icon-box-icon icon-chat mr-lg-4">
                    <i class="w-icon-chat"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title">پشتیبانی مشتری</h4>
                    <p class="text-default">24/7 با ما در ارتباط باشید</p>
                </div>
            </div>
            <div class="swiper-slide icon-box icon-box-side text-dark">
                <span class="icon-box-icon icon-shipping">
                    <i class="w-icon-truck"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title">حمل و نقل / باربری</h4>
                    <p class="text-default">برترین شرکت های حمل و نقل</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Icon Box Wrapper -->

    <!-- End of Product Grid -->
    <div class="notification-wrapper d-flex justify-content-center bg-primary br-sm mb-10 mt-7 appear-animate"
        style="animation-duration: 1.2s;">
        <div class="content align-items-center">
            <p class="font-weight-normal ls-normal">با کارشناسان ما در ارتباط باشید</p>
            <a href="#"
                class="btn btn-white btn-outline btn-rounded btn-sm btn-icon-right font-weight-bold text-capitalize ml-auto" id="chatBtnContact">
                ارتباط <i class="w-icon-comments-solid"></i>
            </a>
        </div>
    </div>
    <!-- End of Notification Wrapper -->
    
    <!-- recent product -->

    <!-- End of - recent product -->
    
    <!-- End of Vendor Wrapper -->
    <div class="category-banner-wrapper row cols-md-2 appear-animate">
        <div class="banner banner-fixed br-sm mb-4">
            <figure class="banner-media br-sm">
                <img src="{{asset('frontend/assets/images/demos/demo13/banner/banner-5.jpg')}}" alt="Category Banner"
                    width="759" height="220" style="background-color: #E5E5E5;" />
            </figure>
            <div class="banner-content y-50">
                {{-- <h4 class="banner-subtitle text-secondary font-weight-bold">محبوب ترین ها </h4> --}}
                <h3 class="banner-title ls-25">انواع محصولات<br> نفت، گاز و پتروشیمی
                    {{-- <br><span class="d-block font-weight-normal">مجموعه </span> --}}
                </h3>
                <a href="{{route('shop.category',['id'=> 4])}}"
                    class="btn btn-dark btn-rounded btn-link btn-underline btn-icon-right">
                    ثبت سفارش <i class="w-icon-long-arrow-left"></i>
                </a>
            </div>
        </div>
        <div class="banner banner-fixed br-sm mb-4">
            <figure class="banner-media br-sm">
                <img src="{{asset('frontend/assets/images/demos/demo13/banner/banner-6.jpg')}}" alt="Category Banner"
                    width="759" height="220" style="background-color: #2C3135;" />
            </figure>
            <div class="banner-content y-50">
                {{-- <h4 class="banner-subtitle text-secondary font-weight-bold">تازه رسیده ها </h4> --}}
                <h3 class="banner-title text-white ls-25">انواع محصولات<br> فولادی فلزی
                    {{-- <br><span class="d-block font-weight-normal">دارای وایرلس</span> --}}
                </h3>
                <a href="{{route('shop.category',['id'=> 1])}}"
                    class="btn btn-white btn-rounded btn-link btn-underline btn-icon-right">
                    ثبت سفارش <i class="w-icon-long-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- End of Category Banner Wrapper -->

    <!-- Beginning of yelsu petrochemical carousel Wrapper -->
    @if(count($petroCategory))
        <div class="title-link-wrapper filter-title after-none pt-4 mb-0 appear-animate">
            <h2 class="title mr-auto">محصولات صنایع نفت، گاز و پتروشیمی</h2>
            <ul class="nav-filters list-style-none d-flex align-items-center flex-wrap"
                >
                <li><a href="javascript:void(0)" class="nav-filterpetro active" data-filter="all_categories_petro">تمامی موارد</a></li>
                @foreach ($petroCategory as $petroCategoryItem)
                    <li><a href="javascript:void(0)" class="nav-filterpetro" data-filter="petro_{{$petroCategoryItem->id}}">{{$petroCategoryItem->category_name}}</a></li>
                @endforeach
            </ul>
        </div>
        
        <div class="swiper-container swiper-theme pg-inner" >
            <div class="petroCategorySwiper">
                <div class="swiper-wrapper">
                    @foreach ($petroProductsArray as $steelCategoryProductId => $steelCategoryProduct)
                        @foreach ($steelCategoryProduct as $item)
                            <div class="swiper-slide appear-animate fadeIn appear-animation-visible petro_{{$steelCategoryProductId}}">
                                <div class="grid-item product-wrap">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="{{route('product.details', $item->product_slug)}}">
                                                <img src="{{!empty($item->product_thumbnail_sm) ? asset($item->product_thumbnail_sm) : asset('storage/upload/no_image.jpg') }}" alt="Product"
                                                    width="300" height="337">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name"><a href="{{route('product.details', $item->product_slug)}}">{{$item->product_name}} {!! $item->trading_method != 'internal' ? '<label class="product-label label-hot">ارزی</label>' : '' !!}</a></h4>
                                            <div class="product-price">
                                                @if ($item->single_price_with_commission == 0)
                                                    <div class="product-price">
                                                        <a href="tel:02126402540">
                                                            <i class="w-icon-phone"></i>
                                                            تماس بگیرید
                                                        </a>
                                                    </div>
                                                @else
                                                    <ins class="new-price">{{number_format($item->single_price_with_commission, 0, '', ',')}} {{$item->determine_product_currency()}}</ins>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- End of yelsu carousel Wrapper -->

    <!-- Beginning of yelsu steel carousel Wrapper -->
    @if(count($steelCategory))
    <div class="title-link-wrapper filter-title after-none pt-4 mb-0 appear-animate">
        <h2 class="title mr-auto">محصولات فولادی و فلزی</h2>
        <ul class="nav-filters list-style-none d-flex align-items-center flex-wrap">
            <li><a href="javascript:void(0)" class="nav-filtersteel active" data-filter="all_categories_steel">تمامی موارد</a></li>
            @foreach ($steelCategory as $steelCategoryItem)
                <li><a href="javascript:void(0)" class="nav-filtersteel" data-filter="steel_{{$steelCategoryItem->id}}">{{$steelCategoryItem->category_name}}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="swiper-container swiper-theme pg-inner" >
        <div class="steelCategorySwiper">
            <div class="swiper-wrapper">
                @foreach ($steelProductsArray as $steelCategoryProductId => $steelCategoryProduct)
                    @foreach ($steelCategoryProduct as $item)
                        <div class="swiper-slide appear-animate fadeIn appear-animation-visible steel_{{$steelCategoryProductId}}">
                            <div class="grid-item product-wrap">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{route('product.details', $item->product_slug)}}">
                                            <img src="{{!empty($item->product_thumbnail_sm) ? asset($item->product_thumbnail_sm) : asset('storage/upload/no_image.jpg') }}" alt="Product"
                                                width="300" height="337">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a href="{{route('product.details', $item->product_slug)}}">{{$item->product_name}} {!! $item->trading_method != 'internal' ? '<label class="product-label label-hot">ارزی</label>' : '' !!}</a></h4>
                                        
                                        <div class="product-price">
                                            @if ($item->single_price_with_commission == 0)
                                                <div class="product-price">
                                                    <a href="tel:02126402540">
                                                        <i class="w-icon-phone"></i>
                                                        تماس بگیرید
                                                    </a>
                                                </div>
                                            @else
                                                <ins class="new-price">{{number_format($item->single_price_with_commission, 0, '', ',')}} {{$item->determine_product_currency()}}</ins>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- End of yelsu carousel Wrapper -->
    
   <!-- Beginning of yelsu mining carousel Wrapper -->
    @if(count($miningCategory))
    <div class="title-link-wrapper filter-title after-none pt-4 mb-0 appear-animate">
        <h2 class="title mr-auto">محصولات معدنی و فرآوری</h2>
        <ul class="nav-filters list-style-none d-flex align-items-center flex-wrap"
            >
            <li><a href="javascript:void(0)" class="nav-filtermining active" data-filter="all_categories_mining">تمامی موارد</a></li>
            @foreach ($miningCategory as $miningCategoryItem)
                <li><a href="javascript:void(0)" class="nav-filtermining" data-filter="mining_{{$miningCategoryItem->id}}">{{$miningCategoryItem->category_name}}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="swiper-container swiper-theme pg-inner" >
        <div class="miningCategorySwiper">
            <div class="swiper-wrapper">
                @foreach ($miningProductsArray as $miningCategoryProductId => $miningCategoryProduct)
                    @foreach ($miningCategoryProduct as $item)
                        <div class="swiper-slide appear-animate fadeIn appear-animation-visible mining_{{$miningCategoryProductId}}">
                            <div class="grid-item product-wrap">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{route('product.details', $item->product_slug)}}">
                                            <img src="{{!empty($item->product_thumbnail_sm) ? asset($item->product_thumbnail_sm) : asset('storage/upload/no_image.jpg') }}" alt="Product"
                                                width="300" height="337">
                                        </a>
                                    </figure>
                                    <div class="product-details">                                  
                                        <h4 class="product-name"><a href="{{route('product.details', $item->product_slug)}}">{{$item->product_name}} {!! $item->trading_method != 'internal' ? '<label class="product-label label-hot">ارزی</label>' : '' !!}</a></h4>
                                        <div class="product-price">
                                            @if ($item->single_price_with_commission == 0)
                                                <div class="product-price">
                                                    <a href="tel:02126402540">
                                                        <i class="w-icon-phone"></i>
                                                        تماس بگیرید
                                                    </a>
                                                </div>
                                            @else
                                                <ins class="new-price">{{number_format($item->single_price_with_commission, 0, '', ',')}} {{$item->determine_product_currency()}}</ins>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- End of yelsu carousel Wrapper -->
    <!-- End of Filter Product Wrapper -->

    <!-- Beginning of yelsu construction carousel Wrapper -->
    @if(count($constructionCategory))
        <div class="title-link-wrapper filter-title after-none pt-4 mb-0 appear-animate">
            <h2 class="title mr-auto">محصولات ساختمانی و عمرانی</h2>
            <ul class="nav-filters list-style-none d-flex align-items-center flex-wrap"
                data-target="#products-3">
                <li><a href="javascript:void(0)" class="nav-filterconstruction active" data-filter="all_categories_construction">تمامی موارد</a></li>
                @foreach ($constructionCategory as $constructionCategoryItem)
                    <li><a href="javascript:void(0)" class="nav-filterconstruction" data-filter="construction_{{$constructionCategoryItem->id}}">{{$constructionCategoryItem->category_name}}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="swiper-container swiper-theme pg-inner" >
            <div class="constructionCategorySwiper">
                <div class="swiper-wrapper">
                    @foreach ($constructionProductsArray as $constructionCategoryProductId => $constructionCategoryProduct)
                        @foreach ($constructionCategoryProduct as $item)
                            <div class="swiper-slide appear-animate fadeIn appear-animation-visible construction_{{$constructionCategoryProductId}}">
                                <div class="grid-item product-wrap">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="{{route('product.details', $item->product_slug)}}">
                                                <img src="{{!empty($item->product_thumbnail_sm) ? asset($item->product_thumbnail_sm) : asset('storage/upload/no_image.jpg') }}" alt="Product"
                                                    width="300" height="337">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name"><a href="{{route('product.details', $item->product_slug)}}">{{$item->product_name}} {!! $item->trading_method != 'internal' ? '<label class="product-label label-hot">ارزی</label>' : '' !!}</a></h4>
                                           
                                            <div class="product-price">
                                                @if($item->single_price_with_commission == 0)
                                                    <div class="product-price">
                                                        <a href="tel:02126402540">
                                                            <i class="w-icon-phone"></i>
                                                            تماس بگیرید
                                                        </a>
                                                    </div>
                                                @else
                                                    <ins class="new-price">{{number_format($item->single_price_with_commission, 0, '', ',')}} {{$item->determine_product_currency()}}</ins>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    @endif
   
    <!-- End of yelsu carousel Wrapper -->
    <div class="row gutter-lg cols-lg-2 mt-4 appear-animate">
        <div class="banner-product-wrapper">
            <div class="title-link-wrapper after-none appear-animate mb-2">
                <h2 class="title pr-4">ماشین آلات جاده ای</h2>
                <a href="{{route('shop.category',['id'=> 8])}}" class="btn btn-link btn-icon-right">
                    جستجوی همه <i class="w-icon-long-arrow-left"></i>
                </a>
            </div>
            <div class="banner banner-1 banner-fixed br-sm mb-4">
                <figure class="banner-media br-sm">
                    <img src="{{asset('frontend/assets/images/demos/demo13/banner/banner-7.jpg')}}" alt="Category Banner"
                        width="754" height="220" style="background-color: #494844;" />
                </figure>
                <div class="banner-content y-50">
                    <h3 class="banner-title text-white ls-25 mb-2">فروش و عرضه انواع<br> کشنده سنگین و فوق سنگین</h3>
                    <a href="{{route('shop.category',['id'=> 8])}}" class="btn btn-white btn-rounded btn-outline">
                        ثبت سفارش
                    </a>
                </div>
            </div>
            
        </div>
        <div class="banner-product-wrapper">
            <div class="title-link-wrapper after-none appear-animate mb-2">
                <h2 class="title pr-4">مصالح ساختمانی</h2>
                <a href="{{route('shop.category',['id'=> 3])}}" class="btn btn-link btn-icon-right">
                    جستجوی همه <i class="w-icon-long-arrow-left"></i>
                </a>
            </div>
            <div class="banner banner-1 banner-fixed br-sm mb-4">
                <figure class="banner-media br-sm">
                    <img src="{{asset('frontend/assets/images/demos/demo13/banner/banner-8.jpg')}}" alt="Category Banner"
                        width="754" height="220" style="background-color: #E5E5E7;" />
                </figure>
                <div class="banner-content y-50">
                    <h3 class="banner-title text-uppercase ls-25 mb-2">فروش انواع <br> مصالح عمرانی و ساختمانی</h3>
                    <a href="{{route('shop.category',['id'=> 3])}}" class="btn btn-dark btn-rounded btn-outline">
                        ثبت سفارش
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-container swiper-theme brands-wrapper bg-white br-sm appear-animate"
        data-swiper-options="{
        'autoplay': false,
        'autoplayTimeout': 4000,
        'loop': false,
        'spaceBetween': 0,
        'breakpoints': {
            '0': {
                'slidesPerView': 2
            },
            '576': {
                'slidesPerView': 3
            },
            '768': {
                'slidesPerView': 4
            },
            '992': {
                'slidesPerView': 5
            },
            '1200': {
                'slidesPerView': 5
            }
        }
        }">
        <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-3 cols-2">
            <figure class="swiper-slide">
                <a href="{{asset('storage/upload/catalogue_file/yelsu_catalogue_3.pdf')}}">
                    <img src="{{asset('frontend/assets/images/demos/demo13/brands/4.jpg')}}" alt="Brand" width="310"
                    height="180" />
                </a>
            </figure>
            <figure class="swiper-slide">
                <a href="https://www.refah-bank.ir/beta">
                    <img src="{{asset('frontend/assets/images/yelsu_images/banks/refah2.png')}}" alt="Brand" width="310"
                    height="250" />
                </a>
            </figure>
            <figure class="swiper-slide">
                <a href="https://www.bmi.ir/">
                    <img src="{{asset('frontend/assets/images/yelsu_images/banks/melli.png')}}" alt="Brand" width="310"
                    height="180" />
                </a>
            </figure>
            <figure class="swiper-slide">
                <a href="https://bankmellat.ir/">
                    <img src="{{asset('frontend/assets/images/yelsu_images/banks/mellat.png')}}" alt="Brand" width="310"
                    height="180" />
                </a>
            </figure>
            <figure class="swiper-slide">
                <a href="https://www.bsi.ir/">
                    <img src="{{asset('frontend/assets/images/yelsu_images/banks/saderat.png')}}" alt="Brand" width="310"
                    height="180" />
                </a>
            </figure>
            {{-- <figure class="swiper-slide">
                <a href="https://www.sb24.ir/">
                    <img src="{{asset('frontend/assets/images/yelsu_images/banks/saman.png')}}" alt="Brand" width="310"
                    height="180" />
                </a>
            </figure> --}}
        </div>
    </div>
    <!-- End of Brands Wrapper -->

    

    {{-- start of blog --}}
    @if (count($blogposts))
        <div class="title-link-wrapper title-post mb-4 after-none appear-animate">
            <h2 class="title ls-normal pt-1 pb-1">اخبار و مقالات</h2>
            <a href="{{route('home.blog')}}" class="btn btn-link mb-0">
                نمایش همه مقالات 
                <i class="w-icon-long-arrow-left"></i>
            </a>
        </div>
        <div class="swiper-container swiper-theme post-wrapper pb-2 appear-animate" data-swiper-options="{
            'slidesPerView': 1,
            'spaceBetween': 20,
            'breakpoints': {
                '576': {
                    'slidesPerView': 2
                },
                '768': {
                    'slidesPerView': 3
                },
                '992': {
                    'slidesPerView': 6,
                    'dots': false
                }
            }
        }">
            <div class="swiper-wrapper row cols-lg-4 cols-md-3 cols-sm-2 cols-1">
                @foreach ($blogposts->take(6) as $blogpost)
                    <div class="swiper-slide post overlay-zoom text-center">
                        <figure class="post-media br-sm">
                            <a href="{{route('home.blog.single',$blogpost->post_slug)}}">
                                <img src="{{$blogpost->post_image}}" alt="Post" width="325"
                                    height="220" style="background-color: #DBE0E4;" />
                            </a>
                        </figure>
                        <div class="post-details pb-5">
                            <div class="post-meta">
                                توسط <a href="#" class="post-author">
                                    {{-- {{$blogpost->bloguser->firstname . ' ' . $blogpost->bloguser->lastname}} --}}
                                    یلسو
                                </a>
                                - <a href="#" class="post-date mr-0">{{jdate($blogpost->created_at)->format('Y/m/d')}}</a>
                            </div>
                            <h4 class="post-title"><a href="{{route('home.blog.single',$blogpost->post_slug)}}">{{$blogpost->post_title}}</a></h4>
                            <a href="{{route('home.blog.single', $blogpost->post_slug)}}" class="btn btn-link btn-dark btn-underline">
                                ادامه مطلب <i class="w-icon-long-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif    
    <!-- End of Blog Post -->

    <!-- Beginning of Financial GIF BANNER -->
    {{-- <div class="bg-white mt-6 mb-6">
        <a href="{{route('blog.financing')}}">
        <a href="">
            <img src="{{asset('frontend/assets/images/financial_compressed.gif')}}" alt="financial banner">
        </a>
    </div> --}}
    <!-- End of Financial GIF BANNER -->

    @if($recently_viewed_product_arr)
        <div class="title-link-wrapper title-recent pt-1 mb-4 after-none appear-animate">
            <h2 class="title ls-normal appear-animate pb-1">بازدید های اخیر</h2>
            <a href="{{route('shop')}}" class="btn btn-link mb-0">
                محصولات بیشتر 
                <i class="w-icon-long-arrow-left"></i>
            </a>
        </div>
        <div class="swiper-container swiper-theme recent-view shadow-swiper appear-animate mb-4 pb-2"
            data-swiper-options="{
                'spaceBetween': 20,
                'slidesPerView': 2,
                'breakpoints': {
                    '576': {
                        'slidesPerView': 3
                    },
                    '768': {
                        'slidesPerView': 5
                    },
                    '992': {
                        'slidesPerView': 6
                    },
                    '1200': {
                        'slidesPerView': 8
                    }
                }
            }">
            <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-2">
                @foreach ($recently_viewed_product_arr[0] as $recentProductItem)
                    <div class="swiper-slide product-wrap">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a href="{{route('product.details', $recentProductItem->product_slug)}}">
                                    <img src="{{!empty($recentProductItem->product_thumbnail_sm) ? asset($recentProductItem->product_thumbnail_sm) : asset('storage/upload/no_image.jpg') }}" alt="Product"
                                        width="130" height="146" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a href="{{route('product.details', $recentProductItem->product_slug)}}">{{$recentProductItem->product_name}}</a>
                            </h4>
                        </div>
                    </div>        
                @endforeach
                <!-- End of Product Wrap -->
            </div>
        </div>
        <!-- End of Recently View -->
    @endif
</div>


@endsection