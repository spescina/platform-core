<?php namespace Psimone\PlatformCore\Modules;

use Psimone\PlatformCore\Models\BaseModel;
use Psimone\PlatformCore\Facades\Application;
use Psimone\PlatformCore\Facades\Navigation;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

abstract class BaseController extends Controller {

	protected $model;

	public function __construct() {}

	public function start()
	{
		Application::setupAssets();

		Navigation::load();
	}

	public function setModel(BaseModel $model)
	{
		$this->model = $model;
	}

	protected function doDelete($id)
	{
		$this->model->delete($id);
	}

	protected function showForm($id)
	{
		return 'show form';
	}

	protected function doListing()
	{
		$results = $this->model->all();

		\View::share('results', $results);

		return \View::make('platform-core::listing');
	}

	protected function doStore($id)
	{
		$this->model->find($id);

		$this->model->store($id);
	}

}
