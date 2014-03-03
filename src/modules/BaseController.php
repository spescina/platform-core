<?php namespace Psimone\PlatformCore\Modules;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Navigation;
use Psimone\PlatformCore\Facades\Table;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

abstract class BaseController extends Controller {

	public function __construct() {}

	public function start()
	{
		Application::setupAssets();

		Navigation::load();
	}

	protected function doDelete($id)
	{
		//$this->model->delete($id);
	}

	protected function showForm($id)
	{
		return 'show form';
	}

	protected function doListing()
	{
		Table::setEntries();

		//var_dump(Table::body());die;

		return View::make('platform-core::listing');
	}

	protected function doStore($id)
	{
		/*$this->model->find($id);

		$this->model->store($id);*/
	}

}
