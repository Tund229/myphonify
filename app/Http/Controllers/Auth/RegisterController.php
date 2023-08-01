<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $customMessages = [
            'accepted' => "Vous devez accepter les conditions d'utilisation",
            'min'=> 'Ce champ doit contenir au moins',
            'max'=> 'Ce champ doit contenir au plus:'
        ];
        return Validator::make($data, [
            'name' => [function ($attribute, $value, $fail) {
                if (empty($value)) {
                    $fail('Veuillez remplir ce champ');
                } else {
                    $user = User::where('name', $value)->first();
                    if ($user) {
                        $fail("Le nom d'utilisateur est déjà utilisée.");
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
                    $user = User::where('email', $value)->first();
                    if ($user) {
                        $fail("L'adresse e-mail est déjà utilisée.");
                    }
                }
            }],


            'password' => [function ($attribute, $value, $fail) {
                if (empty($value)) {
                    $fail('Veuillez remplir ce champ');
                }
            }, 'string', 'min:8'],
            'terms' => ['accepted'],
        ],  $customMessages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $identifiant = mt_rand(10000000, 99999999);
        $name = $data['name'];
        if (!ctype_alnum($name)) {
            $name_array = str_split($name);
            foreach ($name_array as $valeur) {
                if (!ctype_alnum($valeur)) {
                    $interdit=array($valeur, '.');
                    $name = implode($name_array);
                    $name = str_replace($interdit, "", $name);
                }
            }
        }
        return User::create([
            'name' => $name,
            'identifiant'=> $identifiant,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
