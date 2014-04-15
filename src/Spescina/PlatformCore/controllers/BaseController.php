<?php namespace Spescina\PlatformCore\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Spescina\PlatformCore\Facades\Filter;
use Spescina\PlatformCore\Facades\Form;
use Spescina\PlatformCore\Facades\Language;
use Spescina\PlatformCore\Facades\Model;
use Spescina\PlatformCore\Facades\Page;
use Spescina\PlatformCore\Facades\Platform;
use Spescina\PlatformCore\Facades\Table;

abstract class BaseController extends Controller {

        protected function doDelete($id)
        {
                Model::delete($id);

                Session::flash('messages', array(Language::get('ui.deleted')));

                return Response::listing();
        }

        protected function showForm($id)
        {
                Form::load($id);

                Form::putFieldsInSession();

                return View::make(Platform::getPackageName() . '::edit');
        }

        protected function doListing()
        {
                Page::toolbar()->add('add', array(
                    'action' => 'form',
                    'label' => 'add'
                ));

                return View::make(Platform::getPackageName() . '::listing');
        }

        protected function doStore($id)
        {
                Form::getFieldsFromSession();
                
                $data = Form::data();

                $validator = Validator::make($data, Form::rules());

                if ($validator->fails())
                {
                        Session::flash('errors', $validator->messages());

                        return Response::showForm($id, true);
                }

                $objId = Model::store($data, $id);
                
                Model::sync($id, Form::multiFields(), Form::filterOnlyMulti());

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

                Session::forget('formFields');

                return Response::listing();
        }

        public function filter()
        {
                $filters = Table::data();

                Filter::load($filters);

                return Response::listing();
        }

}
