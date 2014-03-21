@extends ('pangea-core::blocks/form/base')

@section ('field')
<div class="input-group date date-only">
        {{ \Form::text($name, $value, array('class' => 'form-control', 'data-format' => 'YYYY-MM-DD')) }}
        <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
        </span>
</div>
@overwrite