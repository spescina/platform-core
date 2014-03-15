<?php namespace Psimone\PlatformCore\Controllers;

use Psimone\PlatformCore\Components\Platform as PlatformConst;
use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Facades\Breadcrumbs;
use Psimone\PlatformCore\Facades\Filter;
use Psimone\PlatformCore\Facades\Form;
use Psimone\PlatformCore\Facades\Language;
use Psimone\PlatformCore\Facades\Model;
use Psimone\PlatformCore\Facades\Navigation;
use Psimone\PlatformCore\Facades\Page;
use Psimone\PlatformCore\Facades\Table;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
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

		return Response::listing();
	}

	protected function showForm($id)
	{
		Form::load($id);

		Session::flash('formFields', Form::allFields());

		return View::make(PlatformConst::PKG . '::edit');
	}

	protected function doListing()
	{		
		Page::toolbar()->add('add', array(
			'action' => 'form',
			'label' => 'add'
		));

		return View::make(PlatformConst::PKG . '::listing');
	}

	protected function doStore($id)
	{
		$data = Form::data();

		$validator = Validator::make($data, Form::rules());

		if ($validator->fails())
		{
			Session::flash('errors', $validator->messages());

			return Response::showForm($id, true);
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
			return Response::showForm($objId);
		}

		return Response::listing();
	}
	
	public function filter()
	{
		$filters = Table::data();
		
		Filter::load($filters);
		
		return Response::listing();
	}
}

