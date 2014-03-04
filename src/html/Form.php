<?php namespace Psimone\PlatformCore\Html;

use Psimone\PlatformCore\Html\BaseComponent;

class Form extends BaseComponent {

	protected $view = 'form';
	
	private $fields;
	
	public function fields(array $fields)
	{
		$this->fields = $fields;
	}

}
