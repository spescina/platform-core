<?php namespace Psimone\PlatformCore\Html;

use Psimone\PlatformCore\Facades\Application;
use Illuminate\Support\Facades\View;

abstract class BaseComponent {

	protected $view;

	public function show() {
		return View::make($this->getView());
	}

	public function getView() {
		return Application::getNamespace() . $view;
	}

}
