@if ( $obj->modal() )
<a href="{{ $obj->action()->url() }}" class="btn btn-{{ $obj->color() }} {{ $obj->modal() }} {{ $obj->slug() }}">{{ $obj->localize() }}</a>
@else
@if ( $obj->button() )
<button type="submit" class="btn btn-{{ $obj->color() }} {{ $obj->slug() }}">{{ $obj->localize() }}</button>
@else
<a href="{{ $obj->action()->url() }}" class="btn btn-{{ $obj->color() }} {{ $obj->slug() }}">{{ $obj->localize() }}</a>
@endif
@endif