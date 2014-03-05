@extends ('pangea-core::blocks/form/base')

@section ('field')
{{ \Form::select($name, $attributes['entries'], $value, array('class' => 'form-control')) }}
@overwrite