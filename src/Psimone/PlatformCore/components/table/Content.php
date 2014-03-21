<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class Content implements Displayable, Translatable {

        use \Psimone\PlatformCore\Traits\Displayable;

        private $field;
        private $options;
        private $record;
        private $view = 'components/table/content';
        private $viewData = true;

        public function __construct($field, $record, array $options = array())
        {
                $this->field = $field;

                $this->options = $options;

                $this->record = $record;
        }

        public function localize()
        {
                
        }

        public function content()
        {
                return $this->record->{$this->field};
        }

}
