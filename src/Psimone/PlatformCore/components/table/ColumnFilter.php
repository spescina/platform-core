<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Components\Table\Table as TableConst;
use Psimone\PlatformCore\Facades\Filter;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class ColumnFilter implements Displayable, Translatable {

        use \Psimone\PlatformCore\Traits\Displayable;

        private $field;
        private $options;
        private $value;
        private $view = 'components/table/column-filter';
        private $viewData = true;

        public function __construct($field, array $options = array())
        {
                $this->field = $field;

                $this->options = $options;

                $this->fill();
        }

        public function isFilterable()
        {
                if ($this->isAction())
                {
                        return false;
                }

                if (array_key_exists('filterable', $this->options) && $this->options['filterable'] === false)
                {
                        return false;
                }

                return true;
        }

        public function isAction()
        {
                return ($this->field === TableConst::COLUMN_SEARCH);
        }

        public function field()
        {
                return $this->field;
        }

        public function value()
        {
                return $this->value;
        }

        public function localize()
        {
                if ($this->field === TableConst::COLUMN_SEARCH)
                {
                        return Language::get('table.' . TableConst::COLUMN_SEARCH);
                }

                return Language::get(Platform::getModule() . '.table.' . $this->field);
        }

        private function fill()
        {
                foreach (Filter::filters() as $field => $value)
                {
                        if ($this->field === $field)
                        {
                                $this->value = $value;

                                break;
                        }
                }
        }

}
