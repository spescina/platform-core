<div class="panel panel-default">
	<div class="panel-heading clearfix">
		<h3 class="panel-title pull-left">{{ PPage::i18n('title') }}</h3>
		<div class="btn-group btn-group-xs pull-right">
			<a href="" class="btn btn-default">{{ PTable::i18n('new_element') }}</a>
		</div>
	</div>
	<div class="panel-body">
		<p>{{ PPage::i18n('subtitle') }}</p>
		@if ( PTable::isEmpty() )
		<div class="well well-sm">
			<span>{{ PTable::i18n('no_results') }}</span>
		</div>
		@endif
	</div>
	@if ( ! PTable::isEmpty() )
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				@foreach (PTable::head() as $cell)
				@if ($cell->isAction())
				<th class="col-md-3">{{ $cell->show() }}</th>
				@else
				<th>{{ $cell->show() }}</th>
				@endif
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach (PTable::body() as $row)
			<tr data-id="{{ $row['__id__'] }}">
				@foreach ($row['data'] as $field => $cell)
				<td>{{ $cell->show() }}</td>
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