@extends('editor.editor_dashboard')
@section('editor')

<div id="kt_app_content" class="app-content flex-column-fluid">
    @if(session()->has('success'))
        <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5  mt-5 mb-5">
            <h4 class="alert-title"></h4><i style="color:#50cd89" class="fas fa-check"></i> {{session('success')}}
        </div>
    @endif
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xxl-12">
                <!--begin::Engage widget 10-->
                <div class="card card-flush h-md-100">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column justify-content-between mt-9 bgi-no-repeat bgi-size-cover bgi-position-x-center pb-15" style="background-position: 100% 50%; background-image:url('https://yelsu.com/adminbackend/assets/media/stock/900x600/42.png')">
                        <!--begin::Wrapper-->
                        <div class="mb-10">
                            <!--begin::Title-->
                            <div class="fs-2hx fw-bold text-gray-800 text-center mb-13">
                            <span class="me-2">به پیشخوان نویسنده خوش آمدید 
                        </span></div>
                            <!--end::Title-->
                           
                        </div>
                        <!--begin::Wrapper-->
                        <!--begin::Illustration-->
                        <img class="mx-auto h-150px h-lg-200px theme-light-show" src="https://yelsu.com/adminbackend/assets/media/illustrations/sigma-1/4.png" alt="">
                        <img class="mx-auto h-150px h-lg-200px theme-dark-show" src="https://yelsu.com/adminbackend/assets/media/illustrations/sigma-1/4.png" alt="">
                        <!--end::Illustration-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Engage widget 10-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        
    </div>
    <!--end::Content container-->
</div>

<!--begin::سفارشی Javascript(used for this page only)-->
{{-- <script src="{{asset('adminbackend/assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/new-target.js')}}"></script> --}}
<script src="{{asset('adminbackend/assets/js/custom/utilities/modals/users-search.js')}}"></script>
<!--end::سفارشی Javascript-->


@endsection