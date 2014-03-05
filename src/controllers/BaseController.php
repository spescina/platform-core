<?php namespace Psimone\PlatformCore\Controllers;

use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Breadcrumbs;
use Psimone\PlatformCore\Facades\Form;
use Psimone\PlatformCore\Facades\Navigation;
use Psimone\PlatformCore\Facades\Table;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

abstract class BaseController extends Controller
{

	public function __construct()
	{
		
	}

	public function start()
	{
		Application::setupAssets();

		Navigation::load();

		Breadcrumbs::load();
	}

	protected function doDelete($id)
	{
		//$this->model->delete($id);
	}

	protected function showForm($id)
	{
		Form::load($id);

		return View::make('platform-core::edit');
	}

	protected function doListing()
	{
		Table::load();

		return View::make('platform-core::listing');
	}

	protected function doStore($id)
	{
		/* $this->model->find($id);

		  $this->model->store($id); */
	}
}