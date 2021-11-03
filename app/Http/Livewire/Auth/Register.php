<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Register extends Component
{

    public $email = '';
    public $nickname = '';
    public $loginId = '';
    public $name = '';
    public $password = '';
    public $passwordConfirmation = '';
    public $sex = '';
    public $mobile = '';
    public $birthday = '';
    public function mount()
    {
        if (auth()->user()) {
            return redirect()->intended('/dashboard');
        }
    }

    public function updatedEmail()
    {
        $this->validate(['email'=>'required|email:rfc,dns|unique:users']);
    }

    public function register()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required|same:passwordConfirmation|min:6',
            'mobile' => 'required',
            'nickname' => 'required|unique:users',
            'loginId' => 'required|unique:users'
        ]);

        $user = User::create([
            'email' =>$this->email,
            'nickname' =>$this->nickname,
            'name' =>$this->name,
            'loginId' =>$this->loginId,
            'sex' =>$this->sex,
            'mobile' =>$this->mobile,
            'birthday' =>$this->birthday,
            'password' => Hash::make($this->password),
            'remember_token' => Str::random(10),
        ]);

        auth()->login($user);

        return redirect('/successful');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
