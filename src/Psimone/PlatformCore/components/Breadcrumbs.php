<?php namespace Psimone\PlatformCore\Components;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Components\Breadcrumbs\Item;
use Psimone\PlatformCore\Interfaces\Displayable;

class Breadcrumbs implements Displayable
{	
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $items = array();
	private $view = 'components/breadcrumbs';
	private $viewData = false;

	public function load()
	{
		$this->item('root');

		$this->item(Application::module());
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