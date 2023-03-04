<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offender;
use App\Models\OffenderCrimeIndication;
use App\Models\MasterListPolres;
use App\Models\MasterListPolsek;
use App\Models\MasterListTimePattern;
use App\Models\IndonesiaVillage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexRangkuman(Request $request)
    {
        $admin = User::where('id', auth()->user()->id)->first();

        $tii = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
            ->where('offenders.type', 1)
            ->where('offender_crime_indications.is_gang_crime', 0);

        if ($admin->role_formatted != 'Superadmin Polda') {
            $tii->where('offenders.polres_id', $admin->polres_code);
            $tii->orWhere('offenders.polsek_id', $admin->polsek_code);
        }

        $total_indikasi_individu = $tii->count();

        $tpi = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
            ->where('offenders.type', 2)
            ->where('offender_crime_indications.is_gang_crime', 0);

        if ($admin->role_formatted != 'Superadmin Polda') {
            $tpi->where('offenders.polres_id', $admin->polres_code);
            $tpi->orWhere('offenders.polsek_id', $admin->polsek_code);
        }

        $total_pelaku_individu = $tpi->count();

        $tpk = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
            ->where('offenders.type', 2)
            ->where('offender_crime_indications.is_gang_crime', 1);

        if ($admin->role_formatted != 'Superadmin Polda') {
            $tpk->where('offenders.polres_id', $admin->polres_code);
            $tpk->orWhere('offenders.polsek_id', $admin->polsek_code);
        }

        $total_pelaku_kelompok = $tpk->count();

        $results = [];

        $mlp = new MasterListPolres;

        if ($admin->role_formatted != 'Superadmin Polda') {
            $mlp->where('id', auth()->user()->polres_code);
        }

        $master_list_polres = $mlp->get();

        foreach ($master_list_polres as $polres) {
            $master_list_polsek = MasterListPolsek::where('polres_code', $polres->id)->get();

            foreach ($master_list_polsek as $polsek) {

                $master_time = MasterListTimePattern::get();
                $subdistrict_ids = OffenderCrimeIndication::select(DB::RAW('distinct subdistrict_id as id'))
                    ->join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                    ->join('users', 'users.id', '=', 'offenders.admin_id')
                    ->where('users.polsek_code', $polsek->id)->get();

                foreach ($subdistrict_ids as $subdistrict) {

                    if ($subdistrict->id == null) continue;
                    foreach ($master_time as $time) {
                        $count = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                            ->join('users', 'users.id', '=', 'offenders.admin_id')
                            ->where('users.polsek_code', $polsek->id)
                            ->where('subdistrict_id', $subdistrict->id)
                            ->where('time_id', $time->id)
                            ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(14))->whereDate('offender_crime_indications.created_at', '<=', Carbon::now())
                            ->count();

                        $response = [
                            'polres' => $polres->name,
                            'polsek' => $polsek->name,
                            'subdistrict' => [
                                'subdistrict_id' => $subdistrict->id,
                                'subdistrict_name' => IndonesiaVillage::select('name')->where('code', $subdistrict->id)->first()
                            ],
                            'time_id' => $time->id,
                            'waktu' => $time->name,
                            'value' => $count
                        ];

                        array_push($results, $response);
                    }
                }
            }
        }

        $sorted_data = collect($results)->sortByDesc('value')->values()->take(10);

        return view('pages.index-rangkuman', compact('sorted_data', 'total_indikasi_individu', 'total_pelaku_individu', 'total_pelaku_kelompok'));
    }

    public function RangkumanMobile()
    {
        $admin = User::where('id', auth()->user()->id)->first();

        $results = [];
        if ($admin->role_formatted == 'Superadmin Polda') {
            $results = Cache::remember('users', 360, function () {

                $results = [];
                $master_list_polres = MasterListPolres::get();
                foreach ($master_list_polres as $polres) {
                    $master_list_polsek = MasterListPolsek::where('polres_code', $polres->id)->get();

                    foreach ($master_list_polsek as $polsek) {

                        $master_time = MasterListTimePattern::get();
                        $subdistrict_ids = OffenderCrimeIndication::select(DB::RAW('distinct subdistrict_id as id'))
                            ->join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                            ->join('users', 'users.id', '=', 'offenders.admin_id')
                            ->where('users.polsek_code', $polsek->id)->get();

                        foreach ($subdistrict_ids as $subdistrict) {

                            if ($subdistrict->id == null) continue;
                            foreach ($master_time as $time) {
                                $count = OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
                                    ->join('users', 'users.id', '=', 'offenders.admin_id')
                                    ->where('users.polsek_code', $polsek->id)
                                    ->where('subdistrict_id', $subdistrict->id)
                                    ->where('time_id', $time->id)
                                    ->whereDate('offender_crime_indications.created_at', '>=', Carbon::now()->subDays(14))->whereDate('offender_crime_indications.created_at', '<=', Carbon::now())
                                    ->count();

                                $response = [
                                    'polres' => $polres->name,
                                    'polsek' => $polsek->name,
                                    'subdistrict' => [
                                        'subdistrict_id' => $subdistrict->id,
                                        'subdistrict_name' => IndonesiaVillage::select('name')->where('code', $subdistrict->id)->first()
                                    ],
                                    'time_id' => $time->id,
                                    'waktu' => $time->name,
                                    'value' => $count
                                ];

                                array_push($results, $response);
                            }
                        }
                    }
                }
                return $results;
            });
        }

        $sorted_data = collect($results)->sortByDesc('value')->values()->take(10);

        return response()->json($sorted_data);
    }


    public function index()
    {
        $config = theme()->getOption('page');

        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $config = theme()->getOption('page');

        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $config = theme()->getOption('page', 'edit');

        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listPolsek()
    {
        // $polseks = new MasterListPolsek;

        $admin = User::where('id', auth()->user()->id)->first();

        if ($admin->roleFormatted == 'Superadmin Polda') {
            $polsek = MasterListPolsek::all();
        }else if ($admin->roleFormatted == 'Admin Polres') {
            $polsek = MasterListPolsek::where('polres_code', $admin->polres_code);
        } else if ($admin->roleFormatted == 'Admin Polsek') {
            $polsek= MasterListPolsek::where('id', $admin->polsek_code)->get();
        }

        return response()->json($polsek);
    }
}
