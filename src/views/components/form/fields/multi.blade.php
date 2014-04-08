@extends ('platform-core::components/form/fields/base-field')

@section ('field')
<div class="panel-group" class="multi_{{ $obj->slug() }}">
        <div class="panel panel-default">
                <div class="panel-heading">
                        <a data-toggle="collapse" data-parent=".multi{{ $obj->slug() }}" href=".panel_{{ $obj->slug() }}">
                                <p class="panel-title"><small>linked</small><span class="badge pull-right">{{ count($obj->value()) }}</span></p>    
                        </a>
                </div>
                <div class="panel-collapse collapse panel_{{ $obj->slug() }}">
                        <div class="panel-body">
                                <ul class="list-group">
                                        @foreach ($obj->entries() as $entry)
                                        <li class="list-group-item">
                                                <span>{{ $entry->label }}</span>
                                                {{ Form::checkbox('multi_' . $obj->slug() . '[]', $entry->value, in_array($entry->value, $obj->value()), array('class' => 'pull-right')) }}
                                        </li>
                                        @endforeach
                                </ul>
                        </div>
                </div>
        </div>
</div>
@overwrite