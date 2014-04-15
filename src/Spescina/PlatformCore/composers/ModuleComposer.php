<?php namespace Spescina\PlatformCore\Composers;

use Illuminate\Support\Facades\App;
use Spescina\PlatformCore\Facades\Breadcrumbs;
use Spescina\PlatformCore\Facades\Navigation;
use Teepluss\Asset\Facades\Asset;

class ModuleComposer {

        public function compose($view)
        {
                $this->setupAssets();

                Navigation::load();

                Breadcrumbs::load();
        }

        /**
         * Load application assets
         */
        private function setupAssets()
        {
                switch (App::environment()) {
                        case 'staging':
                        case 'production':
                                break;

                        case 'local':
                                Asset::container('header.common')->add('bootstrap-css', 'packages/spescina/platform-core/src/css/vendor/bootstrap.css');
                                Asset::container('header.common')->add('bootstrap-datetimepicker-css', 'packages/spescina/platform-core/src/css/vendor/bootstrap-datetimepicker.min.css');
                                Asset::container('header.common')->add('fancybox-css', 'packages/spescina/mediabrowser/src/css/vendor/jquery.fancybox.css');
                                Asset::container('header.common')->add('summernote-css', 'packages/spescina/platform-core/src/css/vendor/summernote.css');
                                Asset::container('header.common')->add('mediabrowser-css', 'packages/spescina/mediabrowser/src/css/mediabrowser-include.css');
                                Asset::container('header.common')->add('application-css', 'packages/spescina/platform-core/src/css/application.css');

                                Asset::container('footer.common')->add('jquery', 'packages/spescina/platform-core/src/js/vendor/jquery.js');
                                Asset::container('footer.common')->add('bootstrap-js', 'packages/spescina/platform-core/src/js/vendor/bootstrap.js', array('jquery'));
                                Asset::container('footer.common')->add('moment', 'packages/spescina/platform-core/src/js/vendor/moment.js');
                                Asset::container('footer.common')->add('bootstrap-datetimepicker-js', 'packages/spescina/platform-core/src/js/vendor/bootstrap-datetimepicker.js', array('bootstrap-js', 'moment'));
                                Asset::container('footer.common')->add('summernote-js', 'packages/spescina/platform-core/src/js/vendor/summernote.js', array('jquery'));
                                Asset::container('footer.common')->add('fancybox-js', 'packages/spescina/mediabrowser/src/js/vendor/jquery.fancybox.js', array('jquery'));

                                Asset::container('footer.common')->add('mediabrowser-js', 'packages/spescina/mediabrowser/src/js/mediabrowser-include.js', array('fancybox-js'));
                                Asset::container('footer.common')->add('application-js', 'packages/spescina/platform-core/src/js/app.js', array('bootstrap-js', 'bootstrap-datetimepicker-js'));
                                break;
                }
        }

}
