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
                        <p class="mb-7">سفارش {{$order->id}}# در تاریخ {{jdate($order->created_at)->format('Y/m/d')}} و ساعت {{jdate($order->created_at)->format('H:i:s')}} ثبت شد و در حال حاضر در حالت 
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
                                    @foreach ($order->vproducts as $order_vproducts)
                                        <tr>
                                            @php
                                                $user = App\Models\User::find($order_vproducts->products->first()->vendor_id);
                                                if($user) {
                                                    $vendor_info = $user->firstname .' '. $user->lastname;
                                                    $vendor_id_arr[] = $order_vproducts->products->first()->vendor_id;
                                                }
                                                $vendor_id_arr = array_unique($vendor_id_arr);
                                            @endphp
                                          
                                            <td style="text-align:right">
                                                <a href="{{route('product.details',$order_vproducts->products->first()->product_slug)}}">{{$order_vproducts->products->first()->product_name}}</a>&nbsp;<strong>{{$order_vproducts->quantity}}</strong>x<br>
                                                @if ($order_vproducts->products->first()->vendor_id)
                                                
                                                فروشنده :  <a href="{{route('vendor.details',$order_vproducts->products->first()->vendor_id)}}"> {{$vendor_info}}</a>

                                                    @if(!is_null($order_vproducts->outlet_id))
                                                        <div class="btn btn-primary btn-rounded btn-sm" style="padding: 0.2em 0.4em; cursor:initial">
                                                            {{$order_vproducts->products->first()->outlets->where("id", $order_vproducts->outlet_id)->first()->shop_name}}
                                                        </div>
                                                    @endif
                                                @else
                                                فروشنده :  یلسو
                                                @endif
                                            </td>
                                                                                     
                                            <td>{{$order_vproducts->quantity * $order_vproducts->price}} {{$order_vproducts->products->first()->determine_product_currency()}} </td>
                                            
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                                <tfoot>
                                    <tr class="total">
                                        <th class="border-no">مجموع:</th>
                                        <td class="border-no">{{$order->price}} {{$order_vproducts->products->first()->determine_product_currency()}}</td>
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
                        
                        <div>
                            {{-- <div class="row">       

                                <div class="col-12">
                                    <div class="ecommerce-address billing-address">
                                        <h4 class="title title-underline ls-25 font-weight-bold">آدرس ارسال سفارش</h4>
                                        <address class="mb-4">
                                            <table class="address-table">
                                                <tbody>
                                                    <tr>
                                                        <th style="text-align:right; font-style: normal;">کشور:</th>
                                                        <td style="text-align:right; font-style: normal;">{{!empty($order->addresses->country) ? $order->addresses->country : $order->order_shipping_country}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:right; font-style: normal;">استان:</th>
                                                        <td style="text-align:right; font-style: normal;">{{!empty($order->addresses->province) ? $order->addresses->province : $order->order_shipping_province}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:right; font-style: normal;">شهر:</th>
                                                        <td style="text-align:right; font-style: normal;">{{!empty($order->addresses->city) ? $order->addresses->city : $order->order_shipping_city}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:right; font-style: normal;">آدرس: </th>
                                                        <td style="text-align:right; font-style: normal;">{{!empty($order->addresses->address) ? $order->addresses->address : $order->order_shipping_address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:right; font-style: normal;">کد پستی :</th>
                                                        <td style="text-align:right; font-style: normal;">{{!empty($order->addresses->postalcode) ? $order->addresses->postalcode : $order->order_shipping_postalcode}}</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </address>
                                    </div>
                                </div>
                            </div> --}}

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

                        </div>
                        <!-- End of Account Address -->
    
                        
                        {{-- <a href="{{route('dashboard')}}" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6 mb-6"><i class="w-icon-long-arrow-left"></i>بازگشت به فهرست</a> --}}
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

@endsection