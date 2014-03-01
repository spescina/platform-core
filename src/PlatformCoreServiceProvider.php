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

		$this->app['platform.core.structures.table'] = $this->app->share(function($app){
                        return new Structures\Table();
                });

		$this->app['platform.core.structures.form'] = $this->app->share(function($app){
                        return new Structures\Form();
                });

		AliasLoader::getInstance()->alias('PcTable', 'Psimone\PlatformCore\Facades\Table');
		AliasLoader::getInstance()->alias('PcForm', 'Psimone\PlatformCore\Facades\Form');

		View::addNamespace('platform-core', __DIR__ . './views');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array(
			'platform.core.structures.table',
			'platform.core.structures.form',
		);
	}

}
