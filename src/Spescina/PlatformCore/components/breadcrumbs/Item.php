<?php namespace Spescina\PlatformCore\Components\Breadcrumbs;

use Spescina\PlatformCore\Facades\Language;
use Spescina\PlatformCore\Interfaces\Displayable;
use Spescina\PlatformCore\Interfaces\Translatable;

class Item implements Displayable, Translatable {

        use \Spescina\PlatformCore\Traits\Displayable;

        private $slug;
        private $view = 'components/breadcrumbs/item';
        private $viewData = true;

        public function __construct($slug)
        {
                $this->slug = $slug;
        }

        public function localize()
        {
                if ($this->isRoot())
                {
                        return Language::get('breadcrumbs.root');
                }
                else
                {
                        return Language::get($this->slug . '.section.title');
                }
        }

        public function isRoot()
        {
                return ($this->slug === 'root');
        }

}
