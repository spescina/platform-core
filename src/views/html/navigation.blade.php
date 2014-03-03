<ul class="nav nav-pills nav-stacked" id="mainNavigation">
    @foreach ($vars['items'] as $section => $value)
    @if (is_array($value))
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Language::get('navigation.'.$section) }} <span class="caret"></span></a>
        <ul class="dropdown-menu">
            @foreach ($value as $subSection => $subValue)
            <li><a href="">{{ Language::get('navigation.'.$subSection) }}</a></li>
            @endforeach
        </ul>
    </li>
    @else
	@if ($value === Route::current()->getAction())
    <li class="active">
        @else
    <li>
        @endif
        <a href="">{{ Language::get('navigation.'.$section) }}</a>
    </li>
    @endif
    @endforeach
</ul>