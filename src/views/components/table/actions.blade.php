<div class="btn-group btn-group-xs">
	@foreach ($obj->actions() as $action)
	{{ $action->show() }}
	@endforeach
</div>