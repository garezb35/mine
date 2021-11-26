<?php

namespace App\Http\Controllers;

use App\Models\MGame;
use Illuminate\Http\Request;

class VGameinfoController extends Controller
{
    public function money(Request $request){
        $game = MGame::with('twegames')->orderBy('order','ASC')->get();
        return view('mania.game_info.index',['game'=>$game]);
    }
}
