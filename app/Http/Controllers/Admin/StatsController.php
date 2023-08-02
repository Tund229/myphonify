<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Number;
use App\Models\Country;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->restoreState();
        Auth::user()->calcAmount();
        $numbers = Number::all();
        $recharges = Recharge::where('user_id', '<>', 1)->where('user_id', '<>', 3)->get();
        $users = User::where('role', 'user')->get();
        $title = "Stats" ;
        $countries_count = Country::where('state', true)->count();
        $numbers_valide = Number::where('user_id', '<>', 1)->where('user_id', '<>', 3)->where('state', 'validé')->get();
        $numbers_en_cours = Number::where('user_id', '<>', 1)->where('user_id', '<>', 3)->where('state', 'en cours')->count();
        $numbers_echoue = Number::where('user_id', '<>', 1)->where('user_id', '<>', 3)->where('state', 'echoué')->count();


        // ...
        $chart_users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("month_name"))
        ->orderByRaw('MONTH(created_at)')
        ->pluck('count', 'month_name');

        $chart_recharges = Recharge::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                ->whereYear('created_at', date('Y'))
                ->where('state', 'validé') // Ajouter la condition pour l'état "validé"
                ->groupBy(DB::raw("month_name"))
                ->orderByRaw('MONTH(created_at)')
                ->pluck('count', 'month_name');


        $chart_numbers_achetes = Number::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                ->whereYear('created_at', date('Y'))
                ->where('state', 'validé')
                ->groupBy(DB::raw("month_name"))
                ->orderByRaw('MONTH(created_at)')
                ->pluck('count', 'month_name');

        // Ensemble de mois de référence (tous les mois de l'année)
        $allMonths = collect([
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ]);

        // Combiner les données avec l'ensemble de mois de référence pour chaque type
        $labels = $allMonths->map(function ($month) {
            return $month ;
        });

        $data_users = $allMonths->map(function ($month) use ($chart_users) {
            return $chart_users->has($month) ? $chart_users[$month] : 0;
        });

        $data_recharges = $allMonths->map(function ($month) use ($chart_recharges) {
            return $chart_recharges->has($month) ? $chart_recharges[$month] : 0;
        });

        $data_numbers_achetes = $allMonths->map(function ($month) use ($chart_numbers_achetes) {
            return $chart_numbers_achetes->has($month) ? $chart_numbers_achetes[$month] : 0;
        });

        return view('private.stats.index', compact('numbers', 'title', 'countries_count', 'recharges', 'users', 'numbers_valide', 'numbers_en_cours', 'numbers_echoue', 'labels', 'data_users', 'data_recharges', 'data_numbers_achetes'));

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
