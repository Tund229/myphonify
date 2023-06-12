<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class RechargeController extends Controller
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
    public function my_recharges(){
        $title = "Mes recharges";
        $countries_count = Country::where('state', true)->count();
        return view('recharges.my-recharges', compact('title', 'countries_count'));
    }


    //purchase-numbers
    // public function purchase_numbers($id = null){
    //     $title = "Acheter un numéro";
    //     $countries = Country::where('state', true)->get();
    //     $countries_count = Country::where('state', true)->count();
    //     return view('numbers.purchase-numbers', compact('title', 'countries', 'countries_count', 'id'));
    // }
}
