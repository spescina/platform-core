<?php namespace Spescina\PlatformCore\Components\Task;

use Spescina\PlatformCore\Components\Action\Action;
use Spescina\PlatformCore\Facades\Language;
use Spescina\PlatformCore\Interfaces\Displayable;
use Spescina\PlatformCore\Interfaces\Translatable;

class Task implements Displayable, Translatable {

        use \Spescina\PlatformCore\Traits\Displayable;

use \Spescina\PlatformCore\Traits\Slugable;

        private $record;
        private $options = array();
        private $slug;
        private $view = 'components/task/task';
        private $viewData = true;
        static $opts = array('label', 'url', 'queryString', 'button', 'modal', 'color');

        public function __construct($slug, $url = null)
        {
                $this->slug = $slug;

                if (isset($url))
                {
                        $this->option('url', $url);
                }
        }

        public function record($record)
        {
                $this->record = $record;

                $this->options['id'] = $this->record->id;
        }

        public function localize()
        {
                if (array_key_exists('label', $this->options))
                {
                        return Language::get('tasks.' . $this->options['label']);
                }
                else
                {
                        return Language::get('tasks.' . $this->slug);
                }
        }

        public function color()
        {
                return isset($this->options['color']) ? $this->options['color'] : 'default';
        }

        public function modal()
        {
                return isset($this->options['modal']) ? $this->options['modal'] : null;
        }

        public function action()
        {
                return new Action($this->slug, $this->options);
        }

        public function option($option, $value)
        {
                if (in_array($option, self::$opts))
                {
                        $this->options[$option] = $value;
                }
        }

        public function button()
        {
                return (isset($this->options['button']) && $this->options['button']);
        }

        static function opts()
        {
                return self::$opts;
        }

}
