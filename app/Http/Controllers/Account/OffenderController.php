<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\SettingsEmailRequest;
use App\Http\Requests\Account\SettingsInfoRequest;
use App\Http\Requests\Account\SettingsPasswordRequest;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterListJob;
use App\Models\Perpetrator;
use App\Models\FileUpload;
use App\Models\PerpetratorAddress;
use App\Models\PerpetratorPersonalInfo;
use App\Models\PerpetratorCriminalOffense;
use App\Models\IndonesiaProvince;
use App\Models\MasterListCrimeOfPerpetratorTarget;
use App\Models\MasterListCrimeOfPotentialTarget;
use App\Models\MasterListEquipment;
use App\Models\MasterListHowGetEquipment;
use App\Models\MasterListMotive;
use App\Models\MasterListTimePattern;
use App\Models\MasterListVehicle;
use App\Models\IndonesiaCity;
use App\Models\Offender;
use App\Models\OffenderCrimeIndication;
use App\Models\User;
use DataTables;

class OffenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createOffender(Request $request)
    {
        $admin = User::where('id', auth()->user()->id)->first();

        $offender = Offender::create([
            'type' => $request->offender_type,
            'admin_id' => $admin->id,
            'polres_id' => $admin->polres_code,
            'polsek_id' => $admin->polsek_code
        ]);

        return response()->json(['url'=>url('/account/settings/data-umum/'.$offender->id.'')]);
    }

    public function index()
    {
        $info = auth()->user()->info;
        $jobs = MasterListJob::get();

        // get the default inner page
        return view('pages.account.settings.index-data', compact('jobs'));
    }

    public function getPerpetrators(Request $request)
    {
        if ($request->ajax()) {
            $data = Perpetrator::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function createOffenders($offender_type)
    {
        $admin = User::where('id', auth()->user()->id)->first();

        $offender = Offender::create([
            'type' => $offender_type,
            'admin_id' => auth()->user()->id,
            'polres_id' => $admin->polres_code,
            'polsek_id' => $admin->polsek_code
        ]);

        return redirect('/account/settings/data-umum/'.$offender->id.'');
    }
}
