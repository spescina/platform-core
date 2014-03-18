<?php namespace Psimone\PlatformCore\Components\MediaLibrary;

use Psimone\PlatformCore\Facades\Medialibrary;

class Item
{
	/**
	 * Public path of the resource
	 * 
	 * @var string
	 */
	public $path;

	/**
	 * Resource name
	 * 
	 * @var string
	 */
	public $name;
	
	/**
	 * Resource extension
	 * 
	 * @var string
	 */
	public $extension;

	/**
	 * Folder flag. True if the resource is a folder
	 * 
	 * @var bool 
	 */
	public $folder;

	/**
	 * Setup of the resource
	 * 
	 * @param string $fullPath
	 * @param bool $folder
	 */
	public function __construct($fullPath, $folder = false)
	{
		$this->path = $this->extractPublicPath($fullPath);

		$this->name = $this->extractName($fullPath);
		
		$this->extension = Medialibrary::extension($fullPath);

		$this->folder = $folder;
	}

	/**
	 * Return only the file|folder name
	 * 
	 * @param string $path
	 * @return string
	 */
	private function extractName($path)
	{
		$segments = explode('/', $path);

		return array_pop($segments);
	}

	/**
	 * Remove the server private path from the full path of the resource
	 * 
	 * @param string $path
	 * @return string
	 */
	private function extractPublicPath($path)
	{
		$config = Medialibrary::config();

		$rootPath = public_path($config['basepath']);

		$rootNode = self::pathToArray($rootPath);

		$pathNode = self::pathToArray($path);

		$diff = array_diff($pathNode, $rootNode);

		$relativePath = array($config['basepath']);

		$final = array_merge($relativePath, $diff);

		return implode('/', $final);
	}

	/**
	 * Convert the path in array splitted by the forward slash separator
	 * 
	 * @param string $path
	 * @return array
	 */
	static function pathToArray($path)
	{
		return explode('/', $path);
	}
}
