<?php

namespace App\Http\Controllers;

use App\Models\MAdminCash;
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
        select(DB::raw('SUM(price) a_price'),DB::raw('YEAR(updated_at) year, MONTH(updated_at) month'))
            ->where('status',2)
            ->whereYear('created_at',$year)
            ->groupby('year','month')->get();
        foreach($items as $v){
            $order_list[$v['month']-1] = $v['a_price'];
        }
        return response()->json($order_list);
    }
}
