<?php namespace Spescina\PlatformCore\Interfaces;

interface Module {

        public function delete($id);

        public function form($id = null);

        public function listing();

        public function store($id = null);

}
