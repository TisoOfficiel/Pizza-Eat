

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
        @for($i=1;$i<$paginator->lastPage()+1;$i++)
            @if($paginator->currentPage()==$i)
            
                <a href="{{$paginator->url($i)}}" class="currentPage">{{$i}}</a>
            @else 
                <a href="{{$paginator->url($i)}}">{{$i}}</a>
            @endif
        @endfor

        <a href="{{ $paginator->nextPageUrl() }}" class="next-link">
            <i class="material-icons">navigate_next</i>
        </a>
        
    @else


       @for($i=1;$i<$paginator->lastPage()+1;$i++)
            @if($paginator->currentPage()==$i)
            
                <a href="{{$paginator->url($i)}}" class="currentPage">{{$i}}</a>
            @else 
                <a href="{{$paginator->url($i)}}">{{$i}}</a>
            @endif
        @endfor

        <span class="disable link">
            <i class="material-icons">navigate_next</i>
        </span>
       
    @endif
@endif