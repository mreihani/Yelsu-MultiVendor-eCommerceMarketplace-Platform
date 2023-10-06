@foreach ($categories as $key => $category)
    
    @if(in_array($category->id, $vendorSectorArr))
        <li class="filterButtonShopPage list-style-none">
            @if($category->relatedChild->count()) 
                <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category->category_name}} 
            @else
                <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category->id}}"> {{$category->category_name}} 
            @endif
        </li>

        @if($category->relatedChild->count()) 
            <!--begin::Table row Children-->
            <div class="mb-1 subCatGroup" style="margin-right: 30px;">
                @include('vendor.body.layouts.vendor_outlets.categories-group', ['categories' => $category->child])    
            </div>
            <!--end::Table row Children-->
        @endif
    @endif

@endforeach