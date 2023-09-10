<!DOCTYPE html>

<html direction="rtl" dir="rtl" style="direction: rtl" >
	<!--begin::Head-->
	<head><base href="{{ URL::to('/') }}"/>
		<title>تایید پیامک وبسایت یل سو</title>
		<meta charset="utf-8" />
		{!! SEO::generate() !!}    
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="icon" type="image/png" href="{{asset('frontend/assets/images/icons/favicon.png')}}">
		<!--begin::Fonts(mوatory for all pages)-->
		{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> --}}
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mوatory for all pages)-->
		<link href="{{asset('adminbackend/assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('adminbackend/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank app-blank">
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::احراز هویت - Two-stes -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					@if(session()->has('error'))
						<div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5 mt-5 mb-5">
							<h4 class="alert-title" style="color:#ffa800">
								<i class="w-icon-exclamation-triangle"></i>خطا!</h4>
								{{session('error')}}
						</div>
					@endif
					<!--begin::Form-->
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10">						
							<!--begin::Form-->
							<form method="POST" action="{{route('2fa.token')}}" class="form w-100 mb-13">
                                @csrf
								<!--begin::Icon-->
								<div class="text-center mb-10">
									<img alt="Logo" class="mh-125px" src="{{asset('adminbackend/assets/media/svg/misc/smartphone-2.svg')}}" />
								</div>
								<!--end::Icon-->
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">تایید شماره تلفن</h1>
									<!--end::Title-->
									<!--begin::Sub-title-->
									<div class="text-muted fw-semibold fs-5 mb-5">وارد کردن کد تایید ارسال شده به شما</div>
									<!--end::Sub-title-->
									<!--begin::Mobile no-->
									<div class="fw-bold text-dark fs-3" dir="ltr">{{substr($home_phone, 0, 4) . "*****" . substr($home_phone, 9, 10)}}</div>
									<!--end::Mobile no-->
								</div>
								<!--end::Heading-->
								<!--begin::Section-->
								<div class="mb-10">
									<!--begin::Tags-->
									<div class="fw-bold text-start text-dark fs-6 mb-1 ms-1">کد امنیتی 5 رقمی خود را تایپ کنید</div>
									<!--end::Tags-->
									<!--begin::Input group-->
									<div class="d-flex flex-stack" dir="ltr">
										<input type="text" name="code_1" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2 numberInputSMS"  />
										<input type="text" name="code_2" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2 numberInputSMS"  />
										<input type="text" name="code_3" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2 numberInputSMS"  />
										<input type="text" name="code_4" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2 numberInputSMS"  />
										<input type="text" name="code_5" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2 numberInputSMS"  />
                                        @error('code_1')
                                            <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
									</div>
									<!--begin::Input group-->
								</div>
								<!--end::Section-->
								<!--begin::ثبت-->
								<div class="d-flex flex-center">
									<button type="submit" class="btn btn-lg btn-primary fw-bold">
										<span class="indicator-label">ثبت</span>
									</button>
								</div>
								<!--end::ثبت-->
							</form>
							<!--end::Form-->
							<!--begin::Notice-->
							<div class="text-center fw-semibold fs-5">
								<span class="text-muted me-1 resendlinkbtn">هنوز کد را دریافت نکرده اید؟</span>
								<a href="{{route('2fa.token.phoneResend')}}" class="link-primary fs-5 me-1 resendlinkbtn">ارسال دوباره</a>
								<div class="text-muted timer">زمان باقی مانده: <span id="timer"></span></div>
							</div>
							<!--end::Notice-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Form-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap px-5">
						<!--begin::Links-->
						
						<!--end::Links-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
				<!--begin::کناری-->
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{asset('adminbackend/assets/media/misc/auth-bg.jpg')}}); background-repeat:no-repeat;">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
						<!--begin::Title-->
						<div>
							<h1 style="font-size: 75px;" class="d-none d-lg-block text-white fw-bolder text-center mb-7">YELSU</h1>
						</div>
						<!--end::Title-->
						<!--begin::Text-->
						<div style="font-size: 30px; direction: ltr;" class="d-none d-lg-block text-white text-center">Part of the future
							{{-- <a href="#" class="opacity-75-hover text-warning fw-bold me-1">مصاحبه شونده</a> --}}
						</div>
						<!--end::Text-->

						<!--begin::Image-->
						<img class="d-none d-lg-block mx-auto w-450px smsCenterImage" src="{{asset('adminbackend/assets/media/misc/auth-screens.png')}}" alt="" />
						<!--end::Image-->

						<!--begin::Logo-->
						<a href="{{ URL::to('/') }}" class="mb-0 mb-lg-12 mt-10">
							<img alt="Logo" src="{{asset('frontend/assets/images/demos/demo13/logo.png')}}" class="h-60px h-lg-75px" />
						</a>
						<!--end::Logo-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::کناری-->
			</div>
			<!--end::احراز هویت - Two-stes-->
		</div>
		<script>var hostUrl = "assets/";</script>
		<script src="{{asset('adminbackend/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('adminbackend/assets/js/scripts.bundle.js')}}"></script>
		<script src="{{asset('adminbackend/assets/js/custom/authentication/sign-in/two-steps.js')}}"></script>
	</body>
	<!--end::Body-->
</html>

<script>
	let timerOn = true;
	$('.resendlinkbtn').hide();
	$('.timer').show();

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  $('.resendlinkbtn').show();
  $('.timer').hide();
}

timer(119);
</script>

<script>
	$(document).on("keyup", ".numberInputSMS", function (e) {
		if(e.target.value) {
			$(this).next().focus();
		}
	})
	</script>