<form action="{{ PTable::action()->url() }}" method="post">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<h3 class="panel-title pull-left">{{ PPage::localize('title') }}</h3>
			<div class="pull-right">
				{{ PPage::toolbar()->show() }}
			</div>
		</div>
		<div class="panel-body">
			@if ( PTable::isEmpty() )
			<div class="well well-sm">
				<span>{{ PTable::localize('no_results') }}</span>
			</div>
			@endif
		</div>
		@if ( ! PTable::isEmpty() )
		<table class="table table-condensed table-bordered table-hover">
			<thead>
				<tr>
					@foreach (PTable::head() as $cell)
					{{ $cell->show() }}
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
	<div class="pull-left">
		<p class="text-muted">{{ PTable::localize('pagination', array('low' => PTable::results()->getFrom(), 'high' => PTable::results()->getTo(), 'total' => PTable::results()->getTotal())) }}</p>
	</div>
	<div class="pull-right">{{ PTable::results()->links() }}</div>
</form>