<?php namespace Psimone\PlatformCore\Composers;

use Psimone\PlatformCore\Facades\Breadcrumbs;
use Psimone\PlatformCore\Facades\Navigation;
use Illuminate\Support\Facades\App;
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
		switch (App::environment()) {
			case 'staging':
			case 'production':
				break;

			case 'local':
				Asset::container('header.common')->add('bootstrap-css', 'packages/psimone/platform-core/src/css/vendor/bootstrap.css');
				Asset::container('header.common')->add('fontawesome-css', 'packages/psimone/platform-core/src/css/vendor/font-awesome.css');

				Asset::container('footer.common')->add('jquery', 'packages/psimone/platform-core/src/js/vendor/jquery.js');
				Asset::container('footer.common')->add('bootstrap-js', 'packages/psimone/platform-core/src/js/vendor/bootstrap.js', array('jquery'));
				Asset::container('footer.common')->add('handlebars-js', 'packages/psimone/platform-core/src/js/vendor/handlebars.js', array('jquery'));

				Asset::container('footer.common')->add('application-js', 'packages/psimone/platform-core/src/js/medialibrary.js', array('bootstrap-js', 'handlebars-js'));
				break;
		}
	}

}
