<header class="header">
    {{-- <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">پیام فروشگاه لغو کنید. به فروشگاه ما خوش آمدید!</p>
            </div>
            <div class="header-right">               
            <span class="divider d-lg-show"></span>
            <a href="blog.html" class="d-lg-show">بلاگ </a>
            <a href="contact-us.html" class="d-lg-show">تماس با ما </a>                       
            </div>
        </div>
    </div> --}}
    <!-- End of Header Top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left mr-md-4">
                <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                </a>
                <a href="{{ URL::to('/') }}" class="logo ml-lg-0">
                    <img src="{{asset('frontend/assets/images/demos/demo13/logo.png')}}" alt="logo" width="144" height="45" />
                </a>
                <form method="GET" action="{{route('search.products')}}" class="header-search hs-expanded hs-round d-md-flex input-wrapper d-none">
                    <div class="select-box">
                        <select id="category" name="cat_id">
                            <option value="0">جستجو محصولات (همه دسته بندی ها)</option>
                            @foreach (App\Models\Category::where('parent', 0)->latest()->get()->reverse() as $parentCategory)
                            <option value="{{$parentCategory->id}}">&nbsp;&nbsp;-&#8239;{{$parentCategory->category_name}}</option>
                            @endforeach
                            <option value="v">جستجو تولید کنندگان / تأمین کنندگان</option>
                            <option value="m">جستجو بازرگانان</option>
                            <option value="r">خرده فروشان</option>
                            <option value="c">جستجو گمرک / بنادر / مناطق اقتصادی</option>
                            <option value="f">جستجو شرکت های باربری</option>
                            <option value="d">جستجو رانندگان</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" name="query" id="search"
                        placeholder="جستجو کنید ..." required />
                    <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                    </button>
                </form>
            </div>
            <div class="header-right ml-4">
                <div class="header-call d-xs-show d-lg-flex align-items-center">
                    <a href="tel:#" class="w-icon-call"></a>
                    <div class="call-info d-lg-show">
                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                            {{-- <a href="mailto:#" class="text-capitalize">تلفن گویا</a> تومان :</h4> --}}
                        <a href="tel:02126402540" class="phone-number font-weight-bolder ls-50">تلفن دفتر مرکزی: 9-02126402540</a>
                    </div>
                </div>
                
                <!-- End of DropDown Menu -->
                @auth                  
               <div class="wishlist-nav-list">
                    <div class="dropdown">
                        <a class="wishlist label-down link d-xs-show" href="">
                            <i class="w-icon-account"></i>
                            <span class="wishlist--label d-lg-show">حساب کاربری</span>
                        </a>
                        <div class="dropdown-content">
                            <div class="tab">                                                                                               
                                <a href="{{route('dashboard')}}">پیشخوان</a>
                                <a href="{{route('dashboard',['type' => 'orders'])}}">سفارشات</a>
                                <a href="{{route('dashboard',['type' => 'addresses'])}}">آدرس ها</a>
                                <a href="{{route('dashboard',['type' => 'details'])}}">جزئیات حساب</a>
                                <a href="{{route('user.logout')}}">خروج</a>
                            </div>       
                        </div>
                    </div>
                </div>
                @else 
                <div class="account align-items-center d-md-show">
                    <a class="login inline-type d-flex ls-normal" href="{{route('dashboard')}}">
                        <i style="color: black;border: 1px solid #cdcdcd;;"
                            class="w-icon-account d-flex align-items-center justify-content-center br-50"></i>
                        <span style="color: black;margin-right: 9px;" class="flex-column justify-content-center d-xl-show">وارد شوید
                            <b style="color: black;" class="d-block font-weight-bolder ls-50">حساب من </b>
                        </span>
                    </a>
                </div>
                @endauth
                <!-- End of Dropdown Menu -->
                       
                
                <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a href="#" class="cart-toggle label-down link">
                        <i class="w-icon-cart">
                            <span class="cart-count">{{App\Helpers\Cart\Cart::countCartItems() ? App\Helpers\Cart\Cart::countCartItems() : 0}}</span>
                        </i>
                        <span class="cart-label">سبد </span>
                    </a>
                    <div>
                        <div class="dropdown-box mb-10" style="Overflow-y:scroll;">
                            <div class="cart-header">
                                <span>سبد خرید </span>
                                <a href="#" class="btn-close">بستن <i class="w-icon-long-arrow-left"></i></a>
                            </div>

                            <div id="minicartRefresh"></div>
                            <div class="products">
                                <div class="minicart gotoShop cart-action" style="justify-content: center;">
                                    <a href="{{ URL::to('/shop') }}" class="btn btn-primary btn-rounded">بازگشت به فروشگاه</a>
                                </div>
                            </div>
                
                            <div class="minicart cart-total">
                                <label>مجموع: </label>
                                <span class="price"><span id="miniCartTotalPrice">0</span> تومان</span>
                            </div>
                
                            <div class="minicart cart-action">
                                <a href="{{ URL::to('/cart') }}" class="btn btn-dark btn-outline btn-rounded">سبد خرید </a>
                                <a href="{{ URL::to('/checkout') }}" class="btn btn-primary btn-rounded">پرداخت </a>
                            </div>

                            
                            <div style="margin-bottom:100px;"></div>
                        </div>
                    </div>
                    <!-- End of Dropdown Box -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="header-bottom sticky-content fix-top sticky-header">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left">
                    <div class="dropdown category-dropdown has-border" data-visible="true">
                        <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true" data-display="static"
                            title="دسته بندی محصولات">
                            <i class="w-icon-category"></i>
                            <span>دسته بندی محصولات</span>
                        </a>

                        @php
                            $parentCategories = App\Models\Category::where('parent',0)->get();
                        @endphp

                        <div class="dropdown-box">
                            <ul class="menu vertical-menu category-menu">
                                @foreach ($parentCategories as $parentCategory)
                                    <li>
                                        <a href="{{route('shop.category',['id'=> $parentCategory->id])}}">
                                            <img width="40px" src = "{{asset($parentCategory->category_image)}}" alt="steel"/> {{$parentCategory->category_name}}
                                        </a>
                                        @includeIf("frontend.body.layout.megamenu." . $parentCategory->id)
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                    <nav class="main-nav">
                        <ul class="menu active-underline">
                            <li>
                                <a href="{{URL::to('/')}}">خانه </a>
                            </li>
                            {{-- <li>
                                <a href="#">خدمات </a>
                            </li> --}}
                            {{-- <li>
                                <a href="{{URL::to('/shop')}}">فروشگاه </a>
                            </li> --}}
                            <li class="has-submenu">
                                <a href=""> دسترسی های پلتفرم  </a>
                                <ul class="submenu">
                                    <li><a href="{{route('shop')}}">Marketplace Platform</a></li>
                                    <li><a href="{{route('vendor.all')}}">تولید کنندگان / تأمین کنندگان</a></li>
                                    <li><a href="{{route('merchant.all')}}">بازرگانان / ترخیص کاران</a></li>
                                    <li><a href="{{route('retailer.all')}}">خرده فروشان</a></li>
                                    <li><a href="{{route('customs.all')}}">گمرک / بنادر / مناطق اقتصادی </a></li>
                                    <li><a href="{{route('freightage.all')}}">شرکت های حمل و نقل / باربری</a></li>
                                    <li><a href="{{route('driver.all')}}">رانندگان</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{URL::to('/blog')}}">اخبار و مقالات </a>
                            </li>
                            <li>
                                <a href="{{URL::to('/anti-money-laundering-law')}}">مقررات و آیین نامه ها</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/about-us')}}">درباره ما </a>
                            </li>
                            <li>
                                <a href="{{URL::to('/contact-us')}}">تماس با ما </a>
                            </li>
                            
                        </ul>
                    </nav>
                </div>
                <div class="header-right">
                    <a href="{{route('dashboard',['type' => 'orders'])}}" class="d-xl-show"><i class="w-icon-orders mr-1"></i>پیگیری سفارش </a>
                    {{-- <a href="#"><i class="w-icon-sale"></i>معاملات روزانه </a> --}}
                </div>
            </div>
        </div>
    </div>
</header>

