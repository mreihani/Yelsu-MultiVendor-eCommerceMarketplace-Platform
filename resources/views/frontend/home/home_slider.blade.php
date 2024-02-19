<div class="grid-item grid-item1 intro-slide-wrapper col-lg-8 height-x3">
    <div class="swiper-container swiper-theme pg-inner pg-white animation-slider h-100 br-sm"
        data-swiper-options="{
        'spaceBetween': 0,
        'slidesPerView': 1,
        'autoplay': {
            'delay': 8000,
            'disableOnInteraction': false
        }
    }">
        <div class="swiper-wrapper row gutter-no cols-1">

            <div onclick="window.location='{{route('shop.category',['id'=> 1])}}';" class="swiper-slide banner banner-fixed intro-slide intro-slide1 br-sm"
                style="background-image: url({{asset('frontend/assets/images/demos/demo13/slides/refah-bank-slider-2.jpg')}}); cursor: pointer;">
                <div class="banner-content y-50" style="width: 350px">
                    <div class="slide-animate" data-animation-options="{
                        'name': 'fadeInUpShorter', 'duration': '1s','delay':'.3s'
                        }">
                        <h1 style="font-size: 43px; color: #405eb0;" class="font-weight-bold">
                            حامیان تجارت شما
                        </h1>
                        {{-- <h3 style="font-size: 17px;" class="text-dark text-uppercase ls-45">استعلام قیمت روز، تمام کارخانجات فولادی
                            میلگرد، قوطی، تیرآهن، انواع ورق و ...
                        </h3>
                        <h4 style="font-size: 17px;" class="banner-price-info text-uppercase font-weight-bold ls-25">
                            <span style="font-size: 17px;" class="text-secondary ls-25">خرید و سفارش آنلاین و مطمئن</span>
                        </h4> --}}
                    </div>
                </div>
            </div>
            <!-- End of Intro Slide 1 -->

            {{-- <div onclick="window.location='{{route('shop.category',['id'=> 4])}}';" class="swiper-slide banner banner-fixed intro-slide intro-slide1 br-sm"
                style="background-image: url({{asset('frontend/assets/images/demos/demo13/slides/refinary_3.jpg')}}); cursor: pointer;">
                <div class="banner-content y-50" style="width: 350px">
                    <div class="slide-animate" data-animation-options="{
                        'name': 'fadeInUpShorter', 'duration': '1s','delay':'.3s'
                        }">
                        <h3 style="font-size: 35px; color: #405eb0;" class="banner-subtitle font-weight-normal">
                            در هر زمینه فعالیت تجاری همراه شما هستیم
                        </h3>
                        <h3 style="font-size: 17px;" class="text-uppercase ls-45">
                            همین حالا تجارت خود را گسترش دهید!!!
                        </h3>
                        <h4 style="font-size: 17px;" class="banner-price-info text-uppercase font-weight-bold ls-25">
                        </h4>
                    </div>
                </div>
            </div> --}}

            <!-- End of Intro Slide 2 -->
            <div onclick="window.location='{{route('shop.category',['id'=> 3])}}';" class="swiper-slide banner banner-fixed intro-slide intro-slide3 br-sm"
                style="background-image: url({{asset('frontend/assets/images/demos/demo13/slides/slide-3.jpg')}}); cursor: pointer;">
                <div class="banner-content y-50" style="width: 350px">
                    <div class="slide-animate" data-animation-options="{
                        'name': 'fadeInUpShorter', 'duration': '1s','delay':'.3s'
                        }">
                        {{-- <h3 style="font-size: 17px;" class="banner-subtitle text-default font-weight-normal">جامع ترین تامین کننده محصولات ساختمانی</h3> --}}
                        {{-- <h3 style="font-size: 17px;" class="text-dark text-uppercase ls-25">خرید و فروش انواع بتن، سیمان، آجر، کاشی و سرامیک
                        </h3> --}}
                        <h4 style="font-size: 17px;" class="banner-price-info font-weight-bold ls-25">
                            {{-- <span class="text-secondary ls-25">با ارمغان تجارت مغان</span> --}}
                        </h4>
                    </div>
                </div>
            </div>
            <!-- End of Intro Slide 3 -->

            {{-- <div onclick="window.location='{{route('shop.category',['id'=> 2])}}';" class="swiper-slide banner banner-fixed intro-slide intro-slide3 br-sm"
                style="background-image: url({{asset('frontend/assets/images/demos/demo13/slides/yelsu_trade_laptop.jpg')}}); cursor: pointer;">
                <div class="banner-content y-50" style="width: 350px">
                    <div class="slide-animate" data-animation-options="{
                        'name': 'fadeInUpShorter', 'duration': '1s','delay':'.3s'
                        }">
                        <h4 style="font-size: 17px;" class="banner-price-info font-weight-bold ls-25">
                        </h4>
                    </div>
                </div>
            </div> --}}
            <!-- End of Intro Slide 5 -->

        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>