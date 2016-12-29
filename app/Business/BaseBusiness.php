<?php
namespace App\Business;

class BaseBusiness {
    /*
     * object model
     * */
    protected $model;

    /**
     * @param Model $model
     */
    function __construct($model) {
        $this->model = new $model();
    }

    /**
     * saveData use to store data into DB
     * @param $request
     * @return mixed
     */
    public function saveData($request) {
        $this->setData($request);
        return $this->model->save();
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateData($request, $id) {
        $this->model = $this->model->find($id);
        $this->setData($request);
        return $this->model->save();
    }

    /**
     * @return mixed
     */
    public function getAll() {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByID($id) {
        return $this->model->find($id);
    }
}