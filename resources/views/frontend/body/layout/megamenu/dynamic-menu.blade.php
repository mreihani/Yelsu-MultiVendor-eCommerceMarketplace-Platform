@php
    $categoryCount = $category->child->count();

    $chunkIterationNumber = 1;
    while (true) {
        if ($categoryCount < 4 * $chunkIterationNumber) break;
        $chunkIterationNumber++;
    }
@endphp

@if($categoryCount)  
    <ul class="megamenu">
        @foreach ($category->child->chunk($chunkIterationNumber) as $key => $categoryChunkItem)
            <li>
                @foreach ($categoryChunkItem->load('child') as $categoryChildItem)
                    <h4 class="menu-title">
                        <img src="{{!empty($categoryChildItem->category_image) ? asset($categoryChildItem->category_image) : 
                        asset('storage/upload/no_image.jpg') }}" alt="{{$categoryChildItem->category_image}}" width="40" height="40"
                        style="border-radius: 50%; border: 1px solid #dddddd;">
                        <a href="{{route('shop.category',['id'=> $categoryChildItem->id])}}">
                            {{$categoryChildItem->category_name}}
                        </a>
                    </h4>
                    <hr class="divider">
                    <ul>
                        @foreach ($categoryChildItem->child as $categoryChild)
                            <li>
                                <a href="{{route('shop.category',['id'=> $categoryChild->id])}}">
                                    {{$categoryChild->category_name}}
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

