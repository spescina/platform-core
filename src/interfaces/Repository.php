<?php namespace Psimone\PlatformCore\Interfaces;

interface Repository
{

	public function setTable($table);

	public function delete($id);

	public function find($id);

	public function all();

	public function store($id = null);
}
