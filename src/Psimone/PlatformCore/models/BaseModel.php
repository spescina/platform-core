<?php namespace Psimone\PlatformCore\Models;

use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Interfaces\Repository;
use Psimone\PlatformCore\Repositories\Fluent;
use Illuminate\Support\Facades\Config;

abstract class BaseModel
{
	private $source;

	public function __construct(Repository $source = null)
	{
		if ( ! isset($source) )
		{
			$driver = 'Psimone\PlatformCore\\Repositories\\' . ucfirst(Config::get(Platform::pkg() . '::database.driver'));

			$source = new $driver;
		}

		$this->source = $source;

		$this->source->setTable($this->table);
	}

	public function __call($method, $parameters)
	{
		return call_user_func_array(array($this->source, $method), $parameters);
	}

	public static function __callStatic($method, $parameters)
	{
		$instance = new static;

		return call_user_func_array(array($instance, $method), $parameters);
	}
}
