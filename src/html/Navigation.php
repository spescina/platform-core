<?php namespace Psimone\PlatformCore\Html;

use Psimone\PlatformCore\Html\BaseComponent;
use Illuminate\Support\Facades\Config;

class Navigation extends BaseComponent {

	protected $view = 'html/navigation';

	public function load()
	{
		$this->addVar('items', Config::get('platform-core::navigation'));
	}

}
