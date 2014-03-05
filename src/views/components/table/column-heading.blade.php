@if ( $obj->isSortable() )
<?/*<a href="?{{ $queryVars }}" title="{{ $obj->i18n() }}">
	{{ $obj->i18n() }}
	@if (!empty($currentIcon))
	<span class="glyphicon glyphicon-{{ $currentIcon }}"></span>
	@endif
</a>*/?>
<a href="" title="{{ $obj->i18n() }}">{{ $obj->i18n() }}</a>
@else
{{ $obj->i18n() }}
@endif