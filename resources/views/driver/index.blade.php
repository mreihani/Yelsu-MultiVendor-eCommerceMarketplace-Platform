@extends('driver.driver_dashboard')
@section('driver')
  

<div id="kt_app_content" class="app-content flex-column-fluid">
    @if(session()->has('error'))
        <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
            <h4 class="alert-title" style="color:#ffa800">
                <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                {{session('error')}}
        </div>
    @endif
    <!--begin::Content container-->
    @if($driverData->status == 'active')
    <div id="kt_app_content_container" class="app-container container-fluid">
       
        <div class="col-xxl-12">
            <!--begin::Engage widget 10-->
            <div class="card card-flush h-md-100">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column justify-content-between mt-9 bgi-no-repeat bgi-size-cover bgi-position-x-center pb-15" style="background-position: 100% 50%; background-image:url('{{asset('adminbackend/assets/media/stock/900x600/42.png')}}')">
                    <!--begin::Wrapper-->
                    <div class="mb-10">
                        <!--begin::Title-->
                        <div class="fs-2hx fw-bold text-gray-800 text-center mb-13">
                        <span class="me-2">به پیشخوان راننده خوش آمدید 
                    </div>
                        <!--end::Title-->
                       
                    </div>
                    <!--begin::Wrapper-->
                    <!--begin::Illustration-->
                    <img class="mx-auto h-150px h-lg-200px theme-light-show" src="{{asset('adminbackend/assets/media/illustrations/sigma-1/driver.png')}}" alt="" />
                    <img class="mx-auto h-150px h-lg-200px theme-dark-show" src="{{asset('adminbackend/assets/media/illustrations/sigma-1/driver.png')}}" alt="" />
                    <!--end::Illustration-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 10-->
        </div>
        
       
    </div>
    @else
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            
                <!--begin::Engage widget 10-->
                <div class="card card-flush h-md-100">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column justify-content-between mt-9 bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0" style="background-position: 100% 50%; background-image:url('http://127.0.0.1:8000/adminbackend/assets/media/stock/900x600/42.png')">
                        <!--begin::Wrapper-->
                        <div class="mb-10">
                            <div class="fs-2hx fw-bold text-gray-800 text-center mb-13">
                                <a href="{{route('driver.profileSettings')}}">
                                    <span class="me-2 blink">1- مشخصات خود را تکمیل نمایید</span>
                                </a>
                            </div>
                            <!--begin::Title-->
                            <div class="fs-2hx fw-bold text-gray-800 text-center mb-13">
                            <span class="me-2">2- پس از تکمیل مشخصات، برای فعال سازی حساب کاربری با
                            <br>
                            <span class="position-relative d-inline-block text-danger">
                                <a href="tel:02126402540" class="text-danger opacity-75-hover">پشتیبانی</a>
                                <!--begin::Separator-->
                                <span class="position-absolute opacity-15 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                                <!--end::Separator-->
                            </span></span>تماس حاصل فرمایید
                        </div>
                            <!--end::Title-->
                            <!--begin::Actions-->
                            <div class="text-center">
                                <a href="tel:02126402540" class="btn btn-sm btn-dark fw-bold">پشتیبانی 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                      </svg>
                                </a>
                            </div>
                            <!--begin::Actions-->
                        </div>
                        <!--begin::Wrapper-->
                        <!--begin::Illustration-->
                        <img class="mx-auto h-150px h-lg-200px theme-light-show" src="{{asset('adminbackend/assets/media/illustrations/2.svg')}}" alt="">
                        <img class="mx-auto h-150px h-lg-200px theme-dark-show" src="{{asset('adminbackend/assets/media/illustrations/2.svg')}}" alt="">
                        <!--end::Illustration-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Engage widget 10-->
            
        </div>    
    </div>
    @endif
    <!--end::Content container-->
</div>



@endsection