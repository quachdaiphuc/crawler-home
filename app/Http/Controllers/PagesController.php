<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function getHome()
    {
        return redirect()->route('admin_dashboard');
    }

}
