<?php namespace Psimone\PlatformCore\Helpers;

use Illuminate\Support\Facades\URL;

class Timthumb {

        const PREFIX = 'static';

        public function link($path, $width, $height)
        {

                $url = array(self::PREFIX, $width, $height, $path);

                return URL::to(implode('/', $url));
        }

}
