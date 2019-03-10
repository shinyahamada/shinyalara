@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true"><span>前へ</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">前へ</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">次へ</a></li>
        @else
            <li class="disabled" aria-disabled="true"><span>次へ</span></li>
        @endif
    </ul>
@endif
