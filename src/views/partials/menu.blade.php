<ul class="nav nav-pills nav-stacked" id="mainNavigation">
    @foreach (\Config::get('pangea-core::menu') as $section => $value)
    @if (is_array($value))
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ \Lang::get('menu.'.$section) }} <span class="caret"></span></a>
        <ul class="dropdown-menu">
            @foreach ($value as $subSection => $subValue)
            <li><a href="{{ \URL::action($subValue) }}">{{ \Lang::get('menu.'.$subSection) }}</a></li>
            @endforeach
        </ul>
    </li>
    @else
    @if ($value === \Route::current()->getAction())
    <li class="active">
        @else
    <li>
        @endif
        <a href="{{ \URL::action($value) }}">{{ \Lang::get('menu.'.$section) }}</a>
    </li>
    @endif
    @endforeach
</ul>