<?php namespace Spescina\PlatformCore\Components\Form\Fields;

use Spescina\PlatformCore\Components\Form\Fields\BaseField;

class Dropdown extends BaseField {

        protected $view = 'components/form/fields/dropdown';

        public function entries()
        {
                return $this->options['entries'];
        }

}
