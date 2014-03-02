<?php namespace Psimone\PlatformCore;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;

class PlatformCoreServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('psimone/platform-core');

		include __DIR__ . '/routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Psimone\\PlatformCore\\Repositories\\RepositoryInterface', 'Psimone\\PlatformCore\\Repositories\\FluentRepository');

		$this->app['platform.core.html.table'] = $this->app->share(function($app){
                        return new Html\Table();
                });

		$this->app['platform.core.html.form'] = $this->app->share(function($app){
                        return new Html\Form();
                });

		$this->app['platform.core.app'] = $this->app->share(function($app){
                        return new Application();
                });

		$this->app->register('Teepluss\Asset\AssetServiceProvider');

		AliasLoader::getInstance()->alias('TableBlock', 'Psimone\PlatformCore\Facades\Table');
		AliasLoader::getInstance()->alias('FormBlock', 'Psimone\PlatformCore\Facades\Form');
		AliasLoader::getInstance()->alias('Application', 'Psimone\PlatformCore\Facades\Application');
		AliasLoader::getInstance()->alias('Asset', 'Teepluss\Asset\Facades\Asset');

		View::addNamespace('psimone\platform-core', __DIR__ . './views');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array(
			'platform.core.html.table',
			'platform.core.html.form',
		);
	}

}
