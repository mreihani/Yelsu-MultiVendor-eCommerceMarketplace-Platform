@extends('frontend.main_theme')
@section('main')

{{-- 
<script>
    let latitudeVal = {!! json_encode(old('latitude',$latitudeVal)) !!};
    let longitudeVal = {!! json_encode(old('longitude',$longitudeVal)) !!};
</script> --}}

<main class="main checkout">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a href="">سبد خرید </a></li>
                <li class="active"><a href="">پرداخت </a></li>
                <li><a href="">سفارش کامل شد</a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->


    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">

             @if(session()->has('error'))
                <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5  mt-5 mb-5">
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
{{-- 
            <div class="coupon-toggle">
                کد تخفیف دارید؟ <a href="#"
                    class="show-coupon font-weight-bold text-uppercase text-dark">کد را وارد کنید </a>
            </div>
            <div class="coupon-content mb-4">
                <p>اگر کد کوپن دارید، لطفاً آن را در زیر اعمال کنید.</p>
                <div class="input-wrapper-inline">
                    <input type="text" name="coupon_code" class="form-control form-control-md mr-1 mb-2" placeholder="کد تخفیف" id="coupon_code">
                    <button type="submit" class="btn button btn-rounded btn-coupon mb-2" name="apply_coupon" value="اعمال کد">اعمال کد</button>
                </div>
            </div> --}}
            <form action="{{route('cart.payment')}}" method="POST" id="cart-payment">
                @csrf
                <div class="row mb-9">
                    <div class="col-lg-7 pr-lg-4 mb-4">
                        <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                            جزئیات صورتحساب
                        </h3>

                        <input type="hidden" value="{{$userData->person_type}}" id="person-type-value">

                        @if($userData->person_type && ($userData->role == "vendor" || $userData->role == "merchant" || $userData->role == "retailer"))
                            <div class="form-group">
                                <label>شخص حقیقی یا حقوقی *</label>
                                <div class="select-box">
                                    <select @disabled(true) id="person" name="person_type" class="form-control form-control-md yelsu-disabled-input">
                                        <option class="yelsu-disabled-input" {{$userData->person_type == "haghighi" ? "selected" : ""}} value="haghighi">شخص حقیقی</option>
                                        <option class="yelsu-disabled-input" {{$userData->person_type == "hoghoghi" ? "selected" : ""}} value="hoghoghi">شخص حقوقی</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row gutter-sm haghighi">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>نام *</label>
                                        <input @disabled(true) type="text" class="form-control form-control-md yelsu-disabled-input" name="firstname" value="{{old('firstname', $userData->firstname)}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>نام خانوادگی  *</label>
                                        <input @disabled(true) type="text" class="form-control form-control-md yelsu-disabled-input" name="lastname" value="{{old('lastname', $userData->lastname)}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group haghighi">
                                <label>کد ملی *</label>
                                <input @disabled(true) type="number" class="form-control form-control-md yelsu-disabled-input" name="national_code" value="{{old('national_code', $userData->national_code)}}">
                            </div>
                            <div class="form-group hoghoghi">
                                <label>نام شرکت *</label>
                                <input @disabled(true) type="text" class="form-control form-control-md yelsu-disabled-input" name="shop_name" value="{{old('shop_name', $userData->shop_name)}}">
                            </div>
                            <div class="form-group hoghoghi">
                                <label>شماره شناسه شرکت *</label>
                                <input @disabled(true) type="number" class="form-control form-control-md yelsu-disabled-input" name="company_number" value="{{old('company_number', $userData->company_number)}}">
                            </div>
                            <div class="form-group hoghoghi">
                                <label>نام نماینده (اختیاری)</label>
                                <input @disabled(true) type="text" class="form-control form-control-md yelsu-disabled-input" name="agent_name" value="{{old('agent_name', $userData->agent_name)}}">
                            </div>
                        @else
                            <div class="form-group">
                                <label>شخص حقیقی یا حقوقی *</label>
                                <div class="select-box">
                                    <select id="person" name="person_type" class="form-control form-control-md">
                                        <option {{$userData->person_type == "haghighi" ? "selected" : ""}} value="haghighi">شخص حقیقی</option>
                                        <option {{$userData->person_type == "hoghoghi" ? "selected" : ""}} value="hoghoghi">شخص حقوقی</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row gutter-sm haghighi">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>نام *</label>
                                        <input type="text" class="form-control form-control-md" name="firstname" value="{{old('firstname', $userData->firstname)}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>نام خانوادگی  *</label>
                                        <input type="text" class="form-control form-control-md" name="lastname" value="{{old('lastname', $userData->lastname)}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group haghighi">
                                <label>کد ملی *</label>
                                <input type="number" class="form-control form-control-md" name="national_code" value="{{old('national_code', $userData->national_code)}}">
                            </div>
                            <div class="form-group hoghoghi">
                                <label>نام شرکت *</label>
                                <input type="text" class="form-control form-control-md" name="shop_name" value="{{old('shop_name', $userData->shop_name)}}">
                            </div>
                            <div class="form-group hoghoghi">
                                <label>شماره شناسه شرکت *</label>
                                <input type="number" class="form-control form-control-md" name="company_number" value="{{old('company_number', $userData->company_number)}}">
                            </div>
                            <div class="form-group hoghoghi">
                                <label>نام نماینده (اختیاری)</label>
                                <input type="text" class="form-control form-control-md" name="agent_name" value="{{old('agent_name', $userData->agent_name)}}">
                            </div>
                        @endif


                        <div class="row gutter-sm">                           
                            {{-- <div class="col-xs-6"> --}}
                                <div class="form-group">
                                    <label> تلفن  *</label>
                                    <input type="number" class="form-control form-control-md" name="home_phone" value="{{old('home_phone') ? old('home_phone') : $userData->home_phone}}">
                                </div>
                            {{-- </div> --}}
                        </div>

                        {{-- added neshan map and addresses --}}
                        {{-- @if(count($useroutlet))
                        <div class="form-group">
                            <div class="mb-1">آدرس پستی مرسوله *</div>

                            <span style="font-size: 12px;">
                                <i class="w-icon-map-marker"></i>
                                اگر قبلا از بخش <a href="{{route('dashboard', ['type' => 'addresses'])}}"><u>آدرس های پیشخوان</u></a> اقدام به افزودن آدرس نموده اید، می توانید از گزینه های زیر یکی از آن آدرس ها را انتخاب کنید. علاوه بر این از همین بخش می توان یک آدرس جدید اضافه و در سفارش خود ثبت نمود.
                            </span>
                            
                            <div class="select-box mt-5">
                                <select id="shipment" name="shipment" class="form-control form-control-md">
                                    <option value="0">افزودن آدرس جدید به سامانه</option>
                                    @foreach ($useroutlet as $outlet)
                                        <option value="{{$outlet->id}}">{{$outlet->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        
                        <div class="col-lg-12 pr-lg-4 address-container">

                            <div class="container mt-5 mb-5">
                                <div id="map" style="height: 450px;"></div>
                            </div>

                            <div class="row gutter-sm">     
                                
                                <input placeholder="طول جغرافیایی / longitude" type="hidden" class="form-control form-control-lg form-control-solid" id="longitude" name="longitude">      
                                <input placeholder="عرض جغرافیایی / latitude" type="hidden" class="form-control form-control-lg form-control-solid" id="latitude" name="latitude">      

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>
                                            عنوان آدرس *
                                        </label>
                                        <input type="text" placeholder="به عنوان مثال: منزل"
                                            class="form-control form-control-md mb-2" name="address_title" value="{{old('address_title')}}">
                                    </div>
                                </div>
                        
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>کشور *</label>
                                        <input type="text" placeholder="به عنوان مثال: ایران"
                                            class="form-control form-control-md mb-2" id="country" name="country" value="{{old('country')}}">
                                    </div>
                                </div>
                            </div>
    
                            <div class="row gutter-sm">                           
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>استان *</label>
                                        <input type="text" placeholder="به عنوان مثال: تهران"
                                            class="form-control form-control-md mb-2" id="province" name="province" value="{{old('province')}}">
                                    </div>
                                </div>
                        
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>شهر *</label>
                                        <input type="text" placeholder="به عنوان مثال: تهران"
                                            class="form-control form-control-md mb-2" id="city" name="city" value="{{old('city')}}">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row gutter-sm">                           
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>آدرس *</label>
                                        <input type="text" placeholder="نام خیابان یا کوچه و پلاک"
                                            class="form-control form-control-md mb-2" id="address" name="address" value="{{old('address')}}">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>کد پستی (اختیاری)</label>
                                        <input type="number" class="form-control form-control-md" name="postalcode" value="{{old('postalcode')}}">
                                    </div>
                                </div>
                            </div>

                        </div>    --}}
                        {{-- added neshan map and addresses --}}

                        <div class="form-group mt-3">
                            <label for="order-notes">یادداشت های سفارش (اختیاری)</label>
                            <textarea class="form-control mb-0" id="order-notes" name="order_note" cols="30"
                                rows="4"
                                placeholder="توضیحات مورد نیاز سفارش">{{old('order_note')}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                        <div class="order-summary-wrapper sticky-sidebar">
                            <h3 class="title text-uppercase ls-10">سفارش شما</h3>
                            <div class="order-summary">
                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <b>محصول</b>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (App\Helpers\Cart\Cart::all() as $cart)
                                            @if(isset($cart['product']))
                                            @php
                                                $product = $cart['product'];
                                            @endphp
                                                <tr class="bb-no">
                                                    <td class="product-name" style="text-align: start;">
                                                        {{$product->product_name}}
                                                        
                                                        <i class="fas fa-times"></i> 
                                                        <span class="product-quantity">
                                                            {{$cart['quantity']}}
                                                        </span>

                                                        @if(!is_null($cart['outlet_id']))
                                                            <div class="btn btn-primary btn-rounded btn-sm d-flex" style="padding: 0.2em 0.4em; cursor:initial; width: max-content;">
                                                                {{$product->outlets->where("id", $cart['outlet_id'])->first()->shop_name}}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="product-total" style="text-align: -webkit-left;">
                                                        {{number_format($cart['quantity'] * $product->getPriceWithCommissionValueAddedAttribute($cart["outlet_id"] ?: null), 0, '', ',')}} {{$product->determine_product_currency()}} 

                                                        @if($product->determine_product_value_added_tax())
                                                            <div class="btn btn-warning btn-rounded btn-sm d-flex" style="padding: 0.2em 0.4em; cursor:initial; width: max-content;">
                                                                {{$product->determine_product_value_added_tax()}}
                                                                درصد مالیات
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif                                     
                                        @endforeach
                                        
                                        @php
                                            $totalPrice = App\Helpers\Cart\Cart::all()->sum(function($cart){
                                                return $cart['product']->getPriceWithCommissionValueAddedAttribute($cart["outlet_id"] ?: null) * $cart['quantity'];
                                            });
                                        @endphp
                               
                                        <tr class="cart-subtotal bb-no">
                                            <td style="text-align: start;">
                                                <b>مجموع</b>
                                            </td>
                                            <td>
                                                <b>{{number_format($totalPrice, 0, '', ',')}} تومان</b>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                                <div class="payment-methods" id="payment_method">

                                    <input type="hidden" name="selected_gateway" value="sep">

                                    <h4 class="title font-weight-bold ls-25 pb-0 mb-1">روش های پرداخت </h4>
                                    <div class="accordion payment-accordion">
                                        <div class="card">
                                            <div class="card-header">
                                                <a href="#sep-gateway" class="collapse">درگاه بانک رفاه</a>
                                            </div>
                                            <div id="sep-gateway" class="card-body expanded">
                                                <p class="mb-0">
                                                    <img width="40px" src="{{asset('frontend/assets/images/demos/demo13/banner/Refah-Bank-Logo.png')}}" alt="">
                                                    پرداخت از طریق درگاه بانک رفاه
                                                </p>
                                            </div>
                                        </div>
                                        {{-- <div class="card">
                                            <div class="card-header">
                                                <a href="#sepehr-gateway" class="expand">درگاه بانک صادرات</a>
                                            </div>
                                            <div id="sepehr-gateway" class="card-body collapsed">
                                                <p class="mb-0">
                                                    <img width="40px" src="{{asset('frontend/assets/images/demos/demo13/banner/Bank_Saderat_Iran_logo.png')}}" alt="">
                                                    پرداخت از طریق درگاه بانک صادرات
                                                </p>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="form-group place-order pt-6">                                                                        
                                    <button onclick="document.getElementById('cart-payment').submit()" type="button" class="btn btn-dark btn-block btn-rounded">ثبت سفارش</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- End of PageContent -->
</main>

<script src="{{asset('frontend/assets/js/checkout.js')}}"></script>

<script>
    $("#payment_method").on("click", ".card-header", function() {
        let thisElement = $(this);
        let selectedGateway = thisElement.find("a").attr("href");
        let selectedGatewayInput = $("#payment_method").find("input");

        if(selectedGateway == "#sep-gateway") {
            selectedGatewayInput.val("sep");
        } else if(selectedGateway == "#sepehr-gateway") {
            selectedGatewayInput.val("sepehr");
        }
    });
</script>

@endsection