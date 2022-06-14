
@if($paginator->hasPages())
   @if($paginator->onFirstPage())
        <span class="disable">
            <i class="material-icons">navigate_before</i>
        </span>
    @else
        <a href="{{ $paginator->previousPageurl() }}" class="previous-link">
            <i class="material-icons">navigate_before</i>
        </a>
    @endif
    @if($paginator->hasMorePages ())
       <a href="{{ $paginator->nextPageUrl() }}" class="next-link">
            <i class="material-icons">navigate_next</i>
        </a>
    @else
        <span class="disable link">
            <i class="material-icons">navigate_next</i>
        </span>
   @endif
@endif