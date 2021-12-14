<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class VCertifyController extends BaseController
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
    public function user_certify(Request $request)
    {
        return view('angel.certify.payment.user_certify');
    }
}
