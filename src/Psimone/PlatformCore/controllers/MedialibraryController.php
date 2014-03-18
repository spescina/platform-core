<?php namespace Psimone\PlatformCore\Controllers;

use Psimone\PlatformCore\Facades\Medialibrary;
use Psimone\PlatformCore\Facades\Platform;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class MedialibraryController extends Controller {

	/**
	 * Load the library interface
	 * 
	 * @return Response
	 */
	public function index()
	{
		return View::make(Platform::getPackageName() . '::components/medialibrary/medialibrary');
	}

	/**
	 * Return the list of all resources at the given path
	 * 
	 * @return Response
	 */
        public function browse()
        {
                $path = Input::get('path');
		
		Medialibrary::browsePath($path);
		
		$data = Medialibrary::getItems();

                return Response::json($data);
        }

}
