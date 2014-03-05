@extends ('pangea-core::blocks/form/base')

@section ('field')
{{ \Form::password($name, array('class' => 'form-control')) }}
@overwrite