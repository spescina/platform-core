<div class="panel panel-default">
        <div class="panel-heading">
                @if (PForm::isEmpty())
                <h3 class="panel-title">{{ PForm::localize('new_element') }}</h3>
                @else
                <h3 class="panel-title">{{ PForm::localize('edit_element') }}{{ PForm::record()->id }}</h3>
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
                        <div class="col-xs-offset-2 col-xs-10">
                                <button name="save" value="save" type="submit" class="btn btn-success">{{ PForm::localize('button_save') }}</button>
                                <button name="save_back" value="save_back" type="submit" class="btn btn-info">{{ PForm::localize('button_save_back') }}</button>
                                <a href="{{ PForm::back()->url() }}" class="btn btn-warning">{{ PForm::localize('button_back') }}</a>
                        </div>
                </form>
        </div>
        <div class="panel-footer">

        </div>
</div>