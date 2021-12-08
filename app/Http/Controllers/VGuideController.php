<?php

namespace App\Http\Controllers;

use App\Models\MGameRate;
use App\Models\MNotice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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
        $notice['game_list'] = MGameRate::limit(10)->get();
        return view('mania.guide.news',$notice);
    }

    public function news(Request $request){
        $data = array();
        $notice_list = MNotice::orderBy('view',"DESC")->limit(10)->get();
        $notices = MNotice::orderBy('created_at',"DESC")->paginate(15);
        $data['notice_list'] = $notice_list;
        $data['notices'] = $notices;
        $data['game_list'] = MGameRate::limit(10)->get();
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
        switch ($request->file)
        {
            case '12':
                return view('mania.guide.newuser.howto2.file12');
            case '13':
                return view('mania.guide.newuser.howto2.file13');
            case '14':
                return view('mania.guide.newuser.howto2.file14');
            case '15':
                return view('mania.guide.newuser.howto2.file15');
            case '16':
                return view('mania.guide.newuser.howto2.file16');
            case '17':
                return view('mania.guide.newuser.howto2.file17');
            default:
                return view('mania.guide.newuser.howto2');
        }
    }

    public function movie()
    {
        return view('mania.guide.newuser.movie');
    }

    public function safe(Request $request)
    {
        switch ($request->file) {
            case '02':
                return view('mania.guide.newuser.safe.file02');
            case '03':
                return view('mania.guide.newuser.safe.file03');
            case '04':
                return view('mania.guide.newuser.safe.file04');
            case '05':
                return view('mania.guide.newuser.safe.file05');
            case '06':
                return view('mania.guide.newuser.safe.file06');
            default:
                return view('mania.guide.newuser.safe');
        }
    }

    public function trade()
    {
        return view('mania.guide.newuser.trade');
    }

    public function failed()
    {
        return view('mania.guide.newuser.failed');
    }

    public function join()
    {
        return view('mania.guide.join');
    }

    public function charge()
    {
        return view('mania.guide.charge');
    }

    public function cancel()
    {
        return view('mania.guide.cancel');
    }

    public function myroom()
    {
        return view('mania.guide.myroom');
    }

    public function safe_grade_point()
    {
        return view('mania.guide.grade_point');
    }

    public function safe_grade_certify()
    {
        return view('mania.guide.grade_certify');
    }

    public function cancel_cancel()
    {
        return view('mania.guide.cancel.cancel');
    }

    public function cancel_bad()
    {
        return view('mania.guide.cancel.bad');
    }

    public function safe_char_trade(Request $request)
    {
        switch ($request->file) {
            case '02':
                break;
            default:
                return view('mania.guide.char_trade.char_trade');
        }
    }

    public function safe_deposit_check()
    {
        return view('mania.guide.char_trade.deposit_check');
    }

    public function safe_buyer_info()
    {
        return view('mania.guide.char_trade.buyer_info');
    }

    public function safe_char_transfer()
    {
        return view('mania.guide.char_trade.char_transfer');
    }

    public function safe_sell_end()
    {
        return view('mania.guide.char_trade.sell_end');
    }

    public function safe_buy_reg()
    {
        return view('mania.guide.char_trade.buy_reg');
    }

    public function safe_seller_info()
    {
        return view('mania.guide.char_trade.seller_info');
    }

    public function safe_take_over()
    {
        return view('mania.guide.char_trade.take_over');
    }

    public function safe_buy_end()
    {
        return view('mania.guide.char_trade.buy_end');
    }

    public function bar_sell_reg()
    {
        return view('mania.guide.bar_trade.sell_reg');
    }

    public function bar_buyer_req()
    {
        return view('mania.guide.bar_trade.buyer_req');
    }

    public function bar_seller_app()
    {
        return view('mania.guide.bar_trade.seller_app');
    }

    public function bar_buyer_pay()
    {
        return view('mania.guide.bar_trade.buyer_pay');
    }

    public function bar_re_bargain()
    {
        return view('mania.guide.bar_trade.re_bargain');
    }

    public function guide_withdraw()
    {
        return view('mania.guide.withdraw');
    }

    public function guide_charge()
    {
        return view('mania.guide.gcharge');
    }

    public function talk_box()
    {
        return view('mania.guide.convnce.talk_box');
    }

    public function hide_func()
    {
        return view('mania.guide.convnce.hide_func');
    }

    public function howto_search()
    {
        return view('mania.guide.convnce.howto_search');
    }

    public function security_number()
    {
        return view('mania.guide.add.security_number');
    }

    public function security_number_plus()
    {
        return view('mania.guide.add.security_number_plus');
    }

    public function user_reg_step1()
    {
        return view('mania.user.user_reg_step1');
    }

    public function user_reg_step2(Request $request)
    {
        if ($request->user_type > 0 && $request->user_type < 4)
        {
            return view('mania.user.user_reg_step2', array("userType" => $request->user_type));
        }
        else {
            redirect(route('user_reg_step1'));
        }
    }

    public function user_reg_step3(Request $request)
    {
        if ($request->userType > 0 && $request->userType < 4 && $request->userName != "") {
            $userInfo = array(
                "userType" => $request->userType,
                "userName" => $request->userName,
                "userBirth" => $request->userBirth,
                "phoneType" => $request->phoneType,
                "phoneNum1" => $request->phoneNum1,
                "phoneNum2" => $request->phoneNum2,
                "phoneNum3" => $request->phoneNum3,
            );
            return view('mania.user.user_reg_step3', $userInfo);
        }
        else {
            redirect(route('user_reg_step1'));
        }
    }

    public function user_reg_step4(Request $request)
    {
        $snzEmail = "";
        if ($request->user_email_host != "direct") {
            $snzEmail = $request->user_email."@".$request->user_email_host;
        }
        else {
            $snzEmail = $request->user_email."@".$request->user_email_direct;
        }

        $userInfo = array(
            "email" => $snzEmail,
            "loginId" => $request->user_id,
            "name" => $request->user_name,
            "nickname" => $request->user_nickname,
            "password" => Hash::make($request->user_password),
            "birthday" => $request->birth,
            "api_token" => Hash::make(Str::random(60)),
            "number_type" => $request->user_mobile_type,
            "number" => sprintf("%s.%s.%s)", $request->user_mobileA, $request->user_mobileB, $request->user_mobileC),
            "user_type" => $request->user_type
        );
        User::create($userInfo);

        return view('mania.user.user_reg_step4');
    }

    public function user_lose_id()
    {
        return view('mania.user.user_lose_id');
    }

    public function user_lose_pwd()
    {
        return view('mania.user.user_lose_pwd');
    }
}
