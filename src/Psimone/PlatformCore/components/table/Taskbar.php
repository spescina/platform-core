<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Facades\Table;
use Psimone\PlatformCore\Components\Task;
use Psimone\PlatformCore\Interfaces\Displayable;

class Taskbar implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $record;
	private $view = 'components/table/taskbar';
	private $viewData = true;

	public function __construct($record)
	{
		$this->record = $record;
	}

	public function tasks()
	{
		$tasks = array();

		foreach (Table::tasks() as $task)
		{
			$tasks[] = new Task($task, $this->record);
		}

		return $tasks;
	}
}
