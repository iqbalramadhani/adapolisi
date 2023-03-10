<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndonesiaProvince extends Model
{
    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany('App\Models\IndonesiaCity', 'province_code');
    }

    public function districts()
    {
        return $this->hasManyThrough('App\Models\IndonesiaDistrict', 'App\Models\IndonesiaCity');
    }
}