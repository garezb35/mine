<?php

namespace App\Http\Controllers;

use App\Models\MCancelReason;
use App\Models\MGame;
use App\Models\MGift;
use App\Models\MItem;
use App\Models\MMygame;
use App\Models\MOrderNotification;
use App\Models\MPayhistory;
use App\Models\MPayitem;
use App\Models\MPopularCharacter;
use App\Models\MRole;
use App\Models\MTitle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VBuyController extends BaseController
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
        $title_row = MTitle::where('userId',$this->user->id)->first();
        $title = empty($title_row) ? '' : $title_row['title'];
        $popular = MPopularCharacter::with('game')->get()->toArray();
        $role = MRole::orderBy('level',"ASC")->get()->toArray();
        $mygame  = MMygame::where('type','buy')->where('userId',$this->user->id)->get();
        $highlight = $premium = $quickicon = 0;
        $gift = MGift::where('userId',$this->user->id)->get();
        foreach($gift as $value){
            if($value['type'] == 1)
                $premium = $value['time'];
            if($value['type'] == 2)
                $highlight = $value['time'];
            if($value['type'] == 3)
                $quickicon = $value['time'];
        }
        return view('mania.buy.main',[
            'popular'=>$popular,
            'user'=>$this->user,
            'title'=>$title,
            'role' =>$role,
            'mygame'=>$mygame,
            'premium'=>$premium,
            'highlight'=>$highlight,
            'quickicon'=>$quickicon,
        ]);
    }

    public function index_view(Request $request)
    {
        $orderNo=  $request->id;
        $item = MItem::
        with(['game','server'])->
        where('userId',$this->user->id)->
        where('orderNo',$orderNo)->
        where('type','buy')->first();
        if($item == null) {
            echo '<script>alert("정상적인 경로를 이용해주세요.");window.history.back();</script>';
            return;
        }

        return view('mania.buy.index_view',$item);
    }

    public function list_search(Request $request)
    {
        $params = $request->all();
        $params['overlap'] = !empty($params['overlap']) ? $params['overlap'] : '';
        $params['goods_type'] = !empty($params['goods_type']) ? $params['goods_type'] : '1';
        $params['trade_state'] = !empty($params['trade_state']) ? $params['trade_state'] : '';
        $params['credit_type'] = !empty($params['credit_type']) ? $params['credit_type'] : '0';
        $params['goods_type'] = !empty($params['goods_type']) && $params['goods_type'] !=1  ? $params['goods_type'] : 'all';
        $params['excellent'] = !empty($params['excellent']) ? $params['excellent'] : '';
        $params['discont'] = !empty($params['discont']) ? $params['discont'] : '';
        $params['speed'] = !empty($params['speed']) ? $params['speed'] : '';
        $roles = MRole::orderBy('level',"ASC")->get()->toArray();
        $params['roles'] = $roles;
        return view('mania.buy.list_search',$params);
    }

    public function buy_application(Request $request)
    {
        $id = $request->id;
        $game = MItem::with(['game','server','user.roles','payitem','bargains','bargain_requests'=>function($query){
            $query->where('userId',$this->user->id);
        }])
            ->where('orderNo',$id)
            ->first();
        if(empty($game)){
            echo '<script>alert("정상적인 경로를 이용해주세요.");window.history.back();</script>';
            return;
        }
        if($game['userId'] == $this->user->id){
            if($game['type'] == 'sell'){
                if(empty($game['payitem']) && empty($game['toId']) && sizeof($game['bargains']) == 0 && $game['status'] == 0){
                    return redirect('/sell/index_view?id='.$id.'&type=sell');
                }
                if(!empty($game['payitem']) && $game['payitem']['status'] == 0 && $game['status'] == 0 && !empty($game['toId'])){
                    return redirect('/myroom/sell/sell_pay_wait_view?id='.$id.'&type=sell');
                }
                if(!empty($game['payitem']) && $game['payitem']['status'] == 1 && $game['status'] > 0 && !empty($game['toId'])){
                    return redirect('/myroom/sell/sell_ing_view?id='.$id.'&type=sell');
                }
                if(empty($game['payitem']) && empty($game['toId']) && sizeof($game['bargains']) > 0){
                    return redirect('/myroom/sell/sell_check_view?id='.$id);
                }
            }
            else{
                if(empty($game['payitem']) && empty($game['toId']) && $game['status'] == 0){
                    return redirect('/buy/index_view?id='.$id.'&type=buy');
                }
                if(!empty($game['payitem']) && $game['payitem']['status'] == 0 && $game['status'] == 0 && !empty($game['toId'])){
                    return redirect('/myroom/buy/buy_pay_wait_view?id='.$id.'&type=buy');
                }
                if(!empty($game['payitem']) && $game['payitem']['status'] == 1 && $game['status'] > 0 && !empty($game['toId'])){
                    return redirect('/myroom/buy/buy_ing_view?id='.$id.'&type=buy');
                }
            }
        }
        else{
            if($game['type'] == 'sell'){
                if(!empty($game['toId'])){
                    if($game['toId'] != $this->user->id){
                        echo '<script>alert("거래중 물품입니다.");window.history.back();</script>';
                        return;
                    }
                    if(!empty($game['payitem']) && $game['payitem']['status'] == 0 && $game['status'] == 0 ){
                        return redirect('/myroom/buy/buy_pay_wait_view?id='.$id.'&type=sell');
                    }
                    if(!empty($game['payitem']) && $game['payitem']['status'] == 1 && $game['status'] > 0){
                        return redirect('/myroom/buy/buy_ing_view?id='.$id.'&type=sell');
                    }
                }
                else{
                    if(!empty($game['payitem']) && $game['payitem']['status'] == 0 && $game['status'] == 0 && !empty($game['bargain_requests']) && sizeof($game['bargain_requests']) > 0){
                        return redirect('/myroom/buy/buy_check_view?id='.$id);
                    }
                }
            }
            if($game['type'] == 'buy'){
                if(!empty($game['toId'])){
                    if($game['toId'] != $this->user->id){
                        echo '<script>alert("거래중 물품입니다.");window.history.back();</script>';
                        return;
                    }
                    if(!empty($game['payitem']) && $game['payitem']['status'] == 0 && $game['status'] == 0 ){
                        return redirect('/myroom/sell/sell_pay_wait_view?id='.$id.'&type=buy');
                    }
                    if(!empty($game['payitem']) && $game['payitem']['status'] == 1 && $game['status'] > 0){
                        return redirect('/myroom/sell/sell_ing_view?id='.$id.'&type=buy');
                    }
                }
            }
        }
        $game['cuser'] =User::with('roles')->where('id',$this->user->id)->first();
        return view('mania.buy.buy_application',$game);
    }

    public function trade_cancel(Request $request){
        $id = $request->id;
        $game = MItem::with('payitem')->where('orderNo',$id)->first();
        $buyer = $seller = "";

        if(empty($game) || empty($game['payitem']) || $game['payitem']['status'] != 1  || empty($game['toId'] || str_contains($game['status'],2))||
            ($game['type'] == 'sell' && $this->user->id != $game['toId']) ||
            ($game['type'] == 'buy' && $this->user->id != $game['userId'])){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        if($game['type'] == 'sell'){
            $buyer = $game['toId'];
            $seller = $game['userId'];
        }
        else{
            $buyer = $game['userId'];
            $seller = $game['toId'];
        }

        MItem::where('orderNo', $game['orderNo'])->update([
            'status'=>0,
            'toId'=>null
        ]);
        MPayitem::where("id",$game['payitem']['id'])->update([
            'status'=>10
        ]);
        User::where('id',$buyer)->update([
           'mileage'=>DB::raw('mileage + '.$game['payitem']['price'])
        ]);
        User::where('id',$seller)->update([
            'mileage'=>DB::raw('mileage - '.$game['payitem']['price'])
        ]);

        MPayhistory::insert([
             'price'=>$game['payitem']['price'],
             'status'=>1,
             'userId'=>$buyer,
             'pay_type'=>21,
             'orderNo'=>$id
            ]);
        MPayhistory::insert([
            'price'=>$game['payitem']['price'],
            'status'=>1,
            'userId'=>$seller,
            'pay_type'=>20,
            'orderNo'=>$id,
            'minus'=>1
        ]);
        MOrderNotification::updateOrCreate([
            'userId'=>$this->user->id,
            'orderNo'=>$id
        ],[
            'reason'=>'거래취소',
            'type'=>2
        ]);
        MPayitem::where('id',$game['payitem']['id'])->delete();
        echo '<script>alert("성공적으로 취소되었습니다.");location.href="/";</script>';
        return;
    }

    public function getSellIndexTemplate(Request $request){
        $result =  "";
        $game_code = $request->game_code;
        $last_alias = $request->last_alias;
        $user_goods_type = $request->user_goods_type;
        $game = MGame::where("parent",$game_code)->where('depth',2)->where("game",$last_alias)->first();
        if(!empty($game)){
            $result = '';

            if($user_goods_type == 'general'){
                if($game->gamemoney_unit ==1){
                    $result .=   '<tr>
                                    <th>구매수량</th>
                                    <td>
                                                        <div class="unit_type" id="unit_type">
                                                                        <label><input type="radio" name="gamemoney_unit" class="g_radio" value="1" checked>없음</label>
                                                    <label><input type="radio" name="gamemoney_unit" class="g_radio" value="만">만</label>
                                                    <label><input type="radio" name="gamemoney_unit" class="g_radio" value="억">억</label>
                                                                        <label class="f_blue1 f_small">(단위)</label>
                                            </div>
                                                                <div id="game_money">
                                                    <input type="text" name="user_quantity" id="user_quantity" maxlength="7" class="g_text f_right rad13">
                                                    <span class="unit"></span> '.$game->alias.'
                                                    <span class="g_txtbtn first_btn radbtn" id="plus10" value="10">+10</span>
                                                    <span class="g_txtbtn radbtn" id="plus50" value="50">+50</span>
                                                    <span class="g_txtbtn radbtn" id="plus100" value="100">+100</span>
                                                    <span class="g_txtbtn radbtn" id="plus500" value="500">+500</span>
                                                    <span class="g_txtbtn radbtn" id="plus1000" value="1000">+1000</span>
                                                    <span class="g_txtbtn radbtn" id="initial" value="0">초기화</span>
                                                </div>
                                                        </td>
                                </tr>';
                }
                $result .= '<tr>
                            <th>구매금액</th>
                            <td>
                                <input type="text" name="user_price" id="user_price" maxlength="10" class="g_text f_right rad13"> 원 (3,000원 이상, 10원 단위 등록 가능)
                            </td>
                        </tr>';
                if($game->purchase_enable == 1){
                    $result .='<tr>
        <th>캐릭터 정보</th>
        <td>
            <select name="account_type" id="account_type">
                <option value="">선택하세요.</option>
                <option value="1">Guest</option>
                <option value="2">Google</option>
                <option value="3">FaceBook</option>
                <option value="9">기타</option>
            </select>
            <select name="purchase_type" id="purchase_type" disabled>
                <option value="">선택하세요.</option>
                <option value="1">본인(1대)</option>
                <option value="9">그 외</option>
            </select>
            <select name="payment_existence" id="payment_existence" disabled>
                <option value="">선택하세요.</option>
                <option value="1">결제내역 O</option>
                <option value="2">결제내역 x</option>
            </select>
            <select name="multi_access" id="multi_access" disabled>
                <option value="">선택하세요.</option>
                <option value="1">이중연동 O</option>
                <option value="2">이중연동 x</option>
            </select>
            <input type="text" class="g_text mode-active" name="character_id" id="character_id" placeholder="게임 ID" size="30">
            <div class="character_noti">
                ※ 캐릭터 정보 주의사항<br>
                - 모든 정보 입력 후 물품 등록이 가능합니다.<br>
                    - 캐릭터 정보를 허위로 입력 시 , 등록자[판매자]에게 책임이 있으며 거래에 불이익을 받을 수 있습니다.
            </div>
        </td>
    </tr>';
                }
                $result .= '<tr>
                            <th>캐릭터명</th>
                            <td>
                                <div class="dfServer" id="dfServer">
                                                </div>
                                <div class="g_left">
                                    <input type="text" class="g_text mode-active rad13" name="user_character" maxlength="30" id="user_character"> 물품을 전달 받으실 본인의 캐릭터명
                                    <span id="sub_text" class="f_red1"></span>
                                </div>
                                <p class="character_noti">* 본인이 사용하는 서버/캐릭터명 미 선택 및 미 기재 시 문제가 발생될 수 있으며, 거래신청자에게 책임이 있습니다.</p>
                            </td>
                        </tr>';
            }

            if($user_goods_type == 'division'){
                if($game->gamemoney_unit == 1){
                    $result .= '<tr>
                                        <th>구매수량</th>
                                        <td>
                                                            <div class="unit_type" id="unit_type">
                                                                            <label><input type="radio" name="gamemoney_unit" class="g_radio" value="1" checked>없음</label>
                                                        <label><input type="radio" name="gamemoney_unit" class="g_radio" value="만">만</label>
                                                        <label><input type="radio" name="gamemoney_unit" class="g_radio" value="억">억</label>
                                                                            <label class="f_blue1 f_small">(단위)</label>
                                                </div>
                                                                <div id="game_money">
                                                    최소
                                                    <input type="text" name="user_quantity_min" id="user_quantity_min" maxlength="7" class="g_text f_right rad13">
                                                    <span class="unit"></span> '.$game->alias.' ~
                                                    최대
                                                    <input type="text" name="user_quantity_max" id="user_quantity_max" maxlength="7" class="g_text f_right rad13">
                                                    <span class="unit"></span> '.$game->alias.'                </div>
                                                        </td>
                                    </tr>';
                }

                else{
                    $result .= '<tr>
        <th>구매수량</th>
        <td>
                            <div id="game_money">
                    최소
                    <input type="text" name="user_quantity_min" id="user_quantity_min" maxlength="7" class="g_text f_right rad13">
                    <span class="unit"></span> 개 ~
                    최대
                    <input type="text" name="user_quantity_max" id="user_quantity_max" maxlength="7" class="g_text f_right rad13">
                    <span class="unit"></span> 개                </div>
                        </td>
    </tr>';
                }

                if($game->discount == 1){
                    $result .= '<tr>
        <th>구매금액</th>
        <td>
                        <input type="text" name="user_division_unit" id="user_division_unit" maxlength="7" class="g_text f_right rad13" size="18">
            <span class="unit"></span> '.$game->alias.' 당
            <input type="text" name="user_division_price" id="user_division_price" maxlength="10" class="g_text f_right rad13" size="18"> 원에 판매합니다.
            <span class="f_small f_black1">(100원 이상, 10원 단위 등록 가능)</span>
        </td>
        </tr>
    <tr>
        <th>캐릭터명</th>
        <td>
            <div class="dfServer" id="dfServer">
                            </div>
            <div class="g_left">
                <input type="text" class="g_text mode-active rad13" name="user_character" maxlength="30" id="user_character"> 물품을 전달 받으실 본인의 캐릭터명
                <span id="sub_text" class="f_red1"></span>
            </div>
            <p class="character_noti">* 본인이 사용하는 서버/캐릭터명 미 선택 및 미 기재 시 문제가 발생될 수 있으며, 거래신청자에게 책임이 있습니다.</p>
        </td>
    </tr>';
                }
                else{
                    $result .= '<tr>
        <th>구매금액</th>
        <td>
                        <input type="text" name="user_division_unit" id="user_division_unit" maxlength="7" class="g_text f_right rad13" size="18">
            <span class="unit"></span> '.$game->alias.' 당
            <input type="text" name="user_division_price" id="user_division_price" maxlength="10" class="g_text f_right rad13" size="18"> 원에 판매합니다.
            <span class="f_small f_black1">(100원 이상, 10원 단위 등록 가능)</span>
        </td>
        </tr>
    <tr>
        <th>캐릭터명</th>
        <td>
            <div class="dfServer" id="dfServer">
                            </div>
            <div class="g_left">
                <input type="text" class="g_text mode-active rad13" name="user_character" maxlength="30" id="user_character"> 물품을 전달 받으실 본인의 캐릭터명
                <span id="sub_text" class="f_red1"></span>
            </div>
            <p class="character_noti">* 본인이 사용하는 서버/캐릭터명 미 선택 및 미 기재 시 문제가 발생될 수 있으며, 거래신청자에게 책임이 있습니다.</p>
        </td>
    </tr>';
                }
            }
        }
        echo $result;
    }

    public function buy_list(Request $request){
        $params = $request->all();
        $params['overlap'] = !empty($params['overlap']) ? $params['overlap'] : '';
        $params['goods_type'] = !empty($params['goods_type']) && $params['goods_type'] !=1  ? $params['goods_type'] : 'all';
        return view('mania.buy.buy_list',$params);
    }
}
