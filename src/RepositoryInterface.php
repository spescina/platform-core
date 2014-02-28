<?php
namespace Psimone\PlatformCore\Classes;

interface RepositoryInterface {

    public function setTable($table);

    public function delete($id);

    public function find($id);

    public function all();

    public function store($id = null);

}
