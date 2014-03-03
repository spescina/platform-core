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
Route::get('{model}/{action?}/{id?}', function($model, $action = 'listing', $id = null)
{

	Psimone\PlatformCore\Facades\Application::setModule($model);

	$className = ucfirst($model);

	$controllerName = 'Psimone\\PlatformCore\\Modules\\' . $className . 'Controller';

	$modelName = 'Psimone\\PlatformCore\\Models\\' . $className;

	$model = App::make($modelName);

	$controller = App::make($controllerName);

	$controller->setModel($model);

	$controller->start();

	return $controller->$action();
});
