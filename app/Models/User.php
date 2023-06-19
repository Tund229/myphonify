<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Country;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function recharges(){
        return $this->hasMany('App\Models\Recharge');
    }

    public function numbers(){
        return $this->hasMany('App\Models\Number');
    }


    public function calcAmount()
    {
        $recharges = $this->recharges()->where('state', ["validé"])->sum('amount');
        $achats = $this->numbers()->whereIn('state', ["en cours", "validé"])->sum('amount');
        $this->account_balance = $recharges - $achats;
        $this->save();
    }
}
