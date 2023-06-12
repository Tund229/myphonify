<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountriesController extends Controller
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

    public function countries_list(){
        $title = "Available Countries";
        $countries = Country::where('state', true)->get();
        $countries_count = Country::where('state', true)->count();
        return view('countries.countries-list', compact('title', 'countries', 'countries_count'));
    }
}
