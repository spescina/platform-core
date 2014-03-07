@extends ('platform-core::components/form/fields/base-field')

@section ('field')
<div class="checkbox-inline">
	{{ Form::checkbox($obj->slug(), 1, $obj->value()) }}
</div>
@overwrite