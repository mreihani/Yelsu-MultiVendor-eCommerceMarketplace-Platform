@extends('retailer.retailer_dashboard')
@section('retailer')

<script src="{{asset('frontend/assets/plugins/leaflet/leaflet.js')}}"></script>   
{{-- <script src="{{asset('frontend/assets/plugins/leaflet/neshan.js')}}"></script>    --}}
<script src="{{asset('frontend/assets/plugins/leaflet/Control.Geocoder.js')}}"></script>

<script>
    let latitudeVal = null;
    let longitudeVal = null;
</script>


<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن آدرس انبار / کارگاه / کارخانه / دپوی کالا</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">خانه</a>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">موقعیت مکانی محل ارسال کالا یا تامین کالا و یا محل بارگیری کالا </li>
                        <!--end::آیتم-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            @if(session()->has('success'))
            <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5 mt-5 mb-5">
                <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
            </div>
        @endif

        @if(session()->has('error'))
            <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
                <h4 class="alert-title" style="color:#ffa800">
                    <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                    {{session('error')}}
            </div>
        @endif
        @foreach($errors->all() as $error)
            <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
                <h4 class="alert-title" style="color:#ffa800">
                    <i class="w-icon-exclamation-triangle"></i>خطا!</h4>
                    {{$error}}
            </div>
        @endforeach
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                
                <!--begin::پایه info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::کارت header-->
                    {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                        <!--begin::کارت title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">اطلاعات و آدرس انبار / کارگاه / کارخانه</h3>
                        </div>
                        
                        <!--end::کارت title-->
                    </div> --}}
                    <!--begin::کارت header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show outlet-page">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form" method="POST" action={{route('retailer.store.outlet')}} enctype="multipart/form-data">
                            @csrf
                            <!--begin::کارت body-->
                            <div class="card-body border-top p-9">

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <h5 class="mb-6">مختصات مکانی انبار / کارگاه / کارخانه / دپوی کالا را از روی نقشه انتخاب نمایید</h5>
                                    <div class="col-lg-12 fv-row">
                                        <div id="map"></div>
                                    </div>
                                    <!--end::Col-->   
                                    {{-- <input type="hidden" id="latitude" name="latitude">      
                                    <input type="hidden" id="longitude" name="longitude">       --}}
                                </div>
                                <!--end::Input group-->
                                
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <h5 class="mb-6">مختصات مکانی مورد نظر را وارد نمایید</h5>
                                    <div class="row">
                                        <div class="col-lg-5 fv-row">
                                            <input placeholder="طول جغرافیایی / longitude" type="text" class="form-control form-control-lg form-control-solid" id="longitude" name="longitude">      
                                        </div>
                                        <div class="col-lg-5 fv-row">
                                            <input placeholder="عرض جغرافیایی / latitude" type="text" class="form-control form-control-lg form-control-solid" id="latitude" name="latitude">      
                                        </div>
                                        <div class="col-lg-2 fv-row text-end">
                                            <button onclick="updateCoords();" class="btn btn-primary"  id="update-coords" type="button">به روز رسانی</button>
                                        </div>
                                    </div>
                                    <!--end::Col-->   
                                </div>
                                <!--end::Input group-->

                                <h5 class="mb-10 mt-10">
                                    لطفا نام، آدرس و مختصات مکانی انبار / کارگاه / کارخانه / دپوی کالا را وارد نمایید.
                                </h5>
                                <!--begin::Input group-->
                                 <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6"> نام انبار / کارگاه / کارخانه / دپوی کالا</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="shop_name" class="form-control form-control-lg form-control-solid" placeholder="نام محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">آدرس انبار / کارگاه / کارخانه / دپوی کالا</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="shop_address" id="shop_address" class="form-control form-control-lg form-control-solid" placeholder="آدرس محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">کد پستی انبار / کارگاه / کارخانه / دپوی کالا</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="shop_postalcode" class="form-control form-control-lg form-control-solid" placeholder="کد پستی محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">شماره تلفن انبار / کارگاه / کارخانه / دپوی کالا</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="shop_phone" class="form-control form-control-lg form-control-solid" placeholder="شماره تلفن محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6"> فکس انبار / کارگاه / کارخانه / دپوی کالا</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="shop_fax" class="form-control form-control-lg form-control-solid" placeholder="شماره فکس محل مورد نظر را وارد نمایید" value="" />
                                    </div>
                                    <!--end::Col-->         
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                @if (count($retailerSectorArr))
                                    <div class="row mb-6">
                                        <!--begin::Tags-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            انتخاب زمینه فعالیت محل انتخاب شده
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="لطفا زمینه فعالیت محل انتخاب شده با مشخص کردن زیر دسته آن فعالیت را از گزینه های روبه انتخاب نمایید."></i></label>
                                        </label>
                                        <!--end::Tags-->
                                       
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row mt-4">
                                            <ul class="list-style-none mt-4">
                                                @foreach ($filter_category_array as $category)
                                                    <li class="filterButtonShopPage rootCat">
                                                        <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category[0]->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category[0]->category_name}}
                                                    </li>
                                                    <div class="subCategoryBtn">
                                                        @include('retailer.body.layouts.retailer_outlets.categories-group', ['categories' => $category[1]])
                                                    </div>
                                                @endforeach
                                            </ul>    
                                        </div>
                                        <!--end::Col-->   
                                    </div>
                                @endif    
                                <!--end::Input group-->

                            </div>
                            <!--end::کارت body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a type="reset" class="btn btn-light btn-active-light-primary me-2" href="{{route('retailer.all.outlet')}}">لغو</a>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره تغییرات</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::پایه info-->
               
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    
</div>

<!--leaflet JS-->
<script src="{{asset('frontend/assets/plugins/leaflet/leafletyelsu.js')}}"></script>   
<script src="{{asset('adminbackend/assets/js/categoryFilter.js')}}"></script>

@endsection



