<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // 追加


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    //ユーザー新規登録処理とバリデーション（登録条件）
    public function register(Request $request){
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|min:2|max:12',
                'mail' => 'required|email|unique:users|max:40',
                'password' => 'required|string|min:8|max:20|confirmed|regex:/^[a-zA-Z0-9]+$/',
                'password_confirmation' => 'required|string|min:8|max:20|regex:/^[a-zA-Z0-9]+$/|same:password',
            ]);

            if ($validator->fails()) {
                return redirect('register')
                            ->withErrors($validator)
                            ->withInput();
            }

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);
            //セッションで新規登録したユーザーの名前を表示する機能
            $request->session()->put('username', $username);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
