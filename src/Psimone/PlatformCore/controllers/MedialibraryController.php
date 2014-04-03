<?php namespace Psimone\PlatformCore\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Psimone\PlatformCore\Facades\Medialibrary;
use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Libraries\UploadHandler;

class MedialibraryController extends Controller {

        /**
         * Load the library interface
         * 
         * @return Response
         */
        public function index($field, $value = null)
        {
                return View::make(Platform::getPackageName() . '::components/medialibrary/medialibrary')
                                ->with('field', $field)
                                ->with('value', $value);
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
        
        /**
         * Creates a folder at the given path
         * 
         * @return Response
         */
        public function folderCreate()
        {
                $path = Input::get('path');
                $folder = Input::get('folder');

                $exec = Medialibrary::folderCreate($path, $folder);

                return Response::json(array($exec));
        }
        
        /**
         * Delete a folder at the given path
         * 
         * @return Response
         */
        public function folderDelete()
        {
                $folder = Input::get('folder');

                $exec = Medialibrary::folderDelete($folder);

                return Response::json(array($exec));
        }
        
        /**
         * Handle uploaded files
         * 
         * @return Response
         */
        public function filesUpload()
        {
                $options = array(
                    'script_url' => URL::route('medialibrary.upload'),
                    'upload_dir' => public_path('uploads'),
                    'upload_url' => asset('uploads')
                );
                
                $upload_handler = new UploadHandler($options);
        }

}
