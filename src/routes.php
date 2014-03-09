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
Route::match(array('GET', 'POST'), '{model}/{action?}/{id?}', array('as' => 'module', function($module, $action = 'listing', $id = null)
{
	App::singleton('platform.core.platform', function() use ($module)
	{
		return new Psimone\PlatformCore\Platform($module);
	});

	$platform = App::make('platform.core.platform');

	$platform->register();

	return $platform->run($action, $id);
}));
