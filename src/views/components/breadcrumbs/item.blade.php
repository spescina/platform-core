@if ( $obj->isRoot() )
<li>{{ $obj->localize() }}</li>
@else
<li class="active">{{ $obj->localize() }}</li>
@endif