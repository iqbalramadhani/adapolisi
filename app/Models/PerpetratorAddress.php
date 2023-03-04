<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerpetratorAddress extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function perpetrator()
    {
        return $this->belongsTo('App\Models\Perpetrator', 'perpetrator_id');
    }
}
