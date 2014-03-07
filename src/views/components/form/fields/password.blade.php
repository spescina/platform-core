@extends ('platform-core::components/form/fields/base-field')

@section ('field')
{{ Form::password($obj->slug(), array('class' => 'form-control')) }}
@overwrite