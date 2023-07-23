<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Number;
use App\Models\Country;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'identifiant',
        'status',
        'role',
        'parent_id',
        'account_balance',
        'affiliate_exarnings'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function recharges()
    {
        return $this->hasMany('App\Models\Recharge');
    }

    public function numbers()
    {
        return $this->hasMany('App\Models\Number');
    }


    public function calcAmount()
    {
        $recharges = $this->recharges()->where('state', ["validé"])->sum('amount');
        $achats = $this->numbers()->whereIn('state', ["en cours", "validé"])->sum('amount');
        $this->account_balance = $recharges - $achats;
        $this->save();
    }



    public function restoreState()
    {
        $admin = Auth::user()->is_admin == 1;
        if ($admin) {
            $getState = Number::where('state', 'en cours')->get();
            foreach ($getState as $getStateDate) {
                $date = Carbon::parse($getStateDate->created_at)->addMinutes(10)->format('H:i:s');
                $is_ExpiredDate = Carbon::now()->format('H:i:s');
                if ($is_ExpiredDate >= $date) {
                    $getStateDate->update(['state' => "echoué"]);
                    $getUsers = User::all();
                    foreach($getUsers as $getUser) {
                        $getUser->calcAmount();
                    }

                }
            }
        } else {
            $getState = $this->numbers()->where('state', 'en cours')->get();
            if($getState) {
                foreach ($getState as $getStateDate) {
                    $date = Carbon::parse($getStateDate->created_at)->addMinutes(10)->format('H:i:s');
                    $is_ExpiredDate = Carbon::now()->format('H:i:s');
                    if ($is_ExpiredDate >= $date) {
                        $getStateDate->update(['state' => "echoué"]);
                        Auth::user()->calcAmount();

                    }
                }
            }
        }


    }
}
