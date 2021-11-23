<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard(){
        return view('admin.dashboard');
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
}
