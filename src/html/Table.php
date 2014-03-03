<?php namespace Psimone\PlatformCore\Html;

use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Html\BaseComponent;

class Table extends BaseComponent {

	protected $view = 'html/table';
	
	public function load()
	{
		$results = Model::all();
		
		$this->addVar('results', $results);
	}

}
