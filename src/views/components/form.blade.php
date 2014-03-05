<div class="panel panel-default">
	<div class="panel-heading">
		@if (PForm::isEmpty())
		<h3 class="panel-title">{{ PForm::i18n('new_element') }}</h3>
		@else
		<h3 class="panel-title">{{ PForm::i18n('edit_element') }}{{ PForm::record()->id }}</h3>
		@endif
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="{{ PForm::action()->url() }}" method="post" autocomplete="off">
			<ul class="nav nav-tabs">
				@foreach (PForm::panels() as $panel)
				{{ $panel->tab()->show() }}
				@endforeach
			</ul>
			<div class="tab-content">
			@foreach (PForm::panels() as $panel)
			{{ $panel->show() }}
			@endforeach
			</div>
			<div class="col-sm-offset-2 col-sm-10">
			<button name="save" value="save" type="submit" class="btn btn-success">{{ PForm::i18n('button_save') }}</button>
			<button name="save_back" value="save_back" type="submit" class="btn btn-info">{{ PForm::i18n('button_save_back') }}</button>
			<a href="{{ PForm::back()->url() }}" class="btn btn-warning">{{ PForm::i18n('button_back') }}</a>
			</div>
		</form>
	</div>
	<div class="panel-footer">

	</div>
</div>