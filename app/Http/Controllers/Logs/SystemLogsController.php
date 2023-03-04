<?php

namespace App\Http\Controllers\Logs;

use App\DataTables\Logs\SystemLogsDataTable;
use App\Http\Controllers\Controller;
use App\Models\MasterListEquipment;
use App\Models\MasterListMotive;
use App\Models\MasterListTimePattern;
use App\Models\MasterListVehicle;
use Jackiedo\LogReader\LogReader;
use App\Models\Perpetrator;
use Illuminate\Http\Request;

class SystemLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SystemLogsDataTable $dataTable, Request $request)
    {

        $userRole = auth()->user();

        $perpetrator = Perpetrator::select(['perpetrators.*', \DB::raw("(select count(*) from offenders where exists (select * from offender_crime_indications where offenders.id = offender_crime_indications.offender_id) and perpetrator_id = perpetrators.id and status in (1,2)) as kasus_aktif"), \DB::raw("(select count(*) from offenders where exists (select * from offender_crime_indications where offenders.id = offender_crime_indications.offender_id) and perpetrator_id = perpetrators.id and status = 3) as kasus_ditutup"), 'offenders.admin_id', 'users.id as user_id', 'users.full_name as admin_name', 'master_list_polres.name as polres_name'])
            ->join('offenders', 'offenders.perpetrator_id', '=', 'perpetrators.id')
            ->join('users', 'users.id', '=', 'offenders.admin_id')
            ->join('master_list_polres', 'master_list_polres.id', 'users.polres_code');

        if (!empty($userRole->polsek_code)) $perpetrator->where('offenders.polsek_id', $userRole->polsek_code);
        else if (!empty($userRole->polres_code)) $perpetrator->where('offenders.polres_id', $userRole->polres_code);

        if (request('search')) {
            $perpetrator->whereLike('name', request('search'))->orWhere('nik', 'like', '%' . request('search') . '%');
        } else if (request('step_filter')) {
            $requestses = request('step_filter');
            if ($requestses == 'fullfill') {
                $perpetrator->whereIn('perpetrators.id', function ($query) {
                    $query->select('perpetrator_id')->from('perpetrator_personal_infos');
                });
                $perpetrator->whereIn('perpetrators.id', function ($query) {
                    $query->select('perpetrator_id')->from('perpetrator_addresses');
                });
                $perpetrator->whereIn('perpetrators.id', function ($query) {
                    $query->select('perpetrator_id')->from('perpetrator_criminal_offenses');
                });
            } else if ($requestses == 'nofullfill') {
                $perpetrator->whereNotIn('perpetrators.id', function ($query) {
                    $query->select('perpetrator_id')->from('perpetrator_personal_infos');
                });
                $perpetrator->orWhere('perpetrators.id', 'IN', function ($query) {
                    $query->select('perpetrator_id')->from('perpetrator_addresses');
                });
                $perpetrator->orWhere('perpetrators.id', 'IN', function ($query) {
                    $query->select('perpetrator_id')->from('perpetrator_criminal_offenses');
                });
            } else if ($requestses == 'fulloffrenders') {
                $perpetrator->whereIn('offenders.id', function ($query) {
                    $query->select('offender_id')->from('offender_crime_indications');
                });
            } else if ($requestses == 'nofulloffrenders') {
                $perpetrator->where(\DB::raw("(select count(*) from offenders where exists (select * from offender_crime_indications where offenders.id = offender_crime_indications.offender_id) and perpetrator_id = perpetrators.id and status in (1,2))"), '=', 0)->where(\DB::raw("(select count(*) from offenders where exists (select * from offender_crime_indications where offenders.id = offender_crime_indications.offender_id) and perpetrator_id = perpetrators.id and status = 3)"), '=', 0);
            }
        } else if (request('motif')) {
            $perpetrator->whereIn('offenders.id', function ($query) {
                $query->select('offender_id')
                    ->from('offender_crime_indications')
                    ->where('motives_id', request('motif'));
            });
        } else if (request('event_time')) {
            $perpetrator->whereIn('offenders.id', function ($query) {
                $query->select('offender_id')
                    ->from('offender_crime_indications')
                    ->where('time_id', request('event_time'));
            });
        } else if (request('alat')) {
            $perpetrator->whereIn('offenders.id', function ($query) {
                $query->select('offender_id')
                    ->from('offender_crime_indications')
                    ->where('equipment_id', request('alat'));
            });
        } else if (request('sarana')) {
            $perpetrator->whereIn('offenders.id', function ($query) {
                $query->select('offender_id')
                    ->from('offender_crime_indications')
                    ->where('vehicle_id', request('sarana'));
            });
        }

        $perpetrator->orderBy('created_at', 'DESC');
        $perpetrators = $perpetrator->paginate(10);

        if ($request->ajax()) {
            return response()->json($perpetrators);
        }

        $motive = MasterListMotive::all();
        $time_event = MasterListTimePattern::all();
        $tool = MasterListEquipment::all();
        $mean = MasterListVehicle::all();

        return view('pages.log.system.index', compact('perpetrators', 'motive', 'time_event', 'tool', 'mean'));
    }

    // public function index(SystemLogsDataTable $dataTable)
    // {
    //     return $dataTable->render('pages.log.system.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, LogReader $logReader)
    {
        return $logReader->find($id)->delete();
    }
}
