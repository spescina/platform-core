@if ( $obj->isMain() )
<div class="tab-pane active" id="{{ $obj->slug() }}">
@else
<div class="tab-pane" id="{{ $obj->slug() }}">
@endif
@foreach ($obj->fields() as $field)
<div class="form-group">
	{{ $field->show() }}
</div>
@endforeach
</div>
