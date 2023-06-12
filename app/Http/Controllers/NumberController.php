<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class NumberController extends Controller
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


    // my-numbers function 
    public function my_numbers(){
        $title = "My Numbers";
        $countries_count = Country::where('state', true)->count();
        return view('numbers.my-numbers', compact('title', 'countries_count'));
    }


    //purchase-numbers
    public function purchase_numbers($id = null){
        $title = "Purchase Numbers";
        $countries = Country::where('state', true)->get();
        $countries_count = Country::where('state', true)->count();
        return view('numbers.purchase-numbers', compact('title', 'countries', 'countries_count', 'id'));
    }
}
