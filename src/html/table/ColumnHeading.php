<?php namespace Psimone\PlatformCore\Html\Table;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Html\Table;

class ColumnHeading implements TableCell
{
	private $field;
	
	private $options;
	
	public function __construct($field, array $options = array())
	{
		$this->field = $field;
		
		$this->options = $options;
	}
	
	public function show()
	{
		if ($this->field === Table::actionColumn)
		{
			return Language::get('ui.' . Table::actionColumn);
		}
		
		if ( ! array_key_exists('sortable', $this->options) || $this->options['sortable'] !== false )
		{
			return $this->sortable();
		}
		
		return Language::get(Application::module() . '.listing.' . $this->field);
	}
	
	private function sortable()
	{
		return "<a href=\"\">" . Language::get(Application::module() . '.listing.' . $this->field) . "</a>";
	}
	
	public function isAction()
	{
		return ($this->field === Table::actionColumn);
	}
}
