<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Number;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numbers = Number::all();
        $title = "Liste des numéros" ;
        $countries_count = Country::where('state', true)->count();
        return view('private.numbers.index', compact('numbers', 'title', 'countries_count'));
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
        $number = Number::where('id', $id)->first();
        $title = "Détails Numéros" ;
        $countries_count = Country::where('state', true)->count();
        return view('private.numbers.show', compact('number', 'title', 'countries_count'));
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
        //
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



    //block number
    public function block($id)
    {
        $number = Number::where('id', $id)->first();
        if($number) {
            $number->update([
                'state' => 'echoué'
            ]);
        }
        // Auth::user()->restoreState();
        // Auth::user()->calcAmount();

        $getUser = User::where('id', $number->user_id)->first();
        $getUser->calcAmount();
        $getUser->restoreState();
        return redirect()->back();

    }

    //unblock number
    public function unblock($id)
    {
        $number = Number::where('id', $id)->first();
        if($number) {
            $number->update([
                'state' => 'validé'
            ]);
        }
        $getUser = User::where('id', $number->user_id)->first();
        $getUser->calcAmount();
        $getUser->restoreState();
        return redirect()->back();
    }
}
