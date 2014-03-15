<div class="btn-group btn-group-{{ $obj->size() }} {{ $obj->classes() }}">
	@foreach ($obj->tasks() as $task)
	{{ $task->show() }}
	@endforeach
</div>