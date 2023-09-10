@foreach ($categories as $key => $category)
    
    <li class="filterButtonShopPage list-style-none">
        @if($category->relatedChild->count()) 
            <input type="checkbox" name="category_{{$category->id}}" value="{{$category->id}}" {{in_array($category->id, $inputArray) ? 'checked' : ''}}> <i class="fa fa-plus" style="display: none;"></i><i class="fa fa-minus"></i> {{$category->category_name}} {{"(".$category->relatedChild->count()." زیر دسته)"}}
        @else
            <input type="checkbox" name="category_{{$category->id}}" value="{{$category->id}}" {{in_array($category->id, $inputArray) ? 'checked' : ''}}> {{$category->category_name}} 
        @endif
    </li>

    @if($category->relatedChild->count()) 
        <!--begin::Table row Children-->
        <div class="mb-1" style="margin-right: 30px;">
            @include('frontend.body.layout.shop-page-filter.categories-group', ['categories' => $category->child])    
        </div>
        <!--end::Table row Children-->
    @endif
    
@endforeach