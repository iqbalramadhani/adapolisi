<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Perpetrator extends Model
{
    use HasFactory;

    protected $guarded = [];  

    protected $appends = [
        'age',
        'gender_formatted',
        'job_formatted'
    ];

    public function offenders()
    {
        return $this->hasMany('App\Models\Offender', 'perpetrator_id');
    }

    protected function genderFormatted(): Attribute
    {
        switch ($this->gender) {
            case 'L':
                $gender = 'Pria';
                break;

            case 'P':
                $gender = 'Wanita';
                break;
        }

        return new Attribute(
            get: fn () => $gender,
        );
    }

    protected function age(): Attribute
    {
        return new Attribute(
            get: fn () => Carbon::parse($this->attributes['date_of_birth'])->age,
        );
    }

    protected function jobFormatted(): Attribute
    {
        $job = MasterListJob::where('id', $this->job_id)->first();
        return new Attribute(
            get: fn () => $job->name,
        );
    }

    public function perpetratorPersonalInfo()
    {
        return $this->hasOne('App\Models\PerpetratorPersonalInfo');
    }

    public function perpetratorAddress()
    {
        return $this->hasMany('App\Models\PerpetratorAddress');
    }
}
