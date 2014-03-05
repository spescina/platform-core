<?php namespace Psimone\PlatformCore\Html;

use Illuminate\Support\Facades\View;

abstract class BaseComponent {

	protected $vars = array();
	protected $view;

	public function getView()
	{
		return 'platform-core::' . $this->view;
	}

	public function addVar($key, $value)
	{
		if ( ! array_key_exists($key, $this->vars))
		{
			$this->vars[$key] = $value;
		}
		else
		{
			throw new Exception;
		}
	}

	public function show()
	{
		return View::make($this->getView())
			->with('vars', $this->vars);
	}

}
