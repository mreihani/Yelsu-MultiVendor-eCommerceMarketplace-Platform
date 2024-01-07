@extends('frontend.main_theme')
@section('main')

<script src="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.js"></script>

<!-- SELECT2 initialize -->
<script>
    $(document).ready(function() {
        $('.yelsu-select2-basic-single').select2();
    });
</script>

    <!-- Start of Main -->
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">حساب کاربری</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{URL::to('/')}}">خانه </a></li>
                    <li><a href="{{route('dashboard')}}">حساب من </a></li>
                    <li>سفارش {{$order->id}}#</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->


        <!-- Start of PageContent -->
        <div class="page-content pt-2 shipping-page-content">
            <div class="container">

                @if(session()->has('success'))
                    <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5 mt-5 mb-5">
                        <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
                        <h4 class="alert-title" style="color:#ffa800">
                            <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                            {{session('error')}}
                    </div>
                @endif
                @foreach($errors->all() as $error)
                    <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
                        <h4 class="alert-title" style="color:#ffa800">
                            <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                            {{$error}}
                    </div>
                @endforeach

                <div class="tab-pane active order">

                    <h1 class="title title-center mb-5">حمل و نقل</h1>

                    <div class="row">       
                        <div class="col-12">
                            <div class="shipping">
                                
                                <div class="tab tab-nav-center tab-nav-underline tab-line-grow show-code-action">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach ($products as $key => $product)
                                            <li class="nav-item">
                                                <a href="#tab5-{{$key + 1}}" class="nav-link {{$key == 0 ? 'active' : ''}}">
                                                    <i class="w-icon-verification price-verification-icon d-none" key="{{$key}}"></i>
                                                    {{$product->product_name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">

                                        @foreach ($products as $key => $product)
                                            <div class="tab-pane {{$key == 0 ? 'active in' : ''}}" id="tab5-{{$key + 1}}" key="{{$key}}">
                                                <div class="row pt-5 pb-5 shipping-element d-flex justify-content-center">

                                                    <div class="col-md-11 bg-grey d-flex justify-content-between align-items-center">
            
                                                        <div class="product-item">
                                                            <div class="mt-3">
                                                                <a href="{{route('product.details', $product->product_slug)}}">
                                                                    <img class="product-image" src="{{!empty($product->product_thumbnail_sm) ? asset($product->product_thumbnail_sm) : asset('storage/upload/no_image.jpg') }}" alt="{{$product->product_name}}" />
                        
                                                                    <span class="ml-1 product-name">
                                                                        {{$product->product_name}}
                                                                    </span>
                                                                </a>
                                                            </div>
            
                                                            <h5 class="mt-3">
                                                                تعداد
                                                                خریداری شده:
                                                                
                                                                {{$product->pivot->quantity}}
                                                            </h5>
                                                        </div>
            
                                                        <div>
                                                            <button style="cursor: auto" disabled class="btn btn-sm btn-info btn-ellipse shipping-calculate-btn">محاسبه</button>
                                                        </div>
                                                    </div>
            
                                                    <div class="col-md-3 bg-grey mt-2">
            
                                                        <div class="order-origin-address pt-3">
                                                            <h4>
                                                                تعیین مبدا
                                                            </h4>
            
                                                            <div class="form-group">
                                                                <label>نام مبدا</label>
                                                                <div>
                                                                    <select class="form-control form-control-md vendor-address-information yelsu-select2-basic-single">
                                                                        @foreach($product->determine_product_owner->vendor_outlets as $vendor_outlet)
                                                                            <option value="{{$vendor_outlet->id}}">{{$vendor_outlet->shop_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
            
                                                            <div class="mt-2 tab tab-with-title tab-nav-link pt-2 pb-2">
                                                                <p>
                                                                    <i class="w-icon-map-marker"></i>
                                                                    آدرس:
                                                                    <span class="vendor-address">
                                                                        {{$product->determine_product_owner->vendor_outlets->first()->shop_address}}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <hr class="divider mb-5 mt-5">
            
                                                        <div class="order-destination-address">
                                                            <h4>
                                                                تعیین مقصد
                                                            </h4>
            
                                                            <div class="form-group">
                                                                <label>نام مقصد</label>
                                                                <div>
                                                                    <select class="form-control form-control-md user-address-information yelsu-select2-basic-single">
                                                                            {{-- <option value="">مقصد را انتخاب نمایید</option> --}}
                                                                        @foreach($userData->outlets()->get() as $user_outlet)
                                                                            <option value="{{$user_outlet->id}}">{{$user_outlet->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
            
                                                            <div class="mt-2 tab tab-with-title tab-nav-link pt-2 pb-2">
                                                                <p>
                                                                    <i class="w-icon-map-marker"></i>
                                                                    آدرس:
                                                                    <span class="user-address">
                                                                        {{$userData->outlets()->first()->address}}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            
                                                        </div>
            
                                                        <div class="mt-2 tab tab-with-title pt-2 pb-5">
                                                            <p>
                                                                {{-- فاصله بین مبدا و مقصد: --}}
                                                                <span class="calculated-distance"></span>
                                                            </p>
                                                        </div>
            
                                                    </div>
            
                                                    <div class="col-md-3 bg-grey ml-1 mr-1 pt-3 mt-2 pb-3">
                                                        <div class="order-shipping-service">
                                                            <h4>
                                                                تعیین شرکت باربری
                                                            </h4>
            
                                                            <div class="form-group freightage-company-name">
                                                                <label>نام شرکت باربری</label>
            
                                                                <input type="hidden" class="product_id" value="{{$product->id}}">
            
                                                                <div>
                                                                    <select class="form-control form-control-md freightage-information-dropdown yelsu-select2-basic-single">
                                                                            <option value="">شرکت باربری را انتخاب نمایید</option>
                                                                        @foreach($product->determine_product_owner->verified_freightages_with_vendor_id as $freightage)
                                                                            <option value="{{$freightage->freightage->id}}">{{$freightage->freightage->shop_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
            
                                                            <div class="mt-5 tab tab-with-title d-flex justify-content-center">
                                                                <p>
                                                                    <span class="shipping-calculations"></span>
                                                                </p>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-5 shipping-page-map-div bg-grey mt-2 pt-2 pb-2">
            
                                                        <div id="map_{{$product->id}}" class="shipping-page-map-container" user_coords="{{json_encode($userData->user_outlets_array())}}" vendor_coords="{{json_encode($product->determine_product_owner->vendor_outelts_array())}}" >
                                                        </div>
            
                                                    </div>
            
                                                    <div class="shipping-details-page-overlay">
                                                        <span class="loader"></span>
                                                    </div>
            
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->

    <script src="{{asset('frontend/assets/plugins/leaflet/leafletYelsuShipping.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shippingPageInformationAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shippingPageFreightageInformationAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shippingPageFreightageLoaderTypeAjax.js')}}"></script>

@endsection