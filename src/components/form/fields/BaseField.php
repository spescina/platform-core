<?php namespace Psimone\PlatformCore\Components\Form\Fields;

use Psimone\PlatformCore\Components\Form\Label;
use Psimone\PlatformCore\Interfaces\Displayable;

abstract class BaseField implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	use \Psimone\PlatformCore\Traits\Slugable;
	
	protected $help;
	protected $label;
	protected $slug;
	protected $value;
	protected $viewData = true;
	
	public function __construct($slug)
	{
		$this->label = new Label($slug);
		
		$this->slug = $slug;
	}
	
	public function help()
	{
		return $this->help;
	}
	
	public function label()
	{
		return $this->label;
	}
	
	public function value()
	{
		return $this->value;
	}
	
	public function hasHelp()
	{
		return false;
	}
}
