<?php namespace Spescina\PlatformCore;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Spescina\PlatformCore\Components\Breadcrumbs\Breadcrumbs;
use Spescina\PlatformCore\Components\Form\Form;
use Spescina\PlatformCore\Components\Navigation\Navigation;
use Spescina\PlatformCore\Components\Page\Page;
use Spescina\PlatformCore\Components\Platform;
use Spescina\PlatformCore\Components\Table\Filter;
use Spescina\PlatformCore\Components\Table\Order;
use Spescina\PlatformCore\Components\Table\Table;
use Spescina\PlatformCore\Localization\Language;

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
                $this->package('spescina/platform-core');

                $this->addNamespaces();

                include __DIR__ . '/../../routes.php';

                include __DIR__ . '/../../macros.php';

                include __DIR__ . '/../../filters.php';

                include __DIR__ . '/../../composers.php';
        }

        /**
         * Register the service provider.
         *
         * @return void
         */
        public function register()
        {
                $this->app->bind('Spescina\\PlatformCore\\Interfaces\\Repository', 'Spescina\\PlatformCore\\Repositories\\Fluent');

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
                    'platform.core',
                    'platform.core.components.breadcrumbs',
                    'platform.core.components.form',
                    'platform.core.components.navigation',
                    'platform.core.components.table',
                    'platform.core.components.table.filter',
                    'platform.core.components.table.order',
                    'platform.core.language',
                    'platform.core.page'
                );
        }

        private function registerAlias()
        {
                AliasLoader::getInstance()->alias('Platform', 'Spescina\PlatformCore\Facades\Platform');
                AliasLoader::getInstance()->alias('PBreadcrumbs', 'Spescina\PlatformCore\Facades\Breadcrumbs');
                AliasLoader::getInstance()->alias('PForm', 'Spescina\PlatformCore\Facades\Form');
                AliasLoader::getInstance()->alias('PNavigation', 'Spescina\PlatformCore\Facades\Navigation');
                AliasLoader::getInstance()->alias('PPage', 'Spescina\PlatformCore\Facades\Page');
                AliasLoader::getInstance()->alias('PTable', 'Spescina\PlatformCore\Facades\Table');
                
                AliasLoader::getInstance()->alias('Asset', 'Dragonfire1119\Asset\Facades\Asset');
        }

        private function registerServices()
        {
                $this->app['platform.core.components.breadcrumbs'] = $this->app->share(function($app) {
                        return new Breadcrumbs();
                });

                $this->app['platform.core.components.form'] = $this->app->share(function($app) {
                        return new Form();
                });

                $this->app['platform.core.components.navigation'] = $this->app->share(function($app) {
                        return new Navigation();
                });

                $this->app['platform.core.components.table'] = $this->app->share(function($app) {
                        return new Table();
                });

                $this->app['platform.core.components.table.filter'] = $this->app->share(function($app) {
                        return new Filter();
                });

                $this->app['platform.core.components.table.order'] = $this->app->share(function($app) {
                        return new Order();
                });

                $this->app['platform.core.language'] = $this->app->share(function($app) {
                        return new Language();
                });

                $this->app['platform.core.page'] = $this->app->share(function($app) {
                        return new Page();
                });

                $this->app['platform.core'] = $this->app->share(function($app) {
                        return new Platform();
                });
        }
        
        private function registerDependencies()
        {
                $this->app->register('Dragonfire1119\Asset\AssetServiceProvider');
        }


        private function addNamespaces()
        {
                Lang::addNamespace(Language::NS, app_path() . '/platform-core/lang');
        }

}
