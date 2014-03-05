<?php namespace Psimone\PlatformCore\i18n;

use Psimone\PlatformCore\Application;
use Illuminate\Support\Facades\Lang;

class Language
{
	const _ns_ = 'platform-core-custom';

	public function get($key, array $replace = array(), $locale = null)
	{
		if (Lang::has($this->namespaced($key, true)))
		{
			return Lang::get($this->namespaced($key, true), $replace, $locale);
		}
		else
		{
			return Lang::get($this->namespaced($key), $replace, $locale);
		}
	}

	public function has($key, $locale = null)
	{
		if (Lang::has($this->namespaced($key, true), $locale))
		{
			return true;
		}
		else
		{
			return Lang::has($this->namespaced($key), $locale);
		}
	}
	
	public function namespaced($key, $custom = false)
	{
		if ($custom)
		{
			return self::_ns_ . '::' . $key;
		}
		else
		{
			return Application::_pkg_ . '::' . $key;
		}
	}
}
