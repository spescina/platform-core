<?php
/*
  |--------------------------------------------------------------------------
  | Application View Composers
  |--------------------------------------------------------------------------
  |
 */

View::composer(Platform::getPackageName() . '::module', 'Spescina\\PlatformCore\\Composers\\ModuleComposer');
