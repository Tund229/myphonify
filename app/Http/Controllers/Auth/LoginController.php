<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Country;
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
    private function validator(Request $request)
    {
        return request()->validate([
            'email' => [function ($attribute, $value, $fail) {
                if (empty($value)) {
                    $fail('Veuillez remplir ce champ');
                }
            },'string', 'email', 'max:255'],
            'password' => [ function ($attribute, $value, $fail) {
                if (empty($value)) {
                    $fail('Veuillez remplir ce champ');
                }
            }],
        ]);
    }

    public function login(Request $request)
    {
        $this->validator($request);

        $email = $request["email"];
        $password = $request["password"];
        $user = User::where('email', '=', $email)->first();
        if (!$user) {
            $message = "Vous n'avez pas encore de compte ! Veuillez vous inscrire.";
            $request->session()->flash('error_message', $message);
            return redirect()->back();
        } else {
            if (Hash::check($password, $user->password)) {
                if ($user ->status ==  1) {
                    $message = "Cet compte a été bloqué. Veuillez contacter le service.";
                    $request->session()->flash('error_message', $message);
                    return redirect()->back();
                } else {
                    Auth::attempt(['email'=>$email,'password'=>$password]);
                    $user = User::where('email', $email)->first();
                    Auth::login($user);
                    $title = "Dashboard" ;
                    $countries_count = Country::where('state', true)->count();

                    return redirect()->route('home')->with(compact('title', 'countries_count'));

                }
            } else {
                $message = "Le mot de passe est incorrect.";
                return redirect()->route('login')
                    ->with('state', $message)
                    ->withErrors(['password' =>$message]);
            }
        }


    }



}
