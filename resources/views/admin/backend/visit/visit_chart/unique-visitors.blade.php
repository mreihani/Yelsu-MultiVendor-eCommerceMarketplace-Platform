@extends('admin.admin_dashboard')
@section('admin')

<script>   
    let unique_visits_per_day = {!! json_encode($unique_visits_per_day) !!};
    let unique_visits_per_day_iran = {!! json_encode($unique_visits_per_day_iran) !!};
</script>


<div id="kt_app_content" class="app-content flex-column-fluid d-flex align-items-center">

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="card card-bordered mt-9">

            <div class="text-center pt-10">
                <h3>نمودار بازدیدکنندگان یکتا (جهانی و داخلی)</h3>
            </div>

            <div class="card-body">
                <div id="unique-visitors"></div>
            </div>
        </div>
        
    </div>
    <!--end::Content container-->
</div>

<script src="{{asset('adminbackend/assets/plugins/custom/apexcharts/adminUniqueVisitsChart.js')}}"></script>
   
@endsection