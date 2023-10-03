@foreach ($categories as $key => $category)
    
    <li class="filterButtonShopPage list-style-none">
        @if($category->relatedChild->count()) 
            <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$category->category_name}} {{"(".$category->relatedChild->count()." زیر دسته)"}}
        @else
            <input {{old('category_id') == $category->id ? 'checked' : ''}} class="form-check-input" type="checkbox" name="category_id" value="{{$category->id}}"> <span>{{$category->category_name}}</span> 
        @endif
    </li>

    @if($category->relatedChild->count()) 
        <!--begin::Table row Children-->
        <div class="mb-1 subCatGroup" style="margin-right: 30px;">
            @include('admin.body.layouts.admin_attributes.categories-group', ['categories' => $category->child])    
        </div>
        <!--end::Table row Children-->
    @endif
    
@endforeach