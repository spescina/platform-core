<?php namespace Psimone\PlatformCore\Components\MediaLibrary;

use Psimone\PlatformCore\Components\MediaLibrary\Item;
use Psimone\PlatformCore\Facades\Platform;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class MediaLibrary
{
	private $items = array();
	private $config;

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
		return $this->items;
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
}
