<?php namespace Psimone\PlatformCore\Components;

use Psimone\PlatformCore\Action;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Interfaces\Displayable;
use Psimone\PlatformCore\Interfaces\Translatable;

class Task implements Displayable, Translatable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $action;
	private $record;
	private $options = array();
	private $slug;
	private $view = 'components/task';
	private $viewData = true;

	public function __construct($slug, $record = null, $translation_label = null)
	{
		$this->slug = $slug;
		
		if ($translation_label)
		{
			$this->options['translation_label'] = $translation_label;
		}
		
		if ($record)
		{
			$this->record = $record;
			
			$this->options['id'] = $this->record->id;
		}
		
		$this->action = new Action($slug, $this->options);
	}

	public function i18n()
	{
		if (array_key_exists('translation_label', $this->options))
		{
			return Language::get('actions.' . $this->options['translation_label']);
		}
		else
		{
			return Language::get('actions.' . $this->slug);
		}
	}

	public function hasModal()
	{
		return ($this->slug === Action::ACTION_DELETE);
	}
	
	public function action()
	{
		return $this->action;
	}
}
