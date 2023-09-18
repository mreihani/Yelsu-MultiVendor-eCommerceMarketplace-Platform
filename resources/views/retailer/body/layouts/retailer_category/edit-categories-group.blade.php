@foreach ($categories as $key => $category)
   
    @if(in_array($category->id, $retailer_sector_cat_arr_selected))
        <li class="filterButtonShopPage list-style-none">
            @if($category->relatedChild->count()) 
                <input @checked(true) type="checkbox" name="vendor_sector[]" value="{{$category->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category->category_name}} {{"(".$category->relatedChild->count()." زیر دسته)"}}
            @else
                <input @checked(true) type="checkbox" name="vendor_sector[]" value="{{$category->id}}"> {{$category->category_name}} 
            @endif
        </li>
    @else
        <li class="filterButtonShopPage list-style-none">
            @if($category->relatedChild->count()) 
                <input type="checkbox" name="vendor_sector[]" value="{{$category->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category->category_name}} {{"(".$category->relatedChild->count()." زیر دسته)"}}
            @else
                <input type="checkbox" name="vendor_sector[]" value="{{$category->id}}"> {{$category->category_name}} 
            @endif
        </li>
    @endif

    @if($category->relatedChild->count()) 
    <!--begin::Table row Children-->
    <div class="mb-1 subCatGroup" style="margin-right: 30px;">
        @include('retailer.body.layouts.retailer_category.edit-categories-group', ['categories' => $category->child])  
    </div>
    <!--end::Table row Children-->
    @endif
    
@endforeach

