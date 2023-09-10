@extends('frontend.main_theme')
@section('main')

<script>
    let shippingProvinceDB = {!! json_encode($userData->shipping_province) !!};
    shippingProvinceDB = shippingProvinceDB  == 'empty' ? '' : shippingProvinceDB;
    let shippingCityDB = {!! json_encode($userData->shipping_city) !!};
</script>

<main class="main checkout">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a href="">ثبت سفارش صادرات</a></li>
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

            <form action="{{route('orderexport')}}" method="POST" id="cart-payment">
                @csrf
                <div class="row mb-9">
                    <div class="col-lg-7 pr-lg-4 mb-4">
                        <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                            جزئیات صورتحساب
                        </h3>
                        <div class="form-group">
                            <label>شخص حقیقی یا حقوقی *</label>
                            <div class="select-box">
                                <select id="person" name="person_type" class="form-control form-control-md">
                                    <option value="haghighi">شخص حقیقی</option>
                                    <option value="hoghoghi">شخص حقوقی</option>
                                </select>
                            </div>
                        </div>
                        <div class="row gutter-sm haghighi">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>نام *</label>
                                    <input type="text" class="form-control form-control-md" name="firstname" value="{{old('firstname') ? old('firstname') :  $userData->firstname}}"
                                    >
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>نام خانوادگی  *</label>
                                    <input type="text" class="form-control form-control-md" name="lastname" value="{{old('lastname') ? old('lastname') :  $userData->lastname}}"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group haghighi">
                            <label>کد ملی *</label>
                            <input type="number" class="form-control form-control-md" name="national_code" value="{{old('national_code')}}">
                        </div>
                        <div class="form-group hoghoghi">
                            <label>نام شرکت *</label>
                            <input type="text" class="form-control form-control-md" name="company_name" value="{{old('company_name')}}">
                        </div>
                        <div class="form-group hoghoghi">
                            <label>شماره شناسه شرکت *</label>
                            <input type="number" class="form-control form-control-md" name="company_number" value="{{old('company_number')}}">
                        </div>
                        <div class="form-group hoghoghi">
                            <label>نام نماینده (اختیاری)</label>
                            <input type="text" class="form-control form-control-md" name="agent_name" value="{{old('agent_name')}}">
                        </div>

                        <div class="row gutter-sm ir-select">                           
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>استان *</label>
                                    <div class="select-box">
                                        <select name="shipping_province" class="ir-province form-control form-control-md"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>شهر *</label>
                                    <select name="shipping_city" class="ir-city form-control form-control-md"></select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>آدرس خیابان  *</label>
                            <input type="text" placeholder="نام خیابان یا کوچه و پلاک"
                                class="form-control form-control-md mb-2" name="shipping_address" value="{{old('shipping_address') ? old('shipping_address') : $userData->shipping_address}}">
                        </div>

                        <div class="row gutter-sm">                           
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>کد پستی *</label>
                                    <input type="number" class="form-control form-control-md" name="shipping_postalcode" value="{{old('shipping_postalcode') ? old('shipping_postalcode') : $userData->shipping_postalcode}}">
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label> تلفن  *</label>
                                    <input type="number" class="form-control form-control-md" name="shipping_phone" value="{{old('shipping_phone') ? old('shipping_phone') : $userData->shipping_phone}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="order-notes">یادداشت های سفارش (اختیاری)</label>
                            <textarea class="form-control mb-0" id="order-notes" name="order_note" cols="30"
                                rows="4"
                                placeholder="توضیحات مورد نیاز سفارش">{{old('order_note')}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                        <div class="order-summary-wrapper sticky-sidebar">
                            <h3 class="title text-uppercase ls-10">سفارش صادرات شما</h3>
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
                                        <input type="hidden" value="{{$product->id}}" name="product_id">
                                        <input type="hidden" value="{{$quantity}}" name="quantity">
                                        <tr class="bb-no">
                                            <td style="text-align:right;" class="product-name">{{$product->product_name}}<i
                                                    class="fas fa-times"></i> <span
                                                    class="product-quantity">{{$quantity}}</span></td>
                                            @if ($product->currency == 'toman')
                                                <td class="product-total">{{$quantity*$product->selling_price}} تومان </td>
                                            @elseif($product->currency == 'dollar')
                                                <td class="product-total">{{$quantity*$product->selling_price}} دلار </td>
                                            @elseif($product->currency == 'euro')
                                                <td class="product-total">{{$quantity*$product->selling_price}} یورو </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
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
@endsection