@foreach ($categories as $key => $category)
   
    @if(in_array($category->id, $category_sector_cat_arr_selected))
        <li class="filterButtonShopPage list-style-none">
            @if($category->relatedChild->count()) 
                <input class="form-check-input" @checked(true) type="checkbox" name="category_id[]" value="{{$category->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category->category_name}} {{"(".$category->relatedChild->count()." زیر دسته)"}}
            @else
                <input class="form-check-input" @checked(true) type="checkbox" name="category_id[]" value="{{$category->id}}"> {{$category->category_name}} 
            @endif
        </li>
    @else
        <li class="filterButtonShopPage list-style-none">
            @if($category->relatedChild->count()) 
                <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category->category_name}} {{"(".$category->relatedChild->count()." زیر دسته)"}}
            @else
                <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category->id}}"> {{$category->category_name}} 
            @endif
        </li>
    @endif

    @if($category->relatedChild->count()) 
    <!--begin::Table row Children-->
    <div class="mb-1 subCatGroup" style="margin-right: 30px;">
        {{-- <div class="subCategoryBtn"> --}}
            @include('freightage.layouts.edit-categories-group', ['categories' => $category->child])  
        {{-- </div> --}}
    </div>
    <!--end::Table row Children-->
    @endif
    
@endforeach

