<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    private $apiToken;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */



    public function authenticate(Request $request){
        // Retrive Input
        $credentials = $request->only('loginId', 'password');
        // $credentials["user_type"] = "01";
        if (Auth::attempt($credentials)) {
            // if success login

            return redirect()->intended('/');

            //return redirect()->intended('/details');
        }
        // if failed login
        return redirect('login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'loginId';
    }

    public function process_login(Request $request)
    {

        $this->validateLogin($request);
        $request->validate([
            'loginId' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);
        if (auth()->attempt($credentials)) {
            $this->apiToken = Str::random(60);
            $user = User::where(['loginId' => $request->loginId])->first();
//            auth()->login($user, $this->remember_me);
            User::where("id",$user->id)
                ->update([
                    "api_token"=>$this->apiToken,
                ]);
            if($user['is_admin'] != 0){
                return $this->sendFailedLoginResponse($request,'잘못된 접근입니다.',false);
            }

            if($user['state'] == 2 || $user['state'] == 3){
                auth()->logout();
                if($user['state'] == 2){
                    return $this->sendFailedLoginResponse($request,'회원님은 탈퇴한 상태입니다.고객센터 문의주세요.',false);
                }
                if($user['state'] == 3){
                    return $this->sendFailedLoginResponse($request,'불법행위로 인해 탈퇴되었습니다.고객센터 문의주세요.',false);
                }
            }
            return redirect()->intended('/index');
        } else {
            return $this->sendFailedLoginResponse($request,'잘못된 시도입니다.',false);
        }
    }

    public function logout(Request $request)
    {
        if(Auth::check()){
          $user = Auth::user();
          $user->api_token = "";
          $user->save();
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('default');
    }
    protected function sendFailedLoginResponse(Request $request ,$msg = "아이디 또는 비밀번호가 일치하지 않습니다.",$auth = true)
    {

        if($auth){
            if (!User::where('loginId', $request->loginId)->first()) {
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([
                        "failed" => $msg,
                    ]);
            }

            if (!User::where('loginId', $request->loginId)->where('password', bcrypt($request->password))->first()) {
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([
                        'failed' => $msg,
                    ]);
            }
        }

        else{
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'failed' => $msg,
                ]);
        }
    }
}
