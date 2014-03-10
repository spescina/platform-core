<div class="btn-group btn-group-sm">
	@foreach ($obj->tasks() as $task)
	{{ $task->show() }}
	@endforeach
</div>