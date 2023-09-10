@extends('frontend.main_theme')
@section('main')

<main class="main">
   <!-- Start of Page Header -->
   <div class="page-header">
    <div class="container">
        <h1 class="page-title mb-0">تأمین مالی</h1>
    </div>
</div>
<!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>تأمین مالی</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    
    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <section class="introduce mb-10 financingPage">
                <p class=" mx-auto">
                    طبق قانون رفع موانع تولید رقابت پذیر و ارتقای نظام مالی کشور، شرکت ارمغان تجارت مغان با نام برند یلسو در جهت حل و فصل مشکلات واحدهای تولیدی و صنعتی، بنگاه‌های تولیدی، انبوه‌سازی‌ها، شرکت‌های دانش بنیان و غیره، تأمین مالی برای خرید کالا و پیش‌برد پروژه‌ها و یا طرح‌های جدید و یا نیمه تمام را ارائه می‌دهد.
                    <br>
                    <br>
                    جهت مشاهده و مطالعه قانون رفع موانع تولید رقابت‌پذیر و ارتقای نظام مالی کشور از سامانه قوانین و مقررات جمهوری اسلامی ایران بر روی اینجا کلیک نمایید.
                    <br>
                    <br>
                    ارمغان تجارت مغان ارائه‌دهنده سه نوع تأمین مالی زیر است:
                    <br>
                    
                    1. تأمین مالی خرید کالا، مصالح و ملزومات ساختمانی و صنعتی
                    <br>
                    2. تأمین مالی پروژه یا طرح‌های تولیدی و ساختمانی
                    <br>
                    3. تأمین مالی سرمایه در گردش بنگاه‌های تولیدی
                    <br>
                    <br>
                    برای اطلاع از شرایط و مراحل اجرایی تأمین مالی مد نظرتان کافیست بر روی آن کلیک نمایید.
                </p>

                <div class="tab tab-vertical tab-nav-outline3 ">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab4-4">1- تامین مالی خرید کالا، مصالح و ملزومات ساختمانی و صنعتی</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-5">2- تامین مالی پروژه یا طرح های تولیدی و ساختمانی</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab4-6">3- تامین مالی سرمایه در گردش بنگاه های تولیدی </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab4-4">
                            <img src="{{asset('frontend/assets/images/pages/financing/financing1.png')}}" alt="financial banner">
                            
                            <h2 class="title mt-5">
                                تامین مالی پروژه یا طرح های تولیدی
                            </h2>
                            <p>
                                1- شرکت مطابق با قانون رفع موانع تولید رقابت پذیر و ارتقای نظام مالی کشور مصوب سال 1394 (ماده 138 مکرر) و قوانین جاری بین الملل و همچنین بر اساس پشتوانه ایجاد شده از محل اعتبارسازی خود و گروه همراه، تأمین مالی را از مسیرهای قانونی و سرمایه گذاران ایجاد و در حساب خود دریافت نموده و در قالب مشارکت با شرایط بازپرداخت و بهره سالانه به روش فاینانس در پروژه توافق شده تا پایان مدت بازپرداخت سرمایه، شریک شده و با بازپرداخت هر قسط (با توافق، سالانه و/یا شش ماهه و/یا سه ماهه و/یا ماهانه) از میزان شراکت کاهش و از ضمانت بازپرداخت به سرمایه پذیر برگشت داده می شود.
                                <br><br>
                                2- مبنای مبلغ تامین مالی خرید کالا و شرایط پرداخت و بازپرداخت آن بر اساس خلاصه طرح توجیهی (Feasibility Study) و ارزیابی ضمانت بازپرداخت و حصول اطمینان از توانایی بازپرداخت سرمایه و بهره سالانه مشخص می گردد.
                                <br><br>
                                3- جاری شدن قرارداد با پرداخت سپرده به شرح موارد زیر می باشد:
                                <br><br>
                                1-3- پیش پرداخت (شامل هزینه های قرارداد):
                                <br><br>
                            </p>


                            <div class="pp-table-container mb-5">
                                <table class="pp-table">
                                                <colgroup>
                                                <col span="1" class="elementor-repeater-item-69db855"></colgroup>
                                        <tfoot>
                                        </tfoot>
                                    <tbody>
                                    <tr>
                                        <th class="pp-table-cell pp-table-cell-7680e47" colspan="4">
                                            <span class="pp-table-cell-content"><span class="pp-table-cell-text">سرمایه درخواستی</span>
                                        </span>
                                        </th>
                                            <td class="pp-table-cell pp-table-cell-68cc617">
                                                <span class="pp-table-cell-content"><span class="pp-table-cell-text">تا یک میلیون یورو</span>
                                            </span>
                                            </td>
                                                <td class="pp-table-cell pp-table-cell-4bb50f1"><span class="pp-table-cell-content">
                                                    <span class="pp-table-cell-text">1 تا 2 میلیون یورو</span>
                                                </span>
                                                </td>
                                                    <td class="pp-table-cell pp-table-cell-a84e539">
                                                        <span class="pp-table-cell-content"><span class="pp-table-cell-text">2 تا 3 میلیون یورو</span>
                                                    </span>
                                                </td>
                                                    <td class="pp-table-cell pp-table-cell-35e5cdc">
                                                        <span class="pp-table-cell-content">
                                                        <span class="pp-table-cell-text">3 تا 5 میلیون یورو</span>
                                                    </span>
                                                </td>
                                                </tr>
                                                    <tr>
                                                        <th class="pp-table-cell pp-table-cell-d612cb9" colspan="4">
                                                        <span class="pp-table-cell-content"><span class="pp-table-cell-text">مبلغ پیش پرداخت</span>
                                                    </span>
                                                </th>
                                                        <td class="pp-table-cell pp-table-cell-35fad4d">
                                                            <span class="pp-table-cell-content">
                                                            <span class="pp-table-cell-text">2000 یورو</span>
                                                        </span>
                                                    </td>
                                                    <td class="pp-table-cell pp-table-cell-200cd15">
                                                            <span class="pp-table-cell-content">
                                                            <span class="pp-table-cell-text">4000 یورو</span>
                                                        </span>
                                                        </td>
                                                    <td class="pp-table-cell pp-table-cell-0037dc8">
                                                        <span class="pp-table-cell-content">
                                                        <span class="pp-table-cell-text">6000 یورو</span>
                                                    </span>
                                                    </td>
                                                    <td class="pp-table-cell pp-table-cell-b4ff0cd">
                                                        <span class="pp-table-cell-content">
                                                                <span class="pp-table-cell-text">10000 یورو</span>
                                                        </span>
                                                    </td>
                                        </tr>		
                                    </tbody>
                                </table>
                            </div>
                            مبلغ هزینه ابتدایی تامین مالی خرید کالا همزمان با امضا قرارداد توسط سرمایه پذیر پرداخت می گردد. مبلغ هزینه ابتدایی در صورت عدم پرداخت کامل سپرده در زمان مقرر که باعث فسخ قرارداد خواهد شد غیر قابل برگشت بوده و در صورت جاری شدن قرارداد با پرداخت کامل سپرده، این مبلغ از سپرده کسر می شود.
                            <br><br>
                            2-3- پرداخت سپرده: کل مبلغ سپرده معادل ده درصد ( 10 %) مبلغ سرمایه درخواستی با حداقل یکصد هزار یورو (000/ 100 یورو) است. کل مبلغ سپرده تا پایان قرارداد نزد تامین کننده سرمایه باقی می ماند و در پایان قرارداد با تسویه حساب کامل اصل و بهره مربوطه در آخرین قسط به سرمایه پذیر برگشت داده می شود.
                            <br>
                            ده درصد تامین سرمایه خرید کالا با کسر مبلغ پیش پرداخت شده در بند سه، طی و حداکثر پانزده روز کاری (15 روز) بعد از عقد قرارداد و واریز پیش پرداخت توسط سرمایه پذیر در مقابل ضمانت توافقی طرفین با توجه به شرایط بروز تامین کننده سرمایه (ملک/ ضمانت بانک داخلی و یا خارجی) می باشد.
                            <br><br>
                            4- مبلغ سرمایه درخواستی با توجه به توافق و شرایط قرارداد در یک یا چند فاز با سپرده گذاری جداگانه تامین و به سرمایه پذیر پرداخت می گردد.
                            <br><br>
                            5- پروسه زمانی اجرا و پرداخت سرمایه طی و ماکزیمم تا نود روز ( 90 روز) با توجه به مبلغ سرمایه و محل و نحوه دریافت سرمایه انجام می شود.
                            <br><br>
                            6- ضمانت بازپرداخت اصل و بهره سرمایه به میزان تعیین شده به روش های توافقی (ضمانت ملکی، ضمانت های بانکی) انجام می گردد.
                            <br><br>
                            7- زمان پرداخت سرمایه، ضمانت سپرده از ضمانت بازپرداخت کسر و به تامین کننده سرمایه برگشت داده می شود.
                            <br><br>
                            8- مدت بازپرداخت سرمایه طبق طرح توجیهی (FS) طی 1 تا 2 سال است. در موارد خاص طی بررسی لازم و توافق دوره بازپرداخت قابل تغییر است.
                            <br><br>
                            9- چنانچه پرداخت و بازپرداخت به صورت ارز یورو باشد، بهره سالانه بصورت توافقی و کمتر از هفت درصد (7 %) باقیمانده سرمایه در زمان بازپرداخت هر قسط است.
                            <br><br>
                            10- چنانچه پرداخت و بازپرداخت به صورت ریالی در داخل کشور باشد بهره سالانه بصورت توافقی و مطابق با نرخ بهره بانکی، باقیمانده سرمایه در زمان بازپرداخت هر قسط است و باقیمانده بازپرداخت در سال بعد با نرخ روز یورو محاسبه و تمدید می گردد.
                            <br><br>
                            11- پرداخت کارمزد تیم مدیریتی، کارشناسی، کارگزاری، هزینه های دولتی و غیره به طور کامل بر عهده سرمایه پذیر است و به میزان دو درصد (2%) کل تسهیلات دریافتی می باشد.
                            <br><br>
                            12- مطابق با پروسه اجرایی شرح داده شده، شروع کار با درخواست رسمی (LOI) از سوی سرمایه پذیر و پیوست طرح توجیهی (FS) همزمان با عقد قرارداد خواهد بود.
                            <br><br>

                        </div>
                        <div class="tab-pane" id="tab4-5">
                            <img src="{{asset('frontend/assets/images/pages/financing/financing2.png')}}" alt="financial banner">
                            
                            <h2 class="title mt-5">
                                مراحل اجرایی تامین سرمایه خرید کالا
                            </h2>
                            <p>
                                1- شرکت مطابق با قانون رفع موانع تولید رقابت پذیر و ارتقای نظام مالی کشور مصوب سال 1394 (ماده 138 مکرر) و قوانین جاری بین الملل و همچنین بر اساس پشتوانه ایجاد شده از محل اعتبارسازی خود و گروه همراه، تأمین مالی را از مسیرهای قانونی و سرمایه گذاران ایجاد و در حساب خود دریافت نموده و در قالب مشارکت با شرایط بازپرداخت و بهره سالانه به روش فاینانس در پروژه توافق شده تا پایان مدت بازپرداخت سرمایه، شریک شده و با بازپرداخت هر قسط (با توافق، سالانه و/یا شش ماهه و/یا سه ماهه و/یا ماهانه) از میزان شراکت کاهش و از ضمانت بازپرداخت به سرمایه پذیر برگشت داده می شود.
                                <br><br>
                                2- مبنای مبلغ تامین مالی خرید کالا و شرایط پرداخت و بازپرداخت آن بر اساس خلاصه طرح توجیهی (Feasibility Study) و ارزیابی ضمانت بازپرداخت و حصول اطمینان از توانایی بازپرداخت سرمایه و بهره سالانه مشخص می گردد.
                                <br><br>
                                3- جاری شدن قرارداد با پرداخت سپرده به شرح موارد زیر می باشد:
                                <br><br>
                                1-3- پیش پرداخت (شامل هزینه های قرارداد):
                                <br><br>
                            </p>


                            <div class="pp-table-container mb-5">
                                <table class="pp-table">
                                                <colgroup>
                                                <col span="1" class="elementor-repeater-item-69db855"></colgroup>
                                        <tfoot>
                                        </tfoot>
                                    <tbody>
                                    <tr>
                                        <th class="pp-table-cell pp-table-cell-7680e47" colspan="4">
                                            <span class="pp-table-cell-content"><span class="pp-table-cell-text">سرمایه درخواستی</span>
                                        </span>
                                        </th>
                                            <td class="pp-table-cell pp-table-cell-68cc617">
                                                <span class="pp-table-cell-content"><span class="pp-table-cell-text">1 تا 2 میلیون یورو</span>
                                            </span>
                                            </td>
                                                <td class="pp-table-cell pp-table-cell-4bb50f1"><span class="pp-table-cell-content">
                                                    <span class="pp-table-cell-text">3 تا 5 میلیون یورو</span>
                                                </span>
                                                </td>
                                                    <td class="pp-table-cell pp-table-cell-a84e539">
                                                        <span class="pp-table-cell-content"><span class="pp-table-cell-text">6 تا 10 میلیون یورو</span>
                                                    </span>
                                                </td>
                                                    <td class="pp-table-cell pp-table-cell-35e5cdc">
                                                        <span class="pp-table-cell-content">
                                                        <span class="pp-table-cell-text">11 تا 20 میلیون یورو</span>
                                                    </span>
                                                </td>

                                                <td class="pp-table-cell pp-table-cell-a84e539">
                                                    <span class="pp-table-cell-content"><span class="pp-table-cell-text">بیش از 21 میلیون یورو</span>
                                                </span>
                                                </td>
                                                
                                                </tr>
                                                    <tr>
                                                        <th class="pp-table-cell pp-table-cell-d612cb9" colspan="4">
                                                        <span class="pp-table-cell-content"><span class="pp-table-cell-text">مبلغ پیش پرداخت</span>
                                                    </span>
                                                </th>
                                                        <td class="pp-table-cell pp-table-cell-35fad4d">
                                                            <span class="pp-table-cell-content">
                                                            <span class="pp-table-cell-text">2000 یورو</span>
                                                        </span>
                                                    </td>
                                                    <td class="pp-table-cell pp-table-cell-200cd15">
                                                            <span class="pp-table-cell-content">
                                                            <span class="pp-table-cell-text">5000 یورو</span>
                                                        </span>
                                                        </td>
                                                    <td class="pp-table-cell pp-table-cell-0037dc8">
                                                        <span class="pp-table-cell-content">
                                                        <span class="pp-table-cell-text">10000 یورو</span>
                                                    </span>
                                                    </td>
                                                    <td class="pp-table-cell pp-table-cell-b4ff0cd">
                                                        <span class="pp-table-cell-content">
                                                                <span class="pp-table-cell-text">20000 یورو</span>
                                                        </span>
                                                    </td>
                                                    <td class="pp-table-cell pp-table-cell-b4ff0cd">
                                                        <span class="pp-table-cell-content">
                                                                <span class="pp-table-cell-text">توافقی</span>
                                                        </span>
                                                    </td>
                                        </tr>		
                                    </tbody>
                                </table>
                            </div>
                            مبلغ هزینه ابتدایی تامین مالی خرید کالا همزمان با امضا قرارداد توسط سرمایه پذیر پرداخت می گردد. مبلغ هزینه ابتدایی در صورت عدم پرداخت کامل سپرده در زمان مقرر که باعث فسخ قرارداد خواهد شد غیر قابل برگشت بوده و در صورت جاری شدن قرارداد با پرداخت کامل سپرده، این مبلغ از سپرده کسر می شود.
                            <br><br>
                            2-3- پرداخت سپرده: کل مبلغ سپرده معادل ده درصد ( 10 %) مبلغ سرمایه درخواستی با حداقل یکصد هزار یورو (000/ 100 یورو) است. کل مبلغ سپرده تا پایان قرارداد نزد تامین کننده سرمایه باقی می ماند و در پایان قرارداد با تسویه حساب کامل اصل و بهره مربوطه در آخرین قسط به سرمایه پذیر برگشت داده می شود.
                            <br>
                            ده درصد تامین سرمایه خرید کالا با کسر مبلغ پیش پرداخت شده در بند سه، طی و حداکثر پانزده روز کاری (15 روز) بعد از عقد قرارداد و واریز پیش پرداخت توسط سرمایه پذیر در مقابل ضمانت توافقی طرفین با توجه به شرایط بروز تامین کننده سرمایه (ملک/ ضمانت بانک داخلی و یا خارجی) می باشد.
                            <br><br>
                            4- مبلغ سرمایه درخواستی با توجه به توافق و شرایط قرارداد در یک یا چند فاز با سپرده گذاری جداگانه تامین و به سرمایه پذیر پرداخت می گردد.
                            <br><br>
                            5- پروسه زمانی اجرا و پرداخت سرمایه طی و ماکزیمم تا نود روز ( 90 روز) با توجه به مبلغ سرمایه و محل و نحوه دریافت سرمایه انجام می شود.
                            <br><br>
                            6- ضمانت بازپرداخت اصل و بهره سرمایه به میزان تعیین شده به روش های توافقی (ضمانت ملکی، ضمانت های بانکی) انجام می گردد.
                            <br><br>
                            7- زمان پرداخت سرمایه، ضمانت سپرده از ضمانت بازپرداخت کسر و به تامین کننده سرمایه برگشت داده می شود.
                            <br><br>
                            8- مدت بازپرداخت سرمایه طبق طرح توجیهی (FS) طی 1 تا 5 سال است. در موارد خاص طی بررسی لازم و توافق دوره بازپرداخت قابل تغییر است.
                            <br><br>
                            9- چنانچه پرداخت و بازپرداخت به صورت ارز یورو باشد، بهره سالانه بصورت توافقی و کمتر از هفت درصد (7 %) باقیمانده سرمایه در زمان بازپرداخت هر قسط است.
                            <br><br>
                            10- چنانچه پرداخت و بازپرداخت به صورت ریالی در داخل کشور باشد بهره سالانه بصورت توافقی و مطابق با نرخ بهره بانکی، باقیمانده سرمایه در زمان بازپرداخت هر قسط است و باقیمانده بازپرداخت در سال بعد با نرخ روز یورو محاسبه و تمدید می گردد.
                            <br><br>
                            11- پرداخت کارمزد تیم مدیریتی، کارشناسی، کارگزاری، هزینه های دولتی و غیره به طور کامل بر عهده سرمایه پذیر است و به میزان یک و شش دهم درصد (1.6%) کل تسهیلات دریافتی می باشد.
                            <br><br>
                            12- مطابق با پروسه اجرایی شرح داده شده، شروع کار با درخواست رسمی (LOI) از سوی سرمایه پذیر و پیوست طرح توجیهی (FS) همزمان با عقد قرارداد خواهد بود.
                            <br><br>
                        </div>
                        <div class="tab-pane" id="tab4-6">
                            <img src="{{asset('frontend/assets/images/pages/financing/financing3.png')}}" alt="financial banner">
                            
                            <h2 class="title mt-5">
                                تامین مالی سرمایه در گردش بنگاه های تولیدی
                            </h2>
                            <p>
                                1- شرکت مطابق با قانون رفع موانع تولید رقابت پذیر و ارتقای نظام مالی کشور مصوب سال 1394 (ماده 138 مکرر) و قوانین جاری بین الملل و همچنین بر اساس پشتوانه ایجاد شده از محل اعتبارسازی خود و گروه همراه، تأمین مالی را از مسیرهای قانونی و سرمایه گذاران ایجاد و در حساب خود دریافت نموده و در قالب مشارکت با شرایط بازپرداخت و بهره سالانه به روش فاینانس در پروژه توافق شده تا پایان مدت بازپرداخت سرمایه، شریک شده و با بازپرداخت هر قسط (با توافق، سالانه و/یا شش ماهه و/یا سه ماهه و/یا ماهانه) از میزان شراکت کاهش و از ضمانت بازپرداخت به سرمایه پذیر برگشت داده می شود.
                                <br><br>
                                2- مبنای مبلغ تامین مالی خرید کالا و شرایط پرداخت و بازپرداخت آن بر اساس خلاصه طرح توجیهی (Feasibility Study) و ارزیابی ضمانت بازپرداخت و حصول اطمینان از توانایی بازپرداخت سرمایه و بهره سالانه مشخص می گردد.
                                <br><br>
                                3- جاری شدن قرارداد با پرداخت سپرده به شرح موارد زیر می باشد:
                                <br><br>
                                1-3- پیش پرداخت (شامل هزینه های قرارداد):
                                <br><br>
                            </p>


                            <div class="pp-table-container mb-5">
                                <table class="pp-table">
                                                <colgroup>
                                                <col span="1" class="elementor-repeater-item-69db855"></colgroup>
                                        <tfoot>
                                        </tfoot>
                                    <tbody>
                                    <tr>
                                        <th class="pp-table-cell pp-table-cell-7680e47" colspan="4">
                                            <span class="pp-table-cell-content"><span class="pp-table-cell-text">سرمایه درخواستی</span>
                                        </span>
                                        </th>
                                            <td class="pp-table-cell pp-table-cell-68cc617">
                                                <span class="pp-table-cell-content"><span class="pp-table-cell-text">1 تا 2 میلیون یورو</span>
                                            </span>
                                            </td>
                                                <td class="pp-table-cell pp-table-cell-4bb50f1"><span class="pp-table-cell-content">
                                                    <span class="pp-table-cell-text">2 تا 3 میلیون یورو</span>
                                                </span>
                                                </td>
                                                    <td class="pp-table-cell pp-table-cell-a84e539">
                                                        <span class="pp-table-cell-content"><span class="pp-table-cell-text">3 تا 4 میلیون یورو</span>
                                                    </span>
                                                </td>
                                                    <td class="pp-table-cell pp-table-cell-35e5cdc">
                                                        <span class="pp-table-cell-content">
                                                        <span class="pp-table-cell-text">4 تا 5 میلیون یورو</span>
                                                    </span>
                                                </td>
                                                </tr>
                                                    <tr>
                                                        <th class="pp-table-cell pp-table-cell-d612cb9" colspan="4">
                                                        <span class="pp-table-cell-content"><span class="pp-table-cell-text">مبلغ پیش پرداخت</span>
                                                    </span>
                                                </th>
                                                        <td class="pp-table-cell pp-table-cell-35fad4d">
                                                            <span class="pp-table-cell-content">
                                                            <span class="pp-table-cell-text">2000 یورو</span>
                                                        </span>
                                                    </td>
                                                    <td class="pp-table-cell pp-table-cell-200cd15">
                                                            <span class="pp-table-cell-content">
                                                            <span class="pp-table-cell-text">6000 یورو</span>
                                                        </span>
                                                        </td>
                                                    <td class="pp-table-cell pp-table-cell-0037dc8">
                                                        <span class="pp-table-cell-content">
                                                        <span class="pp-table-cell-text">8000 یورو</span>
                                                    </span>
                                                    </td>
                                                    <td class="pp-table-cell pp-table-cell-b4ff0cd">
                                                        <span class="pp-table-cell-content">
                                                                <span class="pp-table-cell-text">15000 یورو</span>
                                                        </span>
                                                    </td>
                                        </tr>		
                                    </tbody>
                                </table>
                            </div>
                            مبلغ هزینه ابتدایی تامین مالی خرید کالا همزمان با امضا قرارداد توسط سرمایه پذیر پرداخت می گردد. مبلغ هزینه ابتدایی در صورت عدم پرداخت کامل سپرده در زمان مقرر که باعث فسخ قرارداد خواهد شد غیر قابل برگشت بوده و در صورت جاری شدن قرارداد با پرداخت کامل سپرده، این مبلغ از سپرده کسر می شود.
                            <br><br>
                            2-3- پرداخت سپرده: کل مبلغ سپرده معادل ده درصد ( 10 %) مبلغ سرمایه درخواستی با حداقل یکصد هزار یورو (000/ 100 یورو) است. کل مبلغ سپرده تا پایان قرارداد نزد تامین کننده سرمایه باقی می ماند و در پایان قرارداد با تسویه حساب کامل اصل و بهره مربوطه در آخرین قسط به سرمایه پذیر برگشت داده می شود.
                            <br>
                            ده درصد تامین سرمایه خرید کالا با کسر مبلغ پیش پرداخت شده در بند سه، طی و حداکثر پانزده روز کاری (15 روز) بعد از عقد قرارداد و واریز پیش پرداخت توسط سرمایه پذیر در مقابل ضمانت توافقی طرفین با توجه به شرایط بروز تامین کننده سرمایه (ملک/ ضمانت بانک داخلی و یا خارجی) می باشد.
                            <br><br>
                            4- مبلغ سرمایه درخواستی با توجه به توافق و شرایط قرارداد در یک یا چند فاز با سپرده گذاری جداگانه تامین و به سرمایه پذیر پرداخت می گردد.
                            <br><br>
                            5- پروسه زمانی اجرا و پرداخت سرمایه طی و ماکزیمم تا نود روز ( 90 روز) با توجه به مبلغ سرمایه و محل و نحوه دریافت سرمایه انجام می شود.
                            <br><br>
                            6- ضمانت بازپرداخت اصل و بهره سرمایه به میزان تعیین شده به روش های توافقی (ضمانت ملکی، ضمانت های بانکی) انجام می گردد.
                            <br><br>
                            7- زمان پرداخت سرمایه، ضمانت سپرده از ضمانت بازپرداخت کسر و به تامین کننده سرمایه برگشت داده می شود.
                            <br><br>
                            8- مدت بازپرداخت سرمایه طبق طرح توجیهی (FS) طی 1 تا 5 سال است. در موارد خاص طی بررسی لازم و توافق دوره بازپرداخت قابل تغییر است.
                            <br><br>
                            9- چنانچه پرداخت و بازپرداخت به صورت ارز یورو باشد، بهره سالانه بصورت توافقی و کمتر از هفت درصد (7 %) باقیمانده سرمایه در زمان بازپرداخت هر قسط است.
                            <br><br>
                            10- چنانچه پرداخت و بازپرداخت به صورت ریالی در داخل کشور باشد بهره سالانه بصورت توافقی و مطابق با نرخ بهره بانکی، باقیمانده سرمایه در زمان بازپرداخت هر قسط است و باقیمانده بازپرداخت در سال بعد با نرخ روز یورو محاسبه و تمدید می گردد.
                            <br><br>
                            11- پرداخت کارمزد تیم مدیریتی، کارشناسی، کارگزاری، هزینه های دولتی و غیره به طور کامل بر عهده سرمایه پذیر است و به میزان یک و هشت دهم درصد (1.8%) کل تسهیلات دریافتی می باشد.
                            <br><br>
                            12- مطابق با پروسه اجرایی شرح داده شده، شروع کار با درخواست رسمی (LOI) از سوی سرمایه پذیر و پیوست طرح توجیهی (FS) همزمان با عقد قرارداد خواهد بود.
                            <br><br>
                        </div>
                    </div>
                </div>


            </section>          
        </div>

      
    </div>
</main>

@endsection