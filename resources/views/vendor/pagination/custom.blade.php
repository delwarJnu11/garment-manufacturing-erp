@if ($paginator->hasPages())
<div class="card-body">
    <nav aria-label="Page navigation" class="pagination-style-3" style="display: flex; justify-content: end;">
        <ul class="pagination mb-0">

            {{-- Showing X to Y of Z results --}}
            <li class="page-item disabled">
                <div class="small px-3 py-2">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </div>
            </li>

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="page-item disabled" style="cursor: not-allowed;">
                <a class="page-link" href="javascript:void(0);">Prev</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Prev</a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item disabled"><a class="page-link" href="javascript:void(0);">{{ $element }}</a></li>
            @endif

            {{-- Page Number Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active">
                <a class="page-link" href="javascript:void(0);">{{ $page }}</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link text-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
            </li>
            @else
            <li class="page-item disabled" style="cursor: not-allowed;">
                <a class="page-link" href="javascript:void(0);">Next</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
@endif