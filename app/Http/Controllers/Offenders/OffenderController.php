<?php

namespace App\Http\Controllers\Offenders;

use App\Http\Controllers\Controller;
use App\Models\Offender;
use App\Models\OffenderGeneralInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OffenderController extends Controller
{
    public function createOffender(Request $request) {
        $request->validate([
            'type' => 'required',
        ]);

        $offender = Offender::create([
            'type' => $request->type,
            'data_number' => '0000123',
            'admin_id' => auth()->user()->id
        ]);

        return $offender;
    }

    public function createGeneralInfo(Request $request) {
        $request->validate([
            'offender_id' => 'required',
            'name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'job' => 'required',
        ]);

        $offender_general_info = OffenderGeneralInfo::create([
            'offender_id' => $request->offender_id,
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'job' => $request->job,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        return $offender_general_info;
    }
}