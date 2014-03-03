<?php namespace Psimone\PlatformCore\Html;

use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Html\BaseComponent;

class Table extends BaseComponent {

	protected $view = 'html/table';
	
	private $columns;
	
	public function columns(array $columns = null)
	{
		if ($columns)
		{
			$this->columns = $columns;
		}
		else
		{
			return $this->columns;
		}
	}
	
	public function entries()
	{
		return Model::all();
	}
	
	public function heading()
	{
		$heading = array();
		
		foreach ($this->columns as $field => $options)
		{
			$cell = $field;
			 
			$heading[] = $cell;
		}
		
		$heading[] = 'actions';
		
		return $heading;
	}
	
	public function load()
	{
		
	}

}
