<?php namespace Psimone\PlatformCore\Html;

use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Html\BaseComponent;
use Psimone\PlatformCore\Html\Table\Actions;
use Psimone\PlatformCore\Html\Table\ColumnHeading;
use Psimone\PlatformCore\Html\Table\Content;

class Table extends BaseComponent {
	
	const actionColumn = '__actions__';
	
	const idColumn = '__id__';
	
	const editAction = '_EDT_';
	
	const deleteAction = '_DLT_';
	
	const copyAction = '_CPY_';

	protected $view = 'html/table';
	
	private $columns;
	
	public $actions = array(
		self::editAction,
		self::deleteAction
	);
	
	public function columns(array $columns)
	{
		$this->columns = $columns;
	}
	
	public function isEmpty()
	{
		return ( count(Model::all()) === 0 );
	}
	
	public function headings()
	{
		$headings = array();
		
		foreach ($this->columns as $field => $options)
		{
			$headings[$field] = new ColumnHeading($field, $options);
		}
		
		$headings[self::actionColumn] = new ColumnHeading(self::actionColumn);
		
		return $headings;
	}
	
	public function body()
	{
		$body = array();

		foreach (Model::all() as $record)
		{
			$row = array(
				self::idColumn => $record->id,
				'data' => array()
			);

			foreach ($this->columns as $field => $options)
			{
				$row['data'][$field] = new Content($field, $record, $options);
			}
			
			$row['data'][self::actionColumn] = new Actions($record);

			$body[] = $row;
		}

		return $body;
	}
	
	public function actions()
	{
		return $this->actions;
	}

	public function load()
	{

	}

}
