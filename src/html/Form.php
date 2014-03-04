<?php namespace Psimone\PlatformCore\Html;

use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Html\BaseComponent;

class Form extends BaseComponent {

	protected $view = 'html/form';
	
	private $fields;

	private $id;
	
	public function fields(array $fields)
	{
		$this->fields = $fields;
	}

	public function record()
	{
		return Model::find($this->id);
	}

	public function isEmpty()
	{
		return empty($this->id);
	}

	public function load($id)
	{
		if ($id)
		{
			$this->id = $id;

			$this->record();
		}
	}

}
