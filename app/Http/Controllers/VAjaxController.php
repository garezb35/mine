<?php

namespace App\Http\Controllers;

use App\Models\MInbox;
use App\Models\MItem;
use App\Models\MMyservice;
use App\Models\MPrivateMessage;
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
}
