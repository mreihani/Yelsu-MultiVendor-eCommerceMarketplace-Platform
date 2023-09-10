<aside class="sidebar right-sidebar blog-sidebar sidebar-fixed sticky-sidebar-wrapper">
    <div class="sidebar-overlay">
        <a href="#" class="sidebar-close">
            <i class="close-icon"></i>
        </a>
    </div>
    <a href="#" class="sidebar-toggle">
        <i class="fas fa-chevron-left"></i>
    </a>
    <div class="sidebar-content">
        <div class="sticky-sidebar">
            <div class="widget widget-search-form">
                <div class="widget-body">
                    <form action="{{route('blog.search')}}" method="POST" class="input-wrapper input-wrapper-inline">
                        @csrf
                        <input name="search" type="text" class="form-control"
                            placeholder="جستجو در مقالات" autocomplete="off" required>
                        <button class="btn btn-search"><i
                                class="w-icon-search"></i></button>
                    </form>
                </div>
            </div>
            <!-- End of Widget search form -->
            <div class="widget widget-categories">
                <h3 class="widget-title bb-no mb-0">دسته بندی ها </h3>
                <ul class="widget-body filter-items search-ul">
                    @foreach ($blogcategories as $blogcategory)
                        <li><a class="{{(Route::currentRouteName() == 'blog.category' && $category_id == $blogcategory->id) ? 'activeLink' : ''}}" href="{{route('blog.category',$blogcategory->id)}}">{{$blogcategory->blog_category_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <!-- End of Widget categories -->
            {{-- <div class="widget widget-posts">
                <h3 class="widget-title bb-no">پست های محبوب </h3>
                <div class="widget-body">
                    <div class="swiper">
                        <div class="swiper-container swiper-theme nav-top" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 1
                        }">
                            <div class="swiper-wrapper row cols-1">
                                <div class="swiper-slide widget-col">
                                    <div class="post-widget mb-4">
                                        <figure class="post-media br-sm">
                                            <img src="assets/images/blog/sidebar/1.jpg" alt="150" height="150" />
                                        </figure>
                                        <div class="post-details">
                                            <div class="post-meta">
                                                <a href="#" class="post-date">خرداد 5</a>
                                            </div>
                                            <h4 class="post-title">
                                                <a href="post-single.html">مد از نقطه نظر بیرونی به شما می گوید که چه کسی هستید</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="post-widget mb-4">
                                        <figure class="post-media br-sm">
                                            <img src="assets/images/blog/sidebar/2.jpg" alt="150" height="150" />
                                        </figure>
                                        <div class="post-details">
                                            <div class="post-meta">
                                                <a href="#" class="post-date">خرداد 5</a>
                                            </div>
                                            <h4 class="post-title">
                                                <a href="post-single.html">لباس مردانه تابستانی جدید پیدا شد</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="post-widget mb-2">
                                        <figure class="post-media br-sm">
                                            <img src="assets/images/blog/sidebar/3.jpg" alt="150" height="150" />
                                        </figure>
                                        <div class="post-details">
                                            <div class="post-meta">
                                                <a href="#" class="post-date">خرداد 5</a>
                                            </div>
                                            <h4 class="post-title">
                                                <a href="post-single.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide widget-col">
                                    <div class="post-widget mb-4">
                                        <figure class="post-media br-sm">
                                            <img src="assets/images/blog/sidebar/4.jpg" alt="150" height="150" />
                                        </figure>
                                        <div class="post-details">
                                            <div class="post-meta">
                                                <a href="#" class="post-date">خرداد 5</a>
                                            </div>
                                            <h4 class="post-title">
                                                <a href="post-single.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. با تولید سادگی</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="post-widget mb-4">
                                        <figure class="post-media br-sm">
                                            <img src="assets/images/blog/sidebar/5.jpg" alt="150" height="150" />
                                        </figure>
                                        <div class="post-details">
                                            <div class="post-meta">
                                                <a href="#" class="post-date">خرداد 5</a>
                                            </div>
                                            <h4 class="post-title">
                                                <a href="post-single.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="post-widget mb-2">
                                        <figure class="post-media br-sm">
                                            <img src="assets/images/blog/sidebar/6.jpg" alt="150" height="150" />
                                        </figure>
                                        <div class="post-details">
                                            <div class="post-meta">
                                                <a href="#" class="post-date">خرداد 5</a>
                                            </div>
                                            <h4 class="post-title">
                                                <a href="post-single.html">یک پست وبلاگ جالب با تصاویر ارائه می شود</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- End of Widget posts -->
            {{-- <div class="widget widget-custom-block">
                <h3 class="widget-title bb-no">بلوک سفارشی </h3>
                <div class="widget-body">
                    <p class="text-default mb-0">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد.</p>
                </div>
            </div> --}}
            <!-- End of Widget custom block -->
            {{-- <div class="widget widget-tags">
                <h3 class="widget-title bb-no">برچسب های جدید </h3>
                <div class="widget-body tags">
                    <a href="#" class="tag">مد </a>
                    <a href="#" class="tag">سبک </a>
                    <a href="#" class="tag">مسافرت </a>
                    <a href="#" class="tag">زنانه </a>
                    <a href="#" class="tag">زنانه </a>
                    <a href="#" class="tag">سرگرمی ها </a>
                    <a href="#" class="tag">خريد كردن </a>
                    <a href="#" class="tag">عکاسی </a>
                </div>
            </div> --}}
            {{-- <div class="widget widget-calendar">
                <h3 class="widget-title bb-no">تقویم </h3>
                <div class="widget-body">
                    <div class="calendar-container" data-calendar-options="{
                        'dayExcerpt': 1
                    }"></div>
                </div>
            </div> --}}
        </div>
    </div>
</aside>