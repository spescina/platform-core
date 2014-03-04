<?php namespace Psimone\PlatformCore\Repositories;

use Illuminate\Support\Facades\DB;

class FluentRepository implements RepositoryInterface {

	public $table;
	
	private $result;

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
		if ( empty($this->result) ) 
		{
			$this->result = DB::table($this->table)->where('id', $id)->first();
		}
		
		return $this->result;
	}

	public function all()
	{
		if ( ! is_array($this->result) ) 
		{
			$this->result = DB::table($this->table)->get();
		}
		
		return $this->result;
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
