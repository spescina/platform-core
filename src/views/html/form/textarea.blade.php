@extends ('pangea-core::blocks/form/base')

@section ('field')
{{ \Form::textarea($name, $value, array('class' => 'form-control')) }}
@overwrite