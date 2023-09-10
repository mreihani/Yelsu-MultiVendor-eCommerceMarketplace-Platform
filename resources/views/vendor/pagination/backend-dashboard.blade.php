@if ($paginator->hasPages())
    <ul class="pagination d-flex justify-content-center align-items-center pb-2">

        @if ($paginator->onFirstPage())
        <li class="paginate_button page-item previous disabled" id="kt_ecommerce_category_table_previous"><a href="#" aria-controls="kt_ecommerce_category_table" data-dt-idx="0" tabindex="0" class="page-link"><i class="previous"></i></a></li>
        @else
            
            <li class="paginate_button page-item previous" id="kt_ecommerce_category_table_previous"><a href="{{ $paginator->previousPageUrl() }}" aria-controls="kt_ecommerce_category_table" data-dt-idx="0" tabindex="0" class="page-link"><i class="previous"></i></a></li>
        @endif

        @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="paginate_button page-item active"><a href="{{ $url }}" aria-controls="kt_ecommerce_category_table" data-dt-idx="{{ $page }}" tabindex="0" class="page-link">{{ $page }}</a></li>
                        @else
                            <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="paginate_button page-item next" id="kt_ecommerce_category_table_next"><a href="{{ $paginator->nextPageUrl() }}" aria-controls="kt_ecommerce_category_table" data-dt-idx="4" tabindex="0" class="page-link"><i class="next"></i></a></li>
            @else
                <li class="paginate_button page-item next disabled" id="kt_ecommerce_category_table_next"><a href="#" aria-controls="kt_ecommerce_category_table" data-dt-idx="4" tabindex="0" class="page-link"><i class="next"></i></a></li>
            @endif
    </ul>
@endif