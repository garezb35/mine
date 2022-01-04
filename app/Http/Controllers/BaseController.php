<?php

namespace App\Http\Controllers;

use App\Models\MChgame;
use App\Models\MGame;
use App\Models\MInbox;
use App\Models\MItem;
use App\Models\MMygame;
use App\Models\MPopularCharacter;
use App\Models\MRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

class BaseController extends Controller
{
    public $user;
    public $game;
    public function  __construct()
    {
        $this->isLogged = false;
        $this->game = array();
        $this->middleware(function ($request, $next) {
            $this->game = MPopularCharacter::with('game')->get()->toArray();
            View::share ( 'popular', $this->game );
            $games__home = MGame::where('status',1)->where('depth',0)->orderby('order','ASC')->limit(23)->get()->toArray();
            View::share('games_home',$games__home);
            if (Auth::check()) {
                $this->isLogged = true;
                $this->user = Auth::user();
                $role = MRole::where('level',$this->user->role)->first();
                $point = number_format($this->user->point);
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
                $bargain_request = MItem::
                where('userId',$this->user->id)->
                where('type','sell')->
                where('status',0)->
                whereNull('toId')->
                whereHas('bargain_requests')->
                whereDoesntHave('payitem')->get()->count();
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
                $games = MMygame::orderBy('order','ASC')->limit(3)->get();
                $msg_count = MInbox::where('userId',$this->user->id)->where('readed',0)->get()->count();
                View::share('top_role',$role);
                View::share('top_buying_register',$buying_register);
                View::share('top_selling_register',$selling_register);
                View::share('top_bargain_request',$bargain_request);
                View::share('top_games',$games);
                View::share ( 'me', $this->user );
                View::share('msg_count',$msg_count);
                View::share('top_selling_count',$selling_count);
            }
            return $next($request);
        });


    }
}
