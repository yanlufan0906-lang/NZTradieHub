@if ($paginator->hasPages())
    @php
        $visiblePageCount = 5;
        $halfWindow = intdiv($visiblePageCount, 2);
        $firstVisiblePage = max(1, $paginator->currentPage() - $halfWindow);
        $lastVisiblePage = min($paginator->lastPage(), $firstVisiblePage + $visiblePageCount - 1);
        $firstVisiblePage = max(1, $lastVisiblePage - $visiblePageCount + 1);
    @endphp

    <nav class="directory-pagination" aria-label="Business directory pages">
        <p class="directory-pagination__summary">
            Showing <strong>{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}</strong>
            of <strong>{{ $paginator->total() }}</strong> businesses
        </p>

        <div class="directory-pagination__controls">
            @if ($paginator->onFirstPage())
                <span class="directory-pagination__button directory-pagination__button--disabled" aria-disabled="true">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                    Previous
                </span>
            @else
                <a class="directory-pagination__button" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                    Previous
                </a>
            @endif

            <div class="directory-pagination__pages" aria-label="Page numbers">
                @for ($page = $firstVisiblePage; $page <= $lastVisiblePage; $page++)
                    @if ($page === $paginator->currentPage())
                        <span class="directory-pagination__page directory-pagination__page--active" aria-current="page" aria-label="Current page, page {{ $page }}">
                            {{ $page }}
                        </span>
                    @else
                        <a class="directory-pagination__page" href="{{ $paginator->url($page) }}" aria-label="Go to page {{ $page }}">
                            {{ $page }}
                        </a>
                    @endif
                @endfor
            </div>

            @if ($paginator->hasMorePages())
                <a class="directory-pagination__button" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    Next
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
            @else
                <span class="directory-pagination__button directory-pagination__button--disabled" aria-disabled="true">
                    Next
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </span>
            @endif
        </div>

        <form class="directory-pagination__jump" method="GET" action="{{ $paginator->path() }}" data-page-jump>
            @foreach (($paginator->getOptions()['query'] ?? []) as $name => $value)
                @if (is_scalar($value))
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                @endif
            @endforeach

            <label for="directory-page-jump">Go to page</label>
            <input
                id="directory-page-jump"
                type="number"
                name="{{ $paginator->getPageName() }}"
                min="1"
                max="{{ $paginator->lastPage() }}"
                placeholder="{{ $paginator->currentPage() }}"
                inputmode="numeric"
                autocomplete="off"
                aria-describedby="directory-page-total"
                required
            >
            <span id="directory-page-total">of {{ $paginator->lastPage() }}</span>
            <button type="submit">Go</button>
        </form>
    </nav>
@endif
