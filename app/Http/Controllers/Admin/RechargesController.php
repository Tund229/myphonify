<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Country;
use App\Models\Recharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RechargesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recharges = Recharge::all();
        $title = "Liste des recharges" ;
        $countries_count = Country::where('state', true)->count();
        $users = User::where('status', 0)->get();
        return view('private.recharges.index', compact('recharges', 'title', 'countries_count', 'users'));
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
        $data = $this->validator();
        $user = User::where('id', $data['user_id'])->first();
        $recharge = Recharge::create(['user_id' => $user->id, 'amount' => $data['amount'], 'state' => "validé"]);
        $user->calcAmount();
        $user->restoreState();
        return redirect()->back();
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


    private function validator()
    {
        $customMessages = [
            'required' => "Veuillez remplir ce champ.",
            'same' => 'Les mots de passe ne correspondent pas.',
            'min' => 'Ce champ doit contenir au moins :min caractères',
            'max' => 'Ce champ doit contenir au plus :max caractères ',
        ];
        return request()->validate([
            'user_id' => ["required", function ($attribute, $value, $fail) {
                if (User::where('id', $value)->first() == null) {
                    $fail("Utilisateur non trouvé");
                }
            }],
            'amount' => ["required", "integer"],
        ], $customMessages);
    }

    //block recharges
    public function block($id)
    {

        $recharge = Recharge::where('id', $id)->first();
        if($recharge) {
            $recharge->update([
                'state' => 'echoué'
            ]);
        }
        $getUser = User::where('id', $recharge->user_id)->first();
        $getUser->calcAmount();
        $getUser->restoreState();
        return redirect()->back();

    }

    //unblock recharges
    public function unblock($id)
    {
        $recharge = Recharge::where('id', $id)->first();
        if($recharge) {
            $recharge->update([
                'state' => 'validé'
            ]);
        }
        $getUser = User::where('id', $recharge->user_id)->first();
        $getUser->calcAmount();
        $getUser->restoreState();
        return redirect()->back();
    }




}
