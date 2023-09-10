@foreach ($categories as $key => $category)
    
    <!--begin::Table row Parent-->
    <tr>
        <!--begin::Checkbox-->
        <td>
            <div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1" />
            </div>
        </td>
        <!--end::Checkbox-->

        <!--begin::دسته بندی=-->
        <td>
            <div class="d-flex">
                <!--begin::Thumbnail-->
                <a href="{{route('shop.category',['id'=> $category->id])}}" class="symbol symbol-50px">
                    <span class="symbol-label" style="background-image:url({{!empty($category->category_image) ? url($category->category_image) : url(asset('storage/upload/no_image_product.jpg'))}});"></span>
                </a>
                <!--end::Thumbnail-->
                <div class="ms-5">
                    <!--begin::Title-->
                    <a href="{{route('shop.category',['id'=> $category->id])}}" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-category-filter="category_name">{{$category->category_name}}</a>
                    <!--end::Title-->
                    <!--begin::توضیحات-->
                    {{-- <div class="text-muted fs-7 fw-bold">{{($category->category_description)}}</div> --}}
                    <!--end::توضیحات-->
                </div>
            </div>
        </td>
        <!--end::دسته بندی=-->
        
        <td>
            <!--begin::Badges-->
            <div class="badge badge-light-success"><a href="">{{$category->id}}</a></div>
            <!--end::Badges-->
        </td>
        
        <!--begin::دسته بندی اصلی=-->
        <td>
            <!--begin::Badges-->
            <div class="badge badge-light-success"><a href="{{route('specialist.all.category', ['filter_id' => $category->parent])}}">{{$category->parentCategory($category->parent) ? $category->parentCategory($category->parent) : 'دسته بندی اصلی'}}</a></div>
            
            <!--end::Badges-->
        </td>
        <!--end::دسته بندی اصلی=-->
        <!--begin::عملیات=-->
        <td class="text-end">
            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">عملیات
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
            <span class="svg-icon svg-icon-5 m-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon--></a>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{route('specialist.edit.category',$category->id)}}" class="menu-link px-3">ویرایش</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{route('specialist.delete.category',$category->id)}}" class="menu-link px-3" onclick ="return confirm('آیا برای انجام این کار اطمینان دارید؟')">حذف</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{route('specialist.all.category', ['filter_id' => $category->id])}}" class="menu-link px-3">نمایش زیر دسته</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </td>
        <!--end::عملیات=-->
    </tr>
    <!--end::Table row Parent-->

    @if($category->relatedChild->count()) 
        <!--begin::Table row Children-->
        @include('specialist.category.layouts.categories-group', ['categories' => $category->relatedChild])    
        <!--end::Table row Children-->
    @endif

    
@endforeach