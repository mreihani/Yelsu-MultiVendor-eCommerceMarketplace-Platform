<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    
    <div class="mobile-menu-container scrollable">
        {{-- <form action="https://www.yelsu.com/search/products" method="POST" class="input-wrapper">
            @csrf
            <input type="text" class="form-control" name="search_query" autocomplete="off"
                placeholder="جستجو" />
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form> --}}
        
        <!-- End of Search Form -->
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active">منوی اصلی </a>
                </li>
                <li class="nav-item">
                    <a href="#categories" class="nav-link">دسته بندی ها </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <ul class="mobile-menu">
                    <li><a href="{{URL::to('/')}}">خانه </a></li>
                    <li><a href="{{URL::to('/shop')}}">فروشگاه </a></li>
                    <li><a href="{{URL::to('/blog')}}">اخبار و مقالات </a></li>
                    <li><a href="{{URL::to('/about-us')}}">درباره ما </a></li>
                    <li><a href="{{URL::to('/contact-us')}}">تماس با ما </a></li>
                </ul>
            </div>

            <div class="tab-pane" id="categories">
                @php
                    $parentCategories = App\Models\Category::where('parent',0)->get();
                @endphp

                <ul class="mobile-menu">
                    {{-- <li>
                        <a href="{{route('shop.category',['id'=> 1])}}">
                            <img width="30px" src = "{{asset('frontend/assets/images/yelsu_images/yelsu_steel.svg')}}" alt="steel"/>محصولات فولادی و فلزی
                        </a>
                        <ul>
                            <li>
                                <a href="#">زنانه </a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">تازه رسیده ها </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">پرفروش ترین ها </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">پر طرفدار </a></li>
                                    <li><a href="shop-fullwidth-banner.html">تن پوش </a></li>
                                    <li><a href="shop-fullwidth-banner.html">کفش ها </a></li>
                                    <li><a href="shop-fullwidth-banner.html">کیسه ها </a></li>
                                    <li><a href="shop-fullwidth-banner.html">تجهیزات جانبی </a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">جواهر و
                                            ساعت </a></li>
                                    <li><a href="shop-fullwidth-banner.html">ویژه </a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> --}}

                    @foreach ($parentCategories as $parentCategory)
                        <li>
                            <a href="{{route('shop.category',['id'=> $parentCategory->id])}}">
                                <img width="30px" src = "{{asset($parentCategory->category_image)}}" alt="steel"/> {{$parentCategory->category_name}}
                            </a>
                            {{-- @include("frontend.body.layout.megamenu." . $parentCategory->id) --}}
                        </li>
                    @endforeach
                    
                </ul>
            </div>
        </div>
    </div>
</div>