<?php namespace Psimone\PlatformCore;

use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Facades\Platform;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class Order {

	const COLUMN_PARAM = 'column';
	const SORT_PARAM = 'sort';
	const RESET_PARAM = 'reset';

	public $column;
	public $sort;
	public $module;

	public function __construct()
	{
		$newColumn = Input::get(self::COLUMN_PARAM);
		$newSort = Input::get(self::SORT_PARAM);

		$this->reset();

		if ($newColumn && $newSort)
		{
			$this->set($newColumn, $newSort);

			$this->put();
		}
		else
		{
			$prevTableSort = $this->get();

			if ($prevTableSort && $prevTableSort->module <> Platform::module())
			{
				$this->forget();

				$this->base();
			}
			else
			{
				if (!$prevTableSort)
				{
					$this->base();
				}
				else
				{
					$this->set($prevTableSort->column, $prevTableSort->sort, $prevTableSort->module);
				}
			}
		}
	}

	private function base()
	{
		list($column, $sort) = Model::order();

		$this->set($column, $sort);
	}

	public function isBase()
	{
		list($column, $sort) = Model::order();

		if ($column === $this->column && $sort === $this->sort)
		{
			return true;
		}

		return false;
	}

	private function reset()
	{
		$reset = Input::get(self::RESET_PARAM);

		if ($reset)
		{
			$this->forget();
		}
	}
	
	private function forget()
	{
		Session::forget('tableSort');
	}

	private function get()
	{
		return Session::get('tableSort');
	}

	private function put()
	{
		Session::put('tableSort', $this);
	}

	private function set($column, $sort, $module = null)
	{
		$this->column = $column;

		$this->sort = $sort;

		if ($module)
		{
			$this->module = $module;
		}
		else
		{
			$this->module = Platform::module();
		}
	}

	public function column()
	{
		return $this->column;
	}

	public function sort()
	{
		return $this->sort;
	}

}
