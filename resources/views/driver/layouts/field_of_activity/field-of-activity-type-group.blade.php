@foreach ($items as $item)

    @if(in_array($item->id, $driver_sector_arr))
        <li class="filterButtonShopPage list-style-none">
            @if(count($item->getChildren())) 
                <input @checked(true) class="form-check-input" type="checkbox" name="type[]" value="{{$item->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$item->value}} 
            @else
                <input @checked(true) class="form-check-input" type="checkbox" name="type[]" value="{{$item->id}}"> {{$item->value}} 
            @endif
        </li>
    @else
        <li class="filterButtonShopPage list-style-none">
            @if(count($item->getChildren())) 
                <input class="form-check-input" type="checkbox" name="type[]" value="{{$item->id}}"> <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none;"></i> {{$item->value}} 
            @else
                <input class="form-check-input" type="checkbox" name="type[]" value="{{$item->id}}"> {{$item->value}} 
            @endif
        </li>
    @endif

    @if(count($item->getChildren())) 
        <!--begin::Table row Children-->
        <div class="mb-1 subCatGroup" style="margin-right: 30px;">
            @include('driver.layouts.field_of_activity.field-of-activity-type-group', ['items' => $item->getChildren()])  
        </div>
        <!--end::Table row Children-->
    @endif
    
@endforeach
