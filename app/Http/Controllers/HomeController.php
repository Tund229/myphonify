<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Recharge;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PasswordResetNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome', 'privacy_terms', 'forgot_password', 'forgoted_password' , 'change_password', 'changed_password']);
    }



    public function welcome()
    {
        return view('welcome');
    }

    public function privacy_terms()
    {
        return view('privacy-terms');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Dashboard" ;
        $countries_count = Country::where('state', true)->count();
        $countries = Country::where('state', true)->get();
        Auth::user()->restoreState();
        Auth::user()->calcAmount();
        return view('home', compact('title', 'countries_count', 'countries'));
    }

    public function mywallet()
    {
        $id = Auth::user()->id;
        $title = "Mywallet" ;
        $countries_count = Country::where('state', true)->count();
        $recharges = Recharge::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        Auth::user()->restoreState();
        Auth::user()->calcAmount();
        return view('mywallet', compact('title', 'countries_count', 'recharges'));
    }

    public function partners(){
        $id = Auth::user()->id;
        $title = "Gagner de l'argent" ;
        $countries_count = Country::where('state', true)->count();
        Auth::user()->restoreState();
        Auth::user()->calcAmount();
        return view('partners.index', compact('title', 'countries_count'));
    }

    public function profile()
    {
        $title = "Mon Profil" ;
        $id = Auth::user()->id;
        $countries_count = Country::where('state', true)->count();
        $user = User::where('id', $id)->first();
        return view('profile', compact('title', 'countries_count', 'user'));
    }


    public function profile_update()
    {
        $title = "Modifier Profil" ;
        $id = Auth::user()->id;
        $countries_count = Country::where('state', true)->count();
        $user = User::where('id', $id)->first();
        return view('profile-update', compact('title', 'countries_count', 'user'));
    }


    public function password_update()
    {
        $title = "Sécurité Profil" ;
        $id = Auth::user()->id;
        $countries_count = Country::where('state', true)->count();
        $user = User::where('id', $id)->first();
        return view('update-password', compact('title', 'countries_count', 'user'));
    }


    public function update(Request $request)
    {
        $data= $request->validate([

            'name' => [function ($attribute, $value, $fail) {
                if (empty($value)) {
                    $fail('Veuillez remplir ce champ');
                } else {
                    if (!ctype_alnum($value)) {
                        $fail("alphanumerique, sans espace, @, +, #, ...");
                    }
                    if (!(User::where('name', $value)->where('name', '<>', Auth::user()->name)->get()->isEmpty())) {
                        $fail("Ce nom d'utilisateur existe déjà");
                    }
                }
            }, 'string', 'max:255'],


            'email' => [function ($attribute, $value, $fail) {
                if (empty($value)) {
                    $fail('Veuillez remplir ce champ');
                }
            }, 'email', 'max:255', function ($attribute, $value, $fail) {
                if (empty($value)) {
                    $fail('Veuillez remplir ce champ');
                } else {
                    if (!(User::where('email', $value)->where('email', '<>', Auth::user()->email)->get()->isEmpty())) {
                        $fail("Cet email a déjà été enrégistré");
                    }
                }
            }],

            'password' => [function ($attribute, $value, $fail) {
                if (empty($value)) {
                    $fail('Veuillez remplir ce champ');
                } else {
                    if (Hash::check($value, Auth::user()->password)) {
                    } else {
                        $fail('Votre mot de passe est incorrect');
                    }
                }
            }, 'string', 'min:8'],

            ]);

        $user = User::where('id', Auth::user()->id)->first();
        $user->update([
        "name" => $data['name'],
        'email' => $data['email']
        ]);
        $message = "Vos informations ont été modifiées avec succès";
        $request->session()->flash('status', $message);
        return redirect()->back();
    }


    public function password_updated(Request $request)
    {
        $customMessages = [
            'required' => "Veuillez remplir ce champ.",
            'same'=> 'Les mots de passe ne correspondent pas.',
            'min'=> 'Ce champ doit contenir au moins :min caractères',
            'max'=> 'Ce champ doit contenir au plus :max caractères '
        ];
        $data= $request->validate([
            'new_password' => ['required', 'string',  'max:255', 'min:8'],
            'new_password_confirmation' => ['required', 'string',  'max:255', 'min:8', 'same:new_password'],
            'old_password'  => ['required', 'string' ,function ($attribute, $value, $fail) {
                if (Hash::check($value, Auth::user()->password)) {
                } else {
                    $fail('Votre mot de passe est incorrect');
                }
            }]
        ], $customMessages);
        $user = User::where('id', Auth::user()->id)->first();
        $user->update(["password" => Hash::make($data['new_password'])]);
        $message = "Votre mot de passe a été modifié avec succès";
        $request->session()->flash('status', $message);

        return redirect()->back();
    }


    public function forgot_password()
    {
        return view('forgot-password');
    }


    public function forgoted_password(Request $request)
    {

        $customMessages = [
            'required' => "Veuillez remplir ce champ.",
        ];
        $data= $request->validate([
            'email' => ['required', 'email',  'max:255',function ($attribute, $value, $fail) {
                $user = User::where('email', $value)->first();
                if(!$user) {
                    $fail('Votre email est invalide.. Réessayez!');
                }
            }],
        ], $customMessages);
        $token = random_int(100000, 999999);
        $userPasstoken = PasswordReset::where('email', $data['email'])->first();
        $user = User::where('email', $data['email'])->first();
        if (!$userPasstoken) {
            PasswordReset::create([
                'email'=> $data['email'],
                'token'=> $token,
            ]);

            $user-> notify(new PasswordResetNotification($token, $user));
            $message = "Le code de réinitialisation a été envoyée avec succès. Veuillez verifier vos emails !";
            $request->session()->flash('status', $message);
            return redirect()->back();

        } else {
            PasswordReset::where('email', $data['email'])->delete();
            PasswordReset::create([
                'email'=> $data['email'],
                'token'=> $token,
            ]);
            $user-> notify(new PasswordResetNotification($token, $user));

            $message = "Le code de réinitialisation a été envoyée avec succès. Veuillez verifier vos emails !";
            $request->session()->flash('status', $message);
            return redirect()->back();
        }

    }



    public function change_password()
    {
        return view('change-password');
    }


    public function changed_password(Request $request, $id)
    {
        $user = User::where('identifiant', $id)->first();
        if ($user) {
            $user_email = $user->email;
    
            $customMessages = [
                'required' => "Veuillez remplir ce champ.",
                'same' => 'Les mots de passe ne correspondent pas.',
                'min' => 'Ce champ doit contenir au moins :min caractères',
                'max' => 'Ce champ doit contenir au plus :max caractères ',
            ];
    
            $data = $request->validate([
                'code_validation' => ['required', function ($attribute, $value, $fail) use ($user_email) {
                    $token = PasswordReset::where('token', $value)->where('email', $user_email)->first();
                    if (!$token) {
                        $fail('Votre code est invalide.. Réessayez!');
                    }
                }],
                'password' => ['required', 'string', 'max:255', 'min:8'],
                'password_confirmation' => ['required', 'string', 'max:255', 'min:8', 'same:password'],
            ], $customMessages);
    
            $token = PasswordReset::where('token', $data['code_validation'])->where('email', $user_email)->first();
    
            if ($token->created_at < now()->subMinute(30)) {
                $message = "Le code de réinitialisation a été expiré!";
                $request->session()->flash('status', $message);
                return redirect('forgot-password');
            } else {
                $user->update([
                    "password" => Hash::make($data['password']),
                ]);
                PasswordReset::where('email', $user->email)->delete();
                $message = "Le mot de passe a été modifiée avec succès. Vous pouvez vous connectez!";
                $request->session()->flash('status', $message);
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        }
    }
    
}
