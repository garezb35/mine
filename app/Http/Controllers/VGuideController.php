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
        return view('angel.guide.main');
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
        return view('angel.guide.news',$notice);
    }

    public function news(Request $request){
        $data = array();
        $notice_list = MNotice::orderBy('view',"DESC")->limit(10)->get();
        $notices = MNotice::orderBy('created_at',"DESC")->paginate(15);
        $data['notice_list'] = $notice_list;
        $data['notices'] = $notices;
        $data['game_list'] = MGameRate::limit(10)->get();
        return view('angel.guide.news_lst',$data);
    }

    public function howto(Request $request)
    {
        switch ($request->file)
        {
            case '02':
                return view('angel.guide.newuser.howto.file02');
            case '03':
                return view('angel.guide.newuser.howto.file03');
            case '04':
                return view('angel.guide.newuser.howto.file04');
            case '05':
                return view('angel.guide.newuser.howto.file05');
            case '06':
                return view('angel.guide.newuser.howto.file06');
            default:
                return view('angel.guide.newuser.howto');
        }
    }

    public function howto2(Request $request)
    {
        switch ($request->file)
        {
            case '12':
                return view('angel.guide.newuser.howto2.file12');
            case '13':
                return view('angel.guide.newuser.howto2.file13');
            case '14':
                return view('angel.guide.newuser.howto2.file14');
            case '15':
                return view('angel.guide.newuser.howto2.file15');
            case '16':
                return view('angel.guide.newuser.howto2.file16');
            case '17':
                return view('angel.guide.newuser.howto2.file17');
            default:
                return view('angel.guide.newuser.howto2');
        }
    }

    public function movie()
    {
        return view('angel.guide.newuser.movie');
    }

    public function safe(Request $request)
    {
        switch ($request->file) {
            case '02':
                return view('angel.guide.newuser.safe.file02');
            case '03':
                return view('angel.guide.newuser.safe.file03');
            case '04':
                return view('angel.guide.newuser.safe.file04');
            case '05':
                return view('angel.guide.newuser.safe.file05');
            case '06':
                return view('angel.guide.newuser.safe.file06');
            default:
                return view('angel.guide.newuser.safe');
        }
    }

    public function trade()
    {
        return view('angel.guide.newuser.trade');
    }

    public function failed()
    {
        return view('angel.guide.newuser.failed');
    }

    public function join()
    {
        return view('angel.guide.join');
    }

    public function charge()
    {
        return view('angel.guide.charge');
    }

    public function cancel()
    {
        return view('angel.guide.cancel');
    }

    public function myroom()
    {
        return view('angel.guide.myroom');
    }

    public function safe_grade_point()
    {
        return view('angel.guide.grade_point');
    }

    public function safe_grade_certify()
    {
        return view('angel.guide.grade_certify');
    }

    public function cancel_cancel()
    {
        return view('angel.guide.cancel.cancel');
    }

    public function cancel_bad()
    {
        return view('angel.guide.cancel.bad');
    }

    public function safe_char_trade(Request $request)
    {
        switch ($request->file) {
            case '02':
                break;
            default:
                return view('angel.guide.char_trade.char_trade');
        }
    }

    public function safe_deposit_check()
    {
        return view('angel.guide.char_trade.deposit_check');
    }

    public function safe_buyer_info()
    {
        return view('angel.guide.char_trade.buyer_info');
    }

    public function safe_char_transfer()
    {
        return view('angel.guide.char_trade.char_transfer');
    }

    public function safe_sell_end()
    {
        return view('angel.guide.char_trade.sell_end');
    }

    public function safe_buy_reg()
    {
        return view('angel.guide.char_trade.buy_reg');
    }

    public function safe_seller_info()
    {
        return view('angel.guide.char_trade.seller_info');
    }

    public function safe_take_over()
    {
        return view('angel.guide.char_trade.take_over');
    }

    public function safe_buy_end()
    {
        return view('angel.guide.char_trade.buy_end');
    }

    public function bar_sell_reg()
    {
        return view('angel.guide.bar_trade.sell_reg');
    }

    public function bar_buyer_req()
    {
        return view('angel.guide.bar_trade.buyer_req');
    }

    public function bar_seller_app()
    {
        return view('angel.guide.bar_trade.seller_app');
    }

    public function bar_buyer_pay()
    {
        return view('angel.guide.bar_trade.buyer_pay');
    }

    public function bar_re_bargain()
    {
        return view('angel.guide.bar_trade.re_bargain');
    }

    public function guide_withdraw()
    {
        return view('angel.guide.withdraw');
    }

    public function guide_charge()
    {
        return view('angel.guide.gcharge');
    }

    public function talk_box()
    {
        return view('angel.guide.convnce.talk_box');
    }

    public function hide_func()
    {
        return view('angel.guide.convnce.hide_func');
    }

    public function howto_search()
    {
        return view('angel.guide.convnce.howto_search');
    }

    public function security_number()
    {
        return view('angel.guide.add.security_number');
    }

    public function security_number_plus()
    {
        return view('angel.guide.add.security_number_plus');
    }

    public function user_reg_step1()
    {
        if($this->user)
            return redirect(route('index'));
        return view('angel.user.user_reg_step1');
    }

    public function user_reg_step2(Request $request)
    {
        if ($request->user_type > 0 && $request->user_type < 4)
        {
            return view('angel.user.user_reg_step2', array("userType" => $request->user_type));
        }
        else {
            return redirect(route('user_reg_step1'));
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
            return view('angel.user.user_reg_step3', $userInfo);
        }
        else {
            return redirect(route('user_reg_step1'));
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

        return view('angel.user.user_reg_step4');
    }

    public function user_lose_id(Request $request)
    {
        $userinfo = User::where('name', $request->user_name)
            ->whereDate('birthday', $request->user_birth)
            ->where('email', $request->user_email)
            ->where('number', $request->user_phone)
            ->first();
        $userId = "";
        if ($userinfo != null)
            $userId = $userinfo->loginId;

        $data = array(
            'user_name' => $request->user_name,
            'user_birth' => $request->user_birth,
            'user_email' => $request->user_email,
            'user_phone' => $request->user_phone,
            "user_id" => $userId
        );
        return view('angel.user.user_lose_id', $data);
    }

    public function user_lose_pwd(Request $request)
    {
        $userinfo = User::where('name', $request->user_name)
            ->whereDate('birthday', $request->user_birth)
            ->where('email', $request->user_email)
            ->where('loginId', $request->user_id)
            ->first();
        $isProcPass = false;
        if ($userinfo != null)
            $isProcPass = true;

        $data = array(
            'user_name' => $request->user_name,
            'user_birth' => $request->user_birth,
            'user_email' => $request->user_email,
            'user_id' => $request->user_id,
            "user_pass" => $isProcPass,
            "user_pass1" => $request->user_pass1,
            "user_pass2" => $request->user_pass2
        );

        if ($isProcPass && $request->user_pass1 != "" && $request->user_pass1 == $request->user_pass2) {
            User::where('id', $userinfo['id'])
                ->update(array('password' => Hash::make($request->user_pass1)));
            return redirect(route("login"));
        }
        else {
            return view('angel.user.user_lose_pwd', $data);
        }
    }
}
