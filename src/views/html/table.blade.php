<ol class="breadcrumb">
    <li><a href="">Home</a></li>
    <li class="active">{{ \Lang::get(Application::getModule().".section.title") }}</li>
</ol>
<?/*
<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left">{{ \Lang::get(\Pangea::getModelName().".section.title") }}</h3>
        <div class="btn-group btn-group-xs pull-right">
            <a href="{{ \URL::action(\Pangea::getController() . '@getEdit')}}" class="btn btn-default">{{ \Lang::get('ui.create_new_element') }}</a>
        </div>
    </div>
    <div class="panel-body">
        <p>{{ \Lang::get(\Pangea::getModelName().".section.subtitle") }}</p>
        @if (!count(\PangeaTable::getData()))
        <div class="well well-sm">
            <span>{{ \Lang::get('ui.no_results') }}</span>
        </div>
        @endif
    </div>
    @if (count(\PangeaTable::getData()))
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                @foreach (\PangeaTable::getHeading() as $field => $column)
                @if ($field === '_ACTIONS_')
                <th class="col-md-3">
                @else
                <th>
                @endif
                    {{ $column }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach (\PangeaTable::getData() as $row)
            <tr data-id="{{ $row['id'] }}">
                @foreach ($row as $fieldName => $fieldValue)
                @if ($fieldName <> 'id')
                <td>{{ \PangeaTable::render($fieldName, $fieldValue) }}</td>
                @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <div class="panel-footer"></div>
</div>
<div class="pull-left">
    <p class="text-muted">{{ \Lang::get('ui.pagination', array('low' => \PangeaTable::getRecordset()->getFrom(), 'high' => \PangeaTable::getRecordset()->getTo(), 'total' => \PangeaTable::getRecordset()->getTotal())) }}</p>
</div>
<div class="pull-right">
    {{ \PangeaTable::getPagination() }}
</div>*/?>