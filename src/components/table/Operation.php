<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Action;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class Operation implements Displayable, Translatable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $action;
	private $record;
	private $slug;
	private $view = 'components/table/operation';
	private $viewData = true;

	public function __construct($slug, $record)
	{
		$this->slug = $slug;

		$this->record = $record;
		
		$this->action = new Action($slug, array('id' => $this->record->id));
	}

	public function i18n()
	{
		return Language::get('table.actions.' . $this->slug);
	}

	public function hasModal()
	{
		return ($this->slug === Action::ACTION_DELETE);
	}
	
	public function action()
	{
		return $this->action;
	}
}
