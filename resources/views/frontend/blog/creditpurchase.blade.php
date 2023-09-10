@extends('frontend.main_theme')
@section('main')


<main class="main">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">خرید اعتباری</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav pb-5">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>خرید اعتباری</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    
    <!-- Start of Page Content -->
    <div class="page-content creditPurchase">

        <section class="boost-section pb-5">
            <div class="container">
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 pl-lg-8 mb-8" style="text-align: justify">
                        <h4 class="title text-left">به اعتبارت تکیه کن!</h4>
                        <p class="mb-6">
                            در صورتی که این سرویس برای شما فعال شده باشد می توانید بدون پرداخت نقدی با اعتبار خود از شرکت ارمغان تجارت مغان خرید کرده و محصول مورد نظر خود را دریافت کنید. هر شخص حقیقی و حقوقی می تواند کلیه محصولات موجود در سایت ( yelsu.com ) را به صورت اعتباری از ما خریداری کند.
                        </p>    
                        <div class="text-center">
                            <a href="#creditPurchaseForm" class="btn btn-dark btn-rounded">درخواست خرید اعتباری</a>
                            <a href="tel:02122902471" class="btn ctusbtn btn-rounded">ثبت نام از طریق تماس</a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-8">
                        <figure class="br-lg"  style="text-align: left">
                            <img src="{{asset('frontend/assets/images/pages/credit_purchase/credit_purchase1.jpg')}}" alt="Banner"
                                width="415" style="background-color: #9E9DA2;" />
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section class="boost-section pb-5">
            <div class="container">
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 mb-8">
                        <figure class="br-lg">
                            <img src="{{asset('frontend/assets/images/pages/credit_purchase/credit_purchase2.jpg')}}" alt="Banner"
                                width="415" style="background-color: #9E9DA2;" />
                        </figure>
                    </div>
                    <div class="col-md-6 pl-lg-8 mb-8" style="text-align: justify">
                        <h4 class="title text-left">
                            خرید با چک معتبر
                        </h4>
                        <p class="mb-6">
                            می‌توانید با ارائه شماره حساب جاری که می‌خواهید از آن چک بدهید، روند تأیید را تسریع کنید. حساب شما باید سه معیار زیر را داشته باشد:
                            <br>
                            – به هیچ وجه نباید چک برگشتی داشته باشید.
                            <br>
                            – میانگین حساب شما باید با مبلغی که درخواست کرده اید مطابقت داشته باشد.
                            <br>
                            – حساب شما باید حداقل سه ساله باشد.
                        </p>    
                        <div class="text-center">
                            <a href="#creditPurchaseForm" class="btn btn-dark btn-rounded">درخواست خرید اعتباری</a>
                            <a href="tel:02122902471" class="btn ctusbtn btn-rounded">ثبت نام از طریق تماس</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="boost-section pb-5">
            <div class="container">
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 pl-lg-8 mb-8" style="text-align: justify">
                        <h4 class="title text-left">خرید با اعتبار اسنادی (LC)</h4>
                        <p class="mb-6">
                            با خرید از طریق اعتبار اسنادی می توانید ریسک معاملات کلان را از بین ببرید و با اطمینان کامل خرید کنید. این روش خرید چند مزیت کلی نسبت به خرید با استفاده از چک دارد:
                            <br>
                            – مطمئن هستید که کالای شما به موقع توسط یک شرکت بی طرف و قابل اعتماد بررسی می شود. 
                            <br>
                            – کارمزد ماهیانه کمتری نسبت به روش خرید چک پرداخت خواهید کرد.
                            <br>
                            – تسویه حساب شما از یک ماه تا شش ماه پس از افتتاح اعتبار می تواند انجام شود.
                            <br>
                            – بنابراین برخلاف خرید اعتبار با چک، هیچ محدودیت ریالی برای خرید شما از سایت ما وجود ندارد!
                        </p>    
                        <div class="text-center">
                            <a href="#creditPurchaseForm" class="btn btn-dark btn-rounded">درخواست خرید اعتباری</a>
                            <a href="tel:02122902471" class="btn ctusbtn btn-rounded">ثبت نام از طریق تماس</a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-8">
                        <figure class="br-lg"  style="text-align: left">
                            <img src="{{asset('frontend/assets/images/pages/credit_purchase/credit_purchase3.jpg')}}" alt="Banner"
                                width="415" style="background-color: #9E9DA2;" />
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section class="boost-section pb-5">
            <div class="container">
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 mb-8">
                        <figure class="br-lg">
                            <img src="{{asset('frontend/assets/images/pages/credit_purchase/credit_purchase4.jpg')}}" alt="Banner"
                                width="415" style="background-color: #9E9DA2;" />
                        </figure>
                    </div>
                    <div class="col-md-6 pl-lg-8 mb-8" style="text-align: justify">
                        <h4 class="title text-left">
                            خرید با ضمانت نامه بانکی
                        </h4>
                        <p class="mb-6">
                            شما می توانید با اعتباری که در بانک خود دارید ضمانتنامه تعهد پرداخت تهیه کنید و تا سقف ضمانت نامه خود بدون محدودیت ریالی از ما خرید کنید.
                        </p>    
                        <div class="text-center">
                            <a href="#creditPurchaseForm" class="btn btn-dark btn-rounded">درخواست خرید اعتباری</a>
                            <a href="tel:02122902471" class="btn ctusbtn btn-rounded">ثبت نام از طریق تماس</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="boost-section pb-5">
            <div class="container">
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 pl-lg-8 mb-8" style="text-align: justify">
                        <h4 class="title text-left">خرید با اوراق گام</h4>
                        <p class="mb-6">
                            اوراق گواهی اعتبار مولد که به اختصار «گام» نامیده می‌شوند، سازوکاری را ایجاد خواهند کرد که واحدهای تولیدی به‌جای دریافت تسهیلات از بانک‌ها، به اعتبار و ضمانت بانک تکیه کرده و از این طریق تامین مواد اولیه مورد نیاز خود را انجام دهند.
                        </p>    
                        <div class="text-center">
                            <a href="#creditPurchaseForm" class="btn btn-dark btn-rounded">درخواست خرید اعتباری</a>
                            <a href="tel:02122902471" class="btn ctusbtn btn-rounded">ثبت نام از طریق تماس</a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-8">
                        <figure class="br-lg"  style="text-align: left">
                            <img src="{{asset('frontend/assets/images/pages/credit_purchase/credit_purchase5.jpg')}}" alt="Banner"
                                width="415" style="background-color: #9E9DA2;" />
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section id="creditPurchaseForm" class="content-title-section mb-10 contactFormSection ml-5 mr-5">
            <div class="col-lg-6 mb-8">
                @if(session()->has('success'))
                    <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5  mt-5 mb-5">
                        <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
                    </div>
                @endif
    
                @foreach($errors->all() as $error)
                    <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
                        <h4 class="alert-title" style="color:#ffa800">
                            <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                            {{$error}}
                    </div>
                @endforeach
    
                <h3 class="title title-center mb-3">اطلاعات تماس
                </h3>
                <p class="text-center">
                    درخواست خود را می توانید از طریق فرم زیر برای ما ارسال نمایید:
                </p>

                <form class="form contact-us-form" action="{{route('blog.creditPurchase')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="username">نام و نام خانوادگی *</label>
                        <input type="text" id="username" name="name" value="{{old('name')}}"
                            class="form-control">
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="number">شماره تماس *</label>
                            <input type="number" id="number" name="number" value="{{old('number')}}"
                                class="form-control">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="email_1">ایمیل *</label>
                            <input type="email" id="email_1" name="email" value="{{old('email')}}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">نوع خرید اعتباری *</label>
                        <select name="type" class="form-control" id="exampleFormControlSelect1">
                          <option>چک</option>
                          <option>اعتبار اسنادی (LC)</option>
                          <option>ضمانت نامه بانکی</option>
                          <option>اوراق گام</option>
                          <option>سایر موارد</option>
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="message">توضیحات </label>
                        <textarea id="message" name="message" cols="30" rows="5" 
                            class="form-control">{{old('message')}}</textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-dark btn-rounded">ارسال کنید</button>
                    </div>
                </form>
            <div>    
        </section>
    </div>
</main>
<!-- End of Main -->


@endsection