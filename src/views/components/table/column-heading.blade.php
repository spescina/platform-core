@if ( $obj->isSortable() )
<a href="?{{ $obj->link() }}" title="{{ $obj->i18n() }}">
	{{ $obj->i18n() }}
	@if (!empty($obj->icon()))
	<span class="glyphicon glyphicon-{{ $obj->icon() }}"></span>
	@endif
</a>
@else
{{ $obj->i18n() }}
@endif