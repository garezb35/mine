<?php


namespace App\Http\Controllers;

use App\Models\MGame;
use App\Models\MGameRate;
use App\Models\MItem;
use App\Models\MMall;
use App\Models\MMallBuy;
use App\Models\MMygame;
use App\Models\MMyservice;
use App\Models\MNotice;
use App\Models\MPayhistory;
use App\Models\MPayitem;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use function Livewire\str;
use DB;

class VMainController extends BaseController
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
        if(!$this->isLogged){
            $userId = "";
        }
        else{
            $userId = $this->user->id;
        }
        $sells = MItem::with(['game','server'])->where('type','sell')->where('userId',"!=",$userId)->whereNull('toId')->where('status',0)->limit(10)->get();
        $buys = MItem::with(['game','server'])->where('type','buy')->where('userId',"!=",$userId)->whereNull('toId')->where('status',0)->limit(10)->get();
        $notices = MNotice::orderBy('created_at',"DESC")->limit(10)->get();
        $game_list = MGameRate::get();
        $list = MMyservice::get()->toArray();
        $params = array();
        foreach($list as $v){
            $params[$v['id']] = 1;
        }
        return view('mania.home',['sells'=>$sells,'buys'=>$buys,'notices'=>$notices,'game_list'=>$game_list,'fav'=>$params,'list'=>$list]);
    }
    public function giftcard()
    {
        $gift_selected = $gift = MMall::get();
        return view('mania.portal.giftcard',['gift'=>$gift,'gift_selected'=>$gift_selected]);
    }
    public function viewGift($param){
        if($param == 'giftcard_buy_list'){
            $gift = MMall::get();
            if(\Request::get('pMode') != 'O' && !empty(\Request::get('pMode'))){
                $list = MMallBuy::where('userId',$this->user->id)->where('alias',\Request::get('pMode'))->orderBy('created_at','DESC')->paginate(15);
            }
            else{
                $list = MMallBuy::where('userId',$this->user->id)->orderBy('created_at','DESC')->paginate(15);
            }
            return view('mania.portal.giftcard_buy_list',['gift'=>$gift,'list'=>$list]);
        }
        $item = MMall::where('alias',$param)->where('status',1)->first();
        if(empty($item)){
            echo '<script>alert("죄송합니다.서비스 점검중입니다.");window.history.back();</script>';
            return;
        }

        if(\Request::get('pMode') == 'O'){
            $item['user'] = $this->user;
            return view('mania.portal.viewGift_popup',$item);
        }

        $gift = MMall::get();
        $item['gift'] = $gift;
        return view('mania.portal.viewGift',$item);
    }

    public function viewGift_Post(Request $request){
        $mileage = 0;
        $money_list = array();
        $param = $request->all();
        $insert = array();
        foreach($param as $key=>$v){
            if(str_contains($key,'bill') && $v > 0) {
                array_push($money_list, array(str_replace("bill", "", $key) => $v));
                $mileage += str_replace("bill","",$key) * $v;
                for($i = 0; $i < $v; $i++){
                    array_push($insert,['userId'=>$this->user->id,'alias'=>$param['alias'],'mileage'=>str_replace("bill","",$key)]);
                }
            }
        }

        if($mileage > $this->user->mileage){
            echo '<script>alert("마일리지가 부족합니다.");window.history.back();</script>';
            return;
        }

        if(sizeof($insert) > 0){
            $this->user->mileage = $this->user->mileage - $mileage;
            $this->user->save();
            MPayhistory::insert([
                'price'=>$mileage,
                'userId'=>$this->user->id,
                'pay_type'=>10,
            ]);
            MMallBuy::insert($insert);
        }
        echo '<script>alert("성공적으로 구매하었습니다.");self.close();</script>';
    }

    public function box_chatting(Request $request){
        if($request->state == 'doubled_display'){
            return view('aside.box-block');
        }
        return view('aside.box-chatting');
    }
}
