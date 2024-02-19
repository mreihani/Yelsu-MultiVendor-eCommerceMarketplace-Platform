<aside class="sidebar sidebar-switch-xl sticky-sidebar-wrapper left-sidebar sidebar-fixed">
    <div class="sidebar-overlay"></div>
    <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-right"></i></a>
    <a href="#" class="sidebar-close"><i class="close-icon"></i></a>
    <div class="sidebar-content left-sidebar-content scrollable">
        <div class="dropdown category-dropdown bg-white sticky-sidebar"
            data-sticky-options="{'minWidth': 1199, 'padding': {'top': 0}, 'paddingOffsetTop': 0}">
            <a href="{{ URL::to('/') }}" class="sidebar-logo bg-white d-block after-none text-center">
                <img src="{{asset('frontend/assets/images/demos/demo13/logo.png')}}" alt="logo" width="145" height="45" />
            </a>
            <h3 class="d-block text-dark font-weight-bolder dropdown-title pb-0 mb-0">محصولات پلتفرم یلسو</h3>

            <div class="dropdown-box text-default">
                <ul class="menu vertical-menu category-menu yelsu_main_categories">
                    @foreach ($megaMenuCategories as $parentCategory)
                        <li class="has-submenu">
                            <a href="{{route('shop.category', ['id'=> $parentCategory['category_id']])}}">
                                <img width="40px" src = "{{asset($parentCategory['img_src'])}}" alt="{{$parentCategory['category_name']}}"/>
                                    {{$parentCategory['category_name']}}
                                    <span class="submenu-toggle-btn"></span>
                            </a>
                            @includeIf("frontend.body.layout.megamenu.dynamic-menu", ['child' => $parentCategory['child']])
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="dropdown-nav pb-0">
                {{-- <h3 class="d-block text-dark font-weight-bolder dropdown-title pl-0 pb-3 mb-0">پلتفرم</h3> --}}
                <nav class="main-nav">
                    <ul class="menu d-block">
                        
                        <li class="has-submenu platform-submenu">
                            <a href=""> دسترسی های پلتفرم 
                                <span class="submenu-toggle-btn"></span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{route('shop')}}">Marketplace Platform</a></li>
                                <li><a href="{{route('vendor.all')}}">تولید کنندگان / تأمین کنندگان</a></li>
                                <li><a href="{{route('merchant.all')}}">بازرگانان / ترخیص کاران</a></li>
                                <li><a href="{{route('retailer.all')}}">خرده فروشان</a></li>
                                <li><a href="{{route('customs.all')}}">گمرک / بنادر / مناطق اقتصادی</a></li>
                                <li><a href="{{route('freightage.all')}}">شرکت های حمل و نقل / باربری</a></li>
                                <li><a href="{{route('driver.all')}}">رانندگان</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="dropdown-special-offers mt-5">
                <h3 class="d-block text-dark font-weight-bolder dropdown-title pl-0 mb-0">لینک های ویژه
                </h3>
                <a href="{{URL::to('/')}}">خانه</a>
                {{-- <a href="#">خدمات</a> --}}
                <a href="{{URL::to('/blog')}}">اخبار و مقالات</a>
                <a href="{{URL::to('/anti-money-laundering-law')}}">مقررات و آیین نامه ها</a>
                <a href="{{URL::to('/about-us')}}">درباره ما</a>
                <a href="{{URL::to('/contact-us')}}">تماس با ما</a>
            </div>
           
        </div>
    </div>
</aside>
