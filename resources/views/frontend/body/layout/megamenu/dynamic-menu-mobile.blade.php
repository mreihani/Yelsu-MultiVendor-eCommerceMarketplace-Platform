@php
    $categoryCount = $category->child->count();
@endphp

@if($categoryCount)  
    <ul>
        @foreach ($category->child as $categoryItem)
            <li>
                <a href="{{route('shop.category',['id'=> $categoryItem->id])}}">
                    {{$categoryItem->category_name}}
                </a>
                @if(count($categoryItem->child))
                    <ul>
                        @foreach ($categoryItem->child as $categoryChildItem)
                            <li>
                                <a href="{{route('shop.category',['id'=> $categoryChildItem->id])}}">
                                    {{$categoryChildItem->category_name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
@endif