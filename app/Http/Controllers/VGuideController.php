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

    public function howto(Request $request)
    {
        switch ($request->file)
        {
            case '02':
                return view('mania.guide.newuser.howto.file02');
            case '03':
                return view('mania.guide.newuser.howto.file03');
            case '04':
                return view('mania.guide.newuser.howto.file04');
            case '05':
                return view('mania.guide.newuser.howto.file05');
            case '06':
                return view('mania.guide.newuser.howto.file06');
            default:
                return view('mania.guide.newuser.howto');
        }
    }

    public function howto2(Request $request)
    {
        return view('mania.guide.newuser.howto2');
    }
}
