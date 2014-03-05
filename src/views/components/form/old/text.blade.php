@extends ('pangea-core::blocks/form/base')

@section ('field')
{{ \Form::text($name, $value, array('class' => 'form-control')) }}
@overwrite