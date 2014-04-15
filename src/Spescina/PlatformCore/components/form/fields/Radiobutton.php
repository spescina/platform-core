<?php namespace Spescina\PlatformCore\Components\Form\Fields;

use Spescina\PlatformCore\Components\Form\Fields\BaseField;

class Radiobutton extends BaseField {

        protected $view = 'components/form/fields/radiobutton';

        public function entries()
        {
                return $this->options['entries'];
        }

}
