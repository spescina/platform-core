<?php namespace Psimone\PlatformCore;

use Psimone\PlatformCore\i18n\Language;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Lang;
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
		
		$this->addNamespaces();

		include __DIR__ . '/routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Psimone\\PlatformCore\\Interfaces\\Repository', 'Psimone\\PlatformCore\\Repositories\\Fluent');

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
			'platform.core.components.breadcrumbs',
			'platform.core.components.form',
			'platform.core.components.navigation',
			'platform.core.components.table',
			'platform.core.language'
		);
	}

	private function registerAlias()
	{
		AliasLoader::getInstance()->alias('PBreadcrumbs', 'Psimone\PlatformCore\Facades\Breadcrumbs');
		AliasLoader::getInstance()->alias('PForm', 'Psimone\PlatformCore\Facades\Form');
		AliasLoader::getInstance()->alias('PNavigation', 'Psimone\PlatformCore\Facades\Navigation');
		AliasLoader::getInstance()->alias('PTable', 'Psimone\PlatformCore\Facades\Table');

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
		$this->app['platform.core.components.breadcrumbs'] = $this->app->share(function($app)
		{
			return new Components\Breadcrumbs();
		});
		
		$this->app['platform.core.components.form'] = $this->app->share(function($app)
		{
			return new Components\Form();
		});

		$this->app['platform.core.components.navigation'] = $this->app->share(function($app)
		{
			return new Components\Navigation();
		});
		
		$this->app['platform.core.components.table'] = $this->app->share(function($app)
		{
			return new Components\Table();
		});

		$this->app['platform.core.language'] = $this->app->share(function($app)
		{
			return new i18n\Language();
		});
	}
	
	private function addNamespaces()
	{
		Lang::addNamespace(Language::_ns_, app_path() . '/platform-core/lang');
	}
}
