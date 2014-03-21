<?php namespace Psimone\PlatformCore\Composers;

use Psimone\PlatformCore\Facades\Breadcrumbs;
use Psimone\PlatformCore\Facades\Navigation;
use Psimone\PlatformCore\Facades\Platform;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
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
                $cdn = Config::get(Platform::getPackageName() . '::assets.cdn');

                if ($cdn)
                {
                        switch (App::environment()) {
                                case 'staging':
                                case 'production':
                                        break;

                                case 'local':
                                        Asset::container('header.common')->add('bootstrap-css', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css');
                                        Asset::container('header.common')->add('bootstrap-datetimepicker-css', 'packages/psimone/platform-core/src/css/vendor/bootstrap-datetimepicker.min.css');
                                        Asset::container('header.common')->add('fancybox-css', 'packages/psimone/platform-core/src/css/vendor/jquery.fancybox.css');
                                        Asset::container('header.common')->add('summernote-css', 'packages/psimone/platform-core/src/css/vendor/summernote.css');
                                        Asset::container('header.common')->add('application-css', 'packages/psimone/platform-core/src/css/application.css');

                                        Asset::container('footer.common')->add('jquery', 'https://code.jquery.com/jquery-2.1.0.min.js');
                                        Asset::container('footer.common')->add('bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array('jquery'));
                                        Asset::container('footer.common')->add('moment', 'packages/psimone/platform-core/src/js/vendor/moment.js');
                                        Asset::container('footer.common')->add('bootstrap-datetimepicker-js', 'packages/psimone/platform-core/src/js/vendor/bootstrap-datetimepicker.js', array('bootstrap-js', 'moment'));
                                        Asset::container('footer.common')->add('summernote-js', 'packages/psimone/platform-core/src/js/vendor/summernote.js', array('jquery'));
                                        Asset::container('footer.common')->add('fancybox-js', 'packages/psimone/platform-core/src/js/vendor/jquery.fancybox.js', array('jquery'));

                                        Asset::container('footer.common')->add('application-js', 'packages/psimone/platform-core/src/js/app.js', array('bootstrap-js', 'bootstrap-datetimepicker-js'));
                                        break;
                        }
                }
                else
                {
                        switch (App::environment()) {
                                case 'staging':
                                case 'production':
                                        break;

                                case 'local':
                                        Asset::container('header.common')->add('bootstrap-css', 'packages/psimone/platform-core/src/css/vendor/bootstrap.css');
                                        Asset::container('header.common')->add('bootstrap-datetimepicker-css', 'packages/psimone/platform-core/src/css/vendor/bootstrap-datetimepicker.min.css');
                                        Asset::container('header.common')->add('fancybox-css', 'packages/psimone/platform-core/src/css/vendor/jquery.fancybox.css');
                                        Asset::container('header.common')->add('fontawesome-css', 'packages/psimone/platform-core/src/css/vendor/font-awesome.css');
                                        Asset::container('header.common')->add('summernote-css', 'packages/psimone/platform-core/src/css/vendor/summernote.css');
                                        Asset::container('header.common')->add('application-css', 'packages/psimone/platform-core/src/css/application.css');

                                        Asset::container('footer.common')->add('jquery', 'packages/psimone/platform-core/src/js/vendor/jquery.js');
                                        Asset::container('footer.common')->add('bootstrap-js', 'packages/psimone/platform-core/src/js/vendor/bootstrap.js', array('jquery'));
                                        Asset::container('footer.common')->add('moment', 'packages/psimone/platform-core/src/js/vendor/moment.js');
                                        Asset::container('footer.common')->add('bootstrap-datetimepicker-js', 'packages/psimone/platform-core/src/js/vendor/bootstrap-datetimepicker.js', array('bootstrap-js', 'moment'));
                                        Asset::container('footer.common')->add('summernote-js', 'packages/psimone/platform-core/src/js/vendor/summernote.js', array('jquery'));
                                        Asset::container('footer.common')->add('fancybox-js', 'packages/psimone/platform-core/src/js/vendor/jquery.fancybox.js', array('jquery'));

                                        Asset::container('footer.common')->add('application-js', 'packages/psimone/platform-core/src/js/app.js', array('bootstrap-js', 'bootstrap-datetimepicker-js'));
                                        break;
                        }
                }
        }

}
