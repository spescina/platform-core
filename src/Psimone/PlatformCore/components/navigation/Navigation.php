<?php namespace Psimone\PlatformCore\Components\Navigation;

use Psimone\PlatformCore\Components\Navigation\Item;
use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Interfaces\Displayable;
use Illuminate\Support\Facades\Config;

class Navigation implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $items = array();
	private $view = 'components/navigation/navigation';
	private $viewData = false;	

	public function load()
	{
		$items = Config::get(Platform::pkg(). '::navigation');

		foreach ($items as $slug => $url)
		{
			$this->item($slug, $url);
		}
	}

	public function item($slug, $url)
	{
		if (!array_key_exists($slug, $this->items))
		{
			$this->items[$slug] = new Item($slug, $url);
		}
	}

	public function items()
	{
		return $this->items;
	}
}
