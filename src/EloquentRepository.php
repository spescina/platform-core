<?php
namespace Psimone\PlatformCore\Classes;

use Psimone\PlatformCore\Classes\RepositoryInterface;

class EloquentRepository implements RepositoryInterface {

    public function delete($id)
    {
        var_dump('delete ' . $id);
    }

    public function find($id)
    {
        var_dump('find ' . $id);
    }

    public function all()
    {
        var_dump('all');
    }

    public function store($id = null)
    {
        if ($id) {
            var_dump('save ' . $id);
        }
        else {
            var_dump('create');
        }
    }

}
