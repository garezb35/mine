<?php

namespace App\Http\Controllers;
use App\Models\MItem;
use App\Models\MTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VMyRoomController extends BaseController
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
        return view('mania.myroom.main');
    }

    public function message()
    {
        return view('mania.myroom.message');
    }

    public function alarm_sell_list()
    {
        return view('mania.myroom.alarm_sell_list');
    }

    public function alarm_add()
    {
        return view('mania.myroom.alarm_add');
    }

    public function complete_sell()
    {
        return view('mania.myroom.complete_sell');
    }

    public function complete_cancel_sell()
    {
        return view('mania.myroom.complete_cancel_sell');
    }

    public function complete_cancel_buy()
    {
        return view('mania.myroom.complete_cancel_buy');
    }

    public function complete_buy()
    {
        return view('mania.myroom.complete_buy');
    }

    public function complete_report()
    {
        return view('mania.myroom.complete_report');
    }

    public function sell_pay_wait_view(Request $request){

        $type = $request->type;
        $id = $request->id;
        $game = null;
        if($type == 'sell'){
            $game = MItem::with('payitem','game','server','other')
                ->where('orderNo', $id)
                ->where('userId', $this->user->id)
                ->where('type', 'sell')
                ->first();
        }
        else{
            $game = MItem::with('payitem','game','server','user')
                ->where('orderNo', $id)
                ->where('toId', $this->user->id)
                ->where('type', 'buy')
                ->first();
        }

        if(empty($game) || empty($game['payitem'])){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        if($game['payitem']['status'] == 1 && $game['status'] > 0){
            return redirect('/myroom/sell/sell_ing_view?id='.$game['orderNo'].'&type='.$game['type']);
        }

        $game['seller'] = $this->user;
        if($type == 'sell'){
            $game['buyer'] = $game['other'];
            $game['seller']['character'] = $game['user_character'];
            $game['buyer']['character'] = $game['payitem']['character'];
        }
        else{
            $game['buyer'] = $game['user'];
            $game['buyer']['character'] = $game['user_character'];
            $game['seller']['character'] = $game['payitem']['character'];
        }

        return view('mania.myroom.sell_pay_wait_view', $game);
    }

    public function sell_regist()
    {
        return view('mania.myroom.sell_regist');
    }
    public function sell_ing()
    {
        return view('mania.myroom.sell_ing');
    }

    public function sell_check()
    {
        return view('mania.myroom.sell_check');
    }

    public function sell_regist_view(Request $request)
    {
        $id = $request->id;
        $game = MItem::with(['user','game','server','payitem'])->
        where("orderNo",$id)->
        where("userId",$this->user->id)->
        where('type','sell')->first();

        if(empty($game)){
            echo '<script>alert("잘못된 요청입니다.");window.history.back()</script>';
            return;
        }
        $game['cuser']=  $this->user;
        if($game['status'] > 0 && $game['status'] <= 3 && !empty($game['toId']))
        {
            return Redirect::to('myroom/sell/sell_ing_view?id='.$game['orderNo']);
        }
        return view('mania.myroom.sell_regist_view',$game);
    }

    public function sell_re_reg(Request $request)
    {
        $title_row = MTitle::where('userId',$this->user->id)->first();
        $title = empty($title_row) ? '' : $title_row['title'];
        $id = $request->id;
        $game = MItem::with('game','server','payitem')->where("orderNo",$id)->where('type','sell')->where('userId',$this->user->id)->where('status',0)->first();
        if(empty($game) || !empty($game['payitem'])){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        $game['cuser'] = $this->user;
        $game['title'] = $title;
        return view('mania.myroom.sell_re_reg',$game);
    }

    public function buy_regist()
    {
        return view('mania.myroom.buy_regist');
    }

    public function buy_regist_view(Request $request)
    {
        $id = $request->id;
        $game = MItem::with('game','server')->where('orderNo',$id)->where('userId',$this->user->id)->first();
        if(empty($game)){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        $game['cuser'] = $this->user;
        return view('mania.myroom.buy_regist_view',$game);
    }

    public function buy_re_reg(Request $request)
    {
        $title_row = MTitle::where('userId',$this->user->id)->first();
        $title = empty($title_row) ? '' : $title_row['title'];
        $id = $request->id;
        $game = MItem::with(['payitem','game','server'])->where("orderNo",$id)->where('type','buy')->where('userId',$this->user->id)->where('status',0)->first();
        if(empty($game) || !empty($game['payitem'])){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        $game['cuser'] = $this->user;
        $game['title'] = $title;
        return view('mania.myroom.buy_re_reg',$game);
    }
    public function buy_check()
    {
        return view('mania.myroom.buy_check');
    }

    public function buy_ing()
    {
        return view('mania.myroom.buy_ing');
    }

    public function buy_ing_view(Request $request){
        $orderNo = $request->id;
        $type = $request->type;
        if(empty($type)){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }

        if($type == 'sell'){
            $game = MItem::with('game','server','payitem','user.roles')->
            where('orderNo',$orderNo)->
            where('toId',$this->user->id)->
            where('type',$type)->
            where('status','>',0)->first();
            if(empty($game) || empty($game['payitem']) || $game['payitem']['status'] == 0 || empty($game['other'])){
                echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
                return;
            }
            $game['cuser'] = $this->user;     // 구매자
        }
        if($type == 'buy'){
            $game = MItem::
            with('game','server','payitem','other.roles')->
            where('orderNo',$orderNo)->
            where('userId',$this->user->id)->
            where('type',$type)->
            where('status','>',0)->first();
            if(empty($game) || empty($game['payitem']) || empty($game['other']) || $game['payitem']['status'] == 0){
                echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
                return;
            }
            $game['cuser'] = $this->user;// 구매자
            $game['user'] = $game['other']; // 구매자
        }

        return view('mania.myroom.buy_ing_view',$game);
    }

    public function buy_pay_wait()
    {

        return view('mania.myroom.buy_pay_wait');
    }

    public function buy_pay_wait_view(Request $request){
        $type = $request->type;
        $id = $request->id;
        $buyer=  $seller = "";
        if($type == 'sell'){
            $game = MItem::with('server','game','payitem','user.roles')
                    ->where('orderNo', $id)
                    ->where('toId', $this->user->id)
                    ->where('type', 'sell')->first();
            if(empty($game) || empty($game['payitem']) || $game['payitem']['status'] != 0  || $game['status'] !=0){
                echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
                return;
            }
            $game['buyer']=  $this->user;
            $game['seller'] = $game['user'];
            $game['buyer']['character'] = $game['payitem']['character'];
            $game['seller']['character'] = $game['user_character'];
        }

        else{
            $game = MItem::with('server','game','payitem','other.roles')
                ->where('orderNo', $id)
                ->where('userId', $this->user->id)
                ->where('type', 'buy')->first();
            if(empty($game) || empty($game['payitem']) || $game['payitem']['status'] != 0 || $game['status'] !=0){
                echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
                return;
            }
            $game['buyer']=  $this->user;
            $game['seller'] = $game['other'];
            $game['seller']['character'] = $game['payitem']['character'];
            $game['buyer']['character'] = $game['user_character'];
        }

        return view('mania.myroom.buy_pay_wait_view', $game);
    }

    /***************** Resion 마일리지 ****************/
    /**
     * 마이룸 > 마일리지 > 내 마일리지 > 마이리지 현황
     */
    public function my_mileage_index()
    {
        return view('mania.myroom.mileage.my_mileage.index');
    }
    /**
     * * 마이룸 > 마일리지 > 내 마일리지 > 마일리지 달력보기
     */
    public function my_mileage_calendar()
    {
        return view('mania.myroom.mileage.my_mileage.calendar');
    }
    /**
     * * 마이룸 > 마일리지 > 내 마일리지 > 마일리지 달력보기
     */
    public function my_mileage_detail_list()
    {
        return view('mania.myroom.mileage.my_mileage.detail_list');
    }
    /**
     * 마이룸 > 마일리지 > 마일리지 충전
     */
    public function mileage_guide_charge()
    {
        return view('mania.myroom.mileage.guide.charge');
    }
    /**
     * 마이룸 > 마일리지 > 마일리지 출금
     */
    public function payment_index()
    {
        return view('mania.myroom.mileage.payment.index');
    }
    /**
     * 마이룸 > 마일리지 > 마일리지  > 휴대폰번호 출금
     */
    public function payment_phone()
    {
        return view('mania.myroom.mileage.payment.payment_phone');
    }
    /**
     * 마이룸 > 마일리지 > 마일리지  > 마일리지 출금내역 보기
     */
    public function payment_list()
    {
        return view('mania.myroom.mileage.payment.payment_list');
    }
    /**
     * 마이룸 > 마일리지 > 마일리지  > 휴대폰번호 출금내역 보기
     */
    public function payment_phone_list()
    {
        return view('mania.myroom.mileage.payment.payment_phone_list');
    }
    /**
     * 마이룸 > 마일리지 > 마일리지  > 마일리지 전환
     */
    public function culturecash()
    {
        return view('mania.myroom.mileage.payment.change.culturecash');
    }

    public function sell_ing_view(Request $request){
        $buyer = "";
        if($request->type == 'sell'){
            $game = MItem::with('server','game','other','payitem')
                ->where('orderNo',$request->id)
                ->where('userId',$this->user->id)
                ->where('type', $request->type)
                ->where("status",">", 0)
                ->first();

            if(empty($game) || empty($game['payitem']) || empty($game['other'])){
                echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
                return;
            }
            $game['user']=  $game['other'];
            $game['cuser'] = $this->user;
            $game['buy_character'] = $game['payitem']['character'];
            $game['sell_character'] = $game['user_character'];
        }
        else{
            $game = MItem::with('server','game','user','payitem')
                ->where('orderNo',$request->id)
                ->where('toId',$this->user->id)
                ->where('type', $request->type)
                ->where("status",">", 0)
                ->first();
            if(empty($game) || empty($game['payitem']) || empty($game['user'])){
                echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
                return;
            }
            $game['cuser'] = $this->user;
            $game['sell_character'] = $game['payitem']['character'];
            $game['buy_character'] = $game['user_character'];
        }

        return view('mania.myroom.sell_ing_view',$game);
    }

    public function buy_check_view(Request $request){
        $id = $request->id;
        $game = MItem::with(['game','server','payitem','bargains'=>function($query){
            $query->where("userId", $this->user->id);
        }])->where('orderNo',$id)
                ->where('type','sell')
                ->where('userId',"!=", $this->user->id)
                ->whereNull('toId')
                ->where('user_goods_type','bargain')
                ->where('status', 0)
                ->first();

        if(empty($game) || !empty($game['payitem']) || sizeof($game['bargains']) == 0){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        $game['seller'] = $this->user;
        return view('mania.buy.buy_check_view',$game);
    }

    public function sell_check_view(Request $request){
        $id = $request->id;
        var_dump($id);
        return;
        $game = MItem::with(['game','server','bargains','payitem'])
            ->whereHas('bargains',function($query){
              $query->where('id','>',0);
            })
            ->where('orderNo',$id)
            ->where('userId', $this->user->id)
            ->where('type','sell')
            ->where('user_goods_type','bargain')
            ->where('status',0)
            ->whereNull('toId')
            ->first();
        if(empty($game) || !empty($game['payitem'])){
            $game_temp = MItem::
                whereHas('payitem',function($query){
                    $query->where('id','>',0);
                })
                ->where('userId', $this->user->id)
                ->where('type','sell')
                ->where('user_goods_type','bargain')
                ->where('status',0)
                ->where('toId','>',0)
                ->first();
            if(!empty($game_temp)){
                return redirect('myroom/sell/sell_pay_wait_view?id='.$game_temp['orderNo'].'&type=sell');
            }
            else{
                echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
                return;
            }
        }
        $game['seller'] = $this->user;
        return view('mania.sell.sell_check_view',$game);
    }

    public function search(Request $request){
        echo '<script>alert("서비스가 원할하지 않습니다.");window.history.back();</script>';
        return;
    }
}
