<?php namespace Psimone\PlatformCore\Models;

use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Interfaces\Repository;
use Illuminate\Support\Facades\Config;

abstract class BaseModel {

        private $source;
        protected $order = array('id', 'desc');

        public function __construct(Repository $source = null)
        {
                if (!isset($source))
                {
                        $driver = 'Psimone\PlatformCore\\Repositories\\' . ucfirst(Config::get(Platform::getPackageName() . '::database.driver'));

                        $source = new $driver;
                }

                $this->source = $source;

                $this->setTable($this->table);
        }

        public function __call($method, $parameters)
        {
                if (!method_exists($this, $method))
                {
                        return call_user_func_array(array($this->source, $method), $parameters);
                }
                else
                {
                        return $this->$method();
                }
        }

        public static function __callStatic($method, $parameters)
        {
                $instance = new static;

                return call_user_func_array(array($instance, $method), $parameters);
        }

        public function order()
        {
                return $this->order;
        }

        public function entries()
        {
                return $this->source->entries($this->order);
        }
        
        public function sync($id, $multifields, $data)
        {
                foreach ($multifields as $field => $options)
                {
                        if (method_exists($this, $field))
                        {
                                $vals = isset($data['multi_' . $field]) ? $data['multi_' . $field] : array();
                                
                                self::syncPivot($id, $vals, $this->$field());
                        }
                }
                
                return true;
        }
        
        public function pivot($id, $field)
        {
                if (method_exists($this, $field))
                {
                        return self::getPivot($id, $this->$field());
                }
                
                return false;
        }

}
