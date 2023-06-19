<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;
    protected $fillable = ['service', 'country', 'phone', 'country_name', 'state', 'tzip', 'message', 'comment', 'user_id', 'api_name', 'amount'];

    
    public function user(){
        return $this->belongsTo('App\Models\User', "user_id");
    }

    public function pays(){
        return $this->belongsTo('App\Models\Contries_availables', "country");
    }

   
}
