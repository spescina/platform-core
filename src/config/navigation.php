<?php

return array(
    "home" => "Psimone\PangeaCore\Controllers\DashboardController@getPanel",
    "tests" => "Psimone\PangeaCore\Controllers\TestController@getListing",
    "users_and_groups" => array(
	"groups" => "Psimone\PangeaCore\Controllers\GroupController@getListing",
	"users" => "Psimone\PangeaCore\Controllers\UserController@getListing",
	"permissions" => "Psimone\PangeaCore\Controllers\PermissionController@getListing"
    )
);
