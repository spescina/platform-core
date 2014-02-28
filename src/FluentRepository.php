<?php
namespace Psimone\PlatformCore\Classes;

class FluentRepository implements RepositoryInterface {

    use RepositoryTrait;

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
        return \DB::table($this->table)->get();
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
