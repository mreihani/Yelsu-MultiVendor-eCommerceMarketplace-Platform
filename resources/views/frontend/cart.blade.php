@extends('frontend.main_theme')
@section('main')

<style>
    .shop-table.cart-table .product-quantity {
        width: 20% !important;
    }
</style>

<main class="main cart">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="active"><a href="">سبد خرید</a></li>
                <li><a href="">پرداخت </a></li>
                <li><a href="">سفارش کامل شد</a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">
            @if(App\Helpers\Cart\Cart::countCartItems() > 0)
                <div class="row gutter-lg mb-10">
                    <div class="col-lg-8 pr-lg-4 mb-6">
                        <table class="shop-table cart-table">
                            <thead>
                                <tr>
                                    <th class="product-name"><span>محصول </span></th>
                                    <th></th>
                                    <th class="product-price"><span>قیمت </span></th>
                                    <th class="product-quantity"><span>تعداد </span></th>
                                    <th class="product-subtotal" style="width:28%;">
                                        <span>
                                            جمع فرعی (با احتساب مالیات بر ارزش افزوده)
                                        </span>    
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Helpers\Cart\Cart::all() as $cart)
                                    @if(isset($cart['product']))
                                    @php
                                        $product = $cart['product'];

                                        $price_with_commission_value_added = ceil($product->getPriceWithCommissionValueAddedAttribute($cart["outlet_id"] ?: null));
                                    @endphp
                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="{{route('product.details',$product->product_slug)}}">
                                                    <figure>
                                                        <img src="{{(!empty($product->product_thumbnail)) ? url($product->product_thumbnail) : url('storage/upload/no_image_product.jpg')}}" alt="product"
                                                            width="300" height="338">
                                                    </figure>
                                                </a>
                                                <form action="{{route('cart.destroy',$cart['id'])}}" method="POST">
                                                @csrf
                                                @method('delete')   
                                                <button type="submit" class="btn btn-close">
                                                    <i class="fas fa-times" style="color: red;"></i>
                                                </button>
                                                </form>        
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <div class="d-flex flex-column">
                                                <a href="{{route('product.details',$product->product_slug)}}">
                                                    {{$product->product_name}}
                                                </a>
                                                
                                                @if(!is_null($cart['outlet_id']))
                                                    <div class="btn btn-primary btn-rounded btn-sm" style="padding: 0.2em 0.4em; cursor:initial">
                                                        {{$product->outlets->where("id", $cart['outlet_id'])->first()->shop_name}}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="product-price"><span class="amount">{{number_format($price_with_commission_value_added, 0, '', ',')}} {{$product->determine_product_currency()}}</span></td>
                                        
                                        <td class="product-quantity">
                                            <div class="input-group">
                                                <input onkeyup="updateCartFunction(event,'{{$cart['id']}}',null,'{{$price_with_commission_value_added}}',2)" class="form-control quantity-yelsu" type="number" value="{{$cart['quantity']}}" min="{{$product->determine_product_min() ?: 1}}" max="{{$product->determine_product_max() ?: 1000}}">
                                                <button onclick="updateCartFunction(event,'{{$cart['id']}}',null,'{{$price_with_commission_value_added}}',1)" class="w-icon-plus add-yelsu"></button>
                                                <button onclick="updateCartFunction(event,'{{$cart['id']}}',null,'{{$price_with_commission_value_added}}',1)" class="w-icon-minus sub-yelsu"></button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount"><span class="itemSumPrice">{{number_format(ceil($price_with_commission_value_added * $cart['quantity']), 0, '', ',')}}</span> {{$product->determine_product_currency()}} </span>
                                            @if($product->determine_product_value_added_tax())
                                                <div class="btn btn-warning btn-rounded btn-sm" style="padding: 0.2em 0.4em; cursor:initial">
                                                    {{$product->determine_product_value_added_tax()}}
                                                    درصد مالیات
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="cart-action mb-6">
                            <a href="{{route("shop")}}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto">
                                <i class="w-icon-long-arrow-left"></i>بازگشت به فروشگاه
                            </a>
                            <form action="{{route('cart.destroyAll')}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="پاک کردن سبد ">پاک کردن سبد </button> 
                            </form>
                        </div>
                        <form class="coupon mb-2">
                            <h5 class="title coupon-title font-weight-bold text-uppercase">جشنواره کوپن با </h5>
                            <input type="text" class="form-control mb-4" placeholder="کد تخفیف را وارد کنید..." required />
                            <button class="btn btn-dark btn-outline btn-rounded">اعمال کد</button>
                        </form>

                        <div id="cart-page-overlay">
                            <span class="loader"></span>
                        </div>
                    </div>
                    
                    @php
                        $totalPrice = App\Helpers\Cart\Cart::all()->sum(function($cart){
                            return $cart['product']->getPriceWithCommissionValueAddedAttribute($cart["outlet_id"] ?: null) * $cart['quantity'];
                        });
                    @endphp
                    
                    <div class="col-lg-4 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar">
                            <div class="cart-summary mb-4">
                                <h3 class="cart-title text-uppercase">مجموع سبد </h3>
                                <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                    <label class="ls-25">
                                        مجموع (با احتساب مالیات بر ارزش افزوده)
                                    </label>
                                   
                                    <span>
                                        <span id="totalPrice">{{number_format($totalPrice, 0, '', ',')}}</span>
                                         تومان
                                    </span>
                                </div>

                                <hr class="divider">
                                
                                <a href="{{route('checkout')}}"
                                    class="btn btn-block btn-dark btn-icon-right btn-rounded btn-checkout" id="continueShopping" > 
                                    پردازش و پرداخت<i class="w-icon-long-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row gutter-lg text-center">
                    <i style='font-size:100px;' class='w-icon-cart'></i>
                    <h1 style='margin-top:20px;'>سبد خرید شما در حال حاضر خالی است.</h1>
                </div>    
                <div class="mb-10 text-center">
                    <a href="{{route("shop")}}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto">بازگشت به فروشگاه</a>
                </div>
            @endif
        </div>
    </div>
    <!-- End of PageContent -->
</main>

<script src="{{asset('frontend/assets/js/cart.js')}}"></script>
@endsection