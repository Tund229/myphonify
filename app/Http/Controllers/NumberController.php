<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\TempPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function my_numbers()
    {

        $title = "Mes numéros";
        $countries_count = Country::where('state', true)->count();
        return view('numbers.my-numbers', compact('title', 'countries_count'));
    }


    //purchase-numbers
    public function purchase_numbers($id = null)
    {
        $title = "Acheter un numéro";
        $countries = Country::where('state', true)->get();
        $countries_count = Country::where('state', true)->count();
        $temppurchase = TempPurchase::where('state', true)->get();
        return view('numbers.purchase-numbers', compact('title', 'countries', 'countries_count', 'id', 'temppurchase'));
    }


    //purchase
    public function purchase(Request $request)
    {
        $data = $request->validate([
            'country_id' => ['required'],
            'service' => ['required'],
        ]);
        $service = $data['service'];
        $country = Country::where('id', $data['country_id'])->first();

        $country_price = 'price'.'_'.$service;
        $price = $country->$country_price;

        $tempourchase = TempPurchase::create([
            'user_id' => Auth::user()->id,
            'country_id' => $country->id,
            'service' =>   $service,
            'service_price' => $price,
        ]);
        return redirect()->back();
    }


    // purchase_delete

    public function purchase_delete($id)
    {
        $tempourchase = TempPurchase::where('id', $id)->first();
        if($tempourchase) {
            $tempourchase->delete();
        }
        return redirect()->back();
    }
}
