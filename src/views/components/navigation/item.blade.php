@if ( count($obj->children()) )
<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $obj->i18n() }} <span class="caret"></span></a>
	<ul class="dropdown-menu">
		@foreach ($obj->children() as $item)
		{{ $item->show() }}
		@endforeach
	</ul>
</li>
@else
<li>
	<a href="{{ $obj->url() }}">{{ $obj->i18n() }}</a>
</li>
@endif