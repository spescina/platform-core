<?php namespace Psimone\PlatformCore\Components\Form\Fields;

use Psimone\PlatformCore\Components\Form\Fields\BaseField;
use Spescina\Mediabrowser\Item;

class Media extends BaseField {

        protected $view = 'components/form/fields/media';
        
        public function icon()
        {
                return with(new Item($this->value()))->icon(90, 0);
        }
}
