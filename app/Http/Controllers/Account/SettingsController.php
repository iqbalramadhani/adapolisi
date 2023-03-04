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
use App\Models\MasterListCrimeMode;
use App\Models\Offender;
use App\Models\OffenderCrimeIndication;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $info = auth()->user()->info;
        $jobs = MasterListJob::get();

        // get the default inner page
        return view('pages.account.settings.settings', compact('jobs'));
    }

    public function indexDataUmum()
    {
        $info = auth()->user()->info;
        $jobs = MasterListJob::get();

        // get the default inner page
        return view('pages.account.settings.settings', compact('jobs'));
    }

    public function indexDataPribadi()
    {
        $jobs = MasterListJob::get();
        $provinces = IndonesiaProvince::get();

        // get the default inner page
        return view('pages.account.settings.data-pribadi', compact('jobs', 'provinces'));
    }

    public function indexDataKejadian(Request $request)
    {
        $offender_id = $request->segment(4);
        $data_offender = Offender::where('id', $offender_id)->first();
        
        $jobs = MasterListJob::get();
        $provinces = IndonesiaProvince::get();
        $crime_perpetrator_targets = MasterListCrimeOfPerpetratorTarget::get();
        $crime_potential_targets = MasterListCrimeOfPotentialTarget::get();
        $equipments = MasterListEquipment::get();
        $how_get_equipments = MasterListHowGetEquipment::get();
        $motives = MasterListMotive::get();
        $time_patterns = MasterListTimePattern::get();
        $vehicles = MasterListVehicle::get();
        $crime_modes = MasterListCrimeMode::get();

        if ($data_offender->type == 1) 
            $crimes = MasterListCrimeOfPotentialTarget::get();

        if ($data_offender->type == 2) 
            $crimes = MasterListCrimeOfPerpetratorTarget::get();

        // get the default inner page
        return view('pages.account.settings.data-kejadian', compact('jobs', 'provinces', 'crimes', 'crime_perpetrator_targets', 'crime_potential_targets', 'equipments', 'how_get_equipments', 'motives', 'time_patterns', 'vehicles', 'crime_modes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $jobs = MasterListJob::get();
        $provinces = IndonesiaProvince::get();

        $perpetrator_info = Perpetrator::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'date_of_birth' => $request->dob,
            'gender' => $request->gender,
            'job' => $request->job_id,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        // $info->save();
        // return view('pages.account.settings.data-pribadi', compact('jobs', 'provinces'));
// dd($perpetrator_info);
        // return redirect()->route('settings.dataPribadi');
        // return redirect()->to(route('settings.dataPribadi'));
        return response()->json(['url'=>url('/account/settings/data-pribadi/'.$perpetrator_info->id.'')]);
    }

    // step 1

    public function updateDataUmum(Request $request)
    {
        $validasi = [
            'nik' => 'required|unique:perpetrators|digits:16',
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'job_id' => 'required',
        ];

        $validasi_message = [
            'nik.required' => 'NIK harus diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka',
            'name.required' => 'Nama harus diisi',
            'dob.required' => 'Tanggal lahir harus diisi',
            'gender' => 'Jenis kelamin harus dipilih',
            'job_id.required' => 'Pekerjaan harus dipilih',
        ];

        $validator = Validator::make(
            $request->all(),
            $validasi,
            $validasi_message
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        \DB::beginTransaction();
        try {
        
            $perpetrator = Perpetrator::create([
                'nik' => $request->nik,
                'name' => $request->name,
                'date_of_birth' => $request->dob,
                'gender' => $request->gender,
                'job_id' => $request->job_id,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
            ]);

            $offender = Offender::where('id', $request->offender_id)->first();
            $offender->update([
                'status' => 1, //pendataan
                'perpetrator_id' => $perpetrator->id
            ]);

            \DB::commit();
            // return response()->json(['url'=>url('/account/settings/data-pribadi/'.$perpetrator_info->id.'')]);
            return redirect()->route('settings.dataPribadi', ['id'=> $request->offender_id,'perpetrator_id' => $perpetrator->id]);

        } catch(\Exception $e) {
            \DB::rollback();
            throw $e;
            // Alert::toast('Terjadi kesalahan', 'error')->padding('10px');
            return redirect()->back();
        }
    }

    // Step 2

    public function updateDataPribadi(Request $request)
    {
        $validasi = [
            'father_name' => 'required',
            'father_job' => 'required',
            'mother_name' => 'required',
            'mother_job' => 'required',
            'parent_address' => 'required',
            // 'parent_rt' => 'required',
            // 'parent_rw' => 'required',
            'province_parent' => 'required',
            'city_parent' => 'required',
            'district_parent' => 'required',
            'village_parent' => 'required',
            
        ];

        $validasi_message = [
            'father_name.required' => 'Nama ayah harus di isi',
            'father_job.required' => 'Pekerjaan ayah harus di pilih',
            'mother_name.required' => 'Nama ibu harus di pilih',
            'mother_job.required' => 'Pekerjaan ibu harus di pilih',
            'parent_address.required' => 'Alamat tinggal orang tua harus di isi',
            // 'parent_rt.required' => 'RT harus di isi',
            // 'parent_rw.required' => 'RW harus di isi',
            'province_parent.required' => 'Provinsi harus di pilih',
            'city_parent.required' => 'Kota harus di pilih',
            'district_parent.required' => 'Kecamatan harus di pilih',
            'village_parent.required' => 'Kelurahan harus di pilih',
        ];

        $validator = Validator::make(
            $request->all(),
            $validasi,
            $validasi_message
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        \DB::beginTransaction();
        try {
            $perpetrator_personal_info = PerpetratorPersonalInfo::updateOrCreate([
                'perpetrator_id' => $request->perpetrator_id,
            ],[
                'father_name' => $request->father_name,
                'father_job' => $request->father_job,
                'mother_name' => $request->mother_name,
                'mother_job' => $request->mother_job,
                'guardian_name' => $request->guardian_name,
                'guardian_job' => $request->guardian_job,
            ]);

            // ----------------------------------- START OF INPUT ADDRESS ----------------------------------- //
            $parent_address = PerpetratorAddress::updateOrCreate([
                'perpetrator_id' => $request->perpetrator_id,
                'type' => 1, //alamat orang tua
            ],[
                'address' => $request->parent_address,
                'rt' => $request->parent_rt,
                'rw' => $request->parent_rw,
                'province_id' => $request->province_parent,
                'city_id' => $request->city_parent,
                'district_id' => $request->district_parent,
                'subdistrict_id' => $request->village_parent,
            ]);

            if ($request->isSameAddress) {
                $perpetrator_address = PerpetratorAddress::updateOrCreate([
                    'perpetrator_id' => $request->perpetrator_id,
                    'type' => 2, //alamat pelaku
                ],[
                    'address' => $request->parent_address,
                    'rt' => $request->parent_rt,
                    'rw' => $request->parent_rw,
                    'province_id' => $request->province_parent,
                    'city_id' => $request->city_parent,
                    'district_id' => $request->district_parent,
                    'subdistrict_id' => $request->village_parent,
                ]);
            } else {
                $perpetrator_address = PerpetratorAddress::updateOrCreate([
                    'perpetrator_id' => $request->perpetrator_id,
                    'type' => 2, //alamat pelaku
                ],[
                    'address' => $request->perpetrator_address,
                    'rt' => $request->perpetrator_rt,
                    'rw' => $request->perpetrator_rw,
                    'province_id' => $request->province_perpetrator,
                    'city_id' => $request->city_perpetrator,
                    'district_id' => $request->district_perpetrator,
                    'subdistrict_id' => $request->village_perpetrator,
                ]);
            }
            // ----------------------------------- END OF INPUT ADDRESS ----------------------------------- //

            
            // ----------------------------------- START OF UPLOAD FILE ----------------------------------- //
            if ($request->hasFile('files')) {
                foreach($request->file('files') as $file)
                {
                    $folder = "/images/data-pribadi";
                    $upload = Storage::disk('public_uploads')->put($folder, $file);

                    if ($upload) {
                        $upload_file = FileUpload::create([
                            'file_uploadable_type' => 'App/Model/Perpetrator',
                            'file_uploadable_id' => $request->perpetrator_id,
                            'file_path' => $upload
                        ]);
                    }
                }
            }
            // ----------------------------------- END OF UPLOAD FILE ----------------------------------- //


            // ----------------------------------- START OF INPUT TINDAK PIDANA ----------------------------------- //

            for ($i = 0; $i < count($request->addpidana); $i++) {
                $perpetrator_criminal_offense = PerpetratorCriminalOffense::create([
                    'perpetrator_id' => $request->perpetrator_id,
                    'district_court' => $request->addpidana[$i]['district_court'],
                    'police_station' => $request->addpidana[$i]['police_station'],
                    'crime' => $request->addpidana[$i]['crime'],
                    'adjudication' => $request->addpidana[$i]['adjudication'],
                    'notes' => $request->addpidana[$i]['crime_notes'],
                ]);
            }
        
            // ----------------------------------- END OF UPLOAD FILE ----------------------------------- //
            \DB::commit();

            // return response()->json(['url'=>url('/account/settings/data-kejadian/'.$perpetrator_info->id.'')]);
            // return redirect()->route('settings.dataKejadian', $request->perpetrator_id);
            return redirect()->route('settings.dataKejadian', ['id'=> $request->offender_id,'perpetrator_id' => $request->perpetrator_id]);
            
        } catch(\Exception $e) {
            \DB::rollback();
            throw $e;
            // Alert::toast('Terjadi kesalahan', 'error')->padding('10px');
            return redirect()->back();
        }
    
    }

    // Step 3

    public function updateDataKejadian(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data_offender = Offender::where('id', $request->offender_id)->first();
            if ($data_offender->type == 1) 
                $crime_key = 'App/Model/MasterListCrimeOfPotentialTarget';

            if ($data_offender->type == 2) 
                $crime_key = 'App/Model/MasterListCrimeOfPerpetratorTarget';

            $offender_crime_indication = OffenderCrimeIndication::updateOrCreate([
                'offender_id' => $request->offender_id,
            ],[
                'crime_key' => $crime_key,
                'crime_id' => $request->crime_id,
                'date_incident' => $request->date_incident,
                'time_id' => $request->time_id,
                'location_incident' => $request->location_incident,
                'rt' => $request->location_rt,
                'rw' => $request->location_rw,
                'province_id' => $request->province_location,
                'city_id' => $request->city_location,
                'district_id' => $request->district_location,
                'subdistrict_id' => $request->village_location,
                'is_indication_alchohol' => $request->is_indication_alchohol ?? 0,
                'how_to_get_alchohol' => $request->how_to_get_alchohol,
                'is_indication_drug' => $request->is_indication_drug ?? 0,
                'how_to_get_drug' => $request->how_to_get_drug,
                'equipment_id' => $request->equipment_id,
                'how_get_equipment_id' => $request->how_to_get_equipment_id,
                'motives_id' => $request->motives_id,
                'crime_mode_id' => $request->crime_mode_id,
                'vehicle_id' => $request->vehicle_id,
                'plat_number' => $request->plat_number,
                'other_notes' => $request->other_notes,
                'is_gang_crime' => $request->is_gang_crime ?? 0,
                'lead_gang_name' => $request->lead_gang_name,
                'gang_crime_name' => $request->gang_crime_name,
                'total_gang_member' => $request->total_gang_member,
            ]);
            
            // ----------------------------------- START OF UPLOAD FILE ----------------------------------- //
            if ($request->hasFile('files')) {
                foreach($request->file('files') as $file)
                {
                    $folder = "/images/data-kejadian";
                    $upload = Storage::disk('public_uploads')->putFile($folder, $file);

                    if ($upload) {
                        $upload_file = FileUpload::create([
                            'file_uploadable_type' => 'App/Model/OffenderCrimeIndication',
                            'file_uploadable_id' => $offender_crime_indication->id,
                            'file_path' => $upload
                        ]);
                    }
                }
            }
            // ----------------------------------- END OF UPLOAD FILE ----------------------------------- //
            // dd('tes');

            \DB::commit();
            // return response()->json(['url'=>url('/account/settings/data-kejadian/'.$perpetrator_info->id.'')]);
            return redirect()->route('log.system.index');
        } catch(\Exception $e) {
            \DB::rollback();
            throw $e;
            // Alert::toast('Terjadi kesalahan', 'error')->padding('10px');
            // return redirect()->back();
        }
    }

    public function saveDataUmumPelaku(SettingsInfoRequest $request)
    {
        // save user name
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
        ]);

        auth()->user()->update($validated);

        // save on user info
        $info = UserInfo::where('user_id', auth()->user()->id)->first();

        if ($info === null) {
            // create new model
            $info = new UserInfo();
        }

        // attach this info to the current user
        $info->user()->associate(auth()->user());

        foreach ($request->only(array_keys($request->rules())) as $key => $value) {
            if (is_array($value)) {
                $value = serialize($value);
            }
            $info->$key = $value;
        }

        // include to save avatar
        if ($avatar = $this->upload()) {
            $info->avatar = $avatar;
        }

        if ($request->boolean('avatar_remove')) {
            Storage::delete($info->avatar);
            $info->avatar = null;
        }

        $info->save();

        return redirect()->intended('account/settings');
    }

    /**
     * Function for upload avatar image
     *
     * @param  string  $folder
     * @param  string  $key
     * @param  string  $validation
     *
     * @return false|string|null
     */
    public function upload($folder = 'images', $key = 'avatar', $validation = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|sometimes')
    {
        request()->validate([$key => $validation]);

        $file = null;
        if (request()->hasFile($key)) {
            $file = Storage::disk('public')->putFile($folder, request()->file($key), 'public');
        }

        return $file;
    }

    /**
     * Function to accept request for change email
     *
     * @param  SettingsEmailRequest  $request
     */
    public function changeEmail(SettingsEmailRequest $request)
    {
        // prevent change email for demo account
        if ($request->input('current_email') === 'demo@demo.com') {
            return redirect()->intended('account/settings');
        }

        auth()->user()->update(['email' => $request->input('email')]);

        if ($request->expectsJson()) {
            return response()->json($request->all());
        }

        return redirect()->intended('account/settings');
    }

    /**
     * Function to accept request for change password
     *
     * @param  SettingsPasswordRequest  $request
     */
    public function changePassword(SettingsPasswordRequest $request)
    {
        // prevent change password for demo account
        if ($request->input('current_email') === 'demo@demo.com') {
            return redirect()->intended('account/settings');
        }

        auth()->user()->update(['password' => Hash::make($request->input('password'))]);

        if ($request->expectsJson()) {
            return response()->json($request->all());
        }

        return redirect()->intended('account/settings');
    }
}
