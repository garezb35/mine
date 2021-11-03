<?php

namespace App\Http\Controllers;

use App\Models\MItem;
use App\Models\MOrderNotification;
use App\Models\MPayitem;
use App\Models\MRole;
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
        return view('mania.buy.main');
    }

    public function index_view()
    {
        return view('mania.buy.index_view');
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

    public function buy_application()
    {
        return view('mania.buy.buy_application');
    }

    public function trade_cancel(Request $request){
        $id = $request->id;
        $game = MItem::with('payitem')->where('orderNo',$id)->first();
        $buyer = $seller = "";

        if(empty($game) || empty($game['payitem']) || $game['payitem']['status'] != 1  || empty($game['toId'])||
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
}
