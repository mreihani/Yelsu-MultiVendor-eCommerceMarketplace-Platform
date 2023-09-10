
<!DOCTYPE html>

<html direction="rtl" dir="rtl" style="direction: rtl" >
	<!--begin::Head-->
	<head>
		
		<meta charset="utf-8" />
		{!! SEO::generate() !!}

		<link rel="icon" type="image/png" href="{{asset('frontend/assets/images/icons/favicon.png')}}">
		<!--begin::Fonts(mوatory for all pages)-->
		
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mوatory for all pages)-->
		<link href="{{asset('frontend/assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('frontend/assets/plugins/global/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
		<!--begin::Theme mode setup on page load-->
		
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url({{asset('frontend/assets/plugins/global/bg3.jpg')}}); } [data-theme="dark"] body { background-image: url({{asset('frontend/assets/plugins/global/bg3.jpg')}}); }</style>
			<!--end::Page bg image-->
			<!--begin::احراز هویت - Signup پیام خوش امد گویی -->
			<div class="d-flex flex-column flex-center flex-column-fluid">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-center text-center p-10">
					<!--begin::Wrapper-->
					<div class="card card-flush w-lg-650px py-5">
						<div class="card-body py-15 py-lg-20">
							<!--begin::Title-->
							<h1 class="fw-bolder fs-2qx text-gray-900 mb-4">ما در حال بروزرسانی هستیم</h1>
							<!--end::Title-->
							<!--begin::Text-->
							<div class="fw-semibold fs-6 text-gray-500 mb-7">به زودی باز خواهیم گشت.</div>
							<!--end::Text-->
							<!--begin::Illustration-->
							<div class="mb-11">
								<img src="{{asset('frontend/assets/plugins/global/maintenance.png')}}" class="mw-100 mh-300px theme-light-show" alt="" />
								<img src="{{asset('frontend/assets/plugins/global/maintenance.png')}}" class="mw-100 mh-300px theme-dark-show" alt="" />
							</div>
							<!--end::Illustration-->
							<!--begin::Link-->
							{{-- <div class="mb-0">
								<a href="{{URL::to('/')}}" class="btn btn-sm btn-primary">برو به صفحه اصلی</a>
							</div> --}}
							<!--end::Link-->
						</div>
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::احراز هویت - Signup پیام خوش امد گویی-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mوatory for all pages)-->
		<script src="{{asset('frontend/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('frontend/assets/plugins/global/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>