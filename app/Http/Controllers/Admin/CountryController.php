<?php

namespace App\Http\Controllers\Admin;

use App\Models\Api;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Gestion des pays";
        $countries_count = Country::where('state', true)->count();
        $countries = Country::all();
        return view('private.countries.index', compact('title', 'countries_count', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Gestion des pays";
        $countries_count = Country::where('state', true)->count();
        $country = Country::find($id);
        $apis = Api::all();
        return view('private.countries.show', compact('title', 'countries_count', 'country', 'apis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
       
        $customMessages = [
            'required' => "Veuillez remplir ce champ.",
        ];
        $data = $request->validate([
            'price_whatsapp' => ['required', 'integer'],
            'price_telegram' => ['required','integer'],
            'price_facebook'  => ['required', 'integer'],
            'price_gmail' => ["required",'integer'],
            'price_TikTok' => ["required",'integer'],
            'price_Viber' => ["required",'integer'],
            'price_Signal' => ["required",'integer'],
            'id_whatsapp' => ['required', 'integer'],
            'id_telegram' => ['required', 'integer'],
            'id_facebook'  => ['required', 'integer'],
            'id_gmail' => ["required", "integer"],
            'api_id' => ['required', 'integer'],
        ], $customMessages);

        $country = Country::where('id', $id)->first();
        $update_countries =$country->update([
            "price_whatsapp" => $data['price_whatsapp'],
            "price_telegram" => $data['price_telegram'],
            "price_facebook" => $data['price_facebook'],
            "price_gmail" => $data['price_gmail'],
            "price_TikTok" => $data['price_TikTok'],
            "price_Viber" => $data['price_Viber'],
            "price_Signal" => $data['price_Signal'],
            'id_whatsapp' => $data['id_whatsapp'],
            'id_telegram' => $data['id_telegram'],
            'id_facebook' => $data['id_facebook'],
            'id_gmail' => $data['id_gmail'],
            'api_id' => $data['api_id'],

        ]);

        $message = "Modification enrégistrée avec succès";
        $request->session()->flash('status', $message);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function updateMta($id, Request $request)
    {
        $country = Country::where('id', $id)->first();
        $Mta = $country->Mta;
        if ($Mta == 1) {
            $update_countries =$country->update([
                "Mta" => false,
            ]);
        } elseif ($Mta == 0) {
            $update_countries =$country->update([
                "Mta" => true,
            ]);
        }

        $message = "Mta modifié avec succès";
        $request->session()->flash('status', $message);
        return redirect()->back();
    }


    public function updateState($id, Request $request)
    {
        $country = Country::where('id', $id)->first();
        $state = $country->state;
        if ($state == 1) {
            $update_countries =$country->update([
                "state" => false,
            ]);
        } elseif ($state == 0) {
            $update_countries =$country->update([
                "state" => true,
            ]);
        }



        $message = "Mta modifié avec succès";
        $request->session()->flash('status', $message);
        return redirect()->back();
    }
}
