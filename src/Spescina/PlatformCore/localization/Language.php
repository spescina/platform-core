<?php namespace Spescina\PlatformCore\Localization;

use Spescina\PlatformCore\Facades\Platform;
use Illuminate\Support\Facades\Lang;

class Language {

        const NS = 'platform-core-custom';

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
                        return self::NS . '::' . $key;
                }
                else
                {
                        return Platform::getPackageName() . '::' . $key;
                }
        }

}
