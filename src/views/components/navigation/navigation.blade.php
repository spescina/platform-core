<ul class="nav nav-pills nav-stacked" id="mainNavigation">
	@foreach (PNavigation::items() as $item)
	{{ $item->show() }}
	@endforeach
</ul>