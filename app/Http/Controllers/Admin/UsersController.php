<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Number;
use App\Models\Country;
use App\Models\Recharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', 0)->get();
        $title = "Liste des utilisateurs" ;
        $countries_count = Country::where('state', true)->count();
        return view('private.users.index', compact('users', 'title', 'countries_count'));
    }


        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $title = "Détails utilisateur" ;
        $countries_count = Country::where('state', true)->count();
        return view('private.users.show', compact('user', 'title', 'countries_count'));

    }

    //block user
    public function block($id)
    {
        $user = User::where('id', $id)->first();
        if($user) {
            $user->update([
                'status' => 1
            ]);
        }

        return redirect()->back();

    }

     //unblock user
     public function unblock($id)
     {
         $user = User::where('id', $id)->first();
         if($user) {
             $user->update([
                 'status' => 0
             ]);
         }
         return redirect()->back();
     }

     //reset password
     public function reset_password($id)
     {

         $user = User::where('id', $id)->first();
         if($user) {
             $user->update([
                 'password' => Hash::make('Myphonify')
             ]);
         }
         return redirect()->back();
     }



          //user recharges
          public function user_recharges($id)
          {
              $title = "Recharges utilisateur" ;
              $countries_count = Country::where('state', true)->count();
              $recharges = Recharge::where('user_id', $id)->get();
              return view('private.users.recharges', compact('recharges', 'title', 'countries_count'));
          }


          public function user_numbers($id)
          {
              $title = "Numéros utilisateur" ;
              $countries_count = Country::where('state', true)->count();
              $numbers = Number::where('user_id', $id)->get();
              return view('private.users.numbers', compact('numbers', 'title', 'countries_count'));
          }






}
