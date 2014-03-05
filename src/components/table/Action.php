<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Components\Table as TableClass;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;
use Illuminate\Support\Facades\URL;

class Action implements Displayable, Translatable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $record;
	private $slug;
	private $view = 'components/table/action';
	private $viewData = true;

	public function __construct($slug, $record)
	{
		$this->slug = $slug;

		$this->record = $record;
	}

	public function i18n()
	{
		return Language::get('listing.action' . $this->slug);
	}

	public function url()
	{
		switch ($this->slug)
		{
			case TableClass::editAction:
				$method = 'form';
				break;

			case TableClass::deleteAction:
				$method = 'delete';
				break;

			case TableClass::copyAction:
				$method = 'copy';
				break;
		}

		return URL::route('module', array(
				'module' => Application::module(),
				'action' => $method,
				'id' => $this->record->id
		));
	}

	public function hasModal()
	{
		return ($this->slug === TableClass::deleteAction);
	}
}
