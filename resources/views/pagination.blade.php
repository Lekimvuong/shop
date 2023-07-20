@if($paginator->hasPages())
<nav aria-label="">
    <ul class="pagination">
        @if($paginator->onFirstPage())
            <li class="page-item"><a class="page-link" href="javascript:;">Previous</a></li>
        @else
            <li class="page-item"><a class="page-link page-link-active" href="{{$paginator->previousPageUrl()}}">Previous</a></li>
        @endif

        @foreach($elements as $element)
            @if(is_string($element))
                <li class="page-item"><a class="page-link" href="javascript:;">{{$element}}</a></li>
            @endif

            @if(is_array($element))
                @foreach($element as $key => $page)
                    @if($key == $paginator->currentPage())
                    <li class="page-item active"><a class="page-link " aria-current="page" href="javascript:;">{{$key}}</a></li>
                    @else
                    <li class="page-item"><a class="page-link page-link-active" href="{{$page}}">{{$key}}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if($paginator->onLastPage())
            <li class="page-item"><a class="page-link" href="javascript:;">Next</a></li>
        @else
            <li class="page-item"><a class="sr-only" href="{{$paginator->nextPageUrl()}}">Next</a></li>
        @endif
    </ul>
</nav>
@endif
