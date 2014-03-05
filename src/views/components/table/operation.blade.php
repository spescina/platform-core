@if ( $obj->hasModal() )
<a href="{{ $obj->action()->url() }}" class="btn btn-default modalDelete">{{ $obj->i18n() }}</a>
@else
<a href="{{ $obj->action()->url() }}" class="btn btn-default">{{ $obj->i18n() }}</a>
@endif