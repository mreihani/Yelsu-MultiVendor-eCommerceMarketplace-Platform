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
                    
                    <li>
                        <a href="{{route('shop.category',['id'=> 1])}}">
                            <img width="40px" src = "{{asset('frontend/assets/images/yelsu_images/yelsu_steel.svg')}}" alt="steel"/> فولادی و فلزی
                            <span class="submenu-toggle-btn"></span>
                        </a>
                        @include('frontend.body.layout.megamenu.steelCategory')
                    </li>

                    <li>
                        <a href="{{route('shop.category',['id'=> 2])}}">
                            <img width="40px" src = "{{asset('frontend/assets/images/yelsu_images/yelsu_mining.svg')}}" alt="mining"/> معدنی و فرآوری
                            <span class="submenu-toggle-btn"></span>
                        </a>
                        @include('frontend.body.layout.megamenu.miningCategory')
                    </li>
                    
                    <li>
                        <a href="{{route('shop.category',['id'=> 3])}}">
                            <img width="40px" src = "{{asset('frontend/assets/images/yelsu_images/yelsu_construction.svg')}}" alt="construction"/> ساختمانی و عمرانی
                            <span class="submenu-toggle-btn"></span>
                        </a>
                        @include('frontend.body.layout.megamenu.constructionCategory')
                    </li>

                    <li>
                        <a href="{{route('shop.category',['id'=> 4])}}">
                            <img width="40px" src = "{{asset('frontend/assets/images/yelsu_images/yelsu_oil.svg')}}" alt="oil"/> نفت، گاز و پتروشیمی<span class="submenu-toggle-btn"></span>
                        </a>
                        @include('frontend.body.layout.megamenu.oilCategory')
                    </li>

                    <li>
                        <a href="{{route('shop.category',['id'=> 5])}}">
                            <img width="40px" src = "{{asset('frontend/assets/images/yelsu_images/yelsu_energy.svg')}}" alt="energy"/> برق، مخابرات و آبرسانی
                            <span class="submenu-toggle-btn"></span>
                        </a>
                        @include('frontend.body.layout.megamenu.electricalCategory')
                    </li>
                   

                    <li>
                        <a href="{{route('shop.category',['id'=> 6])}}">
                            <img width="40px" src = "{{asset('frontend/assets/images/yelsu_images/yelsu_agriculture.svg')}}" alt="agriculture"/>غذایی و کشاورزی<span class="submenu-toggle-btn"></span>
                        </a>
                        @include('frontend.body.layout.megamenu.agriculturalCategory')
                    </li>

                    <li>
                        <a href="{{route('shop.category',['id'=> 7])}}">
                            <img width="40px" src = "{{asset('frontend/assets/images/yelsu_images/yelsu_mining_machines.svg')}}" alt="road"/><span class="sidebar-small-text">تجهیزات</span> راهسازی و معدنی
                            <span class="submenu-toggle-btn"></span>
                        </a>
                        @include('frontend.body.layout.megamenu.roadCategory')
                    </li>

                    <li>
                        <a href="{{route('shop.category',['id'=> 8])}}">
                            <img width="40px" src = "{{asset('frontend/assets/images/yelsu_images/yelsu_industrial_machines.svg')}}" alt="industrial machinary"/><span class="sidebar-small-text">تجهیزات</span> جاده ای و کشاورزی
                            <span class="submenu-toggle-btn"></span>
                        </a>
                        @include('frontend.body.layout.megamenu.agricultralMachinesCategory')
                    </li>

                    <li>
                        <a href="{{route('shop.category',['id'=> 860])}}">
                            <img width="40px" src = "{{asset('frontend/assets/images/yelsu_images/home_appliances.jpg')}}" alt="home_appliances.jpg"/>مبلمان و لوازم خانگی
                            <span class="submenu-toggle-btn"></span>
                        </a>
                        {{-- @include('frontend.body.layout.megamenu.agricultralMachinesCategory') --}}
                    </li>
                    
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
                                <li><a href="{{route('retailer.all')}}">عمده فروشان / خرده فروشان</a></li>
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
