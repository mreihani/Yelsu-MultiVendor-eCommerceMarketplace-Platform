@extends('frontend.main_theme')
@section('main')


<main class="main">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">سیاست حفظ حریم خصوصی</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-1">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>سیاست حفظ حریم خصوصی</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    
    <!-- Start of Page Content -->
    <div class="page-content" id="privacyPolicyPage">
        {{-- <section class="boost-section pb-5">
            <div class="container">
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 mb-8">
                        <figure class="br-lg">
                            <img src="{{asset('frontend/assets/images/pages/about_us/yelsu-1024x683.jpg')}}" alt="Banner"
                                width="610" height="450" style="background-color: #9E9DA2;" />
                        </figure>
                    </div>
                    <div class="col-md-6 pl-lg-8 mb-8" style="text-align: justify">
                        <h4 class="title text-left">
                            معرفی شرکت
                        </h4>
                        <p class="mb-6">شرکت دانش بنیان ارمغان تجارت مغان با نام برند یلسو (yelsu) با پشتوانۀ متخصصین مجرب در زمینۀ بازرگانی و صادرات انواع محصولات حجیم بصورت عمده فعالیت دارد. چشم‌انداز و اهداف اصلی شرکت، فعالیت در حوزه بازرگانی، توسعه و تجاری‌سازی می‌باشد. بنابراین برای دستیابی به این مهم اقدام به واردات و صادرات، تأمین و توزیع انواع محصولات فولادی فلزی، محصولات ساختمانی و عمران، محصولات کشاورزی و مشتقات نفتی نموده است و به ارزشها و مشی سازمانی پایبند است.
                            <br><br>
                            ارمغان تجارت مغان با بهره‌گیری از توانایی کارشناسانی با تجربه، امکان ارائه خدمات در زمینۀ تحقیق و توسعه فرآوری، استخراج و بارگیری محصولات معدنی را دارد و خدمات خود را در اقصی نقاط کشور عزیزمان ارائه می‌دهد.</p>
                        <div style="text-align: end">
                            <a href="{{asset('frontend/assets/images/pages/about_us/yelsu_catalogue_2.pdf')}}" class="btn btn-dark btn-rounded">
                                <i class="w-icon-fax"></i>
                                کاتالوگ شرکت
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <section class="introduce">
            <div class="container">
                {{-- <h2 class="title">
                    سیاست حفظ حریم خصوصی
                </h2> --}}
                <p class="mx-auto">
                                        به پلتفرم اقتصادی یلسو خوش آمدید. ما اهمیت زیادی برای حفاظت از اطلاعات شخصی شما قائل هستیم. لطفا متن زیر را بخوانید تا بیشتر با نحوه برخورد یلسو با اطلاعاتی که هویت شما را فاش می کند آشنا شوید.
                    اطلاعات شخصی شما محرمانه تلقی و بر اساس سیاست حفاظت از حریم خصوصی، نگهداری می‌شود. ما آن‌ها را نه منتشر خواهیم کرد و نه در اختیار دیگر مراجع خواهیم گذاشت.
                    <br><br>
                    1- جمع آوری و استفاده از اطلاعات
                    <br>
                    یلسو تنها مالک اطلاعات جمع آوری شده در این وبسایت است. ما این اطلاعات را به هیچ نحو نفروخته، اجاره نداده و به اشتراک نمی گذاریم.
                    برخی از خدمات ما را می‌توانید حتی بدون ثبت نام در وب سایت به راحتی استفاده کنید. با این حال، برای استفاده از همه ویژگی‌های سایت، می‌توانید برای خودتان حساب کاربری ایجاد کنید.
                    ما برای سرویس دهی بهتر برخی از داده‌های شخصی را پردازش و منعکس می‌کنیم. این امر به ویژه برای داده‌های زیر است:
                    <br>

                    <ul>
                        <li>
                        نام کاربری
                        </li>
                        <li>
                            آدرس پست الکترونیکی
                        </li>
                        <li>
                            رمز عبور
                        </li>
                    </ul>

                    کاربران دیگر در هیچ صورت و هیچ زمانی قادر به مشاهده آدرس پست الکترونیکی و رمز عبور شما نخواهند بود. ما این اطلاعات را به اشخاص ثالث و هر منبع دیگری نخواهیم داد. همچنین برخی اطلاعات دیگر که در مورد شما ذخیره شده است، به عنوان مثال، اگر شما داده‌های اضافی در مشخصات شخصی خودتان اضافه کرده باشید و یا اگر با مدیریت وب سایت ارتباط برقرار کرده باشید. توجه داشته باشید که این اطلاعات غیر اجباری است.
                    <br>

                    ممکن است برای کاربران به دلایل مختلف ایمیل ارسال ‌کنیم از جمله برای ثبت نام، آگهی در مورد پیام‌های تازه دریافت شده و غیره. ایمیل‌های ارسالی از سوی همکاران این وب سایت ذخیره می‌شوند. ایمیل هایی که مربوط به کسب و کار باشند در طول دوره حفظ قانونی حذف نخواهند شد. همچنین نشانی‌های پست الکترونیکی که به آن ایمیل ارسال گردیده اما دریافت نشده‌اند، در بایگانی حفظ می‌شوند.
                    <br><br>
                    2- ویرایش و تغییر اطلاعات شخصی

                    <ul>
                        <li>
                            شما می توانید کلیه اطلاعات شخصی خود را در بخش مربوط به کاربری خودتان تغییر داده و ویرایش کنید. این اطلاعات شامل کلیه اطلاعاتی است که شما در سایت وارد کرده اید.
                        </li>
                        <li>
                            حساب شما توسط شما قابل حذف شدن از سیستم نمی باشد و تنها توسط مدیریت امکانپذیر است.
                        </li>
                    </ul>

                    3- استفاده از کوکی ها
                    <br>
                    وقتی شما از یلسو بازدید می کنید، می توانید به صورت ناشناس در وبسایت بگردید. به عنوان یک کاربر میهمان، ممکن است برای بررسی بازدید شما از کوکی استفاده کنیم. همچنین اگر به عنوان یک کاربر  عضو از یلسو استفاده کنید.
                    کوکی حجم کوچکی از اطلاعات است که توسط یک وب سرور به مرورگر وب شما انتقال می یابد و تنها توسط سروری که آن را برای شما فرستاده قابل خواندن است. کوکی با ذخیره سازی اطلاعات کاربری شما، همانند کارت شناسایی عمل می کند. کوکی نمی تواند دستوری را اجرا و یا ویروسی را منتقل کند.
                    <br>
                    بیشتر مرورگر های وب به صورت پیش فرض کوکی ها را می پذیرند. شما می توانید به مرورگر وب خود دستور دهید که به هنگام دریافت کوکی به شما اطلاع دهد و این اجازه را بدهد که آن را پذیرفته یا رد کنید. توجه داشته باشید با غیرفعال کردن کوکی‌ها دیگر نمی‌توانید از ویژگی‌هایی مانند ورود اتوماتیک در وب سایت استفاده کنید.
                    <br><br>
                    4- فایل های گزارش وقایع
                    <br>
                    ما ممکن است از IP Address شما (آدرس کامپیوتر شما بر روی اینترنت) برای بررسی روند ها، مدیریت وبسایت، بررسی جابجایی کاربران و جمع آوری اطلاعات آماری در سطح وسیع استفاده کنیم. این اطلاعات نمی توانند هویت شما را فاش کنند و شما همچنان ناشناس باقی می مانید. مگر اینکه به طریق دیگری اطلاعات شخصی خود را در اختیار ما گذاشته باشید.
                    <br><br>
                    5- پیوند ها
                    <br>
                    در بازه های زمانی مختلف، وبسایت یلسو ممکن است شامل پیوندهایی به دیگر وبسایت ها باشد. آگاه باشید که ما مسئولیتی در قبال شیوه های حفظ حریم خصوصی آن ها نخواهیم داشت. ما کاربرانمان را تشویق می کنیم که هنگام خروج از وبسایت ما آگاه باشند و بیانیه های حفظ حریم خصوصی هر وبسایتی که اطلاعات شخصی کاربران را جمع آوری می کند را، مطالعه کنند. این بیانیه فقط به اطلاعات جمع آوری شده توسط وبسایت یلسو اعمال می گردد.
                    <br><br>
                    6- امنیت
                    <br>
                    شما به عنوان یک کاربر ثبت نام کرده (عضو)، جهت محافظت اطلاعات شخصی و امنیت، از یک حساب کاربری که توسط رمز عبور تان محافظت می شود، بهره می برید.
                    <br><br>
                    7- اصلاح و یا به روز رسانی اطلاعات شخصی
                    <br>
                    در صورتی که اطلاعات شخصی کاربری (که هویت او را فاش می کنند مانند ایمیل) تغییر کند، یا اگر کاربر دیگر علاقه به استفاده از سرویس های ما نداشته باشد، تلاش کرده ایم تا راهی جهت اصلاح، به روز رسانی و یا از بین بردن اطلاعات شخصی کاربر فراهم آوریم. این کار می تواند از طریق ارسال ایمیل به پشتیبانی مشتریان انجام شود.
                    <br><br>
                    8- اطلاع رسانی از تغییرات
                    <br>
                    اگر زمانی تصمیم بر آن شد که سیاست های حفظ حریم خصوصی وبسایت را تغییر دهیم، آن تغییرات را بر روی صفحه به روز رسانی قرار خواهیم داد تا کاربرانمان همیشه از اطلاعات جمع آوری شده، نحوه استفاده و احتمال و شرایط افشای آن آگاه باشند. اگر در هر برهه تاریخی به هر دلیل تصمیم به استفاده از اطلاعات شخصی کاربر بگیریم که در زمان ثبت نام ذکری از آن ها نبوده، توسط یک ایمیل او را آگاه خواهیم کرد. پس از آن کاربر این انتخاب را خواهد داشت که آیا اطلاعاتش در این راه استفاده شود و یا خیر. ما از اطلاعات، تحت توافقی که در سیاست های حفظ حریم خصوصی در زمان جمع آوری آن ها صورت گرفته، استفاده خواهیم کرد.
                    <br><br>
                    9- تماس
                    <br>
                    اعتماد کاربران برای ما مهم است. بر همین اصل یلسو آماده پاسخگویی به سوالات کاربران در رابطه با پردازش داده‌های شخصی خود، در هر زمان است. اگر سوالی دارید که در این متن سیاست حفظ حریم خصوصی پاسخ داده نشده و یا اگر مایل هستید اطلاعات بیشتری در مورد هر بند این متن بدست آورید، لطفا با ایمیل زیر تماس بگیرید:
                    <br><br>
                    
                    <h4 class="mail-info">
                        <a href="mailto:info@yelsu.com ">
                            <i class="w-icon-envelop3"></i>
                            info@yelsu.com 
                        </a>
                    </h4>
                </p>
            </div>
        </section>
      
    </div>
</main>
<!-- End of Main -->








@endsection