<div class="header-middle sticky-content fix-top sticky-header">
    <div class="container">
        <div class="header-left">
            <a href="{{ URL::to('/') }}" class="header-logo bg-white">
                <img src="{{asset('frontend/assets/images/demos/demo13/logo.png')}}" alt="logo" width="144" height="45" />
            </a>
             <!-- End of DropDown Menu -->
             @auth                  
             <div class="wishlist-nav-list">
                  <div class="dropdown">
                      <a class="wishlist label-down link d-xs-show" href="{{route('dashboard')}}">
                          <i class="w-icon-account"></i>
                          <span class="wishlist--label d-lg-show">حساب کاربری</span>
                      </a>
                      <div class="dropdown-content">
                          <div>                                                                                               
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
                    <i
                        class="w-icon-account d-flex align-items-center justify-content-center br-50"></i>
                    <span class="flex-column justify-content-center d-xl-show">وارد شوید
                        <b class="d-block font-weight-bolder ls-50">حساب من </b>
                    </span>
                </a>
              </div>
            @endauth
              <!-- End of Dropdown Menu -->
              <span class="divider mr-4 d-md-show"></span>
              <div class="dropdown ml-0 mr-5">
                <a href="#currency">تومان </a>
                <div class="dropdown-box">
                    <a href="#USD">دلار </a>
                    <a href="#EUR">یورو </a>
                </div>
            </div>
    
            <div class="dropdown">
                <a href="#language"><img src="{{asset('frontend/assets/images/flags/fa.png')}}" alt="ENG Flag" width="14" height="8" class="dropdown-image"> Persian
                </a>
                <div class="dropdown-box">
                    <a href="https://yelsu-com.translate.goog/?_x_tr_sl=auto&_x_tr_tl=en&_x_tr_hl=en&_x_tr_pto=wapp">
                        <img src="{{asset('frontend/assets/images/flags/eng.png')}}" alt="ENG Flag" width="14" height="8" class="dropdown-image">
                        English </a>
                    <a href="https://yelsu-com.translate.goog/?_x_tr_sl=fa&_x_tr_tl=ar&_x_tr_hl=en&_x_tr_pto=wapp">
                        <img src="{{asset('frontend/assets/images/flags/ar.png')}}" alt="FRA Flag" width="14" height="8" class="dropdown-image">
                        Arabic  </a>
                </div>
            </div>

            <!-- End of Dropdown Menu -->
            <form method="GET" action="{{route('search.products')}}" class="input-wrapper header-search hs-expanded hs-round d-md-flex d-none">
                <div class="select-box bg-white">
                    <select id="category" name="cat_id">
                        <option value="0">جستجو محصولات (همه دسته بندی ها)</option>
                        @foreach ($parentCategories->reverse() as $parentCategory)
                        <option value="{{$parentCategory->id}}">&nbsp;&nbsp;-&#8239;{{$parentCategory->category_name}}</option>
                        @endforeach
                        <option value="v">جستجو تأمین کنندگان</option>
                        <option value="m">جستجو بازرگانان</option>
                        <option value="r">جستجو خرده فروشان</option>
                        <option value="c">جستجو گمرک / بنادر / مناطق اقتصادی</option>
                        <option value="f">جستجو شرکت های باربری</option>
                        <option value="d">جستجو رانندگان</option>

                        {{-- <option value="0">-&#8239;جستجو محصولات (همه دسته بندی ها)</option>
                        @foreach ($parentCategories->reverse() as $parentCategory)
                        <option value="{{$parentCategory->id}}">&nbsp;&nbsp;-&#8239;{{$parentCategory->category_name}}</option>
                        @endforeach
                        <option value="v">-&#8239;جستجو تأمین کنندگان</option>
                        <option value="m">-&#8239;جستجو بازرگانان</option> --}}
                    </select>
                    
                </div>
                <input type="text" class="form-control bg-white" name="q" id="search"
                    placeholder="جستجو کنید ..." required />
                <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                </button>
            </form>
        </div>
        <div class="header-right ml-4 d-sm-show">
            <div class="header-call d-lg-show d-lg-flex align-items-center">
                <a href="tel:#" class="w-icon-call"></a>
                <div class="call-info">
                    <h4 class="chat font-weight-normal font-size-md text-normal text-white mb-0">
                        {{-- <a href="mailto:#" class="text-capitalize text-dark">چت زنده</a> <span
                            class="text-dark ls-normal">یا: </span> --}}
                    </h4>
                    <a href="tel:02126402540" class="phone-number font-weight-bolder ls-50">تلفن دفتر مرکزی: 9-02126402540</a>
                </div>
            </div>
            {{-- <a class="wishlist label-down link d-lg-show" href="wishlist.html">
                <i class="w-icon-heart"></i>
                <span class="wishlist-label">علاقه مندیها </span>
            </a> --}}
            <a class="compare label-down link d-lg-show" href="{{URL::to('/contact-us')}}">
                <i class="w-icon-envelop2"></i>
                <span class="compare-label">تماس با ما</span>
            </a>
            <div class="dropdown cart-dropdown cart-offcanvas d-flex mr-0 mr-lg-2">
                <div class="cart-overlay"></div>
                <a href="#" class="cart-toggle label-down link">
                    <i class="w-icon-cart">
                        <span class="cart-count">{{App\Helpers\Cart\Cart::countCartItems() ? App\Helpers\Cart\Cart::countCartItems() : 0}}</span>
                    </i>
                    <span class="cart-label">سبد </span>
                </a>
                <div class="dropdown-box" style="Overflow-y:scroll;">
                    <div class="cart-header">
                        <span>سبد خرید </span>
                        <a href="#" class="btn-close">بستن <i
                                class="w-icon-long-arrow-left"></i></a>
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
        
                    <div class="minicart cart-action mb-10">
                        <a href="{{ URL::to('/cart') }}" class="btn btn-dark btn-outline btn-rounded">سبد خرید </a>
                        <a href="{{ URL::to('/checkout') }}" class="btn btn-primary btn-rounded">پرداخت </a>
                    </div>

                    <div style="margin-bottom:100px;"></div>
                </div>
                <!-- End of Dropdown Box -->
            </div>
        </div>
    </div>
</div>