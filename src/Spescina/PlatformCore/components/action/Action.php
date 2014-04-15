<?php namespace Spescina\PlatformCore\Components\Action;

use Spescina\PlatformCore\Facades\Platform;
use Illuminate\Support\Facades\URL;

class Action {

        const ACTION_DELETE = 'delete';
        const ACTION_LISTING = 'listing';
        const ACTION_STORE = 'store';
        const ACTION_SHOWFORM = 'form';
        const ACTION_SEARCH = 'filter';

        private $options;
        private $type;

        public function __construct($type, array $options = array())
        {
                $this->options = $options;

                $this->type = $type;
        }

        public function url()
        {
                if (isset($this->options['url']))
                {
                        return $this->options['url'];
                }

                $id = array_key_exists('id', $this->options) ? $this->options['id'] : null;

                $queryString = array_key_exists('queryString', $this->options) ? $this->options['queryString'] : null;

                $url = URL::route('module', array(
                            Platform::getModule(),
                            $this->type,
                            $id
                ));

                if (count($queryString))
                {
                        $url .= '?' . http_build_query($queryString);
                }

                return $url;
        }

}
