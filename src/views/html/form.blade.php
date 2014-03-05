{{ PBreadcrumbs::show() }}
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
                <li class="active">
			<a href="#{{ $panel->slug() }}" data-toggle="tab">{{ $panel->i18n() }}</a>
                </li>
                @endforeach
            </ul>
            <?/*<div class="tab-content">
                @foreach (\PangeaForm::getStructure() as $panel => $structure)
                @if ($panel === 'main')
                <div class="tab-pane active" id="{{ $panel }}">
                @else
                <div class="tab-pane" id="{{ $panel }}">
                @endif
                    @foreach ($structure as $fieldName => $fieldAttributes)
                    <div class="form-group">
                        {{ \PangeaHtml::create($fieldName, $fieldAttributes)->show() }}
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            <div class="col-sm-offset-2 col-sm-4">
                <button name="save" value="save" type="submit" class="btn btn-success">{{ \Lang::get('ui.button_save')}}</button>
                <button name="save_back" value="save_back" type="submit" class="btn btn-info">{{ \Lang::get('ui.button_save_back')}}</button>
                <a href="{{ \URL::action(\Pangea::getController() . '@getListing') }}" class="btn btn-warning">{{ \Lang::get('ui.button_back') }}</a>
            </div>*/?>
        </form>
    </div>
    <div class="panel-footer">
       
    </div>
</div>