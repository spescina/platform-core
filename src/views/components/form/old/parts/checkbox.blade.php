@extends ('pangea-core::blocks/form/base')

@section ('field')
<div class="checkbox-inline">
	{{ \Form::checkbox($name, 1, $value) }}
</div>
@overwrite