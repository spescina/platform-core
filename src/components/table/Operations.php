<?php namespace Psimone\PlatformCore\Components\Table;

use Psimone\PlatformCore\Facades\Table;
use Psimone\PlatformCore\Components\Table\Operation;
use Psimone\PlatformCore\Interfaces\Displayable;

class Operations implements Displayable
{
	use \Psimone\PlatformCore\Traits\Displayable;
	
	private $record;
	private $view = 'components/table/operations';
	private $viewData = true;

	public function __construct($record)
	{
		$this->record = $record;
	}

	public function operations()
	{
		$operations = array();

		foreach (Table::operations() as $operation)
		{
			$operations[] = new Operation($operation, $this->record);
		}

		return $operations;
	}
}
