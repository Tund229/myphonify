<?php

namespace App\Http\Controllers;

use App\Models\Number;
use App\Models\Country;
use App\Models\TempPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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


    //temp_purchase
    public function temp_purchase(Request $request)
    {
        $data = $request->validate([
            'country_id' => ['required'],
            'service' => ['required'],
        ]);
        $amount = Auth::user()->account_balance;
        $country = Country::where('id', $data['country_id'])->first();
        $service = $data['service'];
        $country_price = 'price'.'_'.$service;
        $price = $country->$country_price;
        if($amount >=   $price) {
            $tempourchase = TempPurchase::create([
                'user_id' => Auth::user()->id,
                'country_id' => $country->id,
                'service' =>   $service,
                'service_price' => $price,
            ]);
        } else {
            $message = "Votre sole est insuffisant !";
            $request->session()->flash('error_message', $message);
            return redirect()->back();
        }
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



    //purchase
    public function purchase(Request $request, $id)
    {
        $tempourchase = TempPurchase::where('id', $id)->first();
        if($tempourchase) {
            $amount = $tempourchase->service_price;
            if(Auth::user()->account_balance >= $amount) {
                $getLastBuys = Number::where('state', ['en cours'])->where('user_id', Auth::user()->id)->count();
                if ($getLastBuys > 0) {
                    $this->message = "Vous avez déjà un achat en cours. Réessayez plus tard !";
                } else {
                    $product = $tempourchase->service;

                    $country = Country::find($tempourchase->country_id);
                    $api_name = $country->api_name->name;
                    $api_key = '36511c1cfe7416f623edc2927eb099dA';
                    $response = Http::get(
                        'https://api.sms-activate.org/stubs/handler_api.php?api_key='.$api_key.'&action=getCountries'
                    );

                    dd($response->json());






                }
            } else {
                $message = "Solde insuffisant, veuillez recharger votre compte";
                dd($message);
            }


        }
        return redirect()->back();
    }
}
