<li class="dropdown-submenu">
    <a href="" class="dropdown-toggle" data-toggle="dropdown">{{ $categorys[0]->display_name }}</a>
    <ul class="dropdown-menu">
        @foreach($categorys[1] as $category)
        @if(is_object($category))
        <li><a href="">{{ $category->display_name }}</a></li>
        @else
        @include('dropmenu', ['categorys' => $category])
        @endif
        @endforeach
    </ul>
</li>