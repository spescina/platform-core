<?php namespace Psimone\PlatformCore\Modules;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Navigation;
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
		if ($id)
		{
			Model::find($id);
		}
		
		return View::make('platform-core::form');
	}

	protected function doListing()
	{
		return View::make('platform-core::listing');
	}

	protected function doStore($id)
	{
		/*$this->model->find($id);

		$this->model->store($id);*/
	}

}
