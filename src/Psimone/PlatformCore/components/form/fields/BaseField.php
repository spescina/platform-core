<?php namespace Psimone\PlatformCore\Components\Form\Fields;

use Psimone\PlatformCore\Components\Form\Label;
use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Facades\Form;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Interfaces\Displayable;

abstract class BaseField implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	use \Psimone\PlatformCore\Traits\Slugable;
	
	protected $help;
	protected $label;
	protected $options = array(
		'fieldWidth' => 4,
		'labelWidth' => 2
	);
	protected $slug;
	protected $viewData = true;
	
	public function __construct($slug,array $options)
	{
		$this->options($options);
		
		$this->label = new Label($slug, $this->options);
		
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
		if ( ! Form::isEmpty() )
		{
			return Form::record()->{$this->slug};
		}
		else
		{
			return;
		}
	}
	
	public function hasHelp()
	{
		return false;
	}
	
	public function options(array $options)
	{
		$this->options = array_merge($this->options, $options);
	}
	
	public function width()
	{
		return $this->options['fieldWidth'];
	}

	public function i18n($label)
	{
		$key = Platform::module() . '.form._labels_.' . $this->slug . '.' . $label;

		return Language::get($key);
	}

	public function equal($value)
	{
		return $this->value() == $value;
	}
}
