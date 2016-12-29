<?php

namespace App\Http\Controllers\Admin;

use App\Business\NewsBusiness;
use App\Commons\UploadFileImage;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Business\AuthorBusiness;
use Illuminate\Support\Facades\Redirect;

class NewsController extends Controller
{
    private $model;

    private  $newsBusiness;

    /**
     * @var array
     */
    private  $dataInput = array();

    /**
     * @param authorBusiness $authorBusiness
     */
    function __construct(NewsBusiness $newsBusiness) {
        $this->newsBusiness = $newsBusiness;
        $this->model = new News();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $viewData = $this->newsBusiness->getAll();
        return view('protected.admin.news.index', compact('viewData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $requests)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $requests, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $this->model->find($id)->delete();
    }
}
