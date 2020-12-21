@if ($paginator->lastPage() > 1)
<ul class="pagination">
    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a class="pointer" wire:click="gotoPage(1)">First</a>
    </li>

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="disabled"><span>&laquo;</span></li>
    @else
        <li><a class="pointer" wire:click="previousPage" >&laquo;</a></li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active pointer"><span>{{ $page }}</span></li>
                @else
                    <li><a class="pointer" wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li><a class="pointer" wire:click="nextPage" >&raquo;</a></li>
    @else
        <li class="disabled"><span>&raquo;</span></li>
    @endif

    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a class="pointer" wire:click="gotoPage({{$paginator->lastPage()}})">Last</a>
    </li>
</ul>
@endif
