<?php namespace Psimone\PlatformCore\Components\Breadcrumbs;

use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class Item implements Displayable, Translatable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $slug;
	private $view = 'components/breadcrumbs/item';
	private $viewData = true;

	public function __construct($slug)
	{
		$this->slug = $slug;
	}

	public function i18n()
	{
		if ($this->isRoot())
		{
			return Language::get('breadcrumbs.root');
		}
		else
		{
			return Language::get($this->slug . '.section.title');
		}
	}

	public function isRoot()
	{
		return ($this->slug === 'root');
	}
}
