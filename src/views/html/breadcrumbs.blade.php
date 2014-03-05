<ol class="breadcrumb">
	@foreach (PBreadcrumbs::items() as $item)
	@if ($item->slug() === 'root')
	<li>{{ $item->i18n() }}</li>
	@else
	<li class="active">{{ $item->i18n() }}</li>
	@endif
	@endforeach
</ol>