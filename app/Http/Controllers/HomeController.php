<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //  $countries = ["Afghanistan" => "Afghanistan", "Afrique du Sud" => "South Africa", "Albanie" => "Albania", "Algérie" => "Algeria", "Allemagne" => "Germany", "Andorre" => "Andorra", "Angola" => "Angola", "Antigua-et-Barbuda" => "Antigua and Barbuda", "Arabie Saoudite" => "Saudi Arabia", "Argentine" => "Argentina", "Arménie" => "Armenia", "Australie" => "Australia", "Autriche" => "Austria", "Azerbaïdjan" => "Azerbaijan", "Bahamas" => "Bahamas", "Bahreïn" => "Bahrain", "Bangladesh" => "Bangladesh", "Barbade" => "Barbados", "Belgique" => "Belgium", "Belize" => "Belize", "Bénin" => "Benin", "Bhoutan" => "Bhutan", "Biélorussie" => "Belarus", "Birmanie" => "Myanmar", "Bolivie" => "Bolivia", "Bosnie-Herzégovine" => "Bosnia and Herzegovina", "Botswana" => "Botswana", "Brésil" => "Brazil", "Brunei" => "Brunei", "Bulgarie" => "Bulgaria", "Burkina Faso" => "Burkina Faso", "Burundi" => "Burundi", "Cambodge" => "Cambodia", "Cameroun" => "Cameroon", "Canada" => "Canada", "Cap-Vert" => "Cape Verde", "Centrafrique" => "Central African Republic", "Chili" => "Chile", "Chine" => "China", "Chypre" => "Cyprus", "Colombie" => "Colombia", "Comores" => "Comoros", "République du Congo" => "Republic of the Congo", "République démocratique du Congo" => "Democratic Republic of the Congo", "Corée du Nord" => "North Korea", "Corée du Sud" => "South Korea", "Costa Rica" => "Costa Rica", "Côte d’Ivoire" => "Ivory Coast", "Croatie" => "Croatia", "Cuba" => "Cuba", "Danemark" => "Denmark", "Djibouti" => "Djibouti", "Dominique" => "Dominica", "Égypte" => "Egypt", "Émirats arabes unis" => "United Arab Emirates", "Équateur" => "Ecuador", "Érythrée" => "Eritrea", "Espagne" => "Spain", "Estonie" => "Estonia", "États-Unis" => "United States", "Éthiopie" => "Ethiopia", "Fidji" => "Fiji", "Finlande" => "Finland", "France" => "France", "Gabon" => "Gabon", "Gambie" => "Gambia", "Géorgie" => "Georgia", "Ghana" => "Ghana", "Grèce" => "Greece", "Grenade" => "Grenada", "Guatemala" => "Guatemala", "Guinée" => "Guinea","Géorgie" => "Georgia", "Ghana" => "Ghana", "Grenade" => "Grenada", "Guatemala" => "Guatemala", "Guinée" => "Guinea", "Guinée équatoriale" => "Equatorial Guinea", "Guinée-Bissau" => "Guinea-Bissau", "Guyana" => "Guyana", "Haïti" => "Haiti", "Honduras" => "Honduras", "Hongrie" => "Hungary", "Îles Marshall" => "Marshall Islands", "Inde" => "India", "Indonésie" => "Indonesia", "Iran" => "Iran", "Iraq" => "Iraq", "Irlande" => "Ireland", "Islande" => "Iceland", "Israël" => "Israel", "Italie" => "Italy", "Jamaïque" => "Jamaica", "Japon" => "Japan", "Jordanie" => "Jordan", "Kazakhstan" => "Kazakhstan", "Kenya" => "Kenya", "Kirghizistan" => "Kyrgyzstan", "Kiribati" => "Kiribati", "Koweït" => "Kuwait", "Laos" => "Laos", "Lesotho" => "Lesotho", "Lettonie" => "Latvia", "Liban" => "Lebanon", "Libéria" => "Liberia", "Libye" => "Libya", "Liechtenstein" => "Liechtenstein", "Lituanie" => "Lithuania", "Luxembourg" => "Luxembourg", "Macédoine" => "Macedonia", "Madagascar" => "Madagascar", "Malaisie" => "Malaysia", "Malawi" => "Malawi", "Maldives" => "Maldives", "Mali" => "Mali", "Malte" => "Malta", "Maroc" => "Morocco", "Maurice" => "Mauritius", "Mauritanie" => "Mauritania", "Mexique" => "Mexico", "Micronésie" => "Micronesia", "Moldavie" => "Moldova", "Monaco" => "Monaco", "Mongolie" => "Mongolia", "Monténégro" => "Montenegro", "Mozambique" => "Mozambique", "Myanmar" => "Myanmar", "Namibie" => "Namibia", "Nauru" => "Nauru", "Népal" => "Nepal", "Nicaragua" => "Nicaragua", "Niger" => "Niger", "Nigeria" => "Nigeria", "Niue" => "Niue", "Norvège" => "Norway", "Nouvelle-Zélande" => "New Zealand", "Oman" => "Oman", "Ouganda" => "Uganda", "Ouzbékistan" => "Uzbekistan", "Palau" => "Palau", "Panama" => "Panama", "Papouasie-Nouvelle-Guinée" => "Papua New Guinea", "Paraguay" => "Paraguay", "Pays-Bas" => "Netherlands", "Pérou" => "Peru", "Philippines" => "Philippines", "Pologne" => "Poland", "Portugal" => "Portugal", "Qatar" => "Qatar", "République centrafricaine" => "Central African Republic", "République démocratique du Congo" => "Democratic Republic of the Congo", "République dominicaine" => "Dominican Republic", "République tchèque" => "Czech Republic", "Roumanie" => "Romania", "Royaume-Uni" => "United Kingdom", "Russie" => "Russia", "Rwanda" => "Rwanda", "Saint-Christophe-et-Niévès" => "Saint Kitts and Nevis", "Saint-Marin" => "San Marino", "Saint-Vincent-et-les Grenadines" => "Saint Vincent and the Grenadines", "Sainte-Lucie" => "Saint Lucia", "Salomon, Îles" => "Solomon Islands", "Salvador" => "El Salvador", "Samoa" => "Samoa", "Sao Tomé-et-Principe" => "Sao Tome and Principe", "Sénégal" => "Senegal", "Serbie" => "Serbia", "Seychelles" => "Seychelles", "Sierra Leone" => "Sierra Leone", "Singapour" => "Singapore", "Slovaquie" => "Slovakia", "Slovénie" => "Slovenia", "Somalie" => "Somalia", "Soudan" => "Sudan", "Soudan du Sud" => "South Sudan", "Sri Lanka" => "Sri Lanka", "Suède" => "Sweden", "Suisse" => "Switzerland", "Suriname" => "Suriname", "Swaziland" => "Eswatini", "Syrie" => "Syria", "Tadjikistan" => "Tajikistan", "Tanzanie" => "Tanzania", "Tchad" => "Chad", "Tchéquie" => "Czech Republic", "Thaïlande" => "Thailand", "Timor-Leste" => "Timor-Leste", "Togo" => "Togo", "Tonga" => "Tonga", "Trinité-et-Tobago" => "Trinidad and Tobago", "Tunisie" => "Tunisia", "Turkménistan" => "Turkmenistan", "Turquie" => "Turkey", "Tuvalu" => "Tuvalu", "Ukraine" => "Ukraine", "Uruguay" => "Uruguay", "Vanuatu" => "Vanuatu", "Venezuela" => "Venezuela", "Vietnam" => "Vietnam", "Yémen" => "Yemen", "Zambie" => "Zambia", "Zimbabwe" => "Zimbabwe"];
        //     $count = 0;
        //     foreach ($countries as $fr => $en) {
        //         $pays = Country::where('name', $fr)->first();
        //         if ($pays) {
        //             $pays->update(["en_name" => $en]) ;
        //         }
        //     }
        //     foreach ($countries as $fr => $en) {
        //         $pays = Country::where('name', $en)->first();
        //         if ($pays) {
        //             $pays->update(["en_name" => $en]) ;
        //         }
        //     }

        // $countries = Country::where('state', true)->get();
        // $countries->update(['api_name'=> 1]);

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
        $recharges = Recharge::where('user_id', $id)->get();
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
        dd($request->all());
    }
}
