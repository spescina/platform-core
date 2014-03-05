<?php namespace Psimone\PlatformCore\Components\Form;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class Label implements Displayable, Translatable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	use \Psimone\PlatformCore\Traits\Slugable;
	
	private $slug;
	private $view = 'components/form/label';
	private $viewData = true;
	
	public function __construct($slug)
	{
		$this->slug = $slug;
	}
	
	public function i18n()
	{
		return Language::get(Application::module() . '.form.' . $this->slug);
	}
}
