@if ( $obj->isActive() )
<li class="active">
@else
<li>
@endif
	<a href="#{{ $obj->slug() }}" data-toggle="tab">{{ $obj->i18n() }}</a>
</li>