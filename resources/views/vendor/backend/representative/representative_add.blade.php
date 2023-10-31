@extends('vendor.vendor_dashboard')
@section('vendor')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    @if(session()->has('success'))
        <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action ms-5 me-5  mt-5 mb-5">
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
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن کاربر </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">
                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">خانه</a>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">مدیریت کاربران </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">افزودن کاربر</li>
                        <!--end::آیتم-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <form class="form" method="POST" action={{route('vendor.store.representative')}}>
                @csrf
                    <!--begin::کارت-->
                    <div class="card mb-5 mb-xl-10">
                        <!--begin::کارت header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                            <!--begin::کارت title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">مشخصات کاربر</h3>
                            </div>
                            <!--end::کارت title-->
                        </div>
                        <!--begin::کارت header-->
                        <!--begin::Content-->
                        <div class="collapse show">
                            <!--begin::کارت body-->
                            <div class="card-body border-top p-9">

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نوع حساب کاربری</label>
                                    <!--end::Tags-->
                                    <div class="col-lg-10 fv-row">
                                        <select name="representative_type" class="form-select form-select-lg form-control-solid">
                                            <option value="agency">عاملیت</option>
                                            <option value="delegation">نمایندگی</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <div class="separator separator-dashed my-5 pt-5"></div>            
                            
                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="firstname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام کاربر را وارد نمایید" value="{{old('firstname')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام خانوادگی</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="lastname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام خانوادگی کاربر را وارد نمایید" value="{{old('lastname')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <div class="separator separator-dashed my-5 pt-5"></div>

                                <!--begin::Input group-->
                                <div class="row mb-6 pt-5">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نوع شخص</label>
                                    <!--end::Tags-->
                                    <div class="col-lg-10 fv-row">
                                        <select id="person" name="person_type" class="form-select form-select-lg form-control-solid">
                                            <option {{$vendorData->person_type == "haghighi" ? "selected" : ""}} value="haghighi">شخص حقیقی</option>
                                            <option {{$vendorData->person_type == "hoghoghi" ? "selected" : ""}} value="hoghoghi">شخص حقوقی</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->                                

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10 haghighi">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">کد ملی</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="number" name="national_code" class="form-control form-control-lg form-control-solid" placeholder="کد ملی" value="{{$vendorData->national_code}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10 hoghoghi">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">شماره شناسه شرکت</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="number" name="company_number" class="form-control form-control-lg form-control-solid" placeholder="شماره شناسه شرکت" value="{{$vendorData->company_number}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10 hoghoghi">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام نماینده</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="agent_name" class="form-control form-control-lg form-control-solid" placeholder="نام نماینده" value="{{$vendorData->agent_name}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <div class="separator separator-dashed my-5 pt-5"></div>                              

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام فروشگاه / شرکت</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="shop_name" class="form-control form-control-lg form-control-solid" placeholder="نام فروشگاه یا شرکت" value="{{$vendorData->shop_name}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">آدرس دفتر مرکزی</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="shop_address" class="form-control form-control-lg form-control-solid" placeholder="آدرس فروشگاه / شرکت" value="{{$vendorData->shop_address}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <div class="separator separator-dashed my-5 pt-5"></div>

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">نام کاربری</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="username" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام کاربری را وارد نمایید" value="{{old('username')}}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">ایمیل</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="email" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="email@example.com" value="{{old('email')}}" autocomplete="off" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6 mt-10">
                                    <!--begin::Tags-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">کلمه عبور</label>
                                    <!--end::Tags-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="password" name="password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="کلمه عبور" value="password" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->  
                                                                                                                
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::کارت-->


                    <!--begin::کارت-->
                    <div class="card mb-5 mb-xl-10">

                        <!--begin::کارت header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                            <!--begin::کارت title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">مجوز موقعیت جغرافیایی فعالیت (برای تمام محصولات)</h3>
                            </div>
                            <!--end::کارت title-->
                        </div>
                        <!--begin::کارت header-->

                        <!--begin::Content-->
                        <div class="collapse show">
                            <!--begin::کارت body-->
                            <div class="card-body border-top pt-0">
                                <!--begin::Input group-->
                                <div class="row d-flex justify-content-end py-5">

                                    <!--begin::Tags-->
                                    <label class="col-lg-12 col-form-label fw-semibold fs-6">
                                        موقعیت جغرافیایی محصول مورد نظر را از طریق انتخاب استان و شهر تعیین نمایید
                                    </label>
                                    <!--end::Tags-->

                                    <!--begin::Col-->
                                    <div class="row repeater-body">
                                        <div class="col-lg-10">
                                            <div class="repeater">
                                                <div data-repeatable class="my-2">
                                                    <fieldset class="row">
                                                        <!--begin::Row-->
                                                        <div class="row col-md-10">
                                                            <div class="row gutter-sm ir-select">        
                                                                <label class="col-md-2  d-flex align-items-center">استان</label>                  
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="select-box">
                                                                            <select name="geolocation_permission_province[]" class="ir-province form-control form-control-md"></select>
                                                                        </div>
                                                                    </div>
                                                                </div>
    
                                                                <label class="col-md-2 d-flex align-items-center">شهر</label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <select name="geolocation_permission_city[]" class="ir-city form-control form-control-md"></select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Row-->
                                                        <div class="col-md-2 d-flex align-items-center">
                                                            <button type="button" class="btn btn-sm btn-light-danger del-repeater-btn">
                                                                حذف
                                                                <i class="bi bi-patch-minus-fill"></i>
                                                            </button>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 d-flex align-items-start mt-3">
                                            <button type="button" class="btn btn-sm btn-light-primary add-repeater-btn">
                                                افزودن
                                                <i class="bi bi-patch-plus-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Tags-->
                                    <label class="col-lg-12 col-form-label fw-semibold fs-6 mt-5 pt-5">
                                        موقعیت جغرافیایی محصول مورد نظر را در صورت صادرات از طریق انتخاب کشور تعیین نمایید
                                    </label>
                                    <!--end::Tags-->
                                    
                                    <select class="export-countries-dropdown form-select" name="geolocation_permission_export_country[]" multiple="multiple" data-control="select2" data-placeholder="انتخاب کشور" data-allow-clear="true" tabindex="-1" data-kt-initialized="1" dir="ltr">
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Åland Islands">Åland Islands</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guernsey">Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-leste">Timor-leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                               
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::کارت-->


                    <!--begin::کارت-->
                    <div class="card mb-5 mb-xl-10">

                        <!--begin::کارت header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
                            <!--begin::کارت title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">محصول مورد نظر را از جدول زیر انتخاب نمایید</h3>
                            </div>
                            <!--end::کارت title-->
                        </div>
                        <!--begin::کارت header-->

                        <!--begin::Content-->
                        <div class="collapse show">
                            <!--begin::کارت body-->
                            <div class="card-body border-top pt-0">

                                <!-- بخش مربوط به جدول محصولات --> 
                                @if(count($vendor_products))

                                    @foreach ($vendor_products as $category_id => $product_object_array)
                                
                                        <div class="yelsuDataTablesHead d-flex align-items-center mt-10">
                                            <div class="vendor-image-div">
                                                @if(!empty($vendorData->photo))
                                                    <img alt="Logo" src="{{url('storage/upload/vendor_images/' . $vendorData->photo)}}"/>
                                                @else
                                                    <img alt="Logo" src="{{asset('frontend/assets/images/demos/demo13/logo_cropped.png')}}"/>
                                                @endif

                                                <a href="{{route('shop.category', ['id'=> $category_id])}}">  {{App\Models\Category::find($category_id)->category_name}} </a>
                                            </div>

                                            <div class="value-added-tax-div">
                                                <input type="checkbox" class="value_added_tax_btn">
                                                <label for="value_added_tax">نمایش قیمت با ارزش افزوده</label>
                                            </div>
                                        </div>
                                        <div class="product-wrapper row">
                                            <div class="product-wrap">
                                                <div class="product text-center">
                                                    <table class="display yelsuDataTables" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">
                                                                    <input class="form-check-input product-bulk-action" type="checkbox">
                                                                </th>
                                                                <th class="text-center">ردیف</th>
                                                                <th class="all text-center">نام محصول</th>
                                                                {{-- @if(count(App\Models\Category::find($category_id)->attributes))
                                                                    @foreach (App\Models\Category::find($category_id)->attributes->first()->items->where('show_in_table_page', 1)->sortBy('attribute_item_order', SORT_NUMERIC) as $attribute_header_key => $attribute_header_items)
                                                                        <th class="text-center">
                                                                            {{$attribute_header_items->attribute_item_name}} 
                                                                        </th> 
                                                                    @endforeach
                                                                @endif --}}
                                                                <th class="all text-center">تعداد / مقدار محصول اختصاص داده شده</th>
                                                                <th class="all text-center">مجوز تغییر قیمت</th>
                                                                <th class="all text-center">موقعیت جغرافیایی اختصاصی محصول</th>
                                                                <th class="all text-center">مشخصات</th>
                                                                <th class="all text-center">قیمت</th>
                                                                <th class="text-center">اطلاعات بیشتر</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($product_object_array as $product_key => $product_item)
                                                                <tr>
                                                                    <td>
                                                                        <input class="form-check-input" type="checkbox" value="{{$product_item->id}}">
                                                                    </td>
                                                                    <td>{{ $product_key + 1}}</td>
                                                                    <td>
                                                                        <a href="{{route('product.details', $product_item->product_slug)}}">
                                                                            {{$product_item->product_name}}
                                                                        </a>
                                                                    </td>
                                                                    {{-- @if(count(App\Models\Category::find($category_id)->attributes))
                                                                        @foreach (App\Models\Category::find($category_id)->attributes->first()->items->where('show_in_table_page', 1)->sortBy('attribute_item_order', SORT_NUMERIC) as $attribute_row_key => $attribute_row_items)
                                                                            <td>
                                                                                @if(in_array($attribute_row_items->id, $product_item->table_attribute_items_obj_array()->keys()->toArray()))
                                                                                    @if ($attribute_row_items->attribute_item_type == "dropdown")
                                                                                        {{collect($product_item->table_attribute_items_obj_array()[$attribute_row_items->id]['attribute_value_obj'])->pluck('value')->join('، ')}} 
                                                                                    @else
                                                                                        {{$product_item->table_attribute_items_obj_array()[$attribute_row_items->id]['attribute_value']}} 
                                                                                    @endif
                                                                                @else 
                                                                                    ناموجود
                                                                                @endif
                                                                            </td> 
                                                                        @endforeach
                                                                    @endif     --}}
                                                                    <td>
                                                                        <span class="badge badge-info">نامحدود</span>
                                                                    </td>
                                                                    <td>
                                                                        بله
                                                                    </td>
                                                                    <td>
                                                                        بله
                                                                    </td>
                                                                    @if($product_item->selling_price != 0)
                                                                        <input type="hidden" value="{{$product_item->selling_price}}" class="price_before_value_added_tax">
                                                                        <input type="hidden" value="{{$product_item->determine_product_value_added_tax_by_percent()}}" class="price_after_value_added_tax">
                                                                        <td>
                                                                            <span class="price_tag">{{number_format($product_item->selling_price, 0, '', ',')}}</span> {{$product_item->determine_product_currency()}}
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <a href="tel:02191692471">
                                                                                تماس بگیرید
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                    <td>
                                                                        <button @disabled(true) type="button" class="btn btn-sm btn-dark m-1 edit-button-specification" onclick='location.href="#product-edit-specification-section"'>
                                                                            <i class="bi bi-pencil-fill"></i>
                                                                            ویرایش
                                                                        </button>
                                                                        
                                                                        <input class="hidden-input-information" disabled type="hidden" name="product_obj[]" value={{json_encode(["product_id" => $product_item->id, "product_in_stock" => "نامحدود","change_price_permission" => false,"product_specific_geolocation" => false])}}>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <!-- پایان بخش مربوط به جدول محصولات --> 
                                                                                                                
                            </div>
                            <!--end::کارت body-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::کارت-->


                    <!--begin::کارت-->
                    <div class="card mb-5 mb-xl-10" id="product-edit-specification-section" style="display: none;">

                        <!--begin::کارت header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-controls="kt_account_profile_details">
                            <!--begin::کارت title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">تنظیمات مورد نظر را پس از اعمال ذخیره نمایید</h3>
                            </div>
                            <!--end::کارت title-->
                        </div>
                        <!--begin::کارت header-->

                        <!--begin::Content-->
                        <div class="collapse show">
                            <!--begin::Actions-->

                            <!--begin::Input group-->
                            <div class="row card-footer d-flex justify-content-end">
                                <!--begin::Tags-->
                                <label class="col-lg-8 col-form-label fw-semibold fs-6">تعداد محصول اختصاص داده شده (در صورت نامحدود بودن این فیلد را خالی بگذارید)</label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-4" style="padding-left: 28px;" >
                                    <input type="number" class="form-control form-control-solid" placeholder="تعداد مورد نظر را وارد نمایید" name="product_in_stock" id="product_in_stock">
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row d-flex justify-content-end mx-5 px-4">
                                <!--begin::Tags-->
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <label for="change-price-permission">مجوز تغییر قیمت</label>
                                    <input class="form-check-input w-45px h-30px mx-2" type="checkbox" id="change-price-permission" name="change_price_permission">
                                </div>
                                <!--end::Tags-->
                                <!--begin::توضیحات-->
                                <div class="mt-2 text-muted fs-7 p-0">با تأیید این گزینه به عاملیت / نمایندگی اجازه تغییر قیمت این محصول داده خواهد شد.</div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row d-flex justify-content-end mx-5 px-4 py-5">
                                <!--begin::Tags-->
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <label for="product_specific_geolocation">موقعیت جغرافیایی اختصاصی محصول</label>
                                    <input class="form-check-input w-45px h-30px mx-2" type="checkbox" id="product_specific_geolocation" name="product_specific_geolocation">
                                </div>
                                <!--end::Tags-->
                                <!--begin::توضیحات-->
                                <div class="mt-2 text-muted fs-7 p-0">با تأیید این گزینه موقعیت جغرافیایی به صورت اختصاصی برای این محصول اعمال خواهد شد.</div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::Input group-->
                            
                            <div class="product_specific_geolocation_body" style="display: none;">
                                <!--begin::Input group-->
                                <div class="row d-flex justify-content-end mx-5 px-4 py-5">
                                    <!--begin::Tags-->
                                    <label class="col-lg-12 col-form-label fw-semibold fs-6">
                                        موقعیت جغرافیایی محصول مورد نظر را از طریق انتخاب استان و شهر تعیین نمایید
                                    </label>
                                    <!--end::Tags-->

                                    <!--begin::Col-->
                                    <div class="row repeater-body">
                                        <div class="col-lg-10">
                                            <div class="repeater">
                                                <div data-repeatable class="my-2">
                                                    <fieldset class="row">
                                                        <!--begin::Row-->
                                                        <div class="row col-md-10">
                                                            <div class="row gutter-sm ir-select">        
                                                                <label class="col-md-2  d-flex align-items-center">استان</label>                  
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="select-box">
                                                                            <select name="product_geolocation_permission_province[]" class="ir-province form-control form-control-md"></select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <label class="col-md-2 d-flex align-items-center">شهر</label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <select name="product_geolocation_permission_city[]" class="ir-city form-control form-control-md"></select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Row-->
                                                        <div class="col-md-2 d-flex align-items-center">
                                                            <button type="button" class="btn btn-sm btn-light-danger del-repeater-btn">
                                                                حذف
                                                                <i class="bi bi-patch-minus-fill"></i>
                                                            </button>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 d-flex align-items-start mt-3">
                                            <button type="button" class="btn btn-sm btn-light-primary add-repeater-btn">
                                                افزودن
                                                <i class="bi bi-patch-plus-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row d-flex justify-content-end mx-5 px-4 py-2">
                                    <!--begin::Tags-->
                                    <label class="col-lg-12 col-form-label fw-semibold fs-6 mt-5 pt-5">
                                        موقعیت جغرافیایی محصول مورد نظر را در صورت صادرات از طریق انتخاب کشور تعیین نمایید
                                    </label>
                                    <!--end::Tags-->

                                    <select class="export-countries-dropdown form-select" name="product_geolocation_permission_export_country[]" multiple="multiple" data-control="select2" data-placeholder="انتخاب کشور" data-allow-clear="true" tabindex="-1" data-kt-initialized="1" dir="ltr">
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Åland Islands">Åland Islands</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guernsey">Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-leste">Timor-leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                                <!--end::Input group-->
                            </div>

                            <div class="form-group card-body">
                                <button type="button" class="btn btn-sm btn-success mx-1" id="list-btn-save-changes">
                                <i class="bi bi-save"></i>
                                ذخیره تغییرات
                                </button>

                                <button type="button" class="btn btn-sm btn-dark mx-1" id="list-btn-discard-changes">
                                <i class="bi bi-x-square"></i>
                                انصراف
                                </button>

                                <div class="mt-2 text-muted fs-7">با کلیک روی این دکمه می توانید مشخصات تعریف شده برای آن محصول را ذخیره نمایید.</div>
                            </div>

                            <!--end::Actions-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::کارت-->


                    <!--begin::کارت-->
                     <div class="card mb-5 mb-xl-10">
                        <!--begin::Content-->
                        <div class="collapse show">
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{route('vendor.all.representative')}}" class="btn btn-light me-3">لغو</a>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره تغییرات</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::کارت-->

                </form>
                <!--end::Form-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    </div>

    <script src="{{asset('frontend/assets/js/cityDropdown.js')}}"></script>
    <script src="{{asset('adminbackend/assets/js/vendorRepresentative.js')}}"></script>

    <script src="{{asset('frontend/assets/plugins/datatables/yelsuProductTablesVendor.js')}}"></script>

@endsection