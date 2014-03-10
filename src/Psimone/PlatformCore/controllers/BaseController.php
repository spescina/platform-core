<?php namespace Psimone\PlatformCore\Controllers;

use Psimone\PlatformCore\Action;
use Psimone\PlatformCore\Platform as PlatformConst;
use Psimone\PlatformCore\Components\Task;
use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Facades\Breadcrumbs;
use Psimone\PlatformCore\Facades\Form;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Facades\Navigation;
use Psimone\PlatformCore\Facades\Order;
use Psimone\PlatformCore\Facades\Page;
use Psimone\PlatformCore\Facades\Table;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

abstract class BaseController extends Controller
{
	public function start()
	{
		Platform::setupAssets();

		Navigation::load();

		Breadcrumbs::load();
	}

	protected function doDelete($id)
	{
		Model::delete($id);

		Session::flash('messages', array(Language::get('ui.deleted')));

		return Redirect::route('module', array(
		    Platform::module(),
		    Action::ACTION_LISTING
		));
	}

	protected function showForm($id)
	{
		Form::load($id);

		Session::flash('formFields', Form::allFields());

		return View::make(PlatformConst::PKG . '::edit');
	}

	protected function doListing()
	{
		Page::task(new Task('form', null, 'form_new'));

		return View::make(PlatformConst::PKG . '::listing');
	}

	protected function doStore($id)
	{
		$data = Form::data();

		$validator = Validator::make($data, Form::rules());

		if ($validator->fails())
		{
			Session::flash('errors', $validator->messages());

			if ($id)
			{
				return Redirect::route('module', array(
					    Platform::module(),
					    Action::ACTION_SHOWFORM,
					    $id
					))->withInput();
			}
			else
			{
				return Redirect::route('module', array(
					    Platform::module(),
					    Action::ACTION_SHOWFORM
					))->withInput();
			}
		}

		$objId = Model::store($data, $id);

		if ($id)
		{
			Session::flash('messages', array(Language::get('ui.saved')));
		}
		else
		{
			Session::flash('messages', array(Language::get('ui.created')));
		}

		if (Input::has('save'))
		{
			return Redirect::route('module', array(
				    Platform::module(),
				    Action::ACTION_SHOWFORM,
				    $objId
			));
		}

		return Redirect::route('module', array(
			    Platform::module(),
			    Action::ACTION_LISTING
		));
	}
}

