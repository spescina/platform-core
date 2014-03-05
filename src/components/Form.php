<?php namespace Psimone\PlatformCore\Components;

use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Components\Form\Panel;
use Psimone\PlatformCore\Interfaces\Displayable;

class Form implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $activePanel;
	private $fields;
	private $id;
	private $panels = array();
	private $view = 'components/form';
	private $viewData = false;

	public function fields(array $fields)
	{
		$this->fields = $fields;
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

		$this->panel('main');
	}

	public function panel($slug)
	{
		if (!array_key_exists($slug, $this->panels))
		{
			$this->panels[$slug] = new Panel($slug);
		}

		$this->activePanel($slug);
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
