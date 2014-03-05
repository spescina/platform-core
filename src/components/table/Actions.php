<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Facades\Table;
use Psimone\PlatformCore\Components\Table\Action;
use Psimone\PlatformCore\Interfaces\Displayable;

class Actions implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $record;
	private $view = 'components/table/actions';
	private $viewData = true;

	public function __construct($record)
	{
		$this->record = $record;
	}

	public function actions()
	{
		$actions = array();

		foreach (Table::actions() as $action)
		{
			$actions[] = new Action($action, $this->record);
		}

		return $actions;
	}
}
