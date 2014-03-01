<?php namespace Psimone\PlatformCore\Repositories;

class FluentRepository implements RepositoryInterface {

	public $table;

	public function setTable($table)
	{
		$this->table = $table;
	}

	public function delete($id)
	{
		var_dump('delete ' . $id);
	}

	public function find($id)
	{
		var_dump('find ' . $id);
	}

	public function all()
	{
		return \DB::table($this->table)->get();
	}

	public function store($id = null)
	{
		if ($id)
		{
			var_dump('save ' . $id);
		}
		else
		{
			var_dump('create');
		}
	}

}
