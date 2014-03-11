<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Components\Table\Order as OrderConst;
use Psimone\PlatformCore\Components\Table\Table as TableConst;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Facades\Order;
use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class ColumnHeading implements Displayable, Translatable {

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
		return ($this->field === TableConst::COLUMN_ACTIONS);
	}

	public function i18n()
	{
		if ($this->field === TableConst::COLUMN_ACTIONS)
		{
			return Language::get('table.' . TableConst::COLUMN_ACTIONS);
		}

		return Language::get(Platform::module() . '.table.' . $this->field);
	}

	public function link()
	{
		$activeColumn = Order::column() ? : '';
		$activeSort = Order::sort() ? : '';

		$nextSort = 'asc';

		if ($this->field === $activeColumn)
		{
			switch ($activeSort) {
				case 'asc':
					$nextSort = 'desc';
					break;
				case 'desc':
					$nextSort = (Order::isBase()) ? 'asc' : '';
					break;
			}
		}

		if (empty($nextSort) && !Order::isBase())
		{
			$queryVars = array(OrderConst::RESET_PARAM => 1);
		}
		else
		{
			$queryVars = array(
			    OrderConst::COLUMN_PARAM => $this->field,
			    OrderConst::SORT_PARAM => $nextSort
			);
		}

		return http_build_query($queryVars);
	}

	public function icon()
	{
		$activeColumn = Order::column() ? : '';
		$activeSort = Order::sort() ? : '';

		$icon = '';

		if ($this->field === $activeColumn)
		{
			switch ($activeSort) {
				case 'asc':
					$icon = 'chevron-down';
					break;

				case 'desc':
					$icon = 'chevron-up';
					break;
			}
		}

		return $icon;
	}
	
	public function width()
	{
		return isset($this->options['columnWidth']) ? $this->options['columnWidth'] : null;
	}

}
