<?php namespace Spescina\PlatformCore\Components\Form\Fields;

use Spescina\PlatformCore\Components\Form\Fields\BaseField;

class Multi extends BaseField {
        
        private $value;

        protected $view = 'components/form/fields/multi';
        
        public function entries()
        {
                return $this->options['entries'];
        }
        
        public function value()
        {
                if (!is_array($this->value)) {
                        $this->value = $this->multiFieldData();
                }
                
                return $this->value;
        }

}
