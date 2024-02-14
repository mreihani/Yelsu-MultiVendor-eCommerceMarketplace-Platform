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
                                            فیلد درخواست نمی تواند خالی باشد!
                                        </div>
                                        <div class="alert alert-warning alert-bg alert-inline d-none mt-3" id="number-items-request-min-alert">
                                            <i class="w-icon-exclamation-triangle" style="color: #f93"></i>
                                            حداقل درخواست باید بیشتر از <span></span> باشد.
                                        </div>
                                        <div class="alert alert-warning alert-bg alert-inline d-none mt-3" id="number-items-request-max-alert">
                                            <i class="w-icon-exclamation-triangle" style="color: #f93"></i>
                                            حداکثر درخواست باید کمتر از <span></span> باشد.
                                        </div>
                                        <div class="alert alert-warning alert-bg alert-inline d-none mt-3" id="number-items-greater-than-remaining-alert">
                                            <i class="w-icon-exclamation-triangle" style="color: #f93"></i>
                                            درخواست شما بیشتر از مقدار باقی مانده است!
                                        </div>
                                        <div class="alert alert-warning alert-bg alert-inline d-none mt-3" id="number-items-request-value-alert">
                                            <i class="w-icon-exclamation-triangle" style="color: #f93"></i>
                                            مقدار درخواست خارج از بازه تعیین شده برای بارگیری است.
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

                                                                @if(!is_null($vproducts->outlet_id))
                                                                    <div class="btn btn-primary btn-rounded btn-sm mt-2" style="padding: 0.2em 0.4em; cursor:initial">
                                                                        {{App\Models\Outlet::find($vproducts->outlet_id)->shop_name}}
                                                                    </div>
                                                                @endif
                                                            </a>
                                                        </div>
        
                                                        <h5 class="mt-3">
                                                            مقدار کل
                                                            سفارش خریداری شده:
                                                            
                                                            <b>
                                                                {{number_format($vproducts->quantity, 0, '', ',')}}
                                                            </b>

                                                            {{$product->determine_product_unit()}}

                                                            <input type="hidden" value="{{$vproducts->quantity}}" class="total-quantity-input">
                                                            <input type="hidden" value="{{$vproducts->outlet_id}}" class="product-outlet-id">
                                                            <input type="hidden" value="{{$vproducts->id}}" class="order-vproduct-id">
                                                        </h5>

                                                        <h5 class="mt-3">
                                                            مقدار باقی مانده جهت بارگیری:

                                                            <b class="remaining-quantity">
                                                                {{number_format($remainingShippingQuantity, 0, '', ',')}}
                                                            </b>

                                                            {{$product->determine_product_unit()}}

                                                            <input type="hidden" value="{{$remainingShippingQuantity}}" class="remaining-quantity-input">
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>   

                                            <!-- شروع جدول مربوط به ریز حمل سفارشات -->
                                            <div class="row d-flex justify-content-center mt-2" id="table-body">
                                                @if(count($shipping))
                                                    <div class="col-md-12 pt-5 pb-5">
                                                        <table class="display yelsuDataTables" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="all text-center">ردیف</th>
                                                                    <th class="all text-center">مبدا</th>
                                                                    <th class="all text-center">مقصد</th>
                                                                    <th class="all text-center">نام شرکت باربری</th>
                                                                    <th class="all text-center">روش ارسال</th>
                                                                    <th class="all text-center">نوع بارگیر</th>
                                                                    <th class="all text-center">تاریخ</th>
                                                                    <th class="all text-center">مقدار درخواستی</th>
                                                                    <th class="all text-center">وضعیت</th>
                                                                    <th class="all text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="برای رونوشت ردیف مورد نظر، ابتدا تعداد رونوشت را وارد سپس بر روی دکمه رونوشت کلیک کنید.">
                                                                        رونوشت ردیف
                                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="12" r="10" stroke="#ffffff" stroke-width="1.5"></circle> <path d="M12 17V11" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="1" cy="1" r="1" transform="matrix(1 0 0 -1 11 9)" fill="#ffffff"></circle> </g></svg>
                                                                    </th>
                                                                    <th class="all text-center">ویرایش / حذف</th>
                                                                    <th class="all text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="لطفا توجه داشته باشید که اطلاعات هر سطر باید به صورت جداگانه ذخیره شود.">
                                                                        عملیات
                                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="12" r="10" stroke="#ffffff" stroke-width="1.5"></circle> <path d="M12 17V11" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="1" cy="1" r="1" transform="matrix(1 0 0 -1 11 9)" fill="#ffffff"></circle> </g></svg>
                                                                    </th>
                                                                    <th class="text-center">اطلاعات بیشتر</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($shippingItemRowArray as $key => $shippingItemRowItem)
                                                                    <tr>
                                                                        <td class="shipping-row">
                                                                            {{$shippingItemRowItem['row_id']}}
                                                                        </td>
                                                                        <td>
                                                                            {{$shippingItemRowItem['order_origin_address']}}
                                                                        </td>
                                                                        <td>
                                                                            {{$shippingItemRowItem['order_destination_address']}}
                                                                        </td>
                                                                        <td>
                                                                            {{$shippingItemRowItem['freightage_information']}}
                                                                        </td>
                                                                        <td>
                                                                            {{$shippingItemRowItem['freightage_activity_field']}}
                                                                        </td>
                                                                        <td>
                                                                            {{$shippingItemRowItem['freightage_loadertype']}}
                                                                        </td>
                                                                        <td>
                                                                            {{$shippingItemRowItem['deliverDateInputValue']}}
                                                                        </td>
                                                                        <td>
                                                                            {{$shippingItemRowItem['number_of_request_input']}}
                                                                        </td>
                                                                        <td>
                                                                            {{$shippingItemRowItem['shipping_status']}}
                                                                        </td>
                                                                        <td>
                                                                            <div class="d-flex justify-content-center">
                                                                                <div class="input-group" style="width: 130px; height: 33px;">
                                                                                    <input id="quantityInputvalue" name="quantity" class="quantity form-control" type="number" min="1" max="10000000">
                                                                                    <button type="button" class="quantity-plus w-icon-plus"></button>
                                                                                    <button type="button" class="quantity-minus w-icon-minus"></button>
                                                                                </div>
                                                                                <button type="button" class="btn btn-dark btn-ellipse btn-sm ml-1 row-duplicate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="رونوشت">
                                                                                    <svg width="42px" height="42px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.4" d="M18.5703 22H14.0003C11.7103 22 10.5703 20.86 10.5703 18.57V11.43C10.5703 9.14 11.7103 8 14.0003 8H18.5703C20.8603 8 22.0003 9.14 22.0003 11.43V18.57C22.0003 20.86 20.8603 22 18.5703 22Z" fill="#292D32"></path> <path d="M13.43 5.43V6.77C10.81 6.98 9.32 8.66 9.32 11.43V16H5.43C3.14 16 2 14.86 2 12.57V5.43C2 3.14 3.14 2 5.43 2H10C12.29 2 13.43 3.14 13.43 5.43Z" fill="#292D32"></path> <path d="M18.1291 14.2501H17.2491V13.3701C17.2491 12.9601 16.9091 12.6201 16.4991 12.6201C16.0891 12.6201 15.7491 12.9601 15.7491 13.3701V14.2501H14.8691C14.4591 14.2501 14.1191 14.5901 14.1191 15.0001C14.1191 15.4101 14.4591 15.7501 14.8691 15.7501H15.7491V16.6301C15.7491 17.0401 16.0891 17.3801 16.4991 17.3801C16.9091 17.3801 17.2491 17.0401 17.2491 16.6301V15.7501H18.1291C18.5391 15.7501 18.8791 15.4101 18.8791 15.0001C18.8791 14.5901 18.5391 14.2501 18.1291 14.2501Z" fill="#292D32"></path> </g></svg>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="d-flex justify-content-center">
                                                                                <input type="hidden" value="{{$shippingItemsJsonArray[$key]}}" class="shipping-row-object-json">
                                                                                <button type="button" class="btn btn-dark btn-ellipse btn-sm d-flex align-items-center row-edit-btn">
                                                                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="edit"> <g> <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> <polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon> </g> </g> </g> </g></svg>
                                                                                    ویرایش
                                                                                </button>
                                                                                <button type="button" class="btn btn-warning btn-ellipse btn-sm d-flex align-items-center ml-2 row-delete-btn">
                                                                                    <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                                                    حذف
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="d-flex justify-content-center">
                                                                                <button type="button" class="btn btn-dark btn-ellipse btn-sm align-items-center row-save-btn d-none">
                                                                                    <svg width="64px" height="64px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>save-floppy</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-154.000000, -517.000000)" fill="#ffffff"> <path d="M172,522 C172,521.447 172.448,521 173,521 C173.552,521 174,521.447 174,522 L174,526 C174,526.553 173.552,527 173,527 C172.448,527 172,526.553 172,526 L172,522 L172,522 Z M163,529 L177,529 C177.552,529 178,528.553 178,528 L178,517 L162,517 L162,528 C162,528.553 162.448,529 163,529 L163,529 Z M182,517 L180,517 L180,529 C180,530.104 179.104,531 178,531 L162,531 C160.896,531 160,530.104 160,529 L160,517 L158,517 C155.791,517 154,518.791 154,521 L154,545 C154,547.209 155.791,549 158,549 L182,549 C184.209,549 186,547.209 186,545 L186,521 C186,518.791 184.209,517 182,517 L182,517 Z" id="save-floppy" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                                                                                    ذخیره
                                                                                </button>
                                                                                <button type="button" class="btn btn-dark btn-ellipse btn-sm align-items-center row-pending-btn d-none">
                                                                                    <span class="pending-loader"></span>
                                                                                    در حال ذخیره
                                                                                </button>
                                                                                <button disabled type="button" class="btn btn-dark btn-ellipse btn-sm align-items-center row-save-btn-success d-flex">
                                                                                    <svg fill="#000000" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M437.016,74.984c-99.979-99.979-262.075-99.979-362.033,0.002c-99.978,99.978-99.978,262.073,0.004,362.031 c99.954,99.978,262.05,99.978,362.029-0.002C536.995,337.059,536.995,174.964,437.016,74.984z M406.848,406.844 c-83.318,83.318-218.396,83.318-301.691,0.004c-83.318-83.299-83.318-218.377-0.002-301.693 c83.297-83.317,218.375-83.317,301.691,0S490.162,323.549,406.848,406.844z"></path> <path d="M368.911,155.586L234.663,289.834l-70.248-70.248c-8.331-8.331-21.839-8.331-30.17,0s-8.331,21.839,0,30.17 l85.333,85.333c8.331,8.331,21.839,8.331,30.17,0l149.333-149.333c8.331-8.331,8.331-21.839,0-30.17 S377.242,147.255,368.911,155.586z"></path> </g> </g> </g> </g></svg>
                                                                                    ذخیره شد!
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                            </div>  
                                            <!-- پایان جدول مربوط به ریز حمل سفارشات -->

                                            <div class="row shipping-element d-flex justify-content-between">

                                                <div class="col-md-12 bg-grey pt-3 ml-2 d-none" id="table-row-number-card">
                                                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" width="24px" height="24px" viewBox="0 0 448 448" id="svg2" version="1.1" inkscape:version="0.91 r13725" sodipodi:docname="work-item-2.svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title id="title3350">work-item</title> <defs id="defs4"> <pattern y="0" x="0" height="6" width="6" patternUnits="userSpaceOnUse" id="EMFhbasepattern"></pattern> </defs> <sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="1.979899" inkscape:cx="100.38339" inkscape:cy="187.19657" inkscape:document-units="px" inkscape:current-layer="layer1" showgrid="true" units="px" inkscape:snap-bbox="true" inkscape:bbox-nodes="true" inkscape:window-width="3840" inkscape:window-height="2097" inkscape:window-x="-8" inkscape:window-y="-8" inkscape:window-maximized="1" inkscape:object-nodes="true" inkscape:snap-grids="true" inkscape:snap-to-guides="false" inkscape:snap-nodes="true"> <inkscape:grid type="xygrid" id="grid3336" spacingx="16" spacingy="16" empspacing="2"></inkscape:grid> </sodipodi:namedview> <metadata id="metadata7"> <rdf:rdf> <cc:work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"></dc:type> <dc:title>work-item</dc:title> </cc:work> </rdf:rdf> </metadata> <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-604.36209)"> <path style="fill-opacity:1;stroke:none;stroke-width:64;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="M 112 0 L 90.666016 32 L 32 32 C 14.271983 32 0 46.271983 0 64 L 0 416 C 0 433.72802 14.271983 448 32 448 L 320 448 C 337.72802 448 352 433.72802 352 416 L 352 272 L 320 304 L 320 416 L 32 416 L 32 64 L 69.333984 64 L 48 96 L 304 96 L 282.66602 64 L 320 64 L 320 80 L 349.17773 50.822266 C 344.17232 39.706653 333.0229 32 320 32 L 261.33398 32 L 240 0 L 112 0 z M 128 32 L 224 32 L 240 64 L 112 64 L 128 32 z " transform="translate(0,604.36209)" id="rect3337"></path> <path style="fill-rule:evenodd;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 48,844.36209 128,128 272,-272 -32,-48 -240,240 -80,-80 z" id="path4147" inkscape:connector-curvature="0" sodipodi:nodetypes="ccccccc"></path> </g> </g></svg>
                                                    <h4 class="ml-1">
                                                        ردیف 1
                                                    </h4>
                                                </div>

                                                <div class="mb-2 request-btn-show-all-forms d-none">
                                                    <div class="alert-icon alert-warning alert-bg alert-inline text-center">
                                                        برای فعالسازی مبدا، مقصد و شرکت باربری در فرم زیر، ابتدا تاریخ و سپس مقدار درخواست را تکمیل نموده و می بایست روی دکمه
                                                        <b>
                                                            ثبت
                                                        </b> 
                                                        کلیک کنید.
                                                    </div>
                                                </div>

                                                <div class="col-md-12 ml-2 mr-2">
                                                    <div class="row min-max-loader-range">
                                                        <div class="row col-md-4 bg-grey pt-2 pb-2 d-flex align-items-center" style="height: 60px;">
                                                            <span class="ml-2">
                                                                مقدار حداقل بارگیری

                                                                <b>
                                                                    {{number_format($product->freightageLoadertype->pluck('loader_type_min')->min(), 0, '', ',')}}
                                                                </b>
                                                                
                                                                {{$product->determine_product_unit()}}
                                                            </span>
                                                            <span class="ml-2">
                                                                مقدار حداکثر بارگیری

                                                                <b>
                                                                    {{number_format($product->freightageLoadertype->pluck('loader_type_max')->max(), 0, '', ',')}}
                                                                </b>

                                                                {{$product->determine_product_unit()}}
                                                            </span>

                                                            <input type="hidden" id="loader_type_min" value="{{$product->freightageLoadertype->pluck('loader_type_min')->min()}}">
                                                            <input type="hidden" id="loader_type_max" value="{{$product->freightageLoadertype->pluck('loader_type_max')->max()}}">
                                                        </div>
                                                       
                                                        <div class="row col-md-4 bg-grey shipping-schedule pt-2 pb-2 d-flex align-items-center" style="padding-left: 30px;">
                                                            <div class="col-md-6">
                                                                <label>انتخاب تاریخ بارگیری</label>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input name="deliver_date" type="text" data-jdp="" data-jdp-only-date="" data-jdp-min-date="{{jdate()->addDays(3)->format('Y/m/d')}}" data-jdp-max-date="{{jdate()->addDays(29)->format('Y/m/d')}}" class="form-control form-control-sm deliver-date-input" placeholder="تاریخ مورد نظر را انتخاب نمایید">    
                                                            </div>
                                                        </div>

                                                        <div class="row col-md-4 bg-grey number-items-request pt-2 pb-2 d-flex align-items-center">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>
                                                                        مقدار درخواست
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="number" class="form-control form-control-sm" placeholder="{{$product->freightageLoadertype->pluck('loader_type_min')->min()}} الی {{$product->freightageLoadertype->pluck('loader_type_max')->max()}} {{$product->determine_product_unit()}}">
                                                                </div>
                                                                <div class="col-md-4 d-flex justify-content-center">
                                                                    <button class="btn btn-dark btn-rounded btn-sm ml-2 shipping-panel-btn">
                                                                        ثبت
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                           

                                                <div class="row row-number-info d-none" style="flex:1;">
                                                    <div class="row col-md-12 bg-grey mt-2 pl-5 pr-5 pt-2">
                                                        <div class="d-flex">
                                                            <div>
                                                                <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M31.4,15.3h8.2c0.6,0,1.1-0.5,1.1-1.1l0,0c0-0.3-0.1-0.5-0.3-0.8L30.2,3.3C29.9,3.1,29.7,3,29.4,3l0,0 c-0.6,0-1.1,0.5-1.1,1.1v8.1C28.3,13.9,29.7,15.3,31.4,15.3z"></path> <path d="M49.5,25.7l-0.9-0.9c-0.6-0.6-1.5-0.6-2.2,0L34.5,36.7c-0.1,0.1,0,0.2,0,0.3v2.5c0,0.2,0,0.4,0.2,0.4h2.6 c0.1,0,0.2-0.1,0.3-0.1L49.5,28C50.2,27.2,50.2,26.3,49.5,25.7z"></path> <path d="M39.9,44.4h-1.8h-3.6h-1.7c-1.6,0-2.9-1.3-2.9-2.9v-5.4c0-0.8,0.2-1.6,0.9-2.1l9.5-9.5 c0.3-0.3,0.5-0.7,0.5-1.1v-2c0-0.8-0.7-1.5-1.5-1.5H28.3c-2.6,0-4.6-2.1-4.6-4.6V4.5C23.7,3.7,23,3,22.1,3H6.6C4.1,3,2,5.1,2,7.6 v36.8C2,46.9,4.1,49,6.6,49h29.4c2.2,0,4.2-1.6,4.6-3.7C40.7,44.9,40.3,44.4,39.9,44.4z M8.2,16.8c0-0.8,0.7-1.5,1.5-1.5h6.2 c0.9,0,1.5,0.7,1.5,1.5v1.5c0,0.8-0.7,1.5-1.5,1.5H9.7c-0.9,0-1.5-0.7-1.5-1.5V16.8z M23.7,36.7c0,0.8-0.7,1.5-1.5,1.5H9.7 c-0.9,0-1.5-0.7-1.5-1.5v-1.5c0-0.8,0.7-1.5,1.5-1.5h12.4c0.9,0,1.5,0.7,1.5,1.5V36.7z M26.8,27.5c0,0.8-0.7,1.5-1.5,1.5H9.7 c-0.9,0-1.5-0.7-1.5-1.5V26c0-0.8,0.7-1.5,1.5-1.5h15.5c0.9,0,1.5,0.7,1.5,1.5V27.5z"></path> </g> </g></svg>
                                                            </div>
                                                            <div class="ml-1">
                                                                <span>
                                                                    شماره ردیف:
                                                                </span>
                                                                <span class="row-number"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="shipping-controller-panel row">
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
                                                        
                                                        {{-- فاصله بین مبدا و مقصد: --}}
                                                        <div class="mt-2 tab tab-with-title pt-2 pb-5 justify-content-center calculated-distance">
                                                        </div>
            
                                                    </div>
                                                
                                                    <div class="row col-md-3 bg-grey mt-2 pl-5 pr-5 pt-5 pb-5">
                                                        <div class="order-shipping-service pt-3">
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
                                                                    <span class="shipping-calculations d-none">
                                                                        <div class="shipping-page-distance-box d-none">
                                                                            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#9d9d9d"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14 14H17M14 10H17M9 9.5V8.5M9 9.5H11.0001M9 9.5C7.20116 9.49996 7.00185 9.93222 7.0001 10.8325C6.99834 11.7328 7.00009 12 9.00009 12C11.0001 12 11.0001 12.2055 11.0001 13.1667C11.0001 13.889 11.0001 14.5 9.00009 14.5M9.00009 14.5L9 15.5M9.00009 14.5H7.0001M6.2 19H17.8C18.9201 19 19.4802 19 19.908 18.782C20.2843 18.5903 20.5903 18.2843 20.782 17.908C21 17.4802 21 16.9201 21 15.8V8.2C21 7.0799 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V15.8C3 16.9201 3 17.4802 3.21799 17.908C3.40973 18.2843 3.71569 18.5903 4.09202 18.782C4.51984 19 5.07989 19 6.2 19Z" stroke="#9d9d9d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g>
                                                                            </svg>
                                                                            هزینه حمل:&nbsp;
                                                                            <strong class="shipping-price-text">
                                                                            </strong>
                                                                        </div>
                                                                        <div class="d-flex justify-content-center mt-5">
                                                                            <button type="button" class="btn btn-dark btn-ellipse btn-sm shipping-calc-confirm-btn d-none">
                                                                                <svg viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>save-floppy</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-152.000000, -515.000000)" fill="#ffffff"> <path d="M171,525 C171.552,525 172,524.553 172,524 L172,520 C172,519.447 171.552,519 171,519 C170.448,519 170,519.447 170,520 L170,524 C170,524.553 170.448,525 171,525 L171,525 Z M182,543 C182,544.104 181.104,545 180,545 L156,545 C154.896,545 154,544.104 154,543 L154,519 C154,517.896 154.896,517 156,517 L158,517 L158,527 C158,528.104 158.896,529 160,529 L176,529 C177.104,529 178,528.104 178,527 L178,517 L180,517 C181.104,517 182,517.896 182,519 L182,543 L182,543 Z M160,517 L176,517 L176,526 C176,526.553 175.552,527 175,527 L161,527 C160.448,527 160,526.553 160,526 L160,517 L160,517 Z M180,515 L156,515 C153.791,515 152,516.791 152,519 L152,543 C152,545.209 153.791,547 156,547 L180,547 C182.209,547 184,545.209 184,543 L184,519 C184,516.791 182.209,515 180,515 L180,515 Z" id="save-floppy" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                                                                                تأیید و ذخیره
                                                                            </button>
                                                                            <button type="button" class="btn btn-warning btn-ellipse btn-sm shipping-calc-cancel-btn ml-2 d-none">
                                                                            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#ffffff" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><line x1="8.06" y1="8.06" x2="55.41" y2="55.94"></line><line x1="55.94" y1="8.06" x2="8.59" y2="55.94"></line></g></svg>
                                                                                انصراف
                                                                            </button>
                                                                        </div>
                                                                    </span>
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
    
    <script src="{{asset('frontend/assets/js/shipping-page/formatDigits.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/leafletYelsuShipping.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/controlPanelSelectElementStateHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/inputValueResetFormHander.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/resetAllFormsHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/resetAllControlPanelFormsHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/shippingPageInformationAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/shippingPageCancelBtn.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/shippingPageFreightageInformationAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/shippingPageFreightageLoaderTypeAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/showCalcBtnLoaderType.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/resetLoaderTypeOrigin.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/resetLoaderTypeDestination.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/calculateRemainingQuantity.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/shippingPageTable.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/shippingTableCrud.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/quantityChangeEventHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/rowEditHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/shippingPageOriginAddressFilterAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/shippingPageFreightageCompanyFilterAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/resetRowNumberHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/resetRowClassesHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/rowDeleteHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/rowDuplicateHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/panelBtnRemainingErrorHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/sendShippingDetailsItemAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/shippingPanelBtnHandler.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/deleteRowAjax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/shipping-page/hidePriceCalculationLoaderTypeHandler.js')}}"></script>

@endsection