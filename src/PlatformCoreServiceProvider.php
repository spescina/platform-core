<?php namespace Psimone\PlatformCore;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class PlatformCoreServiceProvider extends ServiceProvider
{
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
		$this->package('psimone/platform-core', 'platform-core', __DIR__);

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

		$this->registerServices();

		$this->registerAlias();

		$this->registerDependencies();
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
			'platform.core.html.navigation',
			'platform.core.language'
		);
	}

	private function registerAlias()
	{
		AliasLoader::getInstance()->alias('TableBlock', 'Psimone\PlatformCore\Facades\Table');
		AliasLoader::getInstance()->alias('FormBlock', 'Psimone\PlatformCore\Facades\Form');
		AliasLoader::getInstance()->alias('NavigationBlock', 'Psimone\PlatformCore\Facades\Navigation');

		AliasLoader::getInstance()->alias('Application', 'Psimone\PlatformCore\Facades\Application');
		AliasLoader::getInstance()->alias('Controller', 'Psimone\PlatformCore\Facades\Controller');
		AliasLoader::getInstance()->alias('Model', 'Psimone\PlatformCore\Facades\Model');
		AliasLoader::getInstance()->alias('Language', 'Psimone\PlatformCore\Facades\Language');

		AliasLoader::getInstance()->alias('Asset', 'Teepluss\Asset\Facades\Asset');
	}

	private function registerDependencies()
	{
		$this->app->register('Teepluss\Asset\AssetServiceProvider');
	}

	private function registerServices()
	{
		$this->app['platform.core.html.table'] = $this->app->share(function($app)
		{
			return new Html\Table();
		});

		$this->app['platform.core.html.form'] = $this->app->share(function($app)
		{
			return new Html\Form();
		});

		$this->app['platform.core.html.navigation'] = $this->app->share(function($app)
		{
			return new Html\Navigation();
		});

		$this->app['platform.core.language'] = $this->app->share(function($app)
		{
			return new Language();
		});
	}
}
