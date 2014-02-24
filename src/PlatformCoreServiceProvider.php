<?php

namespace Psimone\PlatformCore;

use Illuminate\Support\ServiceProvider;

class PlatformCoreServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('Psimone\\PlatformCore\\Classes\\RepositoryInterface', 'Psimone\\PlatformCore\\Classes\\EloquentRepository');
    }

}
