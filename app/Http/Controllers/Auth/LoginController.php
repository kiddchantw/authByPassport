<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Log;
// use Auth;
use Illuminate\Http\Request;
use App\User;
// use Input;
use Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Crypt;
// use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Auth\SessionGuard;


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
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        Log::info('LoginController __construct');
    }


    //自定义用户名#
    // public function username()
    // {
    //     return 'username';
    // }

    /**
     * Handle an authentication attempt.
     * 
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    //https://learnku.com/docs/laravel/7.x/authentication/7474
    public function login(Request $request)
    {
        //m1 直接用orm找 ok 
        // $user = User::where([['name','=',$request->name],['password','=', $request->password]])->first();
        // return $user;

        //m2  ok: model use  bcrypt  encode password
        //m3  ok: model use  Hash::make  encode password

        // $credentials = $request->only('name', 'password');
        // var_dump($credentials);
        //  if (Auth::attempt($credentials)) {
        //     return response()->json(['message' => "login success"], 200);
        // }else{
        //     return response()->json(['error01' => 'invalid name or password'], 401);
        // }


        /*測試區*/
        //m3  passport token ok 
        $credentials = $request->only('name', 'password');
        var_dump($credentials);

        if (Auth::guard()->attempt($credentials)) {
            //return response()->json(['message' => "login success"], 200);
            $user = Auth::user();

            // $token = $user->createToken("myapp");
            $token = $user->createToken($user->name . '-' . now());


            return response()->json([
                'token' => $token->accessToken
            ]);
        } else {
            return response()->json(['error01' => 'invalid name or password'], 401);
        }


    }



    public function logout()
    {
        // m1:web session可直接logout
        //Auth::logout();

        // dd("logout");
        dd(Auth::user()); //->password ) ;

    }

    public function authenticate()
    {
        // m1:session可以用decode password
        // $passwordEncode = Auth::user()->password;
        // dd( $passwordEncode);

        // echo "authenticate";
        // dd(auth()->user());
        dd(Auth::user()); //->password ) ;

        // dd ( Auth::user()->password );// 空的


        // var_dump( password_verify('rasmuslerdorf', $passwordEncode) );
    }


    public function show(Request $request, $userId)
    {

        // if (Auth::guest()) 
        // {
        //     return response()->json(['message' => Auth::guest()], 200);
        // }


        if (Auth::user()->id == $userId) {
            //回傳user info
            //m1: 用auth拿自己的資料    
            // return response()->json(['message' => Auth::user()], 200);

            //m2:用 ORM透過userId取資料，但好像也能拿其他userID看其他人的資料
            $user = User::find($userId);
            if ($user) {
                return response()->json(['message' => $user], 200);
            }
            return response()->json(['message' => 'User not found!'], 404);
        } else {
            //回傳 id error 
            return response()->json(['message' => 'User id error'], 404);
        }
    }
}
