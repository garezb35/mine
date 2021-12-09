<?php

namespace App\Http\Controllers;

use App\Models\MAdminCash;
use App\Models\MGame;
use App\Models\MItem;
use App\Models\MMileage;
use App\Models\MPayhistory;
use App\Models\MPayitem;
use App\Models\MRole;
use App\Models\MUserbank;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseAdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard(){
        $user_list = array();
        for($i = 0; $i < 12 ; $i ++)
            $user_list[$i]= 0;
        $cash = MAdminCash::where('id',1)->first();
        $users_num = User::where('state','!=' ,2)->where('state','!=' ,3)->where('is_admin',0)->get()->count();
        $products_num = MItem::whereHas('user',function($query){
            $query->where('state','!=',2);
            $query->where('state','!=',3);
        })->where('status','!=',-1)->get()->count();
        $request_num = MItem::whereHas('user')
            ->where('accept_flag',1)
            ->whereNotNUll('toId')
            ->where(function($query){
                $query->where('status',1);
                $query->orWhere('status',2);
                $query->orWhere('status',3);
            })
            ->get()->count();
        $request_orders = MItem::with(['payitem','user','other','game','server','ask.user'])
            ->whereHas('user')
            ->whereHas('ask')
            ->where('accept_flag',1)
            ->whereNotNUll('toId')
            ->where(function($query){
                $query->where('status',1);
                $query->orWhere('status',2);
                $query->orWhere('status',3);
            })
            ->limit(5)
            ->orderby('updated_at','DESC')
            ->get()->toArray();
        $items = User::
        select(DB::raw('COUNT(id) a_id'),DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->where('state','!=' ,2)->where('state','!=' ,3)
            ->whereYear('created_at',date("Y"))
            ->where("is_admin",0)
            ->groupby('year','month')->get();
        foreach($items as $v){
            $user_list[$v['month'] - 1] = $v['a_id'];
        }
        $mileage = MMileage::with('user')->where('status',0)->orderBy('createdByDtm','DESC')->limit(5)->get();
        return view('admin.dashboard',[
            'cash'=>$cash['cash'],
            'users_num'=>$users_num,
            'products_num'=>$products_num,
            'request_num'=>$request_num,
            'user_list'=>json_encode($user_list),
            'mileage'=>$mileage,
            'request_orders'=>$request_orders

        ]);
    }
    public function profile(){
        return view('admin.profile.edit');
    }
    public function updateProfile(){

    }
    public function passwordProfile(){

    }

    public function userList(){
        return view('admin.users.index');
    }

    public function tableList(){
        return view('admin.pages.tables');
    }

    public function graphOrdersByYear(Request $request){
        $year = $request->year;
        $order_list = array();
        for($i = 0; $i < 12 ; $i ++)
            $order_list[$i]= 0;
        $items = MPayitem::
        select(DB::raw('SUM(price) a_price'),DB::raw('YEAR(updated_at) year, MONTH(updated_at) month'))
            ->where('status',2)
            ->whereYear('created_at',$year)
            ->groupby('year','month')->get();
        foreach($items as $v){
            $order_list[$v['month']-1] = $v['a_price'];
        }
        return response()->json($order_list);
    }

    public function exportXML(){

        $days_ago = date('Y-m-d', strtotime('-10 days'));
        $days_between = createDateRangeArray($days_ago,'now');
        $ordered_game = array();
        $xml_list = "";
        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?><games>";
        $games = MGame::with(['firstOfproperty','childGames'])->whereHas('firstOfproperty')->orderBy('order','ASC')->limit(5)->get()->toArray();
        $game_raws = DB::select("SELECT
                              (SUM(m_payitem.price) / SUM(m_payitem.buy_quantity)) * m_game.ruler AS a_price,
                              MONTH(m_payitem.updated_at) month ,
                              DAY(m_payitem.updated_at) day ,
                              m_item.server_code,
                              m_item.game_code,
                              m_payitem.buy_quantity,
                              m_game.ruler
                            FROM
                              `m_payitem`
                              INNER JOIN `m_item`
                                ON `m_payitem`.`orderNo` = `m_item`.`orderNo`
                              INNER JOIN `m_game`
                                ON `m_item`.`server_code` = `m_game`.`id`
                            WHERE YEAR(`m_payitem`.`updated_at`) = 2021
                              AND `m_payitem`.`buy_quantity` > m_game.ruler
                              AND  `m_item`.`user_goods` = 'money'
                              AND  `m_payitem`.`updated_at` > '{$days_ago}'
                            GROUP BY `month`,`day`,`m_item`.`server_code` ");

        foreach($game_raws as $raw){
            $ordered_game['m'.$raw->game_code.$raw->server_code.$raw->month.$raw->day] = intval($raw->a_price);
        }

        foreach($games as $g){
            $xml_list .= "<game code='{$g['id']}' name='{$g['game']}'>";
            $total_cnt = 0;
            $viewNumber = 1;
            $temp = 0;
            foreach($g['child_games'] as $child){
                if($temp > 3){
                    $temp=0;
                    $viewNumber++;
                }
                $numberUnit = numberReverseUnit($g['ruler']);
                $xml_list .= "<server viewNumber='{$viewNumber}' code='{$child['id']}' name='{$child['game']}' standardUnit ='{$numberUnit}' Unit ='{$g['first_ofproperty']['game']}'>";
                foreach($days_between as $day){
                    $price = !empty($ordered_game['m'.$g['id'].$child['id'].$day[0].$day[1]]) ? number_format($ordered_game['m'.$g['id'].$child['id'].$day[0].$day[1]]) : 0;
                    $xml_list .= "<price day='{$day[1]}'>{$price}</price>";
                }
                $xml_list .= "</server>";
                $temp++;
            }
            $xml_list .= "<totalCnt>{$viewNumber}</totalCnt>";
            $xml_list .= "</game>";
        }
        $xml .= $xml_list;
        $xml .= "</games>";
        file_put_contents(base_path().'\public\mania\_xml\avgPriceXml\gamechart.xml', $xml);
        echo 1;
    }
    public function members(Request $request){
        $state = $request->get('state');
        $usr_alias = $request->get("usr_alias");
        $user_rate = $request->get("user_rate");
        $email_verified_at = $request->get("email_verified_at");
        $mobile_verified = $request->get("mobile_verified");
        $bank_verified = $request->get("bank_verified");
        $member = User::with(['bank','roles'])->where("is_admin",0);
        if(!empty($state)){
            $state = explode("-",$state);
            $member = $member->where(functioN($query) use ($state){
                foreach($state as $state_v){
                    $query->orWhere('state',$state_v);
                }
            });
        }
        if(!empty($usr_alias)){
            $member = $member->where(function($query) use($usr_alias){
                $query->orwhere('name',"LIKE","%".$usr_alias."%");
                $query->orwhere('email',"LIKE","%".$usr_alias."%");
                $query->orwhere('nickname',"LIKE","%".$usr_alias."%");
            });
        }
        if(!empty($user_rate)){
            $member = $member->where('role',$user_rate);
        }
        if($email_verified_at == 1){
            $member = $member->whereNotNull("email_verified_at")->where('email_verified_at','<>','');
        }
        else if($email_verified_at == 0){
            $member = $member->whereNull("email_verified_at");
        }
        if($mobile_verified != null && ($mobile_verified == 0 || $mobile_verified == 1)){
            $member = $member->where("mobile_verified",$mobile_verified);
        }
        if($bank_verified != null && ($bank_verified == 0 || $bank_verified == 1)){
            $member = $member->where("bank_verified",$bank_verified);
        }
        $member = $member->paginate(15);
        $roles = MRole::orderby('level','ASC')->get();
        return view('admin.members',[
            'members'=>$member,
            'roles'=>$roles
        ]);
    }
    public function mileage_charge(Request $request){
        $usr_alias = trim($request->get("usr_alias"));
        $state = trim($request->get("state"));
        $type = trim($request->get("type"));
        $mileage = MMileage::with(['user'])
            ->whereHas('user',function($query) use ($usr_alias){
                if(!empty($usr_alias)){
                    $query->where(function($query1) use($usr_alias){
                        $query1->where('name','LIKE',"%".$usr_alias."%");
                        $query1->orWhere('nickname','LIKE',"%".$usr_alias."%");
                        $query1->orWhere('email','LIKE',"%".$usr_alias."%");
                    });
                }
            });
        if($state >= 0 ){
            $mileage = $mileage->where('status',$state);
        }
        if($type >= 0 ){
            $mileage = $mileage->where('type',$type);
        }
        $mileage = $mileage->orderby('createdByDtm',"DESC")
            ->orderby("status","ASC");
        $mileage = $mileage->paginate(15);
        return view('admin.mileage_charge',[
            "mileage"=>$mileage
        ]);
    }
    public function mileage_used(Request $request){
        $usr_alias = trim($request->get("usr_alias"));
        $mtype = $request->get('mtype');
        $price1 = $request->get("price1");
        $price2 = $request->get("price2");
        $date1 = $request->get("date1");
        $date2 = $request->get("date2");
        $mileage1 = MPayhistory::
        with(['user']);
        $mileage1 = $mileage1->whereHas('user',function($query) use ($usr_alias){
            if(!empty($usr_alias)){
                $query->where('name',"LIKE","%".$usr_alias."%");
                $query->orwhere('email',"LIKE","%".$usr_alias."%");
                $query->orwhere('nickname',"LIKE","%".$usr_alias."%");
            }
        })
            ->where("status",1)
            ->where('pay_type','<>',3);
        if(!empty($mtype)){
            if(strpos($mtype, "m") !== false){
                $mileage1 = $mileage1->where("pay_type",str_replace("m","",$mtype));
            }
            if($mtype == 0 || $mtype == 1){
                $mileage1 = $mileage1->whereNull('pay_type');
            }
        }
        if(!is_null($price1) &&  $price1 >= 0){
            $mileage1 = $mileage1->where('price','>=',$price1);
        }
        if(!is_null($price2) &&  $price2 >= 0){
            $mileage1 = $mileage1->where('price','<=',$price2);
        }
        if(!empty($date1)){
            $mileage1 = $mileage1->whereDate('updated_at','>=',$date1);
        }
        if(!empty($date2)){
            $mileage1 = $mileage1->whereDate('updated_at','<=',$date2);
        }
        $mileage1 =  $mileage1->orderby("updated_at","DESC")->select(DB::raw('price'),DB::raw('userId'),DB::raw('CONCAT(pay_type,"m") as type'),DB::raw('updated_at'),DB::raw('orderNo'), DB::raw('minus'));
        $mileage2 = MMileage::with(['user']);
        $mileage2=  $mileage2->whereHas('user', function($query) use ($usr_alias){
            if(!empty($usr_alias)) {
                $query->where('name',"LIKE","%".$usr_alias."%");
                $query->orwhere('email',"LIKE","%".$usr_alias."%");
                $query->orwhere('nickname',"LIKE","%".$usr_alias."%");
            }
        })
            ->where('status',2);
        if(!empty($mtype)){
            if($mtype == 0 || $mtype == 1){
                $mileage2 = $mileage2->where("type",$mtype);
            }
            if(strpos($mtype, "m") !== false){
                $mileage2 = $mileage2->whereNull("type");
            }
        }
        if(!is_null($price1) &&  $price1 >= 0){
            $mileage2 = $mileage2->where('money','>=',$price1);
        }
        if(!is_null($price2) &&  $price2 >= 0){
            $mileage2 = $mileage2->where('money', '<=', $price2);
        }
        if(!empty($date1)){
            $mileage2 = $mileage2->whereDate('updatedByDtm','>=',$date1);
        }
        if(!empty($date2)){
            $mileage2 = $mileage2->whereDate('updatedByDtm','<=',$date2);
        }
        $mileage2 = $mileage2->orderby('updatedByDtm','DESC')->select(DB::raw('money as price'),DB::raw('userId'),DB::raw('type'),DB::raw('updatedByDtm as updated_at'), DB::raw('type as orderNo'), DB::raw('type as minus'));
        $merged_mileage = $mileage1->unionAll($mileage2)->paginate(15);
        return view('admin.mileage_used',[
            "merged_mileage"=>$merged_mileage
        ]);
    }

    public function member_control(Request $request){
        $msg = "";
        $userIds = $request->userIds;
        $user_exit = $request->user_exit;
        $user_rate = $request->user_rate;
        $userIds = explode(",",$userIds);
        $exit_cancel = $request->exit_cancel;
        $updated_item = array();
        if($exit_cancel == 1){
            $updated_item["state"] = 1;
        }
        else if($exit_cancel == 2){
            User::whereIn('id',$userIds)->delete();
            $msg = '선택된 자료가 정확히 삭제되었습니다.';
            return redirect()->back()->with(['message' => $msg]);
        }
        else{
            if(!empty($user_exit)){
                $updated_item["state"] = $user_exit;
            }
            if(!empty($user_rate)){
                $role = MRole::where('level',$user_rate)->first();
                $updated_item["point"] = $role['point'];
                $updated_item["role"] = $user_rate;
            }
        }
        if(!empty($updated_item)){
            User::whereIn('id',$userIds)->update($updated_item);
            $msg = "변경되었습니다.";
        }
        else{
            $msg = "조작이 실패되었습니다.";
        }
        return redirect()->back()->with(['message' => $msg]);
    }

    public function mileage_control(Request $request){
        $mids = $request->mids;
        $state = $request->state;
        $mode = $request->mode;
        $mids = explode(",", $mids);
        $updated_item = array();
        $msg = "";
        if($mode == 1){
            if($state == 2) {
                $mileage_request = MMileage::whereIn("id",$mids)->get();
                foreach($mileage_request  as $m_req){
                    $user = User::where('id',$m_req['userId'])->first();
                    $updated_mileage = 0;
                    if($m_req['type'] == 1 && $user['mileage'] < $m_req['money']){
                        continue;
                    }
                    if($m_req['type'] == 0){
                        $updated_mileage = $user['mileage'] + $m_req['money'];
                    }
                    if($m_req['type'] == 1){
                        $updated_mileage = $user['mileage'] - $m_req['money'];
                    }
                    User::where("id",$m_req['userId'])->update(['mileage'=>$updated_mileage]);
                    MMileage::where('id',$m_req['id'])->update(['status'=>2]);
                }
            }
            else{
                MMileage::whereIn('id',$mids)->update(['status'=>$state]);
            }

            $msg = "성공적으로 처리되었습니다.";
        }
        else {
            MMileage::whereIn("id",$mids)->delete();
            $msg = "성공적으로 삭제되었습니다.";
        }
        return redirect()->back()->with(['message' => $msg]);
    }

    public function member_edit(Request $request){
        $id = $request->id;
        $user = User::with(["roles"],"bank")->whereHas('roles')->where('id',$id)->first();
        $role = MRole::get();
        if(empty($user)){
            return redirect()->back();
        }
        return view('admin.member.member_edit',[
            "muser"=>$user,
            'roles'=>$role
        ]);
    }

    public function member_update(Request $request){
        $param = $request->all();
        $id = $param['id'];
        $page = $param['page'];
        unset($param['id']);
        unset($param['page']);
        unset($param['_token']);
        $user = User::where("id",$id)->first();
        if(empty($param['email_verified_at'])){
            $param['email_verified_at'] = NULL;
        }
        else{
            if(!empty($user['email_verified_at'])){
                unset($param['email_verified_at']);
            }
            else{
                $param['email_verified_at'] = date("Y-m-d H:i:s");
            }
        }
        if(empty($param['mobile_verified'])){
            $param['mobile_verified'] = 0;
        }

        if(empty($param['bank_verified'])){
            $param['bank_verified'] = 0;
        }
        User::where('id',$id)->update($param);
        return redirect("admin/members?page={$page}")->with('message', "{$user['name']}님의 회원정보가 변경되었습니다!");
    }

    public function member_password(Request $request){
        $password = $request->password;
        $page  = $request->page;
        $id = $request->id;
        $user = User::where('id',$id)->first();
        User::where('id',$id)->update(['password'=>Hash::make($password)]);
        return redirect("admin/members?page={$page}")->with('message', "{$user['name']}님의 비밀번호가 {$password} 으로 변경되었습니다!");
    }

    public function order_list(Request $request){
        $servers = array();
        $game = $request->game;
        $server_code = $request->server_code;
        $orderNo = $request->orderNo;
        $username = $request->username;
        $type = $request->type;
        $good_type = $request->good_type;

        $games = MGame::where("depth",0)->orderby('order','ASC')->get();
        $order = MItem::with(['game','server','payitem','user','other'])
            ->whereHas('game')
            ->whereHas('server');
        if(!empty($username)) {
            $order = $order->whereHas('user',function($query) use ($username){
                $query->where('name',"LIKE","%".$username."%");
                $query->where('email',"LIKE","%".$username."%");
                $query->where('nickname',"LIKE","%".$username."%");
            });
        }
        if(!empty($orderNo)){
            $order = $order->where('orderNo','LIKE',"%".$orderNo."%");
        }

        if(!empty($type)){
            $order = $order->where('type',$type);
        }

        if(!empty($good_type)){
            $order = $order->where('user_goods_type',$good_type);
        }

        if(!empty($game)){
            $servers = MGame::where('parent',$game)->where("depth",1)->orderby('order','ASC')->get();
            $order = $order->where('game_code',$game);
        }

        if(!empty($server_code)){
            $order = $order->where('server_code',$server_code);
        }

        $order = $order->orderby('created_at',"DESC")->paginate(15);
        return view('admin.order.order_list',[
            'game'=>$games,
            'servers'=>$servers,
            'orders'=>$order
        ]);
    }

    public function getServers(Request $request){
        $id = $request->id;
        $servers = array();
        if(empty($id)){

        }
        else{
            $server_games = MGame::where("depth",1)->where("parent",$id)->orderby('order','ASC')->get();
            array_push($servers,array("id"=>"","text"=>"전체"));
            foreach($server_games as $s){
                array_push($servers,array("id"=>$s["id"],"text"=>$s["game"]));
            }
        }

        return response()->json($servers);
    }
}

