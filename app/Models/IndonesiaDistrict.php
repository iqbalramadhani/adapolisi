<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndonesiaDistrict extends Model
{
    public $timestamps = false;

    public function city()
	{
	    return $this->belongsTo('App\Models\IndonesiaCity', 'city_code');
	}

	public function villages()
    {
        return $this->hasMany('App\Models\IndonesiaVillage', 'district_code');
    }
}