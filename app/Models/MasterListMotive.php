<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterListMotive extends Model
{
    use HasFactory;

    public function offenderCrimeIndication()
    {
        return $this->hasMany('App\Models\OffenderCrimeIndication');
    }
}
