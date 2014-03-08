<?php namespace Psimone\PlatformCore\Components\Form;

use Psimone\PlatformCore\Facades\Application as Platform;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class Label implements Displayable, Translatable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	use \Psimone\PlatformCore\Traits\Slugable;
	
	private $options;
	private $slug;
	private $view = 'components/form/label';
	private $viewData = true;
	
	public function __construct($slug, $options)
	{
		$this->slug = $slug;
		
		$this->options = $options;
	}
	
	public function i18n()
	{
		return Language::get(Platform::module() . '.form.' . $this->slug);
	}
	
	public function width()
	{
		return $this->options['labelWidth'];
	}
}
