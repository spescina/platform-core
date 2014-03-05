<?php namespace Psimone\PlatformCore\Components\Form;

use Psimone\PlatformCore\Components\Form\Panel;
use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class Tab implements Displayable, Translatable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	use \Psimone\PlatformCore\Traits\Slugable;

	private $slug;
	private $view = 'components/form/tab';
	private $viewData = true;

	public function __construct($slug)
	{
		$this->slug = $slug;
	}

	public function i18n()
	{
		if ($this->slug === Panel::_main_)
		{
			return Language::get('ui.main_panel');
		}
		else
		{
			return Language::get(Application::module() . '.panels.' . $this->slug);
		}
	}
}
