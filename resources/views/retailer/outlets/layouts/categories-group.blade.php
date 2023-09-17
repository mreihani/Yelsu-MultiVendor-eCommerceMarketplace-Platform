@foreach ($categories as $key => $category)
    
    <li class="filterButtonShopPage list-style-none">
        @if($category->relatedChild->count()) 
            <input type="checkbox" name="category_id[]" value="{{$category->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category->category_name}} {{"(".$category->relatedChild->count()." زیر دسته)"}}
        @else
            <input type="checkbox" name="category_id[]" value="{{$category->id}}"> {{$category->category_name}} 
        @endif
    </li>

    @if($category->relatedChild->count()) 
        <!--begin::Table row Children-->
        <div class="mb-1 subCatGroup" style="margin-right: 30px;">
            @include('retailer.outlets.layouts.categories-group', ['categories' => $category->child])    
        </div>
        <!--end::Table row Children-->
    @endif
    
@endforeach