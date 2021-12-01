@if ($paginator->hasPages())
    <nav class="py-2 flex justify-end">
        <ul class="flex rounded font-medium">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="py-1 px-3 border  border-gray-300 disabled disabled:opacity-50" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="py-1 px-3 border border-gray-300">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="py-1 px-3 disabled border border-gray-300" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="py-1 px-3 active border border-gray-300" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="py-1 px-3 border border-gray-300"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="py-1 px-3 border border-gray-300">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="py-1 px-3 border border-gray-300 disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
