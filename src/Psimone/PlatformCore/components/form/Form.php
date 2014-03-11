<?php namespace Psimone\PlatformCore\Components\Form;

use Psimone\PlatformCore\Components\Action\Action;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Components\Form\Panel;
use Psimone\PlatformCore\Interfaces\Displayable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class Form implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	const MAIN = 'main';
	const ACTION = 'store';
	
	private $action;
	private $activePanel;
	private $allFields = array();
	private $id = null;
	private $panels = array();
	private $rules = array();
	private $view = 'components/form';
	private $viewData = false;
	
	public function __construct()
	{
		$this->panel(self::MAIN, true);
		$this->activePanel(self::MAIN);
	}

	public function fields(array $fields)
	{
		$this->allFields = $this->allFields + $fields;

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
	
	public function action()
	{
		if ( ! isset($this->action) )
		{
			$this->action = new Action(Action::ACTION_STORE, array('id' => $this->id));
		}
		
		return $this->action;
	}
	
	public function back()
	{
		return new Action(Action::ACTION_LISTING);
	}
	
	public function localize($section)
	{
		return Language::get('form.' . $section);
	}

	public function rules(array $rules = null)
	{
		if ($rules)
		{
			$this->rules = $rules;
		}
		else
		{
			return $this->rules;
		}
	}

	public function modelToDropdown($model, $labelField, $valueField = 'id', $nullable = true)
	{
		$collection = ($nullable) ? array('null' => '---') : array();

		foreach ($model as $record)
		{
			$collection[$record->$valueField] = $record->$labelField;
		}

		return $collection;
	}

	public function data()
	{
		$data = $this->fieldsData();

		$fixed = $this->fixCheckbox($data);

		return $fixed;
	}

	private function fieldsData()
	{
		return Input::except('save', 'save_back', 'files');
	}

	private function fixCheckbox($data)
	{
		$allFields = Session::get('formFields');
		
		foreach ($allFields as $field => $options)
		{
			if (!array_key_exists($field, $data))
			{
				if ($options['type'] === 'checkbox')
				{
					$data[$field] = 0;
				}
			}
		}

		return $data;
	}

	public function allFields()
	{
		return $this->allFields;
	}

}
