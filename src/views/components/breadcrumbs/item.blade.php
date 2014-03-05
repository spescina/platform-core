@if ( $obj->isRoot() )
<li>{{ $obj->i18n() }}</li>
@else
<li class="active">{{ $obj->i18n() }}</li>
@endif