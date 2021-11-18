<?php

namespace App\Http\Controllers;
use App\Models\MCashReceipt;
use App\Models\MGift;
use App\Models\MInbox;
use App\Models\MItem;
use App\Models\MMygame;
use App\Models\MMyservice;
use App\Models\MPayhistory;
use App\Models\MPayitem;
use App\Models\MTitle;
use App\Models\User;
use App\Models\MMileage;
use App\Models\MUserbank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

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

    public function message(Request $request)
    {
        $type = !empty($request->type) ? $request->type : '';
        $message = MInbox::where('userId',$this->user->id);
        if(!empty($type) && $type != 'storage')
        {
            $message = $message->where('type',$type);
            $message = $message->where('saved',0);
        }
        if(!empty($type) && $type == 'storage')
            $message = $message->where('saved',1);
        $message = $message->orderBy('created_at',"DESC")->paginate(15);
        $order_message_count = MInbox::where('userId',$this->user->id)->where('type','거래')->get()->count();
        $manager_message_count = MInbox::where('userId',$this->user->id)->where('type','관리자')->get()->count();
        return view('mania.myroom.message',['message'=>$message,'order_message_count'=>$order_message_count,'manager_message_count'=>$manager_message_count]);
    }

    public function alarm_sell_list()
    {
        return view('mania.myroom.alarm_sell_list');
    }

    public function alarm_add()
    {
        return view('mania.myroom.alarm_add');
    }

    public function complete_sell(Request $request)
    {
        $type = empty($request->type)? 'sell': $request->type;
        $search_type = empty($request->search_type)? '': $request->search_type;
        $search_month = empty($request->search_month)? date("Y"): $request->search_month;
        $from = date('Y-m-d', strtotime('-1 week', strtotime('now')));
        $to = date('Y-m-d');
        $data = array();
        $game = MItem::
        with('game','server','payitem')->
        whereHas('payitem',function($query){
            $query->where('status',2);
        })->
        where(function($query){
            $query->where('status',23);
            $query->orWhere('status',32);
        })->
        where(function($query) use($type){
            if($type == 'sell'){
                $query->where(function($query1){
                    $query1->where('type','sell');
                    $query1->where('userId',$this->user->id);
                });
            }
            else{
                $query->where(function($query1){
                    $query1->where('type','buy');
                    $query1->where('toId',$this->user->id);
                });
            }

        });
        $game = $game->whereYear('created_at',$search_month);
        if(!empty($search_type)){
            if($search_month == '2021' ){
                $game = $game->where('created_at', '<',date('Y-m-d H:i:s', strtotime('-1 week', strtotime('now'))));
            }
        }
        else{
            if($search_month == '2021' ){
                $game = $game->whereBetween('created_at', [$from, $to]);
            }
        }
        $game = $game->paginate(15);
        $data['games'] = $game;
        return view('mania.myroom.complete_sell',$data);
    }

    public function complete_cancel_sell(Request $request)
    {
        $type = empty($request->type) ? 'sell': $request->type;
        $game = MItem::
        with(['game','server','payitem'])->whereHas('payitem');
        if($type == 'sell')
            $game = $game->where('type','sell')->where('userId',$this->user->id);
        else
            $game = $game->where('type','buy')->where('toId',$this->user->id);
        $game = $game->where('status',-1);
        $game = $game->where('updated_at','>=',date("Y-m-d H:i:s",strtotime('-24 hours')))->
            where('updated_at',"<=",date("Y-m-d H:i:s"));
        $game = $game->orderBy('updated_at',"DESC")->paginate(15);
        return view('mania.myroom.complete_cancel_sell',['games'=>$game,'type'=>$type]);
    }

    public function complete_cancel_buy(Request $request)
    {
        $type = empty($request->type) ? 'sell': $request->type;
        $game = MItem::
        with(['game','server','payitem'])->whereHas('payitem');
        if($type == 'sell')
            $game = $game->where('type','sell')->where('toId',$this->user->id);
        else
            $game = $game->where('type','buy')->where('userId',$this->user->id);
        $game = $game->where('status',-1);
        $game = $game->where('updated_at','>=',date("Y-m-d H:i:s",strtotime('-24 hours')))->
        where('updated_at',"<=",date("Y-m-d H:i:s"));
        $game = $game->orderBy('updated_at',"DESC")->paginate(15);
        return view('mania.myroom.complete_cancel_buy',['games'=>$game,'type'=>$type]);
    }

    public function complete_buy(Request $request)
    {
        $type = empty($request->type)? 'sell': $request->type;
        $search_type = empty($request->search_type)? '': $request->search_type;
        $search_month = empty($request->search_month)? date("Y"): $request->search_month;
        $from = date('Y-m-d', strtotime('-1 week', strtotime('now')));
        $to = date('Y-m-d');
        $data = array();
        $game = MItem::
        with('game','server','payitem')->
        whereHas('payitem',function($query){
            $query->where('id','>',0);
        })->
        where(function($query){
            $query->where('status',23);
            $query->orWhere('status',32);
        })->
        where(function($query) use($type){
            if($type == 'sell'){
                $query->where(function($query1){
                    $query1->where('type','sell');
                    $query1->where('toId',$this->user->id);
                });
            }
            else{
                $query->orWhere(function($query1){
                    $query1->where('type','buy');
                    $query1->where('userId',$this->user->id);
                });
            }

        });
        $game = $game->whereYear('created_at',$search_month);
        if(!empty($search_type)){
            if($search_month == '2021' ){
                $game = $game->where('created_at', '<',date('Y-m-d H:i:s', strtotime('-1 week', strtotime('now'))));
            }
        }
        else{
            if($search_month == '2021' ){
                $game = $game->whereBetween('created_at', [$from, $to]);
            }
        }
        $game = $game->paginate(15);
        $data['games'] = $game;
        return view('mania.myroom.complete_buy',$data);
    }

    public function complete_report(Request $request)
    {
        $sell_list = $buy_list = array();
        $sell_list['up'] = $sell_list['down'] = $buy_list['up'] = $buy_list['down'] = array();
        $selectYear = !empty($request->selectYear) ? $request->selectYear : date("Y");
        $game_sell = MPayhistory::
        selectRaw('count(id) as sum_count, sum(price) as price,updated_at,pay_type,month(updated_at) as month')->
        whereHas('complete_orders',function($query){
            $query->where(function($query1){
                $query1->where(function($query3){
                    $query3->where(function($query4){
                        $query4->where('type','sell');
                        $query4->where('userId',$this->user->id);
                    });
                    $query3->orWhere(function($query5){
                        $query5->where('type','buy');
                        $query5->where('toId',$this->user->id);
                    });
                });
            });
            $query->where(function($query2){
                $query2->where('status',23);
                $query2->orWhere('status',32);
            });
        })->
        where('status',1)->
        whereYear('updated_at','=',$selectYear)->
        groupBy(array(DB::raw('MONTH(updated_at)'),DB::raw('pay_type')))->get()->toArray();

        $game_buy = MPayhistory::
        selectRaw('count(id) as sum_count, sum(price) as price,updated_at,pay_type,month(updated_at) as month')->
        whereHas('complete_orders',function($query){
            $query->where(function($query1){
                $query1->where(function($query3){
                    $query3->where(function($query4){
                        $query4->where('type','sell');
                        $query4->where('toId',$this->user->id);
                    });
                    $query3->orWhere(function($query5){
                        $query5->where('type','buy');
                        $query5->where('userId',$this->user->id);
                    });
                });
            });
            $query->where(function($query2){
                $query2->where('status',23);
                $query2->orWhere('status',32);
            });
        })->
//        where(function($query){
//            $query->where('pay_type',6);
//        })->
        where('status',1)->
        whereYear('updated_at','=',$selectYear)->
        groupBy(array(DB::raw('MONTH(updated_at)'),DB::raw('pay_type')))->get()->toArray();

        if(!empty($game_sell)){
            foreach($game_sell as $v){
                $temp = array();
                if(empty($sell_list[$v['month'].'m'])){
                    $sell_list[$v['month'].'m'] = array();
                }

                if($v['pay_type'] == 1){
                    $sell_list[$v['month'].'m']['premium'] = $v['price'];
                }
                if($v['pay_type'] == 2){

                    $sell_list[$v['month'].'m']['order'] = $v['price'];
                    $sell_list[$v['month'].'m']['count'] = $v['sum_count'];
                }
                if($v['pay_type'] == 3){
                    $sell_list[$v['month'].'m']['fee'] = $v['price'];
                }
            }
        }

        if(!empty($game_buy)){
            foreach($game_buy as $v){
                if(empty($buy_list[$v['month'].'m'])){
                    $buy_list[$v['month'].'m'] = array();
                }

                if($v['pay_type'] == 1){
                    $buy_list[$v['month'].'m']['premium'] = $v['price'];
                }
                if($v['pay_type'] == 6){
                    $buy_list[$v['month'].'m']['order'] = $v['price'];
                    $buy_list[$v['month'].'m']['count'] = $v['sum_count'];
                }
                if($v['pay_type'] == 3){
                    $buy_list[$v['month'].'m']['fee'] = $v['price'];
                }
            }
        }

        $temp1 = $temp2 = $temp3 = $temp4 = 0;
        for($i = 1; $i<= 6 ; $i++){
            if(!empty($sell_list[$i.'m'])){
                $temp1 += empty($sell_list[$i.'m']['premium']) ? 0 : $sell_list[$i.'m']['premium'];
                $temp1 += empty($buy_list[$i.'m']['premium']) ? 0 : $buy_list[$i.'m']['premium'];
                $temp2 += empty($sell_list[$i.'m']['order']) ? 0 : $sell_list[$i.'m']['order'];
                $temp3 += empty($sell_list[$i.'m']['fee']) ? 0 : $sell_list[$i.'m']['fee'];
                $temp4 += empty($sell_list[$i.'m']['count']) ? 0 : $sell_list[$i.'m']['count'];
            }
        }
        $sell_list['up']['premium'] = $temp1;
        $sell_list['up']['order'] = $temp2;
        $sell_list['up']['fee'] = $temp3;
        $sell_list['up']['count'] = $temp4;

        for($i = 7; $i<= 12 ; $i++){
            if(!empty($sell_list[$i.'m'])){
                $temp1 += empty($sell_list[$i.'m']['premium']) ? 0 : $sell_list[$i.'m']['premium'];
                $temp1 +=empty($buy_list[$i.'m']['premium']) ? 0 : $buy_list[$i.'m']['premium'];
                $temp2 += empty($sell_list[$i.'m']['order']) ? 0 : $sell_list[$i.'m']['order'];
                $temp3 += empty($sell_list[$i.'m']['fee']) ? 0 : $sell_list[$i.'m']['fee'];
                $temp4 += empty($sell_list[$i.'m']['count']) ? 0 : $sell_list[$i.'m']['count'];
            }
        }

        $sell_list['down']['premium'] = $temp1;
        $sell_list['down']['order'] = $temp2;
        $sell_list['down']['fee'] = $temp3;
        $sell_list['down']['count'] = $temp4;

        $temp1 = $temp2 = $temp3 =$temp4=0;
        for($i = 1; $i<= 6 ; $i++){
            if(!empty($buy_list[$i.'m'])){
                $temp2 += empty($buy_list[$i.'m']['order']) ? 0 : $buy_list[$i.'m']['order'];
                $temp4 += empty($buy_list[$i.'m']['count']) ? 0 : $buy_list[$i.'m']['count'];
            }
        }
        $buy_list['up']['order'] = $temp2;
        $buy_list['up']['count'] = $temp4;

        for($i = 7; $i<= 12 ; $i++){
            if(!empty($buy_list[$i.'m'])){
                $temp2 += empty($buy_list[$i.'m']['order']) ? 0 : $buy_list[$i.'m']['order'];
                $temp4 += empty($buy_list[$i.'m']['count']) ? 0 : $buy_list[$i.'m']['count'];
            }
        }
        $buy_list['down']['order'] = $temp2;
        $buy_list['down']['count'] = $temp4;
        return view('mania.myroom.complete_report',['sell_list'=>$sell_list,'buy_list'=>$buy_list]);
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
        $selling_register = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereDoesntHave('bargains')->
        whereDoesntHave('payitem')->get()->count();
        $bargain_request = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests')->
        whereDoesntHave('payitem')->get()->count();
        $pay_pending = MItem::
            whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where(function($query){
            $query->where(function($query1){
                $query1->where('userId',$this->user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2){
                $query2->where('toId',$this->user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        get()->count();
        $selling_count = MItem::
            whereHas('payitem',function($query){
                $query->where('status',1);
            })->
            where(function($query){
            $query->where('userId',$this->user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->
        get()->count();

        $games = MItem::with(['game','server'])->
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereDoesntHave('bargains')->
        whereDoesntHave('payitem')->orderBy('created_at',"DESC")->paginate(15);

        return view('mania.myroom.sell_regist',[
            'selling_register'=>$selling_register,
            'bargain_request'=>$bargain_request,
            'pay_pending'=>$pay_pending,
            'selling_count'=>$selling_count,
            'games'=>$games
        ]);
    }
    public function sell_ing()
    {
        $selling_register = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereDoesntHave('bargains')->
        whereDoesntHave('payitem')->get()->count();
        $bargain_request = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests')->
        whereDoesntHave('payitem')->get()->count();
        $pay_pending = MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where(function($query){
            $query->where(function($query1){
                $query1->where('userId',$this->user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2){
                $query2->where('toId',$this->user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        get()->count();
        $selling_count = MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query){
            $query->where('userId',$this->user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->
        get()->count();
        $games =MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query){
            $query->where('userId',$this->user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->paginate(15);

        return view('mania.myroom.sell_ing',[
            'selling_register'=>$selling_register,
            'bargain_request'=>$bargain_request,
            'pay_pending'=>$pay_pending,
            'selling_count'=>$selling_count,
            'games'=>$games
        ]);
    }

    public function sell_check()
    {
        $selling_register = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereDoesntHave('bargains')->
        whereDoesntHave('payitem')->get()->count();
        $bargain_request = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests')->
        whereDoesntHave('payitem')->get()->count();
        $pay_pending = MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where('userId',$this->user->id)->
        where(function($query){
            $query->where(function($query1){
                $query1->where('userId',$this->user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2){
                $query2->where('toId',$this->user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        get()->count();
        $selling_count = MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query){
            $query->where('userId',$this->user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->
        get()->count();
        $games = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests')->
        whereDoesntHave('payitem')->paginate(15);

        return view('mania.myroom.sell_check',[
            'selling_register'=>$selling_register,
            'bargain_request'=>$bargain_request,
            'pay_pending'=>$pay_pending,
            'selling_count'=>$selling_count,
            'games'=>$games
        ]);
    }

    public function sell_regist_view(Request $request)
    {
        $id = $request->id;
        $game = MItem::with(['user','game','server','payitem','bargain_requests'])->
        where("orderNo",$id)->
        where("userId",$this->user->id)->
        where('type','sell')->first();

        if(empty($game)){
            echo '<script>alert("잘못된 요청입니다.");window.history.back()</script>';
            return;
        }
        $game['cuser']=  $this->user;

        if(!empty($game['payitem']) && !empty($game['toId']) && $game['payitem']['status'] == 0)
        {
            return Redirect::to('myroom/sell/sell_pay_wait_view?id='.$game['orderNo'].'&type='.$game['type']);
        }
        if(!empty($game['payitem']) && !empty($game['toId']) && $game['payitem']['status'] != 0)
        {
            return Redirect::to('myroom/sell/sell_ing_view?id='.$game['orderNo'].'&type='.$game['type']);
        }
        if(empty($game['payitem']) && empty($game['toId']) && sizeof($game['bargain_requests']) > 0)
        {
            return Redirect::to('myroom/sell/sell_check_view?id='.$game['orderNo']);
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
        $game['highlight'] = $highlight;
        $game['premium'] = $premium;
        $game['quickicon'] = $quickicon;
        return view('mania.myroom.sell_re_reg',$game);
    }

    public function buy_regist()
    {
        $buying_register = MItem::
        where('userId',$this->user->id)->
        where('type','buy')->
        where('status',0)->
        whereNull('toId')->
        whereDoesntHave('bargains')->
        whereDoesntHave('payitem')->get()->count();
        $bargain_request = MItem::
        where('userId','!=',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests',function($query){
            $query->where('userId',$this->user->id);
        })->
        whereDoesntHave('payitem')->get()->count();
        $pay_pending = MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where(function($query){
            $query->where(function($query1){
                $query1->where('toId',$this->user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2){
                $query2->where('userId',$this->user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        get()->count();
        $buying_count = MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->
        get()->count();
        $games = MItem::
        whereDoesntHave('payitem')->
        where(function($query){
            $query->where('userId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',0);
            $query->whereNull('toId');
        })->paginate(15);

        return view('mania.myroom.buy_regist',[
            'buying_register'=>$buying_register,
            'bargain_request'=>$bargain_request,
            'pay_pending'=>$pay_pending,
            'buying_count'=>$buying_count,
            'games'=>$games
        ]);
    }

    public function buy_regist_view(Request $request)
    {
        $id = $request->id;
        $game = MItem::with('game','server','payitem')->where('orderNo',$id)->where('userId',$this->user->id)->first();
        if(!empty($game['toId']) && !empty($game['payitem'])){
            if($game['payitem']['status'] == 0){
                return redirect('myroom/buy/buy_pay_wait_view?id='.$game['orderNo'].'&type='.$game['type']);
            }
            else{
                return redirect('myroom/buy/buy_ing_view?id='.$game['orderNo'].'&type='.$game['type']);
            }
        }
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
        $game['highlight'] = $highlight;
        $game['premium'] = $premium;
        $game['quickicon'] = $quickicon;
        return view('mania.myroom.buy_re_reg',$game);
    }
    public function buy_check()
    {

        $buying_register = MItem::
        where('userId',$this->user->id)->
        where('type','buy')->
        where('status',0)->
        whereNull('toId')->
        whereDoesntHave('bargains')->
        whereDoesntHave('payitem')->get()->count();
        $bargain_request = MItem::
        where('userId','!=',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests',function($query){
            $query->where('userId',$this->user->id);
        })->
        whereDoesntHave('payitem')->get()->count();
        $pay_pending = MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where(function($query){
            $query->where(function($query1){
                $query1->where('toId',$this->user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2){
                $query2->where('userId',$this->user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        get()->count();
        $buying_count = MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->
        get()->count();
        $games = MItem::
        where('userId','!=',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests',function($query){
            $query->where('userId',$this->user->id);
        })->
        whereDoesntHave('payitem')->paginate(15);

        return view('mania.myroom.buy_check',[
            'buying_register'=>$buying_register,
            'bargain_request'=>$bargain_request,
            'pay_pending'=>$pay_pending,
            'buying_count'=>$buying_count,
            'games'=>$games
        ]);
    }

    public function buy_ing()
    {
        $buying_register = MItem::
        where('userId',$this->user->id)->
        where('type','buy')->
        where('status',0)->
        whereNull('toId')->
        whereDoesntHave('bargains')->
        whereDoesntHave('payitem')->get()->count();
        $bargain_request = MItem::
        where('userId','!=',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests',function($query){
            $query->where('userId',$this->user->id);
        })->
        whereDoesntHave('payitem')->get()->count();
        $pay_pending = MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where(function($query){
            $query->where(function($query1){
                $query1->where('toId',$this->user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2){
                $query2->where('userId',$this->user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        get()->count();
        $buying_count = MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->
        get()->count();
        $games = MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query){
            $query->where('userId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->paginate(15);

        return view('mania.myroom.buy_ing',[
            'buying_register'=>$buying_register,
            'bargain_request'=>$bargain_request,
            'pay_pending'=>$pay_pending,
            'buying_count'=>$buying_count,
            'games'=>$games
        ]);
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

        $buying_register = MItem::
        where('userId',$this->user->id)->
        where('type','buy')->
        where('status',0)->
        whereNull('toId')->
        whereDoesntHave('bargains')->
        whereDoesntHave('payitem')->get()->count();
        $bargain_request = MItem::
        where('userId','!=',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests',function($query){
            $query->where('userId',$this->user->id);
        })->
        whereDoesntHave('payitem')->get()->count();
        $pay_pending = MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where(function($query){
            $query->where(function($query1){
                $query1->where('toId',$this->user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2){
                $query2->where('userId',$this->user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        get()->count();
        $buying_count = MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->
        get()->count();
        $games = MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where(function($query){
            $query->where(function($query1){
                $query1->where('toId',$this->user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2){
                $query2->where('userId',$this->user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->paginate(15);

        return view('mania.myroom.buy_pay_wait',[
            'buying_register'=>$buying_register,
            'bargain_request'=>$bargain_request,
            'pay_pending'=>$pay_pending,
            'buying_count'=>$buying_count,
            'games'=>$games
        ]);
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

        $game = MItem::with(['game','server','bargains.user.roles','payitem'])
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
        $data = array();
        $data['user'] = $this->user;
        $list = MMygame::orderBy('order','ASC')->paginate(15);
        $data['list'] = $list;
        return view('mania.myroom.search',$data);
        return;
    }

    public function free_remainder_list(Request $request){
        $time = 0;
        $free_use_item = $request->free_use_item;
        $gift=  MGift::where('userId',$this->user->id);
        if(empty($free_use_item) || $free_use_item == 'premium')
            $gift = $gift->where('type',1);
        if($free_use_item == 'highlight')
            $gift = $gift->where('type',2);
        if($free_use_item == 'quickicon')
            $gift = $gift->where('type',3);
        $gift = $gift->get();
        if(!empty($gift)){
            foreach ($gift as $value){
                $time += $value['time'];
            }
        }
        return view('mania.free.free_remainder_list',['time'=>$time]);
    }

    public function sell_pay_wait(Request $request){
        $selling_register = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereDoesntHave('bargains')->
        whereDoesntHave('payitem')->get()->count();
        $bargain_request = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests')->
        whereDoesntHave('payitem')->get()->count();
        $pay_pending = MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where('userId',$this->user->id)->
        where(function($query){
            $query->where(function($query1){
                $query1->where('userId',$this->user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2){
                $query2->where('toId',$this->user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        get()->count();
        $selling_count = MItem::
        whereHas('payitem',function($query){
            $query->where('status',1);
        })->
        where(function($query){
            $query->where('userId',$this->user->id);
            $query->where('type','sell');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->orWhere(function($query){
            $query->where('toId',$this->user->id);
            $query->where('type','buy');
            $query->where('status',"!=",0);
            $query->where('status',"!=",23);
            $query->where('status',"!=",32);
            $query->where('status',"!=",-1);
        })->
        get()->count();
        $games = MItem::
        whereHas('payitem',function($query){
            $query->where('status',0);
        })->
        where(function($query){
            $query->where(function($query1){
                $query1->where('userId',$this->user->id);
                $query1->where('type','sell');
                $query1->where('toId',">", 0);
            });
            $query->orWhere(function($query2){
                $query2->where('toId',$this->user->id);
                $query2->where('type','buy');
                $query2->where('toId',">", 0);
            });
        })->
        where('status',0)->
        paginate(15);

        return view('mania.myroom.sell_pay_wait',[
            'selling_register'=>$selling_register,
            'bargain_request'=>$bargain_request,
            'pay_pending'=>$pay_pending,
            'selling_count'=>$selling_count,
            'games'=>$games
        ]);
    }

    public function myinfo_check(Request $request){
        $this->user->bank_information = MUserbank::where('id',$this->user->id)->first();
        return view('mania.myroom.myinfo_check',$this->user);
    }

    public function cash_receipt_list(Request $request){
        $cash = MCashReceipt::with('item.server','item.game','payitem')->
            whereHas('item',function($query){
            $query->where('status',23);
            $query->orWhere('status',32);
        })->
        where(function($query){
            $query->where('status',2);
            $query->orWhere('status',1);
        })->
        where('userId',$this->user->id)->
        orderBy(array('status'=>"DESC",'updated_at'=>"DESC",))
            ->paginate(15);
        return view('mania.myroom.cash_receipt_list',['cash'=>$cash]);
    }

    public function customer(Request $request){
        $list = MMyservice::get()->toArray();
        $params = array();
        foreach($list as $v){
            $params[$v['id']] = 1;
        }
        return view('mania.myroom.customer',['list'=>$params]);
    }

    public function customer_private(Request $request){
        return view('mania.myroom.customer_private');
    }

    public function search_add(Request $request){
        $params = $request->all();
        unset($params['_token']);
        $params['userId'] = $this->user->id;
        $game = MMygame::where('created_at',"!=","");
        $insertId = 0;
        foreach($params as $key=>$value){
            $game = $game->where($key,$value);
        }
        $game = $game->first();
        if(empty($game)){
            $insertId = MMygame::create($params);
            return redirect('/myroom/customer/search');
        }
        else{
            return redirect('/myroom/customer/search');
        }
    }

    public function search_startpage(Request $request){
        $id = $request->id;
        MMygame::where('id',"!=",$id)->update(['default'=>0]);
        MMygame::where('id',$id)->update(['default'=>1]);
        return redirect('/myroom/customer/search');
    }

    public function search_delete(Request $request){
        $id = $request->id;
        MMygame::where('id',$id)->delete();
        return redirect('/myroom/customer/search');
    }

    public function search_order(Request $request){
        $params = $request->all();

        foreach($params['id'] as $key=>$v){
            MMygame::where('id',$v)->update(['order'=>$key]);
        }
        return redirect('/myroom/customer/search');
    }

    public function search_update(Request $request){
        $param = $request->all();
        unset($param['id']);
        unset($param['_token']);
        unset($param['goods_tmp']);
        MMygame::where('id',$request->id)->update($param);
        echo '<script>opener.redirect();self.close();</script>';
        return;
    }

    public function user_leave_form(Request $request){
        return view('mania.myroom.user_leave_form');
    }

    public function save_all(Request $request){
        if($request->procType == 'save'){
            if(!empty($request->message_id) && sizeof($request->message_id)> 0){
                MInbox::where('id',$request->message_id)->update(['saved'=>1]);
            }
            return redirect('/myroom/message/?type=storage');
        }
    }

    public function delete_all(Request $request){
        if($request->procType == 'delete'){
            if(!empty($request->message_id) && sizeof($request->message_id)> 0){
                MInbox::where('id',$request->message_id)->delete();
            }
            return redirect('/myroom/message');
        }
    }

    public function mileage_charge_home(Request $request){
        echo '<script>alert("서비스 업데이트중입니다.");self.close();</script>';
        return;
    }

    /***************** Resion 마일리지 ****************/
    /**
     * 마이룸 > 마일리지 > 내 마일리지 > 마이리지 충전탭
     */
    public function my_mileage_index_c()
    {
        return view('mania.myroom.mileage.my_mileage.index', ['userDetail'=>$this->user, 'type'=>'charge']);
    }
    /**
     * 마이룸 > 마일리지 > 내 마일리지 > 마이리지 환전탭
     */
    public function my_mileage_index_e()
    {
        return view('mania.myroom.mileage.my_mileage.index', ['userDetail'=>$this->user, 'type'=>'exchange']);
    }
    /**
     * 마이룸 > 마일리지 > 내 마일리지 > 아일리지 상세 팝업
     */
    public function popup_mile_detail()
    {
        return view('mania.myroom.mileage.my_mileage.popup.mile_detail');
    }
    /**
     * * 마이룸 > 마일리지 > 내 마일리지 > 마일리지 달력보기
     */
    public function my_mileage_calendar()
    {
        return view('mania.myroom.mileage.my_mileage.calendar');
    }
    /**
     * * 마이룸 > 마일리지 > 내 마일리지 > 마일리지 리스트
     */
    public function my_mileage_detail_list(Request $request)
    {
        $formData = array(
            "date_start" => date("Y-m-d"),
            "date_end" => date("Y-m-d"),
            "search_type" => 0,
            "payRecord" => array()
        );

        if (isset($request->date_start))
            $formData['date_start'] = $request->date_start;
        if (isset($request->date_end))
            $formData['date_end'] = $request->date_end;
        if (isset($request->search_select))
            $formData['search_type'] = $request->search_select;

        $payRecord = array();
        if ($formData['search_type'] == 0) {
            $payRecord = MMileage::whereDate("createdByDtm", '>=', $formData['date_start'])
                ->whereDate("createdByDtm", '<=', $formData['date_end'])
                ->get()->toArray();
        }
        else {
            $payRecord = MMileage::whereDate("createdByDtm", '>=', $formData['date_start'])
                ->whereDate("createdByDtm", '<=', $formData['date_end'])
                ->where("type", ($formData['search_type'] - 1))
                ->get()->toArray();
        }
        $formData["payRecord"] = $payRecord;

        return view('mania.myroom.mileage.my_mileage.detail_list', $formData);
    }
    /**
     * 마이룸 > 마일리지 > 마일리지 충전
     */
    public function mileage_payment_charge()
    {
        $pageData['userDetail'] = $this->user;
        $pageData['snzProc'] = "충전";
        return view('mania.myroom.mileage.charge.index_account_iframe', $pageData);
    }
    /**
     * 마일리지 충전 처리
     */
    public function mileage_payment_charge_proc(Request $request)
    {
        MMileage::Insert([
            'userId' => $this->user->id,
            'money' => $request->price,
            'type' => 0,
            'keep_money' => $this->user->mileage,
            'memo' => '마일리지 충전',
            'status' => 0
        ]);

        echo "success";
    }
    /**
     * 마이룸 > 마일리지 > 마일리지 출금
     */
    public function mileage_payment_exchange()
    {
        $pageData['userDetail'] = $this->user;
        $pageData['snzProc'] = "출금";
        return view('mania.myroom.mileage.charge.index_account_iframe', $pageData);
    }
    /**
     * 마일리지 충전 처리
     */
    public function mileage_payment_exchange_proc(Request $request)
    {
        $price = $request->price;

        if ($price <= $this->user->mileage) {
            MMileage::Insert([
                'userId' => $this->user->id,
                'money' => $price,
                'type' => 1,
                'keep_money' => $this->user->mileage,
                'memo' => '마일리지 출금',
                'status' => 0
            ]);

            User::where("id", $this->user->id)->update(['mileage'=> DB::raw('mileage - '.$price)]);
            echo "success";
            return;
        }
        echo "fail";
    }

    /**
     * 마이룸 > 마일리지 > 마일리지  > 마일리지 출금내역 보기
     */
    public function payment_list()
    {
        return view('mania.myroom.mileage.payment.payment_list');
    }

    /**
     * 마이룸 > 마일리지 > 마일리지  > 마일리지 전환
     */
    public function culturecash()
    {
        return view('mania.myroom.mileage.payment.change.culturecash');
    }
}
