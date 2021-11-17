<?php

namespace App\Http\Controllers;

use App\Models\MGame;
use App\Models\MItem;
use Illuminate\Http\Request;

class VChrController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * how the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chr = array();
        $sub_games = array();
        $games = MGame::where('character_enabled',1)->where('depth' ,0)->get()->toArray();
        $chr['games'] = $games;
        foreach($games as $key=>$item){
            if($key == 4) break;
            $sub_games[$item['id']] = MItem::with(['game','server'])->where('status',0)->where('type','sell')->whereNull('toId')->where('game_code',$item['id'])->where('user_goods','character')->orderBy('created_at',"DESC")->limit(12)->get()->toArray();
        }

        $chr['sub_game'] = $sub_games;
        return view('mania.chr.main',$chr);
    }
}
