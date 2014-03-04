<ol class="breadcrumb">
	<li><a href="">Home</a></li>
	<li class="active">{{ Language::get(Application::module().".section.title") }}</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        @if (\PangeaForm::isEmpty())
        <h3 class="panel-title">{{ \Lang::get('ui.create_new_element') }}</h3>
        @else
        <h3 class="panel-title">{{ \Lang::get('ui.edit_element_id') }}{{ \PangeaForm::getData()->id }}</h3>
        @endif
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="post" autocomplete="off">
            <ul class="nav nav-tabs">
                @foreach (\PangeaForm::getStructure() as $panel => $structure)
                @if ($panel === 'main')
                <li class="active">
                    <a href="#{{ $panel }}" data-toggle="tab">{{ \Lang::get('ui.main_panel') }}</a>
                </li>
                @else
                <li>
                    <a href="#{{ $panel }}" data-toggle="tab">{{ \Lang::get(\Pangea::getModelName().'.panels.'.$panel) }}</a>
                </li>
                @endif
                @endforeach
            </ul>
            <div class="tab-content">
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
            </div>
        </form>
    </div>
    <div class="panel-footer">
       
    </div>
</div>