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
                $games = MMygame::orderBy('order','ASC')->limit(3)->get();
                $msg_count = MInbox::where('userId',$this->user->id)->where('readed',0)->get()->count();
                View::share('top_role',$role);
                View::share('top_buying_register',$buying_register);
                View::share('top_selling_register',$selling_register);
                View::share('top_bargain_request',$bargain_request);
                View::share('top_games',$games);
                View::share ( 'me', $this->user );
                View::share('msg_count',$msg_count);
            }
            return $next($request);
        });


    }
}
