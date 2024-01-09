@extends('frontend.main_theme')
@section('main')


<main class="main">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">تماس با ما</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav pb-5">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>تماس با ما</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
<div class="page-content contact-us">
                <div class="container">
                    

                    <section class="content-title-section mb-10">
                        <h3 class="title title-center mb-3">اطلاعات تماس
                        </h3>
                        <p class="text-center">می‌توانید از طریق زیر با فروشگاه یلسو (yelsu) در ارتباط باشید و ایمیل ارسال کنید:</p>
                    </section>
                    <!-- End of Contact Title Section -->

                    <section class="contact-information-section mb-10">
                        <div class=" swiper-container swiper-theme " data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 1,
                            'breakpoints': {
                                '480': {
                                    'slidesPerView': 2
                                },
                                '768': {
                                    'slidesPerView': 3
                                },
                                '992': {
                                    'slidesPerView': 3
                                }
                            }
                        }">
                            <div class="swiper-wrapper row cols-xl-3 cols-md-3 cols-sm-2 cols-1">
                                <div class="swiper-slide icon-box text-center icon-box-primary">
                                    <span class="icon-box-icon icon-email">
                                        <i class="w-icon-envelop-closed"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">آدرس ایمیل </h4>
                                        <p><a href="mailto:info@yelsu.com">info@yelsu.com</a></p>
                                    </div>
                                </div>
                                <div class="swiper-slide icon-box text-center icon-box-primary">
                                    <span class="icon-box-icon icon-phone">
                                        <i class="w-icon-phone"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">شماره تلفن </h4>
                                        <p class="mb-1">تلفن دفتر مرکزی: <a href="tel:02126402540">49-02126402540</a></p>
                                        {{-- <p>تلفن گویا: <a href="tel:02126402540">02126402540</a></p> --}}
                                        <p>فکس: <a href="tel:02126402550">02126402550</a></p>
                                    </div>
                                </div>
                                <div class="swiper-slide icon-box text-center icon-box-primary">
                                    <span class="icon-box-icon icon-map-marker">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">آدرس دفتر مرکزی</h4>
                                        <p>تهران، بلوار میرداماد، روبروی بانک مرکزی، برج رز، طبقه 11، واحد 1104 و 1106</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End of Contact Information section -->

                    <hr class="divider mb-10 pb-1">

                    <section class="contact-section">
                        <div class="row gutter-lg pb-3">
                            <div class="col-lg-6 mb-8">
                                <h4 class="title mb-3">پرسش های متداول</h4>
                                <div class="accordion accordion-bg accordion-gutter-md accordion-border">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="#collapse1" class="collapse">چگونه می توانم سفارش خود را لغو کنم؟</a>
                                        </div>
                                        <div id="collapse1" class="card-body expanded">
                                            <p class="mb-0">
                                                
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <a href="#collapse2" class="expand">چرا ثبت نام من به تاخیر افتاد؟</a>
                                        </div>
                                        <div id="collapse2" class="card-body collapsed">
                                            <p class="mb-0">
                                                
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <a href="#collapse3" class="expand">برای خرید محصولات به چه چیزهایی نیاز دارم؟</a>
                                        </div>
                                        <div id="collapse3" class="card-body collapsed">
                                            <p class="mb-0">
                                                
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <a href="#collapse4" class="expand">چگونه می توانم سفارش را پیگیری کنم؟</a>
                                        </div>
                                        <div id="collapse4" class="card-body collapsed">
                                            <p class="mb-0">
                                                
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <a href="#collapse5" class="expand">چگونه می توانم پول را پس بگیرم؟</a>
                                        </div>
                                        <div id="collapse5" class="card-body collapsed">
                                            <p class="mb-0">
                                                
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                   
                                <h4 class="title mb-3">تماس با ما</h4>
                                <form class="form contact-us-form" action="{{route('blog.contactus.send')}}" method="post">
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
                                        <label for="message">پیام *</label>
                                        <textarea id="message" name="message" cols="30" rows="5" 
                                            class="form-control">{{old('message')}}</textarea>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="message">عبارت امنیتی داخل تصویر را وارد نمایید *</label>
                                        <div class="row">
                                            <div class="form-group col-lg-8">
                                                <input type="text" name="captcha" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-1 text-right">
                                                <button type="button" class="btn btn-secondary btn-sm btn-rounded reload" id="reload">
                                                    <i class="w-icon-return2"></i>
                                                </button>
                                            </div>
                                            <div class="form-group col-lg-3 text-right captcha">
                                                {!! captcha_img(env("MEWEBSTUDIO_CAPTCHA", "default")) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-dark btn-rounded">ارسال کنید</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                    <!-- End of Contact Section -->
                </div>

                <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
                {{-- <div class="google-map contact-google-map" id="googlemaps"></div> --}}
                <!-- End Map Section -->
            </div>
            <!-- End of PageContent -->
    
</main>
<!-- End of Main -->

<script>
    $('#reload').click(function(){
        $.ajax({
            type: "GET",
            url: "reload-captcha",
            success: function(data) {
                $('.captcha').html(data.captcha);
            }
        });
    });
</script>

@endsection