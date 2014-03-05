@extends ('platform-core::layout')

@section ('body')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			{{ PNavigation::show() }}
		</div>
		<div class="col-md-9">
			@if (Session::has('messages'))
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<ul>
					@foreach (Session::get('messages') as $message)
					<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if (Session::has('errors'))
			<div class="alert alert-danger">
				<ul>
					@foreach (Session::get('errors')->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif

			@yield('content')
		</div>
	</div>
</div>
@stop

