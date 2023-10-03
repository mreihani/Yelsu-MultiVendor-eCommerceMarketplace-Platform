@extends('frontend.main_theme')
@section('main')



<main class="main" id="encomGalaxygPage">
   <!-- Start of Page Header -->
    <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
        style="background-image: url({{asset('frontend/assets/images/yelsu_images/dynamic_category_banner/turkey.jpg')}});">
        <div class="container banner-content"></div>
    </div>
<!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>فرصت های سرمایه گذاری مسکونی </li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    
    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <section class="introduce mb-10">
                <h3 class="title text-left">
                    معرفی شرکت Encomgalaxy
                </h3>
                <div class="container mb-5">
                    <div class="row">
                        <div class="col-lg-8 col-sm-12 encomGalaxyIntro">
                            <p class="text-start">
                                با چندین دهه تجربه گسترده، Encomgalaxy به شهرت بسیار تثبیت شده ما افتخار می کند و این شهرت سال به سال و کشور به کشور به محبوبیت و موفقیت ما کمک می کند تا این شرکت به یکی از مهم ترین شرکت های املاک و مستغلات مورد تایید در ترکیه و در سراسر جهان تبدیل شود! در دنیای در حال توسعه ی سرمایه گذاری در املاک و مستغلات، شرکت ما یک پیشگام است. دفتر مرکزی ما در استانبول، ترکیه واقع شده است. ما همچنین نمایندگان بسیار ماهری داریم که به روسیه، آمریکای شمالی، عراق، امارات متحده عربی، کویت و برزیل خدمات ارائه می‌دهند و با بهترین شرکت‌های کارگزاری ساخت‌وساز و املاک و مستغلات در ارتباط هستند و با آنها مشارکت دارند. ما از طریق ارتباطات خود در هر چیزی که مربوط به بازار املاک، خدمات املاک و مدیریت مستغلات است، به موفقیت و شهرت خوبی دست یافته ایم. ما خدمات کارگزاری ایمن و قابل اعتمادی را در ترکیه ارائه می دهیم که خیال شما را راحت و نیاز شما را برطرف می کند. چه به دنبال ملک تجاری یا مسکونی باشید و چه به بازار املاک ترکیه و اخبار آن علاقه مند باشید، ما می توانیم از طریق یک متخصص به شما مشاوره حقوقی ارائه دهیم. تیم ما که شامل مشاوران، مدیران، وکلا و کارشناسان مختلف است، هر آنچه که به دنبال آن هستید را شامل می شود.
                            </p>
                            <br>
                            <p class="text-start">
                                ماموریت ما این است که شما را با یک مشاور متخصص که گسترده ترین اطلاعات، مشاوره و خدمات را به مشتریان ما ارائه می دهد همراه کنیم تا مطمئن شوید که دنیای اطراف خود در مورد بازار املاک در ترکیه را درک می کنید. ما در هر مرحله از راه با شما خواهیم بود. در طی فرآیند، در هر مرحله توضیحات و مشاوره را ارائه می دهیم تا مطمئن شویم که شما به اهداف خود دست می یابید و ما نیازهای شما را برآورده می کنیم.
                            </p>
                            <br>
                            <p class="text-start">
                                مالکیت یا سرمایه گذاری در املاک و مستغلات مزایای بسیار زیاد دارد. در بازار پررونق ترکیه، می توانید جواهرات کمیاب را در سراسر این کشور یعنی در کنار دریا، بازارهای شلوغ و در مناظر آرام کوهستانی مشرف به آبشارها پیدا کنید. ما احساس می کنیم که همه لیاقت استفاده از چنین مزایایی در سرزمین باستانی و تاریخی ترکیه را دارند. ما با سرمایه گذاری در تیم متخصص خود و داشتن استعداد و انرژی برای ارائه خدمات املاک و مستغلات مطمئن از طریق نمایندگان و شعب خود در سراسر جهان، به شهرت و شناساندن خود به عنوان یکی از شرکت های املاک و مستغلات پیشگام در جهان افتخار می کنیم.
                            </p>
                        </div>
                        <div class="col-lg-4 col-sm-12 text-center">
                            <a href="https://encomgalaxy.com/">
                                <img width="290" src="{{asset('frontend/assets/images/pages/encom_galaxy/encomgalaxyimage.jpeg')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container mb-5">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 text-center">
                            <img width="700px" src="{{asset('frontend/assets/images/pages/encom_galaxy/yelsu_encom.jpg')}}" alt="">
                        </div>
                    </div>
                </div>

                <div class="tab tab-vertical tab-nav-outline3 ">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab4-1">Buyukcekmeca Vills Pro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-2">Camka</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-3">Dream Villa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-4">Galaxy Villa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-5">MB</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-6">Rvsivillri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-7">Spbkoy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-8">Seven Star Hotel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-9">KURU CESME LAND</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-10">Little Beykoz Palace</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-11">Buyukcekmece land</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-12">Florya Yesilkoy land</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-13">Kayseri Hotel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-14">Kemer Hotel Antalya</a>
                        </li>
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab4-1">
                            <h3 class="title text-left">
                                پروژه ای سرمایه گذاری مناسب افرادی که یک زندگی مدرن و لوکس با حفظ حریم خصوصی را ترجیح می دهند
                            </h3>
                            <h5>مشخصات پروژه:</h5>
                            <ul>
                                <li>پروژه ای مناسب برای اخذ تابعیت ترکیه.</li>
                                <li>طراحی و معماری مدرن با حفظ ظرافت در جزییات.</li>
                                <li>این پروژه شامل 30 ویلا است که در زمینی به مساحت 10700 متر مربع ساخته شده است.</li>
                                <li>هر ویلا شامل 2 سالن، 5 اتاق خواب، 2 آشپزخانه و 6 سرویس بهداشتی می باشد.</li>
                                <li>مساحت کل هر ویلا 510 متر مربع می باشد.</li>
                                <li>متراژ خالص هر ویلا 370 متر مربع می باشد.</li>
                                <li>تمامی ویلاها 4 طبقه و نیم می باشد.</li>
                                <br>
                            </ul>

                            <h5>وجه تمایز این پروژه مجهز بودن آن به امکانات زیر به شکل مستقل و خصوصی است:</h5>
                            <ul>  
                                <li>باغ اختصاصی هر ویلا به مساحت (250 - 350) متر مربع</li>
                                <li>استخر</li>
                                <li>کاملیا</li>
                                <li>جکوزی</li>
                                <li>حمام ترکی</li>
                                <li>سونا</li>
                                <li>باشگاه بدنسازی</li>
                                <li>3 پارکینگ برای هر ویلا</li>
                                <li>هر ویلا مجهز به یک آسانسوردر تمام طبقات</li>
                                <li>فضای باربیکیو در تراس</li>
                                <li>سیستم امنیتی هوشمند</li>
                            </ul>  
                            
                            <h5>تمامی ویلاها دارای خدمات مشترک زیر هستند:</h5>
                            <ul>  
                               <li>فضاهای سبز مشترک</li>
                               <li>داخل مجموعه 1650 متر مربع فضای سبز وجود دارد</li>
                               <li>پارک های بازی کودکان</li>
                               <li>آبشار و دریاچه مصنوعی</li>
                               <li>محل اختصاصی دوچرخه سواری</li>
                               <li>زمین تنیس و بسکتبال</li>
                               <li>امنیت 7/24 با نظارت دوربین ها</li>
                            </ul>  

                            <h5>دسترسی اطراف پروژه:</h5>
                            <ul>  
                              <li>فاصله تا دریای مرمره 2 دقیقه پیاده روی</li>
                              <li>فاصله تا مدارس 2 دقیقه پیاده روی</li>
                              <li>فاصله تا کافه ها و رستوران ها 2 دقیقه پیاده روی</li>
                              <li>فاصله تا مرکز خرید 5 دقیقه پیاده روی</li>
                              <li>فاصله تا فرودگاه 35 دقیقه با وسیله نقلیه</li>
                            </ul>  

                            <h5>اطلاعات تکمیلی:</h5>
                            <ul>  
                                <li>سند مالکیت (تابو) آماده تحویل</li>
                                <li>تحویل ویلا بعد از 12 ماه</li>
                                <li>50٪ پیش پرداخت نقد و مابقی در اقساط 12 ماهه</li>
                            </ul> 

                            <div class="text-center mt-5">
                                <video class="w-100" controls>
                                    <source src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro.mp4')}}" type="video/mp4">
                                </video>
                            </div>
                            
                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro_1.jpg')}}" data-lightbox="image-1" data-title="Buyukcekmeca Vills">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro_1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro_2.jpg')}}" data-lightbox="image-1" data-title="Buyukcekmeca Vills">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro_2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro_3.jpg')}}" data-lightbox="image-1" data-title="Buyukcekmeca Vills">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro_3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro_4.jpg')}}" data-lightbox="image-1" data-title="Buyukcekmeca Vills">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro_4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro_5.jpg')}}" data-lightbox="image-1" data-title="Buyukcekmeca Vills">
                                    <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmeca_Vills_Pro_5.jpg')}}" alt="encom galaxy">
                                </a>
                            </div>

                        </div>
                        
                        <div class="tab-pane" id="tab4-2">
                            <h3 class="title text-left">
                            این پروژه یکی از بهترین، متمایزترین و مجلل ترین پروژه های مسکونی در مرکز استانبول و در دل طبیعت زیبای ترکیه به حساب می آید.
                            </h3>
                            <h5>مکان پروژه :</h5>
                            <ul>
                                <li>این پروژه در منطقه MASLAK در مرکز استانبول، سمت اروپایی واقع شده است.</li>
                                <br>
                            </ul>
                            <h5>اطلاعات پروژه :</h5>
                            <ul>
                                <li>این پروژه در زمینی به مساحت 117000 متر مربع احداث شده است.</li>
                                <li>تعداد ساختمان ها 19 بلوک می باشد.</li>
                                <li>تعداد کل آپارتمان ها 919 آپارتمان است.</li>
                                <li>انواع آپارتمان های موجود عبارتند از: (3 + 1، 4 + 1، 1 + 5)</li>
                                <li>سند مالکیت آماده تحویل است.</li>
                                <li>مناسب برای اخذ تابعیت ترکیه</li>
                                <li>قیمت ها در این پروژه از (1,163,000,00 دلار تا 1,807,000,00 دلار) می باشد.</li>
                                <br>
                            </ul>
                            <h5>امکانات اجتماعی پروژه:</h5>
                            <ul>
                                <li>باشگاه سوارکاری روباز</li>
                                <li>زمین فوتبال / بسکتبال</li>
                                <li>مجموعه ورزشی</li>
                                <li>سونا</li>
                                <li>حمام ترکی</li>
                                <li>رستوران</li>
                                <li>کافه</li>
                                <li>2 استخر (روباز، سرپوشیده)</li>
                                <li>دبستان دولتی</li>
                                <br>
                            </ul>
                            <h5>اماکن اطراف پروژه:</h5>
                            <ul>
                                <li>این پروژه 5 دقیقه با مرکز خرید وادی استامبول فاصله دارد.</li>
                                <li>این پروژه تا مرکز خرید زورلو 10 دقیقه فاصله دارد.</li>
                                <li>این پروژه تا مرکز خرید جواهر 10 دقیقه فاصله دارد.</li>
                                <li>این پروژه تا میدان تقسیم 15 دقیقه فاصله دارد.</li>
                                <li>این پروژه تا ایستگاه مترو 5 دقیقه فاصله دارد.</li>
                                <li>این پروژه 25 دقیقه با فرودگاه جدید استانبول فاصله دارد.</li>
                                <br>
                            </ul>
                            <h5>نحوه پرداخت:</h5>
                            <ul>
                                <li>پرداخت بصورت نقد می باشد</li>
                                <br>
                            </ul>

                            <div class="text-center mt-5">
                                <video class="w-100" controls>
                                    <source src="{{asset('frontend/assets/images/pages/encom_galaxy/camka.mp4')}}" type="video/mp4">
                                </video>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka1.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka2.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka3.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka4.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka5.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka6.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka7.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka7.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka8.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka8.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka9.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka9.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka10.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka10.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                         
                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka11.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka11.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka12.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka12.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                       
                            <div class="text-center mt-5">
                                <a href="{{asset('frontend/assets/images/pages/encom_galaxy/camka13.jpg')}}" data-lightbox="image-2" data-title="Camka">
                                    <img src="{{asset('frontend/assets/images/pages/encom_galaxy/camka13.jpg')}}" alt="encom galaxy">
                                </a>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab4-3">
                            <h3 class="title text-left">
                                فرصتی عالی برای سرمایه گذاری و لذت بردن از یک زندگی مجلل
                            </h3>
                            <h5>درباره پروژه:</h5>
                            <ul>
                                <li>یک پروژه مسکونی منحصر به فرد با ترکیبی از تجملات مدرن، شامل امکانات رفاهی وبهره مندی از زیبایی طبیعت.</li>
                                <li>به مساحت 15000 متر مربع فضای سبز ،مجهز به پارک زیبای (بن لئو) پروژه شامل 8 بلوک در 15 طبقه می باشد.</li>
                                <li>همه آپارتمان ها دارای بالکن های بزرگ هستند، برخی با باغ و تراس خصوصی.</li>
                                <br>
                            </ul>
                            <h5>مشخصات ظاهر پروژه:</h5>
                            <p>این پروژه مشرف به مکان های زیر است:</p>
                            <ul>
                               <li>شهر استانبول، جنگل غنا، برج چاملیگا با چشم انداز دریا و همچنین چشم اندازی از باغ داخلی پروژه</li>
                               <li>تاریخ تحویل پروژه (۶ ژوین) 2024 است.</li>
                               <br>
                            </ul>

                            <div class="text-center mt-5">
                                <video class="w-100" controls>
                                    <source src="{{asset('frontend/assets/images/pages/encom_galaxy/DreamVilla.mp4')}}" type="video/mp4">
                                </video>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{asset('frontend/assets/images/pages/encom_galaxy/DreamVilla1.jpg')}}" data-lightbox="image-3" data-title="DreamVilla">
                                    <img src="{{asset('frontend/assets/images/pages/encom_galaxy/DreamVilla1.jpg')}}" alt="encom galaxy">
                                </a>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab4-4">
                            <h3 class="title text-left">
                                یک ویلا با کیفیت و لوکس در سمت اروپایی استانبول
                            </h3>
                            <h5>درباره پروژه:</h5>
                            <ul>
                                <li>این ویلا در یک مجتمع بزرگ در یک موقعیت عالی بین Beylikduzu و Buyukcekmece واقع شده است.</li>
                                <li>مساحت کل ویلا 400 متر مربع و متراژ خالص 350 متر مربع می باشد.</li>
                                <li>ویلا شامل 6 اتاق و یک اتاق نشیمن، دو حمام در داخل اتاق و چهار حمام مجزا در چهار طبقه می باشد.</li>
                                <li>ویلا دارای سرویس کامل (استخر، باغ، زمین بازی کودکان، سالن بدنسازی) می باشد.</li>
                                <li>بسیار نزدیک به دریا</li>
                                <li>ایستگاه متروبوس در 2 کیلومتری پروژه وجود دارد.</li>
                                <li>بیش از یک مرکز خرید در حدود 3 کیلومتری پروژه وجود دارد.</li>
                                <li>نزدیک پروژه ویلا دو دانشگاه وجود دارد.</li>
                                <li>یک بیمارستان دولتی نیز در این منطقه وجود دارد.</li>
                                <li>آماده تحویل با سند آماده</li>
                                <li>قیمت ویلا 1.100.000 دلار می باشد که با تخفیف به مبلغ 850.000 دلار رسیده است که این قیمت برای مدت زمان مشخص می باشد.</li>
                                <li>پرداخت به صورت نقدی می باشد.</li>
                                <li>مناسب برای اخذ تابعیت ترکیه.</li>
                                <li>تمام کارهای قانونی و شهرداری آن انجام شده و بدون بدهی می باشد.</li>
                                <br>
                            </ul>
                            
                            <div class="text-center mt-5">
                                <video class="w-100" controls>
                                    <source src="{{asset('frontend/assets/images/pages/encom_galaxy/Galaxy_Vila_1.mp4')}}" type="video/mp4">
                                </video>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab4-5">
                            <h5>درباره پروژه:</h5>
                            <ul>
                                <li>این پروژه یکی ازبهترین فرصت های سرمایه گذاری مسکونی می باشد قرار گرفته دریکی از مهمترین محله های
                                    مسکونی در منطقه باشاک شهیر. موقعیت مکانی بی نظیر آن بدلیل قرار گرفتن در نزدیکی مرکز باشاک شهیر و در
                                    فاصله چند دقیقه ای از بزرگترین و مجهزترین بیمارستان پزشکی و بودن در کنار بزرگترین باغ گیاه شناسی و
                                    دسترسی عالی به تمام وسایل حمل و نقل عمومی آن را از سایر پروژه ها متمایز کرده است.</li>
                                <br>
                            </ul>

                            <h5>مکان پروژه:</h5>
                            <ul>
                                <li>این پروژه در باشاک شهیر واقع شده است.</li>
                                <br>
                            </ul>

                            <h5>اطلاعات پروژه:</h5>
                            <ul>
                                <li>این پروژه در زمینی به مساحت 6500 متر مربع احداث شده است.</li>
                                <li>از 6 بلوک به ارتفاع 4 طبقه تشکیل شده است.</li>
                                <li>آپارتمان های در متراژ و سبک های مختلف: (2 + 1 ، 3 + 1 ، 4 + 1).</li>
                                <li>سند مالکیت آماده تحویل است.</li>
                                <li>مناسب برای اخذ تابعیت ترکیه</li>
                                <li>پروژه در دست ساخت است.</li>
                                <li>تاریخ تحویل: 06 / 2024 .</li>
                                <br>
                            </ul>

                            <h5>امکانات رفاهی پروژه:</h5>
                            <ul>
                                <li>باشگاه ورزشی</li>
                                <li>حمام ترکی</li>
                                <li>سونا (بصورت جداگانه برای آقایان و بانوان)</li>
                                <li>هر آپارتمان دارای یک پارکینگ می باشد</li>
                                <li>انباری</li>
                                <br>
                            </ul>

                            <h5>موقعیت مکانی پروژه:</h5>
                            <ul>
                                <li>فاصله این پروژه تا ایستگاه مترو کایاشهیر 3 دقیقه است.</li>
                                <li>این پروژه 20 دقیقه با فرودگاه جدید استانبول فاصله دارد.</li>
                                <li>این پروژه تا شهر پزشکی 3 دقیقه فاصله دارد.</li>
                                <li>این پروژه 3 کیلومتر از کانال استانبول فاصله دارد.</li>
                                <br>
                            </ul>

                            <h5>مدارس و دانشگاه های نزدیک به پروژه:</h5>
                            <ul>
                                <li>مدرسه شرعیه و فقهی امام خطیب و دارای 5 شعبه که در اطراف پروژه .</li>
                                <li>مدرسه بین المللی که 1 کیلومتر با پروژه فاصله دارد .</li>
                                <li>مدرسه بین المللی صنعا 1 کیلومتر با پروژه فاصله دارد.</li>
                                <br>
                            </ul>

                            <h5>روش پرداخت:</h5>
                            <ul>
                                <li>امکان پرداخت بصورت هم نقد و هم أقساط می باشد</li>
                                <li>اقساط: 50% پیش پرداخت و مابقی اقساط 36 ماهه.</li>
                                <br>
                            </ul>
                            
                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB1.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB2.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB3.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB4.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB5.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB6.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB7.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB7.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB8.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB8.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB9.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB9.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB10.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB10.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB11.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB11.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB12.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB12.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB13.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB13.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB14.jpg')}}" data-lightbox="image-4" data-title="MB">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB14.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                           
                            <div class="text-center mt-5">
                                <a href="{{asset('frontend/assets/images/pages/encom_galaxy/MB15.jpg')}}" data-lightbox="image-4" data-title="MB">
                                    <img src="{{asset('frontend/assets/images/pages/encom_galaxy/MB15.jpg')}}" alt="encom galaxy">
                                </a>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab4-6">
                            <h5>درباره پروژه:</h5>
                            <ul>
                                <li>
                                    پروژه ای فوق العاده، یک مجتمع ویلایی با چشم انداز رویایی از دریا.
                                </li>
                                <br>
                            </ul>

                            <h5>مکان پروژه:</h5>
                            <ul>
                                <li>
                                    این پروژه درمنطقه سیلیوری واقع شده است.
                                </li>
                                <br>
                            </ul>

                            <h5>اطلاعات پروژه:</h5>
                            <ul>
                                <li>
                                    مساحت پروژه 8106 متر مربع است.
                                </li>
                                <li>
                                   پروژه شامل 31 ویلا می باشد.
                                </li>
                                <li>
                                  ویلاها در متراژها و انواع مختلف: (1 + 1 ، 3 + 4) که همگی دوبلکس می باشند وجود دارد.
                                </li>
                                <li>
                                    پروژه 500 متر از دریا فاصله دارد.
                                </li>
                                <li>
                                   ویلاها آماده تحویل هستند.
                                </li>
                                <li>
                                    سند مالکیت آماده تحویل است.
                                </li>
                                <li>
                                   مناسب برای اخذ تابعیت ترکیه.
                                </li>
                                <br>
                            </ul>

                            <h5>امکانات اجتماعی و رفاهی پروژه:</h5>
                            <ul>
                                <li>
                                    استخر
                                </li>
                                <li>
                                   پارک و فضای سبز
                                </li>
                                <li>
                                    پارکینگ
                                </li>
                                <li>
                                    سیستم امنیتی 24 / 7
                                </li>
                                <br>
                            </ul>

                            <h5>روش پرداخت:</h5>
                            <ul>
                                <li>
                                    نقد
                                </li>
                                <li>
                                   پارک و فضای سبز
                                </li>
                                <li>
                                    اقساط (50 % پیش پرداخت بصورت نقدی و مابقی در اقساط 6 تا 12 ماه)                             
                                </li>
                                <br>
                            </ul>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri1.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri2.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri3.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri4.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri5.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri6.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri7.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri7.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri8.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri8.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri9.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri9.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri10.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri10.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri11.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri11.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri12.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri12.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri13.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri13.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri14.jpg')}}" data-lightbox="image-5" data-title="Rvsivillr">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/rvsivillri14.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                           
                        </div>

                        <div class="tab-pane" id="tab4-7">
                            <h5>درباره پروژه:</h5>
                            <ul>
                                <li>
                                    یکی از زیباترین و فوقالعادهترین پروژههای ساخته شده بر روی دریای مرمره و متمایزترین پروژه به دلیل داشتن ساحل خاص و طراحیهای متمایز و مجلل است، زیرا ۸۰ درصد مساحت آن مشرف مستقیم به دریا با چشماندازی منحصربه فرد است.
                                </li>
                                <br>
                            </ul>

                            <h5>مکان پروژه:</h5>
                            <ul>
                                <li>
                                    این پروژه در بخش اروپایی استانبول و در منطقه باکرکوی واقع شده است.
                                </li>
                                <br>
                            </ul>

                            <h5>اطلاعات پروژه:</h5>
                            <ul>
                                <li>
                                   پروژه از 4 بلوک تشکیل شده است.
                                </li>
                                <li>
                                    تعداد کل آپارتمان ها 628 آپارتمان است که هر کدام دارای بالکن مخصوص به خود رو به دریا می باشد.
                                </li>
                                <li>
                                    آپارتمان در سبک های مختلف: 1+1، 5، 1+1، 2+1، 3+1، 5، 3+1 (دوبلکس)، 4+1، 5، 4+1، 5، 4+1 (دوبلکس)، 5، 4+1 (پانوراما) می باشد.
                                </li>
                                <li>
                                    پروژه شامل یک هتل می باشد.
                                </li>
                                <li>
                                    سند مالکیت آماده تحویل است.
                                </li>
                                <li>
                                    مناسب برای اخذ تابعیت ترکیه.
                                </li>

                                <br>
                            </ul>

                            <h5>امکانات اجتماعی پروژه:</h5>
                            <ul>
                                <li>
                                    در پایین هر بلوک یک مرکز تناسب اندام تعبیه شده است.
                                </li>
                                <li>
                                    سالن یوگا
                                </li>
                                <li>
                                    سالن پیلاتس
                                </li>
                                <li>
                                    مرحله
                                </li>
                                <li>
                                    سالن های هوازی و رقص
                                </li>
                                <li>
                                    حوضچه های بیولوژیکی
                                </li>
                                <li>
                                    سیستم محافظتی و امنیتی
                                </li>
                                <li>
                                    مسیرهای پیاده روی
                                </li>
                                <li>
                                    مسیرهای دوچرخه سواری
                                </li>
                                <li>
                                    زمین های بازی
                                </li>
                                <li>
                                    4 زمین بازی مختلف برای کودکان
                                </li>
                                <li>
                                    زمین بسکتبال و تنیس
                                </li>
                                <li>
                                    پارکینگ برای هر آپارتمان
                                </li>
                                <li>
                                    یک انباری برای هر آپارتمان
                                </li>
                                <li>
                                    وجود هتل داخل پروژه این امکان را برای ساکنین فراهم کرده که از تمام امکانات هتل با تخفیف استفاده کنند.
                                </li>
                                <li>
                                    مجهز به ایستگاه ماشین های الکتریکی
                                </li>
                                <li>
                                    آپارتمان هایی با آشپزخان بسته مجهز به یخچال نیستند ولی آپارتمان هایی که آشپزخانه اپن دارند، یخچال و سایر لوازم را دارند.
                                </li>

                                <br>
                            </ul>

                            <h5>مکان های اطراف پروژه:</h5>
                            <ul>
                                <li>
                                    این پروژه 4 دقیقه با آتاکوی مگا مارینا فاصله دارد.
                                </li>
                                <li>
                                    این پروژه 5 دقیقه با فرودگاه آتاتورک فاصله دارد.
                                </li>
                                <li>
                                    این پروژه 10 دقیقه با تونل اوراسیا فاصله دارد.
                                </li>
                                <li>
                                    این پروژه 11 دقیقه با جنگل فلوریا آتاتورک فاصله دارد.
                                </li>
                                <li>
                                    این پروژه 11 دقیقه با شبه جزیره تاریخی فاصله دارد.
                                </li>
                                <li>
                                    این پروژه 15 دقیقه با تنگه بسفر فاصله دارد.
                                </li>
                                <br>
                            </ul>

                            <h5>مراکز خرید نزدیک پروژه:</h5>
                            <ul>
                                <li>
                                    این پروژه 3 دقیقه با مرکز خرید گالریا فاصله دارد.
                                </li>
                                <li>
                                    پروژه تا مرکز خرید آتاکوی پلاس یک دقیقه فاصله دارد.
                                </li>
                                <li>
                                    این پروژه تا مرکز خرید آکوا فلوریا 12 دقیقه فاصله دارد.
                                </li>
                                <br>
                            </ul>

                            <h5>بیمارستان های نزدیک پروژه:</h5>
                            <ul>
                                <li>
                                    بیمارستان خصوصی آتاکوی: 7 دقیقه
                                </li>
                                <li>
                                    بیمارستان بین المللی چشم: 4 دقیقه
                                </li>
                                <li>
                                    بیمارستان بین المللی Acıbadem شش دقیقه
                                </li>
                                <li>
                                    بیمارستان Acıbadem چهار دقیقه
                                </li>
                                <li>
                                    در اطراف پروژه امکانات و خدمات اجتماعیو تفریحی زیادی مانند (رستوران های شیک، محوطه قایق های تفریحی و غیره) وجود دارد.
                                </li>
                                <br>
                            </ul>

                            <h5>طریقه پرداخت:</h5>
                            <ul>
                                <li>
                                    پرداخت بصورت نقد می باشد
                                </li>
                               
                                <br>
                            </ul>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy1.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy2.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy3.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy4.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy5.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy6.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy7.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy7.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy8.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy8.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy9.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy9.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy10.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy10.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy11.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy11.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy12.jpg')}}" data-lightbox="image-6" data-title="Spbkoy">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/spbkoy12.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab4-8">
                            <h5>هتل درجه یک و متمایز:</h5>
                            <ul>
                                <li>
                                    یک هتل هفت ستاره مجلل که با شکوه طراحی داخلی و خارجی و موقعیت استثنایی آن مشخص می شود، زیرا این هتل مستقیماً روی دریا در منطقه آتاکوی واقع شده است که یکی از بهترین و مجلل ترین مناطق استانبول است.
                                </li>
                                <br>
                            </ul>

                            <h5>اطلاعات هتل:</h5>
                            <ul>
                                <li>
                                    تاریخ بازگشایی 12/01/2015
                                </li>
                                <li>
                                    مساحت کلی زمین 14898 مترمربع
                                </li>
                                <li>
                                    زیربنای کل 64727 مترمربع
                                </li>
                                <li>
                                    این هتل در حال حاضر در حال فعالیت است.
                                </li>
                                <li>
                                    این هتل یکی از هتل هایی است که در طول ماه های سال با ظرفیت کامل و با ضریب اشغال 98 درصد فعالیت می کند.
                                </li>
                                <li>
                                    هتل از دو بخش توریستی و اقامتی تشکیل شده است.
                                </li>
                                <br>
                            </ul>

                            <h5>بخش توریستی هتل شامل موارد زیر است:</h5>
                            <ul>
                                <li>
                                    تعداد طبقات: 21 طبقه
                                </li>
                                <li>
                                    تعداد اتاق: 284 اتاق
                                </li>
                                <li>
                                    اندازه اتاق ها: از 31 متر مربع تا 230 متر مربع
                                </li>
                                <li>
                                    تعداد تخت: 407 تخت
                                </li>
                                <li>
                                    تعداد سوئیت: 30 سوئیت
                                </li>
                                <li>
                                    تعداد رستوران و آشپزخانه: 4
                                </li>
                                <li>
                                    سالن جشن ها و مجالس به مساحت 3500 متر مربع
                                </li>
                                <li>
                                    استخر: 2 (بسته، باز)
                                </li>
                                <li>
                                    اسکله ای به طول 20 متر وجود دارد که به دریای مرمره می رسد.
                                </li>
                                <br>
                            </ul>

                            <h5>یک اسپای سلامتی با مساحت 4000 متر مربع و شامل:</h5>
                            <ul>
                                <li>
                                    3 حمام ترکی
                                </li>
                                <li>
                                    2 سونا
                                </li>
                                <li>
                                    2 اتاق بخار
                                </li>
                                <li>
                                    5 اتاق ماساژ
                                </li>
                                <li>
                                    جکوزی
                                </li>
                                <br>
                            </ul>

                            <h5>بخش اقامتی هتل شامل موارد زیر است:</h5>
                            <ul>
                                <li>
                                    21 آپارتمان سلطنتی
                                </li>
                                <li>
                                    5 آپارتمان از نوع 7+1 با زیربنای 540 متر مربع است
                                </li>
                                <li>
                                    7 اتاق از نوع 5+1 با زیربنای 377 متر مربع است
                                </li>
                                
                                <br>
                            </ul>

                            <h5>قیمت هتل</h5>
                            <ul>
                                <li>
                                    قیمت هتل در دو قسمت (توریستی و اقامتی) 240,000,000 دلار می باشد. این قیمت یک پیشنهاد انحصاری برای مدت زمان محدود است.
                                </li>
                                <li>
                                    توجه داشته باشید که این هتل در سال 1395 تنها در بخش گردشگری خود بدون بخش اقامتی به ارزش 472,142,580 دلار ارزیابی شده است.
                                </li>
                                <li>
                                    موارد فوق ارزیابی هشت سال پیش است، اما اجازه دهید سعی کنیم بین پروژه های مجاور هتل و هتل خود مقایسه کنیم، متوجه می شویم که قیمت هتل بسیار ارزان است زیرا قیمت هر متر مربع برای یکی از پروژه های مسکونی همسایه : 10000 دلار می باشد (لازم به ذکر است که پروژه در مقایسه با هتل یک پروژه مسکونی است و یک هتل توریستی تجاری نیست)
                                </li>
                                <li>
                                    حال فرض کنید از طریق رابطه زیر قیمت هر متر مربع هتل را با همان قیمت پروژه های مسکونی همسایه محاسبه کنیم: 10,000$ * 64,727 متر مربع = 647,270,000 $
                                </li>
                                <li>
                                    این هتل با قیمت ارزان‌تری نسبت به پروژه‌های مسکونی همسایه برای فروش عرضه می‌شود و این یک فرصت سرمایه‌گذاری ارزشمند است زیرا ما در مورد یک هتل 7 ستاره مدرن و مجهز با چشم‌انداز رو به دریا در مهمترین مناطق استانبول صحبت می‌کنیم. 
                                </li>
                                <br>
                            </ul>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel1.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel2.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel3.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel4.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel5.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel6.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel7.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel7.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel8.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel8.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel9.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel9.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel10.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel10.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel11.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel11.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel12.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel12.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel13.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel13.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel14.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel14.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel15.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel15.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel16.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel16.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel17.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel17.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel18.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel18.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel19.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel19.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel20.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel20.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel21.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel21.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel22.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel22.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel23.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel23.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel24.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel24.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel25.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel25.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel26.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel26.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel27.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel27.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel28.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel28.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel29.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel29.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel30.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel30.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel31.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel31.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel32.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel32.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel33.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel33.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel34.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel34.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel35.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel35.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel36.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel36.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel37.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel37.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel38.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel38.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel39.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel39.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel40.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel40.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel41.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel41.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel42.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel42.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel43.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel43.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel44.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel44.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <a href="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel45.jpg')}}" data-lightbox="image-7" data-title="Seven Star Hotel">
                                <img src="{{asset('frontend/assets/images/pages/encom_galaxy/7starHotel45.jpg')}}" alt="encom galaxy">
                            </a>

                        </div>

                        <div class="tab-pane" id="tab4-9">
                            <h5>فرصت بی نظیر سرمایه گذاری در یک قطعه زمین</h5>
                            <p>این زمین در منطقه بشیکتاش در محله Kuruçeşme واقع شده است که با چشم اندازی فوق العاده به دریا مشرف است. این زمین دارای پروانه ساخت گردشگری است و طرح های آماده ای برای پروژه ای وجود دارد که در صورت تمایل خریدار و در صورت تمایل خریدار برای ایجاد پروژه خود، اعم از اینکه می تواند در این زمین احداث شود. یک ویلا یا یک قصر، هتل یا مجتمع مسکونی است. امکان انتقال این مجوز به آن پروژه وجود دارد و بعداً تمام جزئیات پروژه و برنامه های آن را روشن خواهیم کرد.</p>

                            <h5 class="mt-4">اطلاعات و جزییات زمین:</h5>
                            <ul>
                                <li>
                                    مساحت زمین 3928 متر مربع است.
                                </li>
                                <li>
                                    قیمت زمین: 110.000.000 دلار
                                </li>
                                <li>
                                    این زمین تمامی مجوزها و مجوزها را از وزارت گردشگری و شهرداری بشیکتاش دریافت کرده است.
                                </li>
                                <li>
                                    این پروژه شامل دو ساختمان است که هر ساختمان شامل چهار طبقه است.
                                </li>
                                <br>
                            </ul>

                            <h5>مشخصات طبقات:</h5>
                            <ul>
                                <li>
                                    طبقه زیر زمین: 3x1980 = 5940 متر مربع
                                </li>
                                <li>
                                    طبقه همکف: 1x1875 = 1875 متر مربع
                                </li>
                                <li>
                                    سایر طبقات: 3x1266 = 3798 متر مربع
                                </li>
                                <li>
                                    زیر شیروانی: 1x521 = 521 متر مربع
                                </li>
                                <li>
                                    زیربنای کل 12134 متر مربع
                                </li>
                                <li>
                                    مساحت زمین 3896 متر مربع
                                </li>

                                <br>
                            </ul>

                            <h5>مساحت و تعداد اتاق های توزیع شده در طبقات به شرح زیر است:</h5>
                            <ul>
                                <li>
                                    مساحت 35 متر مربع (16) اتاق
                                </li>
                                <li>
                                    مساحت 36 متر مربع، تعداد (4) اتاق
                                </li>
                                <li>
                                    مساحت 40 متر مربع، تعداد (20) اتاق
                                </li>
                                <li>
                                    مساحت 55 متر مربع، تعداد (5) اتاق
                                </li>
                                <li>
                                    مساحت 56.5 متر مربع، تعداد (4) اتاق
                                </li>
                                <li>
                                    مساحت 65 متر مربع، تعداد (2) اتاق
                                </li>
                                <li>
                                    مساحت 75 متر مربع، اتاق شماره (1).
                                </li>

                                <br>
                            </ul>

                            <h5>موارد استفاده از هر طبقه به شرح زیر است:</h5>
                            <ul>
                                <li>
                                    طبقه (3) زیر زمین برای موارد زیر استفاده می شود: مساحت پارکینگ: 1133 متر مربع
                                </li>
                                <li>
                                    طبقه (2) زیر زمین برای موارد زیر استفاده می شود: سالن عروسی و مجالس با مساحت 1125 متر مربع
                                </li>
                                <li>
                                    کف (1) زیر زمین برای موارد زیر استفاده می شود: اتاق عروس 24 متر مربع اتاق داماد 13 متر مربع است
                                </li>

                                <br>
                            </ul>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND1.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND2.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND3.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND4.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND5.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND6.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND7.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND7.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND8.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND8.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND9.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND9.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND10.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND10.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND11.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND11.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND12.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND12.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND13.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND13.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND14.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND14.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND15.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND15.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND16.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND16.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND17.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND17.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND18.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND18.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND19.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND19.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND20.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND20.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND21.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND21.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND22.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND22.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND23.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND23.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND24.jpg')}}" data-lightbox="image-8" data-title="KURU CESME LAND">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/KURU_CESME_LAND24.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="tab4-10">
                            <h5>یک فرصت منحصر به فرد برای داشتن یک قصر مستقیماً در تنگه بسفر</h5>

                            <h5 class="mt-4">درباره کاخ:</h5>
                            <ul>
                                <li>
                                    کاخ هایی که در تنگه بسفر واقع شده اند با زیبایی و زیبایی سبک معماری متمایز خود مشخص می شوند، جایی که هر کاخ دارای سبک خاصی است که نشان دهنده یک دوره زمانی است که باعث شده این کاخ ها میراث فرهنگی مهمی برای شهر به حساب بیایند. استانبول و کاخی که به شما نشان می دهیم، کاخی است که در سمت راست دو قصر دوتایی که مستقیماً روی دریا (صفر روی دریا) واقع شده است و یکی از کاخ های تاریخی به حساب می آید.
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">موقعیت کاخ:</h5>
                            <ul>
                                <li>
                                    این کاخ در بخش آسیایی استانبول، در بیکوز، به طور خاص در منطقه Paşabahçe واقع شده است.
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">مشخصات کاخ:</h5>
                            <ul>
                                <li>
                                    این کاخ در سمت راست دو کاخ قرار دارد.
                                </li>
                                <li>
                                    مساحت کل 490 متر مربع است.
                                </li>
                                <li>
                                    مساحت مفید 380 متر مربع است.
                                </li>
                                <li>
                                    این کاخ از 4 طبقه تشکیل شده است.
                                </li>
                                <li>
                                    7 اتاق
                                </li>
                                <li>
                                    یک اتاق نشیمن
                                </li>
                                <li>
                                    باغ پشت 75 متر مربع
                                </li>
                                <li>
                                    باغ زمستانی
                                </li>
                                <li>
                                    منطقه ای به فاصله 8 متر از دریا برای افراد زیر سن قانونی اختصاص دارد
                                </li>
                                <li>
                                    آسانسور
                                </li>
                                <li>
                                    بالکن بزرگ
                                </li>
                                <li>
                                    بالکن کوچک
                                </li>
                                <li>
                                    قیمت کاخ 4.500.000 دلار است.
                                </li>

                                <br>
                            </ul>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace1.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace2.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace3.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace4.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace5.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace6.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace7.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace7.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace8.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace8.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace9.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace9.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace10.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace10.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace11.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace11.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace12.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace12.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace13.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace13.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace14.jpg')}}" data-lightbox="image-9" data-title="Little Beykoz Palace">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Little_Beykoz_Palace14.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                            
                        </div>

                        <div class="tab-pane" id="tab4-11">
                            <h5>فرصت طلایی برای سرمایه گذاری</h5>

                            <h5 class="mt-4">اطلاعات و جزییات زمین:</h5>
                            <ul>
                                <li>
                                    این زمین در منطقه Buyukcekmece در قسمت اروپایی استانبول واقع شده است.
                                </li>
                                <br>
                            </ul>

                            <h5>ویژگی های مکانی زمین:</h5>
                            <ul>
                                <li>
                                    این زمین در کنار بزرگترین پروژه های منطقه مانند پروژه (کنت) و پروژه (توسکانی) و نزدیک به آن واقع شده است. در محوطه نمایشگاه، چند قدم دورتر، و همچنین زمین مشرف به دریا و دریاچه، نزدیک به مرکز شهر.
                                </li>
                                <br>
                            </ul>

                            <h5>مساحت زمین:</h5>
                            <ul>
                                <li>
                                    38554.17 مترمربع
                                </li>
                                <br>
                            </ul>

                            <h5>وضعیت زمین:</h5>
                            <ul>
                                <li>
                                    زمین مناسب برای ساخت پروژه ویلا می باشد که امکان ساخت حدوداً 34 ویلا یا بیشتر  به درخواست خریدار وجود دارد.
                                </li>
                                <br>
                            </ul>

                            <h5>سند مالکیت (تاپو):</h5>
                            <ul>
                                <li>
                                    آماده
                                </li>
                                <br>
                            </ul>

                            <h5>قیمت:</h5>
                            <ul>
                                <li>
                                    17 میلیون دلار
                                </li>
                                <br>
                            </ul>

                            <h5>ملاحضات:</h5>
                            <ul>
                                <li>
                                    زمین با تمایل خود مشخص می شود و این امر خریدار را قادر می سازد از افزایش مساحت ساخت بهره مند شود. توجه داشته باشید که برای پروژه ویلاها طرحی وجود دارد که می توان آن را روی زمین ساخت.
                                </li>
                                <br>
                            </ul>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land1.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land2.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land3.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land4.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land5.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land6.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land17.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land7.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land8.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land8.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land9.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land9.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land10.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land10.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land11.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land11.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land12.jpg')}}" data-lightbox="image-10" data-title="Buyukcekmece land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Buyukcekmece_land12.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                            
                        </div>

                        <div class="tab-pane" id="tab4-12">
                            <h5>فرصت عالی برای سرمایه گذاری</h5>

                            <h5 class="mt-4">اطلاعات و جزییات زمین:</h5>
                            <ul>
                                <li>
                                    این زمین در منطقه Florya / Sislikoy در قسمت اروپایی استانبول واقع شده است
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">مساحت زمین:</h5>
                            <ul>
                                <li>
                                    1375 مترمربع
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">وضعیت زمین:</h5>
                            <ul>
                                <li>
                                    زمین دارای پروانه ساخت و آماده بازسازی به صورت مستقیم می باشد و تمامی هزینه های شهرداری پرداخت شده است .
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">مشخصات بنا:</h5>
                            <ul>
                                <li>
                                    3 آپارتمان دوبلکس در طبقه آخر مساحت هر آپارتمان 350 متر مربع می باشد
                                </li>
                                <li>
                                    6 آپارتمان در طبقه وسط، متراژ هر آپارتمان 200 متر مربع
                                </li>
                                <li>
                                    3 آپارتمان تیپ 2 + 1 در طبقه همکف متراژ هر آپارتمان 125 متر مربع
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">تعداد کل آپارتمان ها:</h5>
                            <ul>
                                <li>
                                    12 آپارتمان
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">ملاحضات:</h5>
                            <ul>
                                <li>
                                    سرمایه گذار می تواند ساخت سیستم آپارتمان را لغو و ویلای جداگانه بسازد و پروانه ساخت به پروانه ویلاسازی مستقل تبدیل می شود.
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">ویژگی های زمین:</h5>
                            <ul>
                                <li>
                                    زمین در کنار فرودگاه آتاتورک و پارک ملی بزرگ قرار دارد که حتی بزرگتر خواهد بود باغی در اروپا از یک سو و واقع در ساحل شنی دریا از سوی دیگر
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">قیمت:</h5>
                            <ul>
                                <li>
                                    15 میلیون دلار
                                </li>
                                <br>
                            </ul>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land1.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land2.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land3.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land4.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land5.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land6.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land7.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land7.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land8.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land8.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land9.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land9.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land10.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land10.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land11.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land11.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land12.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land12.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land13.jpg')}}" data-lightbox="image-11" data-title="Florya Yesilkoy land">
                                    <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Florya_Yesilkoy_land13.jpg')}}" alt="encom galaxy">
                                </a>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab4-13">
                            <h5>یک فرصت بی نظیر سرمایه گذاری سودآور</h5>

                            <h5 class="mt-4">هتل پنج ستاره:</h5>
                            <ul>
                                <li>
                                    هتل پنج ستاره لوکس، در معتبرترین مکان شهر قیصری ترکیه،
                                    توسط شرکت (Divan) 
                                    با قرارداد 10 ساله با مبلغ سالانه (27.000.000 لیر ترکیه) 
                                    اجاره شده است.
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">اطلاعات هتل:</h5>
                            <ul>
                                <li>
                                    مساحت هتل: 4450 مترمربع
                                </li>
                                <li>
                                    تعداد طبقات: 10 طبقه
                                </li>
                                <li>
                                    تاریخ تاسیس هتل: دو سال پیش.
                                </li>
                                <li>
                                    قیمت هتل: 265.000.000 لیر ترکیه معادل 14.000.000 دلار.
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">رتبه بندی هتل:</h5>
                            <ul>
                                <li>
                                    این هتل در فوریه 2022 مورد ارزیابی قرار گرفت.
                                    با ارزش 328,538,485 لیر ترکیه
                                    با علم به اینکه وقتی هتل مورد ارزیابی قرار گرفت، با نرخی کمتر از 30 درصد قیمت بازار در آن زمان ارزیابی شد.
                                </li>
                                <li>
                                    قیمت هتل برای سال جاری 410,673,107 لیر ترکیه برآورد شده است. که معادل 21,578,947 دلار است.
                                </li>
                               
                                <br>
                            </ul>

                            <h5 class="mt-4">ملاحضات:</h5>
                            <ul>
                                <li>
                                    سود شش سال اول هتل برابر با ارزش خرید آن است و چهار سال بعد سود خالص هتل است.
                                </li>
                               
                                <br>
                            </ul>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel1.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel2.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel3.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel4.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel5.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel6.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel7.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel7.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel8.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel8.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel9.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel9.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel10.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel10.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel11.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel11.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel12.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel12.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel13.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel13.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel14.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel14.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel15.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel15.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel16.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel16.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel17.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel17.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel18.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel18.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel19.jpg')}}" data-lightbox="image-12" data-title="Kayseri Hotel">
                                    <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kayseri_Hotel19.jpg')}}" alt="encom galaxy">
                                </a>
                            </div>
                            
                        </div>

                        <div class="tab-pane" id="tab4-14">
                            <h5>فرصت سرمایه گذاری عالی
                            </h5>
                            <h5>هتل چهار ستاره</h5>

                            <h5 class="mt-4">موقعیت:</h5>
                            <ul>
                                <li>
                                    این هتل در منطقه کمر، استان آنتالیا واقع شده است.
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">مساحت کل زمین:</h5>
                            <ul>
                                <li>
                                     2126 مترمربع
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">زیربنای کل:</h5>
                            <ul>
                                <li>
                                     4000 مترمربع
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">تعداد اتاق ها:</h5>
                            <ul>
                                <li>
                                    86 اتاق
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">تعداد تخت:</h5>
                            <ul>
                                <li>
                                    200 تخت
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">فاصله از دریا:</h5>
                            <ul>
                                <li>
                                    فاصله هتل تا دریا 150 متر است.
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">سطح هتل:</h5>
                            <ul>
                                <li>
                                    4 ستاره
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">استاندارد هتل اطراف:</h5>
                            <ul>
                                <li>
                                    تمامی هتل های اطراف هتل 5 ستاره هستند.
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">قیمت هتل:</h5>
                            <ul>
                                <li>
                                    5.5 میلیون دلار
                                </li>
                                <br>
                            </ul>

                            <h5 class="mt-4">امکانات اجتماعی و خدماتی:</h5>
                            <ul>
                                <li>
                                    این هتل دارای یک استخر آبگرم روباز است.
                                </li>
                                <br>
                            </ul>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya1.jpg')}}" data-lightbox="image-13" data-title="Kemer Hotel Antalya1">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya1.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya2.jpg')}}" data-lightbox="image-13" data-title="Kemer Hotel Antalya1">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya2.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya3.jpg')}}" data-lightbox="image-13" data-title="Kemer Hotel Antalya1">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya3.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya4.jpg')}}" data-lightbox="image-13" data-title="Kemer Hotel Antalya1">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya4.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya5.jpg')}}" data-lightbox="image-13" data-title="Kemer Hotel Antalya1">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya5.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
    
                                <div class="text-center mt-5 col-md-6 col-xs-12">
                                    <a href="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya6.jpg')}}" data-lightbox="image-13" data-title="Kemer Hotel Antalya1">
                                        <img src="{{asset('frontend/assets/images/pages/encom_galaxy/Kemer_Hotel_Antalya6.jpg')}}" alt="encom galaxy">
                                    </a>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>


            </section>          
        </div>

      
    </div>
</main>


<script>
$(document).on("click", ".nav-item", function (e) {
    $('video').trigger('pause');
})
</script>

@endsection