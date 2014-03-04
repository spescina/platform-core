<div class="btn-group btn-group-xs">
    @foreach ($actions as $action)
    @if ($action['action'] === '_DLT_')
    <a href="{{ $action['url'] }}" class="btn btn-default modalDelete">{{ $action['label'] }}</a>
    @else
    <a href="{{ $action['url'] }}" class="btn btn-default">{{ $action['label'] }}</a>
    @endif
    @endforeach
</div>