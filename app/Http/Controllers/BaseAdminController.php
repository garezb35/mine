<?php

namespace App\Http\Controllers;

use App\Models\MAdminCash;
use App\Models\MAdminNotice;
use App\Models\MAsk;
use App\Models\MItem;
use App\Models\MMallBuy;
use App\Models\MMileage;
use App\Models\MPopularCharacter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

class BaseAdminController extends Controller
{
    public $user;
    public $game;
    public function  __construct()
    {
        $this->isLogged = false;
        $this->game = array();
        $this->middleware(function ($request, $next) {
            if (Auth::guard('admin')->check()) {
                $this->isLogged = true;
                $this->user = Auth::guard('admin')->user();
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
                $mileage_count = MMileage::whereHas('user')->where('status',0)->get()->count();
                $game_requests_count = MAsk::with('user')
                    ->where('type','!=','newgame')
                    ->where('type','!=','cancel')
                    ->where('type','!=','complete')
                    ->where(function($query){
                        $query->where('response','');
                        $query->orWhere('response');
                    })
                    ->get()->count();
                $new_game_count = MAsk::
                    where('type','newgame')
                    ->where(function($query){
                        $query->whereNull('response');
                        $query->orWhere('response','');
                    })->get()->count();
                $buy_lists_count = MMallBuy::whereNull('serial_number')->orWhere('serial_number',"")->get()->count();
                $notice_count = MAdminNotice::where('isReaded',0)->get()->count();
                View::share ( 'user', $this->user);
                View::share ( 'cash', $cash['cash']);
                View::share ( 'users_num', $users_num);
                View::share ( 'products_num', $products_num);
                View::share ( 'request_num', $request_num);
                View::share ( 'mileage_count', $mileage_count);
                View::share ( 'game_requests_count', $game_requests_count);
                View::share ( 'new_game_count', $new_game_count);
                View::share ( 'buy_lists_count', $buy_lists_count);
                View::share ( 'notice_count' , $notice_count);
            }
            return $next($request);
        });


    }
}
