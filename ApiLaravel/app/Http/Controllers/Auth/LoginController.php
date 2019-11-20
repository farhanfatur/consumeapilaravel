<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            ]);
        }else {
            return response()->json(['status' => "Username or Password doesnt match", 'code' => 401]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => "User is logout", 'code' => 200]);
    }
}
