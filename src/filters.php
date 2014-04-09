<?php
/*
  |--------------------------------------------------------------------------
  | Application & Route Filters
  |--------------------------------------------------------------------------
  |
  | Below you will find the "before" and "after" events for the application
  | which may be used to do any work before or after a request into your
  | application. Here you may also register your custom route filters.
  |
 */

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Psimone\PlatformCore\Facades\Platform;

App::before(function($request)
{
	Route::match(array('GET', 'POST'), '{model}/{action?}/{id?}', array(
                'as' => 'module', function($module, $action = 'listing', $id = null) {
                        return Platform::runModule($module, $action, $id);
                }
        ))->where(array('model' => '[a-z]+', 'action' => '[a-z]+', 'id' => '[0-9]+'));
});

Route::filter('platform-core', function() {
        
});
