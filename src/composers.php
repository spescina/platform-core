<?php
/*
  |--------------------------------------------------------------------------
  | Application View Composers
  |--------------------------------------------------------------------------
  |
 */

View::composer(Platform::getPackageName() . '::module', 'Psimone\\PlatformCore\\Composers\\ModuleComposer');
