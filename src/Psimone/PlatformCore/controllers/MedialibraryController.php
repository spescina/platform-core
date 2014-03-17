<?php namespace Psimone\PlatformCore\Controllers;

use Psimone\PlatformCore\Facades\Platform;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class MedialibraryController extends Controller {

	public function index()
	{
		return View::make(Platform::getPackageName() . '::components/medialibrary/medialibrary');
	}

}
