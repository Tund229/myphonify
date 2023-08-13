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
use Illuminate\Support\Facades\Http;
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
        $admin = User::where('role', 'admin')->where('is_admin', true)->first();
        $recharges = Recharge::where('user_id', '<>', $admin->id)->where('state', 'validé')->get();
        $users = User::where('role', 'user')->get();
        $title = "Stats" ;
        $countries_count = Country::where('state', true)->count();
        $numbers_valide = Number::where('user_id', '<>', $admin->id)->where('state', 'validé')->get();
        $numbers_en_cours = Number::where('user_id', '<>', $admin->id)->where('state', 'en cours')->count();
        $numbers_echoue = Number::where('user_id', '<>', $admin->id)->where('state', 'echoué')->count();



        $chart_users = User::whereYear('created_at', date('Y'))
            ->where('role', '<>', 'admin')
            ->where('is_admin', '<>', true)
            ->groupBy(DB::raw("MONTH(created_at), MONTHNAME(created_at)"))
            ->orderByRaw('MONTH(created_at)')
            ->selectRaw("COUNT(*) as count, MONTHNAME(created_at) as month_name")
            ->pluck('count', 'month_name');

        $chart_recharges = Recharge::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(recharges.created_at) as month_name"), DB::raw("MONTH(recharges.created_at) as month"))
        ->join('users', 'recharges.user_id', '=', 'users.id')
        ->whereYear('recharges.created_at', date('Y'))
        ->where('recharges.state', 'validé')
        ->where('users.is_admin', false)
        ->groupBy(DB::raw("month_name, month"))
        ->orderByRaw('month')
        ->pluck('count', 'month_name');




        $chart_numbers_achetes = Number::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(numbers.created_at) as month_name"))
        ->join('users', 'numbers.user_id', '=', 'users.id')
        ->whereYear('numbers.created_at', date('Y'))
        ->where('numbers.state', 'validé')
        ->where('users.is_admin', false)
        ->groupBy(DB::raw("MONTH(numbers.created_at), MONTHNAME(numbers.created_at)")) // Ajouter la colonne created_at à la clause GROUP BY
        ->orderByRaw('MONTH(numbers.created_at)')
        ->pluck('count', 'month_name');




        $chart_numbers_echoues = Number::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(numbers.created_at) as month_name"))
        ->join('users', 'numbers.user_id', '=', 'users.id')
        ->whereYear('numbers.created_at', date('Y'))
        ->where('numbers.state', 'echoué')
        ->where('users.is_admin', false)
        ->groupBy(DB::raw("MONTH(numbers.created_at), MONTHNAME(numbers.created_at)"))
        ->orderByRaw('MONTH(numbers.created_at)')
        ->pluck('count', 'month_name');

        $chart_recharges_sum = Recharge::select(DB::raw("SUM(amount) as total_recharge"), DB::raw("MONTHNAME(recharges.created_at) as month_name"))
            ->join('users', 'recharges.user_id', '=', 'users.id')
            ->whereYear('recharges.created_at', date('Y'))
            ->where('recharges.state', 'validé')
            ->where('users.is_admin', false)
            ->groupBy(DB::raw("MONTH(recharges.created_at), MONTHNAME(recharges.created_at)"))
            ->orderByRaw('MONTH(recharges.created_at)')
            ->pluck('total_recharge', 'month_name');

        $chart_numbers_sum = Number::select(DB::raw("SUM(amount) as total_number_sum"), DB::raw("MONTHNAME(numbers.created_at) as month_name"))
            ->join('users', 'numbers.user_id', '=', 'users.id')
            ->whereYear('numbers.created_at', date('Y'))
            ->where('numbers.state', 'validé')
            ->where('users.is_admin', false)
            ->groupBy(DB::raw("MONTH(numbers.created_at), MONTHNAME(numbers.created_at)"))
            ->orderByRaw('MONTH(numbers.created_at)')
            ->pluck('total_number_sum', 'month_name');





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

        $data_numbers_echoues = $allMonths->map(function ($month) use ($chart_numbers_echoues) {
            return $chart_numbers_echoues->has($month) ? $chart_numbers_echoues[$month] : 0;
        });


        $data_recharges_sum = $allMonths->map(function ($month) use ($chart_recharges_sum) {
            return $chart_recharges_sum->has($month) ? $chart_recharges_sum[$month] : 0;
        });


        $data_numbers_sum = $allMonths->map(function ($month) use ($chart_numbers_sum) {
            return $chart_numbers_sum->has($month) ? $chart_numbers_sum[$month] : 0;
        });

        $chart_recharges_by_day = Recharge::select(DB::raw("SUM(recharges.amount) as total_amount"), DB::raw("DATE(recharges.created_at) as date"))
        ->join('users', 'recharges.user_id', '=', 'users.id')
        ->whereYear('recharges.created_at', date('Y'))
        ->where('users.is_admin', false)
        ->groupBy(DB::raw("DATE(recharges.created_at)"))
        ->orderByRaw('DATE(recharges.created_at)')
        ->pluck('total_amount', 'date');




        $chart_numbers_achetes_by_day = Number::select(DB::raw("COUNT(numbers.id) as total_count"), DB::raw("DATE(numbers.created_at) as date"))
        ->join('users', 'numbers.user_id', '=', 'users.id')
        ->whereYear('numbers.created_at', date('Y'))
        ->where('users.is_admin', false)
        ->groupBy(DB::raw("DATE(numbers.created_at)"))
        ->orderByRaw('DATE(numbers.created_at)')
        ->pluck('total_count', 'date');




        $chart_numbers_echoues_by_day = Number::select(DB::raw("SUM(numbers.amount) as total_amount"), DB::raw("DATE(numbers.created_at) as date"))
        ->join('users', 'numbers.user_id', '=', 'users.id')
        ->whereYear('numbers.created_at', date('Y'))
        ->where('numbers.state', 'echoué')
        ->where('users.is_admin', false)
        ->groupBy(DB::raw("DATE(numbers.created_at)"))
        ->orderByRaw('DATE(numbers.created_at)')
        ->pluck('total_amount', 'date');



        $users_count_by_day = User::select(DB::raw("COUNT(*) as user_count"), DB::raw("DATE(created_at) as date"))
        ->whereYear('created_at', date('Y'))
        ->where('is_admin', false) // Exclure les utilisateurs avec is_admin == true
        ->groupBy(DB::raw("DATE(created_at)"))
        ->orderByRaw('DATE(created_at)')
        ->pluck('user_count', 'date');





        $minDate = DB::table('recharges')
    ->selectRaw('MIN(DATE(created_at)) as min_date')
    ->union(DB::table('numbers')
        ->selectRaw('MIN(DATE(created_at)) as min_date'))
    ->union(DB::table('users')
        ->selectRaw('MIN(DATE(created_at)) as min_date'))
    ->value('min_date');

    $maxDate = DB::table('recharges')
    ->selectRaw('MAX(DATE(created_at)) as max_date')
    ->union(DB::table('numbers')
        ->selectRaw('MAX(DATE(created_at)) as max_date'))
    ->union(DB::table('users')
        ->selectRaw('MAX(DATE(created_at)) as max_date'))
    ->orderBy('max_date', 'desc') // Ordonner par date décroissante
    ->value('max_date');


        $allDates = [];
        $currentDate = $minDate;

        while ($currentDate <= $maxDate) {
            $allDates[] = $currentDate;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

     
        return view('private.stats.index', compact(
            'numbers',
            'title',
            'countries_count',
            'recharges',
            'users',
            'numbers_valide',
            'numbers_en_cours',
            'numbers_echoue',
            'labels',
            'data_users',
            'data_recharges',
            'data_numbers_achetes',
            'data_numbers_echoues',
            'data_recharges_sum',
            'data_numbers_sum',
            'chart_recharges_by_day',
            'chart_numbers_achetes_by_day',
            'chart_numbers_echoues_by_day',
            'users_count_by_day',
            'allDates'
        ));

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


    public function getLocation($ip)
    {
        // Appeler l'API "ipinfo.io" pour obtenir les détails de localisation
        $api_url = 'https://ipinfo.io/' . $ip . '/json';
        $response = Http::get($api_url);
        $location_data = $response->json();

        return response()->json($location_data);
    }

}
