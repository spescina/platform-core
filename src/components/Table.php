<?php namespace Psimone\PlatformCore\Components;

use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Components\Table\Actions;
use Psimone\PlatformCore\Components\Table\ColumnHeading;
use Psimone\PlatformCore\Components\Table\Content;
use Psimone\PlatformCore\Interfaces\Displayable;

class Table implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	const actionColumn = '__actions__';
	const idColumn = '__id__';
	const editAction = '_EDT_';
	const deleteAction = '_DLT_';
	const copyAction = '_CPY_';

	private $actions = array(
		self::editAction,
		self::deleteAction
	);
	private $columns;
	private $view = 'components/table';
	private $viewData = false;

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
