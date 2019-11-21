<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Mail\SendForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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


    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function login(Request $request)
    {
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = Str::random(60);
            $request->user()->forcefill([
                'api_token' => hash('sha256', $token),
            ])->save();
            return response()->json([
                'status' => 'login successfully',
                'token' => $token,
                'code' => 200,
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
            ]);
        }else {
            return response()->json(['status' => "Username or Password doesnt match", 'code' => 401]);
        }
    }

    public function existemail(Request $request)
    {
        if(empty($request->email)) {
            return response()->json(['status' => 'Data is empty']);    
        }else {
            $user = User::where('email', $request->email)->get();
            return response()->json(['status' => 'Email is received, please check it', 'user' =>  $user[0]]);
        }
        
    }

    public function passwordupdate(Request $request)
    {
        if($request->password == $request->password_confirmation) {
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['status' => "Password is changed", 'code' => 200]);
        }else {
            return response()->json(['status' => "Password is not same", 'code' => 401]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => "User is logout", 'code' => 200]);
    }
}
