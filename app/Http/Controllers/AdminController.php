<?php

namespace App\Http\Controllers;

use App\Models\MAdminCash;
use App\Models\MAdminNotice;
use App\Models\MAsk;
use App\Models\MBargainRequest;
use App\Models\MCancelReason;
use App\Models\MGame;
use App\Models\MGift;
use App\Models\MInbox;
use App\Models\MItem;
use App\Models\MMall;
use App\Models\MMallBuy;
use App\Models\MMileage;
use App\Models\MNotice;
use App\Models\MPayhistory;
use App\Models\MPayitem;
use App\Models\MPremium;
use App\Models\MRole;
use App\Models\MRoleGift;
use App\Models\MUserbank;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseAdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard() {
        $user_list = array();
        for($i = 0; $i < 12 ; $i ++)
            $user_list[$i]= 0;

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
            'user_list'=>json_encode($user_list),
            'mileage'=>$mileage,
            'request_orders'=>$request_orders

        ]);
    }
    public function profile() {
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
        file_put_contents(base_path().'\public\angel\_xml\avgPriceXml\gamechart.xml', $xml);
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
                $query->where('name',"LIKE","%".$usr_alias."%");
                $query->orWhere('email',"LIKE","%".$usr_alias."%");
                $query->orWhere('nickname',"LIKE","%".$usr_alias."%");
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
        $mileage = $mileage
            ->orderby('createdByDtm',"DESC");
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
                $query->orWhere('email',"LIKE","%".$usr_alias."%");
                $query->orWhere('nickname',"LIKE","%".$usr_alias."%");
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
                $query->orWhere('email',"LIKE","%".$usr_alias."%");
                $query->orWhere('nickname',"LIKE","%".$usr_alias."%");
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
        $order = MItem::with(['game','server','payitem','user','other','bargain_requests'])
            ->whereHas('game')
            ->whereHas('server');
        if(!empty($username)) {
            $order = $order->whereHas('user',function($query) use ($username){
                $query->where('name',"LIKE","%".$username."%");
                $query->orWhere('email',"LIKE","%".$username."%");
                $query->orWhere('nickname',"LIKE","%".$username."%");
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
        if (empty($id)){

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

    public function order_control(Request $request){
        $id = $request->id;
        $type = $request->type;
        $item = MItem::with(['payitem'])->where('id',$id)->first();
        if(empty($item)){
            return response()->json(array("status"=>0,'msg'=>'자료가 비었습니다.'));
        }
    }

    public function orderContent(Request $request){
        $id = $request->id;
        $item = MItem::with(['user','other','game','server','payitem','privateMessage','bargains'])->where('orderNo',$id)->first();
        $seller =  $buyer = array();
        if(empty($item)){
            echo "<script>alert('존재하지 않는 자료입니다.');self.close();</script>";
        }
        if($item['type'] == 'sell'){
            $seller['u'] = $item['user'];
            $seller['c'] =$item['user_character'];
            $buyer['c'] = "";
            $buyer['u'] = $item['other'];
            if(!empty($item['payitem']))
                $buyer['c'] = $item['payitem']['character'];
        }
        else{
            $buyer['u'] = $item['user'];
            $buyer['c'] = $item['user_character'];
            $seller['u'] = $item['other'];
            $seller['c'] = "";
            if(!empty($item['payitem']))
                $seller['c'] = $item['payitem']['character'];

        }
        return view('admin.order.order_content',[
            'item'=>$item,
            'buyer'=>$buyer,
            'seller'=>$seller
        ]);
    }

    public function controlOrder(Request $request){
        $orderNo = $request->orderNo;
        $type = $request->type;
        $buy_id = $sell_id = 0;
        $item = MItem::with('payitem')->where('orderNo',$orderNo)->first();
        if(empty($item))
            return response()->json(array('msg'=>'자료가 존재하지 않습니다.','type'=>2));
        if($item['type'] == 'sell'){
            $buy_id = $item['toId'];
            $sell_id = $item['userId'];
        }
        else{
            $sell_id = $item['toId'];
            $buy_id = $item['userId'];
        }
        if($item['status'] == 23 || $item['status'] ==32){
            return response()->json(array('msg'=>'이미 거래완료된 물품입니다.','type'=>3));
        }
        if($type == 'end'){
            if(empty($item['toId']) || empty($item['payitem']) || $item['status'] == 0 || $item['payitem']['status'] == 0){
                return response()->json(array('msg'=>'요청을 수락할수 없습니다.','type'=>3));
            }

            $r = $this->processPay($buy_id,$sell_id,$orderNo);
            if($r == 1){
                MPayitem::where('orderNo', $orderNo)->update(['status' => 2]);
                MItem::where('orderNO', $orderNo)->update(['status'=>32]);
                return response()->json(array('msg'=>'거래완료되었습니다.','type'=>1));
            }
            else{
                return response()->json(array('msg'=>'서버오류.','type'=>3));
            }
        }
        if($type == 'cancel'){
            if( empty($item['toId']) || empty($item['payitem'])) {
                return response()->json(array('msg'=>'요청을 수락할수 없습니다.','type'=>3));
            }
            elseif($item['status'] == 0 || $item['payitem']['status'] == 0){
                MPremium::where('post_id',$item['id'])->delete();
                MBargainRequest::where('orderNo',$item['id'])->delete();
                MItem::where('orderNo',$orderNo)->update(['status'=>-1]);
            }
            else{

                MPremium::where('post_id',$item['id'])->delete();
                MBargainRequest::where('orderNo',$item['id'])->delete();
                User::where('id',$buy_id)->update(['mileage'=> DB::raw('mileage+'.$item['payitem']['price'])]);
                MPayhistory::insert([
                    'orderNo'=>$orderNo,
                    'pay_type'=>21,
                    'price'=>$item['payitem']['price'],
                    'status'=>1,
                    'userId'=>$buy_id
                ]);
                MItem::where('orderNo',$orderNo)->update(["status"=>-1]);
                MPayitem::where('id',$item['payitem']['id'])->delete();
                MCancelReason::insert([
                    'orderNo'=>$orderNo,
                    'reason'=>'관리자 거래취소',
                    'content'=>'관리자 거래취소',
                    'userId'=>$sell_id
                ]);
                MInbox::insert([
                    'orderId'=>$orderNo,
                    'type'=>'거래',
                    'title'=>'고객님께서 판매중이신 #'.$orderNo.' 물품이 관리자에 의해 거래취소되었습니다.',
                    'content'=>'궁금한 점이 있으시면 고겍센터로 문의해주세요',
                    'userId'=>$sell_id
                ]);
                MInbox::insert([
                    'orderId'=>$orderNo,
                    'type'=>'거래',
                    'title'=>'고객님께서 구매중이신 #'.$orderNo.' 물품이 거래취소되었습니다.',
                    'content'=>'고객님께서 구매중이신 #'.$orderNo.' 물품이 거래취소되었습니다.',
                    'userId'=>$buy_id
                ]);

                return response()->json(array('msg'=>'거래취소되었습니다.','type'=>1));
            }
        }
        if($type == 'delete'){
            if($item['status'] > 0){
                return response()->json(array('msg'=>'거래취소후 삭제해주세요.','type'=>1));
            }
            MItem::where('orderNo',$orderNo)->delete();
            if(!empty($item['payitem'])){
                MPayitem::where('id',$item['payitem']['id'])->delete();
            }

            MPremium::where('post_id',$item['id'])->delete();
            MBargainRequest::where('orderNo',$item['id'])->delete();
            MPayhistory::where('orderNo',$orderNo)->delete();
            return response()->json(array('msg'=>'거래가 삭제되었습니다.','type'=>2));
        }
    }


    private function processPay($buy_id,$sell_id,$orderNo){
        $admin_cash = $user_cash = 0;
        $payItem = MPayitem::where("orderNo", $orderNo)->first();
        $sell = User::with('roles')->where('id', $sell_id)->first();
        if($payItem['price'] >= $sell['roles']['until']){
            $admin_cash = $sell['roles']['fixed_price'];
            $user_cash = $payItem['price'] - $sell['roles']['fixed_price'];
        }
        elseif($payItem['price'] <= $sell['roles']['min_price']){
            $admin_cash = 1000;
            $user_cash = $payItem['price'] - 1000;
        }
        else{
            $admin_cash = $payItem['price'] * $sell['roles']['fee'] / 100;
            $user_cash =  $payItem['price'] - $admin_cash;
        }
        if($payItem['status'] == 0){
            MPayitem::where('id',$payItem['id'])->update([
                'status'=>1
            ]);
        }
        User::where("id", $sell_id)->update(['mileage'=> \Illuminate\Support\Facades\DB::raw('mileage+'.$user_cash),'point'=>DB::raw('point+1'),'completed_orders'=>DB::raw('completed_orders+1')]);
        User::where("id", $buy_id)->update(['point'=>DB::raw('point+1'),'completed_orders1'=>DB::raw('completed_orders1+1')]);
        MAdminCash::where("id", 1)->update(['cash'=> DB::raw('cash+'.$admin_cash)]);
        MPayhistory::insert([
            'orderNo'=>$orderNo,
            'pay_type'=>2,
            'price'=>$user_cash,
            'status'=>1,
            'userId'=>$sell_id,
        ]);
        MPayhistory::insert([
            'orderNo'=>$orderNo,
            'pay_type'=>6,
            'price'=>$payItem['price'],
            'status'=>1,
            'userId'=>$buy_id,
            'minus'=>1
        ]);
        MPayhistory::insert([
            'orderNo'=>$orderNo,
            'pay_type'=>3,
            'price'=>$admin_cash,
            'status'=>1,
            'minus'=>1
        ]);
        MInbox::insert([
            'orderId'=>$orderNo,
            'type'=>'거래',
            'title'=>'고객님께서 판매중이신 #'.$orderNo.' 물품이 판매종료되었습니다.',
            'content'=>'고객님께서 판매중이신 #'.$orderNo.' 물품이 판매종료되었습니다.',
            'userId'=>$sell_id
        ]);
        MInbox::insert([
            'orderId'=>$orderNo,
            'type'=>'거래',
            'title'=>'고객님께서 구매중이신 #'.$orderNo.' 물품이 구매종료되었습니다.',
            'content'=>'고객님께서 구매중이신 #'.$orderNo.' 물품이 구매종료되었습니다.',
            'userId'=>$buy_id
        ]);
        $this->addGift($buy_id);
        $this->addGift($sell_id);
        return 1;
    }
    private function addGift($userId){
        $user = User::with('roles')->where('id',$userId)->first();
        $role = MRole::where('point','<=',$user['point'])->orderBy('point','DESC')->first();
        if(!empty($role) && $role['id'] != $user['role']){
            User::where('id',$userId)->update(['role'=>$role['id']]);
            MInbox::insert([
                'type'=>'신용등급',
                'title'=>'신용등급 갱신',
                'content'=>'회원님의 신용등급은 '.$role['alias'].'입니다.',
                'userId'=>$userId
            ]);
            $role_gift = MRoleGift::where('role_id',$role['id'])->get();
            if(!empty($role_gift)){
                foreach ($role_gift as $value){
                    $exist_item = MGift::where('userId',$userId)->where('type',$value['type'])->first();
                    if(!empty($exist_item)){
                        MGift::where('id',$exist_item['id'])->update(['time'=>DB::raw('time+'.$value['time'])]);
                    }
                    else{
                        MGift::insert([
                            'userId'=>$userId,
                            'type'=>$value['type'],
                            'time'=>$value['time']
                        ]);
                    }
                }
                MInbox::insert([
                    'type'=>'무료이용권',
                    'title'=>'무료이용권 자동지급',
                    'content'=>'회원님에게 무료이용권이 지급되었습니다.',
                    'userId'=>$userId
                ]);
            }
        }
    }

    public function order_list_request(Request $request){
        $username = $request->usr_alias;
        $orderNo = $request->orderNo;
        $items = MAsk::with(['item','user'])
        ->whereHas('item',function($query){
            $query->where('accept_flag',1);
        })
        ->where(function($query){
            $query->where('type','cancel');
            $query->orWhere('type','complete');
        });
        if(!empty($username)) {
            $items = $items->whereHas('user',function($query) use ($username){
                $query->where('name',"LIKE","%".$username."%");
                $query->orWhere('email',"LIKE","%".$username."%");
                $query->orWhere('nickname',"LIKE","%".$username."%");
            });
        }
        if(!empty($orderNo)){
            $items = $items->where('order_no','LIKE',"%".$orderNo."%");
        }
        $items = $items
        ->orderBy('updated_at','DESC')
        ->paginate(15);
        return view('admin.order.order_list_request',[
            'items'=>$items
        ]);
    }

    public function orderRequestContent(Request $request){
          $id = $request->id;
          $item = MAsk::where('askid',$id)->first();
        return view('admin.order.requestOrder',[
            'item'=>$item
        ]);
    }

    public function processOrderRequest(Request $request){
        $content = $request->contents;
        $id = $request->id;
        $reason = $request->reason;
        $type = $request->type;
        $request_item = MAsk::where("askid",$id)->first();
        $process = $request->process;
        if(!empty($request_item['order_no'])){
            $item = MItem::with('payitem')->where('orderNo',$request_item['order_no'])->first();
            if(empty($item))
            {
                echo '<script>alert("자료가 존재하지 않습니다.");self.close();</script>';
                return;
            }
            if($item['type'] == 'sell'){
                $buy_id = $item['toId'];
                $sell_id = $item['userId'];
            }
            else{
                $sell_id = $item['toId'];
                $buy_id = $item['userId'];
            }
            if($type == 'cancel'){
                if( empty($item['toId']) || empty($item['payitem'])) {
                    echo '<script>alert("요청을 수락할수 없습니다.");self.close();</script>';
                    return;
                }
                elseif(($item['status'] == 0 || $item['payitem']['status'] == 0) && $process == 1){
                    MPremium::where('post_id',$item['id'])->delete();
                    MBargainRequest::where('orderNo',$item['id'])->delete();
                }
                else if($process == 1){
                    MPremium::where('post_id',$item['id'])->delete();
                    MBargainRequest::where('orderNo',$item['id'])->delete();
                    User::where('id',$buy_id)->update(['mileage'=> DB::raw('mileage+'.$item['payitem']['price'])]);
                    MPayhistory::insert([
                        'orderNo'=>$item['orderNo'],
                        'pay_type'=>21,
                        'price'=>$item['payitem']['price'],
                        'status'=>1,
                        'userId'=>$buy_id
                    ]);

                    MPayitem::where('id',$item['payitem']['id'])->delete();
                    MCancelReason::insert([
                        'orderNo'=>$item['orderNo'],
                        'reason'=>'관리자 거래취소',
                        'content'=>'관리자 거래취소',
                        'userId'=>$sell_id
                    ]);
                    MInbox::insert([
                        'orderId'=>$item['orderNo'],
                        'type'=>'거래',
                        'title'=>'고객님께서 판매중이신 #'.$item['orderNo'].' 물품이 관리자에 의해 거래취소되었습니다.',
                        'content'=>$reason,
                        'userId'=>$sell_id
                    ]);
                    MInbox::insert([
                        'orderId'=>$item['orderNo'],
                        'type'=>'거래',
                        'title'=>'고객님께서 구매중이신 #'.$item['orderNo'].' 물품이 거래취소되었습니다.',
                        'content'=>$reason,
                        'userId'=>$buy_id
                    ]);
                    MItem::where('orderNo',$item['orderNo'])->update(["status"=>-1,'accept_flag'=>2]);
                }
                else{
                    MItem::where('orderNo',$item['orderNo'])->update(['accept_flag'=>2]);
                }
                MAsk::where('askid',$id)->update(['response'=>$reason]);
                if($process == 1){
                    echo '<script>alert("거래취소되었습니다.");self.close();</script>';
                }
                else{
                    echo '<script>alert("성공적으로 처리되었습니다.");self.close();</script>';
                }
                return;
            }
            if($type == 'complete'){
                if(empty($item['toId']) || empty($item['payitem']) || $item['status'] == 0 || $item['payitem']['status'] == 0){
                    echo '<script>alert("요청을 수락할수 없습니다.");self.close();</script>';
                    return;
                }
                if($process == 1){
                    $r = $this->processPay($buy_id,$sell_id,$item['orderNo']);
                    if($r == 1){
                        MPayitem::where('orderNo', $item['orderNo'])->update(['status' => 2]);
                        MItem::where('orderNO', $item['orderNo'])->update(['status'=>23,'accept_flag'=>2]);
                        $r_msg = "거래가 완료되었습니다.";
                    }
                }
                else{
                    MItem::where('orderNo', $item['orderNo'])->update(['accept_flag'=>2]);
                    $r_msg = "성공적으로 처리되었습니다.";
                }
                MAsk::where('askid',$id)->update(['response'=>$reason]);
                echo "<script>alert('{{$r_msg}}');self.close();</script>";
            }
        }
        else{
            $insert_data = ["type"=>$type,"response"=>$reason];
            if(empty($id)){
                if(!empty($content))
                    $insert_data['response'] = $content;
                MAsk::insert($insert_data);
                echo '<script>alert("변경되었습니다.");self.close();</script>';
            }
            else{
                if(!empty($content))
                    $insert_data['response'] = $content;
                MAsk::where('askid',$id)->update($insert_data);
                echo '<script>alert("변경되었습니다.");self.close();</script>';
            }
        }
    }

    public function deleteOrderRequest(Request $request){
        $id = $request->id;
        $m_ask = MAsk::where('askid',$id)->first();
        if(!empty($m_ask['order_no']))
            MItem::where('orderNo',$m_ask['order_no'])->update(['accept_flag'=>0]);
        MAsk::where('askid',$id)->delete();
        return response()->json(array('msg'=>'삭제되었습니다.','status'=>1));
    }

    public function new_gaming(Request $request){
        $usr_alias = $request->usr_alias;
        $response = $request->response;
        $game_requests = MAsk::with('user')->where('type','newgame');
        if(!empty($user_alias))
            $game_requests = $game_requests->where(function($query) use ($usr_alias){
                $query->where('name',"LIKE","%".$usr_alias."%");
                $query->orWhere('email',"LIKE","%".$usr_alias."%");
                $query->orWhere('nickname',"LIKE","%".$usr_alias."%");
            });
        if($response == 1)
            $game_requests = $game_requests->where(function($query){
                $query->whereNull('response');
                $query->orWhere('response','');
            });
        if($response == 2)
            $game_requests = $game_requests->whereNotNull('response');
        $game_requests = $game_requests->paginate(15);
        return view('admin.order.new_gaming',[
            'items'=>$game_requests
        ]);
    }

    public function use_relative(Request $request){
        $usr_alias = $request->usr_alias;
        $reply = $request->reply;
        $game_requests = MAsk::with('user')
            ->where('type','!=','newgame')
            ->where('type','!=','cancel')
            ->where('type','!=','complete');

        if(!empty($usr_alias)){
            $game_requests = $game_requests->whereHas('user',function($query) use($usr_alias){
                $query->where('name',"LIKE","%".$usr_alias."%");
                $query->orWhere('email',"LIKE","%".$usr_alias."%");
                $query->orWhere('nickname',"LIKE","%".$usr_alias."%");
            });
        }
        if(!empty($reply)){
            if($reply == 1){
                $game_requests = $game_requests->where(function($query){
                    $query->whereNull('response');
                    $query->orWhere('response','');
                });
            }
            else{
                $game_requests = $game_requests->where(function($query){
                    $query->where('response','!=','');
                });
            }
        }
        $game_requests = $game_requests->paginate(15);
        return view('admin.order.use_relative',[
            'items'=>$game_requests
        ]);
    }

    public function publish_msg(Request $request){
        $notices = MNotice::orderby('created_at','DESC')->paginate(15);
        return view('admin.notices',[
            'items'=>$notices
        ]);
    }

    public function noticeOpen(Request $request){
        $notice = MNotice::where('id',$request->id)->first();
        return view('admin.notice',[
            'item'=>$notice
        ]);
    }

    public function updateNotice(Request $request){
        $id = $request->id;
        $title = $request->title;
        $content = $request->contents;
        if(empty($id)){
            MNotice::insert(['title'=>$title,'content'=>$content]);
        }
        else{
            MNotice::where('id',$id)->update(['title'=>$title,'content'=>$content]);
        }
        echo "<script>alert('변경되었습니다.');self.close();</script>";
    }

    public function deleteNotice(Request $request){
        $id = $request->id;
        MNotice::where("id",$id)->delete();
        return response()->json(array('status'=>1,'msg'=>'처리되었습니다.'));
    }

    public function shoppingmal(Request $request){
        $shops = MMall::orderby('created_at','DESC')->paginate(15);
        return view('admin.shops',[
            'items'=>$shops
        ]);
    }

    public function editShop(Request $request){
        $mall = MMall::where('id',$request->id)->first();
        return view('admin.shop_view',[
            'item'=>$mall
        ]);
    }

    public function shopping_update(Request $request){
        $param = $request->all();
        $id = $param['id'];
        $param['money'] = json_encode(explode(",",$param['money']));
        unset($param['img']);
        unset($param['_token']);
        unset($param['thumnail']);
        if(empty($id)){
            $insert_id = MMall::create($param);
            $id = $insert_id->id;
        }
        else{
            MMall::where('id',$id)->update($param);
        }
        if($id > 0){
            if ($request->hasFile('img')) {
                $filenameWithExt = $request->file('img')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('img')->getClientOriginalExtension();
                $bankbook = $filename .'.' . $extension;
                $request->file('img')->move(public_path('angel/product/'),$bankbook);
                MMall::where('id',$id)->update(['img'=>'/angel/product/'.$bankbook ]);
            }
            if ($request->hasFile('thumnail')) {
                $filenameWithExt = $request->file('thumnail')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('thumnail')->getClientOriginalExtension();
                $bankbook = $filename .'.' . $extension;
                $request->file('thumnail')->move(public_path('angel/img/mall/'),$bankbook);
                MMall::where('id',$id)->update(['thumnail'=>'/angel/img/mall/'.$bankbook ]);
            }
        }
        return redirect("/admin/editShop?id={$id}")->with('message', "변경되었습니다.");
    }

    public function shoppingmal_list(Request $request){
        $serial_number = $request->serial_number;
        $pin = $request->pin;
        $usr_alias = $request->usr_alias;
        $buy_lists = MMallBuy::with(['user','mall']);
        if(!empty($usr_alias)){
            $buy_lists = $buy_lists->whereHas('user',function($query) use($usr_alias){
                $query->where('name',"LIKE","%".$usr_alias."%");
                $query->orWhere('email',"LIKE","%".$usr_alias."%");
                $query->orWhere('nickname',"LIKE","%".$usr_alias."%");
            });
        }
        if(empty($serial_number) || $serial_number == 1){
            $buy_lists = $buy_lists->whereNull('serial_number')->orWhere('serial_number',"");
        }
        else if($serial_number == 2){
            $buy_lists = $buy_lists->where('serial_number','<>',"");
        }
        if(!empty($pin))
            $buy_lists = $buy_lists->where('serial_number','LIKE',"%".$pin."%");

        $buy_lists = $buy_lists->orderBy('created_at','DESC')->paginate(15);
        return view('admin.shoppingmal_list',[
            'items'=>$buy_lists
        ]);
    }

    public function insertPin(Request $request){
        $value = $request->value;
        $id = $request->id;
        MMallBuy::where('id',$id)->update(['serial_number'=>$value]);
        return response()->json(array("status"=>1));
    }

    public function game_management(Request $request){
        $depth = $request->depth;
        $name = $request->name;

        if(empty($depth)){
            $games = MGame::where('depth',0);
        }
        else{
            $games = MGame::where('depth',$depth);
        }
        if(!empty($name)){
            $games = $games->where('game','LIKE','%'.$name.'%');
        }


        $games = $games->orderby('depth','ASC')->orderby('order','ASC')->paginate(15);
        return view('admin.game_management',[
            'games'=>$games
        ]);
    }

    public function notice_list(Request $request){
        $usr_alias = $request->usr_alias;
        $isReaded = $request->isReaded;
        $orderNo = $request->orderNo;
        $type = $request->type;
        $notice_list = MAdminNotice::with('user');
        if(!empty($usr_alias))
            $notice_list =$notice_list->whereHas('user',function($query) use ($usr_alias){
                $query->where('name',"LIKE","%".$usr_alias."%");
                $query->orWhere('email',"LIKE","%".$usr_alias."%");
                $query->orWhere('nickname',"LIKE","%".$usr_alias."%");
            });
        if(empty($isReaded) || $isReaded == 1)
            $notice_list = $notice_list->where('isReaded',0);
        else if($isReaded == 2)
            $notice_list = $notice_list->where('isReaded',1);
        else
            $notice_list = $notice_list->where('id','>',0);
        if(!empty($type)){
            if($type == 'mileage'){
                $notice_list = $notice_list->where(function($query){
                    $query->where('type',1);
                    $query->orWhere('type',2);
                });
            }
            if($type == 'order'){
                $notice_list = $notice_list->where(function($query){
                    $query->where('type',3);
                    $query->orWhere('type',4);
                    $query->orWhere('type',5);
                    $query->orWhere('type',6);
                });
            }
            if($type == 'mileage'){
                $notice_list = $notice_list->where(function($query){
                    $query->where('type',1);
                    $query->orWhere('type',2);
                });
            }
            if($type == 'new'){
                $notice_list = $notice_list->where('type',7);
            }
            if($type == 'using'){
                $notice_list = $notice_list->where('type',8);
            }

        }

        if(!empty($orderNo))
            $notice_list = $notice_list->where('orderNo','LIKE','%'.$orderNo.'%');
        $notice_list = $notice_list->orderBy('created_at','DESC')->paginate(15);
        return view('admin.notice_list',[
            'items'=>$notice_list
        ]);
    }

    public function checkNotice(Request $request){
        $id = $request->id;
        $notice = MAdminNotice::where('id',$id)->first();
        if(empty($notice))
            return response()->json(array("status"=>0));
        else{
            if($notice['isReaded'] == 0)
            {
                MAdminNotice::where('id',$id)->update(['isReaded'=>1]);
                return response()->json(array("status"=>1,'dec'=>1));
            }
            else
                return response()->json(array("status"=>1,'dec'=>0));
        }
    }

    public function deleteNoticeAdmin(Request $request){
        $id = $request->id;
        $notice = MAdminNotice::where('id',$id)->first();
        $dec = 0;
        if(empty($notice)){
            return response()->json(array("status"=>0));
        }
        else{
            if($notice['isReaded'] == 0){
                $dec = 1;
            }
            MAdminNotice::where('id',$id)->delete();
            return response()->json(array("status"=>1,'dec'=>$dec));
        }
    }

    public function stopShops(Request $request){
        $id = $request->id;
        $use = $request->use;
        MMall::where('id',$id)->update(['status'=>$use]);
        return response()->json(array("status"=>1));
    }

    public function msg_content(Request $request){

        $uids = $request->uids;
        $users = array();
        if(!empty($uids)){
            $users = User::whereIn('id',explode(',', $uids))->get();
        }
        return view('admin.msg_content',[
            'users'=>$users
        ]);
    }

    public function sendMsg(Request $request){
        $uids = empty($request->uids) ? array() : explode(',', $request->uids);
        $reason = $request->reason;
        $title = $request->title;
        foreach($uids as $u){
            MInbox::insert([
                'userId'=>$u,
                'content'=>$reason,
                'type'=>'관리자',
                'title'=>$title
            ]);
        }
        echo "<script>alert('처리되었습니다');self.close();</script>";
    }

    public function gamemake(Request $request){
        $id = $request->id;
        $game = null;
        if(!empty($id)){
            $game = MGame::where('id',$id)->first();
        }
        $games = MGame::where('depth', 0)->orderby('order','ASC')->get();
        return view('admin.gamemake',[
            'games' => $games,
            'game_row' => $game
        ]);
    }

    public function UpdateMGame(Request $request){
        $params = $request->all();
        $id = $params['id'];
        unset($params['_token']);
        unset($params['id']);
        $parent = $params['parent'] ?? 0;
        if($params['depth'] == 2){
            if($params['unit'] == 'character')
            {
                $params['alias'] = $params['game'];
                $params['purchase_enable'] = 1;
            }
            $params['discount'] = $params['discount'] ?? 0;
            $params['range'] = $params['range'] ?? 0;
            $params['options'] = $params['options'] ?? 0;
            $params['gamemoney_unit'] = $params['gamemoney_unit'] ?? 0;
        }

        if(!empty($id)){
            MGame::where('id',$id)->update($params);
        }
        else{
            $insert = MGame::create($params);
            if($insert->id > 0) $id = $insert->id;
        }
        if($id > 0){
            if($request->hasFile('icon')){
                $filenameWithExt = $request->file('icon')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('icon')->getClientOriginalExtension();
                $bankbook = $filename .'.' . $extension;
                $request->file('icon')->move(public_path('angel/mgame/'),$bankbook);
                MGame::where('id',$id)->update(['icon'=>'/angel/mgame/'.$bankbook ]);
            }
        }
        return redirect('/admin/gamemake?id='.$id);
    }
}

