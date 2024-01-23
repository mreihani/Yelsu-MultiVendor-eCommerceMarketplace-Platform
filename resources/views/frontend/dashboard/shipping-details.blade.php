@extends('frontend.main_theme')
@section('main')

    <script src="{{asset('frontend/assets/plugins/leaflet/neshan-static.js')}}"></script>

    <!--begin::JalaliDatePicker Plugin JS and CSS -->
    <link href="{{asset('frontend/assets/plugins/JalaliDatePicker/jalalidatepicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('frontend/assets/plugins/JalaliDatePicker/jalalidatepicker.min.js')}}"></script>

    <script>
        jalaliDatepicker.startWatch({
            minDate: "attr",
            maxDate: "attr",
            time: true,
        }); 
    </script>
    <!--end::JalaliDatePicker Plugin JS and CSS -->

    <style>
        /* datatables custom css */
        .yelsuDataTablesHead {
        background-color: #1e1e2d;
        margin-bottom: 5px;
        padding: 10px 10px;
        }

        .yelsuDataTablesHead .vendor-image-div {
        width: 80%;
        }

        .yelsuDataTablesHead .value-added-tax-div {
        width: 20%;
        }

        .yelsuDataTablesHead img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        }

        .yelsuDataTablesHead div label {
        color: white;
        }

        .yelsuDataTablesHead a {
        color: white;
        margin-right: 10px;
        }

        .yelsuDataTables thead th {
        border: none;
        background-color: #1e1e2d;
        color: white;
        }

        .yelsuDataTables tbody tr.odd {
        background-color: #f5f8fa;
        border: none;
        }

        .yelsuDataTables tbody td input {
            border-color: #48486c;
        }

        .yelsuDataTables tbody td input:focus {
            border-color: #48486c;
        }
        /* datatables custom css */
    </style>

    <!-- SELECT2 initialize -->
    <script>
        $(document).ready(function() {
            $('.yelsu-select2-basic-single').select2();
        });
    </script>

    <!-- Start of Main -->
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">حمل و نقل سفارشات</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{URL::to('/')}}">خانه </a></li>
                    <li><a href="{{route('dashboard')}}">حساب من </a></li>
                    <li>سفارش {{$order->id}}</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->


        <!-- Start of PageContent -->
        <div class="page-content pt-2 shipping-page-content">
            <div class="container">

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

                <div class="tab-pane active order">

                    <div class="row">       
                        <div class="col-12">
                            <div class="shipping">
                                <div class="tab tab-nav-center tab-nav-underline tab-line-grow show-code-action">
                                    <div class="tab-content">

                                        <div class="alert alert-warning alert-bg alert-inline d-none" id="shedule-alert">
                                            <i class="w-icon-exclamation-triangle" style="color: #f93"></i>
                                            فیلد تاریخ نمی تواند خالی باشد!
                                        </div>
                                        <div class="alert alert-warning alert-bg alert-inline d-none mt-3" id="number-items-request-empty-alert">
                                            <i class="w-icon-exclamation-triangle" style="color: #f93"></i>
                                            فیلد درخواست نباید خالی باشد
                                        </div>
                                        <div class="alert alert-warning alert-bg alert-inline d-none mt-3" id="number-items-request-min-alert">
                                            <i class="w-icon-exclamation-triangle" style="color: #f93"></i>
                                            حداقل درخواست باید بیشتر از 10 باشد
                                        </div>
                                        <div class="alert alert-warning alert-bg alert-inline d-none mt-3" id="number-items-request-max-alert">
                                            <i class="w-icon-exclamation-triangle" style="color: #f93"></i>
                                            حداکثر درخواست باید کمتر از 1000 باشد
                                        </div>

                                        <div class="shipping-loop-item tab-pane active in" id="tab5-1" key="1">
                                            <div class="row shipping-element d-flex justify-content-between">
                                                <div class="col-md-12 bg-grey d-flex justify-content-between align-items-center pl-5 pr-5">
                                                    
                                                    <div class="product-item">
                                                        
                                                        <div class="mt-3">
                                                            <a href="{{route('product.details', $product->product_slug)}}">
                                                                <img class="product-image" src="{{!empty($product->product_thumbnail_sm) ? asset($product->product_thumbnail_sm) : asset('storage/upload/no_image.jpg') }}" alt="{{$product->product_name}}" />
                    
                                                                <span class="ml-1 product-name">
                                                                    {{$product->product_name}}
                                                                </span>
                                                            </a>
                                                        </div>
        
                                                        <h5 class="mt-3">
                                                            مقدار کل
                                                            سفارش خریداری شده:
                                                            
                                                            <b>
                                                                {{number_format($product->pivot->quantity, 0, '', ',')}}
                                                            </b>

                                                            {{$product->determine_product_unit()}}
                                                        </h5>

                                                        <h5 class="mt-3">
                                                            مقدار باقی مانده جهت بارگیری:

                                                                <b>{{number_format(10000, 0, '', ',')}}</b>

                                                                {{$product->determine_product_unit()}}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>   

                                            <!-- شروع جدول مربوط به ریز حمل سفارشات -->
                                            <div class="row d-flex justify-content-center mt-2" id="table-body">
                                                {{-- <div class="col-md-12 pt-5 pb-5">
                                                    <table class="display yelsuDataTables" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="all text-center">ردیف</th>
                                                                <th class="text-center">مبدا</th>
                                                                <th class="text-center">مقصد</th>
                                                                <th class="text-center">باربری</th>
                                                                <th class="text-center">نوع بارگیر</th>
                                                                <th class="text-center">مقدار</th>
                                                                <th class="text-center">تاریخ</th>
                                                                <th class="text-center">وضعیت</th>
                                                                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="برای رونوشت ردیف مورد نظر، ابتدا تعداد رونوشت را وارد سپس بر روی دکمه رونوشت کلیک کنید.">
                                                                    رونوشت ردیف
                                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="12" r="10" stroke="#ffffff" stroke-width="1.5"></circle> <path d="M12 17V11" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="1" cy="1" r="1" transform="matrix(1 0 0 -1 11 9)" fill="#ffffff"></circle> </g></svg>
                                                                </th>
                                                                <th class="all text-center">ویرایش / حذف</th>
                                                                <th class="text-center">اطلاعات بیشتر</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>2</td>
                                                                <td>3</td>
                                                                <td>4</td>
                                                                <td>5</td>
                                                                <td>6</td>
                                                                <td>7</td>
                                                                <td>8</td>
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="input-group" style="width: 130px;">
                                                                            <input id="quantityInputvalue" name="quantity" class="quantity form-control" type="number" min="1" max="10000000">
                                                                            <button type="button" class="quantity-plus w-icon-plus"></button>
                                                                            <button type="button" class="quantity-minus w-icon-minus"></button>
                                                                        </div>
                                                                        <button type="button" class="btn btn-dark btn-ellipse btn-sm ml-1" data-bs-toggle="tooltip" data-bs-placement="top" title="رونوشت">
                                                                            <svg width="42px" height="42px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.4" d="M18.5703 22H14.0003C11.7103 22 10.5703 20.86 10.5703 18.57V11.43C10.5703 9.14 11.7103 8 14.0003 8H18.5703C20.8603 8 22.0003 9.14 22.0003 11.43V18.57C22.0003 20.86 20.8603 22 18.5703 22Z" fill="#292D32"></path> <path d="M13.43 5.43V6.77C10.81 6.98 9.32 8.66 9.32 11.43V16H5.43C3.14 16 2 14.86 2 12.57V5.43C2 3.14 3.14 2 5.43 2H10C12.29 2 13.43 3.14 13.43 5.43Z" fill="#292D32"></path> <path d="M18.1291 14.2501H17.2491V13.3701C17.2491 12.9601 16.9091 12.6201 16.4991 12.6201C16.0891 12.6201 15.7491 12.9601 15.7491 13.3701V14.2501H14.8691C14.4591 14.2501 14.1191 14.5901 14.1191 15.0001C14.1191 15.4101 14.4591 15.7501 14.8691 15.7501H15.7491V16.6301C15.7491 17.0401 16.0891 17.3801 16.4991 17.3801C16.9091 17.3801 17.2491 17.0401 17.2491 16.6301V15.7501H18.1291C18.5391 15.7501 18.8791 15.4101 18.8791 15.0001C18.8791 14.5901 18.5391 14.2501 18.1291 14.2501Z" fill="#292D32"></path> </g></svg>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <button type="button" class="btn btn-dark btn-ellipse btn-sm d-flex align-items-center row-edit-btn">
                                                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="edit"> <g> <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> <polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon> </g> </g> </g> </g></svg>
                                                                            ویرایش
                                                                        </button>
                                                                        <button type="button" class="btn btn-warning btn-ellipse btn-sm d-flex align-items-center ml-2">
                                                                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                                            حذف
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> --}}
                                            </div>  
                                            <!-- پایان جدول مربوط به ریز حمل سفارشات -->

                                            <div class="row shipping-element d-flex justify-content-between">

                                                <div class="col-md-12 bg-grey pt-3 ml-2 d-none" id="table-row-number-card">
                                                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" width="24px" height="24px" viewBox="0 0 448 448" id="svg2" version="1.1" inkscape:version="0.91 r13725" sodipodi:docname="work-item-2.svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title id="title3350">work-item</title> <defs id="defs4"> <pattern y="0" x="0" height="6" width="6" patternUnits="userSpaceOnUse" id="EMFhbasepattern"></pattern> </defs> <sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="1.979899" inkscape:cx="100.38339" inkscape:cy="187.19657" inkscape:document-units="px" inkscape:current-layer="layer1" showgrid="true" units="px" inkscape:snap-bbox="true" inkscape:bbox-nodes="true" inkscape:window-width="3840" inkscape:window-height="2097" inkscape:window-x="-8" inkscape:window-y="-8" inkscape:window-maximized="1" inkscape:object-nodes="true" inkscape:snap-grids="true" inkscape:snap-to-guides="false" inkscape:snap-nodes="true"> <inkscape:grid type="xygrid" id="grid3336" spacingx="16" spacingy="16" empspacing="2"></inkscape:grid> </sodipodi:namedview> <metadata id="metadata7"> <rdf:rdf> <cc:work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"></dc:type> <dc:title>work-item</dc:title> </cc:work> </rdf:rdf> </metadata> <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-604.36209)"> <path style="fill-opacity:1;stroke:none;stroke-width:64;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="M 112 0 L 90.666016 32 L 32 32 C 14.271983 32 0 46.271983 0 64 L 0 416 C 0 433.72802 14.271983 448 32 448 L 320 448 C 337.72802 448 352 433.72802 352 416 L 352 272 L 320 304 L 320 416 L 32 416 L 32 64 L 69.333984 64 L 48 96 L 304 96 L 282.66602 64 L 320 64 L 320 80 L 349.17773 50.822266 C 344.17232 39.706653 333.0229 32 320 32 L 261.33398 32 L 240 0 L 112 0 z M 128 32 L 224 32 L 240 64 L 112 64 L 128 32 z " transform="translate(0,604.36209)" id="rect3337"></path> <path style="fill-rule:evenodd;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 48,844.36209 128,128 272,-272 -32,-48 -240,240 -80,-80 z" id="path4147" inkscape:connector-curvature="0" sodipodi:nodetypes="ccccccc"></path> </g> </g></svg>
                                                    <h4 class="ml-1">
                                                        ردیف 1
                                                    </h4>
                                                </div>

                                                <div class="col-md-12 ml-2 mr-2">
                                                    <div class="row d-flex justify-content-between align-items-center">
                                                        <div class="row col-md-4 bg-grey pt-2 pb-2 d-flex align-items-center" style="height: 60px;">
                                                            <span class="ml-2">
                                                                مقدار حداقل جهت بارگیری 10

                                                                {{$product->determine_product_unit()}}
                                                            </span>
                                                            <span class="ml-2">
                                                                مقدار حداکثر جهت بارگیری 1000

                                                                {{$product->determine_product_unit()}}
                                                            </span>
                                                        </div>
                                                       
                                                        <div class="row col-md-4 bg-grey number-items-request pt-2 pb-2 d-flex align-items-center">
                                                            <div class="col-md-4">
                                                                <label>
                                                                    مقدار درخواست
                                                                </label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number" class="form-control form-control-sm">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="ml-2">
                                                                    {{$product->determine_product_unit()}}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="row col-md-4 bg-grey shipping-schedule pt-2 pb-2 d-flex align-items-center" style="padding-left: 30px;">
                                                            <div class="col-md-6">
                                                                <label>انتخاب تاریخ بارگیری کالا</label>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input name="deliver_date" type="text" data-jdp="" data-jdp-only-date="" data-jdp-min-date="{{jdate()->addDays(3)->format('Y/m/d')}}" data-jdp-max-date="{{jdate()->addDays(29)->format('Y/m/d')}}" class="form-control form-control-sm deliver-date-input" placeholder="تاریخ مورد نظر را انتخاب نمایید">    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row col-md-3 bg-grey mt-2 pl-5 pr-5 pt-5 pb-5">
        
                                                    <div class="order-origin-address pt-3">
                                                        <h4>
                                                            تعیین مبدا
                                                        </h4>
        
                                                        <div class="form-group">
                                                            <label>نام مبدا</label>
                                                            <div>
                                                                <select class="form-control form-control-md vendor-address-information yelsu-select2-basic-single">
                                                                    @foreach($product->outlets as $vendor_outlet)
                                                                        <option value="{{$vendor_outlet->id}}">{{$vendor_outlet->shop_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
        
                                                        <div class="mt-2 tab tab-with-title tab-nav-link pt-2 pb-2 order-origin-address-html">
                                                            <p>
                                                                <i class="w-icon-map-marker"></i>
                                                                آدرس:
                                                                <span class="vendor-address">
                                                                    {{$product->outlets->first()->shop_address}}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <hr class="divider mb-5 mt-5">
        
                                                    <div class="order-destination-address">
                                                        <h4>
                                                            تعیین مقصد
                                                        </h4>
        
                                                        <div class="form-group">
                                                            <label>نام مقصد</label>
                                                            <div>
                                                                <select class="form-control form-control-md user-address-information yelsu-select2-basic-single">
                                                                    @foreach($userData->outlets()->get() as $user_outlet)
                                                                        <option value="{{$user_outlet->id}}">{{$user_outlet->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
        
                                                        <div class="mt-2 tab tab-with-title tab-nav-link pt-2 pb-2 order-destination-address-html">
                                                            <p>
                                                                <i class="w-icon-map-marker"></i>
                                                                آدرس:
                                                                <span class="user-address">
                                                                    {{$userData->outlets()->first()->address}}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        
                                                    </div>
        
                                                    <div class="mt-2 tab tab-with-title pt-2 pb-5 d-flex justify-content-center">
                                                        <p>
                                                            {{-- فاصله بین مبدا و مقصد: --}}
                                                            <span class="calculated-distance"></span>
                                                        </p>
                                                    </div>
        
                                                </div>
                                            
                                                <div class="row col-md-3 bg-grey mt-2 pl-5 pr-5 pt-5 pb-5">

                                                    <div class="order-shipping-service">
                                                        <h4>
                                                            تعیین شرکت باربری
                                                        </h4>
        
                                                        <div class="freightage-company-name">
                                                            <div class="company-name-div">
                                                                <label>نام شرکت باربری</label>
        
                                                                <input type="hidden" class="product_id" value="{{$product->id}}">
                                                                <input type="hidden" class="order_id" value="{{$order->id}}">
            
                                                                <div>
                                                                    <select class="form-control form-control-md freightage-information-dropdown yelsu-select2-basic-single">
                                                                            <option value="0">شرکت باربری را انتخاب نمایید</option>
                                                                        @foreach($product->determine_product_owner->verified_freightages_with_vendor_id as $freightage)
                                                                            <option value="{{$freightage->freightage->id}}">{{$freightage->freightage->shop_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
        
                                                        <div class="mt-5 tab tab-with-title d-flex justify-content-center">
                                                            <p>
                                                                <span class="shipping-calculations"></span>
                                                            </p>
                                                        </div>
                                                        
                                                        <div class="d-flex justify-content-center">
                                                            <button class="btn btn-sm btn-primary btn-ellipse shipping-calculate-btn d-none">
                                                                <svg viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.cls-1{fill:none;stroke:#ffffff;stroke-miterlimit:10;stroke-width:1.91px;}</style></defs><line class="cls-1" x1="0.52" y1="5.28" x2="10.09" y2="5.28"></line><line class="cls-1" x1="5.3" y1="0.5" x2="5.3" y2="10.07"></line><line class="cls-1" x1="1.48" y1="14.85" x2="9.13" y2="22.5"></line><line class="cls-1" x1="9.13" y1="14.85" x2="1.48" y2="22.5"></line><line class="cls-1" x1="13.91" y1="5.28" x2="23.48" y2="5.28"></line><line class="cls-1" x1="13.91" y1="18.67" x2="23.48" y2="18.67"></line><line class="cls-1" x1="17.74" y1="14.85" x2="19.65" y2="14.85"></line><line class="cls-1" x1="17.74" y1="22.5" x2="19.65" y2="22.5"></line></g></svg>
                                                                محاسبه هزینه حمل
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="row col-md-6 shipping-page-map-div bg-grey mt-2 pr-5 pt-5 pb-5 d-flex align-items-center justify-content-center">
                                                    <div id="map_{{$product->id}}" class="shipping-page-map-container" user_coords="{{json_encode($userData->user_outlets_array())}}" vendor_coords="{{json_encode($product->determine_product_owner->vendor_outelts_array())}}" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="shipping-details-page-overlay">
                                                <span class="loader"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->
    
    <script src="{{asset('frontend/assets/plugins/leaflet/leafletYelsuShipping.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shippingPageInformationAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shippingPageFreightageInformationAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shippingPageFreightageLoaderTypeAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shippingPageTable.js')}}"></script>

@endsection