<?php

namespace App\Http\Controllers;

use App\Models\MAdminCash;
use App\Models\MGame;
use App\Models\MItem;
use App\Models\MMileage;
use App\Models\MPayitem;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

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
            ->get()->count();
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
                                                'mileage'=>$mileage

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
        select(DB::raw('SUM(price)/a_price'),DB::raw('YEAR(updated_at) year, MONTH(updated_at) month'))
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
        return view('admin.members');
    }
}
