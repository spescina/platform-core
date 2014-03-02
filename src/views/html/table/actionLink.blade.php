<div class="btn-group btn-group-xs">
    @foreach ($actions as $action)
    @if ($action['action'] === 'delete')
    <a href="{{ \URL::action(\Pangea::getController().'@get'.ucfirst($action['action']), array($recordId)) }}" class="btn btn-default modalDelete">{{ $action['label'] }}</a>
    @else
    <a href="{{ \URL::action(\Pangea::getController().'@get'.ucfirst($action['action']), array($recordId)) }}" class="btn btn-default">{{ $action['label'] }}</a>
    @endif
    @endforeach
</div>