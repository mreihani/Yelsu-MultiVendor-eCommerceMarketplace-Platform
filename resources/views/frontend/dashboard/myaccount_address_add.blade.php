@extends('frontend.main_theme')
@section('main')

<script>
    let latitudeVal = {!! json_encode(old('latitude',$latitudeVal)) !!};
    let longitudeVal = {!! json_encode(old('longitude',$longitudeVal)) !!};
</script>

{{-- <script>
    let homeProvinceDB = {!! json_encode($userData->home_province) !!};
    if(homeProvinceDB == null) {
        homeProvinceDB = '';
    }
    let homeCityDB = {!! json_encode($userData->home_city) !!};
    if(homeCityDB == null) {
        homeCityDB = '';
    }

    let shippingProvinceDB = {!! json_encode($userData->shipping_province) !!};
    let shippingCityDB = {!! json_encode($userData->shipping_city) !!};
</script> --}}

<main class="main checkout">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a href="{{URL('/')}}">خانه</a></li>
                <li class="passed"><a href="{{route('dashboard')}}">حساب کاربری</a></li>
                <li class="active"><a>ویرایش آدرس </a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->


    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">
            @foreach($errors->all() as $error)
                <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
                    <h4 class="alert-title" style="color:#ffa800">
                        <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                        {{$error}}
                </div>
            @endforeach
            
            <h3 class="title billing-title text-uppercase ls-10 pt-1 mb-0">
                مختصات مکانی و آدرس مورد نظر را از روی نقشه انتخاب نمایید
            </h3>
            <div class="row mb-5">
                <form method="POST" action="{{route('dashboard.address.store')}}">
                    @csrf
                    <div class="col-lg-12 pr-lg-4">
                        <div class="container mt-10 mb-10">
                            <div id="map"></div>
                        </div>

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Col-->
                            <h5 class="mb-6">
                                همچنین می توانید مختصات مکانی مورد نظر را به صورت دستی وارد نمایید. (پس از وارد کردن مختصات روی دکمه به‌روزرسانی کلیک کنید)
                            </h5>
                            <div class="row">
                                <div class="col-lg-5 fv-row">
                                    <input placeholder="طول جغرافیایی / longitude" type="text" class="form-control form-control-lg form-control-solid" id="longitude" name="longitude">      
                                </div>
                                <div class="col-lg-5 fv-row">
                                    <input placeholder="عرض جغرافیایی / latitude" type="text" class="form-control form-control-lg form-control-solid" id="latitude" name="latitude">      
                                </div>
                                <div class="col-lg-2 fv-row d-flex justify-content-end align-items-start">
                                    <button onclick="updateCoords();" class="btn btn-primary"  id="update-coords" type="button">به‌روزرسانی</button>
                                </div>
                            </div>
                            <!--end::Col-->   
                        </div>
                        <!--end::Input group-->

                        <div class="row gutter-sm">                           
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>عنوان آدرس *</label>
                                    <input type="text" placeholder="به عنوان مثال: منزل"
                                        class="form-control form-control-md mb-2" name="name" value="{{old('name')}}">
                                </div>
                            </div>
                    
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>کشور *</label>
                                    <input type="text" placeholder="به عنوان مثال: ایران"
                                        class="form-control form-control-md mb-2" id="country" name="country" value="{{old('country')}}">
                                </div>
                            </div>
                        </div>

                        <div class="row gutter-sm">                           
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>استان *</label>
                                    <input type="text" placeholder="به عنوان مثال: تهران"
                                        class="form-control form-control-md mb-2" id="province" name="province" value="{{old('province')}}">
                                </div>
                            </div>
                    
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>شهر *</label>
                                    <input type="text" placeholder="به عنوان مثال: تهران"
                                        class="form-control form-control-md mb-2" id="city" name="city" value="{{old('city')}}">
                                </div>
                            </div>
                        </div>
                    
                        <div class="row gutter-sm">                           
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>آدرس *</label>
                                    <input type="text" placeholder="نام خیابان یا کوچه و پلاک"
                                        class="form-control form-control-md mb-2" id="address" name="address" value="{{old('address')}}">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>کد پستی (اختیاری)</label>
                                    <input type="number" class="form-control form-control-md" name="postalcode" value="{{old('postalcode')}}">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-dark btn-rounded mb-5 mt-5" type="submit">ذخیره تغییرات</button>
                    </div>    
                </form>
            </div>

        </div>
    </div>

    
    <!-- End of PageContent -->
</main>

{{-- <script src="{{asset('frontend/assets/js/cityDropdown.js')}}"></script> --}}
<script src="{{asset('frontend/assets/plugins/leaflet/Control.Geocoder.js')}}"></script>
<script src="{{asset('frontend/assets/plugins/leaflet/leafletyelsuDashboard.js')}}"></script>

@endsection