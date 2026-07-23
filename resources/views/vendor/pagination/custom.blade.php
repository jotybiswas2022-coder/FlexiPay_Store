@if ($paginator->hasPages())
    <nav>
        <ul class="fp-pagination">
            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <li class="fp-page-item disabled" aria-disabled="true">
                    <span class="fp-page-link"><i class="bi bi-chevron-left"></i></span>
                </li>
            @else
                <li class="fp-page-item">
                    <a class="fp-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="fp-page-item disabled" aria-disabled="true">
                        <span class="fp-page-link fp-page-dots">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="fp-page-item active" aria-current="page">
                                <span class="fp-page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="fp-page-item">
                                <a class="fp-page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <li class="fp-page-item">
                    <a class="fp-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="fp-page-item disabled" aria-disabled="true">
                    <span class="fp-page-link"><i class="bi bi-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
.fp-pagination {
    display: flex; align-items: center; justify-content: center;
    gap: 6px; list-style: none; padding: 0; margin: 0; flex-wrap: wrap;
}
.fp-page-item { margin: 0; }
.fp-page-link {
    display: flex; align-items: center; justify-content: center;
    min-width: 38px; height: 38px;
    padding: 0 12px;
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: 10px;
    color: var(--text-muted);
    font-size: 13px; font-weight: 600;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    font-family: 'Space Grotesk', sans-serif;
}
.fp-page-link:hover {
    background: rgba(234,179,8,0.08);
    border-color: rgba(234,179,8,0.25);
    color: var(--gold-400);
    transform: translateY(-2px);
}
.fp-page-item.active .fp-page-link {
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    border-color: var(--gold-500);
    color: var(--near-black);
    font-weight: 700;
    box-shadow: 0 4px 16px rgba(234,179,8,0.2);
}
.fp-page-item.disabled .fp-page-link {
    opacity: 0.3; cursor: default;
    transform: none !important;
}
.fp-page-dots { border: none; background: transparent; min-width: 20px; }

@media (max-width: 576px) {
    .fp-page-link {
        min-width: 34px; height: 34px;
        padding: 0 8px; font-size: 12px;
        border-radius: 8px;
    }
}
</style>
