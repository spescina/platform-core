<?php namespace Spescina\PlatformCore\Components\Form;

use Spescina\PlatformCore\Components\Form\Form;
use Spescina\PlatformCore\Components\Form\Tab;
use Spescina\PlatformCore\Interfaces\Displayable;

class Panel implements Displayable {

        use \Spescina\PlatformCore\Traits\Displayable;

use \Spescina\PlatformCore\Traits\Slugable;

        const NS = 'Spescina\\PlatformCore\\Components\\Form\\Fields\\';

        private $fields = array();
        private $slug;
        private $tab;
        private $view = 'components/form/panel';
        private $viewData = true;

        public function __construct($slug, $active = false)
        {
                $this->slug = $slug;

                $this->tab = new Tab($slug, $active);
        }

        public function isMain()
        {
                return ($this->slug === Form::MAIN);
        }

        public function components(array $fields)
        {
                foreach ($fields as $field => $options)
                {
                        $fieldType = self::NS . ucfirst($options['type']);

                        $this->fields[$field] = new $fieldType($field, $options);
                }
        }

        public function fields()
        {
                return $this->fields;
        }

        public function tab()
        {
                return $this->tab;
        }

}
