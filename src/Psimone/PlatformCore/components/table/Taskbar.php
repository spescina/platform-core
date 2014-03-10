<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Components\Task;
use Psimone\PlatformCore\Interfaces\Displayable;

class Taskbar implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $record;
	private $tasks;
	private $view = 'components/table/taskbar';
	private $viewData = true;

	public function __construct($tasks, $record = null)
	{
		$this->tasks = $tasks;
		
		if ($record)
		{
			$this->record = $record;
		}
	}

	public function tasks()
	{
		$tasks = array();

		foreach ($this->tasks as $value)
		{
			$obj = $this->task($value);
			
			if ($this->hasRecord())
			{
				$obj->record($this->record);
			}
			
			$tasks[] = $obj;
		}

		return $tasks;
	}
	
	private function hasRecord()
	{
		return isset($this->record);
	}
	
	private function task($args)
	{
		if (is_array($args))
		{
			$obj = new Task($args['action']);
			
			$this->options($obj, $args);
		}
		else
		{
			$obj = new Task($args);
		}
		
		return $obj;
	}
	
	private function options($obj, $args)
	{
		foreach (Task::opts() as $option)
		{
			if (isset($args[$option]))
			{
				$obj->option($option, $args[$option]);
			}
		}
	}
}
