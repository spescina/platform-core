<?php namespace Spescina\PlatformCore\Components\Navigation;

use Spescina\PlatformCore\Components\Navigation\Item;
use Spescina\PlatformCore\Facades\Platform;
use Spescina\PlatformCore\Interfaces\Displayable;
use Illuminate\Support\Facades\Config;

class Navigation implements Displayable {

        use \Spescina\PlatformCore\Traits\Displayable;

        private $items = array();
        private $view = 'components/navigation/navigation';
        private $viewData = false;

        public function load()
        {
                $items = Config::get(Platform::getPackageName() . '::navigation');

                foreach ($items as $slug => $url)
                {
                        $this->item($slug, $url);
                }
        }

        public function item($slug, $url)
        {
                if (!array_key_exists($slug, $this->items))
                {
                        $this->items[$slug] = new Item($slug, $url);
                }
        }

        public function items()
        {
                return $this->items;
        }

}
