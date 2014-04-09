<?php namespace Psimone\PlatformCore;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Psimone\PlatformCore\Components\Breadcrumbs\Breadcrumbs;
use Psimone\PlatformCore\Components\Form\Form;
use Psimone\PlatformCore\Components\Navigation\Navigation;
use Psimone\PlatformCore\Components\Page\Page;
use Psimone\PlatformCore\Components\Platform;
use Psimone\PlatformCore\Components\Table\Filter;
use Psimone\PlatformCore\Components\Table\Order;
use Psimone\PlatformCore\Components\Table\Table;
use Psimone\PlatformCore\Helpers\Timthumb;
use Psimone\PlatformCore\Localization\Language;

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
                    'platform.core',
                    'platform.core.components.breadcrumbs',
                    'platform.core.components.form',
                    'platform.core.components.navigation',
                    'platform.core.components.table',
                    'platform.core.components.table.filter',
                    'platform.core.components.table.order',
                    'platform.core.helpers.timthumb',
                    'platform.core.language',
                    'platform.core.page'
                );
        }

        private function registerAlias()
        {
                AliasLoader::getInstance()->alias('Platform', 'Psimone\PlatformCore\Facades\Platform');
                AliasLoader::getInstance()->alias('PBreadcrumbs', 'Psimone\PlatformCore\Facades\Breadcrumbs');
                AliasLoader::getInstance()->alias('PForm', 'Psimone\PlatformCore\Facades\Form');
                AliasLoader::getInstance()->alias('PNavigation', 'Psimone\PlatformCore\Facades\Navigation');
                AliasLoader::getInstance()->alias('PPage', 'Psimone\PlatformCore\Facades\Page');
                AliasLoader::getInstance()->alias('PTable', 'Psimone\PlatformCore\Facades\Table');
                AliasLoader::getInstance()->alias('Timthumb', 'Psimone\PlatformCore\Facades\Timthumb');

                AliasLoader::getInstance()->alias('Asset', 'Teepluss\Asset\Facades\Asset');
                AliasLoader::getInstance()->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
        }

        private function registerDependencies()
        {
                $this->app->register('Teepluss\Asset\AssetServiceProvider');
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

                $this->app['platform.core.helpers.timthumb'] = $this->app->share(function($app) {
                        return new Timthumb();
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

        private function addNamespaces()
        {
                Lang::addNamespace(Language::NS, app_path() . '/platform-core/lang');
        }

}
