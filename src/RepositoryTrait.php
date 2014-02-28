<?php

namespace Psimone\PlatformCore\Classes;

trait RepositoryTrait {

    public $table;

    public function setTable($table)
    {
        $this->table = $table;
    }

}
