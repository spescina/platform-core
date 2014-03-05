<?php namespace Psimone\PlatformCore\Html\Table;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Html\Table as TableClass;
use Psimone\PlatformCore\i18n\TranslatableInterface;
use Illuminate\Support\Facades\URL;

class Action implements TranslatableInterface
{
	private $slug;
	private $record;

	public function __construct($slug, $record)
	{
		$this->slug = $slug;

		$this->record = $record;
	}

	public function i18n()
	{
		return Language::get('listing.action' . $this->slug);
	}

	public function url()
	{
		switch ($this->slug)
		{
			case TableClass::editAction:
				$method = 'form';
				break;

			case TableClass::deleteAction:
				$method = 'delete';
				break;

			case TableClass::copyAction:
				$method = 'copy';
				break;
		}

		return URL::route('module', array(
				'module' => Application::module(),
				'action' => $method,
				'id' => $this->record->id
		));
	}

	public function slug()
	{
		return $this->slug;
	}
}
