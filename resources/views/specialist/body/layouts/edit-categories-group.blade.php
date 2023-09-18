@foreach ($categories as $key => $category)
   
    @if(in_array($category->id, explode(",",$attribute->category_id)))
        <li class="filterButtonShopPage list-style-none">
            @if($category->relatedChild->count()) 
                <input class="form-check-input" @checked(true) type="checkbox" name="category_id[]" value="{{$category->id}}"> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> {{$category->category_name}} {{"(".$category->relatedChild->count()." زیر دسته)"}}
            @else
                <input class="form-check-input" @checked(true) type="checkbox" name="category_id[]" value="{{$category->id}}"> {{$category->category_name}} 
            @endif
        </li>
    @else
        <li class="filterButtonShopPage list-style-none">
            @if($category->relatedChild->count()) 
                <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category->id}}"> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> {{$category->category_name}} {{"(".$category->relatedChild->count()." زیر دسته)"}}
            @else
                <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category->id}}"> {{$category->category_name}} 
            @endif
        </li>
    @endif

    @if($category->relatedChild->count()) 
    <!--begin::Table row Children-->
    <div class="mb-1" style="margin-right: 30px;">
        @include('specialist.body.layouts.edit-categories-group', ['categories' => $category->child])  
    </div>
    <!--end::Table row Children-->
    @endif
    
@endforeach

