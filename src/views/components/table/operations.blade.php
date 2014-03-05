<div class="btn-group btn-group-xs">
	@foreach ($obj->operations() as $operation)
	{{ $operation->show() }}
	@endforeach
</div>