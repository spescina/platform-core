<?php namespace Psimone\PlatformCore;

use Psimone\PlatformCore\Application as PKG;
use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Language;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Page
{
	private $errors = array();
	private $messages = array();
	
	public function __construct()
	{
		
	}
	
	public function hasErrors()
	{
		return Session::has('errors');
	}
	
	public function hasMessages()
	{
		return Session::has('messages');
	}
	
	public function errors()
	{
		if ($this->hasErrors()) {
			$this->errors = Session::get('errors')->all();
		
			return View::make(PKG::NAME . '::page/errors')
				->with('items', $this->errors)
				->render();
		}
	}
	
	public function messages()
	{
		if ($this->hasMessages()) {
			$this->messages = Session::get('messages');

			return View::make(PKG::NAME . '::page/messages')
				->with('items', $this->messages)
				->render();
		}
	}
	
	public function i18n($section)
	{
		return Language::get(Application::module() . '.section.' . $section);
	}
	
	public function i18n_ui($element, $section = 'ui')
	{
		return Language::get($section . '.' . $element);
	}
}
