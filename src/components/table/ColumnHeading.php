<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Components\Table;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class ColumnHeading implements Displayable, Translatable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $field;
	private $options;
	private $view = 'components/table/columnHeading';
	private $viewData = true;

	public function __construct($field, array $options = array())
	{
		$this->field = $field;

		$this->options = $options;
	}
	
	public function isSortable()
	{
		return !(array_key_exists('sortable', $this->options) && $this->options['sortable'] === false);
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
