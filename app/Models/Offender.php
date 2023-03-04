<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Offender extends Model
{
    use HasFactory;

    protected $guarded = [];  

    protected $appends = [
        'type_formatted',
        'created_at_formatted'
    ];

    protected function typeFormatted(): Attribute
    {
        switch ($this->type) {
            case '1':
                $type = 'Potensi';
                break;

            case '2':
                $type = 'Pelaku';
                break;
        }

        return new Attribute(
            get: fn () => $type,
        );
    }

    protected function createdAtFormatted(): Attribute
    {
        return new Attribute(
            get: fn () => $this->created_at->format('d/m/Y'),
        );
    }

    public function offenderCrimeIndication()
    {
        return $this->hasOne('App\Models\OffenderCrimeIndication');
    }

    public function offenderInternalVisit()
    {
        return $this->hasOne('App\Models\OffenderInternalVisit');
    }

    public function offenderExternalVisit()
    {
        return $this->hasOne('App\Models\OffenderExternalVisit');
    }

    public function perpetrator()
    {
        return $this->belongsTo('App\Models\Perpetrator', 'perpetrator_id');
    }
}
