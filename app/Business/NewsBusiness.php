<?php
namespace App\Business;
use App\Models\News;

class NewsBusiness {

    /**
     * @return mixed
     */
    public function getAll() {
        return News::all();
    }
}