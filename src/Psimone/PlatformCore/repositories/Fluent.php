<?php namespace Psimone\PlatformCore\Repositories;

use Psimone\PlatformCore\Platform as PlatformConst;
use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Facades\Order;
use Psimone\PlatformCore\Interfaces\Repository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Fluent implements Repository
{
	public $table;
	private $result;

	public function setTable($table)
	{
		$this->table = $table;
	}

	public function delete($id)
	{
		DB::table($this->table)
			->where('id', $id)
			->delete();
	}

	public function find($id)
	{
		if (empty($this->result))
		{
			$this->result = DB::table($this->table)
				->where('id', $id)
				->first();
		}

		return $this->result;
	}

	public function all()
	{
		return $this->result = DB::table($this->table)
			->orderBy(Order::column(), Order::sort())
			->paginate(Config::get(PlatformConst::PKG . '::table.pagination'));
	}

	public function store(array $data, $id = null)
	{
		if ($id)
		{
			DB::table($this->table)
				->where('id', $id)
				->update($data);
		}
		else
		{
			$id = DB::table($this->table)
				->insertGetId($data);
		}

		return $id;
	}

	public function entries($order)
	{
		list($column, $sort) = $order;

		return $this->result = DB::table($this->table)
			->orderBy($column, $sort)
			->get();
	}

}
