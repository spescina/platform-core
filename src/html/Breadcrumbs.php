<?php namespace Psimone\PlatformCore\Html;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Html\BaseComponent;
use Psimone\PlatformCore\Html\Breadcrumbs\Item;

class Breadcrumbs extends BaseComponent {
	
	protected $view = 'html/breadcrumbs';
	
	protected $items = array();

	public function load()
	{
		$this->item('root');
		
		$this->item(Application::module());
	}

	public function item($slug)
	{
		if ( ! array_key_exists($slug, $this->items) )
		{
			$this->items[$slug] = new Item($slug);
		}
	}
	
	public function items()
	{
		return $this->items;
	}
}
