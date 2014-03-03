<ol class="breadcrumb">
	<li><a href="">Home</a></li>
	<li class="active">{{ Language::get(Application::module().".section.title") }}</li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading clearfix">
		<h3 class="panel-title pull-left">{{ Language::get(Application::module().".section.title") }}</h3>
		<div class="btn-group btn-group-xs pull-right">
			<a href="" class="btn btn-default">{{ Language::get('ui.create_new_element') }}</a>
		</div>
	</div>
	<div class="panel-body">
		<p>{{ Language::get(Application::module().".section.subtitle") }}</p>
		@if (!count(PTable::getEntries()))
		<div class="well well-sm">
			<span>{{ Language::get('ui.no_results') }}</span>
		</div>
		@endif
	</div>
	@if (count(PTable::getEntries()))
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				@foreach (PTable::heading() as $column)
				@if ($column === '__actions__')
				<th class="col-md-3">
				@else
				<th>
				@endif
					{{ Language::get(Application::module().".listing.".$column) }}
				</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach (PTable::body() as $row)
			<tr data-id="{{ $row['__id__'] }}">
				@foreach ($row as $column => $value)
				@if ($column <> '__id__')
				<td>{{ $value }}</td>
				@endif
				@endforeach
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
	<div class="panel-footer"></div>
</div>
<?/*
<div class="pull-left">
<p class="text-muted">{{ Language::get('ui.pagination', array('low' => \PangeaTable::getRecordset()->getFrom(), 'high' => \PangeaTable::getRecordset()->getTo(), 'total' => \PangeaTable::getRecordset()->getTotal())) }}</p>
</div>
<div class="pull-right">
{{ \PangeaTable::getPagination() }}
</div>*/?>