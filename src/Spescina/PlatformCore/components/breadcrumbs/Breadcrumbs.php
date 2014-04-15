<?php namespace Spescina\PlatformCore\Components\Breadcrumbs;

use Spescina\PlatformCore\Facades\Platform;
use Spescina\PlatformCore\Components\Breadcrumbs\Item;
use Spescina\PlatformCore\Interfaces\Displayable;

class Breadcrumbs implements Displayable {

        use \Spescina\PlatformCore\Traits\Displayable;

        private $items = array();
        private $view = 'components/breadcrumbs/breadcrumbs';
        private $viewData = false;

        public function load()
        {
                $this->item('root');

                $this->item(Platform::getModule());
        }

        public function item($slug)
        {
                if (!array_key_exists($slug, $this->items))
                {
                        $this->items[$slug] = new Item($slug);
                }
        }

        public function items()
        {
                return $this->items;
        }

}
