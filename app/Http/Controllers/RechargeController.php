<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
    public function my_recharges()
    { 
        $title = "Mes recharges";
        $countries_count = Country::where('state', true)->count();
        $id = Auth::user()->id;
        $recharges = Recharge::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        Auth::user()->restoreState();
        Auth::user()->calcAmount();
        return view('recharges.my-recharges', compact('title', 'countries_count', 'recharges'));
    }


    private function validator()
    {
        return request()->validate([
            'transaction_id' => ["required"],
        ]);
    }

    public function recharge(Request $request)
    {
        $data = $this->validator();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer sk_live_pSMriVywigAJteNV_-1PPtJX'
        ])->get('https://sandbox-api.fedapay.com/v1/transactions/' . $data['transaction_id']);
        $rep = $response->json();
        if (array_key_exists("v1/transaction",$rep)){
            $rep = $rep['v1/transaction'];
            if ($rep['status'] == "approved" or $rep['status'] == "transferred" ){
                $recharge = Recharge::create(['user_id' =>Auth::user()->id, 'amount' => $rep['amount'], 'state' => "validé", "name"=>Auth::user()->name]);
                Auth::user()->calcAmount();
                return "approved";
            }else {
                return "failed";
            }
        }else{
            return "failed";
        }
    }
}
