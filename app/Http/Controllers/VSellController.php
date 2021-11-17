<?php

namespace App\Http\Controllers;

use App\Models\MGift;
use App\Models\MItem;
use App\Models\MMygame;
use App\Models\MPopularCharacter;
use App\Models\MRole;
use App\Models\MTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VSellController extends BaseController
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
        return view('mania.sell.main',[
            'popular'=>$popular,
            'user'=>$this->user,
            'title'=>$title,
            'mygame'=>$mygame,
            'premium'=>$premium,
            'highlight'=>$highlight,
            'quickicon'=>$quickicon,

        ]);
    }

    public function index_view(Request $request)
    {
        $orderNo=  $request->id;
        $item = MItem::with(['game','server','payitem'])->where('userId',$this->user->id)->where('orderNo',$orderNo)->where('type','sell')->where('status',0)->first();
        if(empty($item) || !empty($item['payitem'])){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }

        return view('mania.sell.index_view',$item);
    }

    public function sell_view(Request $request)
    {
        $orderNo = $request->id;
        $type=  $request->type;
        $game = MItem::with(['game','server','user.roles','payitem','bargains','bargain_requests'=>function($query){
            $query->where('userId',$this->user->id);
        }])
            ->where('orderNo',$orderNo)
            ->first();
        if(empty($game)){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }

        if($game['userId'] == $this->user->id){
            if($type == 'sell'){
                if(empty($game['payitem']) && empty($game['toId']) && sizeof($game['bargains']) == 0 && $game['status'] == 0){
                    return redirect('/sell/index_view?id='.$orderNo.'&type=sell');
                }
                if(!empty($game['payitem']) && $game['payitem']['status'] == 0 && $game['status'] == 0 && !empty($game['toId'])){
                    return redirect('/myroom/sell/sell_pay_wait_view?id='.$orderNo.'&type=sell');
                }
                if(!empty($game['payitem']) && ($game['payitem']['status'] == 1 || $game['payitem']['status'] == 2) && $game['status'] > 0 && !empty($game['toId'])){
                    return redirect('/myroom/sell/sell_ing_view?id='.$orderNo.'&type=sell');
                }
                if(empty($game['payitem']) && empty($game['toId']) && sizeof($game['bargains']) > 0){
                    return redirect('/myroom/sell/sell_check_view?id='.$orderNo);
                }
            }
            else{
                if(empty($game['payitem']) && empty($game['toId']) && $game['status'] == 0){
                    return redirect('/buy/index_view?id='.$orderNo.'&type=buy');
                }
                if(!empty($game['payitem']) && $game['payitem']['status'] == 0 && $game['status'] == 0 && !empty($game['toId'])){
                    return redirect('/myroom/buy/buy_pay_wait_view?id='.$orderNo.'&type=buy');
                }
                if(!empty($game['payitem']) && ($game['payitem']['status'] == 1 || $game['payitem']['status'] == 2) && $game['status'] > 0 && !empty($game['toId'])){
                    return redirect('/myroom/buy/buy_ing_view?id='.$orderNo.'&type=buy');
                }
            }
        }
        else{
            if($type == 'sell'){
                if(!empty($game['toId'])){
                    if($game['toId'] != $this->user->id){
                        echo '<script>alert("거래중 물품입니다.");window.history.back();</script>';
                        return;
                    }
                    if(!empty($game['payitem']) && $game['payitem']['status'] == 0 && $game['status'] == 0 ){
                        return redirect('/myroom/buy/buy_pay_wait_view?id='.$orderNo.'&type=sell');
                    }
                    if(!empty($game['payitem']) && ($game['payitem']['status'] == 1 || $game['payitem']['status'] == 2) && $game['status'] > 0){
                        return redirect('/myroom/buy/buy_ing_view?id='.$orderNo.'&type=sell');
                    }
                }
                else{
                    if(empty($game['payitem']) && $game['status'] == 0 && !empty($game['bargain_requests']) && sizeof($game['bargain_requests']) > 0){
                        return redirect('/myroom/buy/buy_check_view?id='.$orderNo);
                    }
                }
            }
            if($type == 'buy'){
                if(!empty($game['toId'])){
                    if($game['toId'] != $this->user->id){
                        echo '<script>alert("거래중 물품입니다.");window.history.back();</script>';
                        return;
                    }
                    if(!empty($game['payitem']) && $game['payitem']['status'] == 0 && $game['status'] == 0 ){
                        return redirect('/myroom/sell/sell_pay_wait_view?id='.$orderNo.'&type=buy');
                    }
                    if(!empty($game['payitem']) && ($game['payitem']['status'] == 1 || $game['payitem']['status'] == 2) && $game['status'] > 0){
                        return redirect('/myroom/sell/sell_ing_view?id='.$orderNo.'&type=buy');
                    }
                }
                else{
                    return redirect('/buy/application?id='.$orderNo);
                }
            }
        }

        $game['cuser'] = $this->user;
        return view('mania.sell.sell_view',$game);
    }

    public function sell_application(Request $request)
    {
        $id = $request->id;
        $game = MItem::with(['game','server','user','payitem','bargains','bargain_requests'=>function($query){
            $query->where('userId',$this->user->id);
        }])
            ->where('orderNo',$id)
            ->where('type','sell')->first();
        if(empty($game)){
            echo '<script>alert("정상적인 경로를 이용해주세요.");window.history.back();</script>';
            return;
        }
        if(!empty($game['payitem']) && $game['toId'] == $this->user->id && $game['payitem']['status'] !=0){
            return redirect('/myroom/buy/buy_ing_view?id='.$id.'&type=sell');
        }
        if(!empty($game['payitem']) && $game['userId'] == $this->user->id && $game['payitem']['status'] !=0){
            return redirect('/myroom/sell/sell_ing_view?id='.$id.'&type=sell');
        }
        if(!empty($game['payitem']) && $game['toId'] == $this->user->id && $game['payitem']['status'] ==0){
            return redirect('/myroom/buy/buy_pay_wait_view?id='.$id.'&type=sell');
        }
        if(!empty($game['payitem']) && $game['userId'] == $this->user->id && $game['payitem']['status'] ==0){
            return redirect('/myroom/sell/sell_pay_wait_view?id='.$id.'&type=sell');
        }

        if(empty($game['payitem']) && empty($game['toId']) && !empty($game['bargains']) && sizeof($game['bargains']) > 0 && $game['userId'] == $this->user->id){
            return redirect('/myroom/sell/sell_check_view?id='.$id);
        }
        if(empty($game['payitem']) &&  $game['status'] == 0 && !empty($game['bargain_requests']) && sizeof($game['bargain_requests']) > 0){
            return redirect('/myroom/buy/buy_check_view?id='.$id);
        }
        if($game['userId'] == $this->user->id && empty($game['payitem']) && sizeof($game['bargains']) == 0 && empty($game['toId'])){
            return redirect('/sell/view?id='.$id.'&type=sell');
        }
        $game['cuser'] = $this->user;
        return view('mania.sell.sell_application',$game);
    }

    /**
     * 판매페이지 > 물품제목 > 설정
     */
    public function fixed_trade_subject()
    {
        $fixed = MTitle::where('userId',$this->user->id)->first();
        $title = empty($fixed) ? '' : $fixed['title'];
        return view('mania.sell.fixed_trade_subject',['title'=>$title]);
    }

    public function addFixed(Request $request){
        $txt_fixed_title = $request->txt_fixed_title;
        MTitle::updateOrCreate(['userId'=>$this->user->id],[
           'title'=>$txt_fixed_title
        ]);
        echo '<script>alert("정상적으로 설정되었습니다.");opener.setTit("'.$txt_fixed_title.'");self.close();</script>';
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
        $params['search_server'] = !empty($params['search_server']) ? $params['search_server'] : '';
        $params['search_game_text'] = !empty($params['search_game_text']) ? $params['search_game_text'] : '';
        $params['search_server_text'] = !empty($params['search_server_text']) ? $params['search_server_text'] : '';
        $params['search_goods'] = !empty($params['search_goods']) ? $params['search_goods'] : '';
        $params['speed'] = !empty($params['speed']) ? $params['speed'] : '';
        $roles = MRole::orderBy('level',"ASC")->get()->toArray();
        $params['roles'] = $roles;
        return view('mania.sell.list_search',$params);
    }

    /**
     * 판매페이지 > 연락처수정 버튼
     */
    public function user_contact_edit()
    {
        return view('mania.sell.user_contact_edit',$this->user);
    }

    public function addContact(Request $request){
        $insert_array = array();
        if(!empty($request->user_contactA) && !empty($request->user_contactB) && !empty($request->user_contactC)){
            $insert_array['home'] = $request->user_contactA.'-'.$request->user_contactB.'-'.$request->user_contactC;
        }
        if(!empty($request->user_mobileA) && !empty($request->user_mobileB) && !empty($request->user_mobileC)){
            $insert_array['mobile'] = $request->user_mobileA.'-'.$request->user_mobileB.'-'.$request->user_mobileC;
        }
        if(!empty($insert_array)){
            User::where('id',$this->user->id)->update($insert_array);
        }
        echo '<script>alert("정상적으로 등록되었습니다.");self.close()</script>';
    }

    public function ajax_template()
    {
        return view('mania.sell.index_template');
    }

    public function sell_list(Request $request){
        $params = $request->all();
        $params['overlap'] = !empty($params['overlap']) ? $params['overlap'] : '';
        $params['goods_type'] = !empty($params['goods_type']) && $params['goods_type'] !=1  ? $params['goods_type'] : 'all';
        return view('mania.sell.sell_list',$params);
    }

    public function gamemoney_avg(){
        echo '<?xml version="1.0" encoding="UTF-8" ?>
<quotation result="fail" result_descript="이용에 불편을 드려 죄송합니다.

더이상 정보를 제공하지 않는 게임입니다." time="'.date("H").'시  '.date("i").'분" />';
    }
}
