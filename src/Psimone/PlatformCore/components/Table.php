<?php namespace Psimone\PlatformCore\Components;

use Psimone\PlatformCore\Action;
use Psimone\PlatformCore\Action as ActionConst;
use Psimone\PlatformCore\Facades\Filter;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Components\Table\Taskbar;
use Psimone\PlatformCore\Components\Table\ColumnFilter;
use Psimone\PlatformCore\Components\Table\ColumnHeading;
use Psimone\PlatformCore\Components\Table\Content;
use Psimone\PlatformCore\Interfaces\Displayable;
use Illuminate\Support\Facades\Input;

class Table implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	const COLUMN_ACTIONS = '__actions__';
	const COLUMN_SEARCH = '__search__';
	const COLUMN_ID = '__id__';

	private $action;
	private $tasks = array(
		'edit' => array(
			'action' => ActionConst::ACTION_SHOWFORM,
			'color' => 'warning'
		),
		'delete' => array(
			'action' => ActionConst::ACTION_DELETE,
			'modal' => 'modalDelete',
			'color' => 'danger'
		)
	);
	private $fields;
	private $results;
	private $view = 'components/table';
	private $viewData = false;

	public function __construct()
	{
		$this->results = Model::all();
	}

	public function fields(array $fields)
	{
		$this->fields = $fields;
	}

	public function isEmpty()
	{
		return ( count($this->results) === 0 );
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

		foreach ($this->results as $record)
		{
			$row = array(
				self::COLUMN_ID => $record->id,
				'data' => array()
			);

			foreach ($this->fields as $field => $options)
			{
				$row['data'][$field] = new Content($field, $record, $options);
			}

			$row['data'][self::COLUMN_ACTIONS] = new Taskbar($this->tasks, $record);

			$body[] = $row;
		}

		return $body;
	}
	
	public function i18n($section, $data = array())
	{
		return Language::get('table.' . $section, $data);
	}

	public function results()
	{
		return $this->results;
	}
	
	public function searchbar()
	{
		$filters = array();
		
		foreach ($this->fields as $field => $options)
		{
			$filters[$field] = new ColumnFilter($field, $options);
		}
		
		$filters[self::COLUMN_ACTIONS] = new Taskbar(Filter::tasks());
		
		return $filters;
	}
	
	public function action()
	{
		return $this->action = new Action(ActionConst::ACTION_SEARCH);
	}
	
	private function filtersData()
	{
		return Input::except('search');
	}
	
	private function valid($data)
	{
		foreach ($data as $field => $value)
		{
			if (empty($value))
			{
				unset ($data[$field]);
			}
		}
		
		return $data;
	}
	
	public function data()
	{
		$data = $this->filtersData();

		$fixed = $this->valid($data);

		return $fixed;
	}
	
	public function hasFilters()
	{
		return Filter::hasFilters();
	}
	
	public function resetFilter()
	{
		return Filter::actionReset();
	}
}