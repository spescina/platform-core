<div class="panel panel-default">
	<div class="panel-heading">
		@if (PForm::isEmpty())
		<h3 class="panel-title">{{ Language::get('ui.create_new_element') }}</h3>
		@else
		<h3 class="panel-title">{{ Language::get('ui.edit_element_id') }}{{ PForm::record()->id }}</h3>
		@endif
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="post" autocomplete="off">
			<ul class="nav nav-tabs">
				@foreach (PForm::panels() as $panel)
				{{ $panel->tab->show() }}
				@endforeach
			</ul>
			<div class="tab-content">
			@foreach (PForm::panels() as $panel)
			{{ $panel->show() }}
			@endforeach
			</div>
			<div class="col-sm-offset-2 col-sm-4">
			<button name="save" value="save" type="submit" class="btn btn-success">{{ Language::get('ui.button_save')}}</button>
			<button name="save_back" value="save_back" type="submit" class="btn btn-info">{{ Language::get('ui.button_save_back')}}</button>
			<a href="" class="btn btn-warning">{{ Language::get('ui.button_back') }}</a>
			</div>
		</form>
	</div>
	<div class="panel-footer">

	</div>
</div>