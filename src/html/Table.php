<?php namespace Psimone\PlatformCore\Html;

use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Html\BaseComponent;

class Table extends BaseComponent {

	protected $view = 'html/table';
	
	private $columns;

	private $entries;
	
	public function getColumns()
	{
		return $this->columns;
	}
	
	public function setColumns(array $columns)
	{
		$this->columns = $columns;
	}

	public function getEntries()
	{
		return $this->entries;
	}

	public function setEntries()
	{
		$this->entries = Model::all();
	}
	
	public function heading()
	{
		$heading = array();
		
		foreach ($this->getColumns() as $field => $options)
		{
			$cell = $field;
			 
			$heading[] = $cell;
		}
		
		$heading[] = '__actions__';
		
		return $heading;
	}
	
	public function body()
	{
		$body = array();

		foreach ($this->entries as $entry)
		{
			$row = array();

			$row['__id__'] = $entry->id;

			foreach ($this->columns as $column => $options)
			{
				$row[$column] = $entry->$column;
			}

			$row['__actions__'] = '__actions__';

			$body[] = $row;
		}

		return $body;
	}

}
