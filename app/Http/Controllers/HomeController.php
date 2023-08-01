<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome', 'privacy_terms']);
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
        return view('home', compact('title', 'countries_count', 'countries'));
    }

    public function mywallet()
    {
        $id = Auth::user()->id;
        $title = "Mywallet" ;
        $countries_count = Country::where('state', true)->count();
        $recharges = Recharge::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('mywallet', compact('title', 'countries_count', 'recharges'));
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
}
