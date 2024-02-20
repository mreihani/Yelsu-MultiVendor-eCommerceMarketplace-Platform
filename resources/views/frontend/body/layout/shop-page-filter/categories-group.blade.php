@foreach ($categories as $key => $category)
    
    <li class="filterButtonShopPage list-style-none">
        @if(count($category['child'])) 
            <input type="checkbox" name="category_{{$category['category_id']}}" value="{{$category['category_id']}}"
             {{in_array($category['category_id'], $inputArray) ? 'checked' : ''}}>
             <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i>
             {{$category['category_name']}} {{"(".count($category['child'])." زیر دسته)"}}
        @else
            <input type="checkbox" name="category_{{$category['category_id']}}" value="{{$category['category_id']}}" {{in_array($category['category_id'], $inputArray) ? 'checked' : ''}}> {{$category['category_name']}} 
        @endif
    </li>

    @if(count($category['child'])) 
        <!--begin::Table row Children-->
        <div class="mb-1 subCatGroup" style="margin-right: 30px;">
            @include('frontend.body.layout.shop-page-filter.categories-group', ['categories' => $category['child']])    
        </div>
        <!--end::Table row Children-->
    @endif
    
@endforeach