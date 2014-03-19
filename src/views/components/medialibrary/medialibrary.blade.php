@extends ('platform-core::layout')

@section ('header.scripts')
        <script type="text/javascript">
                PlatformCore = {
                        config: {
				medialibrary : {{ PMedialibrary::configToJSON() }}
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
@stop

