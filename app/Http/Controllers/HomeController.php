<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
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
        $title = "Dashboard" ;
        $countries_count = Country::where('state', true)->count();
        $countries = Country::where('state', true)->get();
        return view('home', compact('title', 'countries_count', 'countries'));
    }

    public function mywallet()
    {
        $title = "Mywallet" ;
        $countries_count = Country::where('state', true)->count();
        return view('mywallet', compact('title', 'countries_count'));
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


    public function update(Request $request){
        dd($request->all());
    }
}
