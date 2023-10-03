<!DOCTYPE html>
<!--
نویسنده: Amin Reihani
تماس با من: reihani.eng@gmail.com
-->
<html direction="rtl" dir="rtl" style="direction: rtl" >
	<!--begin::Head-->
	<head><base href=""/>
		<title>پیشخوان مدیر</title>
		<meta charset="utf-8" />
		{!! SEO::generate() !!}
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<link rel="shortcut icon" href="{{asset('adminbackend/assets/media/logos/favicon.ico')}}" />
		
		<!--begin::Global Stylesheets Bundle(mوatory for all pages)-->
		<link href="{{asset('adminbackend/assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('adminbackend/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->

		<!--leaflet CSS-->
		{{-- <link href="{{asset('frontend/assets/plugins/leaflet/leaflet.css')}}" rel="stylesheet" type="text/css" /> --}}
		<link href="{{asset('frontend/assets/plugins/leaflet/neshan.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('frontend/assets/plugins/leaflet/Control.Geocoder.css')}}" rel="stylesheet" type="text/css"/>
		<!--begin::Javascript-->
		{{-- <script>var hostUrl = "assets/"</script> --}}
		
		<script src="{{asset('adminbackend/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('adminbackend/assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
	
		<script src="{{asset('adminbackend/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		
		<script src="{{asset('adminbackend/assets/js/tinymce/tinymce.min.js')}}"></script>

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		{{-- <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getآیتم("data-theme") !== null ) { themeMode = localStorage.getآیتم("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script> --}}
		<!--end::Theme mode setup on page load-->
		<!--begin::اپلیکیشن-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
                @include('admin.body.header')				
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
					@include('admin.body.sidebar')
					<!--end::Sidebar-->
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">
							<!--begin::Content-->
							@yield('admin')
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
						<!--begin::Footer-->
						
						@include('backend_dashboard_global.footer_global')  
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::اپلیکیشن-->

		
	</body>
	<!--end::Body-->
</html>