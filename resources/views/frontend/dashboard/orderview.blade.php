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
                    <div class="tab-pane active order">
                        <p class="mb-7">سفارش {{$order->id}}# در تاریخ {{$order->created_at}} ثبت شد و در حال حاضر در حالت 
                            <u>{{$order->status == 'paid' ? 'پرداخت موفق' : ''}} 
                            {{$order->status == 'unpaid' ? 'پرداخت ناموفق' : ''}} 
                            {{$order->status == 'preparation' ? 'در حال پردازش' : ''}} 
                            {{$order->status == 'posted' ? 'ارسال شده' : ''}}
                            {{$order->status == 'received' ? 'دریافت شده' : ''}} 
                            {{$order->status == 'cancelled' ? 'لغو شده' : ''}}</u> 
                            می باشد.</p>
                        <div class="order-details-wrapper mb-5">
                            <h4 class="title text-uppercase ls-25 mb-5">جزئیات سفارش </h4>
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th class="text-dark">محصول </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $vendor_id_arr = [];
                                    @endphp
                                    @foreach ($order->products as $product)
                                        <tr>
                                            @php
                                                $user = App\Models\User::find($product->vendor_id);
                                                if($user) {
                                                    $vendor_info = $user->firstname .' '. $user->lastname;
                                                    $vendor_id_arr[] = $product->vendor_id;
                                                }
                                                $vendor_id_arr = array_unique($vendor_id_arr);
                                            @endphp
                                            <td style="text-align:right">
                                                <a href="{{route('product.details',$product->product_slug)}}">{{$product->product_name}}</a>&nbsp;<strong>{{$product->pivot->quantity}}</strong>x<br>
                                                @if ($product->vendor_id)
                                                فروشنده :  <a href="{{route('vendor.details',$product->vendor_id)}}"> {{$vendor_info}}</a>
                                                @else
                                                فروشنده :  یلسو
                                                @endif
                                            </td>
                                            
                                            @if ($product->currency == 'toman')
                                                <td>{{$product->pivot->quantity * $product->pivot->price}} تومان </td>
                                            @elseif($product->currency == 'dollar')
                                                <td>{{$product->pivot->quantity * $product->pivot->price}} دلار </td>
                                            @elseif($product->currency == 'euro')
                                                <td>{{$product->pivot->quantity * $product->pivot->price}} یورو </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>مجموع: </th>
                                        <td>{{$order->price}} تومان</td>
                                    </tr>
                                    <tr>
                                        <th>حمل و نقل:</th>
                                        <td>نرخ ثابت </td>
                                    </tr>
                                    <tr>
                                        <th>روش پرداخت:</th>
                                        <td>انتقال مستقیم بانکی</td>
                                    </tr>
                                    <tr class="total">
                                        <th class="border-no">مجموع:</th>
                                        <td class="border-no">100000 تومان</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End of Order Details -->
    
                        <div class="sub-orders mb-10">
                           
                            {!! count($vendor_id_arr) > 1 ?
                                '<div class="alert alert-icon alert-inline mb-5">
                                    <i class="w-icon-exclamation-triangle"></i>
                                    <strong>یادداشت:  </strong>این سفارش دارای محصولاتی از چندین فروشنده است. بنابراین ما این سفارش را به چند سفارش فروشنده تقسیم کردیم. هر سفارش به طور مستقل توسط فروشنده مربوطه انجام می شود.
                                </div>' 
                                :
                                ''
                            !!}
                            
                        </div>
                        <!-- End of Sub Orders-->
    
                        <div id="billing-account-addresses">
                            <div class="row">       
                                <div class="col-12">
                                    <div class="ecommerce-address billing-address">
                                        <h4 class="title title-underline ls-25 font-weight-bold">آدرس ارسال سفارش</h4>
                                        <address class="mb-4">
                                            <table class="address-table">
                                                <tbody>
                                                    <tr>
                                                        <th style="text-align:right">استان:</th>
                                                        <td>{{$userData->shipping_province}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:right">شهر:</th>
                                                        <td>{{$userData->shipping_city}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:right">آدرس: </th>
                                                        <td>{{$userData->shipping_address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:right">کد پستی :</th>
                                                        <td>{{$userData->shipping_postalcode}}</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </address>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <a href="{{route('dashboard', ["type" => "addresses"])}}" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6 mb-6"><i class="w-icon-envelop4"></i>تغییر آدرس ارسال سفارش</a>
                        </div>
                        <!-- End of Account Address -->
    
                        
                        <a href="{{route('dashboard')}}" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6 mb-6"><i class="w-icon-long-arrow-left"></i>بازگشت به فهرست</a>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

@endsection