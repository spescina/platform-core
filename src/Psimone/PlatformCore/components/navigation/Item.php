<?php namespace Psimone\PlatformCore\Components\Navigation;

use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;
use Illuminate\Support\Facades\URL;

class Item implements Displayable, Translatable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $children = array();
	private $slug;
	private $url;
	private $view = 'components/navigation/item';
	private $viewData = true;

	public function __construct($slug, $url)
	{
		$this->slug = $slug;

		if (is_array($url) && array_key_exists('__childrens__', $url))
		{
			foreach ($url['__childrens__'] as $childSlug => $childUrl)
			{
				$this->child($childSlug, $childUrl);
			}
		}
		else
		{
			$this->url = $url;
		}
	}

	public function localize()
	{
		return Language::get('navigation.' . $this->slug);
	}

	public function child($childSlug, $childUrl)
	{
		$this->children[] = new Item($childSlug, $childUrl);
	}

	public function children()
	{
		return $this->children;
	}

	public function url()
	{
		return URL::route('module', $this->url);
	}
}
