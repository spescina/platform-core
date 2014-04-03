<?php namespace Psimone\PlatformCore\Components\MediaLibrary;

use Psimone\PlatformCore\Components\MediaLibrary\Item;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Facades\Platform;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class MediaLibrary {

        private $items = array();
        private $config;
        private $path;

        public function __construct()
        {
                $this->config = Config::get(Platform::getPackageName() . '::medialibrary');
        }

        /**
         * Return objects in the given path
         *
         * @param string $path
         * @return boolean
         */
        public function browsePath($path)
        {
                $realPath = public_path($path);

                if (!$this->validatePath($realPath))
                {
                        return false;
                }

                $this->path = $path;

                $folders = self::getFolders($realPath);

                $this->parseFolders($folders);

                $files = self::getFiles($realPath);

                $this->parseFiles($files);
        }

        /**
         * Return folders in path
         *
         * @param string $path
         * @return mixed
         */
        private static function getFolders($path)
        {
                return File::directories($path);
        }

        /**
         * Return files in path
         *
         * @param string $path
         * @return mixed
         */
        private static function getFiles($path)
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
         * Return the local config var in json notation
         * embeddable as a javascript config object
         *
         * @return json
         */
        public function configToJSON()
        {
                return json_encode($this->config());
        }

        /**
         * Set the config array of the component in the local var
         * 
         * @return array
         */
        public function config()
        {
                return $this->config;
        }

        /**
         * Add folders to the local item list
         * 
         * @param array $items
         */
        private function parseFolders($items)
        {
                foreach ($items as $item)
                {
                        $this->items[] = new Item($item, true);
                }
        }

        /**
         * Add files to the local item list
         * 
         * @param array $items
         */
        private function parseFiles($items)
        {
                foreach ($items as $item)
                {
                        $extension = self::extension($item);

                        if ($this->allowed($extension))
                        {
                                $this->items[] = new Item($item);
                        }
                }
        }

        /**
         * Return the local item list
         * 
         * @return array
         */
        public function getItems()
        {
                $items = array();

                if (!$this->isRoot())
                {
                        $items[] = new Item($this->parentFolder(), true, true);
                }

                $final = array_merge($items, $this->items);

                return $final;
        }

        /**
         * Return the type of the resource
         * 
         * @param string $path
         */
        static function extension($path)
        {
                return File::extension($path);
        }

        /**
         * Check if the resource is allowed
         * 
         * @return bool
         */
        private function allowed($extension)
        {
                $catalogType = $this->config['type'];

                if (in_array($extension, $this->config['types'][$catalogType]))
                {
                        return true;
                }

                return false;
        }

        /**
         * Check if the given path is the library root
         *
         * @return bool
         */
        private function isRoot()
        {
                if ($this->path === $this->config['basepath'])
                {
                        return true;
                }

                return false;
        }

        /**
         * Return the parent folder
         *
         * @return string
         */
        private function parentFolder()
        {
                if ($this->isRoot())
                {
                        return $this->config['basepath'];
                }

                $segments = $this->pathToArray($this->path);

                array_pop($segments);

                return $this->arrayToPath($segments);
        }

        /**
         * Convert given path in an array of segments
         *
         * @param string path
         * @returns array
         */
        private function pathToArray($path)
        {
                return explode('/', $path);
        }

        /**
         * Convert given array of segments in a path
         *
         * @param array segments
         * @returns string
         */
        private function arrayToPath($segments)
        {
                return implode('/', $segments);
        }

        /**
         * Return the localized requested string
         *
         * @param string $section
         * @return string
         */
        public function localize($section)
        {
                return Language::get('medialibrary.' . $section);
        }
        
        /**
         * Create a folder at the given path
         * 
         * @param string $path
         * @param string $folder
         * @return boolean
         */
        public function folderCreate($path, $folder)
        {
                $realPath = public_path($path . '/' . $folder);
                
                File::makeDirectory($realPath);
                
                return true;
        }
        
        /**
         * Delete the folder with the given path
         * 
         * @param string $folder
         * @return boolean
         */
        public function folderDelete($folder)
        {
                $realPath = public_path($folder);
                
                if (!File::isDirectory($realPath))
                {
                        return false;
                }
                
                File::deleteDirectory($realPath);
                
                return true;
        }
        
        /**
         * Delete the file with the given path
         * 
         * @param string $file
         * @return boolean
         */
        public function fileDelete($file)
        {
                $realPath = public_path($file);
                
                if (!File::isFile($realPath))
                {
                        return false;
                }
                
                File::delete($realPath);
                
                return true;
        }

}
