@extends('frontend.main_theme')
@section('main')

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
            <nav class="breadcrumb-nav">
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
            <div class="page-content pt-2">
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

                        <div>
                            <p class="mb-7">سفارش {{$order->id}}# در تاریخ {{jdate($order->created_at)->format('Y/m/d')}} و ساعت {{jdate($order->created_at)->format('H:i:s')}} ثبت شد و در حال حاضر در حالت 
                                <u>{{$order->status == 'paid' ? 'پرداخت موفق' : ''}} 
                                {{$order->status == 'unpaid' ? 'پرداخت ناموفق' : ''}} 
                                {{$order->status == 'preparation' ? 'در حال پردازش' : ''}} 
                                {{$order->status == 'posted' ? 'ارسال شده' : ''}}
                                {{$order->status == 'received' ? 'دریافت شده' : ''}} 
                                {{$order->status == 'cancelled' ? 'لغو شده' : ''}}</u> 
                                می باشد.
                            </p>
                        </div>
                        
                        <div class="row">       
                            <div class="col-12">
                                <div class="shipping">

                                    <div class="title-underline mb-5">
                                        <h4 class="ls-25 font-weight-bold">
                                            حمل و نقل
                                        </h4>
                                        <p>
                                            لطفا مختصات مبدا و مقصد هر محصول را از فرم زیر انتخاب نمایید.
                                        </p>
                                    </div>
                                    
                                    @foreach ($products as $product)
                                        
                                        <div class="mb-5">
                                            <a href="{{route('product.details', $product->product_slug)}}">
                                                <img src="{{!empty($product->product_thumbnail_sm) ? asset($product->product_thumbnail_sm) : asset('storage/upload/no_image.jpg') }}" alt="{{$product->product_name}}" width="50" />

                                                <span class="ml-1">
                                                    {{$product->product_name}}
                                                </span>
                                            </a>
                                        </div>

                                        <div class="row pt-5 shipping-element">
                                            <div class="col-md-5">

                                                <div class="order-origin-address">
                                                    <h4>
                                                        تعیین مبدا
                                                    </h4>

                                                    <div class="form-group">
                                                        <label>نام مبدا</label>
                                                        <div>
                                                            <select class="form-control form-control-md vendor-address-information">
                                                                @foreach($product->determine_product_owner->vendor_outlets as $vendor_outlet)
                                                                    <option value="{{$vendor_outlet->id}}">{{$vendor_outlet->shop_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mt-2 tab tab-with-title tab-nav-link pt-2 pb-2">
                                                        <p>
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
                                                            <select class="form-control form-control-md user-address-information">
                                                                @foreach($userData->outlets()->get() as $user_outlet)
                                                                    <option value="{{$user_outlet->id}}">{{$user_outlet->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mt-2 tab tab-with-title tab-nav-link pt-2 pb-2">
                                                        <p>
                                                            آدرس:
                                                            <span class="user-address">
                                                                {{$userData->outlets()->first()->address}}
                                                            </span>
                                                        </p>
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                            <div class="col-md-7">
                                                <div id="map_{{$product->id}}" class="shipping-page-map-container" user_coords="{{json_encode($userData->user_outlets_array())}}" vendor_coords="{{json_encode($product->determine_product_owner->vendor_outelts_array())}}" >
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="divider mb-10 mt-10">

                                    @endforeach

                                </div>
                            </div>
                        </div>

                        {{-- @if(count($useroutlet))
                        <h4 class="title title-underline ls-25 font-weight-bold mt-5"> تغییر آدرس ارسال سفارش</h4>
                            <div class="col-12">
                                <div class="form-group">
                                    <form action="{{route('orderview.changeAddress')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$order->id}}">

                                        <div class="mb-1">
                                            برای تغییر آدرس ارسال سفارش یکی از آدرس های زیر را انتخاب و بر روی دکمه "تغییر آدرس ارسال سفارش" کلیک کنید.
                                        </div>

                                        <div class="mt-5">
                                            <select name="shipment" class="form-control form-control-md">
                                                <option value="{{null}}">یک آدرس انتخاب نمایید</option>
                                                @foreach ($useroutlet as $outlet)
                                                    <option value="{{$outlet->id}}">{{$outlet->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="font-size: 12px;">
                                            <i class="w-icon-map-marker"></i>
                                            اگر آدرس محل مورد نظر در لیست وجود ندارد، ابتدا به بخش <a href="{{route('dashboard', ['type' => 'addresses'])}}"><u>آدرس های پیشخوان</u></a> مراجعه و آن آدرس را در سامانه ثبت نمایید.
                                        </div>

                                        <button type="submit" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6 mb-6"><i class="w-icon-envelop4"></i>تغییر آدرس ارسال سفارش</button>
                                    </form>
                                </div>
                            </div>
                        @endif --}}

                       
                     
    
                        
                        {{-- <a href="{{route('dashboard')}}" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6 mb-6"><i class="w-icon-long-arrow-left"></i>بازگشت به فهرست</a> --}}
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

        <script src="{{asset('frontend/assets/plugins/leaflet/leafletYelsuShipping.js')}}"></script>

@endsection