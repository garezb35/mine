<?php

namespace App\Http\Controllers;

use App\Models\MPopularCharacter;
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
                View::share ( 'user', $this->user);
            }
            return $next($request);
        });


    }
}
