<?php namespace Psimone\PlatformCore\Components;

use Psimone\PlatformCore\Facades\Controller;
use Illuminate\Support\Facades\App;

class Platform {

        const PKG = 'platform-core';
        const VND = 'psimone';

        /**
         * The current loaded module
         *
         * @var int
         */
        private $module;

        /**
         * Returns the module package folder
         *
         * @return string
         */
        public function getPackageName()
        {
                return self::PKG;
        }

        /**
         * Returns the module vendor folder
         *
         * @return string
         */
        public function getPackageVendor()
        {
                return self::VND;
        }

        /**
         * Returns the current loaded module
         *
         * @return string
         */
        public function getModule()
        {
                return $this->module;
        }

        /**
         * Sets the current loaded module
         *
         * @param string $module
         */
        public function setModule($module)
        {
                $this->module = $module;
        }

        /**
         * Registers the current Model and the current Controllers to the IoC.
         * Required for theirs facades
         */
        public function registerModuleFacades()
        {
                $className = ucfirst($this->module);

                App::bind('platform.core.module.model', function() use ($className) {
                        $modelName = 'Psimone\\PlatformCore\\Models\\' . $className;

                        return new $modelName;
                });

                App::singleton('platform.core.module.controller', function() use ($className) {
                        $controllerName = 'Psimone\\PlatformCore\\Controllers\\' . $className . 'Controller';

                        return new $controllerName;
                });
        }

        /**
         * Boot the application
         *
         * @param string $module
         * @param string $action
         * @param int $id
         * @return Illuminate\Http\Response
         */
        public function runModule($module, $action, $id)
        {
                $this->setModule($module);

                $this->registerModuleFacades();

                return Controller::$action($id);
        }

}
