<ul>
    @foreach ($child as $childItem)
            <li>
                <a href="{{route('shop.category', ['id'=> $childItem['category_id']])}}">
                    {{$childItem['category_name']}}
                </a>
                
                @if(count($childItem['child']))
                    <ul>
                        @foreach ($childItem['child'] as $categoryChildLoop)
                            <li>
                                <a href="{{route('shop.category',['id'=> $categoryChildLoop['category_id']])}}">
                                    {{$categoryChildLoop['category_name']}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
    @endforeach
</ul>
