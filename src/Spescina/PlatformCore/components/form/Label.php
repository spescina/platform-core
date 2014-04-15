<?php namespace Spescina\PlatformCore\Components\Form;

use Spescina\PlatformCore\Facades\Platform;
use Spescina\PlatformCore\Facades\Language;
use Spescina\PlatformCore\Interfaces\Displayable;
use Spescina\PlatformCore\Interfaces\Translatable;

class Label implements Displayable, Translatable {

        use \Spescina\PlatformCore\Traits\Displayable;

use \Spescina\PlatformCore\Traits\Slugable;

        private $options;
        private $slug;
        private $view = 'components/form/label';
        private $viewData = true;

        public function __construct($slug, $options)
        {
                $this->slug = $slug;

                $this->options = $options;
        }

        public function localize()
        {
                return Language::get(Platform::getModule() . '.form.' . $this->slug);
        }

        public function width()
        {
                return $this->options['labelWidth'];
        }

}
