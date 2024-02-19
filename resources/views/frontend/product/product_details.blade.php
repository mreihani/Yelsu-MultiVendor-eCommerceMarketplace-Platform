@extends('frontend.main_theme')
@section('main')

<main class="main mb-10 pb-1">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav container">
        <ul class="breadcrumb bb-no">
            <li><a href="{{URL::to('/')}}">خانه </a></li>
            <li>{{$product->product_name}}</li>
        </ul>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">

            @if(session()->has('success'))
                <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5  mt-5 mb-5">
                    <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
                </div>
            @endif

            <div class="row gutter-lg">
                <div class="main-content">
                    <div class="product product-single row">
                        <div class="col-md-6 mb-6">
                            <div class="product-gallery product-gallery-sticky">
                                <div class="swiper-container product-single-swiper swiper-theme nav-inner" data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    }
                                }">
                                    <div class="swiper-wrapper row cols-1 gutter-no">
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="{{!empty($product->product_thumbnail) ? asset($product->product_thumbnail) : asset('storage/upload/no_image.jpg') }}"
                                                    data-zoom-image="{{!empty($product->product_thumbnail) ? asset($product->product_thumbnail) : asset('storage/upload/no_image.jpg') }}"
                                                    alt="{{$product->product_name}}" width="800" height="900">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-6">
                            <div class="product-details" data-sticky-options="{'minWidth': 767}">

                                @if($product->product_qty > 0 || $product->unlimitedStock == 'active' || $product->product_qty == NULL)
                                    <label class="product-label label-new">موجود</label>
                                @else
                                    <label class="product-label label-discount">عدم موجودی</label>
                                @endif

                                <div class="d-flex align-items-center pt-2 pb-2">
                                    @if ($product->trading_method == 'internal')
                                        <h1 class="product-title">{{$product->product_name}}</h1>
                                    @else
                                        <h1 class="product-title">{{$product->product_name}} <label class="product-label label-hot">ارزی</label></h1>
                                    @endif
                                </div>

                                <div class="product-bm-wrapper">
                                    <figure class="brand">
                                        @if($product->vendor_id)
                                            <a href="{{route('vendor.details', $product->vendor->id)}}">
                                                <img width="102" height="48" src="{{!empty($product->vendor->photo) ? url('storage/upload/vendor_images/' . $product->vendor->photo) : url('storage/upload/no_image.jpg') }}" alt="user" />
                                            </a>
                                        @else
                                            <img src="{{asset('frontend/assets/images/demos/demo13/logo.png')}}" alt="Brand"
                                            width="102" height="48" />
                                        @endif    
                                    </figure>
                                    <div class="product-meta">
                                        <div class="product-categories">
                                            دسته بندی: 
                                            <span class="product-category"><a href="{{route('shop.category',['id'=> $product->parent_category_id])}}">{{!empty($category->category_name) ? $category->category_name : 'بدون دسته بندی'}} </a></span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="product-divider">

                                @if ($product->price_with_commission == 0 && !count($product->outlets))
                                    <div class="product-price">
                                        <a href="tel:02126402540">
                                            <i class="w-icon-phone"></i>
                                            تماس بگیرید
                                        </a>
                                    </div>
                                @else

                                    @if(count($product->outlets)) 
                                        <div class="row">
                                            <h5>
                                                لطفا با توجه به موقعیت مکانی تأمین کننده قیمت را انتخاب کنید
                                            </h5>
                                        </div>
                                    @endif

                                    <div class="d-flex align-items-center pt-2 pb-2">
                                        <!-- Start of variable product -->
                                        <div class="row gutter-sm" style="width: 100%;">
                                            @if(count($product->outlets)) 
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="select-box">
                                                            <select name="outlet_id" class="form-control form-control-md">
                                                                @foreach ($product->outlets as $outlet_item)
                                                                    <option value="{{$outlet_item->id}}">
                                                                        {{$outlet_item->shop_name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if(count($product->outlets))
                                                <div class="col-md-6">
                                                    @foreach ($product->outlets as $key => $outlet_item)
                                                        <div class="product-price {{$key == 0 ? '' : 'd-none'}}" id="outlet-{{$outlet_item->id}}">
                                                            <ins class="new-price">
                                                                @if($varible_product_price = App\Models\Product::calculatePriceWithCommission($outlet_item->pivot->selling_price, $product))
                                                                    {{number_format($varible_product_price, 0, '', ',')}} 
                                                                    {{$product->determine_product_currency()}} 
                                                                @else
                                                                    <a href="tel:02126402540">
                                                                        <i class="w-icon-phone"></i>
                                                                        تماس بگیرید
                                                                    </a>
                                                                @endif
                                                            </ins>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else 
                                                <div class="col-md-12">
                                                    <div class="product-price">
                                                        <ins class="new-price">{{number_format($product->price_with_commission, 0, '', ',')}} {{$product->determine_product_currency()}} </ins>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- End of variable product -->
                                    </div>
                                @endif
                                
                                <div class="product-short-desc">
                                    <span class="list-type-check">
                                       {!! $product->short_desc !!}
                                    </span>   
                                </div>

                                <hr class="product-divider">

                                <!-- Start of Attributes -->
                                <h4>مشخصات</h4>
                                {{-- برای ویژگی های غیر چندگانه --}}
                                @foreach ($product->attribute_items_obj_array() as $attribute_value_item_key => $attribute_value_array)
                                    @if(count($attribute_value_array['attribute_value_obj']) == 1 && App\Models\AttributeItem::find($attribute_value_item_key)->show_in_product_page && App\Models\AttributeItem::find($attribute_value_item_key)->attribute_item_keyword != "currency")
                                        <div class="d-flex align-items-center details-page-attribute-list">

                                            <span>
                                                {{App\Models\AttributeItem::find($attribute_value_item_key)->attribute_item_name}}
                                            </span>

                                            @foreach ($attribute_value_array['attribute_value_obj'] as $attribute_value_item)
                                                @if(App\Models\AttributeItem::find($attribute_value_item_key)->attribute_item_type == 'dropdown')
                                                    <span>
                                                        {{$attribute_value_item->value}}
                                                    </span>
                                                @else
                                                    <span>
                                                        {{$attribute_value_array['attribute_value']}}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach    

                                {{-- برای ویژگی های چندگانه --}}
                                @foreach ($product->attribute_items_obj_array() as $attribute_value_item_key => $attribute_value_array)
                                    @if(count($attribute_value_array['attribute_value_obj']) > 1 && App\Models\AttributeItem::find($attribute_value_item_key)->show_in_product_page && App\Models\AttributeItem::find($attribute_value_item_key)->attribute_item_keyword != "currency")
                                        <div class="product-form product-variation-form product-size-swatch details-page-attribute-list-multiple">

                                            <span>
                                                {{App\Models\AttributeItem::find($attribute_value_item_key)->attribute_item_name}}
                                            </span>

                                            <span class="flex-wrap d-flex align-items-center justify-content-center product-variations">
                                                @foreach ($attribute_value_array['attribute_value_obj'] as $attribute_value_item)
                                                    <a href="#" class="size">{{$attribute_value_item->value}} </a>
                                                @endforeach
                                            </span>
                                            
                                        </div>
                                    @endif
                                @endforeach    
                                <!-- End of Attributes -->

                                <div class="fix-bottom product-sticky-content sticky-content mt-4">
                                    <div class="product-form container">
            
                                        @if ($product->trading_method == 'internal')
                                            <div class="product-qty-form">
                                                <div class="input-group">
                                                    <input id="quantityInputvalue" class="quantity form-control" type="number" min="{{$product->determine_product_min()}}" max="{{$product->determine_product_max()}}">
                                                    <button class="quantity-plus w-icon-plus"></button>
                                                    <button class="quantity-minus w-icon-minus"></button>
                                                </div>
                                            </div>

                                            @if(App\Helpers\Cart\Cart::count($product) < $product->product_qty || $product->product_qty == NULL || $product->unlimitedStock == 'active')
                                                <button onclick="updateCartFunction({{$product->id}})" class="btn btn-primary btn-cart">
                                                    <i class="w-icon-cart"></i>
                                                    <span>افزودن به سبد</span>
                                                </button>   
                                            @endif    
                                        @else
                                            <form class="d-flex align-items-center flex-1" method="GET" action="{{route('exportcheckout')}}">
                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                <div class="product-qty-form mb-0">
                                                    <div class="input-group">
                                                        <input id="quantityInputvalue" name="quantity" class="quantity form-control" type="number" min="1" max="10000000">
                                                        <button type='button' class="quantity-plus w-icon-plus"></button>
                                                        <button type='button' class="quantity-minus w-icon-minus"></button>
                                                    </div>
                                                </div>
                                                <button type='submit' class="btn btn-primary ">
                                                    <i class="w-icon-orders"></i>
                                                    <span>ثبت سفارش</span>
                                                </button>   
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <i class="fa fa-telegram" aria-hidden="true"></i>
                                <div class="social-links-wrapper">
                                    <div class="social-links">
                                        <div class="social-icons social-no-color border-thin">
                                            <a href="{{'https://twitter.com/intent/tweet?&url=' . url()->full()}}" class="social-icon social-twitter w-icon-twitter"></a>
                                            <a href="{{'https://telegram.me/share/url?url=' . url()->full()}}"
                                                class="social-icon social-youtube">
                                                <svg style="margin-top: 6px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/> </svg>
                                            </a>
                                            <a href="{{'https://wa.me/?text=' . url()->full()}}" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                            <a href="{{'https://www.linkedin.com/sharing/share-offsite/?url=' . url()->full()}}"
                                                class="social-icon social-youtube fab fa-linkedin-in"></a>
                                            <a href="{{'https://eitaa.com/share/url?url=' . url()->full()}}"
                                                class="social-icon social-eitaa">
                                                <svg style="margin-top: 7px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="16" height="16"><path d="m5.968 23.942a6.624 6.624 0 0 1 -2.332-.83c-1.62-.929-2.829-2.593-3.217-4.426-.151-.717-.17-1.623-.15-7.207.019-6.009.005-5.699.291-6.689.142-.493.537-1.34.823-1.767 1.055-1.57 2.607-2.578 4.53-2.943.384-.073.94-.08 6.056-.08 6.251 0 6.045-.009 7.066.314a6.807 6.807 0 0 1 4.314 4.184c.33.937.346 1.087.369 3.555l.02 2.23-.391.268c-.558.381-1.29 1.06-2.316 2.15-1.182 1.256-2.376 2.42-2.982 2.907-1.309 1.051-2.508 1.651-3.726 1.864-.634.11-1.682.067-2.302-.095-.553-.144-.517-.168-.726.464a6.355 6.355 0 0 0 -.318 1.546l-.031.407-.146-.03c-1.215-.241-2.419-1.285-2.884-2.5a3.583 3.583 0 0 1 -.26-1.219l-.016-.34-.309-.284c-.644-.59-1.063-1.312-1.195-2.061-.212-1.193.34-2.542 1.538-3.756 1.264-1.283 3.127-2.29 4.953-2.68.658-.14 1.818-.177 2.403-.075 1.138.198 2.067.773 2.645 1.639.182.271.195.31.177.555a.812.812 0 0 1 -.183.493c-.465.651-1.848 1.348-3.336 1.68-2.625.585-4.294-.142-4.033-1.759.026-.163.04-.304.031-.313-.032-.032-.293.104-.575.3-.479.334-.903.984-1.05 1.607-.036.156-.05.406-.034.65.02.331.053.454.192.736.092.186.275.45.408.589l.24.251-.096.122a4.845 4.845 0 0 0 -.677 1.217 3.635 3.635 0 0 0 -.105 1.815c.103.461.421 1.095.739 1.468.242.285.797.764.886.764.024 0 .044-.048.044-.106.001-.23.184-.973.326-1.327.423-1.058 1.351-1.96 2.82-2.74.245-.13.952-.47 1.572-.757 1.36-.63 2.103-1.015 2.511-1.305 1.176-.833 1.903-2.065 2.14-3.625.086-.57.086-1.634 0-2.207-.368-2.438-2.195-4.096-4.818-4.37-2.925-.307-6.648 1.953-8.942 5.427-1.116 1.69-1.87 3.565-2.187 5.443-.123.728-.169 2.08-.093 2.75.193 1.704.822 3.078 1.903 4.156a6.531 6.531 0 0 0 1.87 1.313c2.368 1.13 4.99 1.155 7.295.071.996-.469 1.974-1.196 3.023-2.25 1.02-1.025 1.71-1.88 3.592-4.458 1.04-1.423 1.864-2.368 2.272-2.605l.15-.086-.019 3.091c-.018 2.993-.022 3.107-.123 3.561-.6 2.678-2.54 4.636-5.195 5.242l-.468.107-5.775.01c-4.734.008-5.85-.002-6.19-.056z"/></svg>
                                            </a>
                                            {{-- <a href="{{'https://www.instagram.com/?url=' . url()->full()}}"
                                                class="social-icon social-instagram w-icon-instagram"></a> --}}
                                        </div>
                                    </div>
                                    {{-- <span class="divider d-xs-show"></span>
                                    <div class="product-link-wrapper d-flex">
                                        <a href="#"
                                            class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                                        <a href="#"
                                            class="btn-product-icon btn-compare btn-icon-left w-icon-compare"><span></span></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#product-tab-description" class="nav-link active">توضیحات</a>
                            </li>

                            @if($product->specification)
                            <li class="nav-item">
                                <a href="#product-tab-specification" class="nav-link">مشخصات </a>
                            </li>
                            @endif

                            @if($product['vendor'] != NULL && $product['vendor']['role'] == 'vendor' && $product['vendor']['vendor_description'] && $product['vendor']['vendor_description_status'] == 'active')
                            <li class="nav-item">
                                <a href="#product-tab-vendor" class="nav-link">اطلاعات تأمین کننده </a>
                            </li>
                            @endif

                            @if($product['merchant'] != NULL && $product['merchant']['role'] == 'merchant' && $product['merchant']['vendor_description'] && $product['merchant']['vendor_description_status'] == 'active')
                            <li class="nav-item">
                                <a href="#product-tab-vendor" class="nav-link">اطلاعات بازرگان </a>
                            </li>
                            @endif

                            @if($product['retailer'] != NULL && $product['retailer']['role'] == 'retailer' && $product['retailer']['vendor_description'] && $product['retailer']['vendor_description_status'] == 'active')
                            <li class="nav-item">
                                <a href="#product-tab-vendor" class="nav-link">اطلاعات فروشنده</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="product-tab-description">
                                <div class="row mb-4">
                                    {!! $product->long_desc !!}
                                </div>
                            </div>
                            <div class="tab-pane" id="product-tab-specification">
                                {!! $product->specification !!}
                            </div>

                            @if($product['vendor'] != NULL && $product['vendor']['role'] == 'vendor' && $product['vendor']['vendor_description']  && $product['vendor']['vendor_description_status'] == 'active')
                            <div class="tab-pane" id="product-tab-vendor">
                                <div class="row">
                                    <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                        <div class="vendor-user">
                                            <figure class="vendor-logo mr-4">
                                                <a href="{{route('vendor.details', $product['vendor']['id'])}}">
                                                    <img src="{{!empty($product['vendor']['photo']) ? asset('storage/upload/vendor_images/' . $product['vendor']['photo']) : asset('storage/upload/no_image.jpg') }}"
                                                        alt="Vendor Logo" width="80" height="80" />
                                                </a>
                                            </figure>
                                            <ul class="vendor-info list-style-none mb-0">
                                                <li class="store-name">
                                                    <label>نام فروشگاه:</label>
                                                    <span class="detail">{{$product['vendor']['shop_name']}}</span>
                                                </li>
                                                <li class="store-address">
                                                    <label>آدرس: </label>
                                                    <span class="detail">{{$product['vendor']['shop_address']}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="{{route('vendor.details', $product['vendor']['id'])}}"
                                            class="btn btn-dark btn-link btn-underline btn-icon-right">نمایش فروشگاه<i class="w-icon-long-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <p class="mb-5">
                                    {!! $product['vendor']['vendor_description'] !!}
                                </p>
                            </div>
                            @endif

                            @if($product['merchant'] != NULL && $product['merchant']['role'] == 'merchant' && $product['merchant']['vendor_description']  && $product['merchant']['vendor_description_status'] == 'active')
                            <div class="tab-pane" id="product-tab-vendor">
                                <div class="row">
                                    <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                        <div class="vendor-user">
                                            <figure class="vendor-logo mr-4">
                                                <a href="{{route('merchant.details', $product['merchant']['id'])}}">
                                                    <img src="{{!empty($product['merchant']['photo']) ? asset('storage/upload/merchant_images/' . $product['merchant']['photo']) : asset('storage/upload/no_image.jpg') }}"
                                                        alt="Vendor Logo" width="80" height="80" />
                                                </a>
                                            </figure>
                                            <ul class="vendor-info list-style-none mb-0">
                                                <li class="store-name">
                                                    <label>نام بازرگان:</label>
                                                    <span class="detail">{{$product['merchant']['shop_name']}}</span>
                                                </li>
                                                <li class="store-address">
                                                    <label>آدرس: </label>
                                                    <span class="detail">{{$product['merchant']['shop_address']}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="{{route('merchant.details', $product['merchant']['id'])}}"
                                            class="btn btn-dark btn-link btn-underline btn-icon-right">درباره بازرگان<i class="w-icon-long-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <p class="mb-5">
                                    {!! $product['merchant']['vendor_description'] !!}
                                </p>
                            </div>
                            @endif

                            @if($product['retailer'] != NULL && $product['retailer']['role'] == 'retailer' && $product['retailer']['vendor_description']  && $product['retailer']['vendor_description_status'] == 'active')
                            <div class="tab-pane" id="product-tab-vendor">
                                <div class="row">
                                    <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                        <div class="vendor-user">
                                            <figure class="vendor-logo mr-4">
                                                <a href="{{route('retailer.details', $product['retailer']['id'])}}">
                                                    <img src="{{!empty($product['retailer']['photo']) ? asset('storage/upload/retailer_images/' . $product['retailer']['photo']) : asset('storage/upload/no_image.jpg') }}"
                                                        alt="Vendor Logo" width="80" height="80" />
                                                </a>
                                            </figure>
                                            <ul class="vendor-info list-style-none mb-0">
                                                <li class="store-name">
                                                    <label>نام فروشنده:</label>
                                                    <span class="detail">{{$product['retailer']['shop_name']}}</span>
                                                </li>
                                                <li class="store-address">
                                                    <label>آدرس: </label>
                                                    <span class="detail">{{$product['retailer']['shop_address']}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="{{route('retailer.details', $product['retailer']['id'])}}"
                                            class="btn btn-dark btn-link btn-underline btn-icon-right">درباره فروشنده<i class="w-icon-long-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <p class="mb-5">
                                    {!! $product['retailer']['vendor_description'] !!}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <section class="vendor-product-section">
                        <div class="title-link-wrapper mb-4">
                            <h4 class="title text-left">محصولات مرتبط</h4>
                            <a href="{{route('shop.category',['id'=> $root_catgory_obj->id])}}" class="btn btn-dark btn-link btn-slide-right btn-icon-right">محصولات بیشتر<i class="w-icon-long-arrow-left"></i></a>
                        </div>
                        <div class="swiper-container swiper-theme" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 4
                                },
                                '992': {
                                    'slidesPerView': 5
                                }
                            }
                        }">
                            <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">

                                @foreach ($relatedProducts->take(8) as $relatedProduct)
                                <div class="swiper-slide product">
                                    <figure class="product-media">
                                        <a href="{{route('product.details', $relatedProduct->product_slug)}}">
                                            <img src="{{!empty($relatedProduct->product_thumbnail) ? asset($relatedProduct->product_thumbnail) : asset('storage/upload/no_image.jpg') }}" alt="Product"
                                                width="300" height="338" />
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <div class="product-cat"><a href="{{route('shop.category',['id'=> $relatedProduct->parent_category_id])}}">{{App\Models\Category::find($relatedProduct->parent_category_id)->category_name}}</a>
                                        </div>
                                        <h4 class="product-name"><a href="{{route('product.details', $relatedProduct->product_slug)}}">{{$relatedProduct->product_name}}</a>
                                        </h4>
                                      
                                        <div class="product-pa-wrapper">
                                            @if ($relatedProduct->price_with_commission == 0)
                                                <div class="product-price">
                                                    <a href="tel:02126402540">
                                                        <i class="w-icon-phone"></i>
                                                        تماس بگیرید
                                                    </a>
                                                </div>
                                            @else
                                                <div class="product-price">
                                                    {{number_format($relatedProduct->price_with_commission, 0, '', ',')}} {{$relatedProduct->determine_product_currency()}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </section>
                   
                    @if(sizeof($recently_viewed_product_arr))
                    <section class="related-product-section">
                        <div class="title-link-wrapper mb-4">
                            <h4 class="title">بازدیدهای اخیر </h4>
                            <a href="{{URL::to('/shop')}}" class="btn btn-dark btn-link btn-slide-right btn-icon-right">محصولات بیشتر<i class="w-icon-long-arrow-left"></i></a>
                        </div>
                        <div class="swiper-container swiper-theme" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 4
                                },
                                '992': {
                                    'slidesPerView': 5
                                }
                            }
                        }">
                        <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                            @foreach($recently_viewed_product_arr[0] as $recently_viewed_product_item)
                            <div class="swiper-slide product">
                                <figure class="product-media">
                                    <a href="{{route('product.details', $recently_viewed_product_item->product_slug)}}">
                                        <img src="{{!empty($recently_viewed_product_item->product_thumbnail) ? asset($recently_viewed_product_item->product_thumbnail) : asset('storage/upload/no_image.jpg') }}" alt="Product"
                                            width="300" height="338" />
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="{{route('product.details', $recently_viewed_product_item->product_slug)}}">{{$recently_viewed_product_item->product_name}}</a></h4>
                                    <div class="product-pa-wrapper">
                                        <div class="product-pa-wrapper">
                                            @if ($recently_viewed_product_item->price_with_commission == 0)
                                                <div class="product-price">
                                                    <a href="tel:02126402540">
                                                        <i class="w-icon-phone"></i>
                                                        تماس بگیرید
                                                    </a>
                                                </div>
                                            @else
                                                <div class="product-price">{{number_format($recently_viewed_product_item->price_with_commission, 0, '', ',')}} {{$recently_viewed_product_item->determine_product_currency()}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        </div>
                    </section>
                    @endif

                    {{-- Steps from order to delivery of goods --}}
                    <section class="mt-5 pt-5 orderProcessingSteps">
                        <h2 class="title title-underline">مراحل سفارش تا تحویل کالا</h2>
                        <p>مراحل کلی سفارش تا تحویل کالا بصورت زیر انجام می‌گردد.</p>
                        <div class="processingContainer">
                            <div>
                                <figure>
                                <img width="400" height="300" src="{{asset('frontend/assets/images/products/order_steps/request.png')}}" alt="">
                                </figure>
                                <div>
                                    <h5>درخواست خرید</h5>
                                    <p>جهت درخواست خرید یا مشاوره هر محصول با کارشناس مربوط به آن محصول تماس حاصل فرمایید یا از طریق سایت درخواست خرید نمایید.</p>
                                </div>
                            </div>   
                            <div>
                                <figure>
                                <img width="400" height="300" src="{{asset('frontend/assets/images/products/order_steps/pre_factor.png')}}" alt="">
                                </figure>
                                <div>
                                    <h5>صدور پیش فاکتور</h5>
                                    <p>پس از بررسی کارشناس بخش، درصورت عدم وجود مشکل پیش فاکتور صادر می‌گردد. در صورت زمان‌بر بودن درخواست سریعاً اطلاع رسانی خواهد شد.</p>
                                </div>
                            </div>     
                            <div>
                                <figure>
                                <img width="400" height="300" src="{{asset('frontend/assets/images/products/order_steps/checkout.png')}}" alt="">
                                </figure>
                                <div>
                                    <h5>تسویه حساب</h5>
                                    <p>بر اساس مفاد پیش فاکتور، درخواست قبلی و توافق حاصله تسویه حساب به صورت نقدی، اعتباری و یا تأمین سرمایه خرید کالا انجام می‌شود.</p>
                                </div>
                            </div>    
                            <div>
                                <figure>
                                <img width="400" height="300" src="{{asset('frontend/assets/images/products/order_steps/quality_control.png')}}" alt="">
                                </figure>
                                <div>
                                    <h5>کنترل کیفیت</h5>
                                    <p>کارشناس بخش مربوطه با دقت فراوان، کیفیت محصول مورد نظر را بررسی می‌نماید. در صورت عدم مغایرت با استانداردها، مجوز بارگیری صادر می‌گردد.</p>
                                </div>
                            </div>    
                            <div>
                                <figure>
                                <img width="400" height="300" src="{{asset('frontend/assets/images/products/order_steps/loading.png')}}" alt="">
                                </figure>
                                <div>
                                    <h5>بارگیری و حمل کالا</h5>
                                    <p>کالای تأییدشده بر اساس درخواست و توافق اولیه و نرخ مصوب حمل و نقل کالا به مقصد مورد نظر شما ارسال می گردد.</p>
                                </div>
                            </div>     
                            <div>
                                <figure>
                                <img width="400" height="300" src="{{asset('frontend/assets/images/products/order_steps/factor.png')}}" alt="">
                                </figure>
                                <div>
                                    <h5>صدور فاکتور رسمی</h5>
                                    <p>پس از تعیین ارزش دقیق خرید شما، تسویه نهایی صورت گرفته و فاکتور نهایی و رسمی خرید شما چاپ و ارسال می‌گردد.</p>
                                </div>
                            </div>                    
                        </div>
                    </section>
                </div>
                <!-- End of Main Content -->
                <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                    <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                    <div class="sidebar-content scrollable">
                        <div class="sticky-sidebar">
                            <div class="widget widget-icon-box mb-6">
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-truck"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">حمل و نقل / باربری</h4>
                                        <p>برترین شرکت های حمل و نقل</p>
                                    </div>
                                </div>
                                <div class="swiper-slide icon-box icon-box-side text-dark">
                                    <a href="{{route('blog.creditPurchase')}}">
                                        <span class="icon-box-icon icon-payment">
                                            <i class="w-icon-money"></i>
                                        </span>
                                    </a>
                                    <div class="icon-box-content">
                                        <a href="{{route('blog.creditPurchase')}}">
                                            <h4 class="icon-box-title">پرداخت امن / تضمین دریافت</h4>
                                        </a>
                                        <a href="{{route('blog.creditPurchase')}}">
                                            <p class="text-default">ما تضمین می کنیم</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-honour"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">گواهی کیفیت</h4>
                                        <p>هنگام خرید محصول</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Widget Icon Box -->

                            <div class="widget widget-banner mb-9">
                                <div class="banner banner-fixed br-sm">
                                    <figure>
                                        <img src="{{asset('frontend/assets/images/shop/banner3.jpg')}}" alt="Banner" width="266"
                                            height="220" style="background-color: #1D2D44;" />
                                    </figure>
                                </div>
                            </div>
                            <!-- End of Widget Banner -->
                        </div>
                    </div>
                </aside>
                <!-- End of Sidebar -->
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</main>

<script>
    productInitialPriceValue = {!! json_encode($product->determine_product_min()) !!};
</script>

<!-- Change price by location -->
<script>
    let outletSelectElement = $("select[name='outlet_id']");
    let outletSelectElementValue = outletSelectElement.find("option:selected").val();
    window.selectedOutletId = outletSelectElement.length ? outletSelectElementValue : null;

    $(".page-content").on("change", "select[name='outlet_id']", function () {
        let thisElement = $(this);
        selectedOutletId = thisElement.val();
        $(".product-price").each(function (key,value) {

            let element = $(value);
            let elementId = element.attr("id");

            if(("outlet-" + selectedOutletId) == elementId) {
                element.removeClass("d-none");
            } else {
                element.addClass("d-none");
            }
        })
    });
</script>

<script src="{{asset('frontend/assets/js/productDetailAjaxCard.js')}}"></script>

@endsection