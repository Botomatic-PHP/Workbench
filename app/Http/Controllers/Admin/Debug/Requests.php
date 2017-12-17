<?php

namespace App\Http\Controllers\Admin\Debug;

use Illuminate\Http\Request;

class Requests extends \App\Http\Controllers\Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('default.pages.debug.requests');
    }
}
