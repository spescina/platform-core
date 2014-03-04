<?php namespace Psimone\PlatformCore\Html\Table;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Facades\Table;
use Psimone\PlatformCore\Html\Table as TableClass;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class Actions implements TableCell
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
			$actions[] = array(
				'action' => $action,
				'label' => Language::get('ui._action' . $action),
				'url' => $this->url($action)
			);
		}
		
		return $actions;
	}
	
	public function url($action)
	{
		switch ($action) {
			case TableClass::editAction:
				$method = 'edit';
				break;
			
			case TableClass::deleteAction:
				$method = 'delete';
				break;
			
			case TableClass::deleteAction:
				$method = 'delete';
				break;			
		}		
		
		return URL::route('module', array(
			'module' => Application::module(),
			'action' => $method,
			'id' => $this->record->id
		));
	}
}
