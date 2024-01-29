<style>
    .megamenu {
        height: 650px;
        overflow: auto;
        border-top: 2px solid #d2d2d2;
        border-bottom: 2px solid #d2d2d2;
        z-index: 100000 !important;
    }
    .megamenu::-webkit-scrollbar {
        width: 3px;
    }
    .megamenu::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px rgb(192, 192, 192);
    }
    .megamenu::-webkit-scrollbar-thumb {
        background-color: #0165d5;
    }
</style>

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
        @foreach ($category->child->chunk($chunkIterationNumber) as $categoryChunkItem)
            <li>
                @foreach ($categoryChunkItem as $categoryChildItem)
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
    </ul>  
@endif