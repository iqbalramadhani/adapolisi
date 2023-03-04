<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MasterListJob;
use App\Models\MasterListCrimeOfPerpetratorTarget;
use App\Models\MasterListCrimeOfPotentialTarget;
use App\Models\MasterListEquipment;
use App\Models\MasterListHowGetEquipment;
use App\Models\MasterListMotive;
use App\Models\MasterListTimePattern;
use App\Models\MasterListVehicle;
use App\Models\MasterListCrimeMode;
use App\Models\Offender;
use App\Models\OffenderCrimeIndication;
use Carbon\Carbon;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function filterIndividuJob(Request $request)
    {
        $color = ['#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE'];
        $master_data = MasterListJob::limit(7)->get();
        $results = [];
        $roleUser = auth()->user();
        foreach ($master_data as $key => $value) {
            if ($request->filter) {
                if ($request->filter == 0) {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                        ->join('perpetrators', 'perpetrators.id', '=', 'offenders.perpetrator_id');

                    if ($request->polsek) {
                        $counts->join('users', 'users.id', '=', 'offenders.admin_id')
                            ->where('users.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('perpetrators.job_id', $value->id)
                        ->whereDate('offender_crime_indications.created_at', Carbon::now());

                    $count = $counts->count();
                } else {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                        ->join('perpetrators', 'perpetrators.id', '=', 'offenders.perpetrator_id');

                    if ($request->polsek) {
                        $counts->join('users', 'users.id', '=', 'offenders.admin_id')
                            ->where('users.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('perpetrators.job_id', $value->id)
                        ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays($request->filter))
                        ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());

                    $count = $counts->count();
                }
            } else {
                $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                    ->join('perpetrators', 'perpetrators.id', '=', 'offenders.perpetrator_id');
                if ($request->polsek) {
                    $counts->join('users', 'users.id', '=', 'offenders.admin_id')->where('users.polsek_code', $request->polsek);
                }

                if (!empty($roleUser->polres_code)) {
                    $counts->where('offenders.polres_id', $roleUser->polres_code);
                }

                $counts->where('perpetrators.job_id', $value->id)
                    ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(30))
                    ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());
                $count = $counts->count();
            }

            $response = [
                'id' => $value->id,
                'label' => $value->name,
                'data' => [$count],
                'backgroundColor' => [$color[$key]],
            ];
            array_push($results, $response);
        }

        $sorted_data = collect($results)->sortByDesc('data')->values()->take(5);
        return response()->json($sorted_data);
    }

    public function filterParentJob(Request $request)
    {
        $color = ['#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE', '#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE', '#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE'];

        $master_data = MasterListJob::get();
        $results = [];
        $roleUser = auth()->user();

        foreach ($master_data as $key => $value) {

            if ($request->filter) {
                if ($request->filter == 0) {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                        ->join('perpetrator_personal_infos', 'perpetrator_personal_infos.id', '=', 'offenders.perpetrator_id');

                    if ($request->polsek) {
                        $counts->join('users', 'users.id', '=', 'offenders.admin_id')->where('users.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('perpetrator_personal_infos.father_job', $value->id)
                        ->whereDate('offender_crime_indications.created_at', Carbon::now());

                    $count = $counts->count();
                } else {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                        ->join('perpetrators', 'perpetrators.id', '=', 'offenders.perpetrator_id');

                    if ($request->polsek) {
                        $counts->join('users', 'users.id', '=', 'offenders.admin_id')->where('users.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('perpetrators.job_id', $value->id)
                        ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays($request->filter))->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());

                    $count = $counts->count();
                }
            } else {
                $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                    ->join('perpetrators', 'perpetrators.id', '=', 'offenders.perpetrator_id');

                if ($request->polsek) {
                    $counts->join('users', 'users.id', '=', 'offenders.admin_id')->where('users.polsek_code', $request->polsek);
                }

                if (!empty($roleUser->polres_code)) {
                    $counts->where('offenders.polres_id', $roleUser->polres_code);
                }

                $counts->where('perpetrators.job_id', $value->id)
                    ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(30))
                    ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());

                $count =  $counts->count();
            }

            $response = [
                'id' => $value->id,
                'label' => $value->name,
                'data' => [$count],
                'backgroundColor' => [$color[$key]],
            ];
            array_push($results, $response);
        }

        $sorted_data = collect($results)->sortByDesc('data')->values()->take(5);
        return response()->json($sorted_data);
    }

    public function filterTimePattern(Request $request)
    {
        $color = ['#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE', '#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE', '#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE'];

        $master_data = MasterListTimePattern::get();
        $results = [];
        $roleUser = auth()->user();

        foreach ($master_data as $key => $value) {
            if ($request->filter) {
                if ($request->filter == 0) {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('offender_crime_indications.time_id', $value->id)
                        ->whereDate('offender_crime_indications.created_at', Carbon::now());

                    $count =  $counts->count();
                } else {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('offender_crime_indications.time_id', $value->id)
                        ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays($request->filter))
                        ->whereDate('created_at', '<=', Carbon::now());

                    $count = $counts->count();
                }
            } else {
                $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');

                if ($request->polsek) {
                    $counts->where('offenders.polsek_code', $request->polsek);
                }

                if (!empty($roleUser->polres_code)) {
                    $counts->where('offenders.polres_id', $roleUser->polres_code);
                }

                $counts->where('offender_crime_indications.time_id', $value->id)
                    ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(30))
                    ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());

                $count = $counts->count();
            }

            $response = [
                'id' => $value->id,
                'label' => $value->name,
                'data' => $count,
                'backgroundColor' => [$color[$key]],
            ];
            array_push($results, $response);
        }

        $sorted_data = collect($results)->sortByDesc('value')->values()->all();
        return response()->json($sorted_data);
    }

    public function filterMotiveCrime(Request $request)
    {
        $color = ['#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE'];

        $master_data = MasterListMotive::get();
        $results = [];
        $roleUser = auth()->user();

        foreach ($master_data as $key => $value) {

            $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
            if ($request->polsek) {
                $counts->where('offenders.polsek_code', $request->polsek);
            }

            if (!empty($roleUser->polres_code)) {
                $counts->where('offenders.polres_id', $roleUser->polres_code);
            }

            $counts->where('offender_crime_indications.motives_id', $value->id)
                ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(30))
                ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());

            $count = $counts->count();

            $response = [
                'id' => $value->id,
                'label' => $value->name,
                'data' => [$count],
                'backgroundColor' => [$color[$key]],
            ];
            array_push($results, $response);
        }

        $sorted_data = collect($results)->sortByDesc('data')->values()->take(5);
        return response()->json($sorted_data);
    }

    public function filterEquipment(Request $request)
    {
        $color = ['#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE'];
        $master_data = MasterListEquipment::get();
        $results = [];
        $roleUser = auth()->user();

        foreach ($master_data as $key => $value) {

            if ($request->filter) {
                if ($request->filter == 0) {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');

                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('offender_crime_indications.equipment_id', $value->id)
                        ->whereDate('offender_crime_indications.created_at', Carbon::now());

                    $count = $counts->count();
                } else {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');

                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('offender_crime_indications.equipment_id', $value->id)
                        ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays($request->filter))
                        ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());

                    $count = $counts->count();
                }
            } else {
                $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');

                if ($request->polsek) {
                    $counts->where('offenders.polsek_code', $request->polsek);
                }

                if (!empty($roleUser->polres_code)) {
                    $counts->where('offenders.polres_id', $roleUser->polres_code);
                }

                $counts->where('offender_crime_indications.equipment_id', $value->id)
                    ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(30))
                    ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());

                $count = $counts->count();
            }

            $response = [
                'id' => $value->id,
                'label' => $value->name,
                'data' => [$count],
                'backgroundColor' => [$color[$key]],
            ];
            array_push($results, $response);
        }

        $sorted_data = collect($results)->sortByDesc('data')->values()->take(5);
        return response()->json($sorted_data);
    }

    public function filterVehicle(Request $request)
    {
        $color = ['#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE'];

        $master_data = MasterListVehicle::get();
        $results = [];
        $roleUser = auth()->user();

        foreach ($master_data as $key => $value) {

            if ($request->filter) {
                if ($request->filter == 0) {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('offender_crime_indications.vehicle_id', $value->id)
                        ->whereDate('offender_crime_indications.created_at', Carbon::now());

                    $count = $counts->count();
                } else {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('offender_crime_indications.vehicle_id', $value->id)
                        ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays($request->filter))
                        ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());

                    $count = $counts->count();
                }
            } else {
                $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');

                if ($request->polsek) {
                    $counts->where('offenders.polsek_code', $request->polsek);
                }

                if (!empty($roleUser->polres_code)) {
                    $counts->where('offenders.polres_id', $roleUser->polres_code);
                }

                $counts->where('offender_crime_indications.vehicle_id', $value->id)
                    ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(30))
                    ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());

                $count = $counts->count();
            }

            $response = [
                'id' => $value->id,
                'label' => $value->name,
                'data' => [$count],
                'backgroundColor' => [$color[$key]],
            ];
            array_push($results, $response);
        }

        $sorted_data = collect($results)->sortByDesc('data')->values()->take(6);
        return response()->json($sorted_data);
    }

    public function filterAlchoholIndicate(Request $request)
    {
        $results = [];
        $roleUser = auth()->user();

        for ($i = 0; $i <= 1; $i++) {
            if ($request->filter) {
                if ($request->filter == 0) {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');

                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('offender_crime_indications.is_indication_alchohol', $i)
                        ->whereDate('offender_crime_indications.created_at', Carbon::now());

                    $count = $counts->count();
                } else {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');

                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }

                    if (!empty($roleUser->polres_code)) {
                        $counts->where('offenders.polres_id', $roleUser->polres_code);
                    }

                    $counts->where('offender_crime_indications.is_indication_alchohol', $i)
                        ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays($request->filter))
                        ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());

                    $count = $counts->count();
                }
            } else {
                $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                if ($request->polsek) {
                    $counts->where('offenders.polsek_code', $request->polsek);
                }
                if (!empty($roleUser->polres_code)) {
                    $counts->where('offenders.polres_id', $roleUser->polres_code);
                }
                $counts->where('offender_crime_indications.is_indication_alchohol', $i)->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(30))->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());
                $count = $counts->count();
            }

            $key = $i == 1 ? 'Menggunakan miras' : 'Tidak menggunakan miras';
            $response = [
                'key' => $key,
                'value' => $count
            ];
            array_push($results, $response);
        }
        return response()->json($results);
    }

    public function filterDrugIndicate(Request $request)
    {
        $results = [];
        $roleUser = auth()->user();

        for ($i = 0; $i <= 1; $i++) {
            if ($request->filter) {
                if ($request->filter == 0) {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                    if ($request->polsek) $counts->where('offenders.polsek_code', $request->polsek);
                    if (!empty($roleUser->polres_code)) $counts->where('offenders.polres_id', $roleUser->polres_code);
                    $counts->where('offender_crime_indications.is_indication_drug', $i)
                        ->whereDate('offender_crime_indications.created_at', Carbon::now());
                    $count = $counts->count();
                } else {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                    if ($request->polsek) $counts->where('offenders.polsek_code', $request->polsek);
                    if (!empty($roleUser->polres_code)) $counts->where('offenders.polres_id', $roleUser->polres_code);
                    $counts->where('offender_crime_indications.is_indication_drug', $i)
                        ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays($request->filter))
                        ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());
                    $count = $counts->count();
                }
            } else {
                $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                if ($request->polsek) $counts->where('offenders.polsek_code', $request->polsek);
                if (!empty($roleUser->polres_code)) $counts->where('offenders.polres_id', $roleUser->polres_code);
                $counts->where('offender_crime_indications.is_indication_drug', $i)
                    ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(30))
                    ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());
                $count = $counts->count();
            }

            $key = $i == 1 ? 'Menggunakan narkoba' : 'Tidak menggunakan narkoba';
            $response = [
                'key' => $key,
                'value' => $count
            ];
            array_push($results, $response);
        }
        return response()->json($results);
    }

    public function filterGangMember(Request $request)
    {
        $color = ['#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE'];
        $master_data = ['0-50', '51-100', '100-150', '150-1000000'];
        $results = [];
        $roleUser = auth()->user();
        foreach ($master_data as $key => $value) {
            $range = explode('-', $value);

            if ($request->filter) {
                if ($request->filter == 0) {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }
                    if (!empty($roleUser->polres_code)) $counts->where('offenders.polres_id', $roleUser->polres_code);
                    $counts->where('offender_crime_indications.total_gang_member', '>', $range[0])
                        ->where('offender_crime_indications.total_gang_member', '<', $range[1])
                        ->whereDate('offender_crime_indications.created_at', Carbon::now());
                    $count = $counts->count();
                } else {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                    if ($request->polsek) $counts->where('offenders.polsek_code', $request->polsek);
                    if (!empty($roleUser->polres_code)) $counts->where('offenders.polres_id', $roleUser->polres_code);
                    $counts->where('offender_crime_indications.total_gang_member', '>', $range[0])
                        ->where('offender_crime_indications.total_gang_member', '<', $range[1])
                        ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays($request->filter))
                        ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());
                    $count = $counts->count();
                }
            } else {
                $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id');
                if ($request->polsek) $counts->where('offenders.polsek_code', $request->polsek);
                if (!empty($roleUser->polres_code)) $counts->where('offenders.polres_id', $roleUser->polres_code);
                $counts->where('offender_crime_indications.total_gang_member', '>', $range[0])
                    ->where('offender_crime_indications.total_gang_member', '<', $range[1])
                    ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(30))
                    ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());
                $count = $counts->count();
            }

            $response = [
                'label' => $value == '150-1000000' ? '>150' : $value,
                'data' => [$count],
                'backgroundColor' => [$color[$key]],
            ];

            array_push($results, $response);
        }

        return response()->json($results);
    }

    public function filterAge(Request $request)
    {
        $color = ['#CB212F', '#05213D', '#07315B', '#5A7692', '#ACBAC8', '#CDD6DE', '#D4DAEE'];

        $master_data = ['0-10', '11-15', '16-20', '21-25', '26-30', '30-100'];
        $results = [];
        $roleUser = auth()->user();

        foreach ($master_data as $key => $value) {
            $range = explode('-', $value);
            $from = Carbon::today()->subYears($range[0]);
            $to = Carbon::today()->subYears($range[1]);

            if ($request->filter) {
                if ($request->filter == 0) {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                        ->join('perpetrators', 'perpetrators.id', '=', 'offenders.perpetrator_id');
                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }
                    if (!empty($roleUser->polres_code)) $counts->where('offenders.polres_id', $roleUser->polres_code);
                    $counts->whereBetween('perpetrators.date_of_birth', [$to, $from])
                        ->whereDate('offender_crime_indications.created_at', Carbon::now());
                    $count = $counts->count();
                } else {
                    $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                        ->join('perpetrators', 'perpetrators.id', '=', 'offenders.perpetrator_id');
                    if ($request->polsek) {
                        $counts->where('offenders.polsek_code', $request->polsek);
                    }
                    if (!empty($roleUser->polres_code)) $counts->where('offenders.polres_id', $roleUser->polres_code);
                    $counts->whereBetween('perpetrators.date_of_birth', [$to, $from])
                        ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays($request->filter))
                        ->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());
                    $count = $counts->count();
                }
            } else {
                $counts = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                    ->join('perpetrators', 'perpetrators.id', '=', 'offenders.perpetrator_id');
                if ($request->polsek) {
                    $counts->where('offenders.polsek_code', $request->polsek);
                }
                if (!empty($roleUser->polres_code)) $counts->where('offenders.polres_id', $roleUser->polres_code);
                $counts->whereBetween('perpetrators.date_of_birth', [$to, $from])
                    ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(30))->whereDate('offender_crime_indications.created_at', '<=', Carbon::now());
                $count = $counts->count();
            }

            if ($value == '0-10') {
                $key = '<10';
            } else if ($value == '30-100') {
                $key = '>30';
            } else {
                $key = $value;
            }

            $response = [
                'key' => $key,
                'value' => rand(0, 1),
            ];
            array_push($results, $response);
        }

        return response()->json($results);
    }
}
