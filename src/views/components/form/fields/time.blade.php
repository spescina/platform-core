@extends ('platform-core::components/form/fields/base-field')

@section ('field')
<div class="input-group date time-only">
	{{ Form::text($obj->slug(), $obj->value(), array('class' => 'form-control', 'data-format' => 'HH:mm:ss')) }}
	<span class="input-group-addon">
		<span class="glyphicon glyphicon-time"></span>
	</span>
</div>
@overwrite