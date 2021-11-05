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
        $data['searchWord'] = "";
        if (isset($request->searchWord)) {
            $data['searchWord'] = $request->searchWord;
            $data['faqRecord'] = MFag::where('content', 'like', '%'.$data['searchWord'].'%')->get()->toArray();
        }
        else {
            $data['faqRecord'] = MFag::limit(6)->get()->toArray();
        }

        return view('mania.customer.index', $data);
    }

    /**
     * 1:1 문의하기
     */
    public function customer_report()
    {
        return view('mania.customer.report');
    }

    /**
     * 신규게임
     */
    public function customer_newgame()
    {
        return view('mania.customer.newgame');
    }

    /**
     * 안전거래
     */
    public function customer_safety()
    {
        return view('mania.customer.safety');
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

}
