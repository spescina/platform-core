@extends ('pangea-core::blocks/form/base')

@section ('field')
<div class="input-group">
        {{ \Form::text($name, $value, array('class' => 'form-control')) }}
        <div class="input-group-btn">
                <a data-fancybox-type="iframe" href="{{ \URL::action('Psimone\PangeaCore\Controllers\MediaLibraryController@getPanel', array('field' => $name, 'value' => $value)) }}" class="btn btn-default lightbox"><span class="glyphicon glyphicon-folder-open"></span></a>
        </div>
</div>
@overwrite