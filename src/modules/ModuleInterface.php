<?php namespace Psimone\PlatformCore\Modules;

interface ModuleInterface {

	public function delete($id);

	public function form($id = null);

	public function listing();

	public function store($id = null);

}
