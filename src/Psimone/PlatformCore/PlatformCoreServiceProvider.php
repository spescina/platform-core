<?php namespace Psimone\PlatformCore;

use Psimone\PlatformCore\Components\Breadcrumbs;
use Psimone\PlatformCore\Components\Form;
use Psimone\PlatformCore\Components\Navigation;
use Psimone\PlatformCore\Components\Table;
use Psimone\PlatformCore\Components\Table\Filter;
use Psimone\PlatformCore\Components\Table\Order;
use Psimone\PlatformCore\i18n\Language;
use Psimone\PlatformCore\Page;
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
		$this->package('psimone/platform-core');
		
		$this->addNamespaces();

		include __DIR__ . '/../../routes.php';
		
		include __DIR__ . '/../../macros.php';
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
			'platform.core.language',
			'platform.core.components.table.filter',
			'platform.core.components.table.order',
			'platform.core.page'
		);
	}

	private function registerAlias()
	{
		AliasLoader::getInstance()->alias('PBreadcrumbs', 'Psimone\PlatformCore\Facades\Breadcrumbs');
		AliasLoader::getInstance()->alias('PForm', 'Psimone\PlatformCore\Facades\Form');
		AliasLoader::getInstance()->alias('PNavigation', 'Psimone\PlatformCore\Facades\Navigation');
		AliasLoader::getInstance()->alias('PPage', 'Psimone\PlatformCore\Facades\Page');
		AliasLoader::getInstance()->alias('PTable', 'Psimone\PlatformCore\Facades\Table');
		
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
			return new Breadcrumbs();
		});
		
		$this->app['platform.core.components.form'] = $this->app->share(function($app)
		{
			return new Form();
		});

		$this->app['platform.core.components.navigation'] = $this->app->share(function($app)
		{
			return new Navigation();
		});
		
		$this->app['platform.core.components.table'] = $this->app->share(function($app)
		{
			return new Table();
		});

		$this->app['platform.core.language'] = $this->app->share(function($app)
		{
			return new Language();
		});
		
		$this->app['platform.core.components.table.filter'] = $this->app->share(function($app)
		{
			return new Filter();
		});

		$this->app['platform.core.components.table.order'] = $this->app->share(function($app)
		{
			return new Order();
		});
		
		$this->app['platform.core.page'] = $this->app->share(function($app)
		{
			return new Page();
		});
	}
	
	private function addNamespaces()
	{
		Lang::addNamespace(Language::NS, app_path() . '/platform-core/lang');
	}
}
