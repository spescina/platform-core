<?php namespace Psimone\PlatformCore\Components\Page;

use Psimone\PlatformCore\Components\Task\Taskbar;
use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Facades\Language;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Page
{
	private $errors = array();
	private $messages = array();
	private $toolbar;
	
	public function __construct()
	{
		$this->toolbar = new Taskbar(array(), array('classes' => 'pull-right'));
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
		
			return View::make(Platform::pkg() . '::page/errors')
				->with('items', $this->errors)
				->render();
		}
	}
	
	public function messages()
	{
		if ($this->hasMessages()) {
			$this->messages = Session::get('messages');

			return View::make(Platform::pkg() . '::page/messages')
				->with('items', $this->messages)
				->render();
		}
	}
	
	public function toolbar()
	{
		return $this->toolbar;
	}
	
	public function localize($section)
	{
		return Language::get(Platform::module() . '.section.' . $section);
	}
	
	public function localize_ui($element, $section = 'ui')
	{
		return Language::get($section . '.' . $element);
	}	
}
