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
                <p class="pull-left">
                        <input id="fileupload" type="file" name="files[]" data-url="/medialibrary/upload" multiple>
                        <!--  <button id="btn-upload" type="button" class="btn btn-primary btn-sm">{{ PMedialibrary::localize('upload') }}</button> -->
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

