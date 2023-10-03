@extends('frontend.main_theme')
@section('main')



<main class="main" id="galaxyPetrolPage">
   <!-- Start of Page Header -->
    <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
        style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/galaxypetrol.jpg')}});">
        <div class="container banner-content"></div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>اجرای پروژه های پالایشگاهی و پتروشیمی</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    
    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <section class="introduce mb-10">
                <h3 class="title text-left">
                    معرفی شرکت Galaxy Petrol
                </h3>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-sm-12 galaxyPetrolIntro">
                            <h4>
                                ما راه حل های محصول نوآورانه ای را برای پیشرفت پایدار ارائه می دهیم
                            </h4>
                            <p class="text-start">
                                ما به تجربه و مشارکت های محترم خود در سرتاسر جهان افتخار می کنیم و هدف ما ادامه توسعه حرفه ای و ایجاد روابط موفق جدید در سطح جهانی است.
                            </p>
                            <br>
                            <h4>
                                بیایید امروز آینده خود را بسازیم
                            </h4>
                            <p class="text-start">
                                ما طرح کسب و کار شما را به طور کامل بررسی می کنیم و می توانیم نیازهای شما را تا سقف 20 میلیارد دلار تامین کنیم. تیم کارشناسان ما با ارائه مشاوره های حرفه ای و استراتژی های مقرون به صرفه برای رسیدن به نتیجه دلخواه با شما همکاری خواهند کرد. ما در زمینه های زیر تخصص داریم:
                            </p>
                            <ul>
                                <li>
                                    منابع انرژی طبیعی
                                </li>
                                <p>ما نقاط تماس و منابع مورد نیاز را در اختیار شما قرار می دهیم.</p>
                                <li>
                                    ما موفقیت را تضمین می کنیم
                                </li>
                                <p>به مردم، شرکت ها، سرمایه گذاران و شرکت ها کمک می کند تا بهترین انتخاب را داشته باشند</p>
                            </ul>
                            <br>
                            <h4>
                                ما فقط ساختمان های قدرتمند می سازیم
                            </h4>
                            <ul>
                                <li>
                                    بهترین خدمات
                                </li>
                                <p>سازمان ما خود را به عنوان یک شریک قابل اعتماد و پایدار تثبیت کرده است.</p>
                                <li>
                                    نتیجه
                                </li>
                                <p>
                                    ما کیفیت خدمات و درک عمیق قانون را ترکیب می کنیم.
                                </p>
                                <li>
                                    کیفیت
                                </li>
                                {{-- <p>
                                    ما کیفیت خدمات و درک عمیق قانون را ترکیب می کنیم
                                </p> --}}
                            </ul>
                        </div>
                        <div class="col-lg-4 col-sm-12 text-center">
                            <a href="https://galaxypetrol.com/">
                                <img width="290" src="{{asset('frontend/assets/images/pages/galaxy_petrol/galaxypetrolimage.jpg')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container mb-5 mt-5 pt-5">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 text-center">
                            <img width="700px" src="{{asset('frontend/assets/images/pages/encom_galaxy/yelsu_encom.jpg')}}" alt="">
                        </div>
                    </div>
                </div>

                <div class="our-recent-projects pt-10">
                    <h4>
                        پروژه های انجام شده
                    </h4>
                    <div class="row">
                        <div class="text-center mt-5 col-md-4 col-xs-12 overlay-zoom">
                            <a href="https://galaxypetrol.com/portfolio/mechanical-engineering/">
                                <img src="{{asset('frontend/assets/images/pages/galaxy_petrol/portfolio-6.jpg')}}" alt="galaxy petrol">
                                <h5 class="font-weight-bold text-center mt-5">مهندسی مکانیک</h5>
                            </a>
                        </div>
    
                        <div class="text-center mt-5 col-md-4 col-xs-12 overlay-zoom">
                            <a href="https://galaxypetrol.com/portfolio/bridge-construction/">
                                <img src="{{asset('frontend/assets/images/pages/galaxy_petrol/portfolio-2.jpg')}}" alt="galaxy petrol">
                                <h5 class="font-weight-bold text-center mt-5">پل سازی</h5>
                            </a>
                        </div>
    
                        <div class="text-center mt-5 col-md-4 col-xs-12 overlay-zoom">
                            <a href="https://galaxypetrol.com/portfolio/welding-processing/">
                                <img src="{{asset('frontend/assets/images/pages/galaxy_petrol/portfolio-1.jpg')}}" alt="galaxy petrol">
                                <h5 class="font-weight-bold text-center mt-5"> کنترل کیفیت جوش</h5>
                            </a>
                        </div>
                    </div>
    
                    <div class="row mt-5">
                        <div class="text-center mt-5 col-md-4 col-xs-12 overlay-zoom">
                            <a href="https://galaxypetrol.com/portfolio/build-machinery/">
                                <img src="{{asset('frontend/assets/images/pages/galaxy_petrol/portfolio-3.jpg')}}" alt="galaxy petrol">
                                <h5 class="font-weight-bold text-center mt-5">ساخت ماشین آلات صنعتی</h5>
                            </a>
                        </div>
    
                        <div class="text-center mt-5 col-md-4 col-xs-12 overlay-zoom">
                            <a href="https://galaxypetrol.com/portfolio/oil-gas-production/">
                                <img src="{{asset('frontend/assets/images/pages/galaxy_petrol/portfolio-4.jpg')}}" alt="galaxy petrol">
                                <h5 class="font-weight-bold text-center mt-5">استخراج نفت و گاز</h5>
                            </a>
                        </div>
    
                        <div class="text-center mt-5 col-md-4 col-xs-12 overlay-zoom">
                            <a href="https://galaxypetrol.com/portfolio/factory-construction/">
                                <img src="{{asset('frontend/assets/images/pages/galaxy_petrol/portfolio-9.jpg')}}" alt="galaxy petrol">
                                <h5 class="font-weight-bold text-center mt-5">احداث کارخانه</h5>
                            </a>
                        </div>
                    </div>
                </div>


                {{-- <div class="container pt-10">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <h4>
                                نامه همکاری شرکت ارمغان تجارت مغان با Encompassing Trade
                            </h4>
                            <div class="text-center mt-5">
                                <a href="{{asset('frontend/assets/images/pages/galaxy_petrol/yelsu_encompassingtrade_join-1.jpg')}}" data-lightbox="image-6" data-title="Encompassing Trade">
                                    <img width="80%" src="{{asset('frontend/assets/images/pages/galaxy_petrol/yelsu_encompassingtrade_join-1.jpg')}}" alt="galaxy petrol">
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div> --}}

            </section>          
        </div>

    </div>
</main>


@endsection