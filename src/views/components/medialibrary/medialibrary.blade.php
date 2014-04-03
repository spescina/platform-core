@extends ('platform-core::layout')

@section ('header.scripts')
<script type="text/javascript">
        ZZ = {
                config: {
                        medialibrary : {
                                config: {{ PMedialibrary::configToJSON() }},
                                field: '{{ $field }}',
                                value: '{{ $value }}'
                        }
                }
        };
</script>
@append

@section('header')
@stop

@section('footer')
@stop

@section ('body')
<div class="container">
        <div class="row" id="medialibrary"></div>
</div>
<div id="bottom-bar">
        <div class="container">
                <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                </div>
                <p class="pull-left">
                        <span class="btn btn-primary btn-sm fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>{{ PMedialibrary::localize('upload') }}</span>
                                
                                <input id="fileupload" type="file" name="files[]" multiple>
                        </span>
                        <button id="btn-create-folder" type="button" class="btn btn-default btn-sm">{{ PMedialibrary::localize('create_folder') }}</button>
                        <button id="btn-delete-folder" type="button" class="hidden btn btn-default btn-sm">{{ PMedialibrary::localize('delete_folder') }}</button>
                        <input id="input-folder" class="hidden form-control input-sm" type="text" name="folder" placeholder="{{ PMedialibrary::localize('folder') }}" />
                        <button id="btn-confirm" type="button" class="hidden btn btn-success btn-sm">{{ PMedialibrary::localize('confirm') }}</button>
                </p>
                <p class="pull-right">
                        <button id="btn-select" type="button" class="hidden btn btn-primary btn-sm">{{ PMedialibrary::localize('select') }}</button>
                        <button id="btn-cancel" type="button" class="btn btn-default btn-sm">{{ PMedialibrary::localize('cancel') }}</button>
                </p>
        </div>
</div>
@stop

