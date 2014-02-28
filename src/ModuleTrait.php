<?php

namespace Psimone\PlatformCore\Classes;

trait ModuleTrait {

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    protected function doDelete($id)
    {
        $this->model->delete($id);
    }

    protected function showForm($id)
    {
        var_dump('show form');
    }

    protected function doListing()
    {
        $results = $this->model->all();

        View::share('results', $results);

        return View::make('listing');
    }

    protected function doStore($id)
    {
        $this->model->find($id);

        $this->model->store($id);
    }

}
