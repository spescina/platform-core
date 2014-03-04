<?php namespace Psimone\PlatformCore\Html\Table;

class Content implements TableCell
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
}
