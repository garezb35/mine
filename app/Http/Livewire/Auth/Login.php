<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;

class Login extends Component
{

    public $email = '';
    public $password = '';
    public $remember_me = false;
    private $apiToken;
    protected $rules = [
        'email' => 'required|email:rfc,dns',
        'password' => 'required|min:6',
    ];

    //This mounts the default credentials for the admin. Remove this section if you want to make it public.
    public function mount()
    {
        if (auth()->user()) {
            return redirect()->intended('/index');
        }
        $this->fill([
            'email' => 'admin@volt.com',
            'password' => 'secret',
        ]);
    }

    public function login()
    {
        $credentials = $this->validate();
        if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            $this->apiToken = Str::random(60);
            $user = User::where(['email' => $this->email])->first();
            auth()->login($user, $this->remember_me);
            User::where("id",$user->id)
                ->update([
                    "api_token"=>$this->apiToken,
                ]);
            return redirect()->intended('/index');
        } else {
            return $this->addError('email', trans('auth.failed'));
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
