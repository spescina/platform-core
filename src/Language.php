<?php namespace Psimone\PlatformCore;

use Illuminate\Support\Facades\Lang;

class Language {

	private $packageName = 'platform-core';

	public function get($key, array $replace = array(), $locale = null)
	{
		if (Lang::has($key))
		{
			return Lang::get($key, $replace, $locale);
		}
		else
		{
			return Lang::get($this->packageName . '::' . $key, $replace, $locale);
		}
	}

	public function has($key, $locale = null)
	{
		if (Lang::has($key, $locale))
		{
			return true;
		}
		else
		{
			return Lang::has($this->packageName . '::' . $key, $locale);
		}
	}

}
