@extends ('platform-core::components/form/fields/base-field')

@section ('field')
{{ Form::select($obj->slug(), $obj->entries(), $obj->value(), array('class' => 'form-control')) }}
@overwrite