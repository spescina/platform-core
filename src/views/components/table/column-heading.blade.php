@if ( $obj->isSortable() )
<a href="?{{ $obj->link() }}" title="{{ $obj->localize() }}">
	{{ $obj->localize() }}
	@if (!empty($obj->icon()))
	<span class="glyphicon glyphicon-{{ $obj->icon() }}"></span>
	@endif
</a>
@else
{{ $obj->localize() }}
@endif