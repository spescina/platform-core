<?php namespace Psimone\PlatformCore\Components\Form;

use Psimone\PlatformCore\Components\Form\Tab;
use Psimone\PlatformCore\Interfaces\Displayable;

class Panel implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	use \Psimone\PlatformCore\Traits\Slugable;
	
	const _main_ = 'main';

	private $slug;
	public $tab;
	private $view = 'components/form/panel';
	private $viewData = true;

	public function __construct($slug)
	{
		$this->slug = $slug;
		
		$this->tab = new Tab($slug);
	}
	
	public function isMain()
	{
		return ($this->slug === self::_main_);
	}
}
