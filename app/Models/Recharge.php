<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    use HasFactory;
    protected $fillable = [ 'user_id', 'amount', 'state', 'name','paiement'];

    public function user(){
        return $this->belongsTo('App\Models\User', "user_id");
    }

}
