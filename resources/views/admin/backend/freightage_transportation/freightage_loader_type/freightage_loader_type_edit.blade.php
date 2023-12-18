@extends('admin.admin_dashboard')
@section('admin')


<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">افزودن نوع بارگیر</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">خانه</a>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">مدیریت حمل و نقل کالا</li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::آیتم-->
                        <!--begin::آیتم-->
                        <li class="breadcrumb-item text-muted">افزودن نوع بارگیر</li>
                        <!--end::آیتم-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            @foreach($errors->all() as $error)
                <div  class="alert alert-icon alert-warning alert-bg alert-inline show-code-action me-5 ms-5">
                    <h4 class="alert-title" style="color:#ffa800">
                        <i class="w-icon-exclamation-triangle"></i>هشدار!</h4>
                        {{$error}}
                </div>
            @endforeach
            
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl col-xl-8">
                <form method="post" action="{{route('admin.update.freightage-loader-type')}}" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
                    @csrf
                  
                    <input type="hidden" name="id" value="{{$freightageLoadertype->id}}">

                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::عمومی options-->
                        <div class="card card-flush py-4">
                           
                            <!--begin::کارت body-->
                            <div class="card-body pt-0">
                                
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Tags-->
                                    <label class="required form-label">عنوان بارگیر</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <input type="text" name="value" class="form-control mb-2" placeholder="عنوان بارگیر را وارد نمایید" value="{{old('value', $freightageLoadertype->value)}}" />
                                    <!--end::Input-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fs-7">عنوان بارگیر را وارد نمایید.</div>
                                    <!--end::توضیحات-->
                                </div>

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Tags-->
                                    <label class="required form-label">عنوان کامل</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <input type="text" name="description" class="form-control mb-2" placeholder="به عنوان مثال: تریلی - تریلی تانکر - حمل شیشه" value="{{old('description', $freightageLoadertype->description)}}" />
                                    <!--end::Input-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fs-7">باید عنوان کامل آخرین سر دسته از اولین تا آخرین آیتم نوشته شود.</div>
                                    <!--end::توضیحات-->
                                </div>

                                <div class="mb-10 fv-row" id="freightagetype_selection">
                                    <!--begin::Tags-->
                                    <label class="form-label">تعیین روش ارسال </label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <select class="js-example-basic-single form-control" name="freightagetype_id">
                                        @foreach ($freightage_types as $freightage_type)
                                            <option {{$freightageLoadertype->freightagetype_id == $freightage_type->id ? "selected" : ""}} value="{{$freightage_type->id}}" freightagetype_title="{{$freightage_type->freightagetype_title}}">{{$freightage_type->value}}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fs-7 mt-2">از گزینه های بالا یک روش ارسال به نوع بارگیر مورد نظر باید نسبت داده شود.</div>
                                    <!--end::توضیحات-->
                                </div>
                                <!--end::Input group-->

                                <div class="mb-10 fv-row" id="freightageloadertype_selection">
                                    <!--begin::Tags-->
                                    <label class="form-label">تعیین بارگیر والد</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <select class="js-example-basic-single form-control" name="parent">
                                            <option value="0" {{$freightageLoadertype->parent == 0 ? "selected" : ""}}>بارگیر والد</option>
                                            @foreach ($freightage_loader_types as $freightage_loader_type_item)

                                                @if($freightageLoadertype->id == $freightage_loader_type_item->id) @continue @endif

                                                <option {{$freightageLoadertype->parent == $freightage_loader_type_item->id ? "selected" : ""}} value="{{$freightage_loader_type_item->id}}">{{$freightage_loader_type_item->description}}</option>
                                            @endforeach
                                        </select>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                 <div class="mb-10 fv-row">
                                    <!--begin::Tags-->
                                    <label class="form-label">لینک مقاله</label>
                                    <!--end::Tags-->
                                    <!--begin::Input-->
                                    <input type="text" name="blog_link" class="form-control mb-2" placeholder="آدرس مقاله" value="{{old('blog_link', $freightageLoadertype->blog_link)}}" />
                                    <!--end::Input-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fs-7">در صورتی که مقاله ای در این مورد وجود دارد برای لینک کردن آدرس آن را وارد نمایید</div>
                                    <!--end::توضیحات-->
                                </div>

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Tags-->
                                    <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                        <label style="margin-left:10px;" for="lastChild">آخرین فرزند</label>
                                        <input class="form-check-input w-45px h-30px mr-3 ml-3" type="checkbox" id="lastChild" name="last_child" {{$freightageLoadertype->last_child == 1 ? "checked" : ""}} >
                                    </div>
                                    <!--end::Tags-->
                                    <!--begin::توضیحات-->
                                    <div class="text-muted fs-7 mt-3">اگر بارگیر مورد نظر آخرین آیتم یک مجموعه است این گزینه را فعال نمایید.</div>
                                    <!--end::توضیحات-->
                                </div>

                                <div class="last-child d-none">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="form-label">حداقل ظرفیت (کیلوگرم)</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="number" step="0.01" name="min_capacity" class="form-control mb-2" placeholder="" value="{{old('min_capacity', $freightageLoadertype->min_capacity)}}" />
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">حداقل ظرفیت بارگیر را به کیلوگرم وارد نمایید</div>
                                        <!--end::توضیحات-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="form-label">حداکثر ظرفیت (کیلوگرم)</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="number" step="0.01" name="max_capacity" class="form-control mb-2" placeholder="" value="{{old('max_capacity', $freightageLoadertype->max_capacity)}}" />
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">حداکثر ظرفیت بارگیر را به کیلوگرم وارد نمایید</div>
                                        <!--end::توضیحات-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="form-label">طول بارگیر (متر)</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="number" step="0.01" name="length" class="form-control mb-2" placeholder="" value="{{old('length', $freightageLoadertype->length)}}" />
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">طول بارگیر را به تن وارد نمایید</div>
                                        <!--end::توضیحات-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="form-label">عرض بارگیر (متر)</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="number" step="0.01" name="width" class="form-control mb-2" placeholder="" value="{{old('width', $freightageLoadertype->width)}}" />
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">عرض بارگیر را به تن وارد نمایید</div>
                                        <!--end::توضیحات-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="form-label">ارتفاع بارگیر (متر)</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="number" step="0.01" name="height" class="form-control mb-2" placeholder="" value="{{old('height', $freightageLoadertype->height)}}" />
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">ارتفاع بارگیر را به تن وارد نمایید</div>
                                        <!--end::توضیحات-->
                                    </div>
                                    
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="form-label">حداقل حجم (متر مکعب)</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="number" step="0.01" name="min_volume" class="form-control mb-2" placeholder="" value="{{old('min_volume', $freightageLoadertype->min_volume)}}" />
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">حداقل ظرفیت حجمی بارگیر را به متر مکعب وارد نمایید</div>
                                        <!--end::توضیحات-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="form-label">حداکثر حجم (متر مکعب)</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <input type="number" step="0.01" name="max_volume" class="form-control mb-2" placeholder="" value="{{old('max_volume', $freightageLoadertype->max_volume)}}" />
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7">حداکثر ظرفیت حجمی بارگیر را به متر مکعب وارد نمایید</div>
                                        <!--end::توضیحات-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Tags-->
                                        <label class="form-label">تعیین واحد پولی کرایه حمل</label>
                                        <!--end::Tags-->
                                        <!--begin::Input-->
                                        <select class="form-control" name="freight_per_ton_currency">
                                            <option {{$freightageLoadertype->freight_per_ton_currency == "toman" ? "selected" : ""}} value="toman">تومان</option>
                                            <option {{$freightageLoadertype->freight_per_ton_currency == "dollar" ? "selected" : ""}} value="dollar">دلار</option>
                                            <option {{$freightageLoadertype->freight_per_ton_currency == "euro" ? "selected" : ""}} value="euro">یورو</option>
                                        </select>
                                        <!--end::Input-->
                                        <!--begin::توضیحات-->
                                        <div class="text-muted fs-7 mt-2">واحد پولی کرایه حمل را تعیین نمایید.</div>
                                        <!--end::توضیحات-->
                                    </div>
                                    <!--end::Input group-->

                                    <div class="road-loader d-none">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Tags-->
                                            <label class="form-label">کرایه حمل هر تن بر کیلومتر داخل شهری</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input type="number" step="0.01" name="freight_per_ton_intracity" class="form-control mb-2" placeholder="" value="{{old('freight_per_ton_intracity', $freightageLoadertype->freight_per_ton_intracity)}}" />
                                            <!--end::Input-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">کرایه حمل هر تن بر کیلومتر داخل شهری بارگیر را وارد نمایید</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Tags-->
                                            <label class="form-label">کرایه حمل هر تن بر کیلومتر بین شهری</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input type="number" step="0.01" name="freight_per_ton_intercity" class="form-control mb-2" placeholder="" value="{{old('freight_per_ton_intercity', $freightageLoadertype->freight_per_ton_intercity)}}" />
                                            <!--end::Input-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">کرایه حمل هر تن بر کیلومتر بین شهری بارگیر را وارد نمایید</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>

                                    <div class="rail-loader d-none">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Tags-->
                                            <label class="form-label">کرایه حمل هر تن بر کیلومتر حمل ریلی</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input type="number" step="0.01" name="freight_per_ton_rail" class="form-control mb-2" placeholder="" value="{{old('freight_per_ton_rail', $freightageLoadertype->freight_per_ton_rail)}}" />
                                            <!--end::Input-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">کرایه حمل هر تن بر کیلومتر حمل ریلی را وارد نمایید</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Tags-->
                                            <label class="form-label">هزینه ترخیص هر تن کالا از طریق حمل ریلی</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input type="number" step="0.01" name="clearance_per_ton_rail" class="form-control mb-2" placeholder="" value="{{old('clearance_per_ton_rail', $freightageLoadertype->clearance_per_ton_rail)}}" />
                                            <!--end::Input-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">هزینه ترخیص هر تن کالا در حمل ریلی را وارد نمایید</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>

                                    <div class="sea-loader d-none">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Tags-->
                                            <label class="form-label">کرایه حمل هر تن بر مایل از طریق حمل دریایی</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input type="number" step="0.01" name="freight_per_ton_sea" class="form-control mb-2" placeholder="" value="{{old('freight_per_ton_sea', $freightageLoadertype->freight_per_ton_sea)}}" />
                                            <!--end::Input-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">کرایه حمل هر تن بر مایل از طریق حمل دریایی را وارد نمایید</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Tags-->
                                            <label class="form-label">هزینه ترخیص هر تن کالا از طریق حمل دریایی</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input type="number" step="0.01" name="clearance_per_ton_sea" class="form-control mb-2" placeholder="" value="{{old('clearance_per_ton_sea', $freightageLoadertype->clearance_per_ton_sea)}}" />
                                            <!--end::Input-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">هزینه ترخیص هر تن کالا در حمل دریایی را وارد نمایید</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>

                                    <div class="air-loader d-none">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Tags-->
                                            <label class="form-label">کرایه حمل هر کیلوگرم بر کیلومتر</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input type="number" step="0.01" name="freight_per_kg_air" class="form-control mb-2" placeholder="" value="{{old('freight_per_kg_air', $freightageLoadertype->freight_per_kg_air)}}" />
                                            <!--end::Input-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">کرایه حمل هر کیلوگرم بر کیلومتر حمل هوایی را وارد نمایید</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Tags-->
                                            <label class="form-label">هزینه ترخیص هر کیلوگرم کالا از طریق حمل هوایی</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input type="number" step="0.01" name="clearance_per_kg_air" class="form-control mb-2" placeholder="" value="{{old('clearance_per_kg_air', $freightageLoadertype->clearance_per_kg_air)}}" />
                                            <!--end::Input-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">هزینه ترخیص هر کیلوگرم کالا در حمل هوایی را وارد نمایید</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>

                                    <div class="post-loader d-none">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Tags-->
                                            <label class="form-label">کرایه حمل هر کیلوگرم بر کیلومتر حمل پستی</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input type="number" step="0.01" name="freight_per_kg_post" class="form-control mb-2" placeholder="" value="{{old('freight_per_kg_post', $freightageLoadertype->freight_per_kg_post)}}" />
                                            <!--end::Input-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">کرایه حمل هر کیلوگرم بر کیلومتر حمل پستی را وارد نمایید</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Tags-->
                                            <label class="form-label">هزینه ترخیص هر کیلوگرم کالا از طریق حمل پستی</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input type="number" step="0.01" name="clearance_per_kg_post" class="form-control mb-2" placeholder="" value="{{old('clearance_per_kg_post', $freightageLoadertype->clearance_per_kg_post)}}" />
                                            <!--end::Input-->
                                            <!--begin::توضیحات-->
                                            <div class="text-muted fs-7">هزینه ترخیص هر کیلوگرم کالا در حمل پستی را وارد نمایید</div>
                                            <!--end::توضیحات-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    
                                </div>

                            </div>
                            <!--end::کارت header-->
                        </div>
                        <!--end::عمومی options-->
                        
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('admin.all.freightage-loader-type')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">انصراف</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">ذخیره تغییرات</span>
                                <span class="indicator-progress">لطفا صبر کنید...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
            
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
        
    </div>
    <!--end::Content wrapper-->
   
</div>
<!--end:::Main-->

<script src="{{asset('adminbackend/assets/js/loadFreightageLoaderTypeAllAjax.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/loadFreightageLoaderTypeLastChildBtn.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/loadFreightageLoaderTypes.js')}}"></script>

@endsection