<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use App\Models\Offender;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ListDataKasusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $userRole = auth()->user();

        $offender = Offender::select(['offenders.*', 'offender_crime_indications.crime_key', 'master_list_crime_of_potential_targets.name as potential_targets', 'master_list_crime_of_perpetrator_targets.name as perpetrator_targets', 'master_list_equipment.name as equitmment', 'master_list_motives.name as motive', 'offender_external_visits.date_visit as date_external_visits', 'offender_internal_visits.date_visit as date_internal_visits'])
            ->join('offender_crime_indications', 'offender_crime_indications.offender_id', '=', 'offenders.id')
            ->leftJoin('offender_external_visits', 'offender_external_visits.offender_id', '=', 'offenders.id')
            ->leftJoin('offender_internal_visits', 'offender_internal_visits.offender_id', '=', 'offenders.id')
            ->leftJoin('master_list_crime_of_potential_targets', 'master_list_crime_of_potential_targets.id', '=', 'offender_crime_indications.crime_id')
            ->leftJoin('master_list_crime_of_perpetrator_targets', 'master_list_crime_of_perpetrator_targets.id', '=', 'offender_crime_indications.crime_id')
            ->leftJoin('master_list_equipment', 'master_list_equipment.id', '=', 'offender_crime_indications.equipment_id')
            ->leftJoin('master_list_motives', 'master_list_motives.id', '=', 'offender_crime_indications.motives_id')
            ->where('offender_crime_indications.is_gang_crime', request('kasus') ?? 0);

        if (!empty($userRole->polsek_code)) $offender->where('offenders.polres_id', $userRole->polsek_code);
        else if (!empty($userRole->polres_code)) $offender->where('offenders.polres_id', $userRole->polres_code);

        $offender->orderBy('offenders.created_at', 'DESC');

        $offenders = $offender->paginate(10);

        if ($request->ajax()) {
            return response()->json($offenders);
        }

        return view('pages.data_kasus.index', compact('offenders'));
    }
}
