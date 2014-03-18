<?php namespace Psimone\PlatformCore\Controllers;

use Psimone\PlatformCore\Facades\Medialibrary;
use Psimone\PlatformCore\Facades\Platform;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class MedialibraryController extends Controller {

	public function index()
	{
                return View::make(Platform::getPackageName() . '::components/medialibrary/medialibrary');
	}

        public function browse($path)
        {
                $data = Medialibrary::browse($path);

                return Response::json($data);
        }

}
