<?php

namespace App\Http\Controllers;

use App\Models\MNotice;
use Illuminate\Http\Request;


class VGuideController extends BaseController
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
        return view('mania.guide.main');
    }
    public function view(Request $request){
        $seq = $request->seq;
        $notice = MNotice::where('id',$seq)->first();
        if(empty($notice)){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        MNotice::where('id',$notice['id'])->update(['view'=>$notice['view']+1]);
        $notice_list = MNotice::orderBy('view',"DESC")->limit(10)->get();
        $notice['notice_list'] = $notice_list;
        return view('mania.guide.news',$notice);
    }
    public function news(Request $request){
        $data = array();
        $notice_list = MNotice::orderBy('view',"DESC")->limit(10)->get();
        $notices = MNotice::orderBy('created_at',"DESC")->paginate(15);
        $data['notice_list'] = $notice_list;
        $data['notices'] = $notices;
        return view('mania.guide.news_lst',$data);
    }
}
