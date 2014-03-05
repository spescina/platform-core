<?php namespace Psimone\PlatformCore\Html\Table;

use Psimone\PlatformCore\i18n\TranslatableInterface;

class Content implements TableCellInterface, TranslatableInterface 
{
	private $field;
	
	private $options;
	
	private $record;


	public function __construct($field, $record, array $options = array())
	{
		$this->field = $field;
		
		$this->options = $options;
		
		$this->record = $record;
	}
	
	public function show()
	{
		return $this->record->{$this->field};
	}
	
	public function i18n()
	{
		
	}
}
