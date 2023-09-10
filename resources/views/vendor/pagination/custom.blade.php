@if ($paginator->hasPages())
    <ul class="pagination justify-content-center pb-2">

        @if ($paginator->onFirstPage())
            <li class="disabled prev disabled" aria-disabled="true" aria-label="قبلی">
                <a href="#" aria-label="قبلی" tabindex="-1" aria-disabled="true">
                    <i class="w-icon-long-arrow-right"></i>قبلی
                </a>
            </li>
        @else
            <li class="prev">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="قبلی" tabindex="-1" aria-disabled="true"><i class="w-icon-long-arrow-right"></i>قبلی</a>
            </li>
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
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @else
                            <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="next">
                    <a  href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="بعدی">بعدی <i class="w-icon-long-arrow-left"></i></a>
                </li>
            @else
                <li class="next disabled" aria-disabled="true" aria-label="بعدی">
                    <span aria-hidden="true"><a href="#" aria-label="بعدی">
                        بعدی <i class="w-icon-long-arrow-left"></i>
                        </a></span>
                </li>
            @endif
    </ul>
@endif