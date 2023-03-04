<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OffenderCrimeIndication extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'crime_formatted'
    ];

    protected function crimeFormatted(): Attribute
    {
        switch ($this->crime_key) {
            case 'App/Model/MasterListCrimeOfPotentialTarget':
                $crime = MasterListCrimeOfPotentialTarget::select('name')->where('id', $this->crime_id)->first();
                break;

            case 'App/Model/MasterListCrimeOfPerpetratorTarget':
                $crime = MasterListCrimeOfPerpetratorTarget::select('name')->where('id', $this->crime_id)->first();
                break;
        }

        return new Attribute(
            get: fn () => $crime->name ?? '-',
        );
    }
    
    public function motive()
    {
        return $this->belongsTo('App\Models\MasterListMotive', 'motives_id');
    }

    public function equipment()
    {
        return $this->belongsTo('App\Models\MasterListEquipment', 'equipment_id');
    }

    public function crime()
    {
        return $this->belongsTo('App\Models\MasterListCrimeOfPerpetratorTarget', 'equipment_id');
    }

    public function offender()
    {
        return $this->belongsTo('App\Models\Offender', 'offender_id');
    }
}
