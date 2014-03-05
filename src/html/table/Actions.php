<?php namespace Psimone\PlatformCore\Html\Table;

use Psimone\PlatformCore\Facades\Table;
use Psimone\PlatformCore\Html\Table\Action;
use Illuminate\Support\Facades\View;

class Actions implements TableCellInterface
{
	private $record;
	
	private $view = 'platform-core::html/table/actions';
	
	public function __construct($record)
	{
		$this->record = $record;
	}
	
	public function show()
	{
		return View::make($this->view)
			->with('actions', $this->actions());
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
