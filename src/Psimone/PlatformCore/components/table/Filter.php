<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Action;
use Psimone\PlatformCore\Action as ActionConst;
use Psimone\PlatformCore\Facades\Platform;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class Filter {
	
	const RESET_PARAM = 'remove';

	public $filters = array();
	public $module;
	private $tasks = array();
	
	public function __construct()
	{
		$prevFilter = $this->get();
		
		if ($prevFilter && $prevFilter->applicable())
		{
			if ($prevFilter) {
				$this->filters = $prevFilter->filters();

				$this->module = $prevFilter->module();
			}
		}
		else
		{
			$this->forget();
		}
	}
	
	public function hasFilters()
	{
		return (count($this->filters) > 0);
	}

	private function reset()
	{
		$reset = Input::get(self::RESET_PARAM);

		if ($reset)
		{
			$this->forget();
			
			return true;
		}
		
		return false;
	}
	
	private function forget()
	{
		Session::forget('tableFilter');
	}

	private function get()
	{
		return Session::get('tableFilter');
	}

	private function put()
	{
		Session::put('tableFilter', $this);
	}

	private function set(array $filters, $module = null)
	{
		$this->filters = $filters;

		if ($module)
		{
			$this->module = $module;
		}
		else
		{
			$this->module = Platform::module();
		}
	}

	public function filters()
	{
		return $this->filters;
	}
	
	public function module()
	{
		return $this->module;
	}
	
	public function load($filters)
	{
		$reset = $this->reset();
		
		if (!$reset)
		{
			$this->set($filters);

			$this->put();
		}
	}
	
	public function applicable()
	{
		return ($this->module === Platform::module());
	}
	
	public function tasks()
	{
		return $this->tasks = array(
			'apply' => array(
				'action' => ActionConst::ACTION_SEARCH,
				'label' => 'search.apply',
				'button' => true,
				'color' => 'success'
			),
			'clear' => array(
				'action' => ActionConst::ACTION_SEARCH,
				'label' => 'search.clear',
				'queryString' => array(self::RESET_PARAM => 1),
				'color' => 'success'
			)
		);
	}
}
