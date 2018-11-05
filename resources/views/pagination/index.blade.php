<ul class="pagination pagination-sm pagination-responsive">
    @if($total_page >= 3)
        <li><a href="#" class="first {{$current_page != 1 ? "" : "disabled"}}" value="1">First</a></li>
        <li><a href="#" class="previous {{$current_page != 1 ? "" : "disabled"}}"
               value="{{$current_page - 1 >= 1 ? $current_page - 1 : 1}}">Previous</a></li>
    @elseif($total_page == 2)
        <li><a href="#" class="{{$current_page != 1 ? "" : "disabled"}}"
               value="{{$current_page - 1 >= 1 ? $current_page - 1 : 1}}">Previous</a></li>
    @endif
    @for($i = 1; $i <= $total_page; $i++)
        @if($total_page <= 10)
            <li><a value="{{$i}}" class="page {{$i == $current_page ? "current" : ""}}" href="#">{{$i}}</a></li>
        @else
            @if($i <= 5 && $current_page < 2)
                <li><a value="{{$i}}" class="page {{$i == $current_page ? "current" : ""}}" href="#">{{$i}}</a>
                </li>
            @elseif($current_page >= 2 && $current_page < $total_page - 1 && $i >= $current_page - 2 && $i <= $current_page + 2)
                <li><a value="{{$i}}" class="page {{$i == $current_page ? "current" : ""}}" href="#">{{$i}}</a>
                </li>
            @elseif($current_page >= $total_page - 1 && $i >= $total_page - 4)
                <li><a value="{{$i}}" class="page {{$i == $current_page ? "current" : ""}}" href="#">{{$i}}</a>
                </li>
            @endif
        @endif
    @endfor
    @if($total_page >= 3)
        <li><a value="{{$current_page + 1 > $total_page ? $total_page : $current_page + 1}}" href="#"
               class="next {{$current_page != $total_page ? "" : "disabled"}}">Next</a></li>
        <li><a href="#" value="{{$total_page}}" class="last {{$current_page != $total_page ? "" : "disabled"}}">Last</a>
        </li>
    @elseif($total_page == 2)
        <li><a value="{{$current_page + 1 > $total_page ? $total_page : $current_page + 1}}" href="#"
               class="{{$current_page ==1 ? "" : "disabled"}}">Next</a></li>
    @endif
</ul>

