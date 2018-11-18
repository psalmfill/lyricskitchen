@if ($paginator->hasPages())
            <div class="pagination">
                    <ul>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="pagination-item active"><a href="#">Prev</a></li>
                    @else
                        <li class="pagination-item "><a href="{{$paginator->previousPageUrl()}}">Prev</a></li>
                    @endif
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="pagination-item"><a href="#">{{$element}}</a></li>
                        @endif

                    @if(is_array($element))
                        {{-- Array Of Links --}}
                        @foreach($element as $page=>$url)
                            @if ($page == $paginator->currentPage())
                            <li class="active pagination-item"><a href="">{{$page}}</a></li>
                            @else
                            <li class="pagination-item"><a href="{{$url}}">{{$page}}</a></li>
                            @endif
                        @endforeach
                    @endif
                    @endforeach
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="pagination-item"><a href="{{$paginator->nextPageUrl()}}">Next</a></li>
                    @else
                        <li class="pagination-item"><a href="{{$paginator->nextPageUrl()}}">Next</a></li>
                    @endif
                    </ul>
                </div> 
@endif