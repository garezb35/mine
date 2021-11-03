<?php

namespace App\Http\Controllers;

use App\Models\MChgame;
use App\Models\MGame;
use App\Models\MPopularCharacter;
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
            if (Auth::check()) {
                $this->isLogged = true;
                $this->user = Auth::user();
            }
            return $next($request);
        });

        $this->game = MPopularCharacter::with('game')->get()->toArray();
        View::share ( 'popular', $this->game );
    }
}
