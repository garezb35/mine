<?php

namespace App\Http\Controllers;

use App\Models\MAdminCash;
use App\Models\MBargainRequest;
use App\Models\MCancelReason;
use App\Models\MCashReceipt;
use App\Models\MCharacterDocument;
use App\Models\MChgame;
use App\Models\MGame;
use App\Models\MGift;
use App\Models\MInbox;
use App\Models\MItem;
use App\Models\MOrderNotification;
use App\Models\MPremium;
use App\Models\MRole;
use App\Models\MRoleGift;
use App\Models\User;
use App\Models\MPayhistory;
use App\Models\MPayitem;
use App\Models\MMygame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use function Livewire\str;

class ManiaController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/index');
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
        User::where("id", $sell_id)->update(['mileage'=> DB::raw('mileage+'.$user_cash),'point'=>DB::raw('point+1'),'completed_orders'=>DB::raw('completed_orders+1')]);
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

    public function applicationiBa(Request $request){
        $params = $request->all();
        $exist_check = MBargainRequest::where('userId',$this->user->id)->where('orderNo',$params['id'])->first();
        if(!empty($exist_check)){
            echo '<script>alert("흥정신청할수 없습니다.");window.history.back();</script>';
            return;
        }
        MBargainRequest::insert([
            'userId'=>$this->user->id,
            'orderNo'=>$params['id'],
            'price'=> str_replace(",","",$params['ba_money']),
            'character'=>$params['user_character']
        ]);
//        MPayitem::insert([
//            'userId'=>$this->user->id,
//            'orderNo'=>$params['id'],
//            'status'=>100,
//            'price_limit'=>str_replace(",","",$params['ba_money']),
//            'home'=>$params['user_contactA'].'-'.$params['user_contactB'].'-'.$params['user_contactC'],
//            'mobile'=>$params['user_mobileA'].'-'.$params['user_mobileB'].'-'.$params['user_mobileC']
//        ]);
        return Redirect::to('/myroom/buy/buy_check_view?id='.$params['id']);
    }

    public function addservice(Request $request){

        $gift_array  = array();
        $gift_array[1] = $gift_array[2] = $gift_array[3] = 0;
        $params = $request->all();
        $params = json_decode(json_encode($params));
        $user_premium_time   = $params->user_premium_time;
        $user_icon_use   = empty($params->user_icon_use) ? 0 : $params->user_icon_use;
        $user_bluepen_use   = empty($params->user_bluepen_use) ? 0 : $params->user_bluepen_use;
        $user_quickicon_use   = empty($params->user_quickicon_use) ? 0 : $params->user_quickicon_use;
        $rereg_count = empty($params->rereg_count) ? 0 : $params->rereg_count;
        $rereg_time = $params->rereg_time;
        $charge_money=  ($user_premium_time + $user_quickicon_use + ($user_bluepen_use + $user_icon_use) / 12 + $rereg_count / 3) * 100;
        if($charge_money > 0 && $this->user->mileage < $charge_money){
            return response()->json(array("status"=>0,'msg'=>'마일리지가 충분치 않습니다.'));
        }
        $gift = MGift::where('userId',$this->user->id)->get();
        foreach($gift as $value){
            $gift_array[$value['type']] = $value['time'];
        }
        unset($params->user_premium_time);
        unset($params->user_icon_use);
        unset($params->user_bluepen_use);
        unset($params->user_quickicon_use);
        unset($params->rereg_count);
        unset($params->rereg_time);
        $params->orderNo = date("Ymd").generateRandomString(8);
        $param_insert = get_object_vars($params);
        $param_insert["user_price"] = str_replace(",","",$param_insert["user_price"] ?? 0);
        $param_insert["user_division_price"] = str_replace(",","",$param_insert["user_division_price"] ?? 0);
        $param_insert['user_quantity'] = !empty($param_insert['user_quantity'])  ? str_replace(",","", $param_insert['user_quantity']):1;
        $param_insert['user_quantity_max'] = str_replace(",","",$param_insert['user_quantity_max'] ?? 0);
        $param_insert['user_quantity_min'] = str_replace(",","",$param_insert['user_quantity_min'] ?? 0);
        $param_insert['user_division_unit'] = str_replace(",","",$param_insert['user_division_unit'] ?? 0);
        unset($param_insert['iteminfo_use_complete']);
        unset($param_insert['fixed_trade_subject']);
        unset($param_insert['game_code_text']);
        unset($param_insert['server_code_text']);
        unset($param_insert['security_service_userinfo']);
        unset($param_insert['security_type']);
        unset($param_insert['user_premium_use']);
        unset($param_insert['user_quick_icon_use']);
        unset($param_insert['user_charge']);
        unset($param_insert['certify_pay']);
        unset($param_insert['seller_birth']);
        unset($param_insert['safety_using_flag']);
        unset($param_insert['user_cell_auth']);
        unset($param_insert['user_cell_num']);
        unset($param_insert['user_safety_type']);
        unset($param_insert['user_phone_check']);
        unset($param_insert['user_without']);
        unset($param_insert['text_select']);
        unset($param_insert['user_id']);
        unset($param_insert['user_contactA']);
        unset($param_insert['user_contactB']);
        unset($param_insert['user_contactC']);
        unset($param_insert['slctMobile_type']);
        unset($param_insert['user_mobileA']);
        unset($param_insert['user_mobileB']);
        unset($param_insert['user_mobileC']);
        unset($param_insert['user_screen']);
        if ($request->hasFile('user_screen')) {
            $param_insert['screenshots'] =  'Y';
        }
        $param_insert['type'] = !empty($request->type) ? $request->type: 'sell';
        $param_insert['userId'] =  $this->user->id;
        if(!empty($param_insert['user_price_limit']))
            $param_insert['user_price_limit'] = str_replace(",","",$param_insert["user_price_limit"] ?? 0);

        $insertId = MItem::create($param_insert);

        if(!empty($insertId->id)){
            if($param_insert['user_goods'] == 'character' && $param_insert['type'] == 'sell'){
                MCharacterDocument::insert([
                    'orderNo'=>$param_insert['orderNo'],
                    'price'=>$param_insert["user_price"],
                    'seller_name'=>$this->user->name,
                    'seller_birthday'=>$this->user->birthday,
                    'character_id'=>!empty($param_insert['character_id']) ? $param_insert['character_id'] : '',
                    'seller_cell'=>$this->user->number,
                ]);
            }
            $premium_array = array();
            $premium_inserts = array();
            $premium_array['post_id'] = $insertId->id;
            if(!empty($user_premium_time)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 1;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_premium_time.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[1] = ($gift_array[1] - $user_premium_time) > 0 ? $gift_array[1] - $user_premium_time: 0;
            }
            if(!empty($user_icon_use)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 2;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_icon_use.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[2] = ($gift_array[2] - $user_icon_use) > 0 ? $gift_array[2] - $user_icon_use: 0;
            }
            if(!empty($user_bluepen_use)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 3;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_bluepen_use.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[2] = ($gift_array[2] - $user_bluepen_use) > 0 ? $gift_array[2] - $user_bluepen_use: 0;
            }
            if(!empty($user_quickicon_use)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 4;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_quickicon_use.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[3] = ($gift_array[3] - $user_quickicon_use) > 0 ? $gift_array[3] - $user_quickicon_use: 0;
            }
            if(!empty($rereg_count) && !empty($rereg_time)){
                $premium_array['type'] = 5;
                $premium_array['re_count'] = $rereg_count;
                $premium_array['re_minutes'] = $rereg_time;
                array_push($premium_inserts,$premium_array);
            }
            if(!empty($premium_inserts) && $charge_money > 0){
                $this->user->mileage = $this->user->mileage - $charge_money;
                $this->user->save();
                MPremium::insert($premium_inserts);

                MPayhistory::insert([
                    'type'=>'premium',
                    'userId'=>$this->user->id,
                    'mania_code'=>$insertId->id,
                    'price'=>$charge_money,
                    'status'=>1,
                    'minus'=>1,
                    'orderNo'=>$param_insert['orderNo']]);

            }

            if ($request->hasFile('user_screen')) {
                foreach($request->file('user_screen') as $file){
                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $bankbook = $filename .'_'.time().'.' . $extension;
                    $file->move(public_path('assets/images/angel/'.$insertId->id),$bankbook);
                }
            }
            if(!empty($gift)){
                MGift::where('type',1)->where('userId',$this->user->id)->update(['time'=>$gift_array[1]]);
                MGift::where('type',2)->where('userId',$this->user->id)->update(['time'=>$gift_array[2]]);
                MGift::where('type',3)->where('userId',$this->user->id)->update(['time'=>$gift_array[3]]);
            }
            return Redirect::to('/'.$param_insert['type'].'/index_view?id='.$params->orderNo);
        }
        else{

        }
    }


    public function sell_re_reg_ok(Request $request){
        $gift_array  = array();
        $gift_array[1] = $gift_array[2] = $gift_array[3] = 0;
        $gift = MGift::where('userId',$this->user->id)->get();
        foreach($gift as $value){
            $gift_array[$value['type']] = $value['time'];
        }
        $user_goods_type = $request->user_goods_type;
        $id = $request->id;
        $mit = MItem::where('orderNo',$id)->first();
        if(empty($mit)){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        $user_premium_time   = $request->user_premium_time;
        $user_icon_use   = empty($request->user_icon_use) ? 0 : $request->user_icon_use;
        $user_bluepen_use   = empty($request->user_bluepen_use) ? 0 : $request->user_bluepen_use;
        $user_quickicon_use   = empty($request->user_quickicon_use) ? 0 : $request->user_quickicon_use;
        $rereg_count = empty($request->rereg_count) ? 0 : $request->rereg_count;
        $rereg_time = $request->rereg_time;
        $charge_money=  ($user_premium_time + $user_quickicon_use + ($user_bluepen_use + $user_icon_use) / 12 + $rereg_count / 3) * 100;
        if($charge_money > 0 && $this->user->mileage < $charge_money){
            echo '<script>alert("마일리지가 충분치 않습니다.");window.history.back();</script>';
            return;
        }
        $update = array();
        if(!empty($request->user_quantity)){
            $update['user_quantity'] = str_replace(",","",$request->user_quantity);
        }
        if(!empty($request->gamemoney_unit)){
            $update['gamemoney_unit'] = $request->gamemoney_unit;
        }
        if($user_goods_type == 'general'){
            $update['user_price'] = str_replace(",","",$request->user_price);
            $update['user_character'] = $request->user_character;
            $update['user_title'] = $request->user_title;
            $update['user_text'] = $request->user_text;
        }
        if($user_goods_type == 'division'){
            $update['user_quantity_min'] = str_replace(",","",$request->user_quantity_min);
            $update['user_quantity_max'] = str_replace(",","",$request->user_quantity_max);
            $update['user_division_unit'] = str_replace(",","",$request->user_division_unit);
            $update['user_division_price'] = str_replace(",","",$request->user_division_price);
            if(!empty($request->discount_quantity)){
                $update['discount_quantity'] = str_replace(",","",$request->discount_quantity);
            }
            if(!empty($request->discount_quantity_cnt)){
                $update['discount_quantity_cnt'] = str_replace(",","",$request->discount_quantity_cnt);
            }
            if(!empty($request->discount_price)){
                $update['discount_price'] = str_replace(",","",$request->discount_price);
            }
            $update['user_character'] = $request->user_character;
            $update['user_title'] = $request->user_title;
            $update['user_text'] = $request->user_text;
        }
        if($user_goods_type == 'bargain'){
            $update['user_price'] = str_replace(",","",$request->user_price);
            if(!empty($request->user_deny_use)){
                $update['user_price_limit'] = str_replace(",","",$request->user_price_limit);
            }
            $update['user_character'] = $request->user_character;
            $update['user_title'] = $request->user_title;
            $update['user_text'] = $request->user_text;
        }
        if(!empty($update)){
            $update['created_at'] = date('Y-m-d H:i:s');
            MItem::where("orderNo",$id)->update($update);
            $premium_array = array();
            $premium_inserts = array();
            if(!empty($user_premium_time)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 1;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_premium_time.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[1] = ($gift_array[1] - $user_premium_time) > 0 ? $gift_array[1] - $user_premium_time: 0;
            }
            if(!empty($user_icon_use)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 2;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_icon_use.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[2] = ($gift_array[2] - $user_icon_use) > 0 ? $gift_array[2] - $user_icon_use: 0;
            }
            if(!empty($user_bluepen_use)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 3;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_bluepen_use.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[2] = ($gift_array[2] - $user_bluepen_use) > 0 ? $gift_array[2] - $user_bluepen_use: 0;
            }
            if(!empty($user_quickicon_use)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 4;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_quickicon_use.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[3] = ($gift_array[3] - $user_quickicon_use) > 0 ? $gift_array[3] - $user_quickicon_use: 0;
            }
            if(!empty($rereg_count) && !empty($rereg_time)){
                $premium_array['type'] = 5;
                $premium_array['re_count'] = $rereg_count;
                $premium_array['re_minutes'] = $rereg_time;
                array_push($premium_inserts,$premium_array);
            }
            if(!empty($premium_inserts) && $charge_money > 0 && sizeof($premium_inserts) > 0){
                $this->user->mileage = $this->user->mileage - $charge_money;
                $this->user->save();
                foreach ($premium_inserts as $v){
                    MPremium::where('post_id',$mit['id'])->update($v);
                }
            }
            return redirect('/sell/index_view?id='.$id);
        }
        else{
            echo '<script>alert("잘못된 접근입니다.");window.history.go(-1);</script>';
            return;
        }
    }

    public function buy_re_reg_ok(Request $request){
        $gift_array  = array();
        $gift_array[1] = $gift_array[2] = $gift_array[3] = 0;
        $gift = MGift::where('userId',$this->user->id)->get();
        foreach($gift as $value){
            $gift_array[$value['type']] = $value['time'];
        }
        $user_goods_type = $request->user_goods_type;
        $id = $request->id;
        $mit = MItem::where('orderNo',$id)->first();
        if(empty($mit)){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        $user_premium_time   = $request->user_premium_time;
        $user_icon_use   = empty($request->user_icon_use) ? 0 : $request->user_icon_use;
        $user_bluepen_use   = empty($request->user_bluepen_use) ? 0 : $request->user_bluepen_use;
        $user_quickicon_use   = empty($request->user_quickicon_use) ? 0 : $request->user_quickicon_use;
        $rereg_count = empty($request->rereg_count) ? 0 : $request->rereg_count;
        $rereg_time = $request->rereg_time;
        $charge_money=  ($user_premium_time + $user_quickicon_use + ($user_bluepen_use + $user_icon_use) / 12 + $rereg_count / 3) * 100;
        if($charge_money > 0 && $this->user->mileage < $charge_money){
            echo '<script>alert("마일리지가 충분치 않습니다.");window.history.back();</script>';
            return;
        }
        $update = array();
        if(!empty($request->user_quantity)){
            $update['user_quantity'] = str_replace(",","",$request->user_quantity);
        }
        if(!empty($request->gamemoney_unit)){
            $update['gamemoney_unit'] = $request->gamemoney_unit;
        }
        if($user_goods_type == 'general'){
            $update['user_price'] = str_replace(",","",$request->user_price);
            $update['user_character'] = $request->user_character;
            if(!empty($request->direct_reg_trade)){
                $update['direct_condition_credit'] = $request->direct_condition_credit;
                $update['direct_condition_hpp'] = $request->direct_condition_hpp;
                $update['direct_condition_acc'] = $request->direct_condition_acc;
                $update['user_title'] = $request->user_title;
                $update['user_text'] = $request->user_text;
            }
        }
        if($user_goods_type == 'division'){
            $update['user_quantity_min'] = str_replace(",","",$request->user_quantity_min);
            $update['user_quantity_max'] = str_replace(",","",$request->user_quantity_max);
            $update['user_division_unit'] = str_replace(",","",$request->user_division_unit);
            $update['user_division_price'] = str_replace(",","",$request->user_division_price);
            $update['user_character'] = $request->user_character;
            $update['user_title'] = $request->user_title;
            $update['user_text'] = $request->user_text;
        }
        if($user_goods_type = 'bargain'){
            $update['user_price'] = str_replace(",","",$request->user_price);
            if(!empty($request->user_deny_use)){
                $update['user_price_limit'] = str_replace(",","",$request->user_price_limit);
            }
            $update['user_character'] = $request->user_character;
            $update['user_title'] = $request->user_title;
            $update['user_text'] = $request->user_text;
        }

        if(!empty($update)){
            $update['created_at'] = date('Y-m-d H:i:s');
            MItem::where("orderNo",$id)->update($update);
            $premium_array = array();
            $premium_inserts = array();
            if(!empty($user_premium_time)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 1;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_premium_time.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[1] = ($gift_array[1] - $user_premium_time) > 0 ? $gift_array[1] - $user_premium_time: 0;
            }
            if(!empty($user_icon_use)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 2;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_icon_use.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[2] = ($gift_array[2] - $user_icon_use) > 0 ? $gift_array[2] - $user_icon_use: 0;
            }
            if(!empty($user_bluepen_use)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 3;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_bluepen_use.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[2] = ($gift_array[2] - $user_bluepen_use) > 0 ? $gift_array[2] - $user_bluepen_use: 0;
            }
            if(!empty($user_quickicon_use)){
                $premium_array['re_count'] = null;
                $premium_array['re_minutes'] = 5;
                $premium_array['type'] = 4;
                $premium_array['until'] = date("Y-m-d H:i:s", strtotime('+'.$user_quickicon_use.' hours'));
                array_push($premium_inserts,$premium_array);
                $gift_array[3] = ($gift_array[3] - $user_quickicon_use) > 0 ? $gift_array[3] - $user_quickicon_use: 0;
            }
            if(!empty($rereg_count) && !empty($rereg_time)){
                $premium_array['type'] = 5;
                $premium_array['re_count'] = $rereg_count;
                $premium_array['re_minutes'] = $rereg_time;
                array_push($premium_inserts,$premium_array);
            }
            if(!empty($premium_inserts) && $charge_money > 0 && sizeof($premium_inserts) > 0){
                $this->user->mileage = $this->user->mileage - $charge_money;
                $this->user->save();
                foreach ($premium_inserts as $v){
                    MPremium::where('post_id',$mit['id'])->update($v);
                }
            }
            return redirect('/buy/index_view?id='.$id);
        }
        else{
            echo '<script>alert("잘못된 접근입니다.");window.history.go(-1);</script>';
            return;
        }
    }

    public function getChrGames(Request $request){
        $games = MChgame::get()->toArray();

        foreach($games as $key=>$item){
            $games[$key]['twegames'] = MGame::where('parent',$item['game_id'])->where('depth',1)->orderBy('order',"ASC")->limit(12)->get()->toArray();
        }
    }

    public function getDetailsGame(Request $request){
        $orderNo = $request->id;
        $details  = MItem::with('user.contact')->where('orderNo',$orderNo)->first();
        if(empty($orderNo) || empty($details)){
            echo '<script>alert("정상적인 경로로 이용하세요.");window.history.go(-1);</script>';
            return;
        }
    }

    public function gameList(){
        $gamelist = $serverlist = array();
        $data = MGame::
        with('firstOfproperty')->
        where("depth",0)->
        where("status",1)->
        get()->toArray();
        foreach($data as $item){
            $temp = array();
            $temp["C"] = $item["id"];
            $temp["N"] = $item["game"];
            $temp["BG"] = 0;
            $temp["L"] = 99;
            $temp["U"] = $item["first_ofproperty"]["game"];
            $temp["S"] = $item["tag"] == null ? '' : $item["tag"];
            $temp["CV"] = $item['character_enabled'] == 1 ? 'y' : '';
            array_push($gamelist,$temp);
        }
        $data = MGame::
        with('threeOfproperty.firstOfproperty')->
        where("depth",1)->
        where("status",1)->
        orderBy("order","ASC")->
        get()->
        toArray();
        foreach($data as $item){
            $temp = array();
            $temp["GC"] = $item["parent"];
            $temp["C"] = $item["id"];
            $temp["N"] = $item["game"];
            $temp["BG"] = $item["order"];
            $temp["M"] = '';
            $temp["U"] = $item["three_ofproperty"]["first_ofproperty"]["alias"];
            array_push($serverlist,$temp);
        }
        return response()->json(array("gamelist"=>$gamelist,"serverlist"=>$serverlist));
    }

    public function checkSafety(Request $request){
        echo false;
    }

    public function getFreeUse(Request $request){
        return response()->json(array('premium'=>0,'quickicon'=>0,'highlight'=>0));
    }

    public function getMySearch(Request $request){
        $content = "";
        $userId = $this->user->id;
        $mygame = MMygame::where('userId',$userId)->orderBy('order','ASC')->get();

        if(!empty($mygame)){
            foreach ($mygame as $v){
                $content .='<item id="'.$v['id'].'" type="'.$v['type'].'">
                                <game id="'.$v['game'].'"><![CDATA['.$v['game_text'].']]></game>
                                <server id="'.$v['server'].'"><![CDATA['.$v['server_text'].']]></server>
                                <goods id="'.$v['goods'].'"><![CDATA['.$v['goods_text'].']]></goods>
                                <goods_type id="'.get($v['goods'])['alias'].'"><![CDATA['.get($v['goods'])['alias'].']]></goods_type>
                            </item>';
            }
        }

        echo '<mysearch result="item_filtered">'.$content.'</mysearch>';
    }

    public function favoritedgames(Request $request){
        $content = "";
        $userId = $this->user->id;
        $mygame = MMygame::where('userId',$userId)->orderBy('order','ASC')->get();
        $result = "success";
        $list = array();
        if(!empty($mygame)){
            foreach($mygame as $v){
                array_push($list,array(
                      "id"=> $v['id'],
                      "type"=> $v['type'],
                      "gameCode"=> $v['game'],
                      "gameName"=> $v['game_text'],
                      "serverCode"=> $v['server'],
                      "serverName"=>  $v['server_text'],
                      "goodsCode"=> itemAlias($v['goods_text']),
                      "goodsName"=> $v['goods_text']
                ));
            }
        }

        return response()->json(array('result'=> $result, "list"=>$list));
    }

    public function getPowerCheck(Request $request){
        echo 0;
    }

    public function getSellIndexTemplate(Request $request){
        $result =  "";
        $game_code = $request->game_code;
        $last_alias = $request->last_alias;
        $user_goods_type = $request->user_goods_type;
        $game = MGame::where("parent",$game_code)->where('depth',2)->where("game",$last_alias)->first();
        if(!empty($game)){
            $result = '';
            if($game->parent == 265 && $game->unit == 'item'){
                $result .= '<tr id="item_detail_srh_service">
    <th>
        아이템정보<br>
        <label><input type="checkbox" class="angel_game_sel" name="iteminfo_use" id="iteminfo_use" value="Y" checked="">서비스이용</label>
    </th>
    <td>
        <input type="hidden" name="iteminfo_use_complete" id="iteminfo_use_complete" value="N">
        <div class="item_detail_srh" id="item_detail_srh">
            <div id="item_detail_wrap"><p>1. 기본정보</p>
                <ul class="item_detail_search" id="item_detail_search">
                    <li>
                        <label for="category">분류</label>
                        <select name="category" id="category">
                            <option value="">불러오는중...</option>
                        </select>
                    </li>
                    <li>
                        <label for="kind">종류</label>
                        <select name="kind" id="kind" disabled>
                            <option value="">선택하세요</option>
                        </select>
                    </li>
                    <li>
                        <label for="item_name">아이템명</label>
                        <select name="item_name" id="item_name" disabled>
                            <option value="">선택하세요</option>
                        </select>
                    </li>
                    <li>
                        <label for="enchant">인챈트 상태</label>
                        <select name="enchant" id="enchant" disabled="">
                            <option value="">선택하세요</option>
                        </select>
                    </li>
                </ul>
            </div>
            <div id="add_detail_wrap" class=""><p>2. 추가정보</p>
                <ul id="add_detail_search">
                    <li>
                        <label for="state">상태</label>
                        <select name="state" id="state" disabled="">
                            <option value="">일반</option>
                            <option value="축복">축복</option>
                            <option value="저주">저주</option>
                        </select>
                    </li>
                    <li>
                        <label for="attribute">속성</label>
                        <select name="attribute" id="attribute" disabled="">
                            <option value="">일반</option>
                            <option value="지령">지령</option>
                            <option value="수령">수령</option>
                            <option value="화령">화령</option>
                            <option value="풍령">풍령</option>
                        </select>
                    </li>
                    <li>
                        (<label for="attr_enchant">속성 인챈트</label><select name="attr_enchant" id="attr_enchant" disabled="">
                            <option value="">선택하세요</option>
                        </select>)
                    </li>
                </ul>
            </div>
            <div class="prc_area">
                <div id="item_suc"><a href="javascript:;" class="btn_blue4" id="suc_btn">정보입력 완료</a>
                    <span class="f_org1">* 아이템정보 서비스를 이용 하시면 판매에 도움이 됩니다.</span></div>
                <div id="item_can" class="item__ajax_item_all.phpcan over__hidden"> 아이템정보 :
                    <strong class="text-rock" id="item_info_txt"></strong><a href="javascript:;" class="btn_gray1" id="can_btn">취소</a>
                </div>
            </div>
        </div>
        <div class="item_guide_txt over__hidden" id="item_guide_txt">* 아이템정보 서비스를 이용 하시면 판매에 도움이 됩니다.</div>
    </td>
</tr>';
            }
            if($user_goods_type == 'general'){
                if($game->gamemoney_unit ==1){
                    $result .=   '<tr>
                                    <th>판매수량</th>
                                    <td>
                                                        <div class="unit_type" id="unit_type">
                                                                        <label><input type="radio" name="gamemoney_unit" class="g_radio" value="1" checked>없음</label>
                                                    <label><input type="radio" name="gamemoney_unit" class="g_radio" value="만">만</label>
                                                    <label><input type="radio" name="gamemoney_unit" class="g_radio" value="억">억</label>
                                                                        <label class="f_blue1 f_small">(단위)</label>
                                            </div>
                                                                <div id="game_money">
                                                    <input type="text" name="user_quantity" id="user_quantity" maxlength="7" class="angel__text text_right rad13">
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
                            <th>판매금액</th>
                            <td>
                                <input type="text" name="user_price" id="user_price" maxlength="10" class="angel__text text_right rad13"> 원 (3,000원 이상, 10원 단위 등록 가능)
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
            <input type="text" class="angel__text mode-active" name="character_id" id="character_id" placeholder="게임 ID" size="30">
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
                                    <input type="text" class="angel__text mode-active rad13" name="user_character" maxlength="30" id="user_character"> 물품을 전달 하실 본인의 캐릭터명
                                    <span id="sub_text" class="text-rock"></span>
                                </div>
                                <p class="character_noti">* 본인이 사용하는 서버/캐릭터명 미 선택 및 미 기재 시 문제가 발생될 수 있으며, 거래신청자에게 책임이 있습니다.</p>
                            </td>
                        </tr>';
            }

            if($user_goods_type == 'division'){
                if($game->gamemoney_unit == 1){
                    $result .= '<tr>
                                        <th>판매수량</th>
                                        <td>
                                                            <div class="unit_type" id="unit_type">
                                                                            <label><input type="radio" name="gamemoney_unit" class="g_radio" value="1" checked>없음</label>
                                                        <label><input type="radio" name="gamemoney_unit" class="g_radio" value="만">만</label>
                                                        <label><input type="radio" name="gamemoney_unit" class="g_radio" value="억">억</label>
                                                                            <label class="f_blue1 f_small">(단위)</label>
                                                </div>
                                                                <div id="game_money">
                                                    최소
                                                    <input type="text" name="user_quantity_min" id="user_quantity_min" maxlength="7" class="angel__text text_right rad13">
                                                    <span class="unit"></span> '.$game->alias.' ~
                                                    최대
                                                    <input type="text" name="user_quantity_max" id="user_quantity_max" maxlength="7" class="angel__text text_right rad13">
                                                    <span class="unit"></span> '.$game->alias.'                </div>
                                                        </td>
                                    </tr>';
                }

                else{
                    $result .= '<tr>
        <th>판매수량</th>
        <td>
                            <div id="game_money">
                    최소
                    <input type="text" name="user_quantity_min" id="user_quantity_min" maxlength="7" class="angel__text text_right rad13">
                    <span class="unit"></span> 개 ~
                    최대
                    <input type="text" name="user_quantity_max" id="user_quantity_max" maxlength="7" class="angel__text text_right rad13">
                    <span class="unit"></span> 개                </div>
                        </td>
    </tr>';
                }

                if($game->discount == 1){
                    $result .= '<tr>
        <th>판매금액</th>
        <td>
                        <input type="text" name="user_division_unit" id="user_division_unit" maxlength="7" class="angel__text text_right rad13" size="18">
            <span class="unit"></span> '.$game->alias.' 당
            <input type="text" name="user_division_price" id="user_division_price" maxlength="10" class="angel__text text_right rad13" size="18"> 원에 판매합니다.
            <span class="f_small f_black1">(100원 이상, 10원 단위 등록 가능)</span>
            <div class="discount">
                <label><input type="checkbox" class="angel_game_sel" name="discount_use" id="discount_use" value="1" onclick="ComplexDiscount();">복수구매 할인적용</label>
                <div id="reven_discount">
                    <input type="text" class="angel__text" name="discount_quantity" id="discount_quantity" maxlength="10" disabled readonly onfocus="$(this).blur();"><span class="unit"></span> x
                    <input type="text" class="angel__text discount_quantity_cnt" name="discount_quantity_cnt" id="discount_quantity_cnt" maxlength="10" disabled>번 구매시
                    <input type="text" class="angel__text discount_price" name="discount_price" id="discount_price" maxlength="10" disabled>원 할인
                </div>
            </div>
        </td>
        </tr>
    <tr>
        <th>캐릭터명</th>
        <td>
            <div class="dfServer" id="dfServer">
                            </div>
            <div class="g_left">
                <input type="text" class="angel__text mode-active rad13" name="user_character" maxlength="30" id="user_character"> 물품을 전달 하실 본인의 캐릭터명
                <span id="sub_text" class="text-rock"></span>
            </div>
            <p class="character_noti">* 본인이 사용하는 서버/캐릭터명 미 선택 및 미 기재 시 문제가 발생될 수 있으며, 거래신청자에게 책임이 있습니다.</p>
        </td>
    </tr>';
                }
                else{
                    $result .= '<tr>
        <th>판매금액</th>
        <td>
                        <input type="text" name="user_division_unit" id="user_division_unit" maxlength="7" class="angel__text text_right rad13" size="18">
            <span class="unit"></span> '.$game->alias.' 당
            <input type="text" name="user_division_price" id="user_division_price" maxlength="10" class="angel__text text_right rad13" size="18"> 원에 판매합니다.
            <span class="f_small f_black1">(100원 이상, 10원 단위 등록 가능)</span>
        </td>
        </tr>
    <tr>
        <th>캐릭터명</th>
        <td>
            <div class="dfServer" id="dfServer">
                            </div>
            <div class="g_left">
                <input type="text" class="angel__text mode-active rad13" name="user_character" maxlength="30" id="user_character"> 물품을 전달 하실 본인의 캐릭터명
                <span id="sub_text" class="text-rock"></span>
            </div>
            <p class="character_noti">* 본인이 사용하는 서버/캐릭터명 미 선택 및 미 기재 시 문제가 발생될 수 있으며, 거래신청자에게 책임이 있습니다.</p>
        </td>
    </tr>';
                }
            }
            if($user_goods_type == 'bargain'){
                $result .='<tr>
        <th>흥정거래금액</th>
        <td>
            즉시판매금액 <span class="f_blue3 f_small">(구매자의 흥정 신청 시 해당금액보다 높은 가격으로는 흥정신청이 되지 않습니다.)</span><br>
            <div class="bargain_area">
                <input type="text" name="user_price" id="user_price" maxlength="10" class="angel__text text_right rad13"> 원 (3,000원 이상, 10원 단위 등록 가능)
            </div>
            <label><input type="checkbox" name="user_deny_use" value="1" id="user_deny_use" class="angel_game_sel">최저 흥정가격 설정</label>
            <div id="min_user_bargain" class="min_user_bargain">
                <input type="text" keyevent="price" name="user_price_limit" maxlength="10" class="angel__text text_right rad13"> 원 미만으로는 흥정신청을 받지 않습니다.
            </div>
        </td>
        </tr>
    <tr>';
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
            <input type="text" class="angel__text mode-active" name="character_id" id="character_id" placeholder="게임 ID" size="30" >
            <div class="character_noti">
                ※ 캐릭터 정보 주의사항<br>
                - 모든 정보 입력 후 물품 등록이 가능합니다.<br>
                - 캐릭터 정보를 허위로 입력 시 , 등록자[판매자]에게 책임이 있으며 거래에 불이익을 받을 수 있습니다.
            </div>
        </td>
    </tr>';
                }
                $result .='<tr>
        <th>캐릭터명</th>
        <td>
            <div class="dfServer" id="dfServer">
                            </div>
            <div class="g_left">
                <input type="text" class="angel__text mode-active rad13" name="user_character" maxlength="30" id="user_character"> 물품을 전달 하실 본인의 캐릭터명
                <span id="sub_text" class="text-rock"></span>
            </div>
        </td>
    </tr>';
            }
        }
        echo $result;
    }

    public function getAjaxItemAll(){
        $item = array (
            'category' =>
                array (
                    0 => '무기',
                    1 => '방어구',
                    2 => '악세서리',
                    3 => '스킬북',
                    4 => '기타',
                ),
            'kind' =>
                array (
                    '무기' =>
                        array (
                            0 => '단검',
                            1 => '도끼',
                            2 => '양손검',
                            3 => '지팡이',
                            4 => '창',
                            5 => '한손검',
                            6 => '활',
                        ),
                    '방어구' =>
                        array (
                            0 => '가더',
                            1 => '각반',
                            2 => '갑옷',
                            3 => '망토',
                            4 => '방패',
                            5 => '부츠',
                            6 => '장갑',
                            7 => '투구',
                            8 => '티셔츠',
                        ),
                    '악세서리' =>
                        array (
                            0 => '귀걸이',
                            1 => '목걸이',
                            2 => '반지',
                            3 => '벨트',
                        ),
                    '스킬북' =>
                        array (
                            0 => '군주',
                            1 => '기사',
                            2 => '마법사',
                            3 => '요정',
                        ),
                    '기타' =>
                        array (
                            0 => '강화주문서',
                            1 => '재료',
                            2 => '캐시아이템',
                        ),
                ),
            'item_name' =>
                array (
                    '단검' =>
                        array (
                            0 => '마력의 단검',
                            1 => '미스릴 단검',
                            2 => '바람칼날의 단검',
                            3 => '생명의 단검',
                            4 => '수정 단검',
                            5 => '오리하루콘 단검',
                            6 => '오크족 단검',
                        ),
                    '도끼' =>
                        array (
                            0 => '광전사의 도끼',
                            1 => '광풍의 도끼',
                            2 => '난쟁이족 도끼',
                            3 => '대형도끼',
                            4 => '데몬 액스',
                            5 => '마족의 도끼',
                            6 => '모닝스타',
                            7 => '아탐',
                            8 => '은도끼',
                            9 => '전투 도끼',
                        ),
                    '양손검' =>
                        array (
                            0 => '나이트발드의 양손검',
                            1 => '대검',
                            2 => '리자드맨 용사의 검',
                            3 => '무관의 양손검',
                            4 => '붉은 기사의 대검',
                            5 => '악마왕의 양손검',
                            6 => '양손검',
                            7 => '은날의 대검',
                            8 => '진명황의 집행검',
                            9 => '파멸의 대검',
                            10 => '피의 대검',
                        ),
                    '지팡이' =>
                        array (
                            0 => '강철 마나의 지팡이',
                            1 => '데몬의 지팡이',
                            2 => '마나의 지팡이',
                            3 => '마력의 지팡이',
                            4 => '마법사의 지팡이',
                            5 => '마족의 지팡이',
                            6 => '명상의 지팡이',
                            7 => '바포메트의 지팡이',
                            8 => '수정 결정체 지팡이',
                            9 => '수정 지팡이',
                            10 => '신관의 지팡이',
                            11 => '악마왕의 지팡이',
                            12 => '얼음 여왕의 지팡이',
                            13 => '제로스의 지팡이',
                            14 => '힘의 지팡이',
                        ),
                    '창' =>
                        array (
                            0 => '넓은 창',
                            1 => '루선해머',
                            2 => '미늘창',
                            3 => '백드코빈',
                            4 => '악마왕의 창',
                            5 => '오크족 창',
                            6 => '창',
                            7 => '크림슨 랜스',
                            8 => '포챠드',
                            9 => '해신의 삼지창',
                            10 => '혹한의 창',
                        ),
                    '한손검' =>
                        array (
                            0 => '고대 다크엘프의 검',
                            1 => '그라디우스',
                            2 => '넓은 검',
                            3 => '뇌신검',
                            4 => '다마스커스 검',
                            5 => '데스나이트의 불검',
                            6 => '레이피어',
                            7 => '마족의 검',
                            8 => '메일 브레이커',
                            9 => '몽둥이',
                            10 => '무관의 장검',
                            11 => '붉은 기사의 검',
                            12 => '싸울아비 장검',
                            13 => '언월도',
                            14 => '오크족 검',
                            15 => '요정족 검',
                            16 => '은장검',
                            17 => '일본도',
                            18 => '장검',
                            19 => '침묵의 검',
                            20 => '커츠의 검',
                        ),
                    '활' =>
                        array (
                            0 => '가이아의 격노',
                            1 => '달의 장궁',
                            2 => '마족의 활',
                            3 => '사냥꾼 활',
                            4 => '사이하의 활',
                            5 => '살천의 활',
                            6 => '악마왕의 활',
                            7 => '악몽의 장궁',
                            8 => '오크족 활',
                            9 => '요정족 활',
                            10 => '작은 활',
                            11 => '장궁',
                            12 => '진홍의 크로스보우',
                            13 => '크로스보우',
                            14 => '파괴의 장궁',
                            15 => '화염의 활',
                        ),
                    '가더' =>
                        array (
                            0 => '고대 명궁의 가더',
                            1 => '고대 투사의 가더',
                            2 => '마법사의 가더',
                            3 => '수호의 가더',
                            4 => '체력의 가더',
                        ),
                    '각반' =>
                        array (
                            0 => '강철 각반',
                            1 => '마법 방어 각반',
                            2 => '체력 각반',
                        ),
                    '갑옷' =>
                        array (
                            0 => '강철 판금 갑옷',
                            1 => '데스나이트의 갑옷',
                            2 => '띠 갑옷',
                            3 => '마법 방어 사슬 갑옷',
                            4 => '마법사 옷',
                            5 => '무관의 갑옷',
                            6 => '무명 로브',
                            7 => '미늘 갑옷',
                            8 => '바포메트의 갑옷',
                            9 => '비늘 갑옷',
                            10 => '뼈 갑옷',
                            11 => '사슬 갑옷',
                            12 => '수정 갑옷',
                            13 => '신관의 로브',
                            14 => '오크족 고리 갑옷',
                            15 => '오크족 사슬 갑옷',
                            16 => '요정족 사슬 갑옷',
                            17 => '요정족 판금 갑옷',
                            18 => '징박힌 가죽갑옷',
                            19 => '청동 판금 갑옷',
                            20 => '판금 갑옷',
                            21 => '흑장로의 로브',
                        ),
                    '망토' =>
                        array (
                            0 => '거대 여왕 개미의 금빛 날개',
                            1 => '거대 여왕 개미의 은빛 날개',
                            2 => '군주의 위엄',
                            3 => '난쟁이족 망토',
                            4 => '마나 망토',
                            5 => '마법 망토',
                            6 => '무관의 망토',
                            7 => '보호 망토',
                            8 => '신관의 망토',
                            9 => '오크족 망토',
                            10 => '은색의 망토',
                        ),
                    '방패' =>
                        array (
                            0 => '강철 방패',
                            1 => '골각 방패',
                            2 => '난쟁이족 둥근 방패',
                            3 => '마력서',
                            4 => '무관의 방패',
                            5 => '반사 방패',
                            6 => '반역자의 방패',
                            7 => '사각 방패',
                            8 => '신관의 마력서',
                            9 => '신의의 방패',
                            10 => '에바의 방패',
                            11 => '요정족 방패',
                            12 => '우럭하이 방패',
                            13 => '은기사의 방패',
                            14 => '큰 방패',
                        ),
                    '부츠' =>
                        array (
                            0 => '강철 부츠',
                            1 => '데몬의 부츠',
                            2 => '데스나이트의 부츠',
                            3 => '무관의부츠',
                            4 => '민첩의 부츠',
                            5 => '부츠',
                            6 => '신관의 부츠',
                            7 => '완력의 부츠',
                            8 => '지식의 부츠',
                            9 => '지혜의 부츠',
                            10 => '짧은 장화',
                            11 => '커츠의 부츠',
                            12 => '타라스의 부츠',
                            13 => '흑장로의 샌달',
                        ),
                    '장갑' =>
                        array (
                            0 => '강철 장갑',
                            1 => '그림자 장갑',
                            2 => '데몬의 장갑',
                            3 => '데스나이트의 장갑',
                            4 => '돌 장갑',
                            5 => '리자드맨 영웅의 장갑',
                            6 => '마력의 장갑',
                            7 => '명궁의 장갑',
                            8 => '무관의 장갑',
                            9 => '빙령의 장갑',
                            10 => '수정 장갑',
                            11 => '신관의 장갑',
                            12 => '암령의 장갑',
                            13 => '염령의 장갑',
                            14 => '장갑',
                            15 => '커츠의 장갑',
                            16 => '파워 글로브',
                            17 => '풍령의 장갑',
                            18 => '활 골무',
                        ),
                    '투구' =>
                        array (
                            0 => '강철 면갑',
                            1 => '기사의 면갑',
                            2 => '난쟁이족 철 투구',
                            3 => '데몬의 투구',
                            4 => '데스나이트의 투구',
                            5 => '마법 방어 투구',
                            6 => '마법사 모자',
                            7 => '메르키오르의 모자',
                            8 => '무관의 투구',
                            9 => '발터자르의 모자',
                            10 => '붉은 기사의 두건',
                            11 => '세마의 모자',
                            12 => '신관의 투구',
                            13 => '엘름의 축복',
                            14 => '오크족 투구',
                            15 => '요정족 투구',
                            16 => '카스파의 모자',
                            17 => '커츠의 투구',
                            18 => '투구',
                            19 => '해골 투구',
                        ),
                    '티셔츠' =>
                        array (
                            0 => '민첩의 티셔츠',
                            1 => '완력의 티셔츠',
                            2 => '요정족 티셔츠',
                            3 => '지식의 티셔츠',
                            4 => '지혜의 티셔츠',
                            5 => '티셔츠',
                        ),
                    '귀걸이' =>
                        array (
                            0 => '불사의 귀걸이',
                            1 => '붉은 오크의 귀걸이',
                            2 => '수리된 귀걸이',
                            3 => '영혼의 귀걸이',
                            4 => '용맹의 귀걸이',
                            5 => '해골 귀걸이',
                        ),
                    '목걸이' =>
                        array (
                            0 => '노예의 목걸이',
                            1 => '도펠겡어 보스의 목걸이',
                            2 => '마족의 목걸이',
                            3 => '매력의 목걸이',
                            4 => '민첩의 목걸이',
                            5 => '약속의 목걸이',
                            6 => '오크 투사의 목걸이',
                            7 => '완력의 목걸이',
                            8 => '지식의 목걸이',
                            9 => '지혜의 목걸이',
                            10 => '해골 목걸이',
                        ),
                    '반지' =>
                        array (
                            0 => '기백의 반지',
                            1 => '기사단의 반지',
                            2 => '도펠겡어 보스의 오른쪽 반지',
                            3 => '도펠겡어 보스의 왼쪽 반지',
                            4 => '마왕의 반지',
                            5 => '멸마의 반지',
                            6 => '수령의 반지',
                            7 => '수리된 반지',
                            8 => '수호의 반지',
                            9 => '수호자의 반지',
                            10 => '심연의 반지',
                            11 => '지령의 반지',
                            12 => '풍령의 반지',
                            13 => '항마의 반지',
                            14 => '화령의 반지',
                        ),
                    '벨트' =>
                        array (
                            0 => '낡은 신체의 벨트',
                            1 => '낡은 영혼의 벨트',
                            2 => '낡은 정신의 벨트',
                            3 => '빛나는 신체의 벨트',
                            4 => '빛나는 영혼의 벨트',
                            5 => '빛나는 정신의 벨트',
                            6 => '신체의 벨트',
                            7 => '영혼의 벨트',
                            8 => '오우거의 벨트',
                            9 => '용기의 벨트',
                            10 => '정신의 벨트',
                            11 => '트롤의 벨트',
                        ),
                    '군주' =>
                        array (
                            0 => '글로잉 오라',
                            1 => '브레이브 멘탈',
                            2 => '샤이닝 오라',
                            3 => '트루 타겟',
                        ),
                    '기사' =>
                        array (
                            0 => '리덕션 아머',
                            1 => '바운스 어택',
                            2 => '솔리드 캐리지',
                            3 => '쇼크 스턴',
                            4 => '카운터 배리어',
                        ),
                    '마법사' =>
                        array (
                            0 => '그레이터 힐',
                            1 => '디스인티그레이트',
                            2 => '디지즈',
                            3 => '디크리즈 웨이트',
                            4 => '디텍션',
                            5 => '라이트',
                            6 => '리무브 커스',
                            7 => '마나 드레인',
                            8 => '메디테이션',
                            9 => '미티어 스트라이크',
                            10 => '뱀파이어릭 터치',
                            11 => '블레스드 아머',
                            12 => '사일런스',
                            13 => '선 버스트',
                            14 => '실드',
                            15 => '아이스 스파이크',
                            16 => '앱솔루트 배리어',
                            17 => '어드밴스 스피릿',
                            18 => '어스 재일',
                            19 => '에너지 볼트',
                            20 => '위크니스',
                            21 => '이럽션',
                            22 => '이뮨 투 함',
                            23 => '인비지블리티',
                            24 => '인챈트 스테이터스',
                            25 => '카운터 매직',
                            26 => '캔슬레이션',
                            27 => '콘 오브 콜드',
                            28 => '콜 라이트닝',
                            29 => '큐어 포이즌',
                            30 => '턴 언데드',
                            31 => '파이어 볼',
                            32 => '파이어 스톰',
                            33 => '포그 오브 슬리핑',
                            34 => '프로즌 클라우드',
                            35 => '헤이스트',
                            36 => '홀리 워크',
                            37 => '힐 올',
                        ),
                    '요정' =>
                        array (
                            0 => '네이쳐스 블레싱',
                            1 => '네이쳐스 터치',
                            2 => '댄싱 블레이즈',
                            3 => '버닝 웨폰',
                            4 => '블러드 투 소울',
                            5 => '소울 오브 프레임',
                            6 => '스톰 샷',
                            7 => '스트라이커 게일',
                            8 => '아이언 스킨',
                            9 => '어디셔널 파이어',
                            10 => '어스 가디언',
                            11 => '어스 바인드',
                            12 => '에어리어 오브 사일런스',
                            13 => '워터 라이프',
                            14 => '윈드워크',
                            15 => '이레이즈 매직',
                            16 => '트리플 애로우',
                            17 => '폴루트 워터',
                        ),
                    '강화주문서' =>
                        array (
                            0 => '갑옷 마법 주문서',
                            1 => '무기 마법 주문서',
                        ),
                    '재료' =>
                        array (
                            0 => '가죽 ',
                            1 => '고급 가죽 ',
                            2 => '고급 보석 ',
                            3 => '고급 천 ',
                            4 => '고급 철 ',
                            5 => '낡은 고리 ',
                            6 => '땅의 숨결 ',
                            7 => '땅의 피혁 ',
                            8 => '린드비오르의 숨결 ',
                            9 => '마물의 기운',
                            10 => '물의 숨결 ',
                            11 => '물의 피혁 ',
                            12 => '바람의 숨결 ',
                            13 => '바람의 피혁 ',
                            14 => '발라카스의 숨결 ',
                            15 => '백금 판금 ',
                            16 => '버섯포자의 즙 ',
                            17 => '보석 ',
                            18 => '불의 숨결 ',
                            19 => '불의 피혁 ',
                            20 => '수룡 비늘 ',
                            21 => '신화 제작 비법서 ',
                            22 => '안타라스의 숨결 ',
                            23 => '영웅 제작 비법서 ',
                            24 => '오리하루콘 판금 ',
                            25 => '전설 제작 비법서 ',
                            26 => '지룡 비늘',
                            27 => '천',
                            28 => '철',
                            29 => '최고급 가죽 ',
                            30 => '최고급 보석 ',
                            31 => '최고급 천 ',
                            32 => '최고급 철 ',
                            33 => '축복의 가루',
                            34 => '파푸리온의 숨결 ',
                            35 => '풍룡 비늘 ',
                            36 => '할파스의 집념',
                            37 => '화룡 비늘 ',
                            38 => '희귀 제작 비법서',
                        ),
                    '캐시아이템' =>
                        array (
                            0 => '다이아',
                        ),
                ),
            'manage' =>
                array (
                    'visible' => 'Y',
                    'enchant_min' => '0',
                    'enchant_max' => '15',
                    'attr_enchant_visible' => 'Y',
                    'attr_enchant_min' => '1',
                    'attr_enchant_max' => '5',
                ),
        );
        return response()->json($item);
    }

    public function getUserContactRestrict(Request $request){
        $params = $request->all();
        $params = json_decode(json_encode($params));
        $mb = $hb = '';

        if(!empty($params->user_mobileA) && !empty($params->user_mobileB) && !empty($params->user_mobileC)){
            $mb = $params->user_mobileA.'-'.$params->user_mobileB.'-'.$params->user_mobileC;
        }
        if(!empty($params->user_contactA) && !empty($params->user_contactB) && !empty($params->user_contactC)){
            $hb = $params->user_contactA.'-'.$params->user_contactB.'-'.$params->user_contactC;
        }

        if(empty($hb) && empty($mb)){
            echo 'E|연락처가 비었습니다.';
        }
        else{
            $other_user = User::where('id','!=',$this->user->id)
                ->where(function($query) use ($mb,$hb){
                    $query->where('number',$mb);
                    $query->orwhere('home',$hb);
                })->get()->first();
            if(!empty($other_user)){
                echo 'E|이미 사용되었습니다.';
            }
            else{
                echo 'S|정상적으로 처리되었습니다.';
            }
        }
    }

    public function getRegInfoCharacterBuy(Request $request){
        $item_info = '';
        $user = Auth::user();
        $params = $request->all();
        $params = json_decode(json_encode($params));
        $params->price = !empty($params->user_price) ?  $params->user_price  : 0;
        if(!empty($params->discount_use)){
            $allcount = $params->discount_quantity * $params->discount_quantity_cnt;
            $discount = '<td>    '.$allcount.' 게임머니 당 '.$params->discount_price.'원        </td>';
        }
        if(!empty($params->item_info_txt)){
            $item_info = '<tr>
            <th>아이템정보</th>
            <td colspan="3" class="f_blue3 f_bold">'.$params->item_info_txt.'</td>
        </tr>';
        }
        if($params->user_goods_type == 'division'){
            $params->price = str_replace(",",'',$params->user_division_price) * str_replace(",","",$params->user_quantity_min) / str_replace(",","",$params->user_division_unit);
            $params->price = '최소 '.number_format($params->price);
        }

        $r = '';
        if($params->user_goods == 'character'){
            $r = '<div class="contract_box"><div class="contract_title">계정양도 전자계약서</div>
양수인 <span class="under">'.$user->name.'</span>(이하 ‘양수인’)과 양도인 <span class="under"></span>(이하 ‘양도인’)은 아래의 양수인의 캐릭터를 이용할 수 있는 인터넷 계정(이하 ‘계정’) 대하여 다음과 같이 양도 계약을 체결한다.
    <table>
    <colgroup>
        <col width="160">
        <col />
    </colgroup>
    <tr>
        <th>물품번호</th>
        <td></td>
    </tr>
    <tr>
        <th>작성일자</th>
        <td></td>
    </tr>
    <tr>
        <th>양수대금(거래금액)</th>
        <td>'.$params->price.'원</td>
    </tr>
    </table>

</div><div class="character_info">
    <table class="table-striped table-green1">
        <colgroup>
            <col width="20%">
            <col width="25%">
            <col width="25%">
            <col width="30%">
        </colgroup>
        <tr>
            <th colspan="4">양수인</th>
        </tr>
        <tr>
            <th>성명</th>
            <td>'.$user->name.'</td>
            <th>게임 캐릭터 ID</th>
            <td>'.$params->character_id.'</td>
        </tr>
        <tr>
            <th>생년월일</th>
            <td>'.$params->seller_birth.'</td>
            <th>연락처</th>
            <td>'.$params->user_cell_num.'</td>
        </tr>
    </table>
    <table class="g_green_table">
        <colgroup>
            <col width="20%">
            <col width="25%">
            <col width="25%">
            <col width="30%">
        </colgroup>
        <tr>
            <th colspan="4">양도인</th>
        </tr>
        <tr>
            <th>성명</th>
            <td colspan="3"></td>
        </tr>
        <tr>
            <th>생년월일</th>
            <td></td>
            <th>연락처</th>
            <td></td>
        </tr>
    </table>
</div>
<div class="g_btn_wrap">
    <a href="javascript:;" id="reg_submit" class="btn-default btn-suc">서명하기</a>
    <a href="javascript:;" id="cancel_submit" class="btn-default btn-cancel">취소</a>
</div>';
        }
        else{
            if(!empty($params->discount_use)){
                $allcount = $params->discount_quantity * $params->discount_quantity_cnt;
                $discount = '<td>    '.$allcount.' 게임머니 당 '.$params->discount_price.'원        </td>';
            }
            if(!empty($params->item_info_txt)){
                $item_info = '<tr>
            <th>아이템정보</th>
            <td colspan="3" class="f_blue3 f_bold">'.$params->item_info_txt.'</td>
        </tr>';
            }

            if($params->user_goods_type == 'division'){
                $r = '<table class="table-striped table-green1">
    <colgroup>
        <col width="122">
        <col width="180">
        <col width="122">
        <col width="180">
    </colgroup>
    <tr>
        <th>카테고리</th>
        <td colspan="3">'.$params->game_code_text.' > '.$params->server_code_text.' > <span class="f_blue3">'.$params->unit.'</td>
    </tr>
</table>
<table class="table-striped g_blue_table2">
    <colgroup>
        <col width="122">
        <col width="180">
        <col width="122">
        <col width="180">
    </colgroup>
    <tr>
        <th>물품제목</th>
        <td colspan="3">
                        '.$params->user_title.'        </td>
    </tr>
    '.$item_info.'
     <tr>
        <th>거래유형</th>
        <td colspan="3">분할판매</td>
    </tr>
    <tr>
        <th>판매수량</th>
        <td colspan="3">'.$params->user_quantity_max.' '.$params->unit.' (최소 '.$params->user_quantity_min.' '.$params->unit.')</td>
    </tr>
    <tr>

        <th>판매금액</th>
        <td colspan="3">'.$params->user_division_unit.' '.$params->unit.' 당 '.$params->user_division_price.'원</td>
    </tr>
    </table>

    <div class="position-relative height90">
        <div class="position-absolute border-one-gray w100"></div>
        <div class="attention position-absolute">거래 사고 주의사항</div>
    </div>

    <ul class="box6 g_list">
        <li>1. 전달받은 물품은 절대 돌려주지 마세요.</li>
        <li>2. 구매 등록시 반드시 본인 정보 (게임명/서버/캐릭터)를 등록하세요</li>
        <li>&nbsp;&nbsp;&nbsp;타인 게임정보 기재 또는, 다른 게임/서버에 구매 신청할 경우 물품신청자에게 불이익이 발생할수 있습니다.</li>
    </ul>
    <div class="last_txt">등록하시려는 물품이 위와 같습니까?</div>
<div class="g_btn_wrap">
    <a href="javascript:;" id="reg_submit" class="btn-default btn-suc">확인</a>
    <a href="javascript:;" id="cancel_submit" class="btn-default btn-cancel">취소</a>
</div>';
            }
            if($params->user_goods_type == 'general'){
                if(!empty($params->user_quantity)){
                    $price_type = '<th>판매수량</th>
        <td>'.$params->user_quantity.' '.$params->unit.'</td>
    </tr>
<tr>
<th>단위금액</th>
<td>'.$params->user_quantity.'당 '.$params->user_price.'원</td>';
                }

                $r =  '<table class="table-striped table-green1">
    <colgroup>
        <col width="122">
        <col width="180">
        <col width="122">
        <col width="180">
    </colgroup>
    <tr>
        <th>카테고리</th>
        <td colspan="3">'.$params->game_code_text.' > '.$params->server_code_text.' > <span class="f_blue3">'.$params->unit.'</span></td>
    </tr>
</table>
<table class="table-striped table-green1">
    <colgroup>
        <col width="122">
        <col width="180">
        <col width="122">
        <col width="180">
    </colgroup>
    <tr>
        <th>물품제목</th>
        <td colspan="3">
            '.$params->user_title.'
        </td>
    </tr>
    '.$item_info.'

     <tr>
        <th>거래유형</th>
        <td>일반 판매</td>

        <th>판매금액</th>
        <td>'.$params->user_price.'원</td>
    </tr>
    </table>

    <div class="position-relative height90">
        <div class="position-absolute border-one-gray w100"></div>
        <div class="attention position-absolute">거래 사고 주의사항</div>
    </div>
    <ul class="box6 g_list">
        <li>1. 전달받은 물품은 절대 돌려주지 마세요.</li>
        <li>2. 구매 등록시 반드시 본인 정보 (게임명/서버/캐릭터)를 등록하세요</li>
        <li>&nbsp;&nbsp;&nbsp;타인 게임정보 기재 또는, 다른 게임/서버에 구매 신청할 경우 물품신청자에게 불이익이 발생할수 있습니다.</li>
    </ul>
<div class="g_btn_wrap">
    <a href="javascript:;" id="reg_submit" class="btn-default btn-suc">확인</a>
    <a href="javascript:;" id="cancel_submit" class="btn-default btn-cancel">취소</a>
</div>';
            }
        }
        echo $r;
    }

    public function getRegInfoCharacter(Request $request){
        $user = Auth::user();
        $params = $request->all();
        $params = json_decode(json_encode($params));
        $params->price = !empty($params->user_price) ?  $params->user_price  : 0;
        if($params->user_goods_type == 'division'){
            $params->price = str_replace(",",'',$params->user_division_price) * str_replace(",","",$params->user_quantity_min) / str_replace(",","",$params->user_division_unit);
        }
        $r = '';
        if($params->user_goods_type !== null){
            $r = '<div class="contract_box"><div class="contract_title">계정양도 전자계약서</div>
양도인 <span class="under">'.$user->name.'</span>(이하 ‘양도인’)과 양수인 <span class="under"></span>(이하 ‘양수인’)은 아래의 양도인의 캐릭터를 이용할 수 있는 인터넷 계정(이하 ‘계정’) 대하여 다음과 같이 양도 계약을 체결한다.
    <table>
    <colgroup>
        <col width="160">
        <col />
    </colgroup>
    <tr>
        <th>물품번호</th>
        <td></td>
    </tr>
    <tr>
        <th>작성일자</th>
        <td></td>
    </tr>
    <tr>
        <th>양도대금(거래금액)</th>
        <td>'.$params->price.'원</td>
    </tr>
    </table>
제1조 [보증 및 계약의 효력]
① 본 계약은 전자문서를 통해 양도인 및 양수인의 전자적 의사표시로 성립된 계약으로 법적 효력을 갖는다.
② 양도인은 본 계정이 관련 법률의 위반 및 타인의 권리를 침해함이 없이 적법하게 권리를 보유한 계정임을 보증한다.
③ 본 계약 체결 이후 양수인이 본 계정 양도대금을 양수인에게 지급하고 양수인이 본 계정을 정상적으로 양수 받은 즉시 양도인은 본 계정에 대한 일체의 권한은 양수인이 갖으며 양도인은 본 계정에 대한 모든 권한을 상실한다.
④ 본 계약은 체결시점부터 본 계약 당사자 일방의 귀책사유에 기하여 해지ㆍ해제 되기 전까지 유효하다.

제2조 [양도인의 의무와 책임]
① 양도인은 계약 당사자임을 확인할 수 있는 이름, 생년월일 및 성별, 주소, 연락처 등의 정보를 양수인에게 제공하여야 한다.
② 양도인은 양수인이 본 계정의 이용 및 일체의 권리를 행사하는데 필요한 정보를 양수인에게 제공한다.
③ 양수인이 계정을 양수 받은 이후 계정을 이용ㆍ처분(양도)하거나 계정에 등록되어 있는 정보(ID, 이메일, 연락처, 비밀번호 등)를 변경하는데 있어 양도인의 정보 제공 내지 본인인증 확인 절차 등 협조가 요구 될 시 양도인은 필요한 정보와 협조를 신속히 제공한다. 기타 ‘양수인’이 ‘계정’을 이용함에 있어 불가피하게 추가 정보를 요청하는 경우 ‘양도인’은 이를 신속히 제공하여야 한다.
④ 양도인은 계정 양도 이후 양수인의 사전 동의 없이 계정에 접근하거나 계정에 등록된 어떠한 정보도 변경할 수 없다. 또한 양도한 계정을 이용해 여타 사이트∙게임을 이용하거나 계정의 정보를 양수인 외 제3자에게 제공하여서는 아니된다. 양도인이 본 규정을 위반한 경우 모든 책임은 양도인에게 있다.
⑤ 양도인은 양도시점에 계정에 포함되어 있는 일체의 서비스 품목을 임의로 변경ㆍ삭제할 수 없으며 양도시점에 계정에 포함되어 있는 유료 상품을 환불 신청하는 등의 방법으로 양수인에게 손해를 끼친 경우 양수인에게 발생한 일체의 손해를 배상하여야 한다.

제3조 [양수인의 의무와 책임]
① 양수인은 양수한 계정에 대한 권한(게임이용 및 처분 등 거래를 통해 취득한 통상의 권리)을 넘어 양도인으로부터 전달받은 정보를 임의로 이용하여서는 아니 되며, 계정의 정상적인 서비스 이용 목적 외 양도인으로부터 받은 계정에 등록된 개인정보 등을 제3자에게 제공하여서는 아니 된다.
② 양수인은 양도인이 본 계약의 의무 위반 책임 없음의 입증을 위해 본 계정 관련 정보를 요청할 시 해당 정보를 제공하여야 한다.

제4조 [손해배상]
① ‘양도인’ 및 ‘양수인’은 본 계약에 따른 의무를 위반하는 경우 상대방에 발생한 손해에 대한 배상 책임을 지며, 각 의무 불이행 사실에 대하여 귀책사유 없음의 입증 책임을 진다.
② 양도인의 계약 위반으로 양수인에 손해가 발생하여 주식회사 아이엠아이가 양수인에게 양도 대금을 대위 변제하는 경우 주식회사 아이엠아이는 이에 대한 구상금 청구권을 취득할 수 있으며, 이 경우 양도인은 대위 변제한 금액을 즉시 변제하여야 한다.
③ 양도인이 본 계약 제2조 제3항 및 제4항 및 제5항을 고의로 위반하거나 계정 양수 이후 제3자로 인해 본 계정의 정보(ID, 이메일, 비밀번호 등)가 변경되는 경우 양도인은 위약벌로서 양수인에게 발생한 손해의 2배를 부담한다. 본 항의 이행여부는 양수인의 여타 권리구제 수단의 실행에 영향을 미치지 아니한다.

제5조 [계약의 해지ㆍ해제]
① 계약 당사자 중 일방의 계약위반에 대하여 서면 또는 전자문서(이메일, 메세지 등)로 상대방에게 그 시정 및 보완을 최고하고, 기한 내 시정되지 아니할 때 본 계약을 해지할 수 있다.
② 계약 당사자 중 일방에게 다음 각 호에 해당하는 사유가 발생한 경우 상대방은 최고 없이 즉시 본 계약을 해지할 수 있다.
1. 양수인이 본 계약 제2조 제3항 및 제4항을 고의로 위반한 경우
2. 계정 양수 이후 제3자로 인해 본 계정의 정보(ID, 이메일, 비밀번호 등)가 변경되는 경우

제6조 [적용법률 및 분쟁해결]
① 본 계약은 대한민국 법률의 적용을 받으며 그에 따라 해석된다.
② 본 계약과 관련하여 분쟁이 발생하는 경우에는 각 계약 당사자 상호 협의를 통하여 원만히 해결하는 것을 원칙으로 하되, 본 계약과 관련하여 발생하는 모든 분쟁 사항에 대한 관할법원은 민사소송법에 의한다.

‘양도인’

<span class="uinfo">성   명</span> '.$user->name.'
<span class="uinfo">생년월일</span> '.$params->seller_birth.'
<span class="uinfo">연 락 처</span> '.$params->user_cell_num.'


‘양수인’

<span class="uinfo">성   명</span>
<span class="uinfo">생년월일</span>
<span class="uinfo">연 락 처</span>
</div><div class="character_info">
    <table class="table-striped table-green1">
        <colgroup>
            <col width="20%">
            <col width="25%">
            <col width="25%">
            <col width="30%">
        </colgroup>
        <tr>
            <th colspan="4">양도인</th>
        </tr>
        <tr>
            <th>성명</th>
            <td>'.$user->name.'</td>
            <th>게임 캐릭터 ID</th>
            <td>'.$params->character_id.'</td>
        </tr>
        <tr>
            <th>생년월일</th>
            <td>'.$params->seller_birth.'</td>
            <th>연락처</th>
            <td>'.$params->user_cell_num.'</td>
        </tr>
    </table>
    <table class="g_green_table">
        <colgroup>
            <col width="20%">
            <col width="25%">
            <col width="25%">
            <col width="30%">
        </colgroup>
        <tr>
            <th colspan="4">양수인</th>
        </tr>
        <tr>
            <th>성명</th>
            <td colspan="3"></td>
        </tr>
        <tr>
            <th>생년월일</th>
            <td></td>
            <th>연락처</th>
            <td></td>
        </tr>
    </table>
</div>
<div class="g_btn_wrap">
    <a href="javascript:;" id="reg_submit" class="btn-default btn-suc">서명하기</a>
    <a href="javascript:;" id="cancel_submit" class="btn-default btn-cancel">취소</a>
</div>';
        }
        echo $r;
    }

    public function getRegInfo(Request $request){
        $item_info = '';
        $r = '';
        $discount=  '<td>-</td>';
        $type = "일반";
        $params = $request->all();
        $params = json_decode(json_encode($params));
        if(!empty($params->discount_use)){
            $allcount = $params->discount_quantity * $params->discount_quantity_cnt;
            $discount = '<td>    '.$allcount.' 게임머니 당 '.$params->discount_price.'원        </td>';
        }
        if(!empty($params->item_info_txt)){
            $item_info = '<tr>
            <th>아이템정보</th>
            <td colspan="3" class="f_blue3 f_bold">'.$params->item_info_txt.'</td>
        </tr>';
        }

        if($params->user_goods_type == 'division'){
            $r = '<table class="table-striped table-green1">
    <colgroup>
        <col width="122">
        <col width="180">
        <col width="122">
        <col width="180">
    </colgroup>
    <tr>
        <th>카테고리</th>
        <td colspan="3">'.$params->game_code_text.' > '.$params->server_code_text.' > <span class="f_blue3">'.$params->unit.'</td>
    </tr>
</table>
<table class="table-striped table-green1">
    <colgroup>
        <col width="122">
        <col width="180">
        <col width="122">
        <col width="180">
    </colgroup>
    <tr>
        <th>물품제목</th>
        <td colspan="3">
                        '.$params->user_title.'        </td>
    </tr>
    '.$item_info.'
            <tr>
        <th>거래유형</th>
        <td>분할판매</td>
        <th>판매수량</th>
<td>'.$params->user_quantity_max.' '.$params->unit.' (최소 '.$params->user_quantity_min.' '.$params->unit.')</td>
</tr>
    <tr>
        <th>복수구매할인</th>
            '.$discount.'
        <th>판매금액</th>
        <td>'.$params->user_division_unit.' '.$params->unit.' 당 '.$params->user_division_price.'원</td>
            </tr>
    </table>

    <div class="position-relative height90">
        <div class="position-absolute border-one-gray w100"></div>
        <div class="attention position-absolute">거래 사고 주의사항</div>
    </div>

    <ul class="box6 g_list">
        <li>1. 전달받은 물품은 절대 돌려주지 마세요.</li>
        <li>2. 구매 등록시 반드시 본인 정보 (게임명/서버/캐릭터)를 등록하세요</li>
        <li>&nbsp;&nbsp;&nbsp;타인 게임정보 기재 또는, 다른 게임/서버에 구매 신청할 경우 물품신청자에게 불이익이 발생할수 있습니다.</li>
    </ul>
    <div class="last_txt">등록하시려는 물품이 위와 같습니까?</div>
<div class="g_btn_wrap">
    <a href="javascript:;" id="reg_submit" class="btn-default btn-suc">확인</a>
    <a href="javascript:;" id="cancel_submit" class="btn-default btn-cancel">취소</a>
</div>';
        }
        if($params->user_goods_type == 'bargain'){
            $r = '<table class="g_blue_table">
    <colgroup>
        <col width="122">
        <col width="180">
        <col width="122">
        <col width="180">
    </colgroup>
    <tr>
        <th>카테고리</th>
        <td colspan="3">'.$params->game_code_text.' > '.$params->server_code_text.' > <span class="f_blue3">'.$params->unit.'</td>
    </tr>
</table>
<table class="table-striped table-green1">
    <colgroup>
        <col width="122">
        <col width="180">
        <col width="122">
        <col width="180">
    </colgroup>
    <tr>
        <th>물품제목</th>
        <td colspan="3">
                        '.$params->user_title.'</td>
    </tr>
            '.$item_info.'
            <tr>
        <th>거래유형</th>
        <td>흥정판매</td>
                    <th>즉시판매금액</th>
            <td>
                3,000원            </td>
                </tr>
    </table>

    <div class="position-relative height90">
        <div class="position-absolute border-one-gray w100"></div>
        <div class="attention position-absolute">거래 사고 주의사항</div>
    </div>
    <ul class="box6 g_list">
        <li>1. 전달받은 물품은 절대 돌려주지 마세요.</li>
        <li>2. 구매 등록시 반드시 본인 정보 (게임명/서버/캐릭터)를 등록하세요</li>
        <li>&nbsp;&nbsp;&nbsp;타인 게임정보 기재 또는, 다른 게임/서버에 구매 신청할 경우 물품신청자에게 불이익이 발생할수 있습니다.</li>
    </ul>
<div class="g_btn_wrap">
    <a href="javascript:;" id="reg_submit" class="btn-default btn-suc">확인</a>
    <a href="javascript:;" id="cancel_submit" class="btn-default btn-cancel">취소</a>
</div>';
        }
        if($params->user_goods_type == 'general'){
            if(!empty($params->user_quantity)){
                $price_type = '<th>판매수량</th>
        <td>'.$params->user_quantity.' '.$params->unit.'</td>
    </tr>
<tr>
<th>단위금액</th>
<td>'.$params->user_quantity.'당 '.$params->user_price.'원</td>';
            }

            $r =  '<table class="table-striped table-green1">
    <colgroup>
        <col width="122">
        <col width="180">
        <col width="122">
        <col width="180">
    </colgroup>
    <tr>
        <th>카테고리</th>
        <td colspan="3">'.$params->game_code_text.' > '.$params->server_code_text.' > <span class="f_blue3">'.$params->unit.'</span></td>
    </tr>
</table>
<table class="table-striped table-green1">
    <colgroup>
        <col width="122">
        <col width="180">
        <col width="122">
        <col width="180">
    </colgroup>
    <tr>
        <th>물품제목</th>
        <td colspan="3">
            '.$params->user_title.'
        </td>
    </tr>
    '.$item_info.'

     <tr>
        <th>거래유형</th>
        <td>일반 판매</td>

        <th>판매금액</th>
        <td>'.$params->user_price.'원</td>
    </tr>
    </table>

    <div class="position-relative height90">
        <div class="position-absolute border-one-gray w100"></div>
        <div class="attention position-absolute">거래 사고 주의사항</div>
    </div>
    <ul class="box6 g_list">
        <li>1. 전달받은 물품은 절대 돌려주지 마세요.</li>
        <li>2. 구매 등록시 반드시 본인 정보 (게임명/서버/캐릭터)를 등록하세요</li>
        <li>&nbsp;&nbsp;&nbsp;타인 게임정보 기재 또는, 다른 게임/서버에 구매 신청할 경우 물품신청자에게 불이익이 발생할수 있습니다.</li>
    </ul>
<div class="g_btn_wrap">
    <a href="javascript:;" id="reg_submit" class="btn-default btn-suc">확인</a>
    <a href="javascript:;" id="cancel_submit" class="btn-default btn-cancel">취소</a>
</div>';
        }
        echo $r;
    }

    public function getAjaxItemDesc(Request $request){
        $category = $request->category;
        $kind = $request->kind;
        $item_name = $request->item_name;
        return response()->json(array("FAIL"=>false,'message'=>$category.' '.$kind.' '.$item_name));
    }

    public function user_certify(Request $request){
        return view('angel.certify');
    }

    public function application_ok_buy(Request $request){
        $params = $request->all();
        $unit = 1;
        $use_creditcard = str_replace(",","",$params['use_creditcard']);

        $item = MItem::where('orderNo', $params['id'])->whereNull('toId')->first();
        if(empty($item)){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        $item = $item->toArray();
        if(empty($use_creditcard)){
            echo '<script>alert("마일리지가 비었습니다.");window.history.back();</script>';
            return;
        }
        MItem::where('orderNo',$params['id'])->update(['toId'=>$this->user->id]);
        if($item['user_goods_type'] == 'division'){
            unset($item['id']);
            unset($item['created_at']);
            unset($item['updated_at']);
            $item['orderNo'] = date("Ymd").generateRandomString(8);
            $item['status'] = 0;
            MItem::insert($item);
            $unit = !empty($params['buy_quantity']) ? $params['buy_quantity'] * numberUnit($item['gamemoney_unit']): 1;
        }
        else{
            $unit = $item['user_quantity'] * numberUnit($item['gamemoney_unit']);
        }

        MPayitem::insert([
            'userId'=>$this->user->id,
            'orderNo'=>$params['id'],
            'status'=>0,
            'home'=>$this->user->home,
            'mobile'=>$this->user->mobile,
            'price'=>$use_creditcard,
            'character'=>$params['user_character'],
            'buy_quantity'=>$unit
        ]);
        return redirect('/myroom/sell/sell_pay_wait_view?id='.$params['id'].'&type='.$item['type']);
    }

    public function application_ok(Request $request){
        $params = $request->all();
        $unit = 1;
        $use_creditcard = str_replace(",","",$params['use_creditcard']);
        $status = 1;
        $item = MItem::where('orderNo', $params['id'])->whereNull('toId')->first();
        if(empty($item)){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        $item = $item->toArray();
        if(empty($use_creditcard)){
            echo '<script>alert("마일리지가 비었습니다.");window.history.back();</script>';
            return;
        }
        $mileage = $this->user->mileage;
        if($mileage < $use_creditcard){
            $status = 0;
            MItem::where('orderNo',$params['id'])->update(['toId'=>$this->user->id,'status'=>0]);
        }
        else{
            $rest_mileage = $mileage - $use_creditcard;
            $this->user->mileage = $rest_mileage;
            $this->user->save();
            MItem::where('orderNo',$params['id'])->update(['toId'=>$this->user->id,'status'=>1]);
        }

        if($item['user_goods_type'] == 'division'){
            unset($item['id']);
            unset($item['created_at']);
            unset($item['updated_at']);
            $item['orderNo'] = date("Ymd").generateRandomString(8);
            $item['status'] = 0;
            MItem::insert($item);
            $unit = !empty($params['buy_quantity']) ? $params['buy_quantity'] * numberUnit($item['gamemoney_unit']): 1;
        }
        else{
            $unit = $item['user_quantity'] * numberUnit($item['gamemoney_unit']);
        }
        MPayitem::insert([
            'userId'=>$this->user->id,
            'orderNo'=>$params['id'],
            'status'=>$status,
            'home'=>$this->user->home,
            'mobile'=>$this->user->mobile,
            'price'=>$use_creditcard,
            'character'=>$params['user_character'],
            'buy_quantity'=>$unit
        ]);
        if($status == 0){
            return redirect('/myroom/buy/buy_pay_wait_view?id='.$params['id'].'&type='.$item['type']);
        }
        else{
            return redirect('/myroom/buy/buy_ing_view?id='.$params['id'].'&type='.$item['type']);
        }
    }

    public function getRemoconMileage(Request $request){
        echo '<mileage result="true" total="0" use="'.$this->user->mileage.'" coupon="0" mcoupon="0" />';
    }

    public function buy_ing_ok(Request $request){
        if($request->mode == 'check'){
            MCashReceipt::updateOrCreate([
                'userId'=>$this->user->id,
                'orderNo'=>$request->id,
                'status' => 0,
                'type' => 1
            ],[
                'moneyreceipt_check'=>1,
                'moneyreceipt_type'=>1,
                'moneyreceipt_name'=>$request->moneyreceipt_name,
                'member_info'=>1,
                'number'=>$request->user_phone1.'-'.$request->user_phone2.'-'.$request->user_phone3,
                'moneyreceipt_email'=>$request->moneyreceipt_email
            ]);
            $item = MItem::where('orderNo',$request->id)->first();

            $status = str_replace(1,'',$item['status']);
            $status = $status.'2';
            if($status == 32){
                MPayitem::where('orderNo', $request->id)->update(['status' => 2]);
                if($item['type'] == 'sell'){
                    $buy_id = $item['toId'];
                    $sell_id = $item['userId'];
                }
                else{
                    $buy_id = $item['toId'];
                    $sell_id = $item['userId'];
                }
                $this->processPay($buy_id,$sell_id,$request->id);
            }
            MItem::where('orderNO', $request->id)->update(['status'=>$status]);
            return redirect('/myroom/buy/buy_ing_view?id='.$request->id.'&type='.$item['type']);
        }
    }

    public function sell_ing_ok(Request $request){

        $buy_id = $sell_id = "";

        if($request->process == 'order_cancel'){
            $item = MItem::with('payitem')->where('orderNo',$request->id)->first();
            if(empty($item) || empty($item['payitem'])){
                echo '<script>alert("잘못된 접근입니다.");window.history.go(-1);</script>';
                return;
            }
            if($item['type'] == 'sell'){
                $sell_id = $item['userId'];
                $buy_id = $item['toId'];
            }
            if($item['type'] == 'buy'){
                $sell_id = $item['toId'];
                $buy_id = $item['userId'];
            }

            if($sell_id != $this->user->id){
                echo '<script>alert("거래즉시취소는 판매자만 가능합니다.");window.history.go(-1);</script>';
                return;
            }

            if($item['payitem']['status'] == 1){
                MPremium::where('post_id',$item['id'])->delete();
                MBargainRequest::where('orderNo',$item['id'])->delete();

                User::where('id',$buy_id)->update(['mileage'=> DB::raw('mileage+'.$item['payitem']['price'])]);
                MPayhistory::insert([
                    'orderNo'=>$request->id,
                    'pay_type'=>21,
                    'price'=>$item['payitem']['price'],
                    'status'=>1,
                    'userId'=>$buy_id
                ]);
                MPayitem::where('id',$item['payitem']['id'])->delete();
            }
            MItem::where('orderNo',$request->id)->update(["status"=>-1]);
            MCancelReason::insert([
                'orderNo'=>$request->id,
                'reason'=>$request->cancel_contents,
                'content'=>$request->CANCEL_DETAIL_CONTENT,
                'userId'=>$sell_id
            ]);
            MInbox::insert([
                'orderId'=>$request->id,
                'type'=>'거래',
                'title'=>'고객님께서 판매중이신 #'.$request->id.' 물품이 거래취소되었습니다.',
                'content'=>getReasonList()[$request->cancel_contents],
                'userId'=>$sell_id
            ]);
            MInbox::insert([
                'orderId'=>$request->id,
                'type'=>'거래',
                'title'=>'고객님께서 구매중이신 #'.$request->id.' 물품이 거래취소되었습니다.',
                'content'=>getReasonList()[$request->cancel_contents]." ".$request->CANCEL_DETAIL_CONTENT,
                'userId'=>$buy_id
            ]);
            echo '<script>alert("거래취소되었습니다.거래취소내역에서 확인해주세요");location.href="/";</script>';
            return;
        }
        elseif($request->mode == 'check'){
            MCashReceipt::updateOrCreate([
                'userId'=>$this->user->id,
                'orderNo'=>$request->id,
                'status' => 0,
                'type' => 1
            ],[
                'moneyreceipt_check'=>1,
                'moneyreceipt_type'=>1,
                'moneyreceipt_name'=>$request->moneyreceipt_name,
                'member_info'=>1,
                'number'=>$request->user_phone1.'-'.$request->user_phone2.'-'.$request->user_phone3,
                'moneyreceipt_email'=>$request->moneyreceipt_email
            ]);
            $item = MItem::where('orderNo',$request->id)->first();
            $status = str_replace(1,'',$item['status']);
            $status = $status.'3';
            MItem::where('orderNO', $request->id)->update(['status'=>$status]);
            if($status == 23){
                MPayitem::where('orderNo', $request->id)->update(['status' => 2]);
                if($item['type'] == 'sell'){
                    $buy_id = $item['toId'];
                    $sell_id = $item['userId'];
                }
                else{
                    $buy_id = $item['toId'];
                    $sell_id = $item['userId'];
                }
                $this->processPay($buy_id,$sell_id,$request->id);
            }
           return redirect('/myroom/sell/sell_ing_view?id='.$request->id.'&type='.$item['type']);
        }
    }

    public  function buy_pay_wait_ok(Request $request){
        $id = $request->id;
        $t_type = $request->t_type;
        $seller_id = $buyer_id = 0;
        if($t_type == 'sell'){
            $game = MItem::with('payitem')->where("orderNo",$id)->where('toId', $this->user->id)->where('type', 'sell')->first();
            $buyer_id = !empty($game['toId']) ? $game['toId']: 0;
            $seller_id = !empty($game['userId']) ? $game['userId']: 0;
        }
        else{
            $game = MItem::with('payitem')->where("orderNo",$id)->where('userId', $this->user->id)->where('type', 'buy')->first();
            $buyer_id = !empty($game['userId']) ? $game['userId']: 0;
            $seller_id = !empty($game['toId']) ? $game['toId']: 0;
        }
        if(empty($game) || empty($game['payitem'])){
            echo '<script>alert("잘못된 요청입니다.");window.history.go(-1);</script>';
            return;
        }
        if($game['payitem']['price'] > $this->user->mileage){
            echo '<script>alert("마일리지가 충분치 않습니다.");window.history.go(-1);</script>';
            return;
        }

        $re = $this->processPay($buyer_id, $seller_id, $id);

        if($re == 1){
            MItem::where('orderNo', $id)->update(['status'=>1]);
        }
        return redirect('/myroom/buy/buy_ing_view?id='.$id.'&type='.$t_type);
    }

    public function sell_check_ok(Request $request){

        $request->re_ba_money = str_replace(",","",$request->re_ba_money);
        if($request->ba_money >= $request->re_ba_money){
            echo '<script>alert("흥정금액보다 높은 가격만 제시하세요.");window.history.back();</script>';
            return;
        }
        $ba_request = MBargainRequest::where('id',$request->id)->first();
        MBargainRequest::where('id',$request->id)->update([
            'price1'=>$request->re_ba_money,
            'status'=>1
            ]);
        MItem::where('orderNo',$ba_request['orderNo'])->update([
            'mode'=>1
        ]);
        return redirect('/myroom/sell/sell_check_view?id='.$ba_request['orderNo']);
    }

    public function buy_check_ok(Request $request){
        $id = $request->id;
        $process = $request->process;
        $bargain_request = MBargainRequest::where('id',$id)->first();
        if($process == 1){
            MBargainRequest::where('id',$id)->update([
                'status'=>10
            ]);
            MItem::where('orderNo',$bargain_request['orderNo'])->update([
               'toId'=>$this->user->id,
            ]);
            MPayitem::insert([
                'userId'=>$this->user->id,
                'orderNo'=>$bargain_request['orderNo'],
                'status'=>0,
                'price'=>$bargain_request['price1'],
                'character'=>$bargain_request['character']
            ]);
            return redirect('/myroom/buy/buy_pay_wait_view?id='.$bargain_request['orderNo'].'&type=sell');
        }
        else{
            MBargainRequest::where('id',$id)->update([
                'status'=>3
            ]);
            MItem::where('orderNo',$bargain_request['orderNo'])->update([
                'mode'=>2
            ]);
            return redirect('/myroom/buy/buy_check_view?id='.$bargain_request['orderNo'].'&type=sell');
        }

    }

    public function buy_pay_wait_cancel(Request $request){
        $status = 1;
        $id = $request->id;
        $item = MItem::with('payitem')->where('orderNo',$id)->first();
        if( empty($item['payitem']) ||
            $item['payitem']['status'] == 1 ||
            ($item['type']== 'sell'  && $this->user->id != $item['toId']) ||
            ($item['type']== 'buy'  && $this->user->id != $item['userId'])){
            echo '<script>alert("잘못된 접근입니다.");window.history.back();</script>';
            return;
        }
        else{
            MItem::where('orderNo',$id)->update(['toId'=>null]);
            MPayitem::where('id',$item['payitem']['id'])->delete();
            MOrderNotification::updateOrCreate([
                'userId'=>$this->user->id,
                'orderNo'=>$id
            ],[
                'reason'=>'구매취소',
                'type'=>2
            ]);
            return redirect('/myroom/buy/buy_regist');
        }
    }

    public function buy_regist(Request $request){
        $process = $request->process;
        $trade_id = $request->trade_id;

        if($process == 'deleteSelect')
        {
            MItem::where('orderNo',$trade_id)->delete();
            return redirect('/');
        }
        if($process == 'hideSelect')
            MItem::where('orderNo',$trade_id)->update(['hide'=>1]);
        if($process == 'showSelect')
            MItem::where('orderNo',$trade_id)->update(['hide'=>0]);
        return redirect('/myroom/buy/buy_regist_view?id='.$trade_id);

    }

    public function sell_regist(Request $request){
        $process = $request->process;
        $trade_id = $request->trade_id;
        if($process == 'deleteSelect')
        {
            MItem::where('orderNo',$trade_id)->delete();
            return redirect('/');
        }
        if($process == 'hideSelect')
            MItem::where('orderNo',$trade_id)->update(['hide'=>1]);
        if($process == 'showSelect')
            MItem::where('orderNo',$trade_id)->update(['hide'=>0]);
        return redirect('/myroom/sell/sell_regist_view?id='.$trade_id);

    }

    public function search_add(Request $request){
        $params = $request->all();
        unset($params['api_token']);
        $params['userId'] = $this->user->id;
        $game = MMygame::where('created_at',"!=","");
        $insertId = 0;
        foreach($params as $key=>$value){
            $game = $game->where($key,$value);
        }
        $game = $game->first();
        if(empty($game)){
            $insertId = MMygame::create($params);
            return response()->json(['result'=>'SUCCESS','mygameID'=>$insertId['id']]);
        }
        else{
            return response()->json(['result'=>'ERROR','msg'=>'이미 추가되었습니다.']);
        }
    }

    public function search_delete(Request $request){
        $id = $request->id;
        $game = MMygame::where('userId',$this->user->id)->where('id',$id)->first();
        if(empty($game)){
            return response()->json(['result'=>'ERROR','msg'=>'자료가 비었습니다.']);
        }
        else{
            MMygame::where('id',$id)->delete();
            return response()->json(['result'=>'SUCCESS']);
        }
    }

    public function list_search_ajax(Request $request){
        $trade_id = $request->trade_id;
        $strTradeType = $request->strTradeType;
        $game = MItem::with(['user.roles'])->where('orderNo',$trade_id)->first();
        if(empty($game) || empty($game['user']) || empty($game['user']['roles'])){
            return response()->json(['bExists'=>false]);
        }
        $price = "";
        $gamemoney_unit = empty($game['gamemoney_unit']) || $game['gamemoney_unit'] == 1 ? $game['gamemoney_unit'] : '';
        $gamemoney_unit = $gamemoney_unit == 1 || $gamemoney_unit == '1' ? "": $gamemoney_unit;

        $trade_kind_txt = $game['good_type'];
        $price = $game['user_price'];
        if(!empty($gamemoney_unit)|| $game['user_quantity'] > 1 )
            $price = $game['user_quantity'].$gamemoney_unit.'개당'.' '.$game['user_price'];
        if($game['user_goods_type'] == 'division'){
            $price = $game['user_division_unit'].$gamemoney_unit.'개당'.' '.$game['user_division_price'];
        }
        $credit_name_en = $game['user']['roles']['name'];
        $credit_name  = $game['user']['roles']['alias'];
        $credit_point = $this->user->point;
        $cell_auth = $this->user->mobile_verified;
        $email_auth = empty($this->user->email_verified_at) ? 0 : 1;
        $public_auth = 0;
        $account_auth = $this->user->bank_verified;
        return response()->json([
            'bExists'=>true,
            'trade_kind_txt'=>$trade_kind_txt,
            'trade_money'=>$price,
            'credit_name_en'=>$credit_name_en,
            'credit_name'=>$credit_name,
            'credit_point'=>number_format($credit_point),
            'cell_auth'=>$cell_auth,
            'email_auth'=>$email_auth,
            'public_auth'=>$public_auth,
            'account_auth'=>$account_auth,
            'image'=>$game['user']['roles']['icon']
        ]);
    }

    public function ajax_trade_check(Request $request){
        $trade_id = $request->trade_id;
        $item = MItem::with(['payitem'])->where('status',0)->whereNull('toId')->where('userId','!=',$this->user->id)->where('orderNo',$trade_id)->first();
        if(!empty($item) && empty($item['payitem'])){
            return response()->json(['result'=>'SUCCESS']);
        }
        else{
            return response()->json(['result'=>'FAIL','msg'=>'거래 가능한 물품이 아닙니다.']);
        }
    }
    public function sell_re_reg_auto_ok(Request $request){
        $id = $request->id;
        MItem::where('orderNo',$id)->update(['created_at'=>date("Y-m-d H:i:s")]);
        return redirect('/myroom/sell/sell_regist');
    }
    public function sell_regist_post(Request $request){
        $id = $request->trade_id;
        $process = $request->process;
        if($process == 'deleteSelect'){
            MItem::where('orderNo',$id)->delete();
        }

        return redirect('/myroom/sell/sell_regist');
    }
    public function user_certify_myinfo(Request $request){
        return view('angel.myroom.certify');
    }
    public function cash_receipt_confirm(Request $request){
        $id = $request->id;
        $cash = MCashReceipt::with('payitem')->whereHas('payitem')->where('orderNo',$id)->where('userId',$this->user->id)->where('status',1)->first();
        if(empty($cash)){
            echo '<script>alert("잘못된 접근입니다.");self.close();</script>';
            return;
        }
        return view('angel.myroom.cash_receipt_confirm',$cash);
    }

    public function cash_receipt_confirm2(Request $request){
        $id = $request->id;
        $cash = MCashReceipt::where('orderNo',$id)->where('userId',$this->user->id)->where('status',2)->first();
        if(empty($cash)){
            echo '<script>alert("잘못된 접근입니다.");self.close();</script>';
            return;
        }
        return view('angel.myroom.cash_receipt_confirm2',$cash);
    }

    public function search_update_form(Request $request){
        $item = MMygame::where('id',$request->id)->first();
        if(empty($item)){
            echo '<script>alert("잘못된 접근입니다.");self.close();</script>';
            return;
        }
        return view('angel.myroom.search_update_form',$item);
    }
}
