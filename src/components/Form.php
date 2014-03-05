<?php namespace Psimone\PlatformCore\Components;

use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Components\Form\Panel;
use Psimone\PlatformCore\Interfaces\Displayable;

class Form implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	const _main_ = 'main';
	
	private $activePanel;
	private $id;
	private $panels = array();
	private $view = 'components/form';
	private $viewData = false;
	
	public function __construct()
	{
		$this->panel(self::_main_, true);
		$this->activePanel(self::_main_);
	}

	public function fields(array $fields)
	{
		$this->panels[$this->activePanel]->components($fields);
	}

	public function record()
	{
		return Model::find($this->id);
	}

	public function isEmpty()
	{
		return empty($this->id);
	}

	public function load($id)
	{
		if ($id)
		{
			$this->id = $id;

			$this->record();
		}
	}

	public function panel($slug, $active = false)
	{
		if (!array_key_exists($slug, $this->panels))
		{
			$this->panels[$slug] = new Panel($slug, $active);
		}
	}

	public function activePanel($slug)
	{
		$this->activePanel = $slug;
	}

	public function panels()
	{
		return $this->panels;
	}
}
