@extends('frontend.main_theme')
@section('main')

        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">مدیریت حمل کالا</h1>
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
                            <table class="order-table pb-5">
                                <thead>
                                    <tr>
                                        <th class="text-dark">لیست محصولات خریداری شده</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $vendor_id_arr = [];
                                    @endphp
                                    
                                    @foreach ($order_vproducts as $order_vproduct_item)
                                    <tr>
                                        @php
                                            $user = App\Models\User::find($order_vproduct_item->products->first()->vendor_id);
                                            if($user) {
                                                $vendor_info = $user->firstname .' '. $user->lastname;
                                                $vendor_id_arr[] = $order_vproduct_item->products->first()->vendor_id;
                                            }
                                            $vendor_id_arr = array_unique($vendor_id_arr);
                                        @endphp
                                        <td style="text-align:right">
                                            <a href="{{route('product.details',$order_vproduct_item->products->first()->product_slug)}}">{{$order_vproduct_item->products->first()->product_name}}</a>&nbsp;<br>
                                            <p>
                                                <strong>
                                                    مقدار
                                                    {{$order_vproduct_item->quantity}}
                                                    {{$order_vproduct_item->products->first()->determine_product_unit()}}
                                                </strong>
                                            </p>
                                            @if ($order_vproduct_item->products->first()->vendor_id)
                                                فروشنده :  <a href="{{route('vendor.details', $order_vproduct_item->products->first()->vendor_id)}}"> {{$vendor_info}}</a>

                                                @if(!is_null($order_vproduct_item->outlet_id))
                                                    <div class="btn btn-primary btn-rounded btn-sm" style="padding: 0.2em 0.4em; cursor:initial">
                                                        {{$order_vproduct_item->products->first()->outlets->where("id", $order_vproduct_item->outlet_id)->first()->shop_name}}
                                                    </div>
                                                @endif
                                            @else
                                                فروشنده :  یلسو
                                            @endif
                                        </td>
                                           
                                        <td>
                                            <a class="btn btn-primary btn-outline" href="{{route('shipping-details', ['orderId' => $order->id, 'productId' => $order_vproduct_item->products->first()->id, 'outletId' => $order_vproduct_item->outlet_id ?: 0])}}">
                                                مدیریت حمل کالا
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End of Order Details -->
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

@endsection