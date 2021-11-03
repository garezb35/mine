<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class VCustomerController extends BaseController
{
    public function __construct()
    {

    }

    /**
     * 고객센터
     */
    public function customer()
    {
        return view('mania.customer.index');
    }

    /**
     * 나의 질문과 답변
     */
    public function myqna_list()
    {
        return view('mania.customer.myqna.list');
    }
    public function myqna_view()
    {
        return view('mania.customer.myqna.view');
    }
    /**
     * FAQ
     */
    public function faq()
    {
        return view('mania.customer.faq');
    }
}
