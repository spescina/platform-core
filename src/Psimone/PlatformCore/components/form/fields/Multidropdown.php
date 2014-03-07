<?php namespace Psimone\PlatformCore\Components\Form\Fields;

use Psimone\PlatformCore\Components\Form\Fields\BaseField;

class Multidropdown extends BaseField
{
	protected $view = 'components/form/fields/multidropdown';

	public function entries()
	{
		return $this->options['entries'];
	}
}



