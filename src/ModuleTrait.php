<?php

namespace Psimone\PlatformCore\Classes;

trait ModuleTrait {

    protected $model;

    protected function delete($id)
    {
        $this->model->delete($id);
    }

    protected function edit($id)
    {
        var_dump('show form');
    }

    protected function listing()
    {
        $this->model->all();

        var_dump('show listing');
    }

    protected function store($id)
    {
        $this->model->find($id);

        $this->model->store($id);
    }

}
