<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    
    <div class="mobile-menu-container scrollable">
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

            @if(!$agent->isDesktop())
                <div class="tab-pane" id="categories">
                    <ul class="mobile-menu">
                        @foreach ($megaMenuCategoriesMobile as $parentCategory)
                            <li>
                                <a href="{{route('shop.category',['id'=> $parentCategory['category_id']])}}">
                                    <img width="30px" src = "{{asset($parentCategory['img_src'])}}" alt="steel"/> {{$parentCategory['category_name']}}
                                </a>
                                @includeIf("frontend.body.layout.megamenu.dynamic-menu-mobile", ['child' => $parentCategory['child']])
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</div>