<?php

/*
|--------------------------------------------------------------------------
| Application View Composers
|--------------------------------------------------------------------------
|
*/

View::composer(Platform::getPackageName() . '::module', 'Psimone\\PlatformCore\\Composers\\ModuleComposer');
View::composer(Platform::getPackageName() . '::components/medialibrary/medialibrary', 'Psimone\\PlatformCore\\Composers\\MedialibraryComposer');