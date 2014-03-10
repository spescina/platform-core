@if ( $obj->modal() )
<a href="{{ $obj->action()->url() }}" class="btn btn-{{ $obj->color() }} {{ $obj->modal() }} {{ $obj->slug() }}">{{ $obj->i18n() }}</a>
@else
@if ( $obj->button() )
<button type="submit" class="btn btn-{{ $obj->color() }} {{ $obj->slug() }}">{{ $obj->i18n() }}</button>
@else
<a href="{{ $obj->action()->url() }}" class="btn btn-{{ $obj->color() }} {{ $obj->slug() }}">{{ $obj->i18n() }}</a>
@endif
@endif