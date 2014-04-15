<?php
/*
  |--------------------------------------------------------------------------
  | Application Response Macros
  |--------------------------------------------------------------------------
 */

use Spescina\PlatformCore\Components\Action\Action as ActionConst;
use Spescina\PlatformCore\Facades\Platform;

Response::macro('showForm', function($objId = null, $withInput = false) {
        $response = Redirect::route('module', array(
                    Platform::getModule(),
                    ActionConst::ACTION_SHOWFORM,
                    $objId
        ));

        if ($withInput)
        {
                $response->withInput();
        }

        return $response;
});

Response::macro('listing', function() {
        return Redirect::route('module', array(
                    Platform::getModule(),
                    ActionConst::ACTION_LISTING
        ));
});
