@extends ('platform-core::components/form/fields/base-field')

@section ('field')
<div class="input-group">
        {{ Form::text($obj->slug(), $obj->value(), array('class' => 'form-control')) }}
        <span class="input-group-btn">
                <a data-fancybox-type="iframe" href="{{ URL::route('medialibrary', array($obj->slug(), $obj->value())) }}" class="btn btn-default lightbox" type="button"><span class="glyphicon glyphicon-folder-open"></span></a>
        </span>
</div>
@overwrite

@section ('extra')
@if (!empty($obj->value()))
<div class="col-md-2">
      <img class="media-preview" src="{{ ImgProxy::link($obj->icon(),120,120) }}" />  
</div>
@endif
@overwrite