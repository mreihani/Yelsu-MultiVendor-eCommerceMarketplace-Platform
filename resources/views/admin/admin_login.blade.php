
<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl" >
	<!--begin::Head-->
	<head><base href="../../../"/>
		<title>ورود مدیر</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced پنل ادمین بوت استراپ Theme on Themeforest trusted by 100,000 beginners و professionals. Multi-demo, حالت تیره, RTL support و complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Flask & Laravel versions. Grab your copy now و get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Flask & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="مترونیک " />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | مترونیک" />
		<link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{{asset('adminbackend/assets/media/logos/favicon.ico')}}" />
		<!--begin::Fonts(mوatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mوatory for all pages)-->
		<link href="{{asset('adminbackend/assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('adminbackend/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank app-blank">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getآیتم("data-theme") !== null ) { themeMode = localStorage.getآیتم("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::احراز هویت - ورود -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<!--begin::Form-->
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10">
							<!--begin::Form-->
                            <form class="form w-100" method="POST" action="{{ route('login') }}">    
                                @csrf
								<!--begin::Heading-->
								<div class="text-center mb-11">
									<!--begin::Title-->
									<h1 class="text-dark fw-bolder mb-3">ورود مدیر</h1>
									<!--end::Title-->
									<!--begin::Subtitle-->
									<div class="text-gray-500 fw-semibold fs-6">پیشخوان مدیریت</div>
									<!--end::Subtitle=-->
								</div>
								<!--begin::Heading-->
								<!--begin::Login options-->
								
								<!--end::Login options-->
								<!--begin::Separator-->

								<!--end::Separator-->
								<!--begin::Input group=-->
								<div class="fv-row mb-8">
									<!--begin::ایمیل-->
									<input dir="ltr" type="email" id="email" placeholder="ایمیل" name="email" autocomplete="off" class="form-control bg-transparent" />
									<!--end::ایمیل-->
								</div>
								<!--end::Input group=-->
								<div class="fv-row mb-3">
									<!--begin::password-->
									<input dir="ltr" type="password" id="password" placeholder="کلمه عبور" name="password" autocomplete="off" class="form-control bg-transparent" />
									<!--end::password-->
								</div>
								<!--end::Input group=-->
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div></div>
									<!--begin::Link-->
									<a href="../../demo1/dist/authentication/layouts/corporate/reset-password.html" class="link-primary">فراموشی رمز؟</a>
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::ثبت button-->
								<div class="d-grid mb-10">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<!--begin::Indicator label-->
										<span class="indicator-label">ورود</span>
										<!--end::Indicator label-->
										<!--begin::Indicator progress-->
										<span class="indicator-progress">لطفا صبر کنید...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										<!--end::Indicator progress-->
									</button>
								</div>
								<!--end::ثبت button-->
								<!--begin::ثبت نام-->
								<div class="text-gray-500 text-center fw-semibold fs-6">آیا هنوز عضو نشده؟
								<a href="../../demo1/dist/authentication/layouts/corporate/sign-up.html" class="link-primary">ثبت نام</a></div>
								<!--end::ثبت نام-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Form-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap px-5">
						<!--begin::Links-->
						<div class="d-flex fw-semibold text-primary fs-base">
							<a href="../../demo1/dist/pages/team.html" class="px-5" target="_blank">تیم ها</a>
							<a href="../../demo1/dist/pages/pricing/column.html" class="px-5" target="_blank">پلان ها</a>
							<a href="../../demo1/dist/pages/contact.html" class="px-5" target="_blank">تماس با ما</a>
						</div>
						<!--end::Links-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
				<!--begin::کناری-->
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{asset('adminbackend/assets/media/misc/auth-bg.png')}})">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
						<!--begin::Logo-->
						<a href="../../demo1/dist/index.html" class="mb-0 mb-lg-12">
							<img alt="Logo" src="{{asset('adminbackend/assets/media/logos/custom-1.png')}}" class="h-60px h-lg-75px" />
						</a>
						<!--end::Logo-->
						<!--begin::Image-->
						<img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{asset('adminbackend/assets/media/misc/auth-screens.png')}}" alt="" />
						<!--end::Image-->
						<!--begin::Title-->
						<h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">سریع، کارآمد و محصولات</h1>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="d-none d-lg-block text-white fs-base text-center">در این نوع پست،
						<a href="#" class="opacity-75-hover text-warning fw-bold me-1">وبلاگر</a>فردی را که با او مصاحبه کرده اند معرفی می کند
						<br />و برخی اطلاعات پس زمینه در مورد ارائه می دهد
						<a href="#" class="opacity-75-hover text-warning fw-bold me-1">مصاحبه شونده</a>و آنها
						<br />کار بعد از این متن مصاحبه است.</div>
						<!--end::Text-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::کناری-->
			</div>
			<!--end::احراز هویت - ورود-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "{{asset('adminbackend/assets/')}}";</script>
		<!--begin::Global Javascript Bundle(mوatory for all pages)-->
		<script src="{{asset('adminbackend/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('adminbackend/assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::سفارشی Javascript(used for this page only)-->
		<script src="{{asset('adminbackend/assets/js/custom/authentication/sign-in/general.js')}}"></script>
		<!--end::سفارشی Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
