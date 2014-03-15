<?php namespace Psimone\PlatformCore\Components\Breadcrumbs;

use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Components\Breadcrumbs\Item;
use Psimone\PlatformCore\Interfaces\Displayable;

class Breadcrumbs implements Displayable
{	
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $items = array();
	private $view = 'components/breadcrumbs/breadcrumbs';
	private $viewData = false;

	public function load()
	{
		$this->item('root');

		$this->item(Platform::module());
	}

	public function item($slug)
	{
		if (!array_key_exists($slug, $this->items))
		{
			$this->items[$slug] = new Item($slug);
		}
	}

	public function items()
	{
		return $this->items;
	}
}
