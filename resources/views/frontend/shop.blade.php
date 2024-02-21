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
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/road.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال ماشین آلات راه و معدن</p>
                    </a>
                </div>
            </div> 
        @elseif($root_catgory_obj && $root_catgory_obj->id == 8)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/industrial-2.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com7">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال تجهیزات صنایع</p>
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
        @elseif($root_catgory_obj && $root_catgory_obj->id == 1405)
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
                style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/chemical.jpg')}});">
                
                <div class="container banner-content d-flex">
                    <a href="https://t.me/yelsu_com">
                        <p class="telegram_channel"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/>کانال صنایع شیمیایی و وابسته</p>
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
    <div class="container">
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
               
                @if(Route::currentRouteName() == "shop.category" && !$category->child()->get()->count())
                    {{-- برای حذف دکمه فیلتر در صفحه آخرین دسته بندی --}}
                @else
                    <nav class="toolbox sticky-toolbox sticky-content fix-top">
                        <div class="toolbox-left">
                            <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle btn-icon-left">
                                <i class="w-icon-category"></i>
                                <span>فیلتر ها </span>
                            </a>
                        </div>
                    </nav>
                @endif
                
                {{-- برای حذف تایل محصولات در دسته بندی آخر صفحه دسته بندی ها --}}
                @if(count($products) && (Route::currentRouteName() == "shop.category" ? $category->child()->get()->count() : true))
                    <div class="product-wrapper row cols-xl-8 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                        @foreach ($products as $product)

                            @if($product->status == 'active')
                                <div class="product-wrap">
                                    <span class="imge_url d-none">{{!empty($product->product_thumbnail) ? asset($product->product_thumbnail) : asset('storage/upload/no_image.jpg') }}</span>
                                    <span class="product_code d-none">{{$product->product_code ?? ''}}</span>
                                    <span class="short_desc d-none">{!! $product->short_desc ?? '' !!}</span>
                                    <span class="product_id d-none">{!! $product->id ?? '' !!}</span>

                                    <input type="hidden" class="product_min" value="{!! App\Services\Products\Attributes\GetAttributeValueByKeywordEagered::getAttributeValue($product, 'min') ?: 1 !!}">
                                    <input type="hidden" class="product_max" value="{!! App\Services\Products\Attributes\GetAttributeValueByKeywordEagered::getAttributeValue($product, 'max') ?: 10000 !!}">
                                    
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
                                                <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                                    title="نمایش سریع"></a>
                                            </div>
                                            @endif
                                        </figure>
                                        <div class="product-details">
                                            <div class="product-cat">
                                                @if($product->parent_category_name)
                                                    <a href="{{route('shop.category', ['id'=> $product->parent_category_id])}}">{{$product->parent_category_name}}</a>
                                                @else
                                                    <a href="">{{'بدون دسته بندی'}}</a>
                                                @endif
                                            </div>
                                            <h3 class="product-name">
                                                @if ($product->trading_method == 'internal')
                                                    <a href="{{route('product.details', $product->product_slug)}}">{{$product->product_name}}</a>
                                                @else
                                                    <a href="{{route('product.details', $product->product_slug)}}">{{$product->product_name}} <label class="product-label label-hot">ارزی</label></a>
                                                @endif
                                            </h3>
                                            
                                            <div class="product-pa-wrapper">
                                                <div class="product-price">
                                                    @if ($product->single_price_with_commission == 0)
                                                        <div class="product-price">
                                                            <a href="tel:02126402540">
                                                                <i class="w-icon-phone"></i>
                                                                تماس بگیرید
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="d-flex align-items-center pt-2 pb-2">
                                                            {{number_format($product->single_price_with_commission, 0, '', ',')}} {{$product->determine_product_currency()}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>     

                @elseif(Route::currentRouteName() != "shop.category")
                    <div class="text-center">
                        <h2>هیچ محصولی یافت نشد</h2>
                    </div>
                @endif

                @if(Route::currentRouteName() == "shop" || Route::currentRouteName() == "search.products")
                    <div class="toolbox toolbox-pagination d-flex justify-content-center mt-5">
                        {{$products->withQueryString()->links('vendor.pagination.custom') }}
                    </div>
                @endif
                
                {{-- برای حذف صفحه گذاری روی صفحه دسته بندی آخر که جدول میاد --}}
                @if(Route::currentRouteName() == "shop.category" && $category->child()->get()->count())
                    <div class="toolbox toolbox-pagination d-flex justify-content-center mt-5">
                        {{$products->withQueryString()->links('vendor.pagination.custom') }}
                    </div>
                @endif

                <!-- بخش مربوط به جدول محصولات --> 
                @if(Route::currentRouteName() == "shop.category" && !$category->child()->get()->count())
                    @if(count(App\Models\Category::find((int) request('id'))->attributes))

                        <input type="hidden" id="page_category_id" value={{((int) request('id'))}}>

                        <div id="tables-loading-spinner" style="display:none;">
                            <h4 class="mt-0 mb-0">&nbsp;&nbsp;در حال بارگذاری جدول&nbsp;&nbsp;</h4>
                            <span class="loader"></span>
                        </div>
                        
                        <div id="yelsuProductPriceTables"></div>

                        {{-- @foreach ($sort_products_by_last_vendor as $user_id => $product_object_array)
                            <div style="max-width: 1200px; margin-left: auto; margin-right: auto;">
                                <div class="yelsuDataTablesHead d-flex align-items-center">
                                    <div class="vendor-image-div">

                                        <!-- جدول مربوط به کاربر تامین کننده --> 
                                        @if($user_id != 0 && App\Models\User::find($user_id)->role == "vendor")

                                            @if(!empty(App\Models\User::find($user_id)->photo))
                                                <a href="{{route('vendor.details', $user_id)}}">
                                                    <img alt="Logo" src="{{url('storage/upload/vendor_images/' . App\Models\User::find($user_id)->photo)}}"/>
                                                </a>
                                            @else
                                                <img alt="Logo" src="{{asset('frontend/assets/images/demos/demo13/logo_cropped.png')}}"/>
                                            @endif

                                            <a href="{{route('vendor.details', $user_id)}}">{{App\Models\User::find($user_id)->shop_name}} - قیمت {{App\Models\Category::find((int) request('id'))->category_name}}</a>

                                        <!-- جدول مربوط به کاربر بازرگان --> 
                                        @elseif($user_id != 0 && App\Models\User::find($user_id)->role == "merchant")

                                            @if(!empty(App\Models\User::find($user_id)->photo))
                                                <a href="{{route('merchant.details', $user_id)}}">
                                                    <img alt="Logo" src="{{url('storage/upload/merchant_images/' . App\Models\User::find($user_id)->photo)}}"/>
                                                </a>
                                            @else
                                                <img alt="Logo" src="{{asset('frontend/assets/images/demos/demo13/logo_cropped.png')}}"/>
                                            @endif

                                            <a href="{{route('merchant.details', $user_id)}}">{{App\Models\User::find($user_id)->shop_name}} - قیمت {{App\Models\Category::find((int) request('id'))->category_name}}</a>

                                        <!-- جدول مربوط به کاربر خرده فروش --> 
                                        @elseif($user_id != 0 && App\Models\User::find($user_id)->role == "retailer")

                                            @if(!empty(App\Models\User::find($user_id)->photo))
                                                <a href="{{route('retailer.details', $user_id)}}">
                                                    <img alt="Logo" src="{{url('storage/upload/retailer_images/' . App\Models\User::find($user_id)->photo)}}"/>
                                                </a>
                                            @else
                                                <img alt="Logo" src="{{asset('frontend/assets/images/demos/demo13/logo_cropped.png')}}"/>
                                            @endif

                                            <a href="{{route('retailer.details', $user_id)}}">{{App\Models\User::find($user_id)->shop_name}} - قیمت {{App\Models\Category::find((int) request('id'))->category_name}}</a>

                                        <!-- جدول مربوط به محصولات خود یلسو --> 
                                        @elseif($user_id == 0)

                                            <img alt="Logo" src="{{asset('frontend/assets/images/demos/demo13/logo_cropped.png')}}"/>  

                                            <a href="">یلسو - قیمت {{App\Models\Category::find((int) request('id'))->category_name}}</a>

                                        @endif

                                    </div>

                                    <div class="value-added-tax-div">
                                        <input type="checkbox" class="value_added_tax_btn">
                                        <label for="value_added_tax">نمایش قیمت با ارزش افزوده</label>
                                    </div>
                                </div>
                                <div class="product-wrapper row">
                                    <div class="product-wrap">
                                        <div class="product text-center">
                                            <table class="display yelsuDataTables" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ردیف</th>
                                                        <th class="all text-center">نام محصول</th>
                                                        @foreach (App\Models\Category::find((int) request('id'))->attributes->first()->items->where('show_in_table_page', 1)->sortBy('attribute_item_order', SORT_NUMERIC) as $attribute_header_key => $attribute_header_items)
                                                            <th class="text-center">
                                                                {{$attribute_header_items->attribute_item_name}} 
                                                            </th> 
                                                        @endforeach
                                                        <th class="all text-center">قیمت</th>
                                                        <th class="text-center">اطلاعات بیشتر</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product_object_array as $product_key => $product_item)
                                                        <tr>
                                                            <td>{{ $product_key + 1}}</td>
                                                            <td>
                                                                <a href="{{route('product.details', $product_item->product_slug)}}">
                                                                    {{$product_item->product_name}}
                                                                </a>
                                                            </td>
                                                            @foreach (App\Models\Category::find((int) request('id'))->attributes->first()->items->where('show_in_table_page', 1)->sortBy('attribute_item_order', SORT_NUMERIC) as $attribute_row_key => $attribute_row_items)
                                                                <td>
                                                                    @if(in_array($attribute_row_items->id, $product_item->table_attribute_items_obj_array()->keys()->toArray()))
                                                                        @if ($attribute_row_items->attribute_item_type == "dropdown")
                                                                            {{collect($product_item->table_attribute_items_obj_array()[$attribute_row_items->id]['attribute_value_obj'])->pluck('value')->join('، ')}} 
                                                                        @else
                                                                            {{$product_item->table_attribute_items_obj_array()[$attribute_row_items->id]['attribute_value']}} 
                                                                        @endif
                                                                    @else 
                                                                        ناموجود
                                                                    @endif
                                                                </td> 
                                                            @endforeach
                                                            @if($product_item->single_price_with_commission != 0)
                                                                <input type="hidden" value="{{$product_item->single_price_with_commission}}" class="price_before_value_added_tax">
                                                                <input type="hidden" value="{{$product_item->determineProductValueAddedTaxByPercent()}}" class="price_after_value_added_tax">
                                                                <td>
                                                                    <span class="price_tag">{{number_format($product_item->single_price_with_commission, 0, '', ',')}}</span> {{$product_item->determine_product_currency()}}
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <a href="tel:02126402540">
                                                                        تماس بگیرید
                                                                    </a>
                                                                </td>
                                                            @endif
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}
                        
                    @endif
                @endif
                <!-- پایان بخش مربوط به جدول محصولات --> 
                
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
                                @if (count($megaMenuCategoriesMobile))
                                    @foreach ($megaMenuCategoriesMobile as $category)
                                        <li class="filterButtonShopPage rootCat">
                                            <input type="checkbox" name="category_{{$category['category_id']}}" value="{{$category['category_id']}}" {{in_array($category['category_id'], $inputArray) ? 'checked' : ''}}> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category['category_name']}} {{count($category['child']) ? "(".count($category['child'])." زیر دسته)" : ''}}
                                        </li>
                                        <div class="subCategoryBtn subCatGroup">
                                            @include('frontend.body.layout.shop-page-filter.categories-group', ['categories' => $category['child']])
                                        </div>
                                    @endforeach
                                @else   
                                    <li><a href="">دسته بندی یافت نشد</a></li>
                                @endif
                            </ul>
                        </div>
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

{{-- بارگذاری فایل ایجکس برای لودینگ جداول در صفحه دسته بندی آخر --}}
@if(Route::currentRouteName() == "shop.category")
    @if(count(App\Models\Category::find((int) request('id'))->attributes) && !App\Models\Category::find((int) request('id'))->child()->get()->count() && count(App\Models\Category::find((int) request('id'))->products))
        <script src="{{asset('frontend/assets/plugins/datatables/yelsuFetchTablesAjax.js')}}"></script>
    @endif
@endif      


@endsection