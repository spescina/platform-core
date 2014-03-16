@extends ('platform-core::layout')

@section ('body')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			{{ PNavigation::show() }}
		</div>
		<div class="col-md-9">
			{{ PBreadcrumbs::show() }}
			{{ PPage::messages() }}
			{{ PPage::errors() }}

			@yield('content')
		</div>
	</div>
</div>
@stop

