<?php namespace Psimone\PlatformCore\Components;

use Psimone\PlatformCore\Action;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Components\Table\Taskbar;
use Psimone\PlatformCore\Components\Table\ColumnHeading;
use Psimone\PlatformCore\Components\Table\Content;
use Psimone\PlatformCore\Interfaces\Displayable;

class Table implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	const COLUMN_ACTIONS = '__actions__';
	const COLUMN_ID = '__id__';

	private $tasks = array(
		Action::ACTION_SHOWFORM,
		Action::ACTION_DELETE
	);
	private $fields;
	private $view = 'components/table';
	private $viewData = false;

	public function fields(array $fields)
	{
		$this->fields = $fields;
	}

	public function isEmpty()
	{
		return ( count(Model::all()) === 0 );
	}

	public function head()
	{
		$headings = array();

		foreach ($this->fields as $field => $options)
		{
			$headings[$field] = new ColumnHeading($field, $options);
		}

		$headings[self::COLUMN_ACTIONS] = new ColumnHeading(self::COLUMN_ACTIONS);

		return $headings;
	}

	public function body()
	{
		$body = array();

		foreach (Model::all() as $record)
		{
			$row = array(
				self::COLUMN_ID => $record->id,
				'data' => array()
			);

			foreach ($this->fields as $field => $options)
			{
				$row['data'][$field] = new Content($field, $record, $options);
			}

			$row['data'][self::COLUMN_ACTIONS] = new Taskbar($record);

			$body[] = $row;
		}

		return $body;
	}

	public function tasks()
	{
		return $this->tasks;
	}

	public function load()
	{
		
	}
	
	public function i18n($section)
	{
		return Language::get('table.' . $section);
	}
}
