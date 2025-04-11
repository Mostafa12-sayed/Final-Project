@if ($elementPaginate->hasPages())
<nav aria-label="Page navigation example" class="mt-3 text-center d-flex justify-content-center">
    <ul class="pagination pagination-rounded">

        {{-- Previous Page Link --}}
        @if ($elementPaginate->onFirstPage())
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $elementPaginate->previousPageUrl() }}">Previous</a></li>
        @endif

        @foreach ($elementPaginate->links()->elements as $element)
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $elementPaginate->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($elementPaginate->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $elementPaginate->nextPageUrl() }}">Next</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
        @endif

    </ul>
</nav>
@endif