<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class Home extends \App\Http\Controllers\Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('default.pages.home');
    }
}
