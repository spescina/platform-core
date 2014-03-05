<?php namespace Psimone\PlatformCore\Html\Form;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\i18n\TranslatableInterface;

class Panel implements TranslatableInterface
{
	const _main_ = 'main'; 
	
	private $slug;
	
	public function __construct($slug)
	{
		$this->slug = $slug;
	}
	
	public function i18n()
	{
		if ($this->slug === self::_main_)
		{
			return Language::get('ui.main_panel');
		}
		else
		{
			return Language::get(Application::module() . '.panels.' . $this->slug);
		}
	}
	
	public function slug()
	{
		return $this->slug;
	}
}
