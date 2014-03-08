<?php namespace Psimone\PlatformCore;

use Psimone\PlatformCore\Facades\Application as Platform;
use Illuminate\Support\Facades\URL;

class Action
{
	const ACTION_DELETE = 'delete';
	const ACTION_LISTING = 'listing';
	const ACTION_STORE = 'store';
	const ACTION_SHOWFORM = 'form';
	
	private $options;
	private $type;
	
	public function __construct($type, array $options = array())
	{
		$this->options = $options;
		
		$this->type = $type;
	}
	
	public function url()
	{
		$id = array_key_exists('id', $this->options) ? $this->options['id'] : null;
		
		return URL::route('module', array(
			Platform::module(),
			$this->type,
			$id
		));
	}
}
