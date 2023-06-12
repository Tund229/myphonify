<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name','phonecode','country_iso','id_whatsapp','id_facebook','id_gmail','id_telegram','state', 'api_id', 'price_whatsapp', 'price_telegram', 'price_facebook', 'price_gmail','price_TikTok', 'price_Viber','price_Signal','Mta', 'en_name'];


    public function api_name()
    {
        return $this->belongsTo('App\Models\Api', "api_id");
    }
    
    public function price($id, $services){
        $country = Country::where($id)->first();
        dd($country);
    }
}
