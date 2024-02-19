@if(count($child))
    <ul class="megamenu">
        @foreach ($child as $categoryChunkItem)
            <li>
                @foreach($categoryChunkItem['child'] as $categoryChildItem)
                    <h4 class="menu-title">
                        <img src="{{$categoryChildItem['img_src']}}" alt="{{$categoryChildItem['category_name']}}" width="40" height="40"
                        style="border-radius: 50%; border: 1px solid #dddddd;">
                        <a href="{{route('shop.category',['id'=> $categoryChildItem['category_id']])}}">
                            {{$categoryChildItem['category_name']}}
                        </a>
                    </h4>
                    <hr class="divider">
                    <ul>
                        @foreach ($categoryChildItem['child'] as $categoryChild)
                            <li>
                                <a href="{{route('shop.category', ['id'=> $categoryChild['category_id']])}}">
                                    {{$categoryChild['category_name']}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </li>
        @endforeach
            <li>
                <div class="banner-fixed menu-banner menu-banner2">
                    <figure>
                    </figure>
                    <div class="banner-content">
                    </div>
                </div>
            </li>
    </ul> 
@endif

    
