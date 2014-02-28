<?php
namespace Psimone\PlatformCore\Classes;

interface ModuleInterface {

    public function delete($id);

    public function form($id = null);

    public function listing();

    public function store($id = null);

}
