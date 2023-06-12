<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

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
    {    $title = "Mywallet" ;
        $countries_count = Country::where('state', true)->count();
        return view('mywallet', compact('title','countries_count'));
    }
}
