@extends ('pangea-core::blocks/form/base')

@section ('field')
<div class="input-group date time-only">
	{{ \Form::text($name, $value, array('class' => 'form-control', 'data-format' => 'HH:mm:ss')) }}
	<span class="input-group-addon">
		<span class="glyphicon glyphicon-time"></span>
	</span>
</div>
@overwrite