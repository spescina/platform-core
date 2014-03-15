<ol class="breadcrumb">
	@foreach (PBreadcrumbs::items() as $item)
	{{ $item->show() }}
	@endforeach
</ol>