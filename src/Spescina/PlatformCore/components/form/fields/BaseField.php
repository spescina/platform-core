<?php namespace Spescina\PlatformCore\Components\Form\Fields;

use Spescina\PlatformCore\Components\Form\Label;
use Spescina\PlatformCore\Facades\Platform;
use Spescina\PlatformCore\Facades\Form;
use Spescina\PlatformCore\Facades\Language;
use Spescina\PlatformCore\Interfaces\Displayable;

abstract class BaseField implements Displayable {

        use \Spescina\PlatformCore\Traits\Displayable;

        use \Spescina\PlatformCore\Traits\Slugable;

        protected $help;
        protected $label;
        protected $options = array(
            'fieldWidth' => 4,
            'labelWidth' => 2
        );
        protected $slug;
        protected $viewData = true;

        public function __construct($slug, array $options)
        {
                $this->options($options);

                $this->label = new Label($slug, $this->options);

                $this->slug = $slug;
        }

        public function help()
        {
                return $this->help;
        }

        public function label()
        {
                return $this->label;
        }

        public function value()
        {
                if (!Form::isEmpty())
                {
                        return Form::record()->{$this->slug};
                }
                else
                {
                        return;
                }
        }

        public function hasHelp()
        {
                return false;
        }

        public function options(array $options)
        {
                $this->options = array_merge($this->options, $options);
        }

        public function width()
        {
                return $this->options['fieldWidth'];
        }

        public function localize($label)
        {
                $key = Platform::getModule() . '.form._labels_.' . $this->slug . '.' . $label;

                return Language::get($key);
        }

        public function equal($value)
        {
                return $this->value() == $value;
        }
        
        public function multiFieldData()
        {
                return Form::multiFieldData($this->slug);
        }

}
