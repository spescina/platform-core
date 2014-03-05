@if ( $obj->hasModal() )
<a href="{{ $obj->url() }}" class="btn btn-default modalDelete">{{ $obj->i18n() }}</a>
@else
<a href="{{ $obj->url() }}" class="btn btn-default">{{ $obj->i18n() }}</a>
@endif