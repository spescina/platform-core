<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Components\Table;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class ColumnHeading implements Displayable, Translatable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $field;
	private $options;
	private $view = 'components/table/column-heading';
	private $viewData = true;

	public function __construct($field, array $options = array())
	{
		$this->field = $field;

		$this->options = $options;
	}

	public function isSortable()
	{
		if ($this->isAction())
		{
			return false;
		}

		if (array_key_exists('sortable', $this->options) && $this->options['sortable'] === false)
		{
			return false;
		}

		return true;
	}

	public function isAction()
	{
		return ($this->field === Table::COLUMN_ACTIONS);
	}

	public function i18n()
	{
		if ($this->field === Table::COLUMN_ACTIONS)
		{
			return Language::get('table.' . Table::COLUMN_ACTIONS);
		}

		return Language::get(Platform::module() . '.table.' . $this->field);
	}
}
