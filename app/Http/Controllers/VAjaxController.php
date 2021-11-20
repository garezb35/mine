<?php

namespace App\Http\Controllers;

use App\Models\MGame;
use App\Models\MInbox;
use App\Models\MItem;
use App\Models\MMygame;
use App\Models\MMyservice;
use App\Models\MPrivateMessage;
use App\Models\MRole;
use App\Models\MRoleGift;
use Illuminate\Http\Request;

class VAjaxController extends BaseController
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
    public function quicklinkuser()
    {
        return view('mania.ajax.quicklinkuser');
    }

    public function ajax_list_search(Request $request){
        $premiums_array = array();
        $result = new \stdClass();
        $result->result=  'SUCCESS';
        $result->data = new \stdClass();
        $search_game = $request->search_game;
        $search_server = $request->search_server;
        $temp = array();
        $request->order = empty($request->order) ? 2 : $request->order;
        $request->excellent = empty($request->excellent) ? '' : $request->excellent;
        $game = MItem
            ::with(['premiums','game','server','user.roles'])
            ->where('game_code',$search_game)
            ->where('status',"!=",-1)
            ->where('server_code',$search_server)
            ->where('type',$request->search_type);

        if(!empty($request->search_goods) && $request->search_goods != 'all')
            $game = $game->where('user_goods',$request->search_goods);

        if(!empty($request->purchase_type))
            $game = $game->where('purchase_type',$request->purchase_type);
        if(!empty($request->payment_existence)){
            $game = $game->where('payment_existence',$request->payment_existence);
        }

//        $game = $game->where(function($query) use ($request){
//           if(!empty($request->archer)) {
//               $query->orWhere('user_title','LIKE','%궁수%');
//           }
//            if(!empty($request->wizard)) {
//                $query->orWhere('user_title','LIKE','%마법사%');
//            }
//            if(!empty($request->man)) {
//                $query->orWhere('user_title','LIKE','%전사%');
//            }
//            if(!empty($request->holy)) {
//                $query->orWhere('user_title','LIKE','%성기사%');
//            }
//            if(!empty($request->sculptor)) {
//                $query->orWhere('user_title','LIKE','%조각사%');
//            }
//            if(!empty($request->alchemy)) {
//                $query->orWhere('user_title','LIKE','%연금술사%');
//            }
//            if(!empty($request->changi)) {
//                $query->orWhere('user_title','LIKE','%창기사%');
//            }
//        });

       $game = $game->where(function($query) use ($request){
           if(!empty($request->google))
               $query->orWhere('account_type',2);
           if(!empty($request->facebook))
               $query->orWhere('account_type',3);
           if(!empty($request->guest))
               $query->orWhere('account_type',1);
           if(!empty($request->out))
               $query->orWhere('account_type',9);
       });
        if(!empty($request->speed)){
            $game = $game->whereHas('premiums',function($query){
               $query->where('type',4);
            });
        }
        if(!empty($request->discont)){
            $game = $game->where('user_goods_type','bargain');
        }
        if(!empty($request->search_word))
            $game = $game->where('user_title','LIKE','%'.$request->search_word.'%');

            $game = $game->whereHas('user',function($query) use ($request){
                if(!empty($request->credit_type)){
                    $query->where('role','>=',$request->credit_type);
                }

                if(!empty($request->excellent)){
                   $query->whereNotNull('email_verified_at');
                   $query->where('mobile_verified',1);
                   $query->where('bank_verified',1);
                }
            });
        if(!empty($request->goods_type) && $request->goods_type !=1 && $request->goods_type!= 'all')
            $game = $game->where('user_goods_type',$request->goods_type);
        if($request->trade_state == 2){
            $game = $game->where('status',0);
        }
        if($request->trade_state == 3){
            $game = $game->where(function($query){
                $query->where('status',23);
                $query->orWhere('status',32);
            });
        }
        if($request->order ==2){
            $game = $game->orderBy('updated_at',"DESC");
        }
        if($request->order ==1){
            $game = $game->orderBy('user_price',"ASC");
        }


        if($request->overlap == 'on')
            $game = $game->groupBy('game_code','server_code');

        $game = $game->skip(($request->pinit -1) * 50)->take(50)->get()->toArray();
        foreach($game as $value){
            $premium_check = false;
            $unit = !empty($value['gamemoney_unit']) && $value['gamemoney_unit'] != 1 ? $value['gamemoney_unit'] : '';
            $temp_object = new \stdClass();
            $temp_object->premium = false;
            $temp_object->quickicon = false;
            $temp_object->min_quantity = 0;
            $temp_object->max_quantity = null;
            $temp_object->trade_keyword1 = '';
            $temp_object->trade_keyword2 = '';
            $temp_object->trade_keyword3 = '';
            $temp_object->multidiscount_use = 'N';
            $temp_object->seller_rank = 'A501';
            $temp_object->game_money = '게임머니';
            $temp_object->text_blue = 'N';
            $temp_object->text_icon = 'N';
            $temp_object->blue_end_time = '0000 00:00:00';
            $temp_object->bold_end_time = '0000 00:00:00';
            $temp_object->character_subject = '';
            $temp_object->ea_range = '';
            $temp_object->trade_kind = '';

            if($value['user_goods'] == 'character'){
                $temp_object->trade_kind = '6';
            }
            if($value['user_quantity'] > 1 || !empty($unit)){
                $temp_object->trade_money = number_format($value['user_quantity']).'당 '.number_format($value['user_price']);
                $temp_object->ea_range = number_format($value['user_quantity']).$unit;
            }
            else{
                $temp_object->trade_money = number_format($value['user_price']);
            }
            foreach($value['premiums'] as $child){

                if($child['type'] == 1)
                    $premium_check = true;
                if($child['type'] ==4){
                    $temp_object->quickicon = 'g';
                }
                if($child['type'] ==1){
                    $temp_object->premium = 'g';
                }
                if($child['type'] == 2){
                    $temp_object->blue_end_time = date("Y-m-d H:i:s",strtotime($child['until']));
                }
                if($child['type'] == 3){
                    $temp_object->bold_end_time = date("Y-m-d H:i:s",strtotime($child['until']));
                }
            }
            $temp_object->trade_state = 'a';
             if($value['status'] == 23 || $value['status'] == 32){
                $temp_object->trade_state = 'p';
             }
            if($value['user_quantity_min'] > 0)
                $temp_object->min_quantity = $value['user_quantity_min'];
            if($value['user_quantity_max'] > 0)
                $temp_object->max_quantity = $value['user_quantity_max'];

            if(!empty($value['user']) && $value['user']['mobile_verified'] == 1 && $value['user']['bank_verified'] == 1 && !empty($value['user']['email_verified_at']))
                $temp_object->trade_show_time = 'Y';
            else
                $temp_object->trade_show_time = 'N';
            $temp_object->ea_trade_money = number_format($value['user_price']).'원';
            if($value['user_division_unit'] > 0 && $value['user_division_price'] > 0){
                $temp_object->ea_trade_money = number_format($value['user_division_unit']).$unit.'당 '.number_format($value['user_division_price']);
                $temp_object->min_trade_money ='최소 '.number_format((int)$value['user_quantity_min'] / $value['user_division_unit'] * $value['user_division_price']);
                $temp_object->ea_range = $value['user_quantity_min'].$unit.'~'.$value['user_quantity_max'].$unit;
            }

            if($value['user_goods_type'] == 'general'){
                $temp_object->min_trade_money = number_format($value['user_price']);
            }
            if($value['user_goods_type'] == 'bargain'){
                $temp_object->min_trade_money = number_format($value['user_price_limit']);
            }

            if(!empty($value['user_price_limit'])){
                $temp_object->multidiscount_use = 'Y';
            }
            if($value['user_goods'] == 'item')
                $temp_object->game_money = '아이템';
            if($value['user_goods'] == 'money')
                $temp_object->game_money = '게임머니';

            if($value['account_type'] > 0){
                $chr = '기타';
                $chr_cou = '';
                if($value['account_type'] == 1){
                    $chr = 'Guest';
                }
                if($value['account_type'] == 2){
                    $chr = 'Google';
                }
                if($value['account_type'] == 3){
                    $chr = 'Facebook';
                }
                if($value['purchase_type'] == 1){
                    $chr_cou = '1대';
                }
                $range = $value['user_goods_type'] == 'bargain' ? '흥정 ': ' ';
                $temp_object->ea_range = $range.$temp_object->ea_range;
                $temp_object->character_subject = '['.$chr.' '.$chr_cou.']';
            }


            $temp_object->trade_id = $value['orderNo'];
            $temp_object->trade_date = date("Ymd",strtotime($value['created_at']));
            $temp_object->gs_name = $value['game']['game'].'/'.$value['server']['game'];
            $temp_object->game_code = $value['game_code'];
            $temp_object->server_code = $value['server_code'];
            $temp_object->seller_id = $value['userId'];
            $temp_object->buyer_id = !empty($value['toId']) ? $value['toId'] : '';
            $temp_object->screenshot = $value['screenshots'];
            $temp_object->user_seller = false;
            $temp_object->seller_icon_type = '';
            $temp_object->seller_icon = '';
            $temp_object->money_sort = '-1000';
            $temp_object->credit_img = !empty($value['user']['roles']) ? $value['user']['roles']['icon']:'';
            $temp_object->credit_name_en = !empty($value['user']['roles']) ? $value['user']['roles']['name']:'';
            $temp_object->trade_subject = $value['user_title'];
            $temp_object->str_trade_kind = $value['good_type'];
            $temp_object->reg_date = date("H:i",strtotime($value['created_at']));
            $temp_object->trade_reg_date = date("Y-m-d H:i:s",strtotime($value['created_at']));
            $temp_object->current_quantity = '0';
            $temp_object->trade_quantity = '0';
            $temp_object->trade_default_unit = '0';

            $temp_object->trade_category = '';
            $temp_object->trade_class = '';
            $temp_object->vw_trade_reg_date = 'g';
            $temp_object->pa_korean_text = null;
            $temp_object->ea_range = empty(trim($temp_object->ea_range)) ? null: $temp_object->ea_range;
            array_push($temp,$temp_object);
            if($premium_check && sizeof($premiums_array) < 10)
                array_push($premiums_array,$temp_object);
        }
        $result->data->g = $temp;
        $result->data->p = $premiums_array;
        return response()->json($result);
    }

    public function ajax_list(Request $request){
        $premiums_array = array();
        $result = new \stdClass();
        $result->result=  'SUCCESS';
        $result->data = new \stdClass();
        $search_game = $request->search_game;
        $search_server = $request->search_server;
        $temp = array();
        $request->order = empty($request->order) ? 2 : $request->order;

        $game = MItem
            ::with(['premiums','premium','game','server','user.roles'])
            ->where('game_code',$search_game)
            ->where('status',"!=",-1)
            ->where('type',$request->search_type);

        if(!empty($request->search_goods) && $request->search_goods != 'all')
            $game = $game->where('user_goods',$request->search_goods);

        if(!empty($request->search_word))
            $game = $game->where('user_title','LIKE','%'.$request->search_word.'%');


        if(!empty($request->goods_type) && $request->goods_type !=1 && $request->goods_type!= 'all')
            $game = $game->where('user_goods_type',$request->goods_type);


        if($request->order ==2 || empty($request->order)){
            $game = $game->orderBy('created_at',"DESC");
        }
        if($request->order ==1){
            $game = $game->orderBy('user_price',"ASC");
        }

        if($request->overlap == 'on')
            $game = $game->groupBy('game_code','server_code');


        $game = $game->skip(($request->pinit -1) * 50)->take(50)->get();
        $game = $game->toArray();
        foreach($game as $value){
            $premium_check = false;
            $unit = !empty($value['gamemoney_unit']) && $value['gamemoney_unit'] != 1 ? $value['gamemoney_unit'] : '';
            $temp_object = new \stdClass();
            $temp_object->premium = false;
            $temp_object->quickicon = false;
            $temp_object->min_quantity = 0;
            $temp_object->max_quantity = null;
            $temp_object->trade_keyword1 = '';
            $temp_object->trade_keyword2 = '';
            $temp_object->trade_keyword3 = '';
            $temp_object->multidiscount_use = 'N';
            $temp_object->seller_rank = 'A501';
            $temp_object->game_money = $value['good_type'];
            $temp_object->text_blue = 'N';
            $temp_object->text_icon = 'N';
            $temp_object->blue_end_time = '0000 00:00:00';
            $temp_object->bold_end_time = '0000 00:00:00';
            $temp_object->premium_end_time = '0000000000';
            $temp_object->character_subject = '';
            $temp_object->ea_range = '';
            $temp_object->trade_kind = '';

            if($value['user_goods'] == 'character'){
                $temp_object->trade_kind = '6';
            }
            if($value['user_quantity'] > 1 || !empty($unit)){
                $temp_object->trade_money = number_format($value['user_quantity']).$unit.'당 '.number_format($value['user_price']);
                $temp_object->ea_range = number_format($value['user_quantity']).$unit;
            }
            else{
                $temp_object->trade_money = number_format($value['user_price']);
            }
            foreach($value['premiums'] as $child){

                if($child['type'] == 1)
                    $premium_check = true;
                if($child['type'] ==4){
                    $temp_object->quickicon = 'g';
                }
                if($child['type'] ==1){
                    $temp_object->premium = 'g';
                    $temp_object->premium_end_time = date("YmdHis",strtotime($child['until']));
                }
                if($child['type'] == 2){
                    $temp_object->blue_end_time = date("Y-m-d H:i:s",strtotime($child['until']));
                }
                if($child['type'] == 3){
                    $temp_object->bold_end_time = date("Y-m-d H:i:s",strtotime($child['until']));
                }
            }

            $temp_object->trade_state = 'a';
            $gamemoney_unit = empty($value['gamemoney_unit']) || $value['gamemoney_unit'] == 1 ? $value['gamemoney_unit'] : '';
            $gamemoney_unit = $gamemoney_unit == 1 || $gamemoney_unit == '1' ? "": $gamemoney_unit;
            if($value['status'] == 23 || $value['status'] == 32){
                $temp_object->trade_state = 'p';
            }
            if($value['user_quantity_min'] > 0)
                $temp_object->min_quantity = $value['user_quantity_min'];
            if($value['user_quantity_max'] > 0)
                $temp_object->max_quantity = $value['user_quantity_max'];

            if(!empty($value['user']) && $value['user']['mobile_verified'] == 1 && $value['user']['bank_verified'] == 1 && !empty($value['user']['email_verified_at']))
                $temp_object->trade_show_time = 'Y';
            else
                $temp_object->trade_show_time = 'N';
            $temp_object->ea_trade_money = number_format($value['user_price']).'원';
            if($value['user_quantity'] > 1 || !empty($unit)){
                $temp_object->ea_trade_money = number_format($value['user_quantity']).$unit.'당 '.number_format($value['user_price']).'원';
            }
            else{
                $temp_object->ea_trade_money = number_format($value['user_price']).'원';
            }
            if($value['user_division_unit'] > 0 && $value['user_division_price'] > 0){
                $temp_object->ea_trade_money = number_format($value['user_division_unit']).$unit.'당 '.number_format($value['user_division_price']);
                $temp_object->min_trade_money ='최소 '.number_format((int)$value['user_quantity_min'] / $value['user_division_unit'] * $value['user_division_price']);
                $temp_object->ea_range = $value['user_quantity_min'].$unit.'~'.$value['user_quantity_max'].$unit;
            }

            if($value['user_goods_type'] == 'general'){
                $temp_object->min_trade_money = number_format($value['user_price']);
            }
            if($value['user_goods_type'] == 'bargain'){
                $temp_object->min_trade_money = number_format($value['user_price_limit']);
            }

            if(!empty($value['user_price_limit'])){
                $temp_object->multidiscount_use = 'Y';
            }
            if($value['user_goods'] == 'item')
                $temp_object->game_money = '아이템';
            if($value['user_goods'] == 'money')
                $temp_object->game_money = '게임머니';

            if($value['account_type'] > 0){
                $chr = '기타';
                $chr_cou = '';
                if($value['account_type'] == 1){
                    $chr = 'Guest';
                }
                if($value['account_type'] == 2){
                    $chr = 'Google';
                }
                if($value['account_type'] == 3){
                    $chr = 'Facebook';
                }
                if($value['purchase_type'] == 1){
                    $chr_cou = '1대';
                }
                $range = $value['user_goods_type'] == 'bargain' ? '흥정 ': ' ';
                $temp_object->ea_range = $range.$temp_object->ea_range;
                $temp_object->character_subject = '['.$chr.' '.$chr_cou.']';
            }


            $temp_object->trade_id = $value['orderNo'];
            $temp_object->trade_date = date("Ymd",strtotime($value['created_at']));
            $temp_object->gs_name = $value['game']['game'].'|'.$value['server']['game'];
            $temp_object->game_code = $value['game_code'];
            $temp_object->server_code = $value['server_code'];
            $temp_object->seller_id = $value['userId'];
            $temp_object->buyer_id = !empty($value['toId']) ? $value['toId'] : '';
            $temp_object->screenshot = $value['screenshots'];
            $temp_object->user_seller = false;
            $temp_object->seller_icon_type = '';
            $temp_object->seller_icon = '';
            $temp_object->money_sort = '-1000';
            $temp_object->credit_img = !empty($value['user']['roles']) ? $value['user']['roles']['icon']:'';
            $temp_object->credit_name_en = !empty($value['user']['roles']) ? $value['user']['roles']['name']:'';
            $temp_object->trade_subject = $value['user_title'];
            $temp_object->str_trade_kind = $value['good_type'];
            $temp_object->reg_date = date("H:i",strtotime($value['created_at']));
            $temp_object->trade_reg_date = date("Y-m-d H:i:s",strtotime($value['created_at']));
            $temp_object->current_quantity = '0';
            $temp_object->trade_quantity = '0';
            $temp_object->trade_default_unit = '0';

            $temp_object->trade_category = '';
            $temp_object->trade_class = '';
            $temp_object->vw_trade_reg_date = 'g';
            $temp_object->pa_korean_text = null;
            $temp_object->ea_range = empty(trim($temp_object->ea_range)) ? null: $temp_object->ea_range;
            array_push($temp,$temp_object);
            if($premium_check)
                array_push($premiums_array,$temp_object);
        }
        $result->data->g = $temp;
        array_multisort(array_column($premiums_array, 'premium_end_time'), SORT_DESC, $premiums_array);
        $result->data->p = $premiums_array;
        return response()->json($result);
    }

    public function message_view(Request $request){
        $message_id  = $request->message_id;
        $inbox = MInbox::with('payitem')->where('id',$message_id)->first();
        if(!empty($inbox)){
            MInbox::where('id',$message_id)->update(['readed'=>1]);
            $price = "";
            $price = !empty($inbox['payitem']) ? $inbox['payitem']['price'] : '';
            echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<message id=\"{$inbox['id']}\" result=\"true\"><trade_id>{$inbox['orderId']}</trade_id><price>{$price}</price><type>{$inbox['type']}</type><state>2</state><date>{$request->message_date}</date><subject>{$inbox['title']}</subject><content>{$inbox['content']}</content></message>";
        return;
        }
        echo "";
    }

    public function message_delete(Request $request){
        $message_id  = $request->message_id;
        MInbox::where('id',$message_id)->delete();
        echo 'success';
    }

    public function my_service(Request $request){
        MMyservice::whereNotNull('id')->delete();
        $list = $request->list;
        $params = array();
        foreach($list as $v){
            array_push($params,array('id'=>$v['value']));
        }
        if(!empty($params) && sizeof($params) > 0){
            MMyservice::insert($params);
        }
        return response()->json(array('msg'=>'성공적으로 저장되었습니다.','result'=>'SUCCESS'));
    }
    public function msg_get(Request $request){
        $next = false;
        $rst = true;
        $msg_list = array();
        $paging = $request->paging;
        $token = $request->token;
        $msg = MPrivateMessage::with('u1')->where('orderNo',$token)->orderBy("created_at","DESC")->skip($paging * 20)->take(20)->get()->toArray();
        if(count($msg) > 0){
//            $msg = array_reverse($msg);
            $msg_next = MPrivateMessage::where('orderNo',$token)->skip(($paging+1) * 20)->take(20)->get()->count();
            if($msg_next > 0){
                $next = true;
            }
            foreach($msg as $v){
                array_push($msg_list,array(
                    "id"=>$v['u1']['loginId'],
                    "whoAmI"=>$v['type'],
                    "msg"=>$v['msg'],
                    "chat_de"=>date("Y-m-d H:i:s",strtotime($v['created_at']))
                ));
            }
        }
        else{
            $rst = false;
        }
        return response()->json(array("NEXT"=>$next,"RST"=>$rst,"MSG"=>json_encode($msg_list)));
    }

    public function msg_encrypt(Request $request){
        $whoAmI = $request->whoAmI;
        $msg = $request->msg;
        $token = $request->token;
        MPrivateMessage::insert([
           'orderNo'=>$token,
            'userId1'=>$this->user->id,
            'type'=>$whoAmI,
            'msg'=>$msg
        ]);
        return response()->json(array("RST"=>true,'MSG'=>$msg,'TIME'=>date("Y-m-d H:i:s"),'FILTER'=>false));
    }

    public function quicklinkuser_home(Request $request){
        $role = MRole::where('level',$this->user->role)->first();
        $point = number_format($this->user->point);
        $m = $a = $e = "";
        if($this->user->mobile_verified ==1)
            $m = "<img src='/mania/img/icons/icon_check.png'>";
        if($this->user->bank_verified ==1)
            $a = "<img src='/mania/img/icons/icon_check.png'>";
        if(!empty($this->user->email_verified_at))
            $e = "<img src='/mania/img/icons/icon_check.png'>";
        $mileage = number_format($this->user->mileage);
        $buying_register = MItem::
        where('userId',$this->user->id)->
        where('type','buy')->
        where('status','!=',-1)->
        get()->count();
        $selling_register = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',"!=",-1)->
        whereDoesntHave('bargains')->
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
        $bargain_request_buy = MItem::
        where('userId','!=',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests',function($query){
            $query->where('userId',$this->user->id);
        })->
        whereDoesntHave('payitem')->get()->count();
        $bargain_request = MItem::
        where('userId',$this->user->id)->
        where('type','sell')->
        where('status',0)->
        whereNull('toId')->
        whereHas('bargain_requests')->
        whereDoesntHave('payitem')->get()->count();
        $games = MMygame::orderBy('order','ASC')->get();
        $game_list = '';
        foreach($games as $v){
            $m_type = '팝니다';
            $item_alias = itemAlias($v['goods_text']);
            if($v['type'] == 'buy')
                $m_type = '삽니다';
            $game_list .= "<dd title=\"{$v['game_text']}{$v['serer_text']}\">
                <span class='title-{$v['type']}'><img src='/mania/img/icons/{$v['type']}-i.png' />-{$m_type}-</span>
                <strong>{$v['game_text']} > {$v['server_text']}</strong>{$v['serer_text']}
                <div class=\"btn_area\">
                    <a href=\"/sell/list_search?search_type={$v['type']}&search_game={$v['game']}&search_game_text={$v['game_text']}&search_server={$v['server']}&search_server_text={$v['server_text']}&search_goods={$item_alias}\">검색</a>
                    <a href=\"/{$v['type']}?game={$v['game']}&server={$v['server']}\">등록</a>
                 </div>
             </dd>";
        }

        echo "<div class=\"myinfo\">
        <dl class=\"status\">
            <dd class=\"credir_rt\">
                <div class=\"rt_figure\">
                    <img src='/mania/img/level/{$role['icon']}' />
                </div>
                <div class=\"user_name\">{$this->user->name}</div>
                <span class=\"rank _txt\">{$role['alias']}회원 &nbsp;&nbsp;<span class='f_blue1 f_bold f-16'>{$point}</span></span>
            </dd>
            <dd class=\"cert\">
                <span class=\"cert_state\">{$m}&nbsp;&nbsp;휴대폰</span>
                <span class=\"cert_state\">{$a}&nbsp;&nbsp;계좌</span>
                <span class=\"cert_state\">{$e}&nbsp;&nbsp;이메일</span>
            </dd>
        </dl>
        <dl class=\"milage\">
            <dt>총 마일리지</dt>
            <dd>{$mileage}원</dd>
        </dl>
        <div class=\"other_link\">
            <a href=\"/myroom/my_mileage/index_c\" class='head_charge'>충전</a>
            <a href=\"/myroom/my_mileage/index_e\" class='head_give'>출금</a>
            <a href=\"/myroom/\" class='head_myroom'>마이룸</a>
        </div>
    </div>

    <div class=\"trade_list\">
        <ul class=\"ing_count\">
            <li class=\"sell\">
                <span class=\"c_txt sells\">판매목록</span>
                <div class=\"qbox\">
                    <div class=\"ings\">
                        <div>
                            <span class='mr-15'>판매등록</span>
                            <span><a href=\"/myroom/sell/sell_regist\">{$selling_register}건</a></span>
                        </div>
                        <div>
                            <span class='mr-15'>흥정신청</span>
                            <span><a href=\"/myroom/sell/sell_check\">{$bargain_request}건</a></span>
                        </div>
                    </div>
                </div>
            </li>
            <li class=\"buy\">
                <span class=\"c_txt buys\">구매목록</span>
                <div class=\"qbox\">

                    <dl class=\"ings\">
                        <div>
                            <span class='mr-15'>구매등록</span>
                            <span><a href=\"/myroom/buy/buy_regist\">{$buying_register}건</a></span>
                        </div>

                    </dl>
                </div>
            </li>
        </ul>
    </div>

    <div class=\"favorite\">
        <div class=\"s_title\">
            나만의 검색메뉴
            <a href=\"/myroom/customer/search\" style='margin-left: 15px'><i class='fa fa-cog'></i></a>
        </div>
        <dl class=\"my_game\">
            {$game_list}
        </dl>
    </div>";
    }

    public function gamelist(Request $request){
        echo '<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">

<xsl:variable name="len" select="0" />

<xsl:for-each select="/gamelist/game">

<xsl:element name="div">
	<xsl:attribute name="value"><xsl:value-of select="@id" /></xsl:attribute>

	<xsl:choose>
		<xsl:when test="@level=\'1\'"><xsl:attribute name="style">color:#407FD4</xsl:attribute></xsl:when>
		<xsl:when test="@level=\'2\'"><xsl:attribute name="style">color:#03A307</xsl:attribute></xsl:when>
		<xsl:when test="@level=\'3\'"><xsl:attribute name="style">color:#FF9000</xsl:attribute></xsl:when>
		<xsl:when test="@level=\'4\'"><xsl:attribute name="style">color:#B651F2</xsl:attribute></xsl:when>
	</xsl:choose>

	<xsl:element name="span">
		<xsl:attribute name="style">font-weight:bold;color:#FF3300</xsl:attribute>
		<xsl:value-of select="substring(@name,1,$len)" />
	</xsl:element>

	<xsl:value-of select="substring(@name,$len+1)" />

	<xsl:element name="input">
		<xsl:attribute name="type">hidden</xsl:attribute>
		<xsl:attribute name="name">unit</xsl:attribute>
		<xsl:attribute name="value"><xsl:value-of select="@unit" /></xsl:attribute>
	</xsl:element>

</xsl:element>

</xsl:for-each>

</xsl:template>

</xsl:stylesheet>';
    }

    public function gamelist_xml(Request $request){
        $gameList = "<gamelist>";
        $game_items = "";
        $games = MGame::with('firstOfproperty')->whereHas('firstOfproperty')->where('status',1)->orderBY('order','ASC')->get();
        foreach($games as $v){
            $character_view = $v['character_enabled'] == 1 ? 'Y':'N';
            $game_items .= "<game id=\"{$v['id']}\" name=\"{$v['game']}\" level=\"1\" unit=\"{$v['firstOfproperty']['game']}\" search=\"R\" premium_view=\"y\" lowest_view=\"n\" character_view=\"{$character_view}\"/>";
        }
        $gameList .= $game_items;
        $gameList .= "</gamelist>";
        echo $gameList;
    }

    public function serverlist(Request $request){
       $id = $request->game;
       $serverList = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
                        <SERVERLIST GAME_ID=\"{$id}\" RESULT=\"success\">";
       $server_games = "";
       $item_type = MGame::where("parent",$id)->where('depth',2)->orderBY('order','ASC')->first();
       $item_type=  !empty($item_type) ? $item_type['game'] : '';
       $games = MGame::where("status",1)->where('parent',$id)->where('depth',1)->orderBy('order','ASC')->get();
       $server_games .= "<SERVER ID=\"0\" TYPE=\"all\" NAME=\"서버전체\" MONEY=\"1\" MONEY_UNIT=\"\" UNIT=\"{$item_type}\" MONEYSORT_TYPE=\"Y\" TIMELIST_TYPE=\"00\" PREMIUM_VIEW=\"y\" LOWEST_VIEW=\"n\" />";
       foreach($games as $v){
           if($v['game']  != '기타')
                $server_games .= "<SERVER ID=\"{$v['id']}\" NAME=\"{$v['game']}\" MONEY=\"46\" MONEY_UNIT=\"\" UNIT=\"{$item_type}\" MONEYSORT_TYPE=\"Y\" TIMELIST_TYPE=\"00\" PREMIUM_VIEW=\"y\" LOWEST_VIEW=\"n\" />";
           else
               $server_games .= "<SERVER ID=\"{$v['id']}\" TYPE=\"etc\" NAME=\"기타\" MONEY=\"65535\" MONEY_UNIT=\"\" UNIT=\"{$item_type}\" MONEYSORT_TYPE=\"Y\" TIMELIST_TYPE=\"00\" PREMIUM_VIEW=\"y\" LOWEST_VIEW=\"n\" />";
       }
       $serverList .= $server_games;
       $serverList .= "</SERVERLIST>";
       echo $serverList;
    }

    public function serverlist_xsl(Request $request){
        echo '<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">

<xsl:variable name="len" select="0" />

<xsl:for-each select="/SERVERLIST/SERVER[not(@TYPE)]">

<xsl:element name="div">
	<!--<xsl:attribute name="onmouseover">_item.option2.onmouseover.bind(this)()</xsl:attribute>
	<xsl:attribute name="onmouseout">_item.option2.onmouseout.bind(this)()</xsl:attribute>
	<xsl:attribute name="onclick">_item.option2.onclick.bind(this)()</xsl:attribute>//-->
	<xsl:attribute name="value"><xsl:value-of select="@ID" /></xsl:attribute>

	<xsl:element name="span">
		<xsl:attribute name="style">font-weight:bold;color:#FF3300</xsl:attribute>
		<xsl:value-of select="substring(@NAME,1,$len)" />
	</xsl:element>

	<xsl:value-of select="substring(@NAME,$len+1)" />

	<!-- <xsl:element name="input">
		<xsl:attribute name="type">hidden</xsl:attribute>
		<xsl:attribute name="name">servercode</xsl:attribute>
		<xsl:attribute name="value"><xsl:value-of select="@ID" /></xsl:attribute>
	</xsl:element> -->

	<xsl:element name="input">
		<xsl:attribute name="type">hidden</xsl:attribute>
		<xsl:attribute name="name">gamecode</xsl:attribute>
		<xsl:attribute name="value"><xsl:value-of select="../@GAME_ID" /></xsl:attribute>
	</xsl:element>

	<xsl:element name="input">
		<xsl:attribute name="type">hidden</xsl:attribute>
		<xsl:attribute name="name">money</xsl:attribute>
		<xsl:attribute name="value"><xsl:value-of select="@MONEY" /></xsl:attribute>
	</xsl:element>

	<xsl:element name="input">
		<xsl:attribute name="type">hidden</xsl:attribute>
		<xsl:attribute name="name">money_unit</xsl:attribute>
		<xsl:attribute name="value"><xsl:value-of select="@MONEY_UNIT" /></xsl:attribute>
	</xsl:element>

	<xsl:element name="input">
		<xsl:attribute name="type">hidden</xsl:attribute>
		<xsl:attribute name="name">unit</xsl:attribute>
		<xsl:attribute name="value"><xsl:value-of select="@UNIT" /></xsl:attribute>
	</xsl:element>

</xsl:element>

</xsl:for-each>

</xsl:template>


</xsl:stylesheet>';
    }
}
