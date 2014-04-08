<?php namespace Psimone\PlatformCore\Components\Form\Fields;

use Psimone\PlatformCore\Components\Form\Fields\BaseField;

class Multi extends BaseField {

        protected $view = 'components/form/fields/multi';
        
        public function entries()
        {
                return $this->options['entries'];
        }
        
        public function value()
        {
                return array(1,3);
        }

}
