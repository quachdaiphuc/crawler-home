<?php
namespace App\Business;
use App\Commons\Constant;
use App\Models\Author;

class AuthorBusiness {

    /**
     * @return mixed
     */
    public function getAll() {
        return Author::all();
    }

    /**
     * get list author
     * @return mixed
     */
    public function getListAuthor() {
        $author = $this->getAll();
        $arrAuthor = array(
            '' => Constant::SELECT_ONE,
        );
        foreach($author as $item) {
            $arrAuthor[$item->id] =  $item->name;
        }
        return $arrAuthor;
    }
}