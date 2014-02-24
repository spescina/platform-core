<?php
namespace Psimone\PlatformCore\Classes;

interface ModuleInterface {

    public function getDelete($id);

    public function getEdit($id = null);

    public function getListing();

    public function postEdit($id = null);

}
