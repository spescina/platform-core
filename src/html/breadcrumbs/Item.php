<?php namespace Psimone\PlatformCore\Html\Breadcrumbs;

use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\i18n\TranslatableInterface;

class Item implements TranslatableInterface
{
	private $slug;
	
	public function __construct($slug)
	{
		$this->slug = $slug;
	}
	
	public function i18n()
	{
		if ($this->slug === 'root')
		{
			return Language::get('breadcrumbs.root');
		}
		else
		{
			return Language::get($this->slug . '.section.title');
		}
	}
	
	public function slug()
	{
		return $this->slug;
	}
}
