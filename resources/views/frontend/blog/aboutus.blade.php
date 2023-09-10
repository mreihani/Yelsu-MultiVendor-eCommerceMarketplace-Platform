@extends('frontend.main_theme')
@section('main')


<main class="main">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">درباره ما</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav pb-5">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>درباره ما</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    
    <!-- Start of Page Content -->
    <div class="page-content aboutUs">
        <section class="boost-section pb-5">
            <div class="container">
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 mb-8">
                        <figure class="br-lg">
                            <img src="{{asset('frontend/assets/images/pages/about_us/yelsu-1024x683-1.jpg')}}" alt="Banner"
                                width="610" height="450" style="background-color: #9E9DA2;" />
                        </figure>
                    </div>
                    <div class="col-md-6 pl-lg-8 mb-8" style="text-align: justify">
                        <h4 class="title text-left">
                            معرفی شرکت
                        </h4>
                        <p class="mb-6">شرکت دانش بنیان ارمغان تجارت مغان با نام برند یلسو (yelsu) با پشتوانۀ متخصصین مجرب در زمینۀ بازرگانی و صادرات انواع محصولات حجیم بصورت عمده فعالیت دارد. چشم‌انداز و اهداف اصلی شرکت، فعالیت در حوزه بازرگانی، توسعه و تجاری‌سازی می‌باشد. بنابراین برای دستیابی به این مهم اقدام به واردات و صادرات، تأمین و توزیع انواع محصولات فولادی فلزی، محصولات ساختمانی و عمران، محصولات کشاورزی و مشتقات نفتی نموده است و به ارزش ها و مشی سازمانی پایبند است.
                            <br><br>
                            ارمغان تجارت مغان با بهره‌گیری از توانایی کارشناسانی با تجربه، امکان ارائه خدمات در زمینۀ تحقیق و توسعه فرآوری، استخراج و بارگیری محصولات معدنی را دارد و خدمات خود را در اقصی نقاط کشور عزیزمان ارائه می‌دهد.</p>
                        <div style="text-align: end">
                            <a href="{{asset('frontend/assets/images/pages/about_us/yelsu_catalogue.pdf')}}" class="btn btn-dark btn-rounded">
                                <i class="w-icon-fax"></i>
                                کاتالوگ شرکت
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="introduce pb-10">
            <div class="container">
                <h2 class="title">
                    مأموریت پلتفرم اقتصادی یلسو
                </h2>
                <p class="mx-auto">
                    مجموعه یلسو (yelsu) قصد دارد پلتفرمی امن و راحت برای خرید سریع، آنلاین و رضایت‌مند مشتریانمان فراهم آورد. از طرفی با به کارگیری بستر لازم برای مارکت پلیس به توسعه و افزایش فروش شرکت‌ها و کارگاه‌های صنعتی یاری برساند. همسو با توسعه فناوری اطلاعات در جهان، مأموریت ما هوشمندسازی تجاری به همراه تکمیل زنجیره‌ فروش انواع محصولات صنعتی می‌باشد.
                <br><br>
                    تحقق حداکثر رضایت و خشنودی مشتریان با تکیه بر متخصصان و نخبگان مجرب و خلاق و تحقیق و ارائه راه‌کارهایی بهینه در مدیریت و اجرای پروژه‌های بزرگ و ارائه محصولات و خدمات در صنایع مختلف از دیگر اهداف این سازمان است.
                </p>
            </div>
        </section>

        <section class="introduce mb-10">
            <div class="container">
                <h2 class="title">
                    چشم انداز‌ها
                </h2>
                <p class="mx-auto">
                    مجموعه یلسو (yelsu) در نظر دارد با تبدیل شدن به برترین پلتفرم دیجیتال مارکتینگ، خرید و فروش آنلاین محصولات صنعتی را پیاده‌سازی نماید. برای رسیدن به این مهم، از فناوری‌های نوین جهت هوشمندسازی تجاری و علم‌ به روز بازاریابی در جهان همچون ژئومارکتینگ و نرومارکتینگ استفاده خواهد کرد. این سازمان، تمامي تلاش خويش را با تاکيد بر اهداف راهبردي ذيل، بکار خواهد برد:
                <br>
                </p>
                <ul>
                    <li>فعالیت بازرگانی در حوزه های تهیه و توزیع محصولات صنایع معدنی، فولادی فلزی و ساختمانی عمرانی محصولات کشاورزی، نفت، گاز و پتروشیمی، برق، انرژی و مخابرات، ماشین‌آلات سنگین و سبک</li>
                    <li>تلاش برای بین المللی شدن، تجاری‌سازی و صادرات محصولات فولادی فلزی، صنایع معدنی و ساختمانی عمرانی و یافتن شرکای استراتژیک منطقه‌ای و بین‌المللی</li>
                    <li>تکمیل زنجیرۀ فروش انواع محصولات ساخت ساختمان در سراسر ایران</li>
                </ul>

                <div class="values-wrapper mt-10 pt-7 pb-5">
                    <h4 class="title font-weight-bold mb-10 pb-1 ls-25">ارزش‌های سازمانی یلسو</h4>
                    <div class="valuesitems">
                        <div class="image-box text-center">
                            <figure>
                                <img src="{{asset('frontend/assets/images/pages/about_us/commitment1.png')}}" alt="Award Image" width="109">
                            </figure>
                            <h3>تعهد</h3>
                            <p>تعهد و پایبندی به سازمان و مشتریان جهت نهادینه نمودن این ارزش</p>
                        </div>
    
                        <div class="image-box text-center">
                            <figure>
                                <img src="{{asset('frontend/assets/images/pages/about_us/customer-satisfaction.png')}}" alt="Award Image" width="109">
                            </figure>
                            <h3>رضایت مشتریان</h3>
                            <p>کسب رضایت‌مندی مشتریان با تعریف کانال‌های ارتباطی هدفمند جهت شناسایی مشتریان عزیز</p>
                        </div>
    
                        <div class="image-box text-center">
                            <figure>
                                <img src="{{asset('frontend/assets/images/pages/about_us/morality.png')}}" alt="Award Image" width="109">
                            </figure>
                            <h3>کرامت انسانی</h3>
                            <p>احترام به کرامت انسانی، رعایت اصول اخلاقی و درک اهمیت تلاش در برقراری ارتباطات سازمانی</p>
                        </div>
    
                        <div class="image-box text-center">
                            <figure>
                                <img src="{{asset('frontend/assets/images/pages/about_us/partners.png')}}" alt="Award Image" width="109">
                            </figure>
                            <h3>کار گروهی</h3>
                            <p>اعتقاد به کار جمعی و دانش گروهی جهت دستیابی به تعالی سازمانی</p>
                        </div>
    
                        <div class="image-box text-center">
                            <figure>
                                <img src="{{asset('frontend/assets/images/pages/about_us/innovation.png')}}" alt="Award Image" width="109">
                            </figure>
                            <h3>نوآوری</h3>
                            <p>خلاقیت و نوآوری جهت ارائه ایده‌های نوآورانه به عنوان یک شرکت دانش بنیان</p>
                        </div>

                        <div class="image-box text-center">
                            <figure>
                                <img src="{{asset('frontend/assets/images/pages/about_us/responsibility.png')}}" alt="Award Image" width="109">
                            </figure>
                            <h3>مسئولیت‌پذیری</h3>
                            <p>مسئولیت‌پذیری در قبال کارکنان و مشتریان و انجام کلیه فرایندهای تولید و ارائه خدمات بر این اساس</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="boost-section pb-5">
            <div class="container">
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 pl-lg-8 mb-8" style="text-align: justify">
                        <h4 class="title text-left">هویت ما</h4>
                        <p class="mb-6">
                            هویت مجموعه یلسو (yelsu) بر اساس رضایت و آسودگی خاطر مشتریان و فروشندگان به کار گرفته شد و هویت بصری برند یلسو همچون رنگ‌ها، لوگوها و الگوها در خدمات رسانی سریع و راحت به مشتریان شکل گرفت.
                    </div>
                    <div class="col-md-6 mb-8">
                        <figure class="br-lg">
                            <img src="{{asset('frontend/assets/images/pages/about_us/Wall_Logo-1-1024x317-1.jpg')}}" alt="Banner"
                                width="610" height="450" style="background-color: #9E9DA2;" />
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section class="member-section mt-5 mb-10 pb-4">
            <div class="container">
                <h4 class="title mb-3">اعضای هیئت مدیره</h4>
                <div class="swiper-container swiper-theme" data-swiper-options="{
                    'spaceBetween': 20,
                    'slidesPerView': 1,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 2
                        },
                        '768': {
                            'slidesPerView': 4
                        },
                        '992': {
                            'slidesPerView': 5
                        }
                    }
                }">
                    <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-sm-2 cols-1">
                        <div class="swiper-slide member-wrap">
                            <figure class="br-lg">
                                <img src="{{asset('frontend/assets/images/pages/about_us/mehrdad_mohammadi_sm.jpg')}}" alt="Member" width="295" height="332" />
                            </figure>
                            <div class="member-info text-center">
                                <h4 class="member-name mt-5 mb-0">مهرداد محمدی</h4>
                                <p class="text-uppercase">رئیس هیئت مدیره</p>
                            </div>
                        </div>
                        <div class="swiper-slide member-wrap">
                            <figure class="br-lg">
                                <img src="{{asset('frontend/assets/images/pages/about_us/mahdi-mohammadi.jpg')}}" alt="Member" width="295" height="332" />
                            </figure>
                            <div class="member-info text-center">
                                <h4 class="member-name mt-5 mb-0">مهدی محمدی</h4>
                                <p class="text-uppercase">مدیرعامل و عضو هیئت مدیره </p>
                            </div>
                        </div>
                        <div class="swiper-slide member-wrap">
                            <figure class="br-lg">
                                <img src="{{asset('frontend/assets/images/pages/about_us/ali-yousefi.jpg')}}" alt="Member" width="295" height="332" />
                            </figure>
                            <div class="member-info text-center">
                                <h4 class="member-name mt-5 mb-0">علی یوسفی مجد</h4>
                                <p class="text-uppercase">معاون مالی و عضو هیئت مدیره</p>
                            </div>
                        </div>
                        <div class="swiper-slide member-wrap">
                            <figure class="br-lg">
                                <img src="{{asset('frontend/assets/images/pages/about_us/hossein-afshar.jpg')}}" alt="Member" width="295" height="332" />
                            </figure>
                            <div class="member-info text-center">
                                <h4 class="member-name mt-5 mb-0">حسین افشار</h4>
                                <p class="text-uppercase">عضو هیئت مدیره</p>
                            </div>
                        </div>
                        <div class="swiper-slide member-wrap">
                            <figure class="br-lg">
                                <img src="{{url('storage/upload/no_image.jpg')}}" alt="Member" width="295" height="332" />
                            </figure> 
                            <div class="member-info text-center">
                                <h4 class="member-name mt-5 mb-0">کامبیز دورنما</h4>
                                <p class="text-uppercase">عضو هیئت مدیره</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    </div>
</main>
<!-- End of Main -->








@endsection