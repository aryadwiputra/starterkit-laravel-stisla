@if($paginator->hasPages())
<nav class="pagination" role="navigation" aria-label="Pagination">
    @if($paginator->onFirstPage())
    <span class="pagination__item pagination__item--prev pagination__item--disabled">Prev</span>
    @else
    <a class="pagination__item pagination__item--prev" href="{{ $paginator->previousPageUrl() }}" rel="prev">Prev</a>
    @endif

    @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
    @if($page === $paginator->currentPage())
    <span class="pagination__item active">{{ $page }}</span>
    @else
    <a class="pagination__item" href="{{ $url }}">{{ $page }}</a>
    @endif
    @endforeach

    @if($paginator->hasMorePages())
    <a class="pagination__item pagination__item--next" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
    @else
    <span class="pagination__item pagination__item--next pagination__item--disabled">Next</span>
    @endif
</nav>
@endif
