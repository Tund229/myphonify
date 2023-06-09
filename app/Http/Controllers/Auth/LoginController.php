<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $email = $request["email"];
        $password = $request["password"];
        $user = User::where('email', '=', $email)->first();
        if (!$user) {
            $message = "You don't have an account yet! Please sign up.";
            $request->session()->flash('error_message', $message);
            return redirect()->back();
        } else {
            if (Hash::check($password, $user->password)) {
                if ($user ->status ==  1) {
                    $message = "This account has been blocked. Please contact the administrator.";
                    $request->session()->flash('error_message', $message);
                    return redirect()->back();
                } else {
                    Auth::attempt(['email'=>$email,'password'=>$password]);
                    $user = User::where('email', $email)->first();
                    Auth::login($user);
                    $title = "Dashboard" ;
                    return view('home', compact('title'));
                }
            } else {
                $message = "The password is incorrect.";
                return redirect()->route('login')
                    ->with('state', $message)
                    ->withErrors(['password' =>$message]);
            }
        }


    }


    private function validator()
    {
        return request()->validate([
            'email' => "required|email|unique:users",
            'password' => "required",
        ]);
    }
}
