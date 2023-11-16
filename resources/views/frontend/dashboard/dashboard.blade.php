@extends('frontend.main_theme')
@section('main')


<main class="main">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">حساب کاربری</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>حساب کاربری</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <div class="container mb-5">
        @if(session()->has('success'))
            <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action">
                <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-icon alert-warning alert-bg alert-inline show-code-action">
                <h4 class="alert-title" style="color:#ffa800">
                    <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                    {{session('error')}}
            </div>
        @endif

        @foreach($errors->all() as $error)
            <div class="alert alert-icon alert-warning alert-bg alert-inline show-code-action">
                <h4 class="alert-title" style="color:#ffa800">
                    <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                    {{$error}}
            </div>
        @endforeach
    </div>

    <!-- Start of PageContent -->
    <div class="page-content pt-2">
        <div class="container">
            <div class="tab tab-vertical row gutter-lg">
                <ul class="nav nav-tabs mb-6" role="tablist">
                    
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{route('admin.dashboard')}}" class="nav-link-backend d-flex">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M532.528 661.408c-12.512 12.496-12.513 32.752-.001 45.248 6.256 6.256 14.432 9.376 22.624 9.376s16.368-3.12 22.624-9.376l189.008-194L577.775 318.64c-12.496-12.496-32.752-12.496-45.248 0-12.512 12.496-12.512 32.752 0 45.248l115.744 115.76H31.839c-17.68 0-32 14.336-32 32s14.32 32 32 32h618.448zM960.159 0h-576c-35.36 0-64.017 28.656-64.017 64v288h64.432V103.024c0-21.376 17.344-38.72 38.72-38.72h496.704c21.408 0 38.72 17.344 38.72 38.72l1.007 818.288c0 21.376-17.311 38.72-38.72 38.72H423.31c-21.376 0-38.72-17.344-38.72-38.72V670.944l-64.432.08V960c0 35.344 28.656 64 64.017 64h576c35.344 0 64-28.656 64-64V64c-.016-35.344-28.672-64-64.016-64z"/></svg>
                                <span class="ml-1">ورود به پیشخوان مدیریت</span>
                            </a>
                        </li>
                    @elseif(Auth::user()->role == 'vendor')
                        <li class="nav-item">
                            <a href="{{route('vendor.dashboard')}}" class="nav-link-backend d-flex">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M532.528 661.408c-12.512 12.496-12.513 32.752-.001 45.248 6.256 6.256 14.432 9.376 22.624 9.376s16.368-3.12 22.624-9.376l189.008-194L577.775 318.64c-12.496-12.496-32.752-12.496-45.248 0-12.512 12.496-12.512 32.752 0 45.248l115.744 115.76H31.839c-17.68 0-32 14.336-32 32s14.32 32 32 32h618.448zM960.159 0h-576c-35.36 0-64.017 28.656-64.017 64v288h64.432V103.024c0-21.376 17.344-38.72 38.72-38.72h496.704c21.408 0 38.72 17.344 38.72 38.72l1.007 818.288c0 21.376-17.311 38.72-38.72 38.72H423.31c-21.376 0-38.72-17.344-38.72-38.72V670.944l-64.432.08V960c0 35.344 28.656 64 64.017 64h576c35.344 0 64-28.656 64-64V64c-.016-35.344-28.672-64-64.016-64z"/></svg>
                                <span class="ml-1">ورود به پیشخوان فروشنده</span>
                            </a>
                        </li>
                    @elseif(Auth::user()->role == 'editor')
                        <li class="nav-item">
                            <a href="{{route('editor.dashboard')}}" class="nav-link-backend d-flex">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M532.528 661.408c-12.512 12.496-12.513 32.752-.001 45.248 6.256 6.256 14.432 9.376 22.624 9.376s16.368-3.12 22.624-9.376l189.008-194L577.775 318.64c-12.496-12.496-32.752-12.496-45.248 0-12.512 12.496-12.512 32.752 0 45.248l115.744 115.76H31.839c-17.68 0-32 14.336-32 32s14.32 32 32 32h618.448zM960.159 0h-576c-35.36 0-64.017 28.656-64.017 64v288h64.432V103.024c0-21.376 17.344-38.72 38.72-38.72h496.704c21.408 0 38.72 17.344 38.72 38.72l1.007 818.288c0 21.376-17.311 38.72-38.72 38.72H423.31c-21.376 0-38.72-17.344-38.72-38.72V670.944l-64.432.08V960c0 35.344 28.656 64 64.017 64h576c35.344 0 64-28.656 64-64V64c-.016-35.344-28.672-64-64.016-64z"/></svg>
                                <span class="ml-1">ورود به پیشخوان نویسنده</span>
                            </a>
                        </li>
                    @elseif(Auth::user()->role == 'specialist')
                        <li class="nav-item">
                            <a href="{{route('specialist.dashboard')}}" class="nav-link-backend d-flex">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M532.528 661.408c-12.512 12.496-12.513 32.752-.001 45.248 6.256 6.256 14.432 9.376 22.624 9.376s16.368-3.12 22.624-9.376l189.008-194L577.775 318.64c-12.496-12.496-32.752-12.496-45.248 0-12.512 12.496-12.512 32.752 0 45.248l115.744 115.76H31.839c-17.68 0-32 14.336-32 32s14.32 32 32 32h618.448zM960.159 0h-576c-35.36 0-64.017 28.656-64.017 64v288h64.432V103.024c0-21.376 17.344-38.72 38.72-38.72h496.704c21.408 0 38.72 17.344 38.72 38.72l1.007 818.288c0 21.376-17.311 38.72-38.72 38.72H423.31c-21.376 0-38.72-17.344-38.72-38.72V670.944l-64.432.08V960c0 35.344 28.656 64 64.017 64h576c35.344 0 64-28.656 64-64V64c-.016-35.344-28.672-64-64.016-64z"/></svg>
                                <span class="ml-1">ورود به پیشخوان کارشناس</span>
                            </a>
                        </li>
                    @elseif(Auth::user()->role == 'financial')
                        <li class="nav-item">
                            <a href="{{route('financial.dashboard')}}" class="nav-link-backend d-flex">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M532.528 661.408c-12.512 12.496-12.513 32.752-.001 45.248 6.256 6.256 14.432 9.376 22.624 9.376s16.368-3.12 22.624-9.376l189.008-194L577.775 318.64c-12.496-12.496-32.752-12.496-45.248 0-12.512 12.496-12.512 32.752 0 45.248l115.744 115.76H31.839c-17.68 0-32 14.336-32 32s14.32 32 32 32h618.448zM960.159 0h-576c-35.36 0-64.017 28.656-64.017 64v288h64.432V103.024c0-21.376 17.344-38.72 38.72-38.72h496.704c21.408 0 38.72 17.344 38.72 38.72l1.007 818.288c0 21.376-17.311 38.72-38.72 38.72H423.31c-21.376 0-38.72-17.344-38.72-38.72V670.944l-64.432.08V960c0 35.344 28.656 64 64.017 64h576c35.344 0 64-28.656 64-64V64c-.016-35.344-28.672-64-64.016-64z"/></svg>
                                <span class="ml-1">ورود به پیشخوان مالی</span>
                            </a>
                        </li>
                    @elseif(Auth::user()->role == 'merchant')
                        <li class="nav-item">
                            <a href="{{route('merchant.dashboard')}}" class="nav-link-backend d-flex">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M532.528 661.408c-12.512 12.496-12.513 32.752-.001 45.248 6.256 6.256 14.432 9.376 22.624 9.376s16.368-3.12 22.624-9.376l189.008-194L577.775 318.64c-12.496-12.496-32.752-12.496-45.248 0-12.512 12.496-12.512 32.752 0 45.248l115.744 115.76H31.839c-17.68 0-32 14.336-32 32s14.32 32 32 32h618.448zM960.159 0h-576c-35.36 0-64.017 28.656-64.017 64v288h64.432V103.024c0-21.376 17.344-38.72 38.72-38.72h496.704c21.408 0 38.72 17.344 38.72 38.72l1.007 818.288c0 21.376-17.311 38.72-38.72 38.72H423.31c-21.376 0-38.72-17.344-38.72-38.72V670.944l-64.432.08V960c0 35.344 28.656 64 64.017 64h576c35.344 0 64-28.656 64-64V64c-.016-35.344-28.672-64-64.016-64z"/></svg>
                                <span class="ml-1">ورود به پیشخوان بازرگان</span>
                            </a>
                        </li>
                    @elseif(Auth::user()->role == 'retailer')
                        <li class="nav-item">
                            <a href="{{route('retailer.dashboard')}}" class="nav-link-backend d-flex">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M532.528 661.408c-12.512 12.496-12.513 32.752-.001 45.248 6.256 6.256 14.432 9.376 22.624 9.376s16.368-3.12 22.624-9.376l189.008-194L577.775 318.64c-12.496-12.496-32.752-12.496-45.248 0-12.512 12.496-12.512 32.752 0 45.248l115.744 115.76H31.839c-17.68 0-32 14.336-32 32s14.32 32 32 32h618.448zM960.159 0h-576c-35.36 0-64.017 28.656-64.017 64v288h64.432V103.024c0-21.376 17.344-38.72 38.72-38.72h496.704c21.408 0 38.72 17.344 38.72 38.72l1.007 818.288c0 21.376-17.311 38.72-38.72 38.72H423.31c-21.376 0-38.72-17.344-38.72-38.72V670.944l-64.432.08V960c0 35.344 28.656 64 64.017 64h576c35.344 0 64-28.656 64-64V64c-.016-35.344-28.672-64-64.016-64z"/></svg>
                                <span class="ml-1">ورود به پیشخوان خرده فروش</span>
                            </a>
                        </li>            
                    @elseif(Auth::user()->role == 'freightage')
                        <li class="nav-item">
                            <a href="{{route('freightage.dashboard')}}" class="nav-link-backend d-flex">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M532.528 661.408c-12.512 12.496-12.513 32.752-.001 45.248 6.256 6.256 14.432 9.376 22.624 9.376s16.368-3.12 22.624-9.376l189.008-194L577.775 318.64c-12.496-12.496-32.752-12.496-45.248 0-12.512 12.496-12.512 32.752 0 45.248l115.744 115.76H31.839c-17.68 0-32 14.336-32 32s14.32 32 32 32h618.448zM960.159 0h-576c-35.36 0-64.017 28.656-64.017 64v288h64.432V103.024c0-21.376 17.344-38.72 38.72-38.72h496.704c21.408 0 38.72 17.344 38.72 38.72l1.007 818.288c0 21.376-17.311 38.72-38.72 38.72H423.31c-21.376 0-38.72-17.344-38.72-38.72V670.944l-64.432.08V960c0 35.344 28.656 64 64.017 64h576c35.344 0 64-28.656 64-64V64c-.016-35.344-28.672-64-64.016-64z"/></svg>
                                <span class="ml-1">ورود به پیشخوان باربری</span>
                            </a>
                        </li>  
                    @elseif(Auth::user()->role == 'driver')
                        <li class="nav-item">
                            <a href="{{route('driver.dashboard')}}" class="nav-link-backend d-flex">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M532.528 661.408c-12.512 12.496-12.513 32.752-.001 45.248 6.256 6.256 14.432 9.376 22.624 9.376s16.368-3.12 22.624-9.376l189.008-194L577.775 318.64c-12.496-12.496-32.752-12.496-45.248 0-12.512 12.496-12.512 32.752 0 45.248l115.744 115.76H31.839c-17.68 0-32 14.336-32 32s14.32 32 32 32h618.448zM960.159 0h-576c-35.36 0-64.017 28.656-64.017 64v288h64.432V103.024c0-21.376 17.344-38.72 38.72-38.72h496.704c21.408 0 38.72 17.344 38.72 38.72l1.007 818.288c0 21.376-17.311 38.72-38.72 38.72H423.31c-21.376 0-38.72-17.344-38.72-38.72V670.944l-64.432.08V960c0 35.344 28.656 64 64.017 64h576c35.344 0 64-28.656 64-64V64c-.016-35.344-28.672-64-64.016-64z"/></svg>
                                <span class="ml-1">ورود به پیشخوان راننده</span>
                            </a>
                        </li>  
                    @elseif(Auth::user()->role == 'representative')
                        <li class="nav-item">
                            <a href="{{route('representative.dashboard')}}" class="nav-link-backend d-flex">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M532.528 661.408c-12.512 12.496-12.513 32.752-.001 45.248 6.256 6.256 14.432 9.376 22.624 9.376s16.368-3.12 22.624-9.376l189.008-194L577.775 318.64c-12.496-12.496-32.752-12.496-45.248 0-12.512 12.496-12.512 32.752 0 45.248l115.744 115.76H31.839c-17.68 0-32 14.336-32 32s14.32 32 32 32h618.448zM960.159 0h-576c-35.36 0-64.017 28.656-64.017 64v288h64.432V103.024c0-21.376 17.344-38.72 38.72-38.72h496.704c21.408 0 38.72 17.344 38.72 38.72l1.007 818.288c0 21.376-17.311 38.72-38.72 38.72H423.31c-21.376 0-38.72-17.344-38.72-38.72V670.944l-64.432.08V960c0 35.344 28.656 64 64.017 64h576c35.344 0 64-28.656 64-64V64c-.016-35.344-28.672-64-64.016-64z"/></svg>
                                @if(auth()->user()->representative->representative_type == "agency")
                                    <span class="ml-1">ورود به پیشخوان عاملیت</span>
                                @else
                                    <span class="ml-1">ورود به پیشخوان نمایندگی</span>
                                @endif
                            </a>
                        </li>                
                    @endif

                    <li class="nav-item">
                        <a href="#account-dashboard" class="nav-link active">پیشخوان</a>
                    </li>
                    <li class="nav-item">
                        <a href="#account-orders" class="nav-link">سفارشات </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#account-downloads" class="nav-link">دانلودها </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="#account-addresses" class="nav-link">آدرس</a>
                    </li>
                    <li class="nav-item">
                        <a href="#account-details" class="nav-link">جزئیات حساب </a>
                    </li>
                    {{-- <li class="link-item">
                        <a href="wishlist.html">علاقه مندیها </a>
                    </li> --}}
                    <li class="link-item">
                        <a href="{{route('user.logout')}}">خروج </a>
                    </li>
                </ul>

                <div class="tab-content mb-6">
                    <div class="tab-pane active in" id="account-dashboard">
                        <p class="greeting">
                            سلام
                            <span class="text-dark font-weight-bold">{{Auth::user()->firstname .' '. Auth::user()->lastname}} </span>
                            (<a href="{{route('user.logout')}}" class="text-primary">خروج</a>)
                        </p>

                        <p class="mb-4">
                            از داشبورد حساب خود می توانید خود را مشاهده کنید <a href="#account-orders"
                                class="text-primary link-to-tab">سفارشات اخیر</a>،
                            مدیریت شما روی <a href="#account-addresses" class="text-primary link-to-tab">آدرس حمل و نقل ها</a>،
                            <a href="#account-details" class="text-primary link-to-tab">رمز عبور و جزئیات حساب خود را ویرایش کنید.</a>
                        </p>

                        <div class="row">
                            {{-- <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="#account-downloads" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-download">
                                            <i class="w-icon-download"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">دانلود ها </p>
                                        </div>
                                    </div>
                                </a>
                            </div>     --}}
                            @if (Auth::user()->role == 'admin')
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="{{route('admin.dashboard')}}" class="link-to-tab">
                                        <div class="icon-box text-center">
                                            <span class="icon-box-icon icon-computer">
                                                <i class="w-icon-computer"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">ورود به پیشخوان مدیریت</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>   
                            @elseif(Auth::user()->role == 'vendor')
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">        
                                    <a href="{{route('vendor.dashboard')}}" class="link-to-tab">
                                        <div class="icon-box text-center">
                                            <span class="icon-box-icon icon-computer">
                                                <i class="w-icon-computer"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">ورود به پیشخوان فروشنده</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>   
                            @elseif(Auth::user()->role == 'editor')
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">        
                                <a href="{{route('editor.dashboard')}}" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-computer">
                                            <i class="w-icon-computer"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">ورود به پیشخوان نویسنده</p>
                                        </div>
                                    </div>
                                </a>
                            </div>       
                            @elseif(Auth::user()->role == 'specialist')
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">        
                                <a href="{{route('specialist.dashboard')}}" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-computer">
                                            <i class="w-icon-computer"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">ورود به پیشخوان کارشناس</p>
                                        </div>
                                    </div>
                                </a>
                            </div>      
                            @elseif(Auth::user()->role == 'financial')
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">        
                                <a href="{{route('financial.dashboard')}}" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-computer">
                                            <i class="w-icon-computer"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">ورود به پیشخوان کاربر مالی</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @elseif(Auth::user()->role == 'merchant')
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">        
                                <a href="{{route('merchant.dashboard')}}" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-computer">
                                            <i class="w-icon-computer"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">ورود به پیشخوان بازرگان</p>
                                        </div>
                                    </div>
                                </a>
                            </div>       
                            @elseif(Auth::user()->role == 'retailer')
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">        
                                <a href="{{route('retailer.dashboard')}}" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-computer">
                                            <i class="w-icon-computer"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">ورود به پیشخوان خرده فروش</p>
                                        </div>
                                    </div>
                                </a>
                            </div>        
                            @elseif(Auth::user()->role == 'freightage')
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">        
                                <a href="{{route('freightage.dashboard')}}" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-computer">
                                            <i class="w-icon-computer"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">ورود به پیشخوان باربری</p>
                                        </div>
                                    </div>
                                </a>
                            </div>     
                            @elseif(Auth::user()->role == 'driver')
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">        
                                <a href="{{route('driver.dashboard')}}" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-computer">
                                            <i class="w-icon-computer"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">ورود به پیشخوان راننده</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @elseif(Auth::user()->role == 'representative')
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">        
                                <a href="{{route('representative.dashboard')}}" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-computer">
                                            <i class="w-icon-computer"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            @if(auth()->user()->representative->representative_type == "agency")
                                                <p class="text-uppercase mb-0">ورود به پیشخوان عاملیت</p>
                                            @else
                                                <p class="text-uppercase mb-0">ورود به پیشخوان نمایندگی</p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>               
                            @endif

                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="#account-orders" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-orders">
                                            <i class="w-icon-orders"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">سفارشات </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="#account-addresses" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-address">
                                            <i class="w-icon-map-marker"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">آدرس </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="#account-details" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-account">
                                            <i class="w-icon-user"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">جزئیات حساب </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            {{-- <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="wishlist.html" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-wishlist">
                                            <i class="w-icon-heart"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">علاقه مندیها </p>
                                        </div>
                                    </div>
                                </a>
                            </div> --}}
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="{{route('user.logout')}}">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-logout">
                                            <i class="w-icon-logout"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">خروج </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane mb-4" id="account-orders">
                        <div class="icon-box icon-box-side icon-box-light">
                            <span class="icon-box-icon icon-orders">
                                <i class="w-icon-orders"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title text-capitalize ls-normal mb-0">سفارشات </h4>
                            </div>
                        </div>
                    
                        @if(count($orders))
                            <table class="shop-table account-orders-table mb-6">
                                <thead>
                                    <tr>
                                        <th class="order-id text-center">شماره سفارش </th>
                                        <th class="order-date text-center">تاریخ ثبت سفارش </th>
                                        <th class="order-status text-center">وضعیت </th>
                                        <th class="order-total text-center">مجموع </th>
                                        <th class="order-actions text-center">اقدامات </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="order-id text-center">{{$order->id}}</td>
                                            <td class="order-date text-center">{{jdate($order->created_at)->format('Y/m/d')}}</td>
                                            <td class="order-status text-center">
                                                {{$order->status == 'paid' ? 'پرداخت موفق' : ''}} 
                                                {{$order->status == 'unpaid' ? 'پرداخت ناموفق' : ''}} 
                                                {{$order->status == 'preparation' ? 'در حال پردازش' : ''}} 
                                                {{$order->status == 'posted' ? 'ارسال شده' : ''}}
                                                {{$order->status == 'received' ? 'دریافت شده' : ''}} 
                                                {{$order->status == 'cancelled' ? 'لغو شده' : ''}} 
                                            </td>
                                            <td class="order-total text-center">
                                                <span class="order-price">{{$order->price}} تومان</span> 
                                                {{-- <span class="order-quantity"> {{$order->products->count()}}</span> آیتم --}}
                                            </td>
                                            <td class="order-action text-center">
                                                <a href="{{route('orderview', $order->id)}}"
                                                    class="btn btn-outline btn-default btn-block btn-sm btn-rounded">نمایش </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h4 class="font-weight-bold text-center mt-5">
                                هیچ سفارشی ثبت نشده است!
                            </h4>
                        @endif
                    
                        <a href="{{route('shop')}}" class="btn btn-dark btn-rounded btn-icon-right">برو فروشگاه <i class="w-icon-long-arrow-left"></i></a>
                    </div>

                    {{-- <div class="tab-pane" id="account-downloads">
                        <div class="icon-box icon-box-side icon-box-light">
                            <span class="icon-box-icon icon-downloads mr-2">
                                <i class="w-icon-download"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title ls-normal">دانلود ها </h4>
                            </div>
                        </div>
                        <p class="mb-4">هنوز دانلودی در دسترس نیست.</p>
                        <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">برو فروشگاه <i class="w-icon-long-arrow-left"></i></a>
                    </div> --}}

                    <div class="tab-pane" id="account-addresses">
                        <div class="icon-box icon-box-side icon-box-light">
                            <span class="icon-box-icon icon-map-marker">
                                <i class="w-icon-map-marker"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title mb-0 ls-normal">آدرس </h4>
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-sm-9">
                                <p>آدرس های زیر به طور پیش فرض در صفحه پرداخت استفاده می شود.</p>
                            </div>

                            <div class="col-sm-3">
                                <a href="{{route('dashboard.address.add')}}"
                                    class="btn btn-outline btn-default btn-block btn-sm btn-rounded btn-primary">
                                    <i class="w-icon-plus"></i>
                                    افزودن آدرس جدید
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            {{-- <div class="col-sm-6 mb-6">
                                <div class="ecommerce-address billing-address pr-lg-8">
                                    <h4 class="title title-underline ls-25 font-weight-bold">آدرس محل سکونت</h4>
                                    <address class="mb-4">
                                        <table class="address-table">
                                            <tbody>
                                                <tr>
                                                    <th>استان:</th>
                                                    <td>{{$userData->home_province}} </td>
                                                </tr>
                                                <tr>
                                                    <th>شهر:</th>
                                                    <td>{{$userData->home_city}} </td>
                                                </tr>
                                                <tr>
                                                    <th>آدرس: </th>
                                                    <td>{{$userData->home_address}}</td>
                                                </tr>
                                                <tr>
                                                    <th>کد پستی :</th>
                                                    <td>{{$userData->home_postalcode}}</td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </address>
                                    <a href="{{route('dashboard.address')}}"
                                        class="btn btn-link btn-underline btn-icon-right text-primary">آدرس محل سکونت خود را ویرایش کنید<i class="w-icon-long-arrow-left"></i></a>
                                </div>
                            </div> --}}
                            <div class="col-sm-12 mb-6">
                                <div class="ecommerce-address billing-address pr-lg-8">

                                    @if(count($userData->outlets))
                                        <table class="shop-table account-orders-table mb-6">
                                            <thead>
                                                <tr>
                                                    <th style="width: 75px;" class="text-center">ردیف</th>
                                                    <th style="width: 75px;" class="text-center">عنوان</th>
                                                    <th class="text-left">آدرس</th>
                                                    <th style="width: 185px;" class="text-center">عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($userData->outlets as $key => $outlet)
                                                <tr>
                                                    <td class="text-center">{{$key + 1}}</td>
                                                    <td class="text-center">{{$outlet->name}}</td>
                                                    <td class="text-left">
                                                        {{$outlet->address}}
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <a href="{{route('dashboard.address.edit', $outlet->id)}}"
                                                                    class="btn btn-outline btn-default btn-block btn-sm btn-rounded btn-success">ویرایش 
                                                                </a>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <a onclick ="return confirm('آیا برای انجام این کار اطمینان دارید؟')" href="{{route('dashboard.address.delete', $outlet->id)}}"
                                                                    class="btn btn-outline btn-default btn-block btn-sm btn-rounded btn-secondary">حذف 
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <h4 class="font-weight-bold text-center mt-5">
                                            هیچ آدرسی ثبت نشده است!
                                        </h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="account-details">
                        <div class="icon-box icon-box-side icon-box-light">
                            <span class="icon-box-icon icon-account mr-2">
                                <i class="w-icon-user"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title mb-0 ls-normal">جزئیات حساب </h4>
                            </div>
                        </div>

                        @if($userData->home_phone && !$userData->phone_verified)
                            <div class="alert alert-warning alert-button show-code-action mb-3">
                                <a href="#" class="btn btn-warning btn-rounded">توجه فرمایید</a>
                                شماره تلفن وارد شده به تأیید نیاز دارد، برای دریافت کد تأیید بر روی دکمه "ذخیره تغییرات" کلیک کنید.
                            </div>
                        @endif

                        <form class="form account-details-form" action="{{route('user.profile.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname"> نام *</label>
                                        <input type="text" id="firstname" name="firstname" placeholder="نام"
                                            class="form-control form-control-md" value="{{$userData->firstname}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname"> نام خانوادگی  *</label>
                                        <input type="text" id="lastname" name="lastname" placeholder="نام خانوادگی"
                                            class="form-control form-control-md" value="{{$userData->lastname}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="display-name">نام کاربری *</label>
                                        <input type="text" id="display-name" name="username" placeholder="نام کاربری خود را وارد نمایید "
                                            class="form-control form-control-md mb-0" value="{{$userData->username}}">
                                        <p>به این ترتیب نام شما در بخش حساب و در بررسی ها نمایش داده می شود</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   
                                    <div class="form-group">
                                        <label>تلفن * (09123456789)</label>

                                        @if($userData->phone_verified)
                                            <div class="row">
                                                <div class="col-md-2 pr-0 pl-0 alert-success alert-bg alert-inline d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-check"></i>
                                                    <span>
                                                        &nbsp;تأیید شده
                                                    </span>
                                                </div>
                                                <div class="col-md-10 pl-0">
                                                    <input type="number" class="form-control form-control-md mb-0" name="home_phone" value="{{$userData->home_phone}}">
                                                </div>
                                            </div>
                                        @elseif(!$userData->phone_verified && $userData->home_phone)
                                            <div class="row">
                                                <div class="col-md-2 pr-0 pl-0 alert-warning alert-bg alert-inline d-flex align-items-center justify-content-center">
                                                    <i class="w-icon-exclamation-triangle"></i>
                                                    <span>
                                                        &nbsp;تأیید نشده
                                                    </span>
                                                </div>
                                                <div class="col-md-10 pl-0">
                                                    <input type="number" class="form-control form-control-md mb-0" name="home_phone" value="{{$userData->home_phone}}">
                                                </div>
                                            </div>
                                        @else
                                            <input type="number" class="form-control form-control-md" name="home_phone" value="{{$userData->home_phone}}">
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>

                            
                            <div class="icon-box icon-box-side icon-box-light mt-5">
                                <span class="icon-box-icon icon-account mr-2">
                                    <i class="w-icon-mobile"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">ورود دو مرحله ای</h4>
                                </div>                        
                                <div>
                                    <p class="ml-1">
                                        (با فعال سازی ورود دو مرحله ای و دریافت پیامک می توانید امنیت حساب کاربری خود را ارتقاء دهید)
                                    </p>
                                </div>
                            </div>
                            <div class="form-check form-switch mb-5">
                                <label class="form-check-label" for="twoStepAuth">فعال سازی ورود دو مرحله ای</label>
                                <input {{$userData->twoStepAuth == "active" ? "checked" : ''}}  class="form-check-input" type="checkbox" id="twoStepAuth" name="twoStepAuth">
                            </div>
                            <button type="submit" class="btn btn-dark btn-rounded btn-sm mt-1 mb-4">ذخیره تغییرات </button>
                        </form>

                        <hr class="hr mt-5 mb-5">

                        <form class="mt-10" action="{{route('user.profile.storePassword')}}" method="post">
                            @csrf   
                            <div class="icon-box icon-box-side icon-box-light mt-5">
                                <span class="icon-box-icon icon-account mr-2">

                                    <img src="{{asset('frontend/assets/images/yelsu_images/etc/svgviewer-output.svg')}}" alt="">
                                </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">تغییر کلمه عبور</h4>
                                </div>                        
                                <div>

                                </div>
                            </div>
                            <h4 class="title title-password ls-25 font-weight-bold"></h4>
                            <div class="form-group">
                                <label class="text-dark" for="cur-password">رمز عبور فعلی</label>
                                <input type="password" class="form-control form-control-md"
                                    id="cur-password" name="old_password" value="password">
                            </div>
                            <div class="form-group mt-5">
                                <label class="text-dark" for="new-password">رمز عبور جدید</label>
                                <input type="password" class="form-control form-control-md"
                                    id="new-password" name="new_password">
                            </div>
                            <div class="form-group mb-3 mt-5">
                                <label class="text-dark" for="conf-password">تایید رمز عبور </label>
                                <input type="password" class="form-control form-control-md"
                                    id="conf-password" name="new_password_confirmation">
                            </div>
                            <button type="submit" class="btn btn-dark btn-rounded btn-sm mt-1 mb-4">ذخیره تغییرات </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</main>


<script>
    let request_type = {!! json_encode($request_type) !!};
    if(request_type == "orders") {
        $('#account-dashboard').removeClass('active');
        $('#account-orders').addClass('active');
    } else if(request_type == "addresses") {
        $('#account-dashboard').removeClass('active');
        $('#account-addresses').addClass('active');
    }
    else if(request_type == "details") {
        $('#account-dashboard').removeClass('active');
        $('#account-details').addClass('active');
    }
</script>


@endsection