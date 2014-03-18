@extends ('platform-core::layout')

@section ('header.scripts')
        <script type="text/javascript">
                PlatformCore = {
                        "medialibrary" : {{ PMedialibrary::config() }}
                };
        </script>
@append

@section('header')
@stop

@section('footer')
@stop

@section ('body')
<div class="container">
	<div class="row">
                
	</div>
</div>
@stop

