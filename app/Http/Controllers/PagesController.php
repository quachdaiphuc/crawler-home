<?php

namespace App\Http\Controllers;

use App\Business\AuthorBusiness;
use App\Business\CategoryBusiness;
use App\Business\ProductBusiness;
use App\Commons\Constant;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class PagesController extends Controller
{
    private $categoryBusiness;
    private $productBusiness;
    private $authorBusiness;

    /*
     * constructor
     * */
    function __construct(CategoryBusiness $categoryBusiness, ProductBusiness $productBusiness, AuthorBusiness $authorBusiness) {
        $this->categoryBusiness = $categoryBusiness;
        $this->productBusiness = $productBusiness;
        $this->authorBusiness = $authorBusiness;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getHome()
    {
        return redirect()->route('admin_dashboard');
        //return view('pages.home', compact('categories', 'products'));
    }

}
