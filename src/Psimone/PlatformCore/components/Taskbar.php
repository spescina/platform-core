<?php namespace Psimone\PlatformCore\Components;

use Psimone\PlatformCore\Components\Task;
use Psimone\PlatformCore\Interfaces\Displayable;

class Taskbar implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $record;
	private $tasks;
	private $options;
	private $view = 'components/taskbar';
	private $viewData = true;

	public function __construct($tasks, $options = null, $record = null)
	{
		$this->tasks = $tasks;
		
		if ($record)
		{
			$this->record = $record;
		}
		
		if ($options && is_array($options))
		{
			$this->options = $options;
		}
	}
	
	public function add($key, $task)
	{
		$this->tasks[$key] = $task;
	}

	public function tasks()
	{
		$tasks = array();

		foreach ($this->tasks as $index => $value)
		{
			$obj = $this->task($value);
			
			if ($this->hasRecord())
			{
				$obj->record($this->record);
			}
			
			$tasks[$index] = $obj;
		}

		return $tasks;
	}
	
	public function size()
	{
		return isset($this->options['size']) ? $this->options['size'] : 'xs';
	}
	
	public function classes()
	{
		return isset($this->options['classes']) ? $this->options['classes'] : null;
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
