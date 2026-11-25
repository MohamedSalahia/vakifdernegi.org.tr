@if ($paginator->hasPages())
    <ul>
        @if ($paginator->hasMorePages())
            <li><a href="javascript:;"><span class="flaticon-arrow-1"></span></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}"><span class="flaticon-arrow-1"></span></a></li>
        @endif
        @foreach ($elements as $element)

            @if (is_string($element))
                <li><a href="javascript:;">{{ $element }}</a></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a href="javascript:;">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->onFirstPage())
            <li><a href="{{ $paginator->nextPageUrl() }}"><span class="flaticon-arrow-1"></span></a></li>
        @else
            <li><a href="javascript:;"><span class="flaticon-arrow-1"></span></a></li>
        @endif
    </ul>
@endif
