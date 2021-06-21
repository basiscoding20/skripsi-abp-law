@php
    $per_page = env('PAGINATION') ?? 10;
@endphp
<div class="row">
    <div class="col-md-4 col-12">
        @if($paginator->total() > 0 )
        <p class="" style="margin:10px"> Tampil
            <strong>{{ (($paginator->currentPage() - 1) * $per_page) + 1 }}</strong> sampai
            <strong>{{ $per_page * $paginator->currentPage() > $paginator->total()? $paginator->total() : $per_page * $paginator->currentPage() }}</strong> dari
            <strong><span class="text-primary">{{ $paginator->total() }}</span></strong>
            data
        </p>
        @endif
    </div>
    <div class="col-md-8 col-12">
        @if ($paginator->hasPages())
        <nav>
            <ul class="pagination justify-content-end">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <a class="page-link" aria-hidden="true">&laquo;</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><a class="page-link">{{ $element }}</a></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <a class="page-link" aria-hidden="true">&raquo;</a>
                    </li>
                @endif
            </ul>
        </nav>
        @endif  
    </div>  
</div>    