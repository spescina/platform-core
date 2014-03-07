<?php namespace Psimone\PlatformCore\Models;

use Psimone\PlatformCore\Interfaces\Repository;

abstract class BaseModel
{
	private $source;

	public function __construct(Repository $source)
	{
		$this->source = $source;

		$this->source->setTable($this->table);
	}

	public function __call($name, $arguments)
	{
		return call_user_func_array(array($this->source, $name), $arguments);
	}
}
