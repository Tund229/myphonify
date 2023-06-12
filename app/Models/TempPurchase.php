<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TempPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'country_name',
        'service',
        'service_price',
        'state'
    ];

    public function country () {
        return $this->belongsTo(Country::class);
    }
}
