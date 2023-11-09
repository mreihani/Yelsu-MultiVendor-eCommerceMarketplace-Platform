@extends('frontend.main_theme')
@section('main')

<script>
    let outletsArr =  {!! json_encode($outletsArr) !!};
   
    let latitudeVal = {!! json_encode($latitudeVal) !!};
    let longitudeVal = {!! json_encode($longitudeVal) !!};
</script>


<main class="main">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb mb-3">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>
                    <a href="{{route('representative.all')}}">
                        لیست تأمین کنندگان  
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Pgae Contetn -->
    <div class="page-content mb-8">
        <div class="container">
            <!-- Start of Vendor Toolbox -->
            {{-- <div class="toolbox vendor-toolbox pb-0">
                <div class="toolbox-left mb-4 mb-md-0">
                    <a href="#" class="btn btn-primary btn-outline btn-rounded btn-icon-left vendor-search-toggle "><i class="w-icon-category"></i>جستجو فروشندگان </a>
                   
                    <label class="d-block vendor-total-num">تعداد فروشندگان {{count($representatives)}}</label>
                </div>
                <div class="toolbox-right">
                    <div class="toolbox-item toolbox-sort select-box mb-0">
                        <label class="font-weight-normal">مرتب سازی بر اساس: </label>
                        <select name="orderby" class="form-control">
                            <option value="default" selected="selected">پیشفرض </option>
                            <option value="recent">اخیرا </option>
                            <option value="popular">محبوبترین </option>
                        </select>
                    </div>
                    <div class="toolbox-item toolbox-layout mb-0 d-flex">
                        <a href="vendor-dokan-store-grid.html" class="icon-mode-grid btn-layout active">
                            <i class="w-icon-grid"></i>
                        </a>
                        <a href="vendor-dokan-store-list.html" class="icon-mode-list btn-layout">
                            <i class="w-icon-list"></i>
                        </a>
                    </div>
                </div>
            </div> --}}
            <!-- End of Vendor Toolbox -->
            {{-- <div class="vendor-search-wrapper"> --}}
                <form class="vendor-search-form d-flex mb-10" method="GET" action="{{route('representative.all.search')}}">
                    <input type="text" class="form-control mr-4 bg-white" name="q" id="representative"
                        placeholder="تأمین کننده را جستجو کنید" value="{{$query}}" />
                    <button class="btn btn-primary btn-rounded" type="submit">جستجو </button>
                </form>
                <!-- End of Vendor Search Form -->
            {{-- </div> --}}


            @if(count($outletsArr))    
            <div class="container mt-10">
                <div class="shop-default-category">                           
                    <h4 class="text-center">مکان یابی تأمین کنندگان</h4>
                    <div id="map"></div>
                </div>
            </div>
            @elseif(!count($representatives))
            <div class="container mt-10">
                <div class="shop-default-category">                           
                    <h4 class="text-center">هیچ نتیجه ای یافت نشد!</h4>
                </div>
            </div>
            @endif

            @if(Route::currentRouteName() == 'representative.all')    
                <div class="toolbox toolbox-pagination d-flex justify-content-center" style="border-top: none;">
                    {{$representatives->links('vendor.pagination.custom')}}
                </div>
            @endif

            <div class="row cols-lg-3 cols-md-2 cols-sm-2 cols-1 mt-4">

                @foreach($representatives as $representative)

                <div class="store-wrap mb-4">
                    <div class="store store-grid">
                        <div class="store-header">
                            <figure class="store-banner">
                                <img src="{{(!empty($representative->store_banner)) ? url('storage/upload/representative_images/'.$representative->store_banner) : url('storage/upload/no_image_store.jpg')}}" alt="Vendor" 
                                    width="400" height="194" style="background-color: #40475E" />
                            </figure>
                        </div>
                        <!-- End of Store Header -->

                        @php
                            $representative_sector_arr = explode(",", $representative->representative_sector);
                            $representative_sector_cat_arr = App\Models\Category::findRootCategoryArray($representative_sector_arr)
                        @endphp

                        <div class="store-content">
                            <h4 class="store-title">
                                <a href="{{route('representative.details',$representative->id)}}">{{$representative->shop_name}}</a>
                            </h4>
                            <div class="featured-label-vendor-all">
                                @foreach($representative_sector_cat_arr as $representative_sector_item)
                                <a href="{{route('shop.category',['id'=> $representative_sector_item->id])}}">
                                    {{$representative_sector_item->category_name}}
                                </a>
                                @endforeach
                            </div>
                            {{-- <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: 100%;"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div> --}}
                            {{-- <div style="color:black;" class="store-address">
                                {{$representative->shop_address}}
                            </div> --}}
                            {{-- <ul class="seller-info-list list-style-none">
                                <li class="store-phone">
                                    <a style="color:black;" href="tel:{{$representative->home_phone}}"><i class="w-icon-phone"></i>{{$representative->home_phone}}</a>
                                </li>
                            </ul> --}}
                        </div>
                        <!-- End of Store Content -->
                        <div class="store-footer">
                            <figure class="seller-brand">
                                <img src="{{(!empty($representative->photo)) ? url('storage/upload/representative_images/'.$representative->photo) : url('storage/upload/no_image.jpg')}}" alt="Brand" width="80" height="80" />
                            </figure>
                            <a href="{{route('representative.details',$representative->id)}}" class="btn btn-dark btn-link btn-underline btn-icon-right btn-visit">
                                اطلاعات بیشتر <i class="w-icon-long-arrow-left"></i></a>
                        </div>
                        <!-- End of Store Footer -->
                    </div>
                    <!-- End of Store -->
                </div>

                @endforeach

            </div>
                
            {{-- @if(Route::currentRouteName() == 'representative.all')    
                <div class="toolbox toolbox-pagination d-flex justify-content-center mt-5">
                    {{$representatives->links('vendor.pagination.custom')}}
                </div>
            @endif --}}

        </div>
    </div>
    <!-- End of Page Content -->
</main>


<script src="{{asset('frontend/assets/plugins/leaflet/leafletYelsuFrontend.js')}}"></script>


@endsection