@extends ('platform-core::components/form/fields/base-field')

@section ('field')
{{ Form::text($obj->slug(), $obj->value(), array('class' => 'form-control')) }}
@overwrite