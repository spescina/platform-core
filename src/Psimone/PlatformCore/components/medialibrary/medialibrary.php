<?php namespace Psimone\PlatformCore\Components\MediaLibrary;

use Psimone\PlatformCore\Facades\Platform;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class MediaLibrary {

        /**
         * Return objects in the given path
         *
         * @param string $path
         * @return boolean
         */
        public function browse($path)
        {
                $realPath = public_path($path);
                
                if (!$this->validatePath($realPath)) {
                        return false;
                }

                $folders = $this->getFolders($realPath);

                $files = $this->getFiles($realPath);

                $items = array_merge($folders,$files);

                return $items;
        }

        /**
         * Return folders in path
         *
         * @param string $path
         * @return mixed
         */
        private function getFolders($path)
        {
                return File::directories($path);
        }

        /**
         * Return files in path
         *
         * @param string $path
         * @return mixed
         */
        private function getFiles($path)
        {
                return File::files($path);
        }

        /**
         * Checl if the given path passes the filesystem validation
         *
         * @param string $path
         * @return boolean
         */
        private function validatePath($path)
        {
                if (!File::exists($path))
                {
                        return false;
                }

                if (!File::isDirectory($path))
                {
                        return false;
                }

                return true;
        }

        /**
         * Return the config object of the component in json notation
         * embeddable as a javascript config object
         *
         * @return json
         */
        public function config()
        {
                $config = Config::get(Platform::getPackageName() . '::medialibrary');

                return json_encode($config);
        }

}
