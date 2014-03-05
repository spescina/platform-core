@extends ('platform-core::components/form/fields/base-field')

@section ('field')
{{ Form::textarea($obj->slug(), $obj->value(), array('class' => 'rich form-control')) }}
@overwrite