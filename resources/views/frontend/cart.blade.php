@extends('frontend.main_theme')
@section('main')

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
                                    <th class="product-subtotal"><span>جمع فرعی </span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Helpers\Cart\Cart::all() as $cart)
                                    @if(isset($cart['product']))
                                    @php
                                        $product = $cart['product'];
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
                                                <button type="submit" class="btn btn-close"><i
                                                        class="fas fa-times"></i></button>
                                                </form>        
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{route('product.details',$product->product_slug)}}">
                                                {{$product->product_name}}
                                            </a>
                                        </td>

                                        <td class="product-price"><span class="amount">{{$product->selling_price}} {{$product->determine_product_currency()}}</span></td>
                                        
                                        <td class="product-quantity">
                                            
                                            <div class="input-group">
                                                <input oninput="updateCartFunction(event,'{{$cart['id']}}',null,'{{$product->selling_price}}',2)" class="form-control quantity-yelsu" type="number" value="{{$cart['quantity']}}" min="{{$product->determine_product_min() ?: 1}}" max="{{$product->determine_product_max() ?: 1000}}">
                                                <button onclick="updateCartFunction(event,'{{$cart['id']}}',null,'{{$product->selling_price}}',1)" class="w-icon-plus add-yelsu"></button>
                                                <button onclick="updateCartFunction(event,'{{$cart['id']}}',null,'{{$product->selling_price}}',1)" class="w-icon-minus sub-yelsu"></button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount"><span class="itemSumPrice">{{$product->selling_price * $cart['quantity']}}</span> {{$product->determine_product_currency()}} </span>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                        <div class="cart-action mb-6">
                            <button class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>بازگشت به فروشگاه</button>
                            <form action="{{route('cart.destroyAll')}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="پاک کردن سبد ">پاک کردن سبد </button> 
                            </form>
                            {{-- <button type="submit" class="btn btn-rounded btn-update disabled" name="update_cart" value="بروز کردن سبد">بروز کردن سبد</button> --}}
                        </div>

                        <form class="coupon">
                            <h5 class="title coupon-title font-weight-bold text-uppercase">جشنواره کوپن با </h5>
                            <input type="text" class="form-control mb-4" placeholder="کد تخفیف را وارد کنید..." required />
                            <button class="btn btn-dark btn-outline btn-rounded">اعمال کد</button>
                        </form>
                    </div>
                        <div class="col-lg-4 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar">
                                <div class="cart-summary mb-4">
                                    <h3 class="cart-title text-uppercase">مجموع سبد </h3>
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                        <label class="ls-25">مجموع</label>
                                        @php
                                            $totalPrice = App\Helpers\Cart\Cart::all()->sum(function($cart){
                                                return $cart['product']->selling_price * $cart['quantity'];
                                            });
                                        @endphp
                                        <span><span id="totalPrice">{{$totalPrice}}</span> تومان</span>
                                    </div>

                                    <hr class="divider">

                                    {{-- <ul class="shipping-methods mb-2">
                                        <li>
                                            <label
                                                class="shipping-title text-dark font-weight-bold">حمل و نقل</label>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="free-shipping" class="custom-control-input"
                                                    name="shipping">
                                                <label for="free-shipping"
                                                    class="custom-control-label color-dark">حمل و نقل رایگان</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="local-pickup" class="custom-control-input"
                                                    name="shipping">
                                                <label for="local-pickup"
                                                    class="custom-control-label color-dark">وانت محلی</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="flat-rate" class="custom-control-input"
                                                    name="shipping">
                                                <label for="flat-rate" class="custom-control-label color-dark">نرخ ثابت:
                                                    78000 تومان</label>
                                            </div>
                                        </li>
                                    </ul> --}}

                                    {{-- <div class="shipping-calculator">
                                        <p class="shipping-destination lh-1">حمل و نقل به <strong>CA</strong>.</p>

                                        <form class="shipping-calculator-form">
                                            <div class="form-group">
                                                <div class="select-box">
                                                    <select name="country" class="form-control form-control-md">
                                                        <option value="default" selected="selected">ایالات متحده
                                                            (US)
                                                        </option>
                                                        <option value="us">ایالات متحده</option>
                                                        <option value="uk">انگلستان</option>
                                                        <option value="fr">فرانسه </option>
                                                        <option value="aus">استرالیا </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="select-box">
                                                    <select name="state" class="form-control form-control-md">
                                                        <option value="default" selected="selected"> کالیفرنیا 
                                                        </option>
                                                        <option value="ohaio">اوهایو</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-md" type="text"
                                                    name="town-city" placeholder="خانه / شهر">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-md" type="text"
                                                    name="zipcode" placeholder="کد پستی">
                                            </div>
                                            <button type="submit" class="btn btn-dark btn-outline btn-rounded">آپدیت مجموع</button>
                                        </form>
                                    </div> --}}

                                    {{-- <hr class="divider mb-6">
                                    <div class="order-total d-flex justify-content-between align-items-center">
                                        <label>مجموع</label>
                                        <span class="ls-50">100000 تومان</span>
                                    </div> --}}
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
                    <button class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto">بازگشت به فروشگاه</button>
                </div>
            @endif
        </div>
    </div>
    <!-- End of PageContent -->
</main>

<script src="{{asset('frontend/assets/js/cart.js')}}"></script>
@endsection