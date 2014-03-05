<?php namespace Psimone\PlatformCore\Html\Table;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Html\Table;
use Psimone\PlatformCore\i18n\TranslatableInterface;

class ColumnHeading implements TableCellInterface, TranslatableInterface
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
		if ( ! array_key_exists('sortable', $this->options) || $this->options['sortable'] !== false )
		{
			return $this->sortable();
		}
		
		return $this->i18n();
	}
	
	private function sortable()
	{
		return "<a href=\"\">" . $this->i18n() . "</a>";
	}
	
	public function isAction()
	{
		return ($this->field === Table::actionColumn);
	}
	
	public function i18n()
	{
		if ($this->field === Table::actionColumn)
		{
			return Language::get('listing.' . Table::actionColumn);
		}
		
		return Language::get(Application::module() . '.listing.' . $this->field);
	}
}
