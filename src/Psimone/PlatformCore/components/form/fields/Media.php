<?php namespace Psimone\PlatformCore\Components\Form\Fields;

use Psimone\PlatformCore\Components\Form\Fields\BaseField;
use Spescina\Mediabrowser\Item;

class Media extends BaseField {

        protected $view = 'components/form/fields/media';
        
        public function thumb()
        {
                return with(new Item($this->value()))->thumbUrl(90, 0);
        }
}
