@extends ('platform-core::components/form/fields/base-field')

@section ('field')
<div class="input-group date date-only">
	{{ Form::text($obj->slug(), $obj->value(), array('class' => 'form-control', 'data-format' => 'YYYY-MM-DD')) }}
	<span class="input-group-addon">
		<span class="glyphicon glyphicon-calendar"></span>
	</span>
</div>
@overwrite