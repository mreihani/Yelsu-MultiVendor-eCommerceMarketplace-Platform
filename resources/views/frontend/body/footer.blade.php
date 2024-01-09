
<footer class="footer appear-animate" data-animation-options="{
    'name': 'fadeIn'
    }">
            @if(!Request::is('login', 'register'))
                @include('frontend.body.layout.newsletter')
            @endif

            <div class="container">
                <div class="footer-top">
                    <div class="footer-flex-class">

                        <div class="flex-col">
                            <div class="widget" >
                                <a href="{{ URL::to('/') }}" class="logo-footer d-flex flex-row justify-content-center mb-3">
                                    <img src="{{asset('frontend/assets/images/demos/demo13/logo.png')}}" alt="logo-footer" width="144"
                                        height="45" />
                                </a>
                            </div>
                        </div>

                        <div class="flex-col">
                            <div class="widget" >
                                <ul class="widget-body text-center">
                                    <li><b>آدرس دفتر مرکزی:</b> تهران، بلوار میرداماد، روبروی بانک مرکزی، برج رز، طبقه 11، واحد 1104 و 1106</li>
                                    <li><b>کدپستی:</b> 1919991986</li>
                                    <li><b>تلفن دفتر مرکزی:</b><a href="tel:02126402540"> 9-02126402540</a></li>
                                    <li><b>فکس:</b><a href="tel:02126402550"> 02126402550</a></li>
                                    {{-- <li><b>تلفن گویا:</b><a href="tel:02126402540"> 02126402540</a></li> --}}
                                    <li><b>ایمیل:</b><a href="mailto:info@yelsu.com"> info@yelsu.com</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="flex-col">
                            <div class="widget text-center">
                                <h3 class="widget-title">همکاران ما خارج از کشور </h3>
                                <ul class="widget-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            {{-- <li><a href="">آمریکا</a></li> --}}
                                            <li><a href="">آلمان</a></li>
                                            <li><a href="#">اتریش</a></li>
                                            <li><a href="#">قزاقستان</a></li>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            {{-- <li><a href="#">روسیه </a></li> --}}
                                            <li><a href="#">امارات </a></li>
                                            <li><a href="#">عمان</a></li>
                                            <li><a href="#">ترکیه</a></li>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div class="flex-col">
                            <div class="widget text-center">
                                <h4 class="widget-title">شبکه های اجتماعی</h4>
                                <ul class="widget-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-md-6 col-sm-6 social-media-col">
                                            <li>
                                                <a href="https://www.instagram.com/yelsu_com/"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/instagram.png')}}" alt="یلسو"/> </a>
                                            </li>
        
                                            <li  class="mt-4">
                                                <a href="https://twitter.com/Yelsu_com"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/twitter.png')}}" alt="یلسو"/> </a>
                                            </li>
                                        
                                            <li class="mt-3">
                                                <a href="https://t.me/yelsu_com"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/telegram.png')}}" alt="یلسو"/> </a>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-sm-6 social-media-col">
                                            <li>
                                                <a href="https://eitaa.com/yelsu_com"><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/eita.png')}}" alt="یلسو"/> </a>
                                            </li>
        
                                            <li>
                                                <a href=""><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/robica.png')}}" alt="یلسو"/> </a>
                                            </li>
        
                                            <li>
                                                <a href=""><img width="20" src="{{asset('frontend/assets/images/yelsu_images/social_media/linkedin.png')}}" alt="یلسو"/> </a>
                                            </li>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="flex-col">
                            <div class="widget text-center">
                                <div class="container text-center">
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="https://eanjoman.ir/member/f3TIPo88NvVj3Kv1aCIYGZMlj" target="_blank">
                                                <img width="100" src="{{asset('frontend/assets/images/anjoman-150x150.png')}}" alt="انجمن صنفی کارفرمایی فروشگاه های اینترنتی تهران"/>
                                            </a>
                                        </div>
                                        <div class="col-4 d-flex align-items-center justify-content-center">
                                            <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=313787&amp;Code=erJJIfPCgieNo3BaeAyT"><img referrerpolicy="origin" src="{{asset('frontend/assets/images/e-namad-logo.png')}}" width="100" alt="" style="cursor:pointer" id="erJJIfPCgieNo3BaeAyT"></a>
                                        </div>
                                        <div class="col-4">
                                            <a href="{{asset('frontend/assets/images/ecom_license.jpg')}}" data-lightbox="image-3" data-title="پروانه کسب">
                                                <img width="100" src="{{asset('frontend/assets/images/ecom_union.png')}}" alt="پروانه کسب"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="{{asset('frontend/assets/images/bazargani_membership.jpg')}}" data-lightbox="image-1" data-title="اتاق بازرگانی، صنایع، معادن و کشاورزی تهران">
                                                <img width="85" src="{{asset('frontend/assets/images/bazargani_logo_200.png')}}" alt="اتاق بازرگانی، صنایع، معادن و کشاورزی تهران"/>
                                            </a>
                                        </div>
                                        <div class="col-4"><img width="100" referrerpolicy='origin' id = 'rgvjnbqejxlzrgvjjxlzrgvj' style = 'cursor:pointer' onclick = 'window.open("https://logo.samandehi.ir/Verify.aspx?id=321313&p=xlaouiwkrfthxlaorfthxlao", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' alt = 'logo-samandehi' src = '{{asset('frontend/assets/images/samandehi-logo.png')}}' /></div>
                                        <div class="col-4 d-flex justify-content-center align-items-center">
                                            {{-- <a href="" data-lightbox="image-4" data-title="دانش بنیان"> --}}
                                                <img width="45" src="{{asset('frontend/assets/images/knowledge_base.png')}}" alt="دانش بنیان"/>
                                            {{-- </a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- End fo Footer Top -->
            </div>
            <!-- End of Container -->
            <div class="footer-bottom">
                <div class="container" style="width: 80%;">
                    <div class="footer-left">
                        <p class="copyright">تمامی حقوق برای شرکت ارمغان تجارت مغان با <a href="{{URL::to('/')}}">وبسایت Yelsu</a> محفوظ است. کپی به هر شکل غیر قانونی و غیر مجاز است.</p>
                    </div>
                    <div class="footer-right">
                        {{-- <span class="payment-label mr-lg-8">ما از پرداخت مطمئن استفاده می کنیم</span> --}}
                        <figure >
                            {{-- <img src="{{asset('frontend/assets/images/pay-pic-for-footer.png')}}" alt="payment" width="300"/> --}}
                            <img src="{{asset('frontend/assets/images/yelsu_images/banks/mellat.png')}}" alt="payment" width="42"/>
                            <img src="{{asset('frontend/assets/images/yelsu_images/banks/melli.png')}}" alt="payment" width="42"/>
                            <img src="{{asset('frontend/assets/images/yelsu_images/banks/refah.png')}}" alt="payment" width="70"/>
                            <img src="{{asset('frontend/assets/images/yelsu_images/banks/saderat.png')}}" alt="payment" width="42"/>
                            <img src="{{asset('frontend/assets/images/yelsu_images/banks/saman.png')}}" alt="payment" width="42"/>
                        </figure>
                    </div>
                </div>
            </div>
            <!-- End of Footer Bottom -->
        </footer>


        