<?php
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

use Psimone\PlatformCore\Facades\Platform;

Route::get('medialibrary/{field}/{value?}', array(
    'as' => 'medialibrary',
    'uses' => 'Psimone\\PlatformCore\\Controllers\\MedialibraryController@index'
))->where('field', '[A-Za-z0-9-_]+')
        ->where('value', '(.*)');

Route::post('medialibrary/folder_create', array(
    'as' => 'medialibrary.folderCreate',
    'uses' => 'Psimone\\PlatformCore\\Controllers\\MedialibraryController@folderCreate'
));

Route::post('medialibrary/folder_delete', array(
    'as' => 'medialibrary.folderDelete',
    'uses' => 'Psimone\\PlatformCore\\Controllers\\MedialibraryController@folderDelete'
));

Route::post('medialibrary/browse', array(
    'as' => 'medialibrary.browse',
    'uses' => 'Psimone\\PlatformCore\\Controllers\\MedialibraryController@browse'
));

Route::match(array('GET', 'POST'), '{model}/{action?}/{id?}', array('as' => 'module', function($module, $action = 'listing', $id = null) {
    return Platform::runModule($module, $action, $id);
}));
