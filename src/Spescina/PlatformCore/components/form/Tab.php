<?php namespace Spescina\PlatformCore\Components\Form;

use Spescina\PlatformCore\Components\Form\Form;
use Spescina\PlatformCore\Facades\Platform;
use Spescina\PlatformCore\Facades\Language;
use Spescina\PlatformCore\Interfaces\Displayable;
use Spescina\PlatformCore\Interfaces\Translatable;

class Tab implements Displayable, Translatable {

        use \Spescina\PlatformCore\Traits\Displayable;

use \Spescina\PlatformCore\Traits\Slugable;

        private $active;
        private $slug;
        private $view = 'components/form/tab';
        private $viewData = true;

        public function __construct($slug, $active = false)
        {
                $this->slug = $slug;

                $this->active = $active;
        }

        public function localize()
        {
                if ($this->slug === Form::MAIN)
                {
                        return Language::get('ui.main_panel');
                }
                else
                {
                        return Language::get(Platform::getModule() . '.panels.' . $this->slug);
                }
        }

        public function isActive()
        {
                return $this->active;
        }

}
