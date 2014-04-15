<?php namespace Spescina\PlatformCore\Components\Navigation;

use Spescina\PlatformCore\Facades\Language;
use Spescina\PlatformCore\Interfaces\Displayable;
use Spescina\PlatformCore\Interfaces\Translatable;
use Illuminate\Support\Facades\URL;

class Item implements Displayable, Translatable {

        use \Spescina\PlatformCore\Traits\Displayable;

        private $children = array();
        private $slug;
        private $url;
        private $view = 'components/navigation/item';
        private $viewData = true;

        public function __construct($slug, $url)
        {
                $this->slug = $slug;

                if (is_array($url) && array_key_exists('__childrens__', $url))
                {
                        foreach ($url['__childrens__'] as $childSlug => $childUrl)
                        {
                                $this->child($childSlug, $childUrl);
                        }
                }
                else
                {
                        $this->url = $url;
                }
        }

        public function localize()
        {
                return Language::get('navigation.' . $this->slug);
        }

        public function child($childSlug, $childUrl)
        {
                $this->children[] = new Item($childSlug, $childUrl);
        }

        public function children()
        {
                return $this->children;
        }

        public function url()
        {
                return URL::route('module', $this->url);
        }

}
