<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class VEventController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // echo "test";
        return view('angel.event.main');
    }
}
