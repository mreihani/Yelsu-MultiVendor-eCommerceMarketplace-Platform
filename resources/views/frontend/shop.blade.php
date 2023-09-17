@extends('frontend.main_theme')
@section('main')

<script>
    let outletsArr =  {!! json_encode($outletsArr) !!};

    let latitudeVal = {!! json_encode($latitudeVal) !!};
    let longitudeVal = {!! json_encode($longitudeVal) !!};
</script>

<main class="main">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{URL::to('/')}}">خانه </a></li>

                <li>
                    <a href="{{URL::to('/shop')}}">فروشگاه </a>
                </li>

                @if($category_hierarchy_arr)
                    @foreach ($category_hierarchy_arr as $category_hierarchy_item)
                        <li>
                            <a href="{{route('shop.category',['id'=> $category_hierarchy_item->id])}}">{{$category_hierarchy_item->category_name}}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Shop Page error -->
    @if(session()->has('error'))
        <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
            <h4 class="alert-title" style="color:#ffa800">
                <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                {{session('error')}}
        </div>
    @endif
    <!-- End of Shop Page error -->

    <!-- Start of Page Content -->
    <div class="page-content mb-10">
        @if ($root_catgory_obj && $root_catgory_obj->id == 1)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/steel.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com1">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال فولادی و فلزی</p>
                    </a>
                </div>
            </div>
        @elseif($root_catgory_obj && $root_catgory_obj->id == 2)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/mining.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com3">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال معدنی و فرآوری</p>
                    </a>
                </div>
            </div>
        @elseif($root_catgory_obj && $root_catgory_obj->id == 3)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/cunstruction.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com2">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال ساختمانی و عمرانی</p>
                    </a>
                </div>
            </div>
        @elseif($root_catgory_obj && $root_catgory_obj->id == 4)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/oil.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com4">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال نفت، گاز و پتروشیمی</p>
                    </a>
                </div>
            </div>    
        @elseif($root_catgory_obj && $root_catgory_obj->id == 5)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/electrical.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com5">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال تاسیسات برق، مخابرات، آبرسانی</p>
                    </a>
                </div>
            </div>  
        @elseif($root_catgory_obj && $root_catgory_obj->id == 6)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/agricultrual.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com6">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال صنایع و محصولات کشاورزی</p>
                    </a>
                </div>
            </div>   
        @elseif($root_catgory_obj && $root_catgory_obj->id == 7)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/machinary.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال ماشین آلات راهسازی و معدنی</p>
                    </a>
                </div>
            </div> 
        @elseif($root_catgory_obj && $root_catgory_obj->id == 8)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/road.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com7">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال ماشین آلات جاده ای و کشاورزی</p>
                    </a>
                </div>
            </div>     
        @elseif($root_catgory_obj && $root_catgory_obj->id == 860)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/home_applicances.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال دکوراسیون و لوازم خانگی</p>
                    </a>
                </div>
            </div>     
        @else
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/yelsu.jpg')}});">

                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال اصلی</p>
                    </a>
                </div>
            </div>                   
        @endif
    <!-- End of Shop Banner -->


    <!-- Start of Shop Category -->
    <div class="container" style="max-width: 1320px;">
        <div class="shop-default-category category-ellipse-section mb-6">                           
            <div style="display:flex; flex-wrap:wrap; justify-content: center;">
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
            </div>                      
        </div>
    </div>
    <!-- End of Shop Category -->


    <!-- Start of leaflet maps -->
    @if(count($outletsArr))
        <div class="container mt-10" style="max-width: 1320px;">
            <div class="shop-default-category">                           
                @if(Route::currentRouteName() == 'shop' || Route::currentRouteName() == 'vendors' || Route::currentRouteName() == 'merchants' || Route::currentRouteName() == 'retailers')
                    <h4 class="text-center">
                        مکان یابی پلتفرم
                        (Geo Marketing)
                    </h4>
                @else  
                    <h4 class="text-center">
                        مکان یابی پلتفرم
                        {{$category->category_name}}
                        (Geo Marketing)
                    </h4>
                @endif
                <div id="map"></div>
            </div>
        </div>
    @endif
    <!-- End of leaflet maps -->   


    <!-- Start of category description -->
    @if($category && $category->category_description)
        <div class="container mt-10" style="max-width: 1320px;">
            <div id="category_description_full">
                {!! $category->category_description !!}
            </div>

            <button style="display: none;" id="category_description_full_btn" class="btn btn-link btn-primary btn-simple">
                ادامه مطلب
                <i class="w-icon-angle-down"></i>
            </button>
            <button style="display: none;" id="category_description_short_btn" class="btn btn-link btn-primary btn-simple">
                خلاصه مطلب
                <i class="w-icon-angle-up"></i>
            </button>
        </div>
    @endif
    <!-- End of category description -->    
       

    <div class="container-fluid mt-10">
        <!-- Start of Shop Content -->
        <div class="shop-content">
            <!-- Start of Shop Main Content -->
            <div class="main-content">
                <nav class="toolbox sticky-toolbox sticky-content fix-top">
                    <div class="toolbox-left">
                        <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                            btn-icon-left"><i class="w-icon-category"></i><span>فیلتر ها </span></a>
                        {{-- <div class="toolbox-item toolbox-sort select-box text-dark">
                            <label>مرتب سازی با اساس :</label>
                            <select name="orderby" class="form-control">
                                <option value="default" selected="selected">مرتب سازی پیش فرض </option>
                                <option value="popularity">مرتب سازی با اساس محبوبیت </option>
                                <option value="rating">مرتب سازی با اساس میانگین امتیاز </option>
                                <option value="date">مرتب سازی با اساس اخیر </option>
                                <option value="price-low">مرتب سازی با اساس قیمت پایین به بالا</option>
                                <option value="price-high">مرتب سازی با اساس قیمت بالا به پایین</option>
                            </select>
                        </div> --}}
                    </div>
                    {{-- <div class="toolbox-right">
                        <div class="toolbox-item toolbox-show select-box">
                            <select name="count" class="form-control">
                                <option value="9">نمایش 9</option>
                                <option value="12" selected="selected">نمایش 12</option>
                                <option value="24">نمایش 24</option>
                                <option value="36">نمایش 36</option>
                            </select>
                        </div>
                        <div class="toolbox-item toolbox-layout">
                            <a href="shop-fullwidth-banner.html" class="icon-mode-grid btn-layout active">
                                <i class="w-icon-grid"></i>
                            </a>
                            <a href="shop-list.html" class="icon-mode-list btn-layout">
                                <i class="w-icon-list"></i>
                            </a>
                        </div>
                    </div> --}}
                </nav>
            
                @if(count($products))
                    <div class="product-wrapper row cols-xl-8 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                        @foreach ($products as $product)

                            @if($product->status == 'active')
                                <div class="product-wrap">
                                    <span class="imge_url d-none">{{!empty($product->product_thumbnail) ? asset($product->product_thumbnail) : asset('storage/upload/no_image.jpg') }}</span>
                                    <span class="product_code d-none">{{$product->product_code ?? ''}}</span>
                                    <span class="short_desc d-none">{!! $product->short_desc ?? '' !!}</span>
                                    <span class="product_id d-none">{!! $product->id ?? '' !!}</span>
                                    
                                    @if(App\Helpers\Cart\Cart::count($product) < $product->product_qty || $product->product_qty == NULL || $product->unlimitedStock == 'active')
                                    <span class="product_qty d-none">show_button</span>
                                    @endif  
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="{{route('product.details', $product->product_slug)}}">
                                                <img src="{{!empty($product->product_thumbnail_sm) ? asset($product->product_thumbnail_sm) : asset('storage/upload/no_image.jpg') }}" alt="{{$product->product_name}}" width="300"
                                                    height="338" />
                                            </a>
                                            @if($product->currency == 'toman')
                                            <div class="product-action-horizontal" style="width:90px">
                                                <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                    title="افزودن به سبد "></a>
                                                {{-- <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                    title="علاقه مندیها"></a>
                                                <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                                    title="مقایسه"></a> --}}
                                                <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                                    title="نمایش سریع"></a>
                                            </div>
                                            @endif
                                        </figure>
                                        <div class="product-details">
                                            <div class="product-cat">
                                                @if($product->parent_category_name)
                                                    <a href="{{route('shop.category',['id'=> $product->parent_category_id])}}">{{$product->parent_category_name}}</a>
                                                @else
                                                    <a href="">{{'بدون دسته بندی'}}</a>
                                                @endif
                                            </div>
                                            <h3 class="product-name">
                                                @if ($product->currency == 'toman')
                                                    <a href="{{route('product.details', $product->product_slug)}}">{{$product->product_name}}</a>
                                                @else
                                                    <a href="{{route('product.details', $product->product_slug)}}">{{$product->product_name}} <label class="product-label label-hot">ارزی</label></a>
                                                @endif
                                            </h3>
                                            {{-- <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="product-default.html" class="rating-reviews">(3 نظر )</a>
                                            </div> --}}
                                            <div class="product-pa-wrapper">
                                                <div class="product-price">
                                                    @if ($product->selling_price == 0)
                                                        <div class="product-price">
                                                            <a href="tel:02191692471">
                                                                <i class="w-icon-phone"></i>
                                                                تماس بگیرید
                                                            </a>
                                                        </div>
                                                    @else
                                                        @if ($product->currency == 'toman')
                                                            {{$product->selling_price}} تومان
                                                        @elseif($product->currency == 'dollar')
                                                            {{$product->selling_price}} دلار
                                                        @elseif($product->currency == 'euro')
                                                            {{$product->selling_price}} یورو
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>     
                @else
                    <div class="text-center">
                        <h2>هیچ محصولی یافت نشد</h2>
                    </div>
                @endif
                @if(Route::currentRouteName() == 'shop' || Route::currentRouteName() == "shop.category")    
                    <div class="toolbox toolbox-pagination d-flex justify-content-center mt-5">
                        {{$products->links('vendor.pagination.custom')}}
                    </div>
                @endif
                
                
            </div>
            <!-- End of Shop Main Content -->
            
            <!-- Start of Sidebar, Shop Sidebar -->
            <aside class="sidebar shop-sidebar left-sidebar sticky-sidebar-wrapper">
                <!-- Start of Sidebar Overlay -->
                <div class="sidebar-overlay"></div>
                <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

            <form action="{{route('shop.search')}}" method="GET">
                <!-- Start of Sidebar Content -->
                    <div class="sidebar-content scrollable">
                        <div class="filter-actions">
                            <label>فیلتر :</label>
                            <a href="{{route('shop')}}" class="btn btn-dark btn-link ">پاک کردن همه </a>
                        </div>
                        <!-- Start of Collapsible widget -->
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title"><span>تمام دسته بندی ها</span></h3>
                            <ul class="widget-body filter-items search-ul">
                                @if ($categories->count())
                                    @foreach ($filter_category_array as $category)
                                        <li class="filterButtonShopPage rootCat">
                                            <input type="checkbox" name="category_{{$category[0]->id}}" value="{{$category[0]->id}}" {{in_array($category[0]->id, $inputArray) ? 'checked' : ''}}> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category[0]->category_name}} {{count($category[1]) ? "(".count($category[1])." زیر دسته)" : ''}}
                                        </li>
                                        <div class="subCategoryBtn subCatGroup">
                                            @include('frontend.body.layout.shop-page-filter.categories-group', ['categories' => $category[1]])
                                        </div>
                                    @endforeach
                                @else   
                                    <li><a href="">دسته بندی یافت نشد</a></li>
                                @endif
                            </ul>
                        </div>
                        <!-- End of Collapsible Widget -->

                        <!-- Start of Collapsible Widget -->

                        {{-- <div class="widget widget-collapsible">
                            <h3 class="widget-title"><span>قیمت </span></h3>
                            <div class="widget-body">
                                <ul class="filter-items search-ul">
                                    <li><a href="#">0 - 99000 تومان</a></li>
                                    <li><a href="#">100,000 - 500,000 تومان</a></li>
                                    <li><a href="#">500,000 - 1,000,000 تومان</a></li>
                                    <li><a href="#">1,000,000 - 5,000,000 تومان</a></li>
                                    <li><a href="#">5,000,000 تومان +</a></li>
                                </ul>
                                <div class="price-range">
                                    <input type="number" name="min_price" class="min_price text-center"
                                        placeholder="حداقل"><span class="delimiter">-</span><input type="number"
                                        name="max_price" class="max_price text-center" placeholder="حداکثر">
                                </div>
                            </div>
                        </div> --}}

                        <!-- End of Collapsible Widget -->

                        <!-- Start of Collapsible Widget -->
                        {{-- <div class="widget widget-collapsible">
                            <h3 class="widget-title"><span>سایز </span></h3>
                            <ul class="widget-body filter-items item-check mt-1">
                                <li><a href="#">خبلی بزرگ </a></li>
                                <li><a href="#">بزرگ </a></li>
                                <li><a href="#">متوسط </a></li>
                                <li><a href="#">کوچک </a></li>
                            </ul>
                        </div> --}}
                        <!-- End of Collapsible Widget -->

                        <!-- Start of Collapsible Widget -->
                        {{-- <div class="widget widget-collapsible">
                            <h3 class="widget-title"><span>برند </span></h3>
                            <ul class="widget-body filter-items item-check mt-1">
                                <li><a href="#">گروه خودرو زیبا </a></li>
                                <li><a href="#">علف سبز </a></li>
                                <li><a href="#">Node Js</a></li>
                                <li><a href="#">NS8</a></li>
                                <li><a href="#">Red</a></li>
                                <li><a href="#">Skysuite Tech</a></li>
                                <li><a href="#">Sterling</a></li>
                            </ul>
                        </div> --}}
                        <!-- End of Collapsible Widget -->

                        <!-- Start of Collapsible Widget -->
                        {{-- <div class="widget widget-collapsible">
                            <h3 class="widget-title"><span>رنگ </span></h3>
                            <ul class="widget-body filter-items item-check">
                                <li><a href="#">سیاه</a></li>
                                <li><a href="#">آبی</a></li>
                                <li><a href="#">قهوه ای</a></li>
                                <li><a href="#">سبز </a></li>
                                <li><a href="#">خاکستری </a></li>
                                <li><a href="#">نارنجی </a></li>
                                <li><a href="#">زرد </a></li>
                            </ul>
                        </div> --}}
                        <!-- End of Collapsible Widget -->
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary btn-rounded">اعمال فیلتر</a>
                        </div>
                    </div>
                    
                </form>            
                <!-- End of Sidebar Content -->
            </aside>
            <!-- End of Shop Sidebar -->
        </div>
        <!-- End of Shop Content -->
    </div>
    </div>
    <!-- End of Page Content -->
</main>


<script src="{{asset('frontend/assets/js/shopQuickView.js')}}"></script>
<script src="{{asset('frontend/assets/js/shopDetailAjaxCard.js')}}"></script>
<script src="{{asset('frontend/assets/js/shopFilter.js')}}"></script>
<script src="{{asset('frontend/assets/js/categoryPageDescription.js')}}"></script>

<script src="{{asset('frontend/assets/plugins/leaflet/leafletYelsuFrontend.js')}}"></script>


@endsection