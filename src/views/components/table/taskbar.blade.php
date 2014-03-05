<div class="btn-group btn-group-xs">
	@foreach ($obj->tasks() as $task)
	{{ $task->show() }}
	@endforeach
</div>