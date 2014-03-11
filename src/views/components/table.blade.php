<form action="{{ PTable::action()->url() }}" method="post">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<h3 class="panel-title pull-left">{{ PPage::localize('title') }}</h3>
		</div>
		<div class="panel-body">
			<p>{{ PPage::localize('subtitle') }}</p>
			@if ( PTable::isEmpty() )
			<div class="well well-sm">
				<span>{{ PTable::localize('no_results') }}</span>
			</div>
			@endif
		</div>
	</div>
	@if ( ! PTable::isEmpty() )
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			{{ PPage::toolbar()->show() }}
		</div>
		<div class="panel-body">
			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						@foreach (PTable::head() as $cell)
						@if ($cell->isAction())
						<th class="col-sm-2">{{ $cell->show() }}</th>
						@else
						@if ($cell->width())
						<th class="col-sm-{{ $cell->width() }}">
						@else
						<th>
						@endif
							{{ $cell->show() }}
						</th>
						@endif
						@endforeach
					</tr>
				</thead>
				<tbody>
					@if (PTable::hasFilters())
					<tr class="filters">
					@else
					<tr class="filters hidden">
					@endif
						@foreach (PTable::searchbar() as $cell)
						<td>{{ $cell->show() }}</td>
						@endforeach
					</tr>
					@foreach (PTable::body() as $row)
					<tr data-id="{{ $row['__id__'] }}">
						@foreach ($row['data'] as $field => $cell)
						<td>{{ $cell->show() }}</td>
						@endforeach
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer"></div>
	</div>
	@endif
	<div class="pull-left">
		<p class="text-muted">{{ PTable::localize('pagination', array('low' => PTable::results()->getFrom(), 'high' => PTable::results()->getTo(), 'total' => PTable::results()->getTotal())) }}</p>
	</div>
	<div class="pull-right">{{ PTable::results()->links() }}</div>
</form>