<?php namespace Spescina\PlatformCore\Components\Form;

use Spescina\PlatformCore\Components\Action\Action;
use Spescina\PlatformCore\Facades\Language;
use Spescina\PlatformCore\Facades\Model;
use Spescina\PlatformCore\Components\Form\Panel;
use Spescina\PlatformCore\Interfaces\Displayable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class Form implements Displayable {

        use \Spescina\PlatformCore\Traits\Displayable;

        const MAIN = 'main';
        const ACTION = 'store';

        private $action;
        private $activePanel;
        private $allFields = array();
        private $id = null;
        private $panels = array();
        private $rules = array();
        private $view = 'components/form/form';
        private $viewData = false;

        public function __construct()
        {
                $this->panel(self::MAIN, true);
                $this->activePanel(self::MAIN);
        }

        /**
         * Add an array of fields to the form
         *
         * @param array $fields
         */
        public function fields(array $fields)
        {
                $this->allFields = $this->allFields + $fields;

                $this->panels[$this->activePanel]->components($fields);
        }

        /**
         * Return the record binded to the form
         *
         * @return Model
         */
        public function record()
        {
                return Model::find($this->id);
        }

        /**
         * Check if the form is an empty form (create) or a filled one (edit)
         *
         * @return bool
         */
        public function isEmpty()
        {
                return empty($this->id);
        }

        /**
         * If exists load the record in the model
         *
         * @param int $id
         */
        public function load($id)
        {
                if ($id)
                {
                        $this->id = $id;

                        $this->record();
                }
        }

        /**
         * Add a tab panel to the form
         *
         * @param string $slug
         * @param bool $active
         */
        public function panel($slug, $active = false)
        {
                if (!array_key_exists($slug, $this->panels))
                {
                        $this->panels[$slug] = new Panel($slug, $active);
                }
        }

        /**
         * Set the active panel on the form
         *
         * @param string $slug
         */
        public function activePanel($slug)
        {
                $this->activePanel = $slug;
        }

        /**
         * Return all tab panels in the form
         *
         * @return array
         */
        public function panels()
        {
                return $this->panels;
        }

        /**
         * Set the action in the form
         *
         * @return string
         */
        public function action()
        {
                if (!isset($this->action))
                {
                        $this->action = new Action(Action::ACTION_STORE, array('id' => $this->id));
                }

                return $this->action;
        }

        /**
         * Create the back button action
         *
         * @return \Spescina\PlatformCore\Components\Action\Action
         */
        public function back()
        {
                return new Action(Action::ACTION_LISTING);
        }

        /**
         * Return the localized string
         *
         * @param string $section
         * @return string
         */
        public function localize($section)
        {
                return Language::get('form.' . $section);
        }

        /**
         * Validation rules setup
         *
         * @param array $rules
         * @return type
         */
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

        /**
         * Convert a collection in a dropdown oriented collection
         *
         * @param Model $model
         * @param string $labelField
         * @param string $valueField
         * @param bool $nullable
         * @return Collection type
         */
        public function modelToDropdown($model, $labelField, $valueField = 'id', $nullable = true)
        {
                $collection = ($nullable) ? array('null' => '---') : array();

                foreach ($model as $record)
                {
                        $collection[$record->$valueField] = $record->$labelField;
                }

                return $collection;
        }
        
        /**
         * Convert a collection in a multi list oriented collection
         *
         * @param Model $model
         * @param string $labelField
         * @param string $valueField
         * @return Collection type
         */
        public function modelToList($model, $labelField, $valueField = 'id')
        {
                $collection = array();

                foreach ($model as $record)
                {
                        $item = new \stdClass;
                        
                        $item->value = $record->$valueField;
                        $item->label = $record->$labelField;
                        
                        $collection[] = $item;
                }

                return $collection;
        }

        /**
         * Return the fixed data taken from post
         *
         * @return array
         */
        public function data()
        {
                $data = $this->fieldsData();

                $fixed = $this->fixCheckbox($data);
                
                $clean = $this->filterData($fixed);

                return $clean;
        }

        /**
         * Filter out buttons var from post data
         *
         * @return array
         */
        private function fieldsData()
        {
                return Input::except('save', 'save_back', 'files', '_token');
        }

        /**
         * Return fixed data taken from checkbox fields
         *
         * @param array $data
         * @return array
         */
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

        /**
         * Return all fields from the form
         *
         * @return array
         */
        public function allFields()
        {
                return $this->allFields;
        }
        
        /**
         * Filter data
         * 
         * @return array
         */
        public function filterData(array $data)
        {
                $data = $this->filterOutMulti($data);
                
                return $data;
        }
        
        /**
         * Filter out multi field related input data
         * 
         * @param array $data
         * @return array
         */
        public function filterOutMulti(array $data)
        {
                foreach ($this->multiFields() as $field => $options)
                {
                        unset($data['multi_' . $field]);
                }
                
                return $data;
        }
        
        /**
         * Keep only multi field related input data
         * 
         * @param array $data
         * @return array
         */
        public function filterOnlyMulti()
        {
                $multiFields = $this->multiFields();
                
                $data = $this->fieldsData();
                
                foreach ($data as $field => $value)
                {
                        $name = $this->cleanMultiFieldName($field);
                        
                        if (!array_key_exists($name, $multiFields)) {
                                unset($data[$field]);
                        }
                }
                
                return $data;
        }
        
        public function cleanMultiFieldName($field)
        {
                $prefix = 'multi_';
                
                if (substr($field, 0, strlen($prefix)) == $prefix) {
                        $field = substr($field, strlen($prefix));
                }
                
                return $field;
        }
        
        public function multiFields()
        {
                $fields = $this->mapToAllFields(function($field, $options) {
                        if ($options['type'] === 'multi') {
                                return true;
                        }
                        
                        return false;
                });
                
                return $fields;
        }
        
        private function mapToAllFields($callback)
        {
                $fields = array();
                
                foreach ($this->allFields as $field => $options)
                {
                        if (call_user_func_array($callback, array($field, $options))) {
                                $fields[$field] = $options;
                        }
                }
                
                return $fields;
        }
        
        public function getFieldsFromSession()
        {
                $this->allFields = Session::get('formFields');
        }
        
        public function putFieldsInSession()
        {
                Session::put('formFields', $this->allFields);
        }
        
        public function multiFieldData($field)
        {
                return Model::pivot($this->id, $field);
        }
}
