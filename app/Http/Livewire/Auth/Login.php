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
            'email' => '',
            'password' => '',
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
            if($user['is_admin'] != 0){
                return $this->addError('email', trans('잘못된 접근입니다.'));
            }

            if($user['state'] == 2 || $user['state'] == 3){
                auth()->logout();
                if($user['state'] == 2){
                    return $this->addError('email', trans('회원님은 탈퇴한 상태입니다.고객센터 문의주세요.'));
                }
                if($user['state'] == 3){
                    return $this->addError('email', trans('불법행위로 인해 탈퇴되었습니다.고객센터 문의주세요.'));
                }
            }
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
