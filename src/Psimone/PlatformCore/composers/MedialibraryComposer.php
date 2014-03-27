<?php namespace Psimone\PlatformCore\Composers;

use Psimone\PlatformCore\Facades\Breadcrumbs;
use Psimone\PlatformCore\Facades\Navigation;
use Psimone\PlatformCore\Facades\Platform;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Teepluss\Asset\Facades\Asset;

class MedialibraryComposer {

        public function compose($view)
        {
                $this->setupAssets();
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
                                        Asset::container('header.common')->add('application-css', 'packages/psimone/platform-core/src/css/application.css');

                                        Asset::container('footer.common')->add('holder-js', 'holder.js');
                                        Asset::container('footer.common')->add('jquery', 'https://code.jquery.com/jquery-2.1.0.min.js');
                                        Asset::container('footer.common')->add('bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array('jquery'));
                                        Asset::container('footer.common')->add('handlebars-js', 'packages/psimone/platform-core/src/js/vendor/handlebars.js', array('jquery'));
                                        Asset::container('footer.common')->add('jquery-ui-widget', 'packages/psimone/platform-core/src/js/vendor/jquery.ui.widget.js', array('jquery'));
                                        Asset::container('footer.common')->add('uploader-transport-js', 'packages/psimone/platform-core/src/js/vendor/jquery.iframe-transport.js', array('jquery'));
                                        Asset::container('footer.common')->add('uploader-js', 'packages/psimone/platform-core/src/js/vendor/jquery.fileupload.js', array('jquery', 'jquery-ui-widget', 'uploader-transport-js'));

                                        
                                        Asset::container('footer.common')->add('ajax-js', 'packages/psimone/platform-core/src/js/ajax.js', array('jquery'));
                                        Asset::container('footer.common')->add('medialibrary-js', 'packages/psimone/platform-core/src/js/medialibrary.js', array('jquery', 'ajax-js', 'bootstrap-js', 'handlebars-js'));
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
                                        Asset::container('header.common')->add('fontawesome-css', 'packages/psimone/platform-core/src/css/vendor/font-awesome.css');
                                        Asset::container('header.common')->add('application-css', 'packages/psimone/platform-core/src/css/application.css');

                                        Asset::container('footer.common')->add('holder-js', 'holder.js');
                                        Asset::container('footer.common')->add('jquery', 'packages/psimone/platform-core/src/js/vendor/jquery.js');
                                        Asset::container('footer.common')->add('bootstrap-js', 'packages/psimone/platform-core/src/js/vendor/bootstrap.js', array('jquery'));
                                        Asset::container('footer.common')->add('handlebars-js', 'packages/psimone/platform-core/src/js/vendor/handlebars.js', array('jquery'));
                                        Asset::container('footer.common')->add('jquery-ui-widget', 'packages/psimone/platform-core/src/js/vendor/jquery.ui.widget.js', array('jquery'));
                                        Asset::container('footer.common')->add('uploader-transport-js', 'packages/psimone/platform-core/src/js/vendor/jquery.iframe-transport.js', array('jquery'));
                                        Asset::container('footer.common')->add('uploader-js', 'packages/psimone/platform-core/src/js/vendor/jquery.fileupload.js', array('jquery', 'jquery-ui-widget', 'uploader-transport-js'));
                                        
                                        Asset::container('footer.common')->add('ajax-js', 'packages/psimone/platform-core/src/js/ajax.js', array('jquery'));
                                        Asset::container('footer.common')->add('medialibrary-js', 'packages/psimone/platform-core/src/js/medialibrary.js', array('jquery', 'ajax-js', 'bootstrap-js', 'handlebars-js'));
                                        break;
                        }
                }
        }

}
