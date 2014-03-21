@if ( $obj->isActive() )
<li class="active">
        @else
<li>
        @endif
        <a href="#{{ $obj->slug() }}" data-toggle="tab">{{ $obj->localize() }}</a>
</li>