<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Number;
use App\Models\Country;
use App\Models\Recharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numbers = Number::all();
        $recharges = Recharge::where('user_id', '<>',1)->where('user_id', '<>',3)->get();
        $users = User::where('role', 'user')->get();
        $title = "Stats" ;
        $countries_count = Country::where('state', true)->count();
        $numbers_valide = Number::where('user_id', '<>',1)->where('user_id', '<>',3)->where('state', 'validé')->get();
        $numbers_en_cours = Number::where('user_id', '<>',1)->where('user_id', '<>',3)->where('state', 'en cours')->count();
        $numbers_echoue = Number::where('user_id', '<>',1)->where('user_id', '<>',3)->where('state', 'echoué')->count();
        Auth::user()->restoreState();
        Auth::user()->calcAmount();
        return view('private.stats.index', compact('numbers', 'title', 'countries_count', 'recharges', 'users', 'numbers_valide', 'numbers_en_cours', 'numbers_echoue'));
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
        //
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
}
